<?php
require_once 'UserRepository.php';
/**
 * This class is used to validate user input
 */
class Validation{
    // error messages
    private $errorMsg;
    /**
     * validate username
     * @param string $username
     * @return bool true if username is valid and false if username is invalid
     */
    public function usernameValidate($username){
        if(!$username){
            $this->errorMsg['username'] = 'Please enter username';
            return false;
        }
        return true;
    }
    /**
     * validate password
     * @param string $password
     * @return bool true if password is valid or false if password is invalid
     */
    public function passwordValidate($password){
        if(!$password){
            $this->errorMsg['password'] = 'Please enter password';
            return false;
        }
        return true;
    }
    /**
     * validate confirm password
     * @param string $password
     * @return bool true if confirm password is valid or false if confirm password is invalid
     */
    public function confirmPasswordValidate($password, $confirmPass){
        if(!$confirmPass){
            $this->errorMsg['confirmPass'] = 'Please enter confirm password';
            return false;
        }
        if($password != $confirmPass){
            $this->errorMsg['password'] = "Password does not match";
            $this->errorMsg['confirmPass'] = "Password does not match";
            return false;
        }
        return true;
    }
    public function getErrorMsg(){
        return $this->errorMsg;
    }
    /**
     * validate title, body and category from post
     * @param string $title post's title
     * @param string $body post's body
     * @param string $category post's category
     * @return bool true if title, body and category are valid false if data is invalid
     */
    public function postValidate($title, $body, $category){
        $valid = true;
        if ($title === '') {
            $this->errorMsg['title-post'] = 'Please enter title';
            $valid = false;
        }
        if ($body === '') {
            $this->errorMsg['article-body'] = 'Please add text to your post';
            $valid = false;
        }
        if ($category === '') {
            $this->errorMsg['category'] = 'Please select category';
            $valid = false;
        }
        return $valid;
    }
    /**
     * validate image file from post
     * @param file image file from post
     * @return bool true if image file is valid or false if image file is invalid
     */
    public function fileValidate($file){
        if (!$file['name']) {
            $this->errorMsg['thumbnail'] = 'Please add image to your post';
            return false;
        } else {
            $validFileExtensions = ['png', 'jpg', 'jpeg'];

            $extension = explode('.', $file['name']);
            $extension = strtolower($extension[count($extension) - 1]);
            if (!in_array($extension, $validFileExtensions)) {
                $this->errorMsg['thumbnail'] = 'Invalid file extension, only png, jpg and jpeg are allowed';
                return false;
            }
            if ($file['size'] > 2_000_000) {
                $this->errorMsg['thumbnail'] = 'File size must be less than 2Mb';
                return false;
            }
        }
        return true;
    }
}