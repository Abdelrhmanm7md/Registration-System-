<?php
require('db_conn.php');

$studentID = $_GET["studentID"];
$studentFName = $_POST['studentFirstName'];
$studentLName = $_POST['studentLastName'];
$studentdob= $_POST['studentDOB'];
$studentAdd =$_POST['studentAddress'];
$studentmail =$_POST['studentEmail'];
$studentdep =$_POST['departmentID'];
$studentgpa =$_POST['GPA'];

$query = "UPDATE student SET studentFirstName = '$studentFName',
studentLastName = '$studentLName',
studentDOB = '$studentdob',
studentAddress = '$studentAdd',
studentEmail = '$studentmail',
departmentID = '$studentdep',
GPA = '$studentgpa'
where studentID = '$studentID'";

$result= $con-> query($query);

header("Location: AdmStuView.php?studentFirstName=$studentFName&studentID=$studentID");

/*
$query = "UPDATE student SET studentFirstName = '$_POST['studentFirstName']',
studentLastName = '$_POST['studentLastName']',
studentDOB = '$_POST['studentDOB']',
studentAddress = '$_POST['studentAddress']',
studentEmail = '$_POST['studentEmail']',
departmentID = '$_POST['departmentID']',
GPA = '$_POST['GPA']' where studentID = '$studentID';"
*/

?>

