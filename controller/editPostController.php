<?php
session_start();
require_once '../config/db_config.php';
require_once('../model/PostRepository.php');
require_once('../model/Validation.php');


if (isset($_POST['submit'])) {
    $_POST['id'] = filter_var($_POST['id'], FILTER_SANITIZE_NUMBER_INT);
    $_POST['prev-thumbnail'] = filter_var($_POST['prev-thumbnail'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $_POST['title-post'] = filter_var($_POST['title-post'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $_POST['article-body'] = filter_var($_POST['article-body'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $_POST['category'] = filter_var($_POST['category'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $thumbnail = $_FILES['thumbnail'];
    $_POST['user-id'] = filter_var($_POST['user-id'], FILTER_SANITIZE_NUMBER_INT);
    // check if post belong to the user
    if($_POST['user-id'] != $_SESSION['user']['user_id']){
        $_SESSION['error'][] = 'Cannot edit this post';
        $_SESSION['error'][] = $_POST['user-id'] . " " . $_SESSION['user']['user_id'];
        header('Location: ../article.php?id='. $_POST['id']);
        die();
    }

    // validation   
    $validator = new Validation();
    if($validator->postValidate($_POST['title-post'], $_POST['article-body'], $_POST['category'])){
        // upload file
        if($thumbnail['name']){
            if($validator->fileValidate($thumbnail)){
                $thumbnailName = uniqid() . filter_var($thumbnail['name'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
                $thumbnailTmpName = filter_var($thumbnail['tmp_name'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
                $thumbnailPath = '../img/' . $thumbnailName;
                // move new file to folder
                if(move_uploaded_file($thumbnailTmpName, $thumbnailPath)){
                    // remove file from folder
                    if(!unlink('../img/' . $_POST['prev-thumbnail'])){
                        $_SESSION['error'][] = 'Cannot delete image from folder';
                        header('Location: ../editPost.php?id=' . $_POST['id']);
                        die();
                    }
                }else{
                    $_SESSION['error'][] = 'Cannot move image to folder';
                    header('Location: ../editPost.php?id=' . $_POST['id']);
                    die();
                }
            }else{
                $_SESSION['formData'] = $_POST;
                $_SESSION['errorMsg'] = $validator->getErrorMsg();
                header('Location: ' . '../editPost.php?id='. $_POST['id']);
                die();
            }
        }
        // update post in db
        $postRepo = new PostRepository($conn);
        if(!$postRepo->updatePostById($_POST['id'], $_POST['title-post'], $_POST['category'], $_POST['article-body'], $thumbnailName ?? $_POST['prev-thumbnail'])){
            $_SESSION['error'][] = 'Update post failed';
            header('Location: ' . '../editPost.php?id='. $_POST['id']);
            die();
        }
        $_SESSION['success'][] = 'Update post successfuly';
        header('Location: ' . '../article.php?id='. $_POST['id']);
        die();
    }else{
        
    }
} else {
    header('Location: ' . '../index.php');
    die();
}
