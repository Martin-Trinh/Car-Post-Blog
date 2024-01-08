<?php
/**
 * This controller handle logic for logout
 * Unset the session and redirect user back to homepage
 */
session_start();
session_unset();
// init notification variables again
$_SESSION['success'] = array();
$_SESSION['error'] = array();

$_SESSION['success'][] = 'Successfuly logged out';
header('Location: ../index.php');
die();