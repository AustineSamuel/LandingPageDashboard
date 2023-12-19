<?php
session_start();

$host = "localhost";
$username = "root";
$password = "";
$database = "LandingDashboard";
function RunOnLocalHost(){
    $whitelist = array('127.0.0.1', '::1',"192.168.43.99");
    return in_array($_SERVER['REMOTE_ADDR'], $whitelist);

}

if(!RunOnLocalHost()){
    $host = "localhost";
    $username = "id21691197_store";
    $password = "Ujjwal12**";
    $database = "id21691197_austinetest";
}
$GLOBALS['CONNECTION'] = new mysqli($host, $username, $password, $database);

if ($GLOBALS['CONNECTION']->connect_error) {
    die("Connection failed: " . $GLOBALS['CONNECTION']->connect_error);
}
require "func.php";

// ... rest of the code ...
?>
