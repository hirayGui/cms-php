<?php
session_start();
$_SESSION['userid'] = '';
$_SESSION['role'] = '';
$_SESSION['name'] = '';
$_SESSION['status'] = '';
session_destroy();

header("Location: index.php");