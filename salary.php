<?php
class Salary{
    private $seq, $empseq, $month, $year, $salary, $dateofpayment;
    public function setSeq($seq){
        $this->seq= $seq;
    }
    public function getSeq(){
        return $this->seq;
    }
    public function setEmpSeq($empSeq){
        $this->empseq= $empSeq;
    }
    public function getEmpSeq(){
        return $this->empseq;
    }
    public function setMonth($month){
        $this->month= $month;
    }
    public function getMonth(){
        return $this->month;
    }
    public function setYear($year){
        $this->year= $year;
    }
    public function getYear(){
        return $this->year;
    }
    public function setSalary($salary){
        $this->salary= $salary;
    }
    public function getSalary(){
        return $this->salary;
    }
    public function setDateOfPayment($dateOfPayment){
        $this->dateofpayment= $dateOfPayment;
    }
    public function getDateOfPayment(){
        return $this->dateofpayment;
    }
}
?>