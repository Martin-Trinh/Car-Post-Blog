<?php 
session_start();
require_once '../config/db_config.php';
require_once('../model/UserRepository.php');
require_once('../model/Validation.php');

if(isset($_POST['submit'])){
    $username = filter_var($_POST['username'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $password = filter_var($_POST['password'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $_POST['username'] = $username;
    // validation
    $_POST['password'] = $password;
    $errorMsg;
    $validation = new Validation();
    if($validation->usernameValidate($username) &&
        $validation->passwordValidate($password))
    {
        // find user in database
        $userRepo = new UserRepository($conn);
        $user = $userRepo->findUserByUsername($username);
        if(!$user){
            $errorMsg['username'] = 'Username does not exist';
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
        $errorMsg = $validation->getErrorMsg();
    }
    if(isset($errorMsg) && $errorMsg){
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