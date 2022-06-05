<?php
    require_once('links.php');
    require_once('database.php');
    $database= new database();
    $departments= $database->deptDropDown();
    $seq = "";
    $name = "";
    $dob = "";
    $doj = "";
    $address = "";
    $gender = "";
    $localResident = "";
    $selectedDepSeq = "";
    if(!empty($_POST['seq'])){
        $seq= $_POST['seq'];
        $result= $database->getEmpBySeq($seq);
        $name = $result['name'];
        $dob = $result['date_of_birth'];
        $doj = $result['date_of_joining'];
        $address = $result['address'];
        $gender= $result['gender'];
        $localResident= $result['local_residence'];
        $selectedDepSeq= $result['dept_seq'];
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Employee Details</title>
</head>
<body>
    <form action="index.php" method="post" id="employee-form">
        <input type="hidden" name="seq" value="<?php echo $seq?>">
        <div class="header">
            <h1>Employee</h1>
        </div>
        <div class="col-12">
            <div class="mb-1 row">
                <div class="col-sm-4">
                    <label class="col-form-label form-label" for="name">Name:</label>
                </div>
                <div class="col-sm-8">
                    <input type="text" class="form-control" name="name" value="<?php echo $name; ?>" placeholder="">
                </div>     
            </div>
        </div>
        <div class="col-12">
            <div class="mb-1 row">
                <div class="col-sm-4">
                    <label class="col-form-label form-label" for="date_of_birth">Date of birth:</label>
                </div>
                <div class="col-sm-8">
                    <input type="date" class="form-control" name="date_of_birth" value="<?php echo $dob; ?>" placeholder="">
                </div>
            </div>
        </div>
        <div class="col-12">
            <div class="mb-1 row">
                <div class="col-sm-4">
                    <label class="col-form-label form-label" for="date_of_joining">Date of Joining:</label>
                </div>
                <div class="col-sm-8">
                    <input type="date" class="form-control" name="date_of_joining" value="<?php echo $doj; ?>" placeholder="">
                </div>
            </div>
        </div>
        <div class="col-12">
            <div class="mb-1 row">
                <div class="col-sm-4">
                    <label class="col-form-label form-label" for="address">Address:</label>
                </div>
                <div class="col-sm-8">
                    <input type="text" class="form-control" name="address" value="<?php echo $address; ?>" placeholder="">
                </div>
            </div>
        </div>
        <div class="col-12">
            <div class="mb-1 row align-items-end">
                <div class="col-sm-4">
                    <label class="col-form-label form-label" for="gender">Gender:</label>
                </div>
                <div class="col-sm-8">
                    <div class="btn-group" role="group">
                        <input class="btn-check" type="radio" name="gender" value="Male" <?php if($gender == "Male"){echo "checked";}?> id="male" autocomplete="off">
                        <label class="btn btn-secondary radio-btn" for="male">Male</label>

                        <input class="btn-check" type="radio" name="gender" value="Female" <?php if($gender == "Female"){echo "checked";}?> id="female" autocomplete="off">
                        <label class="btn btn-secondary radio-btn" for="female">Female</label>

                        <input class="btn-check" type="radio" name="gender" value="Other" <?php if($gender == "Other"){echo "checked";}?> id="other" autocomplete="off">
                        <label class="btn btn-secondary radio-btn" for="other">Other</label>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-12">
            <div class="mb-1 row align-items-end">
                <div class="col-sm-4">
                    <label class="col-form-label form-label" for="residence">Local Resident:</label>
                </div>
                <div class="col-sm-8">
                    <div class="btn-group" role="group">
                        <input class="btn-check" type="radio" name="residence" value="1" <?php if($localResident === 1){echo "checked";} ?> id="yes">
                        <label class="btn btn-secondary radio-btn" for="yes">Yes</label>
                        <input class="btn-check" type="radio" name="residence" value="0" <?php if($localResident === 0){echo "checked";} ?> id="no">
                        <label class="btn btn-secondary radio-btn" for="no">No</label>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-12">
            <div class="mb-1 row align-items-end">
                <div class="col-sm-4">
                    <label class="col-form-label form-label" for="departments">Department:</label>
                </div>
                <div class="col-sm-8">
                    <select class="form-select" name="departments">
                        <option selected>Select Deparment</option>
                        <?php 
                        while($department= mysqli_fetch_array($departments)){
                        ?>
                        <option value="<?php echo $department['seq']; ?>" 
                            <?php if ($selectedDepSeq == $department['seq']){echo "selected";}?>>
                            <?php
                                echo $department['dept_name'];
                            ?>
                        </option>
                        <?php
                        }
                        ?>
                    </select>
                </div>
            </div>
        </div>
        <button type="submit" name="employees" value="Submit">Submit</button>
        <button type="reset" value="Reset">Reset</button>
    </form>
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
        echo '<script type="text/javascript">alert("'.$message.'")</script>';
        $_REQUEST = array();
    }
}
?>