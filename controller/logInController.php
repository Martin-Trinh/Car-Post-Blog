<?php 
session_start();
// require '../config/db_config.php';
if(isset($_POST['submit'])){
    $username = filter_var($_POST['username'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $password = filter_var($_POST['password'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    // validation
    $errorMsg;
    if($username === ''){
        $errorMsg['username'] = 'Please enter username';
    }
    if($password === ''){
        $errorMsg['password'] = 'Please enter password';
    }
    if(isset($errorMsg['username']) && isset($errorMsg['password'])){
        // fetch user from database
    }
    if(isset($errorMsg)){
        $_SESSION['formData'] = $_POST;
        $_SESSION['errorMsg'] = $errorMsg;
        header('location: '. '../login.php');
        die();
    }else{
        header('location: '. '../success.php');
        die();
    }

}else{
    header('location: '. '../login.php');
    die();
}
?>