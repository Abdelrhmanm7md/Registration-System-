<?php
//include auth_session.php file on all user panel pages
include("auth_session.php");
require('db_conn.php');
$studentID = $_GET['studentID'];


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
</style>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
</head>
<body>

<div class="header">
 <h1>Admin View <?php echo $_GET['studentFirstName']?></h1>
</div>

<div style="display: flex; justify-content: center">

<div class="nav">
 <a><button onclick="changeSection('det')">Details</button> </a>
</div>
</div>
<div class="content" id="det">
 <h2 class="mb-4">Details</h2>
  <?php
        $query    = "SELECT * FROM student WHERE studentID  ='$studentID' ";

$result = mysqli_query($con, $query) ;
$rows = mysqli_num_rows($result);
$studentInfo = $result -> fetch_assoc();

?>
<div>
 <?php $studentAddress = $studentInfo['studentAddress']; ?>
 <?php $studentDOB = $studentInfo['studentDOB']; ?>
 <?php $GPA = $studentInfo['GPA']; ?>
 <?php
  $facultyID = $studentInfo['facultyID'];
        $query    = "SELECT * FROM faculty WHERE facultyID ='$facultyID' ";

$result = mysqli_query($con, $query) ;
mysqli_num_rows($result);
$facultyInfo = $result -> fetch_assoc();
?>
<?php
  $departmentID  = $studentInfo['departmentID'];
  
  $query    = "SELECT * FROM department WHERE departmentID  ='$departmentID' ";
  $facQuery = "SELECT * FROM faculty";
  $depQuery = "SELECT * FROM department WHERE facultyID ='$facultyID' ";


$result = mysqli_query($con, $query) ;
mysqli_num_rows($result);
$faculties = $result -> fetch_assoc();

$result = mysqli_query($con, $facQuery) ;
mysqli_num_rows($result);
$faculties = $result -> fetch_all(MYSQLI_ASSOC);

$result = mysqli_query($con, $depQuery) ;
mysqli_num_rows($result);
$departments = $result -> fetch_all(MYSQLI_ASSOC);

?>
<form style="display: flex; flex-direction: column" action="stuDetailsEdit.php?studentID=<?php echo $studentID ?>" id="upsubmission" method="post">
<div style="white-space:nowrap">
  <label for="fname">First name:</label>
  <input name="studentFirstName" value="<?php echo $studentInfo['studentFirstName']?>" />
</div>
<div style="white-space:nowrap">
  <label for="lname">Last name:</label>
  <input name="studentLastName" value="<?php echo $studentInfo['studentLastName']?>" />
  </div>
  <div style="white-space:nowrap">
  <label for="dob">Date of Birth:</label>
  <input name="studentDOB" type="date" value="<?php echo $studentInfo['studentDOB']?>" />
  </div>
  <div style="white-space:nowrap">
  <label for="dob">Address:</label>
  <input name="studentAddress" value="<?php echo $studentInfo['studentAddress']?>" />
  </div>
  <div style="white-space:nowrap">
  <label for="email">Email:</label>
  <input name="studentEmail" value="<?php echo $studentInfo['studentEmail']?>" />
  </div>
  <p> Faculty  : <?= $facultyInfo['facultyFirstName']  ?>  </p>
    <div style="white-space:nowrap">
    <label for="department">Department:</label>
    <select name="departmentID" value="<?php echo  $depInfo['departmentID']?>">
    <?php
      foreach ($departments as $department) {
        echo "<option value='{$department['departmentID']}'>{$department['departmentName']}</option>";
      }
      ?>
    </select>
  </div>
  <div style="white-space:nowrap">
    <label for="gpa">GPA:</label>
  <input name="GPA" value="<?php echo $studentInfo['GPA']?>" />
  </div>
  <div>
  <button  type="submit">Submit</button>
    </div>
</form>



 </div>
</div>
<div>
  <p><a href="logout.php"><button> Logout </button></a></p>
</div>
<script>
  const facultySelect = document.getElementById("faculty")
  facultySelect.addEventListener("change", (e) => {

  })
    </script>
</body>
</html>



  <!--
  <div style="white-space:nowrap">
    <label for="faculty">Faculty:</label>
    <select id="faculty" value="<?php echo $facultyInfo['facultyID']?>">
    <?php
      foreach ($faculties as $faculty) {
        echo "<option value='{$faculty['facultyID']}'>{$faculty['facultyFirstName']}</option>";
      }
      ?>
    </select>
  </div>
    -->