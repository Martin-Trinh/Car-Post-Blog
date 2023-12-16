<?php
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
    $sql = "SELECT * FROM posts";
    $stmt = mysqli_stmt_init($conn);
    if(!mysqli_stmt_prepare($stmt, $sql)){
        header("location: " . '../sign-up.php?error=stmtfailed');
        die();
    }
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    mysqli_stmt_close($stmt);
}