<?php 
class ReadMoreInfo
{
    private $conn;

    public function __construct($conn)
    {
        $this->conn = $conn;
    }

    public function createReadMore($title, $text, $trustpilotReviewLink, $clutchReviewLink, $appStoreReviewLink)
    {
        $stmt = $this->conn->prepare("INSERT INTO readMore (title, text, TrustpilotReviewLink, ClutchReviewLink, appStoreReviewLink) VALUES (?, ?, ?, ?, ?)");
        $stmt->bind_param("sssss", $title, $text, $trustpilotReviewLink, $clutchReviewLink, $appStoreReviewLink);

        if ($stmt->execute()) {
            return true;
        } else {
            return false;
        }
    }

    public function readReadMore()
    {
        $result = $this->conn->query("SELECT * FROM readMore");

        if ($result->num_rows > 0) {
            $readMoreArray = array();

            while ($row = $result->fetch_assoc()) {
                $readMoreArray[] = $row;
            }

            return $readMoreArray;
        } else {
            return array();
        }
    }

    public function updateReadMore($id, $title, $text, $trustpilotReviewLink, $clutchReviewLink, $appStoreReviewLink)
    {
        $stmt = $this->conn->prepare("UPDATE readMore SET title=?, text=?, TrustpilotReviewLink=?, ClutchReviewLink=?, appStoreReviewLink=? WHERE id=?");
        $stmt->bind_param("sssssi", $title, $text, $trustpilotReviewLink, $clutchReviewLink, $appStoreReviewLink, $id);

        if ($stmt->execute()) {
            return true;
        } else {
            return false;
        }
    }

    public function deleteReadMore($id)
    {
        $stmt = $this->conn->prepare("DELETE FROM readMore WHERE id=?");
        $stmt->bind_param("i", $id);

        if ($stmt->execute()) {
            return true;
        } else {
            return false;
        }
    }
}
