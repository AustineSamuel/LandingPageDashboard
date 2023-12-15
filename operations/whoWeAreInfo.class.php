<?php
class WhoWeAreInfo
{
    private $conn;

    public function __construct($conn)
    {
        $this->conn = $conn;
    }

    public function createWhoWeAre($image, $heading, $message)
    {
        $stmt = $this->conn->prepare("INSERT INTO whoWeAre (image, heading, message) VALUES (?, ?, ?)");
        $stmt->bind_param("sss", $image, $heading, $message);

        if ($stmt->execute()) {
            return true;
        } else {
            return false;
        }
    }

    public function readWhoWeAre()
    {
        $result = $this->conn->query("SELECT * FROM whoWeAre");

        if ($result->num_rows > 0) {
            $whoWeAreArray = array();

            while ($row = $result->fetch_assoc()) {
                $whoWeAreArray[] = $row;
            }

            return $whoWeAreArray;
        } else {
            return array();
        }
    }

    public function updateWhoWeAre($id, $image, $heading, $message)
    {
        $stmt = $this->conn->prepare("UPDATE whoWeAre SET image=?, heading=?, message=? WHERE id=?");
        $stmt->bind_param("sssi", $image, $heading, $message, $id);

        if ($stmt->execute()) {
            return true;
        } else {
            return false;
        }
    }

    public function deleteWhoWeAre($id)
    {
        $stmt = $this->conn->prepare("DELETE FROM whoWeAre WHERE id=?");
        $stmt->bind_param("i", $id);

        if ($stmt->execute()) {
            return true;
        } else {
            return false;
        }
    }
}
