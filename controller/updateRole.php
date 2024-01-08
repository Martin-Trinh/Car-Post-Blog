<?php
session_start();
require_once ('../config/db_config.php');
require_once('../model/UserRepository.php');
/**
 * This controller handle update role logic for admin
 */
// check if user is admin
if(!isset($_SESSION['user']) || $_SESSION['user']['role'] !== 'admin' ){
    $_SESSION['error'][] = "You don't have access to manage user!";
    header('Location: ../index.php');
    die();
}
// check parameter in GET request
if(isset($_GET['role']) || isset($_GET['username'])){
    // data sanitize
    $role = filter_var($_GET['role'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $username = filter_var($_GET['username'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    // check if role is valid
    if($role !== 'admin' && $role !== 'user'){
        $_SESSION['error'][] = 'Role does not exists';
        header('Location: ../manageUser.php');
        die();       
    }
    // update role in database
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