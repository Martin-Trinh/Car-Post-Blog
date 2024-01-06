<?php
session_start();
require_once ('../config/db_config.php');
require_once('../model/UserRepository.php');

if(!isset($_SESSION['user']) || $_SESSION['user']['role'] !== 'admin' ){
    $_SESSION['error'][] = "You don't have access to manage user!";
    header('Location: ../index.php');
    die();
}
if(isset($_GET['role']) || isset($_GET['username'])){
    $role = filter_var($_GET['role'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $username = filter_var($_GET['username'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);

    if($role !== 'admin' && $role !== 'user'){
        $_SESSION['error'][] = 'Role does not exists';
        header('Location: ../manageUser.php');
        die();       
    }

    $userRepo = new UserRepository($conn);
    $userRepo->updateRoleByUsername($username, $role);
    $_SESSION['success'][] = 'Update role succesfully';
    header('Location: ../manageUser.php');
    die();       

}else{
    $_SESSION['error'][] = 'Bad parameter!';
    header('Location: ../index.php');
    die();       
}