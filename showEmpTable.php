<?php
require_once('links.php');
require_once('database.php');
// $dateutils= new DateUtils();
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Document</title>
        <style>
            table,th,td{
                border: 1px solid black;
                border-collapse: collapse;
                padding: 8px;
            }
            .notfound{
                display: none;
            }
        </style>
        <script>
            $( document ).ready(function() {        
                var url= "Actions.php?call=pagination";
                $.getJSON(url, function(response){
                    loadEmpTable(response);
                })
                var url= "Actions.php?call=totalPages";
                $.get(url, function(response){
                    loadLinks(response);
                })               
                $(".searchBox").on("keyup", function() {
                    var searchedText= $(this).val();
                    var url= "Actions.php?call=pagination&searchedText="+searchedText;
                    $.getJSON(url, function(response){
                        loadEmpTable(response);
                    })
                });
                $(".searchBox").on("keyup", function() {
                    var searchedText= $(this).val();
                    var url= "Actions.php?call=totalPages&searchedText="+searchedText;
                    $.get(url, function(response){
                        loadLinks(response);
                    })
                });
            });
            // function submitForm(){ 
            //     $("#myform").submit(); 
            // }
            function loadEmpTable(response){
                var html = "";
                html += "<table>"+
                "<thead>"+
                "<tr>"+
                "<th>Department sr no.</th>"+
                "<th>Employee name</th>"+
                "<th>Date of Birth</th>"+
                "<th>Date of Joining</th>"+
                "<th>Address</th>"+
                "<th>Gender</th>"+
                "<th>Local Residence</th>"+
                "<th>Created on</th>"+
                "<th>Department Name</th>"+
                "<th>Actions</th>"+
                "</tr>"+
                "</thead>";
                for (var i = 0; i < response.length; i++){
                    html +="<tr>"+
                    "<td>"+ response[i].seq + "</td>"+
                    "<td>"+ response[i].name + "</td>"+
                    "<td>"+ response[i].date_of_birth + "</td>"+
                    "<td>"+ response[i].date_of_joining + "</td>"+
                    "<td>"+ response[i].address + "</td>"+
                    "<td>"+ response[i].gender + "</td>"+
                    "<td>"+ response[i].local_residence + "</td>"+
                    "<td>"+ response[i].created_on + "</td>"+
                    "<td>"+ response[i].dept_name + "</td>"+
                    "<td><button type='button' onclick='editEmp("+response[i].employeeseq+")'>Edit</button><button type='button' onclick='deleteEmp("+response[i].employeeseq+")'>Delete</button></td>";
                    "</tr>";
                }
                $(".employeeTable").html(html);
            }
            function loadLinks(response){
                var html="";
                for(var i = 1; i <= response; i++ ){ 
                    html+= "<span>"+
                    "<a href='#' class='page-item' id="+i+"> "+i+" </a>"+
                    "</span>";
                }
                $(".links").html(html);
                $(".page-item").on("click", function(){
                    var pageNum= $(this).prop('id');
                    var url= "Actions.php?call=pagination&page="+pageNum;
                    $.getJSON(url, function(response){
                        loadEmpTable(response);
                    })
                });
            }
            function exportData(){
                if (confirm("Export data to CSV format?") == true) {
                    var url= "Actions.php?call=exportData";
                    $.get(url, function(response){
                        var downloadLink = document.createElement("a");
                        var file = new Blob([response], {type: 'text/csv'});
                        downloadLink.href = URL.createObjectURL(file);
                        downloadLink.download = 'EmployeeDetails.csv';  
                        downloadLink.append();
                        downloadLink.click();
                        downloadLink.remove();
                    }); 
                }
            }
        </script>
</head>
<body>
    <h1>Employee table </h1>
    <p>
        <!-- <form action="showEmpTable.php" method="post" id= "myform" onchange= "submitForm()"> -->
            <input type="text" name="searchBox" class= "searchBox">
        <!-- </form> -->
    </p>
    <div class="employeeTable"></div>
    <p class= "links" align="center"></p>
    <p class= "export-btn" align= "center">
        <button onclick= "exportData()">Export To CSV File</button>
    </p>
</body>
</html>
<script>
function editEmp(seq){
    window.location= "editDetails.php?employeeseq="+seq;
}
function deleteEmp(seq){
    if (confirm("Are you sure to delete this record?") == true) {
        var url= "Actions.php?call=deleteEmployee&employeeseq=" + seq;
        $.get(url, function(response){
            alert(response);
        });
    }
    else{
        alert ("Record not deleted");
    }
}
</script>