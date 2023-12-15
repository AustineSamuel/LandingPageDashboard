<?php
class FooterOurServicesLinksInfo
{
    private $conn;

    public function __construct($conn)
    {
        $this->conn = $conn;
    }

    public function createFooterOurServicesLink($name, $link)
    {
        $stmt = $this->conn->prepare("INSERT INTO footerOurServicesLinks (name, link) VALUES (?, ?)");
        $stmt->bind_param("ss", $name, $link);

        if ($stmt->execute()) {
            return true;
        } else {
            return false;
        }
    }

    public function readFooterOurServicesLinks()
    {
        $result = $this->conn->query("SELECT * FROM footerOurServicesLinks");

        if ($result->num_rows > 0) {
            $footerOurServicesLinksArray = array();

            while ($row = $result->fetch_assoc()) {
                $footerOurServicesLinksArray[] = $row;
            }

            return $footerOurServicesLinksArray;
        } else {
            return array();
        }
    }

    public function updateFooterOurServicesLink($id, $name, $link)
    {
        $stmt = $this->conn->prepare("UPDATE footerOurServicesLinks SET name=?, link=? WHERE id=?");
        $stmt->bind_param("ssi", $name, $link, $id);

        if ($stmt->execute()) {
            return true;
        } else {
            return false;
        }
    }

    public function deleteFooterOurServicesLink($id)
    {
        $stmt = $this->conn->prepare("DELETE FROM footerOurServicesLinks WHERE id=?");
        $stmt->bind_param("i", $id);

        if ($stmt->execute()) {
            return true;
        } else {
            return false;
        }
    }
}
