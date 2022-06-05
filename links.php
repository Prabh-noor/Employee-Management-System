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
    <link rel="stylesheet" href="assets/bootstrap-5.2.0/css/bootstrap.css">
    <!-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous"> -->

    <!-- Fontawesome CDN -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/fontawesome.css" integrity="sha512-H2GlJYNMmZLAA8LfFQ8EW7WWVumdleFREr8PUyBZeuRt5mEd25RK11Zo+rHBqSzbp75v2xRFfkmiyO9MBtx3mg==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>

    <!-- Custom CSS -->
    <link rel="stylesheet" href="assets/css/style.css">
</head>

<body>
    <header class="section-header">
        <nav class="navbar navbar-expand-lg navbar-light bg-light">
            <div class="container-fluid">
                <a class="navbar-brand d-md-none d-md-flex" href="#">Categories</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarNavDropdown">
                    <ul class="navbar-nav">
                        <li class="nav-item">
                            <a class="nav-link active" aria-current="page" href="index.php">Employee</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="addDept.php">Department</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="insertSalary.php">Salary</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="showEmpTable.php">Employees Detail</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="showSalaryDetails.php">Salaries Detail</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="logout.php">Logout</a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
    </header>

    <!-- <div class="d-flex justify-content-end">
        <button>
            <a href='index.php'>Employee</a>
        </button>
		<button>
            <a href='addDept.php'>Department</a>
        </button>
        <button>
        	<a href='insertSalary.php'>Salary</a> 
        </button>
        <button>
        	<a href='showEmpTable.php'>Employees Detail</a> 
        </button>
        <button>
        	<a href='showSalaryDetails.php'>Salaries Detail</a>
        </button>
        <button>
            <a href='logout.php'>Log Out</a>
        </button>
    </div> -->
</body>

</html>