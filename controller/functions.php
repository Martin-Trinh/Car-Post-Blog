<?php
function findUserByUsername($conn, $username){
    $sql = "SELECT * FROM users where username = ?";
    $stmt = mysqli_stmt_init($conn);
    if(!mysqli_stmt_prepare($stmt, $sql)){
        mysqli_stmt_close($stmt);
        return false;
    }

    mysqli_stmt_bind_param($stmt, "s", $username);
    mysqli_stmt_execute($stmt);

    $result = mysqli_stmt_get_result($stmt);
    $row = mysqli_fetch_assoc($result);
    mysqli_stmt_close($stmt);
    return $row;
}

function createUser($conn, $username, $password, $role){
    $sql = "INSERT INTO users (username, password, role) VALUES (?, ?, ?)";
    $stmt = mysqli_stmt_init($conn);
    if(!mysqli_stmt_prepare($stmt, $sql)){
        mysqli_stmt_close($stmt);
        return false;
    }
    $hashedPwd = password_hash($password, PASSWORD_DEFAULT);
    mysqli_stmt_bind_param($stmt, "sss", $username, $hashedPwd, $role);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);
    return true;
}

function addPost($conn, $userId, $title, $body, $category, $thumbnail){
    $sql = "INSERT INTO posts (title, body, user_id, category, thumbnail) VALUES (?, ?, ?, ?, ?)";
    $stmt = mysqli_stmt_init($conn);
    if(!mysqli_stmt_prepare($stmt, $sql)){
        mysqli_stmt_close($stmt);
        return false;
    }
    mysqli_stmt_bind_param($stmt, "ssiss", $title, $body, $userId, $category, $thumbnail);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);
    return true;
}

function selectAllPosts($conn){
    $sql = "SELECT posts.post_id ,posts.title, posts.body, posts.category, posts.publish_datetime, posts.likes, posts.thumbnail,users.username 
    FROM posts JOIN users ON posts.user_id = users.user_id
    ORDER BY posts.publish_datetime DESC";
    $data = array();
    $stmt = mysqli_stmt_init($conn);
    if(!mysqli_stmt_prepare($stmt, $sql)){
        mysqli_stmt_close($stmt);
        return false;
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
    LIMIT ?";
    $data = array();
    $stmt = mysqli_stmt_init($conn);
    if(!mysqli_stmt_prepare($stmt, $sql)){
        mysqli_stmt_close($stmt);
        return false;
    }
    mysqli_stmt_bind_param($stmt, 'i', $numRow);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    while($row = mysqli_fetch_assoc($result)){
        $data[] = $row;
    }
    mysqli_stmt_close($stmt);
    return $data;
}

function selectPostById($conn, $id){
    $sql = "SELECT posts.post_id, posts.title, posts.body, posts.category, posts.publish_datetime, posts.likes, posts.thumbnail, users.username, users.user_id
    FROM posts JOIN users ON posts.user_id = users.user_id 
    WHERE posts.post_id = ?";
    $data = array();
    $stmt = mysqli_stmt_init($conn);
    if(!mysqli_stmt_prepare($stmt, $sql)){
        mysqli_stmt_close($stmt);
        return false;
    }
    mysqli_stmt_bind_param($stmt, 'i', $id);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    $data = mysqli_fetch_assoc($result);
    mysqli_stmt_close($stmt);
    return $data;
}

function updatePostById($conn, $id, $title, $category, $body, $thumbnail){
    $sql = "UPDATE posts SET posts.title=?, posts.body=?, posts.category=?, posts.thumbnail=?
    WHERE posts.post_id=?";

    $stmt = mysqli_stmt_init($conn);
    if(!mysqli_stmt_prepare($stmt, $sql)){
        mysqli_stmt_close($stmt);
        return false;
    }
    mysqli_stmt_bind_param($stmt, 'ssssi', $title, $body, $category, $thumbnail, $id);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);
    return true;
}

function deletePostById($conn, $id){
    $sql = "DELETE FROM posts WHERE posts.post_id=?";

    $stmt = mysqli_stmt_init($conn);
    if(!mysqli_stmt_prepare($stmt, $sql)){
        mysqli_stmt_close($stmt);
        return false;
    }
    mysqli_stmt_bind_param($stmt, 'i', $id);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);
    return true;
}

function countAllPosts($conn){
    $sql = "SELECT COUNT(*) as count FROM posts";
    $stmt = mysqli_stmt_init($conn);
    if(!mysqli_stmt_prepare($stmt, $sql)){
        mysqli_stmt_close($stmt);
        return null;
    }
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    $data = mysqli_fetch_assoc($result);
    mysqli_stmt_close($stmt);
    return $data['count'];
}

function selectPostsPagination($conn, $limit, $offset){
    $sql = "SELECT posts.post_id ,posts.title, posts.body, posts.category, posts.publish_datetime, posts.likes, posts.thumbnail, users.username 
    FROM posts JOIN users ON posts.user_id = users.user_id 
    ORDER BY posts.publish_datetime DESC
    LIMIT ? 
    OFFSET ?";
    $stmt = mysqli_stmt_init($conn);
    if(!mysqli_stmt_prepare($stmt, $sql)){
        mysqli_stmt_close($stmt);
        return null;
    }
    mysqli_stmt_bind_param($stmt, 'ii', $limit, $offset);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    while($row = mysqli_fetch_assoc($result)){
        $data[] = $row;
    }
    mysqli_stmt_close($stmt);
    return $data;
}