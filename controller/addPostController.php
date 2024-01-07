<?php
session_start();
require_once '../config/db_config.php';
require_once('../model/PostRepository.php');
require_once('../model/Validation.php');

if (isset($_POST['submit'])) {
    $_POST['title-post'] = filter_var($_POST['title-post'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $_POST['article-body'] = filter_var($_POST['article-body'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $_POST['category'] = filter_var($_POST['category'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $thumbnail = $_FILES['thumbnail'];
    // validation   
    $validator = new Validation();
    if($validator->postValidate($_POST['title-post'], $_POST['article-body'], $_POST['category']) && 
    $validator->fileValidate($thumbnail)){
        // upload file
        $thumbnailName = uniqid() . filter_var($thumbnail['name'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        $thumbnailTmpName = filter_var($thumbnail['tmp_name'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        $thumbnailPath = '../img/' . $thumbnailName;
        if(move_uploaded_file($thumbnailTmpName, $thumbnailPath)){
            $postRepo = new PostRepository($conn);
            if(!$postRepo->addPost($_SESSION['user']['user_id'], $_POST['title-post'], $_POST['article-body'], $_POST['category'], $thumbnailName)){
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
    }else{
        $_SESSION['formData'] = $_POST;
        $_SESSION['errorMsg'] = $validator->getErrorMsg();
        header('Location: ../addPost.php');
        die();
    }
    
} else {
    header('Location: ../addPost.php');
    die();
}