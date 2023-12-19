<?php
session_start();
require_once '../config/db_config.php';
require_once 'functions.php';

if (isset($_POST['submit'])) {
    $id =filter_var($_POST['id'], FILTER_SANITIZE_NUMBER_INT);
    $prev_thumbnail = filter_var($_POST['prev-thumbnail'], FILTER_SANITIZE_SPECIAL_CHARS);
    $title = filter_var($_POST['title-post'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $body = filter_var($_POST['article-body'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $category = filter_var($_POST['category'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $thumbnail = $_FILES['thumbnail'];
    // validation   
    $errorMsg;
    $thumbnailName;
    if (!$title) {
        $errorMsg['title-post'] = 'Please enter title';
    }
    if (!$body) {
        $errorMsg['article-body'] = 'Please add text to your post';
    }
    if (!$category) {
        $errorMsg['category'] = 'Please select category';
    }
    if ($thumbnail['name'] && !isset($errorMsg)) {
        $validFileExtensions = ['png', 'jpg', 'jpeg'];
        $extension = explode('.', $thumbnail['name']);
        $extension = strtolower($extension[1]);
        $_SESSION['file'] = $_FILES;
        if (!in_array($extension, $validFileExtensions)) {
            $errorMsg['thumbnail'] = 'Invalid file extension';
        } else if ($thumbnail['size'] > 2_000_000) {
            $errorMsg['thumbnail'] = 'File to big';
        }else{
            // upload file
            $thumbnailName = time() . $thumbnail['name'];
            $thumbnailTmpName = $thumbnail['tmp_name'];
            $thumbnailPath = '../img/' . $thumbnailName;
            // remove file from folder
            unlink('../img/' . $prev_thumbnail);
            // move new file to folder
            move_uploaded_file($thumbnailTmpName, $thumbnailPath);
        }
    }
    // check if any error occurred
    if (isset($errorMsg)) {
        $_SESSION['formData'] = $_POST;
        $_SESSION['errorMsg'] = $errorMsg;
        header('location: ' . '../editPost.php');
        die();
    } else {
        // update post in db
        updatePostById($conn, $id, $title, $category, $body, $thumbnailName ?? $prev_thumbnail);
        header('location: ' . '../success.php');
        die();
    }
} else {
    header('location: ' . '../index.php');
    die();
}
