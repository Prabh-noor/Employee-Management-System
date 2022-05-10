<?php
class Employee{
    private $seq, $name, $dateofbirth, $dateofjoining, $address, $gender, $localresidence, $accountcreated, $deptseq;
    // set methods
    public function setSeq($seq){
        $this->seq= $seq;
    }
    public function setName($name){
        $this->name= $name;
    }
    public function setDateOfBirth($DateOfBirth){
        $this->dateofbirth= $DateOfBirth;
    }
    public function setDateOfJoining($dateOfJoining){
        $this->dateofjoining= $dateOfJoining;
    }
    public function setAddress($address){
        $this->address= $address;
    }
    public function setGender($gender){
        $this->gender= $gender;
    }
    public function setLocalResidence($localResidence){
        $this->localresidence= $localResidence;
    }
    public function setAccountCreated($accountCreated){
        $this->accountcreated= $accountCreated;
    }
    public function setDeptSeq($deptSeq){
        $this->deptseq= $deptSeq;
    }
    // get methods
    public function getSeq(){
        return $this->seq;
    }
    public function getName(){
        return $this->name;
    }
    public function getDateOfBirth(){
        return $this->dateofbirth;
    }
    public function getDateOfJoining(){
        return $this->dateofjoining;
    }
    public function getAddress(){
        return $this->address;
    }
    public function getGender(){
        return $this->gender; 
    }
    public function getLocalResidence(){
        return $this->localresidence;
    }
    public function getAccountCreated(){
        return $this->accountcreated;
    }
    public function getDeptSeq(){
        return $this->deptseq;
    }
}
?>