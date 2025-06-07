<?php
// Enable error reporting
error_reporting(E_ALL);
ini_set('display_errors', 1);

echo "<h1>Search Functionality Debug</h1>";

// Include database connection
require 'require/_dbconn.php';

if ($conn) {
    echo "<p style='color: green;'>✓ Database connection successful</p>";
    
    // Check if forum database exists
    $result = mysqli_query($conn, "SELECT DATABASE()");
    $row = mysqli_fetch_row($result);
    $current_db = $row[0];
    echo "<p>Current database: <strong>$current_db</strong></p>";
    
    // Check if tread table exists
    $result = mysqli_query($conn, "SHOW TABLES LIKE 'tread'");
    if (mysqli_num_rows($result) > 0) {
        echo "<p style='color: green;'>✓ Table 'tread' exists</p>";
        
        // Count records in tread table
        $result = mysqli_query($conn, "SELECT COUNT(*) FROM `tread`");
        $row = mysqli_fetch_row($result);
        $count = $row[0];
        echo "<p>Number of threads in database: <strong>$count</strong></p>";
        
        if ($count > 0) {
            // Show all threads
            $result = mysqli_query($conn, "SELECT * FROM `tread`");
            echo "<h3>All Threads in Database:</h3>";
            echo "<table border='1'><tr><th>ID</th><th>Title</th><th>Description</th><th>Category ID</th><th>User ID</th></tr>";
            while ($row = mysqli_fetch_assoc($result)) {
                echo "<tr>";
                echo "<td>" . $row['tread_id'] . "</td>";
                echo "<td>" . $row['tread_title'] . "</td>";
                echo "<td>" . substr($row['tread_desc'], 0, 50) . "...</td>";
                echo "<td>" . $row['tread_cat_id'] . "</td>";
                echo "<td>" . $row['tread_user_id'] . "</td>";
                echo "</tr>";
            }
            echo "</table>";
            
            // Test search functionality
            echo "<h3>Test Search Functionality</h3>";
            echo "<form method='get' action='check_search.php'>";
            echo "<input type='text' name='search_term' placeholder='Enter search term' required>";
            echo "<input type='submit' value='Search'>";
            echo "</form>";
            
            if (isset($_GET['search_term'])) {
                $search_term = $_GET['search_term'];
                echo "<h4>Search Results for: '$search_term'</h4>";
                
                // Test with LIKE query
                $sql = "SELECT * FROM `tread` WHERE `tread_title` LIKE '%$search_term%' OR `tread_desc` LIKE '%$search_term%'";
                echo "<p>SQL Query: <code>$sql</code></p>";
                
                $result = mysqli_query($conn, $sql);
                
                if ($result) {
                    $num = mysqli_num_rows($result);
                    echo "<p>Results found: <strong>$num</strong></p>";
                    
                    if ($num > 0) {
                        echo "<table border='1'><tr><th>ID</th><th>Title</th><th>Description</th></tr>";
                        while ($row = mysqli_fetch_assoc($result)) {
                            echo "<tr>";
                            echo "<td>" . $row['tread_id'] . "</td>";
                            echo "<td>" . $row['tread_title'] . "</td>";
                            echo "<td>" . substr($row['tread_desc'], 0, 50) . "...</td>";
                            echo "</tr>";
                        }
                        echo "</table>";
                    } else {
                        echo "<p style='color: orange;'>⚠ No results found</p>";
                    }
                } else {
                    echo "<p style='color: red;'>✗ Error executing search query: " . mysqli_error($conn) . "</p>";
                }
            }
        } else {
            echo "<p style='color: orange;'>⚠ No threads found in the database</p>";
            echo "<p>Please run <a href='add_sample_data.php'>add_sample_data.php</a> to add sample data.</p>";
        }
    } else {
        echo "<p style='color: red;'>✗ Table 'tread' does not exist</p>";
        echo "<p>Please run <a href='add_sample_data.php'>add_sample_data.php</a> to create the table and add sample data.</p>";
    }
    
} else {
    echo "<p style='color: red;'>✗ Database connection failed: " . mysqli_connect_error() . "</p>";
}

echo "<br><a href='index.php'>Back to Home</a>";
?>
