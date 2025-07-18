<?php
// Simple database connection for the project

$conn = mysqli_connect('localhost', 'root', '', 'etech_store');
if (!$conn) {
    die('Connection failed: ' . mysqli_connect_error());
}
?>

