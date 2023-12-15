<?php

class EditHeadingTextsInfo
{
    private $conn;

    public function __construct($conn)
    {
        $this->conn = $conn;
    }

    public function createEditHeadingTexts($h1, $playButtonLink, $subH1, $getStartedLink, $headingMessageText)
    {
        $stmt = $this->conn->prepare("INSERT INTO editHeadingTexts (h1, playButtonLink, subH1, getStartedLink, headingMessageText) VALUES (?, ?, ?, ?, ?)");
        $stmt->bind_param("sssss", $h1, $playButtonLink, $subH1, $getStartedLink, $headingMessageText);
        
        if ($stmt->execute()) {
            return true;
        } else {
            return false;
        }
    }

    public function readEditHeadingTexts()
    {
        $result = $this->conn->query("SELECT * FROM editHeadingTexts");

        if ($result->num_rows > 0) {
            $editHeadingTextsArray = array();

            while ($row = $result->fetch_assoc()) {
                $editHeadingTextsArray[] = $row;
            }

            return $editHeadingTextsArray;
        } else {
            return array();
        }
    }

    public function updateEditHeadingTexts($id, $h1, $playButtonLink, $subH1, $getStartedLink, $headingMessageText)
    {
        $stmt = $this->conn->prepare("UPDATE editHeadingTexts SET h1=?, playButtonLink=?, subH1=?, getStartedLink=?, headingMessageText=? WHERE id=?");
        $stmt->bind_param("sssssi", $h1, $playButtonLink, $subH1, $getStartedLink, $headingMessageText, $id);
        
        if ($stmt->execute()) {
            return true;
        } else {
            return false;
        }
    }

    public function deleteEditHeadingTexts($id)
    {
        $stmt = $this->conn->prepare("DELETE FROM editHeadingTexts WHERE id=?");
        $stmt->bind_param("i", $id);
        
        if ($stmt->execute()) {
            return true;
        } else {
            return false;
        }
    }
}

