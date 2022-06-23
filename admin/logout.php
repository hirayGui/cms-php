<?php 
session_start();
$_SESSION['userid'] = '';
$_SESSION['role'] = ''; 
$_SESSION['name'] = '';
session_destroy();

header("Location: index.php");