<?php
session_start();
session_unset();
// session_destroy();
$_SESSION['success'] = array();
$_SESSION['error'] = array();

$_SESSION['success'][] = 'Successfuly logged out';
header('Location: ../index.php');
die();