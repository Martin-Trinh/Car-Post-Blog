<?php
require_once '../config/db_config.php';
require_once 'functions.php';
session_start();

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
    if(isset($errorMsg)){
        $_SESSION['formData'] = $_POST;
        $_SESSION['errorMsg'] = $errorMsg;
        header('Location: '. '../sign-up.php');
        die();
    }else{
        
        // createUser
        if(!usernameFind($conn, $username)){
            createUser($conn, $username, $password, 'admin');
            $_SESSION['successMsg'] = 'Signed up successfully';
            header('Location: '. '../login.php');
            die();
        }
        else{
            $_SESSION['errorMsg']['logicError'] = 'Username already taken';
            header('Location: ../sign-up.php');
            die();
        }
    }
}else{
    header('Location: '. '../sign-up.php');
    die();
}