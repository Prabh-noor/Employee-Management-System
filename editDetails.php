<?php
require_once('links.php');
require_once('database.php');
$database= new Database();
$seq= $_GET['employeeseq'];
$result= $database->getEmpBySeq($seq);
$departments= $database->deptDropDown();
if(isset($result['gender'])){
    $selectedGender= $result['gender'];
}
else{
    $selectedGender= "Male";
}
if(isset($result['local_residence'])){
    $selectedLocal= $result['local_residence'];
}
else{
    $selectedLocal= 0;
}
if(isset($result['dept_seq'])){
    $selectedDepSeq= $result['dept_seq'];
}
else{
    $selectedDepSeq= "1";
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        table,th,td{
            border: 1px solid black;
            border-collapse: collapse;
            padding: 10px;
        }
    </style>
</head>
<body>
    <h1>Edit details:</h1>
    <form action="showEmpTable.php" method="Post">
        <input type="hidden" name="seq" value="<?php echo $seq?>">
            <p>Name: 
                <input type="text" name="name" value="<?php echo $result['name']; ?>"><br>
            </p>       
            <p>
            Date of Birth: 
            <input type="date" name="date_of_birth" value="<?php echo $result['date_of_birth']; ?>"><br>
        </p>        
        <p>
            Date of joining:
            <input type="date" name="date_of_joining" value="<?php echo $result['date_of_joining'] ?>"><br>
        </p>        
        <p>Address:
            <input type="text" name="address" value="<?php echo $result['address']; ?>" size="40"><br>
        </p>       
        <p>
            Gender:
            <input type="radio" name="gender" value="Male" <?php if($selectedGender == "Male"){echo "checked";}?>>Male
            <input type="radio" name="gender" value="Female" <?php if($selectedGender == "Female"){echo "checked";}?>>Female
            <input type="radio" name="gender" value="Other" <?php if($selectedGender == "other"){echo "checked";}?>>Other
        </p>       
        <p>Local Residence:
            <input type="radio" name="residence" value="1" <?php if($selectedLocal == 1){echo "checked";}?>>Yes
            <input type="radio" name="residence" value="0" <?php if($selectedGender == 0){echo "checked";}?>>No
        </p>
        <p>           
            Department name:
            <select name="departments">
            <?php
            while($department= mysqli_fetch_array($departments)){
            ?>
            <option value="<?php echo $department['seq'];?>" 
                <?php if ($selectedDepSeq == $department['seq']){echo "selected";}?>>
                <?php echo $department['dept_name']; ?>
            </option>
            <?php
                }               
            ?>
            </select><br>
        </p>
        <input type="submit"  name= "UpdateEmp" value="Submit">
    </form>
    <br>
    <a href="showEmpTable.php" value="goBack">Go back</a>
    <?php
    if (isset($_POST['UpdateEmp'])){
        $employeeObj= new Employee();
        $employeeObj->setSeq($_POST['seq']);
        $employeeObj->setName($_POST['name']);
        $employeeObj->setDateOfBirth($_POST['date_of_birth']);
        $employeeObj->setDateOfJoining($_POST['date_of_joining']);
        $employeeObj->setAddress($_POST['address']);
        $employeeObj->setGender($_POST['gender']);
        $employeeObj->setLocalResidence($_POST['residence']);  
        $employeeObj->setAccountCreated(date("Y-m-d H:i:s"));
        $employeeObj->setDeptSeq($_POST['departments']);
        $message= $database->saveEmployees($employeeObj);
        echo "<script>alert('$message');</script>";
    } 
    ?>
    
</body>
</html>