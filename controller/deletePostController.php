<?php
session_start();
require_once '../config/db_config.php';
require_once('../model/PostRepository.php');


if(!isset($_SESSION['user'])){
    $_SESSION['error'][] = 'Please log in to delete post';
    header('Location: ../login.php');
    die();
}

if(isset($_GET['id'])){
    $id = filter_var($_GET['id'], FILTER_SANITIZE_NUMBER_INT);
    // select post from db
    $postRepo = new PostRepository($conn);
    $post =$postRepo->selectPostById($id);
    if(isset($post)){
        // check if post belong to the user
        if($post['user_id'] !== $_SESSION['user']['user_id']){
            $_SESSION['error'][] = 'Cannot delete this post';
            header('Location: ../article.php?id'. $id);
            die();
        }
        // delete file in folder & delete post from db
        $filePath = '../img/' . $post['thumbnail'];
        if(file_exists($filePath)){
            unlink($filePath);
        }
        if($postRepo->deletePostById($id)){
            $_SESSION['success'][] = 'Succesfully deleted post';
            header('Location: ../index.php');
            die();
        }else{
            $_SESSION['error'][] = 'Cannot delete post';
            header('Location: ../article.php?id='. $id);
            die();
        }
    }else{
        $_SESSION['error'][] = 'Cannot find post';
        header('Location: ../article.php?id=' . $id);
        die();
    }
    
}
$_SESSION['error'][] = 'ID not specified';
header('Location: ../index.php');
die();