<?php
session_start();
require_once '../config/db_config.php';
require_once 'functions.php';


if (isset($_POST['submit'])) {
    $id = filter_var($_POST['id'], FILTER_SANITIZE_NUMBER_INT);
    $prev_thumbnail = filter_var($_POST['prev-thumbnail'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $title = filter_var($_POST['title-post'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $body = filter_var($_POST['article-body'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $category = filter_var($_POST['category'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $thumbnail = $_FILES['thumbnail'];
    $userId = filter_var($_POST['user-id'], FILTER_SANITIZE_NUMBER_INT);

    // check if post belong to the user
    if($userId != $_SESSION['user']['user_id']){
        $_SESSION['error'][] = 'Cannot edit this post';
        $_SESSION['error'][] = $userId . " " . $_SESSION['user']['user_id'];
        header('Location: ../article.php?id='. $id);
        die();
    }

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
            $thumbnailName = time() . filter_var($thumbnail['name'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            $thumbnailTmpName = filter_var($thumbnail['tmp_name'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            $thumbnailPath = '../img/' . $thumbnailName;
            // move new file to folder
            if(move_uploaded_file($thumbnailTmpName, $thumbnailPath)){
                // remove file from folder
                if(!unlink('../img/' . $prev_thumbnail)){
                    $_SESSION['error'][] = 'Cannot delete image from folder';
                    header('Location: ../editPost.php?id=' . $id);
                    die();
                }
            }else{
                $_SESSION['error'][] = 'Cannot move image to folder';
                header('Location: ../editPost.php?id=' . $id);
                die();
            }
        }
    }
    // check if any error occurred
    if (isset($errorMsg)) {
        $_SESSION['formData'] = $_POST;
        $_SESSION['errorMsg'] = $errorMsg;
        header('Location: ' . '../editPost.php?id='. $id);
        die();
    }else{
        // update post in db
        if(!updatePostById($conn, $id, $title, $category, $body, $thumbnailName ?? $prev_thumbnail)){
            $_SESSION['error'][] = 'Update post failed';
            header('Location: ' . '../editPost.php?id='. $id);
            die();
        }
        $_SESSION['success'][] = 'Update post successfuly';
        header('Location: ' . '../article.php?id='. $id);
        die();
}
} else {
    header('Location: ' . '../index.php');
    die();
}
