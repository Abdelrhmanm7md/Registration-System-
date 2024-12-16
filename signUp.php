<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign Up</title>
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
        h2{
            text-align: center;
        }
    </style>
  </head>
<body>
    <div class="signup-form">
        <h1>ALEXANDRIA UNIVERSITY</h1>
        <h2>Sign Up </h2>
            <!-- <input type="text" class="login-input" name="Email" placeholder="Email" autofocus="true" required>
            <input type="password" class="login-input" name="Password" placeholder="Password" required>
            <br> -->
            <div class="form-check form-check-inline">
  <input class="form-check-input" type="radio" name="usertype" id="usertype_0" value="1">
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
<button id="redirectButton" class="btn btn-primary">Sign Up</button>

<script>
  document.getElementById('redirectButton').addEventListener('click', function () {
    // Get the selected radio button value
    const selectedType = document.querySelector('input[name="usertype"]:checked').value;

    // Define redirection logic
    let redirectUrl = '';
    switch (selectedType) {
      case '1':
        redirectUrl = 'adminSignUp.php';
        break;
      case '2':
        redirectUrl = 'studentSignUp.php';
        break;
      case '3':
        redirectUrl = 'staffSignUp.php';
        break;
      default:
        alert('Please select a valid user type!');
        return;
    }

    // Redirect to the selected page
    window.location.href = redirectUrl;
  });
</script>
    </div>

</body>
</html>
