<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>University Login </title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            margin: 0;
            padding: 0;
            display: flex;
            align-items: center;
            justify-content: center;
            height: 100vh;
            background-color: #f1f1f1;
        }

        .container {
            background-color: #fff;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            overflow: hidden;
            width: 400px;
            max-width: 100%;
            height: 48vh;

        }

        .tab {
            display: flex;
            justify-content: space-around;
            background-color: #3498db;
            padding: 15px;
            color: #fff;
            font-weight: bold;
            text-align: center;
        }

        .tab a {
            text-decoration: none;
            color: #fff;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        .tab a:hover {
            background-color: #297fb8;
        }

        .form-wrap {
            padding: 20px;
        }

        input[type="text"],
        input[type="password"] {
            width: 100%;
            padding: 10px;
            margin: 8px 0;
            display: inline-block;
            border: 1px solid #ccc;
            box-sizing: border-box;
            border-radius: 5px;
        }

        input[type="submit"] {
            background-color: #3498db;
            color: #fff;
            padding: 10px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            width: 100%;
        }

        input[type="submit"]:hover {
            background-color: #297fb8;
        }

        .message {
            margin-top: 15px;
            text-align: center;
            color: #555;
        }
    </style>
</head>
<body>
<?php
    require('db_conn.php');
    session_start();
    // When form submitted, check and create user session.
    if (isset($_POST['submit'])) {
        $Email = stripslashes($_REQUEST['Email']);    
        $Email = mysqli_real_escape_string($con, $Email);
        $Password = stripslashes($_REQUEST['Password']);
        $Password = mysqli_real_escape_string($con, $Password);
        $_SESSION['Email'] = $Email;
        $_SESSION['Password'] =$Password ;
        if ($_POST['usertype']== '2')
        {
        $query    = "SELECT * FROM student WHERE studentEmail='$Email'
                     AND studentPassword='$Password' ";
                             $result = mysqli_query($con, $query) ;
                             $rows = mysqli_num_rows($result);
                             $studInfo = $result -> fetch_assoc();
                     
                             if ($rows == 1) {
                                 $_SESSION['studentEmail'] = $Email;
                                 $_SESSION['studentPassword'] =$Password ;
                                 $_SESSION['studentFirstName'] =$studInfo['studentFirstName'] ;
                                 $_SESSION['studentLastName'] =$studInfo['studentLastName'] ;
                                 $_SESSION['studentID'] =$studInfo['studentID'] ;
                                 $_SESSION['studentAddress'] =$studInfo['studentAddress'] ;
                                 $_SESSION['studentDOB'] =$studInfo['studentDOB'] ;
                                 $_SESSION['GPA'] =$studInfo['GPA'] ;
                                 $_SESSION['facultyID'] =$studInfo['facultyID'] ;
                                 $_SESSION['departmentID'] =$studInfo['departmentID'] ;
                                 header("Location: home_stu.php");
                     
                     
                                 
                             } else {
                                 echo "<div class='form'>
                                       <h3>Incorrect email/password.</h3><br/>
                                       <p class='link'>Click here to <a href='logg.php'>Login</a> again.</p>
                                       </div>";
                             }
                                

        }
        // 1 --> admin
        elseif ($_POST['usertype']== '1')
        {
        $query    = "SELECT * FROM administrator WHERE adminEmail='$Email'
                     AND adminPassword='$Password' ";
                             $result = mysqli_query($con, $query) ;
                             $rows = mysqli_num_rows($result);
                             $studInfo = $result -> fetch_assoc();
                     
                             if ($rows == 1) {
                                 $_SESSION['adminEmail'] = $adminEmail;
                                 $_SESSION['adminPassword'] =$adminPassword ;


                                 header("Location: AdmFaculty.php");

                                 
                             } else {
                                 echo "<div class='form'>
                                       <h3>Incorrect email/password.</h3><br/>
                                       <p class='link'>Click here to <a href='logg.php'>Login</a> again.</p>
                                       </div>";
                             }

        }
        elseif ($_POST['usertype']== '3')
        {
        $query    = "SELECT * FROM instructor WHERE instructorEmail='$Email'
                     AND instructorPassword='$Password' ";
                             $result = mysqli_query($con, $query) ;
                             $rows = mysqli_num_rows($result);
                             $studInfo = $result -> fetch_assoc();
                     
                             if ($rows == 1) {
                                 $_SESSION['instructorEmail'] = $instructorEmail;
                                 $_SESSION['instructorPassword'] =$instructorPassword ;
                                 $_SESSION['instructorFname'] =$studInfo['instructorFname'] ;
                                 $_SESSION['instructorRank'] =$studInfo['instructorRank'] ;
                                 $_SESSION['instructorEmail'] =$studInfo['instructorEmail'] ;
                                 $_SESSION['instructorID'] =$studInfo['instructorID'] ;
                                 $_SESSION['facultyID'] =$studInfo['facultyID'] ;


                                 header("Location: home_inst.php");

                                 
                             } else {
                                 echo "<div class='form'>
                                       <h3>Incorrect email/password.</h3><br/>
                                       <p class='link'>Click here to <a href='logg.php'>Login</a> again.</p>
                                       </div>";
                             }

        }

    } else {
?>
  <div class="container">
    <div class="tab">
        <a href="#" onclick="showLogin()">ALEXANDRIA UNIVERSITY </a>
    </div>
    <div class="form-wrap" id="login">
        <h2>Welcome back,</h2>
        <form action="<?= htmlspecialchars($_SERVER['PHP_SELF']);?>" method="post">
            <input type="text" class="login-input" name="Email" placeholder="Email" autofocus="true" required>
            <input type="password" class="login-input" name="Password" placeholder="Password" required>
            <br>
            <div class="optionsLogin" style="width:105%;display:grid;grid-template-columns:repeat(3, 1fr);">
            <div class="form-check form-check-inline">
                      <input class="form-check-input" type="radio" name="usertype" id="usertype_0" value="1" >
                      <label class="form-check-label" for="usertype_0">Admin</label>
                    </div>
                    <div class="form-check form-check-inline">
                      <input class="form-check-input" type="radio" name="usertype" id="usertype_2" value="3">
                      <label class="form-check-label" for="usertype_2">Staff</label>
                    </div>
                    
                    <div class="form-check form-check-inline">
                      <input class="form-check-input" type="radio" name="usertype" id="usertype_1" value="2" checked="checked">
                      <label class="form-check-label" for="usertype_1">Student</label>
                    </div>
                    <br>
            </div>
            <input type="submit" value="submit" name="submit" class="login-button"/>
            <br>
        </form>
    </div>
   





<?php
    }
?>
</body>
</html>