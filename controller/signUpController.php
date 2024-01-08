<?php
session_start();
require_once '../config/db_config.php';
require_once '../model/Validation.php';
require_once '../model/UserRepository.php';
/**
 * This controller handle sign up logic for user
 * Create user in database if data is valid
 * Return data back if data is invalid
 */

if(isset($_POST['submit'])){
    // sanitize data
    $username = filter_var($_POST['username'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $password = filter_var($_POST['password'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $confirmPassword = filter_var($_POST['confirm-password'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $_POST['username'] = $username;
    $_POST['password'] = $password;
    $_POST['confirm-password'] = $confirmPassword;
    $errorMsg;
    // validation
    $validator = new Validation();
    $validator->usernameValidate($username);
    // validate if confirm password match password
    if($validator->passwordValidate($password) && 
        $validator->confirmPasswordValidate($password, $confirmPassword))
    {
        // check if username exists in database
        $userRepo = new UserRepository($conn);
        if($userRepo->findUserByUsername($username))
            $errorMsg['username'] = 'Username already taken';
    }else{
        $errorMsg = $validator->getErrorMsg();
    }

    if(isset($errorMsg)){
        $_SESSION['formData'] = $_POST;
        $_SESSION['errorMsg'] = $errorMsg;
        header('Location: '. '../sign-up.php');
        die();
    }else{
        // createUser in databse
        $userRepo = new UserRepository($conn);
        if($userRepo->createUser($username, $password, 'user')){
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