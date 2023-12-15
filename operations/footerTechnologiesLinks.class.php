<?php

class FooterTechnologiesLinksInfo
{
    private $conn;
    public function __construct($conn)
    {
        $this->conn = $conn;
    }

    public function createFooterTechnologiesLink($name, $link)
    {
        $stmt = $this->conn->prepare("INSERT INTO footerTechnologiesLinks (name, link) VALUES (?, ?)");
        $stmt->bind_param("ss", $name, $link);
        if ($stmt->execute()) {
            return true;
        } else {
            return false;
        }
    }

    public function readFooterTechnologiesLinks()
    {
        $result = $this->conn->query("SELECT * FROM footerTechnologiesLinks");

        if ($result->num_rows > 0) {
            $footerTechnologiesLinksArray = array();

            while ($row = $result->fetch_assoc()) {
                $footerTechnologiesLinksArray[] = $row;
            }

            return $footerTechnologiesLinksArray;
        } else {
            return array();
        }
    }

    public function updateFooterTechnologiesLink($id, $name, $link)
    {
        $stmt = $this->conn->prepare("UPDATE footerTechnologiesLinks SET name=?, link=? WHERE id=?");
        $stmt->bind_param("ssi", $name, $link, $id);

        if ($stmt->execute()) {
            return true;
        } else {
            return false;
        }
    }

    public function deleteFooterTechnologiesLink($id)
    {
        $stmt = $this->conn->prepare("DELETE FROM footerTechnologiesLinks WHERE id=?");
        $stmt->bind_param("i", $id);

        if ($stmt->execute()) {
            return true;
        } else {
            return false;
        }
    }
}
