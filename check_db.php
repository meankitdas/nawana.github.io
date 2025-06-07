<?php
// Enable error reporting
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Include database connection
require 'require/_dbconn.php';

// Check if user table exists
$result = mysqli_query($conn, "SHOW TABLES LIKE 'user'");
if (mysqli_num_rows($result) == 0) {
    echo "Table 'user' does not exist!<br>";
    
    // Create user table
    $sql = "CREATE TABLE `user` (
        `user_id` INT AUTO_INCREMENT PRIMARY KEY,
        `email` VARCHAR(255) NOT NULL,
        `password` VARCHAR(255) NOT NULL,
        `date & time` TIMESTAMP DEFAULT CURRENT_TIMESTAMP
    )";
    
    if (mysqli_query($conn, $sql)) {
        echo "Table 'user' created successfully<br>";
    } else {
        echo "Error creating table: " . mysqli_error($conn) . "<br>";
    }
} else {
    echo "Table 'user' exists.<br>";
    
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
}

// Check if category table exists
$result = mysqli_query($conn, "SHOW TABLES LIKE 'category'");
if (mysqli_num_rows($result) == 0) {
    echo "<br>Table 'category' does not exist!<br>";
    
    // Create category table
    $sql = "CREATE TABLE `category` (
        `category_id` INT AUTO_INCREMENT PRIMARY KEY,
        `category_name` VARCHAR(255) NOT NULL,
        `category_desc` TEXT NOT NULL,
        `created` TIMESTAMP DEFAULT CURRENT_TIMESTAMP
    )";
    
    if (mysqli_query($conn, $sql)) {
        echo "Table 'category' created successfully<br>";
        
        // Insert some sample categories
        $sql = "INSERT INTO `category` (`category_name`, `category_desc`) VALUES 
            ('PHP', 'PHP is a server scripting language, and a powerful tool for making dynamic and interactive Web pages.'),
            ('JavaScript', 'JavaScript is the programming language of the Web. JavaScript is easy to learn.'),
            ('Python', 'Python is a popular programming language. Python can be used on a server to create web applications.')";
        
        if (mysqli_query($conn, $sql)) {
            echo "Sample categories added successfully<br>";
        } else {
            echo "Error adding sample categories: " . mysqli_error($conn) . "<br>";
        }
    } else {
        echo "Error creating table: " . mysqli_error($conn) . "<br>";
    }
} else {
    echo "<br>Table 'category' exists.<br>";
    
    // Check table structure
    $result = mysqli_query($conn, "DESCRIBE `category`");
    echo "<h3>Category Table Structure:</h3>";
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
}

// Check if tread table exists
$result = mysqli_query($conn, "SHOW TABLES LIKE 'tread'");
if (mysqli_num_rows($result) == 0) {
    echo "<br>Table 'tread' does not exist!<br>";
    
    // Create tread table
    $sql = "CREATE TABLE `tread` (
        `tread_id` INT AUTO_INCREMENT PRIMARY KEY,
        `tread_title` VARCHAR(255) NOT NULL,
        `tread_desc` TEXT NOT NULL,
        `tread_cat_id` INT NOT NULL,
        `tread_user_id` INT NOT NULL,
        `timestamp` TIMESTAMP DEFAULT CURRENT_TIMESTAMP
    )";
    
    if (mysqli_query($conn, $sql)) {
        echo "Table 'tread' created successfully<br>";
    } else {
        echo "Error creating table: " . mysqli_error($conn) . "<br>";
    }
} else {
    echo "<br>Table 'tread' exists.<br>";
    
    // Check table structure
    $result = mysqli_query($conn, "DESCRIBE `tread`");
    echo "<h3>Tread Table Structure:</h3>";
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
}

// Check if comment table exists
$result = mysqli_query($conn, "SHOW TABLES LIKE 'comment'");
if (mysqli_num_rows($result) == 0) {
    echo "<br>Table 'comment' does not exist!<br>";
    
    // Create comment table
    $sql = "CREATE TABLE `comment` (
        `comment_id` INT AUTO_INCREMENT PRIMARY KEY,
        `comment_title` TEXT NOT NULL,
        `username` INT NOT NULL,
        `tread_id` INT NOT NULL,
        `comment_time` TIMESTAMP DEFAULT CURRENT_TIMESTAMP
    )";
    
    if (mysqli_query($conn, $sql)) {
        echo "Table 'comment' created successfully<br>";
    } else {
        echo "Error creating table: " . mysqli_error($conn) . "<br>";
    }
} else {
    echo "<br>Table 'comment' exists.<br>";
    
    // Check table structure
    $result = mysqli_query($conn, "DESCRIBE `comment`");
    echo "<h3>Comment Table Structure:</h3>";
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
}

echo "<br><a href='index.php'>Back to Home</a>";
?>
