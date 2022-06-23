<?php

class User
{
    private $userTable = 'user';
    private $conn;

    public function __construct($db)
    {
        $this->conn = $db;
    }

    public function login()
    {
        if ($this->email && $this->password) {
            $sqlQuery = "SELECT * FROM " . $this->userTable . " WHERE ds_email = ? AND ds_password = ?";
            $stmt = $this->conn->prepare($sqlQuery);
            $password = hash('sha256', $this->password);
            $stmt->bind_param('ss', $this->email, $password);
            $stmt->execute();
            $result = $stmt->get_result();
            //after verify if user exists in the db, function store its data to session
            if ($result->num_rows > 0) {
                $user = $result->fecth_assoc();
                $_SESSION['userid'] = $user['id_user'];
                $_SESSION['role'] = $user['ds_role'];
                $_SESSION['name'] = $user['ds_name'];
                return 1;
            } else {
                return 0;
            }
        } else {
            return 0;
        }
    }


    //function verifies if user is logged
    public function loggedIn()
    {
        if (!empty($_SESSION['userid'])) {
            return 1;
        } else {
            return 0;
        }
    }

    //function verifies if user is an admin
    public function isAdmin()
    {
        if (!empty($_SESSION['userid'] && $_SESSION['role'] == 'admin')) {
            return 1;
        } else {
            return 0;
        }
    }
}