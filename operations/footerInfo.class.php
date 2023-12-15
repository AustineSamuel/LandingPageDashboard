<?php 

class FooterInfo
{
    private $conn;
    public function __construct($conn)
    {
        $this->conn = $conn;
    }
    public function createFooter($heading, $subHeading, $facebookLink, $twitterLink, $youtubeLink, $linkedInLink, $instagramLink)
    {
        $stmt = $this->conn->prepare("INSERT INTO footer (heading, subHeading, facebookLink, twitterLink, youtubeLink, linkedInLink, instagramLink) VALUES (?, ?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("sssssss", $heading, $subHeading, $facebookLink, $twitterLink, $youtubeLink, $linkedInLink, $instagramLink);

        if ($stmt->execute()) {
            return true;
        } else {
            return false;
        }
    }

    public function readFooter()
    {
        $result = $this->conn->query("SELECT * FROM footer");

        if ($result->num_rows > 0) {
            $footerArray = array();

            while ($row = $result->fetch_assoc()) {
                $footerArray[] = $row;
            }

            return $footerArray;
        } else {
            return array();
        }
    }

    public function updateFooter($id, $heading, $subHeading, $facebookLink, $twitterLink, $youtubeLink, $linkedInLink, $instagramLink)
    {
        $stmt = $this->conn->prepare("UPDATE footer SET heading=?, subHeading=?, facebookLink=?, twitterLink=?, youtubeLink=?, linkedInLink=?, instagramLink=? WHERE id=?");
        $stmt->bind_param("sssssssi", $heading, $subHeading, $facebookLink, $twitterLink, $youtubeLink, $linkedInLink, $instagramLink, $id);

        if ($stmt->execute()) {
            return true;
        } else {
            return false;
        }
    }

    public function deleteFooter($id)
    {
        $stmt = $this->conn->prepare("DELETE FROM footer WHERE id=?");
        $stmt->bind_param("i", $id);

        if ($stmt->execute()) {
            return true;
        } else {
            return false;
        }
    }
}
