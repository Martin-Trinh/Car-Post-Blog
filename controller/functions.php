<?php
// require_once '../config/db_config.php';


function usernameFind($conn, $username){
    $sql = "SELECT * FROM users where username = ?";
    $stmt = mysqli_stmt_init($conn);
    if(!mysqli_stmt_prepare($stmt, $sql)){
        header("location: " . '../sign-up.php?error=stmtfailed');
        die();
    }
    mysqli_stmt_bind_param($stmt, "s", $username);
    mysqli_stmt_execute($stmt);

    $result = mysqli_stmt_get_result($stmt);
    if($row = mysqli_fetch_assoc($result)){
        return $row;
    }else{
        return false;
    }
    mysqli_stmt_close($stmt);
}

function createUser($conn, $username, $password, $role){
    $sql = "INSERT INTO users (username, password, role) VALUES (?, ?, ?)";
    $stmt = mysqli_stmt_init($conn);
    if(!mysqli_stmt_prepare($stmt, $sql)){
        header("location: " . '../sign-up.php?error=stmtfailed');
        die();
    }
    $hashedPwd = password_hash($password, PASSWORD_DEFAULT);
    mysqli_stmt_bind_param($stmt, "sss", $username, $hashedPwd, $role);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);
}

function addPost($conn, $userId, $title, $body, $category, $thumbnail){
    $sql = "INSERT INTO posts (title, body, user_id, category, thumbnail) VALUES (?, ?, ?, ?, ?)";
    $stmt = mysqli_stmt_init($conn);
    if(!mysqli_stmt_prepare($stmt, $sql)){
        header("location: " . '../sign-up.php?error=stmtfailed');
        die();
    }
    mysqli_stmt_bind_param($stmt, "ssiss", $title, $body, $userId, $category, $thumbnail);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);
}

function selectAllPosts($conn){
    $sql = "SELECT posts.post_id ,posts.title, posts.body, posts.category, posts.publish_datetime, posts.likes, posts.thumbnail,users.username 
    FROM posts JOIN users ON posts.user_id = users.user_id
    ORDER BY posts.publish_datetime DESC";
    $stmt = mysqli_stmt_init($conn);
    if(!mysqli_stmt_prepare($stmt, $sql)){
        header("location: " . '../sign-up.php?error=stmtfailed');
        die();
    }
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    while($row = mysqli_fetch_assoc($result)){
        $data[] = $row;
    }
    mysqli_stmt_close($stmt);
    return $data;
}

function selectTrendingPosts($conn, $numRow){
    $sql = "SELECT posts.post_id, posts.title, posts.body, posts.category, posts.publish_datetime, posts.likes, posts.thumbnail,users.username 
    FROM posts JOIN users ON posts.user_id = users.user_id
    ORDER BY posts.publish_datetime DESC
    LIMIT {$numRow}";

    $stmt = mysqli_stmt_init($conn);
    if(!mysqli_stmt_prepare($stmt, $sql)){
        header("location: " . '../sign-up.php?error=stmtfailed');
        die();
    }
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    while($row = mysqli_fetch_assoc($result)){
        $data[] = $row;
    }
    mysqli_stmt_close($stmt);
    return $data;
}

function selectPostById($conn, $id){
    $sql = "SELECT posts.post_id, posts.title, posts.body, posts.category, posts.publish_datetime, posts.likes, posts.thumbnail,users.username 
    FROM posts JOIN users ON posts.user_id = users.user_id 
    WHERE posts.post_id = {$id}";

    $stmt = mysqli_stmt_init($conn);
    if(!mysqli_stmt_prepare($stmt, $sql)){
        header("location: " . '../sign-up.php?error=stmtfailed');
        die();
    }
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    $data = mysqli_fetch_assoc($result);
    mysqli_stmt_close($stmt);
    return $data;
}