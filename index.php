<?php
    require_once('links.php');
    require_once('database.php');
    $database= new database();
    $departments= $database->deptDropDown();
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
    <div class="row">
        <div class="col-lg-12">
            <form action="index.php" method="post" id="employee-form">
                <div class="header">
                    <h1>Employee</h1>
                </div>
                <div>
                    <label class="form-label" for="name">Name:</label> 
                    <input class="form-field" type="text" name="name" size="43">
                </div>       
                <div>
                    <label class="form-label" for="date_of_birth">Date of Birth:</label>  
                    <input class="form-field" type="date" name="date_of_birth">
                </div>        
                <div>
                    <label class="form-label" for="date_of_joining">Date of Joining:</label> 
                    <input class="form-field" type="date" name="date_of_joining">
                </div>        
                <div>
                    <label class="form-label" for="address">Address:</label>
                    <input class="form-field" type="text" name="address" size="39">
                </div>       
                <div style="display: flex;align-items: end;">
                    <label class="form-label" for="gender">Gender:</label>
                    <div class="btn-group" role="group">
                        <input class="btn-check" type="radio" name="gender" value="Male" id="male" autocomplete="off">
                        <label class="btn btn-secondary radio-btn" for="male">Male</label>

                        <input class="btn-check" type="radio" name="gender" value="Female" id="female" autocomplete="off">
                        <label class="btn btn-secondary radio-btn" for="female">Female</label>

                        <input class="btn-check" type="radio" name="gender" value="Other" id="other" autocomplete="off">
                        <label class="btn btn-secondary radio-btn" for="other">Other</label>
                    </div>
                </div>        
                <div style="display: flex;align-items: end;">
                    <label class="form-label" for="residence">Local Residence:</label>
                    <div class="btn-group">
                        <input class="btn-check" type="radio" name="residence" value="1" id="yes">
                        <label class="btn btn-secondary radio-btn" for="yes">Yes</label>
                        <input class="btn-check" type="radio" name="residence" value="0" id="no">
                        <label class="btn btn-secondary radio-btn" for="no">No</label>
                    </div>
                </div>
                <div>
                    <label class="form-label" for="departments">Departments:</label> 
                    <select class="form-field" name="departments">
                        <?php 
                        while($department= mysqli_fetch_array($departments)){
                        ?>
                        <option value="<?php
                                echo $department['seq'];
                                ?>">
                            <?php
                                echo $department['dept_name'];
                                ?>
                        </option>
                        <?php
                            }
                        ?>
                    </select>
                </div>
                    <button type="submit" name="employees" value="Submit">Submit</button>
                    <button type="reset" value="Reset">Reset</button>
            </form>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12">
            <form action="index.php" method="post" id="department-form">
                <div class="header">
                    <h1>Departments table</h1>
                </div>
                <div>
                    <label class="form-label" for="dept_name">Department name:</label>
                    <input class="form-field" type="text" name="dept_name" size="25">
                </div>
                <div>
                    <label class="form-label" for="dept_details">Details:</label>
                    <input class="form-field" type="text" name="dept_details" size="41">
                </div>
                <button type="submit" name="department" value="Submit">Submit</button>
                <button type="reset" value="Reset">Reset</button>
            </form>
        </div>
    </div>
    <!-- Bootstrap Popper -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.5/dist/umd/popper.min.js" integrity="sha384-Xe+8cL9oJa6tN/veChSP7q+mnSPaj5Bcu9mPX5F5xIGE0DVittaqT5lorf0EI7Vk" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.min.js" integrity="sha384-kjU+l4N0Yf4ZOJErLsIcvOU2qSb74wXpOhqTvwVx3OElZRweTnQ6d31fXEoRD1Jy" crossorigin="anonymous"></script>
    <!-- Custom js -->
    <script src="assets/js/app.js"></script>
</body>
</html>
<?php
if(isset($_POST['employees'])){
    if($_POST['employees']=="Submit"){
        $employeeObj= new Employee();
        $employeeObj->setName($_POST['name']);
        $employeeObj->setDateOfBirth($_POST['date_of_birth']);
        $employeeObj->setDateOfJoining($_POST['date_of_joining']);
        $employeeObj->setAddress($_POST['address']);
        $gender= "";
        if(isset($_POST['gender'])){
            $employeeObj->setGender($_POST['gender']);
        }
        $local_residence= "";
        if(isset($_POST['residence'])){
            $employeeObj->setLocalResidence($_POST['residence']);
        }  
        $employeeObj->setAccountCreated(date("Y-m-d H:i:s"));
        $employeeObj->setDeptSeq($_POST['departments']);
        $message=  $database->saveEmployees($employeeObj);
        // echo $message;
        echo '<script type="text/javascript">alert("'.$message.'")</script>';
    }
}
if(isset($_POST['department'])){
    if ($_POST['department']=="Submit"){
        $departmentObj= new Department();
        $departmentObj->setDeptName($_POST['dept_name']);
        $departmentObj->setDeptDetails($_POST['dept_details']);
        $message= $database->saveDepartment($departmentObj);
        // echo $message;
        echo '<script type="text/javascript">alert("'.$message.'")</script>';
    }
}
?>