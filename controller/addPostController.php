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
            $errorMsg['thumbnail'] = 'Invalid file extension';
        } else if ($thumbnail['size'] > 1_000_000) {
            $errorMsg['thumbnail'] = 'File to big';
        } else {
            // upload file
            $thumbnailName = time() . $thumbnail['name'];
            $thumbnailTmpName = $thumbnail['tmp_name'];
            $thumbnailPath = '../img/' . $thumbnailName;
            move_uploaded_file($thumbnailTmpName, $thumbnailPath);
            addPost($conn, $_SESSION['user']['user_id'], $title, $body, $category, $thumbnailName);
        }
    }
    if (isset($errorMsg)) {
        $_SESSION['formData'] = $_POST;
        $_SESSION['errorMsg'] = $errorMsg;
        header('location: ' . '../addPost.php');
        die();
    } else {
        header('location: ' . '../success.php');
        die();
    }
} else {
    header('location: ' . '../addPost.php');
    die();
}
