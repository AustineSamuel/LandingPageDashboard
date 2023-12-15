<?php

class HeadingSlideContainersInfo
{
    private $conn;

    public function __construct($conn)
    {
        $this->conn = $conn;
    }

    public function createHeadingSlideContainer($iconImage, $name, $clickRedir)
    {
        $stmt = $this->conn->prepare("INSERT INTO headingSlideContainers (iconImage, name, clickRedir) VALUES (?, ?, ?)");
        $stmt->bind_param("sss", $iconImage, $name, $clickRedir);
        
        if ($stmt->execute()) {
            return true;
        } else {
            return false;
        }
    }

    public function readHeadingSlideContainers()
    {
        $result = $this->conn->query("SELECT * FROM headingSlideContainers");

        if ($result->num_rows > 0) {
            $headingSlideContainersArray = array();

            while ($row = $result->fetch_assoc()) {
                $headingSlideContainersArray[] = $row;
            }

            return $headingSlideContainersArray;
        } else {
            return array();
        }
    }

    public function updateHeadingSlideContainer($id, $iconImage, $name, $clickRedir)
    {
        $stmt = $this->conn->prepare("UPDATE headingSlideContainers SET iconImage=?, name=?, clickRedir=? WHERE id=?");
        $stmt->bind_param("sssi", $iconImage, $name, $clickRedir, $id);
        
        if ($stmt->execute()) {
            return true;
        } else {
            return false;
        }
    }

    public function deleteHeadingSlideContainer($id)
    {
        $stmt = $this->conn->prepare("DELETE FROM headingSlideContainers WHERE id=?");
        $stmt->bind_param("i", $id);
        
        if ($stmt->execute()) {
            return true;
        } else {
            return false;
        }
    }
}
