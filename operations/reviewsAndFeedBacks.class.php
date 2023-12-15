<?php 
class ReviewsAndFeedbacksInfo
{
    private $conn;

    public function __construct($conn)
    {
        $this->conn = $conn;
    }

    public function createReviewAndFeedback($name, $image, $occupation, $review, $platform, $stars)
    {
        $stmt = $this->conn->prepare("INSERT INTO reviewsAndFeedBacks (name, image, occupation, review, platform, stars) VALUES (?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("ssssss", $name, $image, $occupation, $review, $platform, $stars);

        if ($stmt->execute()) {
            return true;
        } else {
            return false;
        }
    }

    public function readReviewsAndFeedbacks()
    {
        $result = $this->conn->query("SELECT * FROM reviewsAndFeedBacks");

        if ($result->num_rows > 0) {
            $reviewsAndFeedbacksArray = array();

            while ($row = $result->fetch_assoc()) {
                $reviewsAndFeedbacksArray[] = $row;
            }

            return $reviewsAndFeedbacksArray;
        } else {
            return array();
        }
    }

    public function updateReviewAndFeedback($id, $name, $image, $occupation, $review, $platform, $stars)
    {
        $stmt = $this->conn->prepare("UPDATE reviewsAndFeedBacks SET name=?, image=?, occupation=?, review=?, platform=?, stars=? WHERE id=?");
        $stmt->bind_param("ssssssi", $name, $image, $occupation, $review, $platform, $stars, $id);

        if ($stmt->execute()) {
            return true;
        } else {
            return false;
        }
    }

    public function deleteReviewAndFeedback($id)
    {
        $stmt = $this->conn->prepare("DELETE FROM reviewsAndFeedBacks WHERE id=?");
        $stmt->bind_param("i", $id);

        if ($stmt->execute()) {
            return true;
        } else {
            return false;
        }
    }
}
