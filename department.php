<?php
class Department{
    private $deptname, $deptdetails;
    //set methods
    public function setDeptName($deptName){
        $this->deptname= $deptName;        
    }
    public function setDeptDetails($deptDetails){
        $this->deptdetails= $deptDetails;
    }
    // get methods 
    public function getDeptName(){
        return $this->deptname;        
    }
    public function getDeptDetails(){
        return $this->deptdetails;
    }
}
?>