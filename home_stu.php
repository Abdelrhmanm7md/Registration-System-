<?php
include("auth_session.php");
require('db_conn.php');
$studentID = $_SESSION['studentID'];


?>
<!DOCTYPE html>
<html>
<head>
<style>
body {
 font-family: Arial, sans-serif;
}

.header {
 background-color:#3498db;
 padding: 20px;
 text-align: center;
 font-size: 35px;
 color: #333;
}

.nav {
 margin: 20px 0;
}

.nav a {
 margin: 0 10px;
 color: #333;
 text-decoration: none;
}

.nav a:hover {
 background-color: #ddd;
 color: black;
}

.content {
 padding: 20px;
 font-size: 20px;
}
.details{
  box-shadow: 0 6px 8px 6px rgba(0, 0, 0, 0.2);
}
</style>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
</head>
<body>

<div class="header">
 <h1 class="text-white">Student Registration</h1>
</div>

<div style="display: flex; justify-content: center">

<div class="nav d-flex wrap">
 <a><button class="btn btn-primary mt-2" onclick="changeSection('det')">Details</button> </a>
 <a><button class="btn btn-primary mt-2" onclick="changeSection('reg')"> Academic Registration </button></a>
 <a><button class="btn btn-primary mt-2" onclick="changeSection('tt')">Time Table</button></a>
 <a><button class="btn btn-primary mt-2" onclick="changeSection('pay')">Payment</button></a>
</div>
</div>
<div class="content" id="det">

<div class="details p-3">
<h2 class="mb-4">Details</h2>
 <?php $studentAddress = $_SESSION['studentAddress']; ?>
 <?php $studentDOB = $_SESSION['studentDOB']; ?>
 <?php $GPA = $_SESSION['GPA']; ?>

 <p class="fs-3">Full Name  : <?php echo $_SESSION['studentFirstName'] ." " .$_SESSION['studentLastName']?> </p>

 <p  class="fs-3">Address  : <?php echo   $_SESSION['studentAddress'];?>  </p>
 
 <p class="fs-3">Date of Birth  : <?php echo   $_SESSION['studentDOB'];?>  </p>

 <p class="fs-3">Email  : <?php echo   $_SESSION['studentEmail'];?>  </p>
<?php
  $facultyID = $_SESSION['facultyID'];
        $query    = "SELECT * FROM faculty WHERE facultyID ='$facultyID' ";

$result = mysqli_query($con, $query) ;
$rows = mysqli_num_rows($result);
$facultyInfo = $result -> fetch_assoc();



?>

 <p> Faculty  : <?= $facultyInfo['facultyFirstName']  ?>  </p>

 <?php
  $departmentID  = $_SESSION['departmentID'];
        $query    = "SELECT * FROM department WHERE departmentID  ='$departmentID' ";

$result = mysqli_query($con, $query) ;
$rows = mysqli_num_rows($result);
$depInfo = $result -> fetch_assoc();



?>

 <p> Department  : <?=   $depInfo['departmentName'] ?>  </p>

 <p> Total GPA  : <?php echo   $_SESSION['GPA'];?>  </p>

 
 </div>
</div>
<div class="content d-none" id="tt">
 <h2 class="text-center my-4">Time Table</h2>
<div>
<table class="table">
    <thead>
      <tr>
        <th class="text-center">Course Name</th>
        <th class="text-center">Day</th>
        <th class="text-center">Time</th>
        <th class="text-center">Class</th>
        <th class="text-center">Room Location</th>
        <th class="text-center">Instructor</th>

      </tr>
    </thead>
    <?php
    $studentID = $_SESSION['studentID'];
      $sql="SELECT 
      s.studentID, c.courseTitle,  r.roomLocation , i.instructorFname , i.instructorRank , sc.scheduleDay ,sc.scheduleTime ,class.classType
      FROM student s 
      INNER JOIN Enrollment e ON s.studentID = e.studentID AND e.studentID = '$studentID' AND e.enrollmentStatus = 'Registered'
      INNER JOIN class ON e.classID = class.classID
      INNER JOIN courses c ON class.courseCode = c.courseCode
      INNER JOIN room r
      INNER JOIN schedule sc ON sc.roomID = r.roomID AND sc.classID = class.classID
      INNER JOIN instructor i ON class.instructorID  = i.instructorID  
      
     ";
      $result=$con-> query($sql);
      if ($result-> num_rows > 0){
        while ($row=$result-> fetch_assoc()) {
    ?>
    <tr>
      <td class="text-center"><?=$row["courseTitle"]?></td>
      <td class="text-center"><?=$row["scheduleDay"]?></td>
      <td class="text-center"><?=$row["scheduleTime"]?></td>      
      <td class="text-center"><?=$row["classType"]?></td>     
      <td class="text-center"><?=$row["roomLocation"]?></td>     
      <td class="text-center"><?=$row["instructorRank"] . " \\ ".$row["instructorFname"]?></td>     

      </tr>
      <?php
          }
        }
      ?>
  </table>
 </div>
</div>
<div class="content d-none" id="reg">
 <h2 class="text-center my-4">Academic Registration</h2>
<div>
<table class="table border-collapse">
    <thead>
      <tr>
        <th class="text-center">Name</th>
        <th class="text-center">Class type</th>
        <th class="text-center">Credits</th>
        <th class="text-center">Level</th>
        <th class="text-center">Status</th>
        <th class="text-center" colspan="2">Action</th>
      </tr>
    </thead>
    <?php
    $studentID = $_SESSION['studentID'];
      $sql="SELECT s.studentID, c.courseTitle,class.classType , c.courseCredits, c.courseLevel, e.enrollmentStatus, class.courseCode 
      FROM student s 
      INNER JOIN Enrollment e 
      ON s.studentID = e.studentID AND e.studentID = '$studentID' 
      INNER JOIN class 
      ON e.classID = class.classID 
      INNER JOIN courses c 
      ON class.courseCode = c.courseCode";
      $result=$con-> query($sql);
      if ($result-> num_rows > 0){
        while ($row=$result-> fetch_assoc()) {
          $courseCode = $row["courseCode"];
    ?>
    <tr>
      <td class="text-center"><?=$row["courseTitle"]?></td>
      <td class="text-center"><?=$row["classType"]?></td>
      <td class="text-center"><?=$row["courseCredits"]?></td>      
      <td class="text-center"><?=$row["courseLevel"]?></td>     
      <td class="text-center"><?=$row["enrollmentStatus"]?></td>     
    <?php if($row["enrollmentStatus"] != 'Registered'){ ?>
      <td class="text-center"> <a  href="addRemove.php?studentID=<?=$studentID?>&action=register&courseCode=<?=$courseCode?>"> <button  type="button" class="btn btn-primary ">Register</button></a></td> 
      <?php }else{?>    
      <td class="text-center"> <a  href="addRemove.php?studentID=<?=$studentID?>&action=delete&courseCode=<?=$courseCode?>"> <button type="button" class="btn btn-danger ">Delete</button></a></td>   
      <?php } ?>  
      </tr>
      <?php
          }
        }
      ?>
  </table>
 </div>
</div>

<div class="content d-none" id="pay">
 <h2>Payment</h2>
<div>
 <p><?php 
    $sql="SELECT p.paymentAmount
      FROM student s 
      INNER JOIN payment p ON s.studentID = p.studentID
      where s.studentID = '$studentID';";
    $result=$con-> query($sql);
      if ($result-> num_rows > 0){
        while ($row=$result-> fetch_assoc()) {
          $payment = $row["paymentAmount"];
        }
      }
    if ($payment >= 3000){

        echo 'Student Paid';

    }else{
        echo "Student on dept ". 3000 - $payment ." left";
    }
 ?> !</p>
 
 </div>
</div>


<div class="m-4 d-flex wrap">
  <p><a  href="contact.php"><button class="btn btn-primary"> Contact Us - Support</button></a></p>
</div>
<div class="m-4 d-flex wrap">
  <p><a  href="logout.php"><button class="btn btn-primary"> Logout</button></a></p>
</div>
<script> 
let det = document.getElementById("det");
let tt = document.getElementById("tt");
let reg = document.getElementById("reg");
let pay = document.getElementById("pay");

function changeSection(section) {
  switch (section) {
    case "det":
      det.classList.add("d-block");
      tt.classList.add("d-none");
      reg.classList.add("d-none");
      pay.classList.add("d-none");
      pay.classList.remove("d-block");
      tt.classList.remove("d-block");
      reg.classList.remove("d-block");
      break;

    case "tt":
      det.classList.add("d-none");
      tt.classList.add("d-block");
      reg.classList.add("d-none");
      pay.classList.add("d-none");
      det.classList.remove("d-block");
      reg.classList.remove("d-block");
      pay.classList.remove("d-block");
      break;

    case "reg":
      det.classList.add("d-none");
      tt.classList.add("d-none");
      reg.classList.add("d-block");
      pay.classList.add("d-none");
      det.classList.remove("d-block");
      tt.classList.remove("d-block");
      pay.classList.remove("d-block");
      break;

    case "pay":
      det.classList.add("d-none");
      tt.classList.add("d-none");
      reg.classList.add("d-none");
      pay.classList.add("d-block");
      det.classList.remove("d-block");
      tt.classList.remove("d-block");
      reg.classList.remove("d-block");
      break;
  }
}
</script>
</body>
</html>
