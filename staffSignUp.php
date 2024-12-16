<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Collect form data
    $instructorRank = $_POST['instructorRank'];
    $instructorID = $_POST['instructorID'];
    $facultyID = $_POST['facultyID'];
    $instructorFname = $_POST['instructorFname'];
    $instructorEmail = $_POST['instructorEmail'];
    $instructorPassword = password_hash($_POST['instructorPassword'], PASSWORD_DEFAULT); // Hashing the password for security

    // Database connection
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "systemm"; // Replace with your database name

    try {
        // Create a connection
        $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
        // Set the PDO error mode to exception
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        // Insert data into Instructor table
        $sql = "INSERT INTO Instructor (instructorRank, instructorID,facultyID, instructorFname, instructorEmail, instructorPassword) 
                VALUES (?, ?, ?, ?, ?,?)";
        $stmt = $conn->prepare($sql);
        $stmt->execute([$instructorRank, $instructorID,$facultyID, $instructorFname, $instructorEmail, $instructorPassword]);

        header("Location: logg.php");  // Redirect to a success page (e.g., login or dashboard)
        exit();
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }

    // Close connection
    $conn = null;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Instructor Sign-Up</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }

        .signup-container {
            width: 300px;
            margin: 100px auto;
            padding: 20px;
            background-color: #fff;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        h2 {
            text-align: center;
            margin-bottom: 20px;
        }

        form {
            display: flex;
            flex-direction: column;
        }

        label {
            margin-bottom: 5px;
        }

        input {
            padding: 8px;
            margin-bottom: 15px;
            border: 1px solid #ccc;
            border-radius: 4px;
        }

        button {
            padding: 10px;
            background-color: #4CAF50;
            color: #fff;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }

        button:hover {
            background-color: #45a049;
        }
    </style>
</head>
<body>

    <div class="signup-container">
        <h2>Instructor Sign-Up</h2>
        <form action="" method="POST">
            <label for="instructorRank">Instructor Rank:</label>
            <input type="text" id="instructorRank" name="instructorRank" required>

            <label for="instructorID">Instructor ID:</label>
            <input type="text" id="instructorID" name="instructorID" required>

            <label for="facultyID">Faculty ID:</label>
            <input type="text" id="facultyID" name="facultyID" required>

            <label for="instructorFname">First Name:</label>
            <input type="text" id="instructorFname" name="instructorFname" required>

            <label for="instructorEmail">Email:</label>
            <input type="email" id="instructorEmail" name="instructorEmail" required>

            <label for="instructorPassword">Password:</label>
            <input type="password" id="instructorPassword" name="instructorPassword" required>

            <button type="submit">Sign Up</button>
        </form>
    </div>

</body>
</html>