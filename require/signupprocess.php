<?php
// Enable error reporting for debugging
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Log errors to a file for debugging
ini_set('log_errors', 1);
ini_set('error_log', 'signup_error.log');

session_start();

// Debug information
error_log("Session started. POST data: " . print_r($_POST, true));
error_log("Session variables: " . print_r($_SESSION, true));
if(isset($_SESSION['readmore']) && $_SESSION['readmore'] == true){
    $showerror = false;
    $showalert= false;
    $signup = "false";
    $pass = "false";


    $method = $_SERVER['REQUEST_METHOD'];
    if($method == 'POST'){
        require "_dbconn.php";
        
        // Check if database connection is successful
        if (!$conn) {
            error_log("Database connection failed: " . mysqli_connect_error());
            die("Database connection failed. Please try again later.");
        }
        
        error_log("Database connection successful");

        $email = $_POST['email'];
        $password = $_POST['password'];
        $cpassword = $_POST['cpassword'];

        $existsql = "SELECT * FROM `user` WHERE `email` LIKE '$email'";
        $result = mysqli_query($conn, $existsql);
        $num = mysqli_num_rows($result);

        if($num == 1){
            $showerror = "BDI*XJDHH1!SJJ$/VJ%%VSJ404a";
            $a = $_SESSION['site'];
            $_SESSION['email_exist'] = true;
            header("location: /readmore.php?catid=$a&signup=false&pass=$showerror");
            exit();
        }
        else{
            if($password == $cpassword){
                $hash = password_hash($password, PASSWORD_BCRYPT);
                // Check if the user table exists
                $tableCheck = mysqli_query($conn, "SHOW TABLES LIKE 'user'");
                if (mysqli_num_rows($tableCheck) == 0) {
                    // Create user table if it doesn't exist
                    $createTable = "CREATE TABLE `user` (
                        `user_id` INT AUTO_INCREMENT PRIMARY KEY,
                        `email` VARCHAR(255) NOT NULL,
                        `password` VARCHAR(255) NOT NULL,
                        `date & time` TIMESTAMP DEFAULT CURRENT_TIMESTAMP
                    )";
                    
                    if (!mysqli_query($conn, $createTable)) {
                        error_log("Error creating user table: " . mysqli_error($conn));
                        die("Error creating database table. Please contact administrator.");
                    }
                    error_log("User table created successfully");
                }
                
                $sql = "INSERT INTO `user` (`email`, `password`) VALUES ('$email', '$hash')";
                $result = mysqli_query($conn, $sql);

                if($result){
                    error_log("User registered successfully: $email");
                    $showalert = true;
                    $a = $_SESSION['site'];
                    
                    header("location: /readmore.php?catid=$a&signup=true");
                    exit();
                }
                else{
                    error_log("Error inserting user: " . mysqli_error($conn));
                    $showerror = "101";
                    $a = $_SESSION['site'];
                    
                    header("location: /readmore.php?catid=$a&signup=false&pass=$showerror");
                    exit();
                }
            }
            else{
                $showerror = "$@abm*HJG@JK%JKKOO*101";
                $a = $_SESSION['site'];
                $_SESSION['no_match'] = true;
                header("location: /readmore.php?catid=$a&signup=false&pass=$showerror");
            }
        }
    }

}
elseif (isset($_SESSION['comment']) && $_SESSION['comment'] == true){
    $showerror = false;
    $showalert= false;
    $signup = "false";
    $pass = "false";


    $method = $_SERVER['REQUEST_METHOD'];
    if($method == 'POST'){
        require "_dbconn.php";
        
        // Check if database connection is successful
        if (!$conn) {
            error_log("Database connection failed: " . mysqli_connect_error());
            die("Database connection failed. Please try again later.");
        }
        
        error_log("Database connection successful");

        $email = $_POST['email'];
        $password = $_POST['password'];
        $cpassword = $_POST['cpassword'];

        $existsql = "SELECT * FROM `user` WHERE `email` LIKE '$email'";
        $result = mysqli_query($conn, $existsql);
        $num = mysqli_num_rows($result);

        if($num == 1){
            $showerror = "BDI*XJDHH1!SJJ$/VJ%%VSJ404a";
            $a = $_SESSION['tsite'];
            $_SESSION['email_exist'] = true;
            header("location: /tread.php?treadid=$a&signup=false&pass=$showerror");
            exit();
        }
        else{
            if($password == $cpassword){
                $hash = password_hash($password, PASSWORD_BCRYPT);
                // Check if the user table exists
                $tableCheck = mysqli_query($conn, "SHOW TABLES LIKE 'user'");
                if (mysqli_num_rows($tableCheck) == 0) {
                    // Create user table if it doesn't exist
                    $createTable = "CREATE TABLE `user` (
                        `user_id` INT AUTO_INCREMENT PRIMARY KEY,
                        `email` VARCHAR(255) NOT NULL,
                        `password` VARCHAR(255) NOT NULL,
                        `date & time` TIMESTAMP DEFAULT CURRENT_TIMESTAMP
                    )";
                    
                    if (!mysqli_query($conn, $createTable)) {
                        error_log("Error creating user table: " . mysqli_error($conn));
                        die("Error creating database table. Please contact administrator.");
                    }
                    error_log("User table created successfully");
                }
                
                $sql = "INSERT INTO `user` (`email`, `password`) VALUES ('$email', '$hash')";
                $result = mysqli_query($conn, $sql);

                if($result){
                    error_log("User registered successfully: $email");
                    $showalert = true;
                    $a = $_SESSION['site'];
                    
                    
                    header("location: /tread.php?treadid=$a&signup=true");
                    exit();
                }
                else{
                    error_log("Error inserting user: " . mysqli_error($conn));
                    $showerror = "101";
                    $a = $_SESSION['site'];
                    $_SESSION['no_match'] = true;
                    header("location: /tread.php?treadid=$a&signup=false&pass=$showerror");
                    exit();
                }
            }
            else{
                $showerror = "$@abm*HJG@JK%JKKOO*101";
                $a = $_SESSION['site'];
                $_SESSION['no_match'] = true;
                header("location: /tread.php?treadid=$a&signup=false&pass=$showerror");
            }
        }
    }
}
else{
    $showerror = false;
    $showalert= false;
    $signup = "false";
    $pass = "false";


    $method = $_SERVER['REQUEST_METHOD'];
    if($method == 'POST'){
        require "_dbconn.php";
        
        // Check if database connection is successful
        if (!$conn) {
            error_log("Database connection failed: " . mysqli_connect_error());
            die("Database connection failed. Please try again later.");
        }
        
        error_log("Database connection successful");

        $email = $_POST['email'];
        $password = $_POST['password'];
        $cpassword = $_POST['cpassword'];

        $existsql = "SELECT * FROM `user` WHERE `email` LIKE '$email'";
        $result = mysqli_query($conn, $existsql);
        $num = mysqli_num_rows($result);

        if($num == 1){
            $showerror = "BDI*XJDHH1!SJJ$/VJ%%VSJ404a";
            $_SESSION['email_exist'] = true;
            header("location: /index.php?signup=false&pass=$showerror");
            exit();
        }
        else{
            if($password == $cpassword){
                $hash = password_hash($password, PASSWORD_BCRYPT);
                // Check if the user table exists
                $tableCheck = mysqli_query($conn, "SHOW TABLES LIKE 'user'");
                if (mysqli_num_rows($tableCheck) == 0) {
                    // Create user table if it doesn't exist
                    $createTable = "CREATE TABLE `user` (
                        `user_id` INT AUTO_INCREMENT PRIMARY KEY,
                        `email` VARCHAR(255) NOT NULL,
                        `password` VARCHAR(255) NOT NULL,
                        `date & time` TIMESTAMP DEFAULT CURRENT_TIMESTAMP
                    )";
                    
                    if (!mysqli_query($conn, $createTable)) {
                        error_log("Error creating user table: " . mysqli_error($conn));
                        die("Error creating database table. Please contact administrator.");
                    }
                    error_log("User table created successfully");
                }
                
                $sql = "INSERT INTO `user` (`email`, `password`) VALUES ('$email', '$hash')";
                $result = mysqli_query($conn, $sql);

                if($result){
                    error_log("User registered successfully: $email");
                    $showalert = true;
                    header("location: /index.php?signup=true");
                    exit();
                }
                else{
                    error_log("Error inserting user: " . mysqli_error($conn));
                    $showerror = "101";
                    header("location: /index.php?signup=false&pass=$showerror");
                    exit();
                }
            }
            else{
                $showerror = "$@abm*HJG@JK%JKKOO*101";
                $_SESSION['no_match'] = true;
                header("location: /index.php?signup=false&pass=$showerror");
            }
        }
    }

}
?>
