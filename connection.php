<?php
session_start();

$host = "localhost";
$username = "root";
$password = "";
$database = "LandingDashboard";

$GLOBALS['CONNECTION'] = new mysqli($host, $username, $password, $database);

if ($GLOBALS['CONNECTION']->connect_error) {
    die("Connection failed: " . $GLOBALS['CONNECTION']->connect_error);
}

// ... rest of the code ...
?>
