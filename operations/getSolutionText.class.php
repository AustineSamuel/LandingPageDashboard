<?php

class GetSolutionTextInfo
{
    private $conn;

    public function __construct($conn)
    {
        $this->conn = $conn;
    }

    public function createGetSolutionText($heading, $text)
    {
        $stmt = $this->conn->prepare("INSERT INTO GetSolutionText (heading, text) VALUES (?, ?)");
        $stmt->bind_param("ss", $heading, $text);
        
        if ($stmt->execute()) {
            return true;
        } else {
            return false;
        }
    }

    public function readGetSolutionTexts()
    {
        $result = $this->conn->query("SELECT * FROM GetSolutionText");

        if ($result->num_rows > 0) {
            $getSolutionTextArray = array();

            while ($row = $result->fetch_assoc()) {
                $getSolutionTextArray[] = $row;
            }

            return $getSolutionTextArray;
        } else {
            return array();
        }
    }

    public function updateGetSolutionText($id, $heading, $text)
    {
        $stmt = $this->conn->prepare("UPDATE GetSolutionText SET heading=?, text=? WHERE id=?");
        $stmt->bind_param("ssi", $heading, $text, $id);
        
        if ($stmt->execute()) {
            return true;
        } else {
            return false;
        }
    }

    public function deleteGetSolutionText($id)
    {
        $stmt = $this->conn->prepare("DELETE FROM GetSolutionText WHERE id=?");
        $stmt->bind_param("i", $id);
        
        if ($stmt->execute()) {
            return true;
        } else {
            return false;
        }
    }
}
