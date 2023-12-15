<?
class FooterCompanyLinksInfo
{
    private $conn;

    public function __construct($conn)
    {
        $this->conn = $conn;
    }

    public function createFooterCompanyLink($name, $link)
    {
        $stmt = $this->conn->prepare("INSERT INTO footerCompanyLinks (name, link) VALUES (?, ?)");
        $stmt->bind_param("ss", $name, $link);

        if ($stmt->execute()) {
            return true;
        } else {
            return false;
        }
    }

    public function readFooterCompanyLinks()
    {
        $result = $this->conn->query("SELECT * FROM footerCompanyLinks");

        if ($result->num_rows > 0) {
            $footerCompanyLinksArray = array();

            while ($row = $result->fetch_assoc()) {
                $footerCompanyLinksArray[] = $row;
            }

            return $footerCompanyLinksArray;
        } else {
            return array();
        }
    }

    public function updateFooterCompanyLink($id, $name, $link)
    {
        $stmt = $this->conn->prepare("UPDATE footerCompanyLinks SET name=?, link=? WHERE id=?");
        $stmt->bind_param("ssi", $name, $link, $id);

        if ($stmt->execute()) {
            return true;
        } else {
            return false;
        }
    }

    public function deleteFooterCompanyLink($id)
    {
        $stmt = $this->conn->prepare("DELETE FROM footerCompanyLinks WHERE id=?");
        $stmt->bind_param("i", $id);

        if ($stmt->execute()) {
            return true;
        } else {
            return false;
        }
    }
}
