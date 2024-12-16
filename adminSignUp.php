<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Sign Up</title>
    <style>
body {
 font-family: Arial, sans-serif;
}

.header {
 background-color:#3498db;
 padding: 10px;
 text-align: center;
 font-size: 25px;
 color: #333;
}
body {
    font-family: Arial, sans-serif;
    background-color: #f4f4f4;
    display: flex;
    justify-content: center;
    align-items: center;
    height: 100vh;
    margin: 0;
}

.signup-container {
    background-color: #fff;
    padding: 30px;
    border-radius: 8px;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    width: 400px;
}

h2 {
    text-align: center;
    margin-bottom: 20px;
}

label {
    display: block;
    margin-bottom: 8px;
    font-weight: bold;
}

input {
    width: 100%;
    padding: 10px;
    margin: 8px 0;
    border: 1px solid #ddd;
    border-radius: 4px;
}

button {
    width: 100%;
    padding: 10px;
    background-color: #4CAF50;
    color: white;
    border: none;
    border-radius: 4px;
    font-size: 16px;
    cursor: pointer;
}

button:hover {
    background-color: #45a049;
}

</style>
</head>

<body>


<?php
// Database connection
$host = "localhost";  
$user = "root";  
$password = '';  
$db_name = "systemm";  

$conn = mysqli_connect($host, $user, $password, $db_name);  

if(mysqli_connect_errno()) {  
    die("Failed to connect with MySQL: ". mysqli_connect_error());  
}  
?>
<div class="signup-container">
    <h2>Administrator Sign Up</h2>
    <form  method="POST">
        <label for="adminName">Admin Name:</label>
        <input type="text" id="adminName" name="adminName" required>

        <label for="adminEmail">Admin Email:</label>
        <input type="email" id="adminEmail" name="adminEmail" required>

        <label for="adminPassword">Admin Password:</label>
        <input type="password" id="adminPassword" name="adminPassword" required>

        <label for="administratorID">Administrator ID:</label>
        <input type="text" id="administratorID" name="administratorID" required>

        <label for="administratorPosition">Position:</label>
        <input type="text" id="administratorPosition" name="administratorPosition" required>

        <button type="submit">Sign Up</button>
    </form>
</div>

<?php
// Database connection
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get the form data
    $adminName = $_POST['adminName'];
    $adminEmail = $_POST['adminEmail'];
    $adminPassword = $_POST['adminPassword'];
    $administratorID = $_POST['administratorID'];
    $administratorPosition = $_POST['administratorPosition'];

    // Hash the password for secure storage

    // SQL query to insert data into the Administrator table
    $sql = "INSERT INTO Administrator (administratorPosition, administratorID, adminName, adminEmail, adminPassword) 
            VALUES ('$administratorPosition', '$administratorID', '$adminName', '$adminEmail', '$adminPassword')";

    // Execute the query and check if insertion is successful
    if ($conn->query($sql) === TRUE) {
        // Redirect to a success page or log in page after successful sign up
        header("Location: logg.php");  // Redirect to a success page (e.g., login or dashboard)
        exit();
    } else {
        // If there's an error with the query, display an error message
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

// Close the connection to the database
$conn->close();
?>


</body>
</html>