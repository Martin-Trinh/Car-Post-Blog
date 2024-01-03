<?php
session_start();
require_once '../config/db_config.php';
require_once 'functions.php';

if(isset($_POST['submit'])){
    $username = filter_var($_POST['username'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $password = filter_var($_POST['password'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $confirmPassword = filter_var($_POST['confirm-password'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    // validation
    $errorMsg;
    if(!$username){
        $errorMsg['username'] = 'Please enter username';
    }
    if(!$password){
        $errorMsg['password'] = 'Please enter password';
    }
    if(!$confirmPassword){
        $errorMsg['confirmPass'] = 'Please enter confirm password';
        
    }
    if($confirmPassword !== $password){
        $errorMsg['password'] = "Password does not match";
        $errorMsg['confirmPass'] = "Password does not match";
    }
    if(findUserByUsername($conn, $username)){
        $errorMsg['username'] = 'Username already taken';
    }

    if(isset($errorMsg)){
        $_SESSION['formData'] = $_POST;
        $_SESSION['errorMsg'] = $errorMsg;
        header('Location: '. '../sign-up.php');
        die();
    }else{
        // createUser
        if(createUser($conn, $username, $password, 'admin')){
            $_SESSION['success'][] = 'Signed up successfully';
            header('Location: '. '../login.php');
            die();
        }
        $_SESSION['error'][] = 'Signed up failed';
        header('Location: '. '../sign-up.php');
        die();
    }
}else{
    header('Location: '. '../sign-up.php');
    die();
}