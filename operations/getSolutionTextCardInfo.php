<?php

class GetSolutionTextCardInfo
{
    private $conn;

    public function __construct($conn)
    {
        $this->conn = $conn;
    }

    public function createGetSolutionTextCard($image, $heading, $subHeading, $personImage, $personName, $personRole)
    {
        $stmt = $this->conn->prepare("INSERT INTO GetSolutionTextCard (image, heading, subHeading, personImage, personName, personRole) VALUES (?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("ssssss", $image, $heading, $subHeading, $personImage, $personName, $personRole);
        
        if ($stmt->execute()) {
            return true;
        } else {
            return false;
        }
    }

    public function readGetSolutionTextCards()
    {
        $result = $this->conn->query("SELECT * FROM GetSolutionTextCard");

        if ($result->num_rows > 0) {
            $getSolutionTextCardArray = array();

            while ($row = $result->fetch_assoc()) {
                $getSolutionTextCardArray[] = $row;
            }

            return $getSolutionTextCardArray;
        } else {
            return array();
        }
    }

    public function updateGetSolutionTextCard($id, $image, $heading, $subHeading, $personImage, $personName, $personRole)
    {
        $stmt = $this->conn->prepare("UPDATE GetSolutionTextCard SET image=?, heading=?, subHeading=?, personImage=?, personName=?, personRole=? WHERE id=?");
        $stmt->bind_param("ssssssi", $image, $heading, $subHeading, $personImage, $personName, $personRole, $id);
        
        if ($stmt->execute()) {
            return true;
        } else {
            return false;
        }
    }

    public function deleteGetSolutionTextCard($id)
    {
        $stmt = $this->conn->prepare("DELETE FROM GetSolutionTextCard WHERE id=?");
        $stmt->bind_param("i", $id);
        
        if ($stmt->execute()) {
            return true;
        } else {
            return false;
        }
    }
}
