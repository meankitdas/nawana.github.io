<?php
// Enable error reporting
error_reporting(E_ALL);
ini_set('display_errors', 1);

echo "<h1>Adding Sample Data to Database</h1>";

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
            exit;
        }
    }
    
    // Create category table if it doesn't exist
    $result = mysqli_query($conn, "SHOW TABLES LIKE 'category'");
    if (mysqli_num_rows($result) == 0) {
        echo "<p>Creating 'category' table...</p>";
        
        $sql = "CREATE TABLE `category` (
            `category_id` INT AUTO_INCREMENT PRIMARY KEY,
            `category_name` VARCHAR(255) NOT NULL,
            `category_desc` TEXT NOT NULL,
            `created` TIMESTAMP DEFAULT CURRENT_TIMESTAMP
        )";
        
        if (mysqli_query($conn, $sql)) {
            echo "<p style='color: green;'>✓ Table 'category' created successfully</p>";
        } else {
            echo "<p style='color: red;'>✗ Error creating table: " . mysqli_error($conn) . "</p>";
            exit;
        }
    } else {
        echo "<p style='color: green;'>✓ Table 'category' already exists</p>";
    }
    
    // Create user table if it doesn't exist
    $result = mysqli_query($conn, "SHOW TABLES LIKE 'user'");
    if (mysqli_num_rows($result) == 0) {
        echo "<p>Creating 'user' table...</p>";
        
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
            exit;
        }
    } else {
        echo "<p style='color: green;'>✓ Table 'user' already exists</p>";
    }
    
    // Create tread table if it doesn't exist
    $result = mysqli_query($conn, "SHOW TABLES LIKE 'tread'");
    if (mysqli_num_rows($result) == 0) {
        echo "<p>Creating 'tread' table...</p>";
        
        $sql = "CREATE TABLE `tread` (
            `tread_id` INT AUTO_INCREMENT PRIMARY KEY,
            `tread_title` VARCHAR(255) NOT NULL,
            `tread_desc` TEXT NOT NULL,
            `tread_cat_id` INT NOT NULL,
            `tread_user_id` INT NOT NULL,
            `timestamp` TIMESTAMP DEFAULT CURRENT_TIMESTAMP
        )";
        
        if (mysqli_query($conn, $sql)) {
            echo "<p style='color: green;'>✓ Table 'tread' created successfully</p>";
        } else {
            echo "<p style='color: red;'>✗ Error creating table: " . mysqli_error($conn) . "</p>";
            exit;
        }
    } else {
        echo "<p style='color: green;'>✓ Table 'tread' already exists</p>";
    }
    
    // Create comment table if it doesn't exist
    $result = mysqli_query($conn, "SHOW TABLES LIKE 'comment'");
    if (mysqli_num_rows($result) == 0) {
        echo "<p>Creating 'comment' table...</p>";
        
        $sql = "CREATE TABLE `comment` (
            `comment_id` INT AUTO_INCREMENT PRIMARY KEY,
            `comment_title` TEXT NOT NULL,
            `username` INT NOT NULL,
            `tread_id` INT NOT NULL,
            `comment_time` TIMESTAMP DEFAULT CURRENT_TIMESTAMP
        )";
        
        if (mysqli_query($conn, $sql)) {
            echo "<p style='color: green;'>✓ Table 'comment' created successfully</p>";
        } else {
            echo "<p style='color: red;'>✗ Error creating table: " . mysqli_error($conn) . "</p>";
            exit;
        }
    } else {
        echo "<p style='color: green;'>✓ Table 'comment' already exists</p>";
    }
    
    // Add sample categories if they don't exist
    $result = mysqli_query($conn, "SELECT * FROM `category`");
    if (mysqli_num_rows($result) == 0) {
        echo "<p>Adding sample categories...</p>";
        
        $categories = [
            ['PHP', 'PHP is a server scripting language, and a powerful tool for making dynamic and interactive Web pages.'],
            ['JavaScript', 'JavaScript is the programming language of the Web. JavaScript is easy to learn.'],
            ['Python', 'Python is a popular programming language. Python can be used on a server to create web applications.'],
            ['Java', 'Java is a popular programming language. Java can be used to develop mobile apps, web apps, desktop apps, games and much more.']
        ];
        
        foreach ($categories as $category) {
            $name = $category[0];
            $desc = $category[1];
            
            $sql = "INSERT INTO `category` (`category_name`, `category_desc`) VALUES ('$name', '$desc')";
            if (mysqli_query($conn, $sql)) {
                echo "<p style='color: green;'>✓ Added category: $name</p>";
            } else {
                echo "<p style='color: red;'>✗ Error adding category: " . mysqli_error($conn) . "</p>";
            }
        }
    } else {
        echo "<p style='color: green;'>✓ Categories already exist</p>";
    }
    
    // Add sample user if it doesn't exist
    $result = mysqli_query($conn, "SELECT * FROM `user` WHERE `email` = 'admin@example.com'");
    if (mysqli_num_rows($result) == 0) {
        echo "<p>Adding sample user...</p>";
        
        $email = 'admin@example.com';
        $password = password_hash('admin123', PASSWORD_BCRYPT);
        
        $sql = "INSERT INTO `user` (`email`, `password`) VALUES ('$email', '$password')";
        if (mysqli_query($conn, $sql)) {
            echo "<p style='color: green;'>✓ Added user: $email (password: admin123)</p>";
            $user_id = mysqli_insert_id($conn);
        } else {
            echo "<p style='color: red;'>✗ Error adding user: " . mysqli_error($conn) . "</p>";
            exit;
        }
    } else {
        $row = mysqli_fetch_assoc($result);
        $user_id = $row['user_id'];
        echo "<p style='color: green;'>✓ Sample user already exists (ID: $user_id)</p>";
    }
    
    // Add sample threads if they don't exist
    $result = mysqli_query($conn, "SELECT * FROM `tread`");
    if (mysqli_num_rows($result) == 0) {
        echo "<p>Adding sample threads...</p>";
        
        $threads = [
            ['How to connect to MySQL in PHP?', 'I am trying to connect to a MySQL database using PHP but getting an error. Here is my code: $conn = mysqli_connect("localhost", "username", "password", "database"); Can someone help me fix this?', 1],
            ['JavaScript event listeners not working', 'I have added event listeners to my buttons but they are not triggering when clicked. Here is my code: document.getElementById("myButton").addEventListener("click", function() { alert("Button clicked!"); });', 2],
            ['Python list comprehension examples', 'Can someone provide some examples of list comprehension in Python? I am trying to understand how to use it effectively.', 3],
            ['Java vs JavaScript differences', 'What are the main differences between Java and JavaScript? They sound similar but I heard they are completely different.', 4],
            ['PHP form validation best practices', 'What are the best practices for validating form data in PHP? Should I use filter_var or regular expressions?', 1],
            ['JavaScript async/await tutorial', 'I need help understanding async/await in JavaScript. Can someone explain how it works with examples?', 2],
            ['Python Django vs Flask', 'What are the pros and cons of using Django vs Flask for a web application in Python?', 3],
            ['Java Spring Boot tutorial', 'Looking for a good tutorial on Spring Boot for beginners. Any recommendations?', 4]
        ];
        
        foreach ($threads as $thread) {
            $title = $thread[0];
            $desc = $thread[1];
            $cat_id = $thread[2];
            
            $sql = "INSERT INTO `tread` (`tread_title`, `tread_desc`, `tread_cat_id`, `tread_user_id`) VALUES ('$title', '$desc', $cat_id, $user_id)";
            if (mysqli_query($conn, $sql)) {
                echo "<p style='color: green;'>✓ Added thread: $title</p>";
            } else {
                echo "<p style='color: red;'>✗ Error adding thread: " . mysqli_error($conn) . "</p>";
            }
        }
    } else {
        echo "<p style='color: green;'>✓ Sample threads already exist</p>";
    }
    
    echo "<h2>Sample Data Added Successfully!</h2>";
    echo "<p>You can now test the search functionality with keywords like 'PHP', 'JavaScript', 'Python', etc.</p>";
    echo "<p><a href='index.php' class='btn btn-primary'>Go to Homepage</a></p>";
    
} else {
    echo "<p style='color: red;'>✗ Database connection failed: " . mysqli_connect_error() . "</p>";
}
?>
