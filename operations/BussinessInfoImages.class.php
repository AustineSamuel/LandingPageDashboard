<?php

class BusinessInfoImageInfo
{
    private $conn;

    public function __construct($conn)
    {
        $this->conn = $conn;
    }

    public function createBusinessInfoImage($heading, $text, $image)
    {
        $stmt = $this->conn->prepare("INSERT INTO BusinessInfoImage (heading, text, image) VALUES (?, ?, ?)");
        $stmt->bind_param("sss", $heading, $text, $image);
        
        if ($stmt->execute()) {
            return true;
        } else {
            return false;
        }
    }

    public function readBusinessInfoImages()
    {
        $result = $this->conn->query("SELECT * FROM BusinessInfoImage");

        if ($result->num_rows > 0) {
            $businessInfoImageArray = array();

            while ($row = $result->fetch_assoc()) {
                $businessInfoImageArray[] = $row;
            }

            return $businessInfoImageArray;
        } else {
            return array();
        }
    }

    public function updateBusinessInfoImage($id, $heading, $text, $image)
    {
        $stmt = $this->conn->prepare("UPDATE BusinessInfoImage SET heading=?, text=?, image=? WHERE id=?");
        $stmt->bind_param("sssi", $heading, $text, $image, $id);
        
        if ($stmt->execute()) {
            return true;
        } else {
            return false;
        }
    }

    public function deleteBusinessInfoImage($id)
    {
        $stmt = $this->conn->prepare("DELETE FROM BusinessInfoImage WHERE id=?");
        $stmt->bind_param("i", $id);
        
        if ($stmt->execute()) {
            return true;
        } else {
            return false;
        }
    }
}
