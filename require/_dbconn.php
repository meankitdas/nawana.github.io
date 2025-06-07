<?php

$servername = "localhost";
$username = "root";
$password = "";
$database = "forum";

// First connect without selecting a database
$conn = mysqli_connect($servername, $username, $password);

// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// Check if database exists, create if it doesn't
$result = mysqli_query($conn, "SELECT SCHEMA_NAME FROM INFORMATION_SCHEMA.SCHEMATA WHERE SCHEMA_NAME = '$database'");
if (mysqli_num_rows($result) == 0) {
    // Create database
    if (!mysqli_query($conn, "CREATE DATABASE IF NOT EXISTS $database")) {
        die("Error creating database: " . mysqli_error($conn));
    }
}

// Select the database
if (!mysqli_select_db($conn, $database)) {
    die("Error selecting database: " . mysqli_error($conn));
}

// Enable error reporting for debugging
error_reporting(E_ALL);
ini_set('display_errors', 1);

?>
