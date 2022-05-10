<?php
require_once('employee.php');
require_once('department.php');
require_once('salary.php');
require_once('user.php');
require_once('dateutils.php');
class Database
{
    private $conn;
    function connectivity()
    {
        $this->conn = mysqli_connect('localhost', 'root', '', 'employeemanagementsystem');
        if (!$this->conn) {
            die("Cannot connect: " . mysqli_connect_error());
        }
    }
    public function loginUser($email, $passwd)
    {
        $this->connectivity();
        session_start();
        $sql = "SELECT * FROM users WHERE email='$email' AND password= '$passwd'";
        $result = mysqli_query($this->conn, $sql);
        if (mysqli_num_rows($result) === 1) {
            $record = mysqli_fetch_assoc($result);
            if ($record['email'] === $email && $record['password'] === $passwd) {
                $_SESSION['email'] = $record['email'];
                $_SESSION['password'] = $record['password'];
                return header("Location: index.php");
            } else {
                return header("Location: login.php?error=Incorrect username or password");
            }
        } else {
            return header("Location: login.php?error=Incorrect username or password");
        }
    }
    public function saveEmployees($employeeObj)
    {
        $this->connectivity();
        $seq = $employeeObj->getSeq();
        $name = $employeeObj->getName();
        $dateOfBirth = $employeeObj->getDateOfBirth();
        $dateOfJoining = $employeeObj->getDateOfJoining();
        $address = $employeeObj->getAddress();
        $gender = $employeeObj->getGender();
        $localResidence = $employeeObj->getLocalResidence();
        $accountCreated = $employeeObj->getAccountCreated();
        $deptSeq = $employeeObj->getDeptSeq();
        if ($seq == 0) {
            $sql = "INSERT INTO `employees`(`name`, `date_of_birth`, `date_of_joining`, `address`, `gender`, `local_residence`, `created_on`, `dept_seq`)
            VALUES ('$name', '$dateOfBirth', '$dateOfJoining', '$address', '$gender', '$localResidence', '$accountCreated', '$deptSeq')";
            if (mysqli_query($this->conn, $sql)) {
                return "New employee record saved successfully.";
            } else {
                return "Insertion failed: " . mysqli_error($this->conn);
            }
        } else {
            $name = $employeeObj->getName();
            $dateOfBirth = $employeeObj->getDateOfBirth();
            $dateOfJoining = $employeeObj->getDateOfJoining();
            $address = $employeeObj->getAddress();
            $gender = $employeeObj->getGender();
            $localResidence = $employeeObj->getLocalResidence();
            $accountCreated = $employeeObj->getAccountCreated();
            $deptSeq = $employeeObj->getDeptSeq();
            $sql = "UPDATE `employees` SET `name`= '$name',`date_of_birth`= '$dateOfBirth',`date_of_joining`= '$dateOfJoining',`address`= '$address',`gender`= '$gender',`local_residence`= $localResidence,`created_on`= '$accountCreated',`dept_seq`=$deptSeq WHERE `seq`= $seq";
            $result = mysqli_query($this->conn, $sql);
            if ($result) {
                return "Record Updated";
            } else {
                return "Could not update record!";
            }
        }
    }
    public function saveDepartment($departmentObj)
    {
        $this->connectivity();
        $deptName = $departmentObj->getDeptName();
        $deptDetails = $departmentObj->getDeptDetails();
        $sqlDept = "INSERT INTO `department` (`dept_name`, `dept_details`)
                VALUES ('$deptName', '$deptDetails')";
        if (mysqli_query($this->conn, $sqlDept)) {
            return "New department record saved successfully successfully.";
        } else {
            return mysqli_error($this->conn);
        }
    }
    public function saveSalary($salary)
    {
        $this->connectivity();
        $empSeq = $salary->getEmpSeq();
        $month = $salary->getMonth();
        $year = $salary->getYear();
        $empSal = $salary->getSalary();
        $dateOfPayment = $salary->getDateOfPayment();
        $sql = "INSERT INTO `Salary`(`emp_seq`, `month`, `year`, `salary`, `date_of_payment`) 
            VALUES ('$empSeq', '$month', '$year', '$empSal', '$dateOfPayment')";
        if (mysqli_query($this->conn, $sql)) {
            return "Salary record saved!";
        } else {
            return mysqli_error($this->conn);
        }
    }
    public function getSalariesByEmp($empSeq)
    {
        $this->connectivity();
        $sql_join = "SELECT employees.name, department.dept_name, salary.month, salary.year, salary.salary, salary.date_of_payment
        FROM employees
        INNER JOIN salary
        ON employees.seq =  salary.emp_seq
        INNER JOIN department
        ON employees.dept_seq= department.seq
        WHERE employees.seq= $empSeq";
        $result = mysqli_query($this->conn, $sql_join);
        return $result;
    }
    public function deptDropDown()
    {
        $this->connectivity();
        $sql = "Select * from `department`";
        $departments = mysqli_query($this->conn, $sql);
        return $departments;
    }
    public function empDropDown()
    {
        $this->connectivity();
        $sql = "SELECT * FROM `employees`";
        $employees = mysqli_query($this->conn, $sql);
        return $employees;
    }
    public function getEmpBySeq($seq)
    {
        $this->connectivity();
        $sql = "SELECT * FROM `employees` WHERE `seq`= $seq";
        $emp = mysqli_query($this->conn, $sql);
        $emp = mysqli_fetch_array($emp);
        return $emp;
    }
    public function delEmpBySeq($seq)
    {
        $this->connectivity();
        $sql = "DELETE FROM `employees` WHERE `seq`= $seq";
        if (mysqli_query($this->conn, $sql)) {
            return "Record Deleted";
        } else {
            return mysqli_error($this->conn);
        }
    }
    public function pagination($limit, $offset, $searchString)
    {
        $this->connectivity();
        $sql = "SELECT department.seq, employees.seq as employeeseq, employees.name, employees.date_of_birth, employees.date_of_joining, employees.address, employees.gender, employees.local_residence, employees.created_on, department.dept_name
            FROM employees
            LEFT JOIN department
            ON department.seq = employees.dept_seq";
        if (!empty($searchString)) {
            $sql .= " WHERE employees.name LIKE '%" . $searchString . "%'";
        }
        $sql .= " ORDER BY employees.seq
            LIMIT $limit OFFSET $offset";
        $page = mysqli_query($this->conn, $sql);
        $employees = array();
        while ($row = mysqli_fetch_assoc($page)) {
            array_push($employees, $row);
        }
        return $employees;
    }
    public function totalPages($limit, $searchString)
    {
        $this->connectivity();
        $sql = "SELECT COUNT(`name`)
            FROM `employees`";
        if (!empty($searchString)) {
            $sql .= " WHERE `name` LIKE '%" . $searchString . "%'";
        }
        $resultObj = mysqli_query($this->conn, $sql);
        $resultArray = mysqli_fetch_array($resultObj);
        $totalRecords = $resultArray[COUNT(`name`)];
        $totalPages = ceil($totalRecords / $limit);
        return $totalPages;
    }
    public function exportData()
    {
        $this->connectivity();
        $sql = "SELECT department.seq, employees.seq as employeeseq, employees.name, employees.date_of_birth, employees.date_of_joining, employees.address, employees.gender, employees.local_residence, employees.created_on, department.dept_name
            FROM employees
            LEFT JOIN department
            ON department.seq = employees.dept_seq
            ORDER BY employees.seq";
        if (!$result = mysqli_query($this->conn, $sql)) {
            exit(mysqli_error($this->conn));
        }
        $employees = array();
        if (mysqli_num_rows($result) > 0) {
            while ($row = mysqli_fetch_assoc($result)) {
                $employees[] = $row;
            }
        }
        $file = fopen('php://output', 'w');
        fputcsv($file, array('Department sr no.', 'Employee sr no.', 'Employee Name', 'Date of Birth', 'Date of Joining', 'Address', 'Gender', 'Local Residence', 'Created On', 'Department Name'));
        if (count($employees) > 0) {
            foreach ($employees as $row) {
                fputcsv($file, $row);
            }
        }
        fclose($file);
        header('Content-Description: File Transfer');
        header('Content-Type: text/csv; charset=utf-8');
        header('Content-Disposition: attachment; filename= "EmployeeDetails.csv"');
    }
}