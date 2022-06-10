<?php
session_start();
require_once("database.php");
$database= new Database();
$call= $_GET['call'];
if($call== "deleteEmployee"){
    if (isset($_GET['employeeseq'])){
        $seq= $_GET['employeeseq'];
        $message= $database->delEmpBySeq($seq);
        echo $message;  
    }
}
if($call== "pagination"){
    $limit= isset($_SESSION['record-limit']) ? $_SESSION['records-limit'] : 5;
    if(isset($_GET['searchedText'])){
        $searchedText= $_GET['searchedText'];
    }
    else{
        $searchedText= "";
    } 
    $pageNo = (isset($_GET['page']) && is_numeric($_GET['page']) ) ? $_GET['page'] : 1;
    $paginationStart = ($pageNo - 1) * $limit; //offset  
    $pageRows= $database->pagination($limit, $paginationStart, $searchedText);
    echo $pageRowsJSON= json_encode($pageRows);
}
if($call== "totalPages"){
    $limit= isset($_SESSION['record-limit']) ? $_SESSION['records-limit'] : 5;
    if(isset($_GET['searchedText'])){
        $searchedText= $_GET['searchedText'];
    }
    else{
        $searchedText= "";
    }
    $totalPages= $database->totalPages($limit, $searchedText);
    echo $totalPages;
}
if($call== "exportData"){
    echo $file= $database->exportData();
}
?>