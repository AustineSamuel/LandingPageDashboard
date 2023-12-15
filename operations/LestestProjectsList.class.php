<?php

class LatestProjectsListInfo
{
    private $conn;

    public function __construct($conn)
    {
        $this->conn = $conn;
    }

    public function createLatestProjectList($image, $heading, $subHeading)
    {
        $stmt = $this->conn->prepare("INSERT INTO LatestProjectsList (image, heading, subHeading) VALUES (?, ?, ?)");
        $stmt->bind_param("sss", $image, $heading, $subHeading);
        
        if ($stmt->execute()) {
            return true;
        } else {
            return false;
        }
    }

    public function readLatestProjectList()
    {
        $result = $this->conn->query("SELECT * FROM LatestProjectsList");

        if ($result->num_rows > 0) {
            $latestProjectsListArray = array();

            while ($row = $result->fetch_assoc()) {
                $latestProjectsListArray[] = $row;
            }

            return $latestProjectsListArray;
        } else {
            return array();
        }
    }

    public function updateLatestProjectList($id, $image, $heading, $subHeading)
    {
        $stmt = $this->conn->prepare("UPDATE LatestProjectsList SET image=?, heading=?, subHeading=? WHERE id=?");
        $stmt->bind_param("sssi", $image, $heading, $subHeading, $id);
        
        if ($stmt->execute()) {
            return true;
        } else {
            return false;
        }
    }

    public function deleteLatestProjectList($id)
    {
        $stmt = $this->conn->prepare("DELETE FROM LatestProjectsList WHERE id=?");
        $stmt->bind_param("i", $id);
        
        if ($stmt->execute()) {
            return true;
        } else {
            return false;
        }
    }
}
