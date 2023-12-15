<?php

class ServicesWeProvideInfo
{
    private $conn;

    public function __construct($conn)
    {
        $this->conn = $conn;
    }

    public function createServicesWeProvide($heading, $subHeading)
    {
        $stmt = $this->conn->prepare("INSERT INTO ServicesWeProvide (heading, subHeading) VALUES (?, ?)");
        $stmt->bind_param("ss", $heading, $subHeading);
        
        if ($stmt->execute()) {
            return true;
        } else {
            return false;
        }
    }

    public function readServicesWeProvide()
    {
        $result = $this->conn->query("SELECT * FROM ServicesWeProvide");

        if ($result->num_rows > 0) {
            $servicesWeProvideArray = array();

            while ($row = $result->fetch_assoc()) {
                $servicesWeProvideArray[] = $row;
            }

            return $servicesWeProvideArray;
        } else {
            return array();
        }
    }

    public function updateServicesWeProvide($id, $heading, $subHeading)
    {
        $stmt = $this->conn->prepare("UPDATE ServicesWeProvide SET heading=?, subHeading=? WHERE id=?");
        $stmt->bind_param("ssi", $heading, $subHeading, $id);
        
        if ($stmt->execute()) {
            return true;
        } else {
            return false;
        }
    }

    public function deleteServicesWeProvide($id)
    {
        $stmt = $this->conn->prepare("DELETE FROM ServicesWeProvide WHERE id=?");
        $stmt->bind_param("i", $id);
        
        if ($stmt->execute()) {
            return true;
        } else {
            return false;
        }
    }
}
