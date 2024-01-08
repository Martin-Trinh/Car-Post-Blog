<?php
/** 
 * This class is used to interact with the database table users
 */
class UserRepository{
    private $conn;

    public function __construct($conn)
    {
        $this->conn = $conn;
    }
    /**
     * Find a user in database by username
     * @param string $username
     * @return array|null $row rows of user or null if query failed
     */
    public function findUserByUsername( $username){
        $sql = "SELECT * FROM users where username = ?";
        $stmt = mysqli_stmt_init($this->conn);
        if(!mysqli_stmt_prepare($stmt, $sql)){
            mysqli_stmt_close($stmt);
            return null;
        }
    
        mysqli_stmt_bind_param($stmt, "s", $username);
        mysqli_stmt_execute($stmt);
    
        $result = mysqli_stmt_get_result($stmt);
        $row = mysqli_fetch_assoc($result);
        mysqli_stmt_close($stmt);
        return $row;
    }
    /**
     * Create a user in database
     * @param string $username username of user
     * @param string $password hashed password of user
     * @return bool true if query success or false if query failed
     */
    public function createUser($username, $password, $role){
        $sql = "INSERT INTO users (username, password, role) VALUES (?, ?, ?)";
        $stmt = mysqli_stmt_init($this->conn);
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
    /**
     * Count number of users in database
     * @return int|null $data['count'] number of users
     */
    public function countUsers(){
        $sql = "SELECT COUNT(*) as count FROM users"; 
    
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
     * Select all users in database with limit and offset
     * @param int $limit number of users to select
     * @param int $offset number of users to skip
     * @return array|null data array of users or null if query failed
     */
    public function selectAllUser($limit, $offset){
        $sql = "SELECT * FROM users 
        ORDER BY users.username ASC
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
        while($row = mysqli_fetch_assoc($result)){
            $data[] = $row;
        }
        mysqli_stmt_close($stmt);
        return $data;
    }
    /**
     * Update user's roole in database by username
     * @param string $username username of user
     * @param string $role role of user
     * @return bool true if update success, false if query failed
     */
    public function updateRoleByUsername($username, $role){
        $sql = "UPDATE users SET users.role = ?
        WHERE users.username = ?";
    
        $stmt = mysqli_stmt_init($this->conn);
        if(!mysqli_stmt_prepare($stmt, $sql)){
            mysqli_stmt_close($stmt);
            return false;
        }
        mysqli_stmt_bind_param($stmt, 'ss', $role, $username);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_close($stmt);
        return true;
    }


}