<?php
session_start();
require_once '../config/db_config.php';
require_once('../model/PostRepository.php');
require_once('../model/Validation.php');
/**
 * This controller handle user's data from add post form.
 *  Validate data
 *  Add post to database and image to folder if data is valid
 *  Return data back to the page if data is invalid
 */
if (isset($_POST['submit'])) {
    // sanitize data from POST request
    $_POST['title-post'] = filter_var($_POST['title-post'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $_POST['article-body'] = filter_var($_POST['article-body'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $_POST['category'] = filter_var($_POST['category'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $thumbnail = $_FILES['thumbnail'];
    // validation data and file using Validation class  
    $validator = new Validation();
    if($validator->postValidate($_POST['title-post'], $_POST['article-body'], $_POST['category']) && 
    $validator->fileValidate($thumbnail)){
        // make a unique name for image
        $thumbnailName = uniqid() . filter_var($thumbnail['name'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        $thumbnailTmpName = filter_var($thumbnail['tmp_name'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        $thumbnailPath = '../img/' . $thumbnailName;
        // move file to folder
        if(move_uploaded_file($thumbnailTmpName, $thumbnailPath)){
            $postRepo = new PostRepository($conn);
            // add post to database
            if(!$postRepo->addPost($_SESSION['user']['user_id'], $_POST['title-post'], $_POST['article-body'], $_POST['category'], $thumbnailName)){
                $_SESSION['formData'] = $_POST;
                // return a error notification for user
                $_SESSION['error'][] = 'Add post to database failed';
                header('Location: ../addPost.php');
                die();
            }
            // return a success notification for user
            $_SESSION['success'][] = 'Your post has been successfuly added';
            header('Location: ../index.php');
            die();
        }else{
            // return data back to the user
            $_SESSION['formData'] = $_POST;
            $_SESSION['error'][] = 'Cannot move file to folder';
            header('Location: ../addPost.php');
            die();
        }
    }else{
        // return data back to the user
        $_SESSION['formData'] = $_POST;
        // return error messages to the user
        $_SESSION['errorMsg'] = $validator->getErrorMsg();
        header('Location: ../addPost.php');
        die();
    }
    
} else {
    // user did not submit the form
    header('Location: ../addPost.php');
    die();
}