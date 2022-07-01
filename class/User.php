<?php

class User
{
    private $userTable = 'tb_users';
    private $conn;

    public function __construct($db)
    {
        $this->conn = $db;
    }

    public function login()
    {
        if ($this->email && $this->password) {
            $sqlQuery = "SELECT id_user, ds_name, ds_email, ds_password, ds_role, ds_status FROM " . $this->userTable . " WHERE ds_email = ? AND ds_password = ?";
            $stmt = $this->conn->prepare($sqlQuery);
            $password = hash('sha256', $this->password);
            $stmt->bind_param('ss', $this->email, $password);
            $stmt->execute();
            $result = $stmt->get_result();
            //after verify if user exists in the db, function store its data to session
            if ($result->num_rows > 0) {
                $user = $result->fetch_assoc();
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

    //listing existing users
    public function listUsers()
    {
        $sqlQuery = 'SELECT id_user, ds_name, ds_email, ds_password, ds_role, ds_status FROM ' . $this->userTable . " ";

        if (!empty($_POST['search']['value'])) {
            $sqlQuery .= 'WHERE (id_user LIKE "%' . $_POST['search']['value'] . '%" ';
            $sqlQuery .= 'OR ds_name LIKE "%' . $_POST['search']['value'] . '%" ';
            $sqlQuery .= 'OR ds_email LIKE "%' . $_POST['search']['value'] . '%" ';
        }

        $stmt = $this->conn->prepare($sqlQuery);
        $stmt->execute();
        $result = $stmt->get_result();

        return $result;
    }

    public function listUsersNumber()
    {
        $sqlQuery = 'SELECT id_user, ds_name, ds_email, ds_password, ds_role, ds_status FROM ' . $this->userTable . " ";

        $stmt = $this->conn->prepare($sqlQuery);
        $stmt->execute();
        $result = $stmt->get_result();
        if (mysqli_num_rows($result)) {
            $usersCount = mysqli_num_rows($result);
        } else {
            $usersCount = 0;
        }
        return $usersCount;
    }

    public function listLastUsers()
    {
        $sqlQuery = "SELECT id_user, ds_name, ds_email, ds_password, ds_role, ds_status FROM " . $this->userTable . " ORDER BY id_user DESC LIMIT 3";

        $stmt = $this->conn->prepare($sqlQuery);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result;
    }

    public function insert()
    {
        if ($this->role && $this->email && $this->password && $_SESSION['userid']) {
            $stmt = $this->conn->prepare("
            INSERT INTO " . $this->userTable . "(`ds_name`, `ds_email`, `ds_password`, `ds_role`, `ds_status`) VALUES (?, ?, ?, ?, ?)");
            $this->role = htmlspecialchars(strip_tags($this->role));
            $this->email = htmlspecialchars(strip_tags($this->email));
            $this->name = htmlspecialchars(strip_tags($this->name));
            $this->status = htmlspecialchars(strip_tags($this->status));
            $this->password = hash('sha256', $this->password);
            $stmt->bind_param('sssss', $this->name, $this->email, $this->password, $this->role, $this->status);

            if ($stmt->execute()) {
                return true;
            }
        }
    }
}