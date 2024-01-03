<?php 
session_start();
require_once '../config/db_config.php';
require_once 'functions.php';


if(isset($_POST['submit'])){
    $username = filter_var($_POST['username'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $password = filter_var($_POST['password'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    // validation
    $errorMsg;
    if($username !== '' && $password !== ''){
        // find user in database
        $user = findUserByUsername($conn, $username);
        if($user === false){
            $_SESSION['error'] = 'Cannot find user';
        }else{
            if(password_verify($password, $user['PASSWORD'])){
                $_SESSION['success'][] = 'Log in successfuly';
                $_SESSION['user']['user_id'] = $user['user_id'];
                $_SESSION['user']['username'] = $user['username'];
                $_SESSION['user']['role'] = $user['role'];

            }else{
                $errorMsg['password'] = 'Incorrect password';
            }
        }
    }else{
        if(!$username){
            $errorMsg['username'] = 'Please enter username';
        }
        if(!$password){
            $errorMsg['password'] = 'Please enter password';
        }
    }
    if(isset($errorMsg)){
        $_SESSION['formData'] = $_POST;
        $_SESSION['errorMsg'] = $errorMsg;
        header('Location: '. '../login.php');
        die();
    }else{
        header('Location: '. '../index.php');
        die();
    }

}else{
    header('Location: '. '../login.php');
    die();
}
?>