<?php
require "../connection.php";
// Registration File (inserts a default admin)
$error=false;
$success=false;

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['register'])) {
    $username = "AustineTest@Ganlaxmine.com";
    $password = password_hash("$$$9j@1", PASSWORD_DEFAULT);

    // Assuming you have a valid MySQLi connection
    $stmt = $GLOBALS['CONNECTION']->prepare("INSERT INTO admins (username, password) VALUES (?, ?)");
    
    if (!$stmt) {
        die("Error in prepare statement: " . $GLOBALS['CONNECTION']->error);
    }

    $stmt->bind_param("ss", $username, $password);

    if (!$stmt->execute()) {
        die("Error in execute: " . $stmt->error);
    }

    $success="Admin inserted successfully!";

    $stmt->close();
}

// Login File
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['login'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $stmt = $GLOBALS['CONNECTION']->prepare("SELECT id, username, password FROM admins WHERE username = ?");

    $stmt->bind_param("s", $username);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows > 0) {
        $stmt->bind_result($id, $dbUsername, $dbPassword);
        $stmt->fetch();

        if (password_verify($password, $dbPassword)) {
            $success="Login successful!";
            $_SESSION['isLogIn']=true;
            echo "<script>setTimeout(()=>{window.location.href='/'},1000)</script>";

            // You can set session variables here or redirect to the dashboard
        } else {
            $error="Invalid password!";
        }
    } else {
        $error="Username not found!";
    }

    $stmt->close();
}

// HTML Form
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Login to dashboard</title>
  <link rel="stylesheet" href="./style.css">
</head>
<body>
<div class="container">
  <div class="card">
    <h2>Login Form</h2>

    <?php 
    echo $success ? "<div class='alert alert-success'>
    <strong>Success!</strong> $success
</div>":"";

echo $error ? "<div class='alert alert-danger'>
    <strong>Error : </strong> $error
</div>":"";
?>
    <form method="post" action="">
      <label for="username">Username</label>
      <input type="text" name="username" id="username" placeholder="Enter your username" required>

      <label for="password">Password</label>
      <input type="password" name="password" id="password" placeholder="Enter your password" required>

      <button type="submit" name="login">Login</button>
    </form>
    <form method="post" action="">
      <br/>
      <button type="submit" name="register">Register Default Admin</button>
    </form>
    <div class="switch"><a href="#">Request for password </a></div>
  </div>
  <script  src="./script.js"></script>
</body>
</html>
