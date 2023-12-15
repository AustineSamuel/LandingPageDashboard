<?php

class PageInfo
{
    private $conn;

    public function __construct($conn)
    {
        $this->conn = $conn;
    }

    public function createPageInfo($logo, $name)
    {
        $stmt = $this->conn->prepare("INSERT INTO pageInfo (logo, name) VALUES (?, ?)");
        $stmt->bind_param("ss", $logo, $name);
        
        if ($stmt->execute()) {
            return true;
        } else {
            return false;
        }
    }

    public function readPageInfo()
    {
        $result = $this->conn->query("SELECT * FROM pageInfo");

        if ($result->num_rows > 0) {
            $pageInfoArray = array();

            while ($row = $result->fetch_assoc()) {
                $pageInfoArray[] = $row;
            }

            return $pageInfoArray;
        } else {
            return array();
        }
    }

    public function updatePageInfo($id, $logo, $name)
    {
        $stmt = $this->conn->prepare("UPDATE pageInfo SET logo=?, name=? WHERE id=?");
        $stmt->bind_param("ssi", $logo, $name, $id);
        
        if ($stmt->execute()) {
            return true;
        } else {
            return false;
        }
    }

    public function deletePageInfo($id)
    {
        $stmt = $this->conn->prepare("DELETE FROM pageInfo WHERE id=?");
        $stmt->bind_param("i", $id);
        
        if ($stmt->execute()) {
            return true;
        } else {
            return false;
        }
    }
}
