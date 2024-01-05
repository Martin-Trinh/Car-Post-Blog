<?php
session_start();
require_once '../config/db_config.php';
require_once 'functions.php';

if (isset($_POST['submit'])) {
    $title = filter_var($_POST['title-post'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $body = filter_var($_POST['article-body'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $category = filter_var($_POST['category'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $thumbnail = $_FILES['thumbnail'];
    // validation   
    $errorMsg;
    if ($title === '') {
        $errorMsg['title-post'] = 'Please enter title';
    }
    if ($body === '') {
        $errorMsg['article-body'] = 'Please add text to your post';
    }
    if ($category === '') {
        $errorMsg['category'] = 'Please select category';
    }
    if (!$thumbnail['name']) {
        $errorMsg['thumbnail'] = 'Please add image to your post';
    } else {
        $validFileExtensions = ['png', 'jpg', 'jpeg'];
        $extension = explode('.', $thumbnail['name']);
        $extension = strtolower($extension[1]);
        $_SESSION['file'] = $_FILES;
        if (!in_array($extension, $validFileExtensions)) {
            $errorMsg['thumbnail'] = 'Invalid file extension, only png, jpg and jpeg are allowed';
        }
        if ($thumbnail['size'] > 2_000_000) {
            $errorMsg['thumbnail'] = 'File size must be less than 2Mb';
        }
    }
    if (isset($errorMsg)) {
        $_SESSION['formData'] = $_POST;
        $_SESSION['errorMsg'] = $errorMsg;
        header('Location: ../addPost.php');
        die();
    } else {
        // upload file
        $thumbnailName = time() . filter_var($thumbnail['name'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        $thumbnailTmpName = filter_var($thumbnail['tmp_name'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        $thumbnailPath = '../img/' . $thumbnailName;
        if(move_uploaded_file($thumbnailTmpName, $thumbnailPath)){
            if(!addPost($conn, $_SESSION['user']['user_id'], $title, $body, $category, $thumbnailName)){
                $_SESSION['formData'] = $_POST;
                $_SESSION['error'][] = 'Add post to database failed';
                header('Location: ../addPost.php');
                die();
            }
            $_SESSION['success'][] = 'Your post has been successfuly added';
            header('Location: ../index.php');
            die();
        }else{
            $_SESSION['formData'] = $_POST;
            $_SESSION['error'][] = 'Cannot move file to folder';
            header('Location: ../addPost.php');
            die();
        }
    }
} else {
    header('Location: ../addPost.php');
    die();
}
