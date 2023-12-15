<?php

class TechnologiesInfo
{
    private $conn;

    public function __construct($conn)
    {
        $this->conn = $conn;
    }

    public function createTechnology($name, $icon)
    {
        $stmt = $this->conn->prepare("INSERT INTO Technologies (name, icon) VALUES (?, ?)");
        $stmt->bind_param("ss", $name, $icon);
        
        if ($stmt->execute()) {
            return true;
        } else {
            return false;
        }
    }

    public function readTechnologies()
    {
        $result = $this->conn->query("SELECT * FROM Technologies");

        if ($result->num_rows > 0) {
            $technologiesArray = array();

            while ($row = $result->fetch_assoc()) {
                $technologiesArray[] = $row;
            }

            return $technologiesArray;
        } else {
            return array();
        }
    }

    public function updateTechnology($id, $name, $icon)
    {
        $stmt = $this->conn->prepare("UPDATE Technologies SET name=?, icon=? WHERE id=?");
        $stmt->bind_param("ssi", $name, $icon, $id);
        
        if ($stmt->execute()) {
            return true;
        } else {
            return false;
        }
    }

    public function deleteTechnology($id)
    {
        $stmt = $this->conn->prepare("DELETE FROM Technologies WHERE id=?");
        $stmt->bind_param("i", $id);
        
        if ($stmt->execute()) {
            return true;
        } else {
            return false;
        }
    }
}

