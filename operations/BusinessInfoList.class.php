<?php

class BusinessInfoListInfo
{
    private $conn;

    public function __construct($conn)
    {
        $this->conn = $conn;
    }

    public function createBusinessInfoListItem($text)
    {
        $stmt = $this->conn->prepare("INSERT INTO BusinessInfoList (text) VALUES (?)");
        $stmt->bind_param("s", $text);
        
        if ($stmt->execute()) {
            return true;
        } else {
            return false;
        }
    }

    public function readBusinessInfoListItems()
    {
        $result = $this->conn->query("SELECT * FROM BusinessInfoList");

        if ($result->num_rows > 0) {
            $businessInfoListArray = array();

            while ($row = $result->fetch_assoc()) {
                $businessInfoListArray[] = $row;
            }

            return $businessInfoListArray;
        } else {
            return array();
        }
    }

    public function updateBusinessInfoListItem($id, $text)
    {
        $stmt = $this->conn->prepare("UPDATE BusinessInfoList SET text=? WHERE id=?");
        $stmt->bind_param("si", $text, $id);
        
        if ($stmt->execute()) {
            return true;
        } else {
            return false;
        }
    }

    public function deleteBusinessInfoListItem($id)
    {
        $stmt = $this->conn->prepare("DELETE FROM BusinessInfoList WHERE id=?");
        $stmt->bind_param("i", $id);
        
        if ($stmt->execute()) {
            return true;
        } else {
            return false;
        }
    }
}
