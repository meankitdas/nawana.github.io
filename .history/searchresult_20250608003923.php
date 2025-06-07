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
        $search = $_GET['search'];
        $sql = "SELECT * FROM `tread` WHERE MATCH (tread_title, tread_desc) against ('$search')";
        $result = mysqli_query($conn, $sql);
        $num = mysqli_num_rows($result);
        $noresult = true;
        
    
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
