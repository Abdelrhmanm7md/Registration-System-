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
        </style>
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    </head>
<body>

    <div class="header">
 <h1 class="text-white">Administrator Access Control</h1>
</div>
<div class="content" id="det">
 <h2 class="mb-4 text-center my-4"><?= $_GET['DepartmentName']?></h2>
<div>
    <div>
<table class="table">
    <thead>
      <tr>
        <th class="text-center">Name</th>
        <th class="text-center">Level</th>
        <th class="text-center">View</th>
      </tr>
    </thead>
    <?php
      $DepartmentID = $_GET['DepartmentID'];
      $sql="SELECT studentID , studentLevel ,studentFirstName, studentLastName
      from student
      where departmentID = '$DepartmentID'";
      $result=$con-> query($sql);
      if ($result-> num_rows > 0){
        while ($row=$result-> fetch_assoc()) {
    ?>
    <tr>
      <td class="text-center"><?=$row["studentFirstName"]." ".$row["studentLastName"]?></td>
      <td class="text-center"><?=$row["studentLevel"]?></td> 
      <td class="text-center"><form action="AdmStuView.php" method='GET'><button type="submit" class="btn btn-danger" value="<?= $row["studentFirstName"]?>" name="studentFirstName">View</button><input type="hidden" value="<?=$row['studentID']?>" name='studentID'></form></td> 
    </tr>
      <?php
          }
        }
      ?>
  </table>
 </div>
</div>
<div>
  <p><a  href="logout.php"><button class="btn btn-primary"> Logout</button></a></p>
</div>
</body>
</html>