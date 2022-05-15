<?php
session_start();
if (!isset($_SESSION['email'])) {
    header("location: login.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    
    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Rubik&display=swap" rel="stylesheet">

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">
    <!-- Custom CSS -->
    <link rel="stylesheet" href="assets/css/style.css">
</head>

<body>
    <div class="d-flex justify-content-end">
        <button>
            <a href='index.php'>Homepage</a>
        </button>
        <button>
            <a href='showEmpTable.php'>Employees</a>
        </button>
        <button>
            <a href='showSalaryDetails.php'>Salary</a>
        </button>
        <button>
            <a href='insertSalary.php'>Add Salaries</a>
        </button>
        <button>
            <a href='logout.php'>Log Out</a>
        </button>
    </div>
</body>

</html>