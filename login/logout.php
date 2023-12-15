<?php
session_start();
echo "please wait";
if(isset($_SESSION['isLogIn'])){
    session_unset();
    echo "please wait";
    header("Location: /login/");
}