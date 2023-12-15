<?php

class NavigationInfo
{
    private $conn;

    public function __construct($conn)
    {
        $this->conn = $conn;
    }

    public function createNavigation($name, $hashTag)
    {
        $stmt = $this->conn->prepare("INSERT INTO `navigations` (name, hashTag) VALUES (?, ?)");
        $stmt->bind_param("ss", $name, $hashTag);
        
        if ($stmt->execute()) {
            return true;
        } else {
            return false;
        }
    }

    public function readNavigations()
    {
        $result = $this->conn->query("SELECT * FROM `navigations`");

        if ($result->num_rows > 0) {
            $navigationArray = array();

            while ($row = $result->fetch_assoc()) {
                $navigationArray[] = $row;
            }

            return $navigationArray;
        } else {
            return array();
        }
    }

    public function updateNavigation($id, $name, $hashTag)
    {
        $stmt = $this->conn->prepare("UPDATE `navigations` SET name=?, hashTag=? WHERE id=?");
        $stmt->bind_param("ssi", $name, $hashTag, $id);
        
        if ($stmt->execute()) {
            return true;
        } else {
            return false;
        }
    }

    public function deleteNavigation($id)
    {
        $stmt = $this->conn->prepare("DELETE FROM `navigations` WHERE id=?");
        $stmt->bind_param("i", $id);
        
        if ($stmt->execute()) {
            return true;
        } else {
            return false;
        }
    }
}
