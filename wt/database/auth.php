<?php
// This file is just for old support
// Main login and sign up is in login.php and register.php
session_start();
include 'dbconnect.php';

// send old requests to new pages
if (isset($_POST['login'])) {
    header("Location: ../login.php");
    exit();
}

if (isset($_POST['register'])) {
    header("Location: ../register.php");
    exit();
}

// log out
if (isset($_GET['logout'])) {
    session_destroy();
    header("Location: ../index.php");
    exit();
}
?>
