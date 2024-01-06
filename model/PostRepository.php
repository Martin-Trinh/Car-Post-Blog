<?php
class PostRepository{
    private $conn;

    public function __construct($conn)
    {
        $this->conn = $conn;
    }

    public function addPost($userId, $title, $body, $category, $thumbnail){
        $sql = "INSERT INTO posts (title, body, user_id, category, thumbnail) VALUES (?, ?, ?, ?, ?)";
        $stmt = mysqli_stmt_init($this->conn);
        if(!mysqli_stmt_prepare($stmt, $sql)){
            mysqli_stmt_close($stmt);
            return false;
        }
        mysqli_stmt_bind_param($stmt, "ssiss", $title, $body, $userId, $category, $thumbnail);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_close($stmt);
        return true;
    }

    public function selectTrendingPosts($limit){
        $sql = "SELECT posts.post_id, posts.title, posts.body, posts.category, posts.publish_datetime, posts.likes, posts.thumbnail,users.username 
        FROM posts JOIN users ON posts.user_id = users.user_id
        ORDER BY posts.publish_datetime DESC
        LIMIT ?";
        $data = array();
        $stmt = mysqli_stmt_init($this->conn);
        if(!mysqli_stmt_prepare($stmt, $sql)){
            mysqli_stmt_close($stmt);
            return false;
        }
        mysqli_stmt_bind_param($stmt, 'i', $limit);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);
        $data = array();
        while($row = mysqli_fetch_assoc($result)){
            $data[] = $row;
        }
        mysqli_stmt_close($stmt);
        return $data;
    }
    
    public function selectPostById($id){
        $sql = "SELECT posts.post_id, posts.title, posts.body, posts.category, posts.publish_datetime, posts.likes, posts.thumbnail, users.username, users.user_id
        FROM posts JOIN users ON posts.user_id = users.user_id 
        WHERE posts.post_id = ?";
        $data = array();
        $stmt = mysqli_stmt_init($this->conn);
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
    
    public function updatePostById($id, $title, $category, $body, $thumbnail){
        $sql = "UPDATE posts SET posts.title=?, posts.body=?, posts.category=?, posts.thumbnail=?
        WHERE posts.post_id=?";
    
        $stmt = mysqli_stmt_init($this->conn);
        if(!mysqli_stmt_prepare($stmt, $sql)){
            mysqli_stmt_close($stmt);
            return false;
        }
        mysqli_stmt_bind_param($stmt, 'ssssi', $title, $body, $category, $thumbnail, $id);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_close($stmt);
        return true;
    }
    
    public function deletePostById($id){
        $sql = "DELETE FROM posts WHERE posts.post_id=?";
    
        $stmt = mysqli_stmt_init($this->conn);
        if(!mysqli_stmt_prepare($stmt, $sql)){
            mysqli_stmt_close($stmt);
            return false;
        }
        mysqli_stmt_bind_param($stmt, 'i', $id);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_close($stmt);
        return true;
    }
    
    public function countAllPosts(){
        $sql = "SELECT COUNT(*) as count FROM posts";
        $stmt = mysqli_stmt_init($this->conn);
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
    
    public function selectPostsPagination($limit, $offset){
        $sql = "SELECT posts.post_id ,posts.title, posts.body, posts.category, posts.publish_datetime, posts.likes, posts.thumbnail, users.username 
        FROM posts JOIN users ON posts.user_id = users.user_id 
        ORDER BY posts.publish_datetime DESC
        LIMIT ? 
        OFFSET ?";
        $stmt = mysqli_stmt_init($this->conn);
        if(!mysqli_stmt_prepare($stmt, $sql)){
            mysqli_stmt_close($stmt);
            return null;
        }
        mysqli_stmt_bind_param($stmt, 'ii', $limit, $offset);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);
        $data = array();
        while($row = mysqli_fetch_assoc($result)){
            $data[] = $row;
        }
        mysqli_stmt_close($stmt);
        return $data;
    }
    
    public function countPostsByCategory($category){
        $sql = "SELECT COUNT(*) as count FROM posts 
        WHERE posts.category = ?";
    
        $stmt = mysqli_stmt_init($this->conn);
        if(!mysqli_stmt_prepare($stmt, $sql)){
            mysqli_stmt_close($stmt);
            return null;
        }
        mysqli_stmt_bind_param($stmt, 's', $category);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);
        $data = mysqli_fetch_assoc($result);
        mysqli_stmt_close($stmt);
        return $data['count'];
    }
    
    public function selectPostsByCategory($category, $limit, $offset){
        $sql = "SELECT posts.post_id ,posts.title, posts.body, posts.category, posts.publish_datetime, posts.likes, posts.thumbnail, users.username 
        FROM posts JOIN users ON posts.user_id = users.user_id 
        WHERE posts.category = ?
        ORDER BY posts.publish_datetime DESC
        LIMIT ? 
        OFFSET ?";
    
        $stmt = mysqli_stmt_init($this->conn);
        if(!mysqli_stmt_prepare($stmt, $sql)){
            mysqli_stmt_close($stmt);
            return null;
        }
        mysqli_stmt_bind_param($stmt, 'sii', $category, $limit, $offset);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);
        $data = array();
        while($row = mysqli_fetch_assoc($result)){
            $data[] = $row;
        }
        mysqli_stmt_close($stmt);
        return $data;
    }
    
    public function selectPostsFromUser($id, $limit, $offset){
        $sql = "SELECT posts.post_id ,posts.title, posts.body, posts.category, posts.publish_datetime, posts.likes, posts.thumbnail, users.username 
        FROM posts JOIN users ON posts.user_id = users.user_id 
        WHERE posts.user_id = ?
        ORDER BY posts.publish_datetime DESC
        LIMIT ? 
        OFFSET ?";
    
        $stmt = mysqli_stmt_init($this->conn);
        if(!mysqli_stmt_prepare($stmt, $sql)){
            mysqli_stmt_close($stmt);
            return null;
        }
        mysqli_stmt_bind_param($stmt, 'iii', $id, $limit, $offset);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);
        $data = array();
        while($row = mysqli_fetch_assoc($result)){
            $data[] = $row;
        }
        mysqli_stmt_close($stmt);
        return $data;
    }
    
    public function countPostFromUser($id){
        $sql = "SELECT COUNT(*) as count FROM posts 
        WHERE posts.user_id = ?";
    
        $stmt = mysqli_stmt_init($this->conn);
        if(!mysqli_stmt_prepare($stmt, $sql)){
            mysqli_stmt_close($stmt);
            return null;
        }
        mysqli_stmt_bind_param($stmt, 'i', $id);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);
        $data = mysqli_fetch_assoc($result);
        mysqli_stmt_close($stmt);
        return $data['count'];
    }

    public function incrementLike($id){
        $sql = "UPDATE posts SET likes = likes + 1
        WHERE posts.post_id = ?";
        $stmt = mysqli_stmt_init($this->conn);
        if(!mysqli_stmt_prepare($stmt, $sql)){
            mysqli_stmt_close($stmt);
            return null;
        }
        mysqli_stmt_bind_param($stmt, 'i', $id);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_close($stmt);
        return true;
    }

    public function getLike($id){
        $sql = "SELECT posts.likes FROM posts
        WHERE posts.post_id = ?";
        $stmt = mysqli_stmt_init($this->conn);
        if(!mysqli_stmt_prepare($stmt, $sql)){
            mysqli_stmt_close($stmt);
            return null;
        }
        mysqli_stmt_bind_param($stmt, 'i', $id);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);
        $data = mysqli_fetch_assoc($result);
        mysqli_stmt_close($stmt);
        return $data['likes'];
    }
    
    public function getLikeFromUser($id){
        $sql = "SELECT SUM(posts.likes) as likes FROM posts 
        WHERE posts.user_id = ?";
    
        $stmt = mysqli_stmt_init($this->conn);
        if(!mysqli_stmt_prepare($stmt, $sql)){
            mysqli_stmt_close($stmt);
            return null;
        }
        mysqli_stmt_bind_param($stmt, 'i', $id);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);
        $data = mysqli_fetch_assoc($result);
        mysqli_stmt_close($stmt);
        if ($data['likes'])
            return $data['likes'];
        else
            return 0;
    }   

}