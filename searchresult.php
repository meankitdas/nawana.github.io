<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css"
        integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
    <style>
    #foot {
        min-height: 433px;
    }

    #img {
        border-radius: 4rem;
    }

    #read {
        border-radius: 6rem;
    }
    /* #circle {
        border-radius: 4rem;
    } */

    #first {
        min-height: 100vh;
    }
    </style>
    <title>Home</title>
</head>

<body>
    <?php include 'require/_dbconn.php'; ?>
    <?php include "require/_header.html"; ?>
    <?php
    // echo htmlspecialchars($_GET['search']);
    $_GET['search'] = filter_input(INPUT_GET,'search', FILTER_SANITIZE_SPECIAL_CHARS);
    // $_GET['search'] = filter_input(INPUT_GET,'>', FILTER_SANITIZE_SPECIAL_CHARS);
    
    ?>
    <?php
        // Enable error reporting for debugging
        error_reporting(E_ALL);
        ini_set('display_errors', 1);
        
        // Debug information (hidden in HTML comment)
        echo "<!-- Debug info: \n";
        echo "Current database: " . mysqli_query($conn, "SELECT DATABASE()")->fetch_row()[0] . "\n";
        echo "Tables in database: \n";
        $tables = mysqli_query($conn, "SHOW TABLES");
        while ($table = mysqli_fetch_row($tables)) {
            echo "- " . $table[0] . "\n";
        }
        echo "-->";
        
        // Check if search parameter exists
        if(isset($_GET['search'])) {
            $search = $_GET['search'];
            
            // Check if tread table exists
            $tableCheck = mysqli_query($conn, "SHOW TABLES LIKE 'tread'");
            if (mysqli_num_rows($tableCheck) == 0) {
                // Create tread table if it doesn't exist
                $createTable = "CREATE TABLE `tread` (
                    `tread_id` INT AUTO_INCREMENT PRIMARY KEY,
                    `tread_title` VARCHAR(255) NOT NULL,
                    `tread_desc` TEXT NOT NULL,
                    `tread_cat_id` INT NOT NULL,
                    `tread_user_id` INT NOT NULL,
                    `timestamp` TIMESTAMP DEFAULT CURRENT_TIMESTAMP
                )";
                
                if (!mysqli_query($conn, $createTable)) {
                    echo "<div class='alert alert-danger'>Error creating tread table: " . mysqli_error($conn) . "</div>";
                }
            }
            
            // Also search in category table
            $sql1 = "SELECT t.* FROM `tread` t 
                    JOIN `category` c ON t.tread_cat_id = c.category_id
                    WHERE t.tread_title LIKE '%$search%' 
                    OR t.tread_desc LIKE '%$search%'
                    OR c.category_name LIKE '%$search%'";
                    
            // Debug SQL query (hidden in HTML comment)
            echo "<!-- SQL Query: $sql1 -->";
            
            $result = mysqli_query($conn, $sql1);
            
            if($result) {
                $num = mysqli_num_rows($result);
                // Debug result count (hidden in HTML comment)
                echo "<!-- Query result count: $num -->";
            } else {
                echo "<div class='alert alert-danger'>Error executing search query: " . mysqli_error($conn) . "</div>";
                $num = 0;
            }
            
            $noresult = true;
        } else {
            $search = "";
            $num = 0;
            $noresult = true;
        }
    ?>
    <div class="container my-3" id="first">
        <h2 class="text-center">Search Result for <em>"<?php echo $_GET['search']?>"</em> <em>(<?php echo $num;?> results found)</em></h2>
        
 <?php 
        while($row = mysqli_fetch_assoc($result)){
            $title = $row['tread_title'];
            $desc = $row['tread_desc'];
            $id = $row['tread_id'];
            $noresult=false;
            
            echo '<div class="searchresult py-2" id="idcontainer">
            <h3><a href="tread.php?treadid='. $id.'" class="text-primary">'. $title.'</a></h3>
            <p><em>'. $desc.'</em></p>
            </div>';
        }   

        if($noresult){
            echo '<div class="jumbotron jumbotron-fluid my-3">
            <div class="container">
              <h1 class="display-4">&nbsp;&nbsp;No Results Found</h1>
              <p class="lead"><ul>Suggestions:
                        <li>Make sure that all words are spelled correctly.</li>
                        <li>Try different keywords.</li>
                        <li>Try more general keywords.</li>
                        <li>Try fewer keywords.</li></ul></p>
            </div>
          </div>';

        }
        ?>


    </div>
    <?php include 'require/_footer.html'; ?>


    <!-- Optional JavaScript; choose one of the two! -->

    <!-- Option 1: jQuery and Bootstrap Bundle (includes Popper) -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"
        integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous">
    </script>

    <!-- Option 2: jQuery, Popper.js, and Bootstrap JS
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.min.js" integrity="sha384-w1Q4orYjBQndcko6MimVbzY0tgp4pWB4lZ7lr30WKz0vr/aWKhXdBNmNb5D92v7s" crossorigin="anonymous"></script>
    -->
</body>

</html>
