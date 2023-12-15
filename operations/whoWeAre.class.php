<?php

class WhoWeAreComponentInfo
{
    private $conn;

    public function __construct($conn)
    {
        $this->conn = $conn;
    }

    public function createWhoWeAreComponent($heading, $text, $buttonText, $clickRedir)
    {
        $stmt = $this->conn->prepare("INSERT INTO whoWeAreComponent (heading, text, buttonText, clickRedir) VALUES (?, ?, ?, ?)");
        $stmt->bind_param("ssss", $heading, $text, $buttonText, $clickRedir);
        
        if ($stmt->execute()) {
            return true;
        } else {
            return false;
        }
    }

    public function readWhoWeAreComponents()
    {
        $result = $this->conn->query("SELECT * FROM whoWeAreComponent");

        if ($result->num_rows > 0) {
            $whoWeAreComponentsArray = array();

            while ($row = $result->fetch_assoc()) {
                $whoWeAreComponentsArray[] = $row;
            }

            return $whoWeAreComponentsArray;
        } else {
            return array();
        }
    }

    public function updateWhoWeAreComponent($id, $heading, $text, $buttonText, $clickRedir)
    {
        $stmt = $this->conn->prepare("UPDATE whoWeAreComponent SET heading=?, text=?, buttonText=?, clickRedir=? WHERE id=?");
        $stmt->bind_param("ssssi", $heading, $text, $buttonText, $clickRedir, $id);
        
        if ($stmt->execute()) {
            return true;
        } else {
            return false;
        }
    }

    public function deleteWhoWeAreComponent($id)
    {
        $stmt = $this->conn->prepare("DELETE FROM whoWeAreComponent WHERE id=?");
        $stmt->bind_param("i", $id);
        
        if ($stmt->execute()) {
            return true;
        } else {
            return false;
        }
    }
}
