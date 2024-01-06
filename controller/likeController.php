<?php
session_start();
require_once ('../config/db_config.php');
require_once('../model/PostRepository.php');

if(!isset($_SESSION['user'])){
    $_SESSION['error'][] = "You must login to like post";
    header('Location: ../login.php');
    die();
}
$data = json_decode(file_get_contents('php://input'), true);
$postId = filter_var($data['post_id'], FILTER_SANITIZE_NUMBER_INT);

$postRepo = new PostRepository($conn);
$postRepo->incrementLike($postId);
$currLike = $postRepo->getLike($postId);
echo json_encode(array('likes' => $currLike));