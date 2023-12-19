<?php
session_start();
require_once '../config/db_config.php';
require_once 'functions.php';

if(isset($_GET['id'])){
    $id = filter_var($_GET['id'], FILTER_SANITIZE_NUMBER_INT);

    // select post from db
    $post = selectPostById($conn, $id);
    if($post){
        // delete file in folder
        unlink('../img' . $post['thumbnail']);
    }else{
        header('location: ../test.php');
        die();
    }

    // delete post from db
    deletePostById($conn, $id);
}
header('location: ../index.php');
die();