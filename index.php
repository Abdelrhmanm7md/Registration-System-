
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
    <form action="logg.php" method="post">
        <h2>Login</h2>
        <?php if (isset($_GET['error'])) { ?>
            <p class="error"><?php echo $_GET['error']; ?></p>
        <?php } ?>
        <label for="uname">User Name</label>
        <input type="text" id="uname" name="uname" placeholder="User Name" required><br>
        
        <label for="password">Password</label>
        <input type="password" id="password" name="password" placeholder="Password" required><br>
        
        <button type="submit">Login</button>
    </form>
</body>
</html>
