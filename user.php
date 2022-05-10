<?php
class User{
    private $seq, $email, $password;
    public function setSeq($seq){
        $this->seq= $seq;
    }
    public function getSeq(){
        return $this->seq;
    }
    public function setEmail($email){
        $this->email= $email;
    }
    public function getEmail(){
        return $this->email;
    }
    public function setPassword($password){
        $this->password= $password;
    }
    public function getPassword(){
        return $this->password;
    }
}
?>