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

    <div class="header text-white">
 <h1 class="text-center">Administrator Access Control</h1>
</div>
<div class="content" id="det">
 <h2 class="mb-4 text-center my-4">Alexandria University</h2>
<div>
    <div>
<table class="table">
    <thead>
      <tr>
        <th class="text-center">Faculty</th>
        <th class="text-center">Departments</th>
        <th class="text-center">View</th>
      </tr>
    </thead>
    <?php
      $sql="SELECT f.facultyFirstName, count(d.departmentName), f.facultyID 
      from faculty f Inner join department d 
      on f.facultyID = d.facultyID
      group by f.facultyFirstName;";
      $result=$con-> query($sql);
      if ($result-> num_rows > 0){
        while ($row=$result-> fetch_assoc()) {
    ?>
    <tr>
      <td class="text-center"><?=$row["facultyFirstName"]?></td>
      <td class="text-center"><?=$row["count(d.departmentName)"]?></td>
      <td class="text-center"><form action="AdmDepartments.php" method='GET'><button type="submit" class="btn btn-danger" value="<?= $row["facultyFirstName"] ?>" name="FacultyName">View</button><input type="hidden" value="<?= $row["facultyID"] ?>" name="FacultyID"></form></td> 
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
  <p><a  href="signUp.php"><button class="btn btn-primary" > Create Account</button></a></p>
</div>
</body>
</html>