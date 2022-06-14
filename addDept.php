<?php
    require_once('links.php');
    require_once('database.php');
    $database= new database();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Department</title>
</head>
<body>
    <form action="addDept.php" method="post" id="department-form">
        <div class="header">
            <h1>Add Department</h1>
        </div>
        <div class="col-12">
            <div class="mb-1 row align-items-center">
                <div class="col-sm-4">
                    <label class="col-form-label form-label" for="dept_name">Department name:</label>
                </div>
                <div class="col-sm-8">
                    <input type="text" class="form-control" name="dept_name" required placeholder="">
                </div>
            </div>
        </div>
        <div class="col-12">
            <div class="mb-1 row align-items-center">
                <div class="col-sm-4">
                    <label class="col-form-label form-label" for="dept_details">Details:</label>
                </div>
                <div class="col-sm-8">
                    <input type="text" class="form-control" name="dept_details" required placeholder="">
                </div>
            </div>
        </div>
        <button class="form-submit-btn" type="submit" name="department" value="Submit">Submit</button>
        <button class="form-reset-btn" type="reset" value="Reset">Reset</button>
    </form>
    <!-- Custom js -->
    <script src="assets/js/app.js"></script>
</body>
</html>
<?php
if(isset($_POST['department'])){
    if ($_POST['department']=="Submit"){
        $departmentObj= new Department();
        $departmentObj->setDeptName($_POST['dept_name']);
        $departmentObj->setDeptDetails($_POST['dept_details']);
        $message= $database->saveDepartment($departmentObj);
        echo '<script type="text/javascript">alert("'.$message.'")</script>';
    }
}
?>