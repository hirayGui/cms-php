<?php
include_once '../../config/Database.php';
include_once '../../class/User.php';

$database = new Database();
$db = $database->getConnection();

$user = new User($db);

//verifying if user is logged in
if (!$user->loggedIn()) {
    header('Location: ../index.php');
}

if (!$user->isAdmin()) {
    header('Location: index.php?error=Você não tem permissão para realizar esta ação!');
}

if (isset($_GET['id'])) {
    if (!empty($_GET['id'])) {
        $user->id = $_GET['id'];

        if ($user->delete()) {
            header('Location: index.php?success=Usuário deletado com sucesso!');
        } else {
            header('Location: index.php?error=Ocorreu um erro!');
        }
    }
} else {
    header('Location: index.php?error=Ocorreu um erro!');
}