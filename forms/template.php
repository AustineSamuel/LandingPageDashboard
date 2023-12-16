<?php
require "../connection.php";
// Registration File (inserts a default admin)
$error=false;
$success=false;

// Login File
if ($_SERVER['REQUEST_METHOD']) {
 
}
// HTML Form
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Login to dashboard</title>
  <link rel="stylesheet" href="../login/style.css">
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

    <div class="switch"><a href="#">Request for password </a></div>
  </div>
  <script  src="./script.js"></script>
</body>
</html>
