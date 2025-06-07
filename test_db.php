<?php
// Enable error reporting
error_reporting(E_ALL);
ini_set('display_errors', 1);

echo "<h1>Database Connection Test</h1>";

// Include database connection
require 'require/_dbconn.php';

if ($conn) {
    echo "<p style='color: green;'>✓ Database connection successful</p>";
    
    // Check if forum database exists
    $result = mysqli_query($conn, "SELECT SCHEMA_NAME FROM INFORMATION_SCHEMA.SCHEMATA WHERE SCHEMA_NAME = 'forum'");
    if (mysqli_num_rows($result) > 0) {
        echo "<p style='color: green;'>✓ Database 'forum' exists</p>";
    } else {
        echo "<p style='color: red;'>✗ Database 'forum' does not exist</p>";
        echo "<p>Creating database 'forum'...</p>";
        
        // Create database
        if (mysqli_query($conn, "CREATE DATABASE IF NOT EXISTS forum")) {
            echo "<p style='color: green;'>✓ Database 'forum' created successfully</p>";
            
            // Select the database
            mysqli_select_db($conn, 'forum');
        } else {
            echo "<p style='color: red;'>✗ Error creating database: " . mysqli_error($conn) . "</p>";
        }
    }
    
    // Check if user table exists
    $result = mysqli_query($conn, "SHOW TABLES LIKE 'user'");
    if (mysqli_num_rows($result) > 0) {
        echo "<p style='color: green;'>✓ Table 'user' exists</p>";
        
        // Check table structure
        $result = mysqli_query($conn, "DESCRIBE `user`");
        echo "<h3>User Table Structure:</h3>";
        echo "<table border='1'><tr><th>Field</th><th>Type</th><th>Null</th><th>Key</th><th>Default</th><th>Extra</th></tr>";
        while ($row = mysqli_fetch_assoc($result)) {
            echo "<tr>";
            echo "<td>" . $row['Field'] . "</td>";
            echo "<td>" . $row['Type'] . "</td>";
            echo "<td>" . $row['Null'] . "</td>";
            echo "<td>" . $row['Key'] . "</td>";
            echo "<td>" . $row['Default'] . "</td>";
            echo "<td>" . $row['Extra'] . "</td>";
            echo "</tr>";
        }
        echo "</table>";
    } else {
        echo "<p style='color: red;'>✗ Table 'user' does not exist</p>";
        echo "<p>Creating table 'user'...</p>";
        
        // Create user table
        $sql = "CREATE TABLE `user` (
            `user_id` INT AUTO_INCREMENT PRIMARY KEY,
            `email` VARCHAR(255) NOT NULL,
            `password` VARCHAR(255) NOT NULL,
            `date & time` TIMESTAMP DEFAULT CURRENT_TIMESTAMP
        )";
        
        if (mysqli_query($conn, $sql)) {
            echo "<p style='color: green;'>✓ Table 'user' created successfully</p>";
        } else {
            echo "<p style='color: red;'>✗ Error creating table: " . mysqli_error($conn) . "</p>";
        }
    }
    
    // Test user creation
    echo "<h2>Test User Creation</h2>";
    echo "<form method='post' action='test_db.php'>";
    echo "<label for='email'>Email:</label>";
    echo "<input type='email' name='email' value='test@example.com' required><br><br>";
    echo "<label for='password'>Password:</label>";
    echo "<input type='password' name='password' value='password123' required><br><br>";
    echo "<input type='submit' name='create_user' value='Create Test User'>";
    echo "</form>";
    
    // Process form submission
    if (isset($_POST['create_user'])) {
        $email = $_POST['email'];
        $password = $_POST['password'];
        $hash = password_hash($password, PASSWORD_BCRYPT);
        
        // Check if user already exists
        $existsql = "SELECT * FROM `user` WHERE `email` LIKE '$email'";
        $result = mysqli_query($conn, $existsql);
        $num = mysqli_num_rows($result);
        
        if ($num == 1) {
            echo "<p style='color: orange;'>⚠ User with email '$email' already exists</p>";
        } else {
            // Insert user
            $sql = "INSERT INTO `user` (`email`, `password`) VALUES ('$email', '$hash')";
            if (mysqli_query($conn, $sql)) {
                echo "<p style='color: green;'>✓ Test user created successfully</p>";
                
                // Show all users
                $result = mysqli_query($conn, "SELECT * FROM `user`");
                echo "<h3>Users in Database:</h3>";
                echo "<table border='1'><tr><th>ID</th><th>Email</th><th>Date & Time</th></tr>";
                while ($row = mysqli_fetch_assoc($result)) {
                    echo "<tr>";
                    echo "<td>" . $row['user_id'] . "</td>";
                    echo "<td>" . $row['email'] . "</td>";
                    echo "<td>" . $row['date & time'] . "</td>";
                    echo "</tr>";
                }
                echo "</table>";
            } else {
                echo "<p style='color: red;'>✗ Error creating test user: " . mysqli_error($conn) . "</p>";
            }
        }
    }
    
} else {
    echo "<p style='color: red;'>✗ Database connection failed: " . mysqli_connect_error() . "</p>";
}

echo "<br><a href='index.php'>Back to Home</a>";
?>
