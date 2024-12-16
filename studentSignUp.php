<?php
// Database connection details
$servername = "localhost";
$username = "root";
$passwordd = "";
$dbname = "systemm";

$message = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $firstName = $_POST['firstName'];
    $lastName = $_POST['lastName'];
    $email = $_POST['email'];
    $dob = $_POST['dob'];
    $address = $_POST['address'];
    $password = $_POST['password'];

    // Validate inputs
    if (empty($firstName) || empty($lastName) || empty($email) || empty($dob) || empty($address) || empty($password)) {
        $message = "All fields are required.";
    } else {
        // Hash the password
        $hashedPassword = password_hash($password, PASSWORD_BCRYPT);

        // Generate a unique studentID
        function generateUniqueID($min, $max, $conn) {
            do {
                $uniqueID = random_int($min, $max);

                $exists = 0;
                $stmt = $conn->prepare("SELECT COUNT(*) FROM Student WHERE studentID = ?");
                $stmt->bind_param("i", $uniqueID);
                $stmt->execute();
                $stmt->bind_result($exists);
                $stmt->fetch();
                $stmt->close();
            } while ($exists > 0);

            return $uniqueID;
        }

        // Connect to the database
        $conn = new mysqli($servername, $username, $passwordd, $dbname);

        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        $studentID = generateUniqueID(1000, 9999, $conn);

        // Prepare and bind the SQL statement
        $sql = "INSERT INTO Student (studentID, studentFirstName, studentLastName, studentEmail, studentDOB, studentAddress, studentPassword) 
                VALUES (?, ?, ?, ?, ?, ?, ?)";
        $stmt = $conn->prepare($sql);

        if (!$stmt) {
            die("SQL Error: " . $conn->error);
        }

        $stmt->bind_param("issssss", $studentID, $firstName, $lastName, $email, $dob, $address, $hashedPassword);

        if ($stmt->execute()) {
            header("Location: logg.php");  
            exit();
                } else {
            $message = "Error: " . $stmt->error;
        }

        $stmt->close();
        $conn->close();
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Sign-Up</title>
    <style>
        body { font-family: Arial, sans-serif; background-color: #f4f4f9; margin: 0; padding: 0; display: flex; justify-content: center; align-items: center; height: 100vh; }
        form { background: #fff; padding: 20px; border-radius: 5px; box-shadow: 0 0 10px rgba(0, 0, 0, 0.1); width: 100%; max-width: 400px; }
        input { width: 100%; padding: 10px; margin: 10px 0; border: 1px solid #ccc; border-radius: 4px; }
        button { width: 100%; padding: 10px; background: #28a745; color: #fff; border: none; border-radius: 4px; cursor: pointer; }
        button:hover { background: #218838; }
        .message { color: red; font-size: 14px; margin-bottom: 10px; }
        .success { color: green; }
    </style>
</head>
<body>
    <form method="POST" action="">
        <h2>Student Sign-Up</h2>
        <?php if (!empty($message)): ?>
            <div class="message <?= strpos($message, 'successful') !== false ? 'success' : '' ?>">
                <?= $message ?>
            </div>
        <?php endif; ?>
        <input type="text" name="firstName" placeholder="First Name" required>
        <input type="text" name="lastName" placeholder="Last Name" required>
        <input type="email" name="email" placeholder="Email" required>
        <input type="date" name="dob" placeholder="Date of Birth" required>
        <input type="text" name="address" placeholder="Address" required>
        <input type="password" name="password" placeholder="Password" required>
        <button type="submit">Sign Up</button>
    </form>
</body>
</html>
