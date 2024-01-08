<?php
/**
 * Class representing operation with Posts in database
 */
class PostRepository{
    private $conn;
    public function __construct($conn)
    {
        $this->conn = $conn;
    }
    /**
     * add post to database
     * @param int $userId user id
     * @param string $title post title
     * @param string $body post body
     * @param string $category post category
     * @param string $thumbnail post thumbnail as image file
     * @return bool true success false query failed
     */
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
    /**
     * Select posts from database with limit and 
     * @param int $limit number of rows
     * @return array|null $data posts sorted by number of like descending and by date added null if query failed
     */
    public function selectTrendingPosts($limit){
        $sql = "SELECT posts.post_id, posts.title, posts.body, posts.category, posts.publish_datetime, posts.likes, posts.thumbnail,users.username 
        FROM posts JOIN users ON posts.user_id = users.user_id
        ORDER BY posts.likes DESC, posts.publish_datetime DESC
        LIMIT ?";
        $data = array();
        $stmt = mysqli_stmt_init($this->conn);
        if(!mysqli_stmt_prepare($stmt, $sql)){
            mysqli_stmt_close($stmt);
            return null;
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
    /**
     * Get post from database base on their id
     * @param int $id post's id
     * @return array|null $data 1 post from database or null if query failed
     */
    public function selectPostById($id){
        $sql = "SELECT posts.post_id, posts.title, posts.body, posts.category, posts.publish_datetime, posts.likes, posts.thumbnail, users.username, users.user_id
        FROM posts JOIN users ON posts.user_id = users.user_id 
        WHERE posts.post_id = ?";
        $data = array();
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
        return $data;
    }
    /**
     * Update post in database by id
     * @param int $id post's id
     * @param string $title post's title
     * @param string $category post's category
     * @param string $body post's body
     * @param string $thumbnail post's thumbnail file
     * @return bool true onn success or false if query failed
     */
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
    /**
     * Delete post from database by id
     * @param int $id post's id
     * @return bool true on success or false if query failed
     */
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
    /**
     * Count all posts from database
     * @return array|null $data['count'] number of posts or null if query failed
     */
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
    /**
     * Select posts from database with limit and offset
     * @param int $limit number of rows
     * @param int $offset number of rows to skip
     * @return array|null $data posts sorted by date added
     */
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
    /**
     * Count posts from database by category
     * @param string $category post's category
     * @return int|null $data['count'] number of posts or null if query failed
     */
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
    /**
     * Select posts from database by category with limit and offset
     * @param string $category post's category
     * @param int $limit number of rows
     * @param int offset $number of rows to skip
     * @return array|null $data posts sorted by date added or null
     */
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
    /**
     * Get posts from database by user with limit and offset
     * @param int $id user's id
     * @param int $limit number of rows
     * @param int $offset number of rows to skip
     * @return array|null posts sorted by date added or null
     */
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
    /**
     * Count posts from database by user id
     * @param int $id user's id
     * @return int|null data['count'] number of posts or null if query failed
     */
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
    /**
     * Increment post's like using post id
     * @param int $id post's id
     * @return bool true if success false if failed
     */
    public function incrementLike($id){
        $sql = "UPDATE posts SET likes = likes + 1
        WHERE posts.post_id = ?";
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
    /**
     * Get likes value from post using post id
     * @param int $id post's id
     * @return int|null data['likes'] number of likes or null if query failed
     */
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
    /**
     * Get likes value from all posts of an user
     * @param  int $id user's id
     * @return int|null $data['likes'] number of likes or null if query failed
     */
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