<?php
require_once('links.php');
require_once('database.php');
$database= new Database();
$salary= new Salary();
$employees= $database->empDropDown();
$dateutils= new DateUtils();
$salaries= null;
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
<style>
    table,th,td{
        border: 1px solid black;
        border-collapse: collapse;
        padding: 10px;
    }
</style> 
<script type='text/javascript'> 
function submitForm(){ 
  document.getElementById('myform').submit(); 
}
</script>
<body>
    <form action="showSalaryDetails.php" id= "myform" method="post" onchange="submitForm()">
    <p>
        Employee Name:
        <select name="empSeq">
            <option value="">Choose an option</option>
            <?php
            while($employee= mysqli_fetch_array($employees))
            {
            ?>
            <option value="<?php echo $employee['seq'];?>"><?php echo $employee['name']; ?></option>
            <?php } ?>
        </select>
    </p>            
    </form>   
    <br>
    <table>        
        <?php
        if(sizeof($salaries)>0){
            echo ("
            <tr>
                <th>Employee Name</th>
                <th>Department</th>
                <th>Month</th>
                <th>Year</th>
                <th>Amount</th>
                <th>Date Of Payment</th>
            </tr>");            
            while($salary= mysqli_fetch_array($salaries))
            {
                $name= $salary['name'];
                $deptName= $salary['dept_name'];
                $month= $salary['month'];
                $year= $salary['year'];
                $empSalary= $salary['salary'];
                $dateOfPayment= $salary['date_of_payment'];
                $dateOfPayment= $dateutils->formatDateTime($dateOfPayment);
                echo ("
                <tr>
                <td>$name</td>
                <td>$deptName</td>
                <td>$month</td>
                <td>$year</td>
                <td>$empSalary</td>
                <td>$dateOfPayment</td>
                </tr>
                ");
            } 
        }     
        ?>               
    </table>
</body>
</html>