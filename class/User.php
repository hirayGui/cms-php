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

        $stmtTotal = $this->conn->prepare($sqlQuery);
        $stmtTotal->execute();
        $allResult = $stmtTotal->get_result();
        $allRecords = $allResult->num_rows;

        $displayRecords = $result->num_rows;
        $records = array();
        $count = 1;
        while ($user = $result->fetch_assoc()) {
            $rows = array();
            $rows[] = $count;
            $rows[] = ucfirst($user['ds_name']);
            $rows[] = $user['ds_email'];
            $rows[] = ucfirst($user['ds_role']);
            $rows[] = ucfirst($user['ds_status']);
            $rows[] = '<button type="button" name="update" id"' . $user['id_user'] . '" class="btn btn-default update"><i class="bi bi-pencil-fill"></i>Editar</button>';
            $rows[] = '<button type="button" name="delete" id"' . $user['id_user'] . '" class="btn btn-default delete"><i class="bi bi-trash3"></i>Excluir</button>';
            $records[] = $rows;
            $count++;
        }

        $output = array(
            "draw" => intval($_POST['draw']),
            "iTotalRecords" => $displayRecords,
            "iTotalDisplayRecords" => $allRecords,
            "data" => $records
        );

        echo json_encode($output);
    }
}