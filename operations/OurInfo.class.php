<?php

class OurInfo
{
    private $conn;

    public function __construct($conn)
    {
        $this->conn = $conn;
    }

    public function createOurInfo($yearsOfExperience, $talentedTeam, $projectsDelivered, $countriesServed)
    {
        $stmt = $this->conn->prepare("INSERT INTO OurInfo (YearsOfExperience, talentedTeam, projectsDelivered, countriesServed) VALUES (?, ?, ?, ?)");
        $stmt->bind_param("ssss", $yearsOfExperience, $talentedTeam, $projectsDelivered, $countriesServed);
        
        if ($stmt->execute()) {
            return true;
        } else {
            return false;
        }
    }

    public function readOurInfo()
    {
        $result = $this->conn->query("SELECT * FROM OurInfo");

        if ($result->num_rows > 0) {
            $ourInfoArray = array();

            while ($row = $result->fetch_assoc()) {
                $ourInfoArray[] = $row;
            }

            return $ourInfoArray;
        } else {
            return array();
        }
    }

    public function updateOurInfo($id, $yearsOfExperience, $talentedTeam, $projectsDelivered, $countriesServed)
    {
        $stmt = $this->conn->prepare("UPDATE OurInfo SET YearsOfExperience=?, talentedTeam=?, projectsDelivered=?, countriesServed=? WHERE id=?");
        $stmt->bind_param("ssssi", $yearsOfExperience, $talentedTeam, $projectsDelivered, $countriesServed, $id);
        
        if ($stmt->execute()) {
            return true;
        } else {
            return false;
        }
    }

    public function deleteOurInfo($id)
    {
        $stmt = $this->conn->prepare("DELETE FROM OurInfo WHERE id=?");
        $stmt->bind_param("i", $id);
        
        if ($stmt->execute()) {
            return true;
        } else {
            return false;
        }
    }
}
