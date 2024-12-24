<?php
//include auth_session.php file on all user panel pages
include("auth_session.php");
require('db_conn.php');


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
  box-shadow: 10px 6px 10px rgba(0, 0, 0, 0.3);
}
</style>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
</head>
<body>

<div class="header">
 <h1 class="text-white">Staff</h1>
</div>

<div style="display: flex; justify-content: center">

<div class="nav d-flex wrap">
 <a><button class="btn btn-primary" onclick="changeSection('det')">Details</button> </a>
 <a><button class="btn btn-primary" onclick="changeSection('tt')">Time Table</button></a>
</div>
</div>
<div class="content" id="det">
<div class="details p-3">
<h2 class="mb-4">Details</h2>

 <?php $instructorFname = $_SESSION['instructorFname']; ?>

 <p>Full Name  : <?php echo $_SESSION['instructorFname'] ?> </p>

 <p>Rank  : <?php echo   $_SESSION['instructorRank'];?>  </p>
 

 <p>Email  : <?php echo   $_SESSION['instructorEmail'];?>  </p>
 <?php
 $facultyID = $_SESSION['facultyID'];
        $query    = "SELECT * FROM faculty WHERE facultyID ='$facultyID' ";

$result = mysqli_query($con, $query) ;
$rows = mysqli_num_rows($result);
$facultyInfo = $result -> fetch_assoc();

?>

 <p> Faculty  : <?= $facultyInfo['facultyFirstName']  ?>  </p>


</div>
</div>
<div class="content d-none" id="tt">
 <h2>Time Table</h2>
<div>
<table class="table">
    <thead>
      <tr>
      <th class="text-center">Course</th>
        <th class="text-center">Day</th>
        <th class="text-center">Time</th>
        <th class="text-center">Class</th>
        <th class="text-center">Room Location</th>

      </tr>
    </thead>
    <?php
       $instructorID  = $_SESSION['instructorID'];
      $sql="SELECT 
      c.courseTitle,  r.roomLocation , sc.scheduleDay ,sc.scheduleTime ,class.classType
     FROM instructor i  
     INNER JOIN class ON i.instructorID = class.instructorID AND i.instructorID = '$instructorID'
     INNER JOIN courses c ON class.courseCode = c.courseCode
     INNER JOIN room r
     INNER JOIN schedule sc ON sc.roomID = r.roomID AND sc.classID = class.classID
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

      </tr>
      <?php
          }
        }
      ?>
  </table>
 </div>
</div>
<div class="content d-none" id="reg">
 <h2>Academic Registration</h2>
<div>
<table class="table">
    <thead>
      <tr>
        <th class="text-center">Code</th>
        <th class="text-center">Name</th>
        <th class="text-center">Credits</th>
        <th class="text-center">Level</th>
        <th class="text-center">Status</th>

        <th class="text-center" colspan="2">Action</th>
      </tr>
    </thead>
    <?php
    $studentID = $_SESSION['studentID'];
      $sql="SELECT s.studentID, c.courseCode, c.courseTitle, c.courseCredits, c.courseLevel , e.enrollmentStatus, class.courseCode FROM student s INNER JOIN Enrollment e ON s.studentID = e.studentID AND e.studentID = '$studentID' INNER JOIN class ON e.classID = class.classID INNER JOIN courses c ON class.courseCode = c.courseCode";
      $result=$con-> query($sql);
      if ($result-> num_rows > 0){
        while ($row=$result-> fetch_assoc()) {
    ?>
    <tr>
      <td class="text-center"><?=$row["courseCode"]?></td>
      <td class="text-center"><?=$row["courseTitle"]?></td>
      <td class="text-center"><?=$row["courseCredits"]?></td>      
      <td class="text-center"><?=$row["courseLevel"]?></td>     
 
      </tr>
      <?php
          }
        }
      ?>
  </table>
 </div>
</div>




<div class="p-2">
  <p><a  href="contact.php"><button class="btn btn-primary"> Contact Us - Support</button></a></p>
</div>
<div class="p-2">
  <p><a  href="logout.php"><button class="btn btn-primary"> Logout</button></a></p>
</div>
<script> 
let det = document.getElementById("det");
let tt = document.getElementById("tt");
let reg = document.getElementById("reg");


function changeSection(section) {
  switch (section) {
    case "det":
      det.classList.add("d-block");
      tt.classList.add("d-none");
      reg.classList.add("d-none");
      tt.classList.remove("d-block");
      reg.classList.remove("d-block");
      break;

    case "tt":
      det.classList.add("d-none");
      tt.classList.add("d-block");
      reg.classList.add("d-none");
      det.classList.remove("d-block");
      reg.classList.remove("d-block");
      break;

    case "reg":
      det.classList.add("d-none");
      tt.classList.add("d-none");
      reg.classList.add("d-block");
      det.classList.remove("d-block");
      tt.classList.remove("d-block");

      break;


  }
}
</script>
</body>
</html>



