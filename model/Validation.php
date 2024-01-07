<?php
require_once 'UserRepository.php';

class Validation{
    private $errorMsg;
    
    public function usernameValidate($username){
        if(!$username){
            $this->errorMsg['username'] = 'Please enter username';
            return false;
        }
        return true;
    }
    public function passwordValidate($password){
        if(!$password){
            $this->errorMsg['password'] = 'Please enter password';
            return false;
        }
        return true;
    }
    public function confirmPasswordValidate($password){
        if(!$password){
            $this->errorMsg['confirmPass'] = 'Please enter confirm password';
            return false;
        }
        return true;
    }
    public function twoPasswordValidate($password, $confirmPass){
        if($password != $confirmPass){
            $errorMsg['password'] = "Password does not match";
            $errorMsg['confirmPass'] = "Password does not match";
            return false;
        }
        return true;
    }

    public function getErrorMsg(){
        return $this->errorMsg;
    }

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