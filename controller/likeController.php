<?php
session_start();
require_once ('../config/db_config.php');
require_once('../model/PostRepository.php');
/**
 * This controller handle Like button logic 
 * Increment number of like of the post in database
 */
// read id from POST request
$data = json_decode(file_get_contents('php://input'), true);
$postId = filter_var($data['post_id'], FILTER_SANITIZE_NUMBER_INT);

// increment number of like in database
$postRepo = new PostRepository($conn);
$postRepo->incrementLike($postId);
// get the number of like after increment
$currLike = $postRepo->getLike($postId);
// return current number of like to the user
echo json_encode(array('likes' => $currLike));