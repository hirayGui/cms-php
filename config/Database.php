<?php
session_start();

class Database
{
    private $host = 'localhost';
    private $user = 'root';
    private $password = 'root';
    private $database = 'cms_teste';

    public function getConnection()
    {
        $conn = new mysqli($this->host, $this->user, $this->password, $this->database);

        if ($conn->connect_error) {
            die('Error: ' . $conn->connect_error);
        } else {
            return $conn;
        }
    }

    public function freeSpace()
    {
        $conn = new mysqli($this->host, $this->user, $this->password, $this->database);
        $totalSpace = 140.00000000;
        $sqlQuery = "SELECT table_schema AS name, SUM((data_length+index_length)/1024/1024) AS used_space FROM information_schema.tables WHERE table_schema = 'cms_teste' GROUP BY 1;";
        $stmt = $conn->prepare($sqlQuery);
        $stmt->execute();
        $result = $stmt->get_result();

        if (mysqli_num_rows($result)) {
            $row = mysqli_fetch_assoc($result);
            $finalResult = 100 - (($row['used_space'] * 100) / $totalSpace);
            return $finalResult;
        }
    }
}