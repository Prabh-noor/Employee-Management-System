<?php
require_once('links.php');
require_once('database.php');
$database= new Database();
$salaryObj= new Salary();
$employees= $database->empDropDown();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <form id="salary-form" action="insertSalary.php" method="post">
        <div class="header">
            <h1>Salary</h1>
        </div>
        <div class="col-12">
            <div class="mb-1 row select-field">
                <div class="col-sm-4">
                    <label class="col-form-label form-label" for="dept_details">Employee Name:</label>
                </div>
                <div class="col-sm-8">                    
                    <select class="form-select" name="emp_name">
                        <?php 
                            while($employee= mysqli_fetch_array($employees))
                            {
                        ?>        
                        <option value="<?php echo $employee['seq'];?>"><?php echo $employee['name'];?></option>
                        <?php
                            }
                        ?>
                    </select>
                </div>
            </div>
        </div>
        <div class="col-12">
            <div class="mb-1 row select-field">
                <div class="col-sm-4">
                    <label class="col-form-label form-label" for="month">Month:</label>
                </div>
                <div class="col-sm-8">                    
                    <select class="form-select" name="month">
                        <option value="January">January</option>
                        <option value="February">February</option>
                        <option value="March">March</option>
                        <option value="April">April</option>
                        <option value="May">May</option>
                        <option value="June">June</option>
                        <option value="July">July</option>
                        <option value="August">August</option>
                        <option value="September">September</option>
                        <option value="October">October</option>
                        <option value="November">November</option>
                        <option value="December">December</option>
                    </select>
                </div>
            </div>
        </div>
        <div class="col-12">
            <div class="mb-1 row select-field">
                <div class="col-sm-4">
                    <label class="col-form-label form-label" for="year">Year:</label>
                </div>
                <div class="col-sm-8">                    
                    <select class="form-select" name="year">
                        <option value="2021">2021</option>
                        <option value="2022">2022</option>
                        <option value="2023">2023</option>
                        <option value="2024">2024</option>
                        <option value="2025">2025</option>
                    </select>
                </div>
            </div>
        </div>
        <div class="col-12">
            <div class="mb-1 row">
                <div class="col-sm-4">
                    <label class="col-form-label form-label" for="emp_salary">Salary:</label>
                </div>
                <div class="col-sm-8">
                    <input type="text" class="form-control" name="emp_salary" placeholder="">
                </div>     
            </div>
        </div>
        <button type="submit" name= "savesalary" value="Submit">Submit</button>
    </form>

    <!-- Bootstrap Popper -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.5/dist/umd/popper.min.js" integrity="sha384-Xe+8cL9oJa6tN/veChSP7q+mnSPaj5Bcu9mPX5F5xIGE0DVittaqT5lorf0EI7Vk" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.min.js" integrity="sha384-kjU+l4N0Yf4ZOJErLsIcvOU2qSb74wXpOhqTvwVx3OElZRweTnQ6d31fXEoRD1Jy" crossorigin="anonymous"></script>
    <!-- Custom js -->
    <script src="assets/js/app.js"></script>
</body>
</html>
<?php   
if(isset($_POST['savesalary'])){
    $salaryObj->setEmpSeq($_POST['emp_name']);
    $salaryObj->setMonth($_POST['month']);
    $salaryObj->setYear($_POST['year']);
    $salaryObj->setSalary($_POST['emp_salary']);
    $salaryObj->setDateOfPayment(date("Y-m-d H:i:s"));
    $message= $database->saveSalary($salaryObj);
    echo "<div id='flash-msg' class='alert alert-success alert-dismissible fade show' role='alert'>
            $message
        <button type='button' class='close btn btn-outline-dark btn-sm' onclick='closeMsg()' data-dismiss='alert' aria-label='Close'>
            <span aria-hidden='true'>&times;</span>
        </button>
    </div>";
}
?>