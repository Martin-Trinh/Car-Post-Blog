<?php
// require '../config/db_config.php';

if(isset($_POST['submit'])){
    $username = filter_var($_POST['username'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $password = filter_var($_POST['password'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $confirmPassword = filter_var($_POST['confirm-password'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);

    // validation
    
}else{
    header('location: '. '../sign-up.php');
    die();
}