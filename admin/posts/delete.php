<?php
include_once '../../config/Database.php';
include_once '../../class/User.php';
include_once '../../class/Post.php';

$database = new Database();
$db = $database->getConnection();

$user = new User($db);
$post = new Post($db);

//verifying if user is logged in
if (!$user->loggedIn()) {
    header('Location: ../index.php');
}

if (!$user->isAdmin()) {
    header('Location: index.php?error=Você não tem permissão para realizar esta ação!');
}

if (isset($_GET['id'])) {
    if (!empty($_GET['id'])) {
        $post->id = $_GET['id'];

        if ($post->delete()) {
            header('Location: index.php?success=Post deletado com sucesso!');
        } else {
            header('Location: index.php?error=Ocorreu um erro ao tentar deletar post!');
        }
    }
} else {
    header('Location: index.php?error=Ocorreu um erro ao selecionar post!');
}