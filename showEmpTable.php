<?php
require_once('links.php');
require_once('database.php');
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
                html += "<div class='row' id='grid-header'>"+
                            "<div class='col'>Employee name</div>"+
                            "<div class='col'>D.O.B</div>"+
                            "<div class='col'>Joining date</div>"+
                            "<div class='col'>Address</div>"+
                            "<div class='col'>Gender</div>"+
                            "<div class='col'>Local Resident</div>"+
                            "<div class='col'>Created on</div>"+
                            "<div class='col'>Department</div>"+
                            "<div class='col'>Actions</div>"+
                        "</div>";
                for (var i = 0; i < response.length; i++){
                    html +="<div class='row align-items-center' id='grid-details'>"+
                        "<div class='col'>"+ response[i].name + "</div>"+
                        "<div class='col'>"+ response[i].date_of_birth + "</div>"+
                        "<div class='col'>"+ response[i].date_of_joining + "</div>"+
                        "<div class='col'>"+ response[i].address + "</div>"+
                        "<div class='col'>"+ response[i].gender + "</div>"+
                        "<div class='col'>"+ response[i].local_residence + "</div>"+
                        "<div class='col'>"+ response[i].created_on + "</div>"+
                        "<div class='col'>"+ response[i].dept_name + "</div>"+
                        "<div class='col'><ul class='list-inline m-0'>"+
                            "<li class='list-inline-item'><button class='btn btn-success btn-sm rounded-0' type='button' onclick='editEmp("+response[i].employeeseq+")' data-toggle='tooltip' data-placement='top' title='Edit'><i class='fa-pen-to-square'></i></button></li>"+
                            "<li class='list-inline-item'><button class='btn btn-danger btn-sm rounded-0' type='button' onclick='deleteEmp("+response[i].employeeseq+")' data-toggle='tooltip' data-placement='top' title='Delete'><i class='fa-solid fa-trash-can'></i></button></li>"+
                        "</ul></div>"+
                    "</div>";
                }
                $("#employees-grid").html(html);
            }
            function loadLinks(response){
                var html="";
                for(var i = 1; i <= response; i++ ){
                    html+= "<li class='page-item'><a class='page-link' id="+i+" href='#'>"+i+"</a></li>";
                }
                $("#links").html(html);
                $(".page-link").on("click", function(){
                    var pageNum= $(this).prop('id');
                    var searchedText = $('.searchBox').val();
                    var url= "Actions.php?call=pagination&page="+pageNum+"&searchedText="+searchedText;
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
    <div id="grid-with-search">
        <div id="searchBox" class="form-group">
            <input type="text" name="searchBox" class="form-control searchBox" aria-describedby="searchBox" placeholder="Search here...">
        </div>
        <div id="employees-grid"></div>
    </div>
    <nav aria-label="...">
        <ul class="pagination pagination-lg" id="links">
        </ul>
    </nav>
    <div id="export-btn">
        <button class="btn btn-primary" onclick= "exportData()">Export To CSV File</button>
    </div>

    <form id="editEmployee" action="index.php" method="post">
        <input type="hidden" name="seq" id="seq">
    </form>
    
    <!-- Bootstrap Popper -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.5/dist/umd/popper.min.js" integrity="sha384-Xe+8cL9oJa6tN/veChSP7q+mnSPaj5Bcu9mPX5F5xIGE0DVittaqT5lorf0EI7Vk" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.min.js" integrity="sha384-kjU+l4N0Yf4ZOJErLsIcvOU2qSb74wXpOhqTvwVx3OElZRweTnQ6d31fXEoRD1Jy" crossorigin="anonymous"></script>
    <!-- Custom js -->
    <script src="assets/js/app.js"></script>
</body>
</html>
<script>
    function editEmp(seq){
        $("#editEmployee #seq").val(seq);
        $("#editEmployee").submit();
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