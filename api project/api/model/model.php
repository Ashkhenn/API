<?php
class Import {
    private $conn;

    public function __construct() {
        $this->conn = mysqli_connect("localhost", "root", "", "api");
        if (!$this->conn) {
            die("Ошибка подключения: " . mysqli_connect_error());
        }
    }

    public function importUser($name, $last_name, $email, $age) {
        $name = mysqli_real_escape_string($this->conn, $name);
        $last_name = mysqli_real_escape_string($this->conn, $last_name);
        $email = mysqli_real_escape_string($this->conn, $email);
    
        $query = "INSERT INTO users (first_name, last_name, email, age) VALUES ('$name', '$last_name', '$email', '$age')";
        $res = mysqli_query($this->conn, $query);
    }

    public function countRecords($tableName) {
        $query = "SELECT COUNT(*) as count FROM $tableName";
        $result = $this->conn->query($query);

        if ($result) {
            $row = $result->fetch_assoc();
            $count = $row['count'];
            return $count;
        } else {
            return 0;
        }
    }

    public function closeConnection() {
        mysqli_close($this->conn);
    }
}

$import = new Import();
?>
