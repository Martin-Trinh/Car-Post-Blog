<?php 
session_start();
// require '../config/db_config.php';
if(isset($_POST['submit'])){
    $title = filter_var($_POST['title-post'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $body = filter_var($_POST['article-body'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $category = filter_var($_POST['category'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $thumbnail = $_FILES['thumbnail'];
    // validation
    $errorMsg;
    if($title === ''){
        $errorMsg['title'] = 'Please enter title';
    }
    if($body === ''){
        $errorMsg['password'] = 'Please add text to your post';
    }
    if($category === ''){
        $errorMsg['category'] = 'Please select category';
    }
    if(!$thumbnail['name']){
        $errorMsg['thumbnail'] = 'Please add image to your post';
    }else{
        $validFileExtensions = ['png', 'jpg', 'jpeg'];
        $extension = explode('.', $thumbnail['name']);
        $extension = $extension[1];
        if(in_array($extension, $validFileExtensions)){
            $errorMsg['thumbnail'] = 'Invalid file extension';
        }else if($thumbnail['size'] < 1_000_000){
            $errorMsg['thumbnail'] = 'File to big';
        }else{
            // upload file
            $thumbnailName = time() . $thumbnail['name'];
            $thumbnailTmpName = $thumbnail['tmp_name'];
            $thumbnailPath = 'images/' . $thumbnailName;
            move_uploaded_file($thumbnailTmpName, $thumbnailPath);
        }
    }
    if(isset($errorMsg)){
        $_SESSION['formData'] = $_POST;
        $_SESSION['errorMsg'] = $errorMsg;
        header('location: '. 'addPost.php');
        die();
    }else{
        header('location: '. 'index.php');
        die();
    }

}else{
    header('location: '. 'addPost.php');
    die();
}
?>