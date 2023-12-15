class WorkedInInfo
{
    private $conn;

    public function __construct($conn)
    {
        $this->conn = $conn;
    }

    public function createWorkedIn($name, $icon)
    {
        $stmt = $this->conn->prepare("INSERT INTO workedIn (name, icon) VALUES (?, ?)");
        $stmt->bind_param("ss", $name, $icon);

        if ($stmt->execute()) {
            return true;
        } else {
            return false;
        }
    }

    public function readWorkedIns()
    {
        $result = $this->conn->query("SELECT * FROM workedIn");

        if ($result->num_rows > 0) {
            $workedInArray = array();

            while ($row = $result->fetch_assoc()) {
                $workedInArray[] = $row;
            }

            return $workedInArray;
        } else {
            return array();
        }
    }

    public function updateWorkedIn($id, $name, $icon)
    {
        $stmt = $this->conn->prepare("UPDATE workedIn SET name=?, icon=? WHERE id=?");
        $stmt->bind_param("ssi", $name, $icon, $id);

        if ($stmt->execute()) {
            return true;
        } else {
            return false;
        }
    }

    public function deleteWorkedIn($id)
    {
        $stmt = $this->conn->prepare("DELETE FROM workedIn WHERE id=?");
        $stmt->bind_param("i", $id);

        if ($stmt->execute()) {
            return true;
        } else {
            return false;
        }
    }
}
