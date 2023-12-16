<?php

class LatestProjectsInfo
{
    private $conn;

    public function __construct($conn)
    {
        $this->conn = $conn;
    }

    public function createLatestProject($heading, $subHeading)
    {
        $stmt = $this->conn->prepare("INSERT INTO LatestProjects (heading, subHeading) VALUES (?, ?)");
        $stmt->bind_param("ss", $heading, $subHeading);
        
        if ($stmt->execute()) {
            return true;
        } else {
            return false;
        }
    }

    public function readLatestProjects()
    {
        $result = $this->conn->query("SELECT * FROM LatestProjects");

        if ($result->num_rows > 0) {
            $latestProjectsArray = array();

            while ($row = $result->fetch_assoc()) {
                $latestProjectsArray[] = $row;
            }

            return $latestProjectsArray;
        } else {
            return array();
        }
    }

    public function updateLatestProject($id, $heading, $subHeading)
    {
        $stmt = $this->conn->prepare("UPDATE LatestProjects SET heading=?, subHeading=? WHERE id=?");
        $stmt->bind_param("ssi", $heading, $subHeading, $id);
        
        if ($stmt->execute()) {
            return true;
        } else {
            return false;
        }
    }

    public function deleteLatestProject($id)
    {
        $stmt = $this->conn->prepare("DELETE FROM LatestProjects WHERE id=?");
        $stmt->bind_param("i", $id);
        
        if ($stmt->execute()) {
            return true;
        } else {
            return false;
        }
    }
}
