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
}