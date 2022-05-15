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
    <form action="insertSalary.php" method="post">
        <p>
            Employee Name:
            <select name="emp_name">
                <?php 
                    while($employee= mysqli_fetch_array($employees))
                    {
                ?>        
                <option value="<?php echo $employee['seq'];?>"><?php echo $employee['name'];?></option>
                <?php
                    }
                ?>
            </select>
        </p>
        <p>
            Month:
            <select name="month">
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
        </p>
        <p>
            Year:
            <select name="year">
                <option value="2021">2021</option>
                <option value="2022">2022</option>
                <option value="2023">2023</option>
            </select>
        </p>
        <p>
            Salary 
            <input type="number" name="emp_salary">
        </p>
        <input type="submit" name= "savesalary" value="Submit">
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
    echo $message;
}
?>