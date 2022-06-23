<?php
session_start();

class Database
{
    private $host = '127.0.0.1';
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
}