<?php
session_start();
require_once '../config/db_config.php';
require_once '../model/Validation.php';
require_once '../model/UserRepository.php';


if(isset($_POST['submit'])){
    // sanitize data
    $username = filter_var($_POST['username'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $password = filter_var($_POST['password'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $confirmPassword = filter_var($_POST['confirm-password'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $errorMsg;
    // validation
    $validator = new Validation();
    $validator->usernameValidate($username);
    if($validator->passwordValidate($password) && 
        $validator->confirmPasswordValidate($confirmPassword))
    {
        $validator->twoPasswordValidate($password, $confirmPassword);
    }
    $errorMsg = $validator->getErrorMsg();
    $userRepo = new UserRepository($this->conn);
    if($userRepo->findUserByUsername($username)){
        $errorMsg['username'] = 'Username already taken';
        return false;
    }

    if(isset($errorMsg) && $errorMsg){
        $_SESSION['formData'] = $_POST;
        $_SESSION['errorMsg'] = $validator->$errorMsg;
        header('Location: '. '../sign-up.php');
        die();
    }else{
        // createUser
        $userRepo = new UserRepository($conn);
        if($userRepo->createUser($username, $password, 'admin')){
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