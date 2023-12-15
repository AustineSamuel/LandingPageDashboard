<?php

class SubNavigationInfo
{
    private $conn;

    public function __construct($conn)
    {
        $this->conn = $conn;
    }

    public function createSubNavigation($name, $url, $hashTag)
    {
        $stmt = $this->conn->prepare("INSERT INTO `subNavigations` (name, url, hashTag) VALUES (?, ?, ?)");
        $stmt->bind_param("sss", $name, $url, $hashTag);
        
        if ($stmt->execute()) {
            return true;
        } else {
            return false;
        }
    }

    public function readSubNavigations()
    {
        $result = $this->conn->query("SELECT * FROM `subNavigations`");

        if ($result->num_rows > 0) {
            $subNavigationArray = array();

            while ($row = $result->fetch_assoc()) {
                $subNavigationArray[] = $row;
            }

            return $subNavigationArray;
        } else {
            return array();
        }
    }

    public function updateSubNavigation($id, $name, $url, $hashTag)
    {
        $stmt = $this->conn->prepare("UPDATE `subNavigations` SET name=?, url=?, hashTag=? WHERE id=?");
        $stmt->bind_param("sssi", $name, $url, $hashTag, $id);
        
        if ($stmt->execute()) {
            return true;
        } else {
            return false;
        }
    }

    public function deleteSubNavigation($id)
    {
        $stmt = $this->conn->prepare("DELETE FROM `subNavigations` WHERE id=?");
        $stmt->bind_param("i", $id);
        
        if ($stmt->execute()) {
            return true;
        } else {
            return false;
        }
    }
}
