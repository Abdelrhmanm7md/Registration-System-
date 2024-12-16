<?php
require('db_conn.php');

$studentID = $_GET['studentID'];
$courseCode = $_GET['courseCode'];
if($_GET['action']== 'register'){
    $sql="UPDATE enrollment  SET  enrollmentStatus = 'Registered' 
    where classID in (Select classID from class where courseCode = '$courseCode');";
      $result=$con-> query($sql);
      header("Location: home_stu.php");
    }
elseif($_GET['action']== 'delete'){
    $sql="UPDATE enrollment  SET  enrollmentStatus = 'NOT Registered'
    where classID in (Select classID from class where courseCode = '$courseCode');";
      $result=$con-> query($sql);
      header("Location: home_stu.php");
    }



?>