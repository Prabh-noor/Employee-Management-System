<?php
    require_once('links.php');
    require_once('database.php');
    $database= new Database();
    $salary= new Salary();
    $employees= $database->empDropDown();
    $dateutils= new DateUtils();
    $salaries= "";
    if(!empty($_POST['empSeq'])){
        $empSeq= $_POST['empSeq'];
        $salaries= $database->getSalariesByEmp($empSeq);  
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<script type='text/javascript'> 
function submitForm(){ 
  document.getElementById('show-salary').submit(); 
}
</script>
<body>
    <form action="manageSalaries.php" id="show-salary" method="post" onchange="submitForm()">
        <div class="col-8" id="inner-div">
            <div class="mb-1 row">
                <div class="col-sm-5">
                    <label class="col-form-label form-label" for="name">Employee Name:</label>
                </div>
                <div class="col-sm-7">
                    <select class="form-select" name="empSeq">
                        <option value="">Choose an option</option>
                        <?php
                        while($employee= mysqli_fetch_array($employees))
                        {
                        ?>
                            <option value="<?php echo $employee['seq'];?>"><?php echo $employee['name']; ?></option>
                        <?php } ?>
                    </select>
                </div>     
            </div>
        </div>
    </form>
    <div id="salary-grid">      
        <?php
        if($salaries !== ""){
            $header= "<div class='row' id='grid-header'>
                    <div class='col'>Employee name</div>
                    <div class='col'>Department</div>
                    <div class='col'>Month</div>
                    <div class='col'>Year</div>
                    <div class='col'>Amount</div>
                    <div class='col'>Date of Payment</div>
                    </div>";
            echo $header;
            $html= "";
            while($salary= mysqli_fetch_array($salaries))
            {
                $name= $salary['name'];
                $deptName= $salary['dept_name'];
                $month= $salary['month'];
                $year= $salary['year'];
                $empSalary= $salary['salary'];
                $dateOfPayment= $salary['date_of_payment'];
                $dateOfPayment= $dateutils->formatDateTime($dateOfPayment);
                $html .= "<div class='row align-items-center grid-details'>
                        <div class='col'>$name</div>
                        <div class='col'>$deptName</div>
                        <div class='col'>$month</div>
                        <div class='col'>$year</div>
                        <div class='col'>$empSalary</div>
                        <div class='col'>$dateOfPayment</div>
                        </div>";
            }
            echo $html;
        }     
        ?>               
    </div>
    <!-- Bootstrap Popper -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.5/dist/umd/popper.min.js" integrity="sha384-Xe+8cL9oJa6tN/veChSP7q+mnSPaj5Bcu9mPX5F5xIGE0DVittaqT5lorf0EI7Vk" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.min.js" integrity="sha384-kjU+l4N0Yf4ZOJErLsIcvOU2qSb74wXpOhqTvwVx3OElZRweTnQ6d31fXEoRD1Jy" crossorigin="anonymous"></script>
    <!-- Custom js -->
    <script src="assets/js/app.js"></script>
</body>
</html>