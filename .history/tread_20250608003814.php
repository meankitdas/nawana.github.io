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

    #circle {
        border-radius: 4rem;
    }
    </style>
    <title>Home</title>
</head>

<body>
<?php include 'require/_dbconn.php'; ?>
    <?php
    include 'require/_header.html';
    ?>
    <?php
    if(isset($_GET['signup']) && $_GET['signup']=="true"){
        echo '<div class="alert alert-success alert-dismissible fade show my-0" role="alert">
        <strong>Success !</strong> You can login now.
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
        </button>
        </div>';
    }
    elseif (isset($_SESSION['email_exist']) && $_SESSION['email_exist'] == true) {
        echo '<div class="alert alert-danger alert-dismissible fade show my-0" role="alert">
        <strong>Error !</strong> Email already exist.
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
        </button>
        </div>';
        unset($_SESSION['email_exist']);
    }
    elseif(isset($_SESSION['no_match']) && $_SESSION['no_match']==true) {
        echo '<div class="alert alert-danger alert-dismissible fade show my-0" role="alert">
        <strong>Error !</strong> Password not matched.
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
        </button>
        </div>';
        unset($_SESSION['no_match']);
    }
    ?>
    <?php
        
        if(isset($_SESSION['loggedinasperyou']) && !isset($_SESSION['no']) && !isset($_SESSION['ex'])){
            echo '<div class="alert alert-success alert-dismissible fade show my-0" role="alert">
            <strong>Success !</strong> You are successfully logged in as '. $_SESSION['email'].'
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
            </div>';
            $_SESSION['no'] = true;
        }
        // echo var_dump($_GET['error']); 
        // echo var_dump($_GET['lon']); 
        if(isset($_SESSION['pass_not']) && $_SESSION['pass_not'] == true){
            echo '<div class="alert alert-danger alert-dismissible fade show my-0" role="alert">
            <strong>Try again !</strong> Incorrect password.
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
            </div>';
            unset($_SESSION['pass_not']);
        }
        if(isset($_SESSION['acc_not']) && $_SESSION['acc_not'] == true){
            echo '<div class="alert alert-danger alert-dismissible fade show my-0" role="alert">
            <strong>Sorry !</strong> Please Signup to continue.
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
            </div>';
            unset($_SESSION['acc_not']);
        }

    ?>
    <?php

    // include 'require/_dbconn.php';

    $id = $_GET['treadid'];
    $sql = "SELECT * FROM `tread` WHERE tread_id=$id";
    $result = mysqli_query($conn, $sql);
    

    while ($row = mysqli_fetch_assoc($result)) {
        
        $treadname = $row['tread_title'];
        $treaddesc = $row['tread_desc'];
        // $a = mysqli_fetch_assoc($result);
        $tread_user_id = $row['tread_user_id'];

        $sql2 = "SELECT email FROM `user` WHERE user_id=$tread_user_id";
        $result2 = mysqli_query($conn, $sql2);
        $row2 = mysqli_fetch_assoc($result2);
        $user = $row2['email'];
    }
    

    ?>
    <?php
    $showalert = false;
    $method = $_SERVER['REQUEST_METHOD'];
    if($method == 'POST'){
        // $th_title = $_POST['title'];
        $th_comment = $_POST['comment'];
        $th_comment = str_replace("<","&lt", $th_comment);
        $th_comment = str_replace(">","&gt", $th_comment);
        $usid = $_SESSION['id'];


        $sql = "INSERT INTO `comment` (`comment_title`, `username`, `tread_id`, `comment_time`) VALUES ('$th_comment','$usid', '$id', current_timestamp())";
        $result = mysqli_query($conn, $sql);
        
        $showalert = true;
        if($showalert){
            echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
            <strong>Success !</strong> Your comment is successfully submitted.
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
           </div>';
        }

    }
    
    ?>

    <div class="container">
        <div class="jumbotron my-3">
            <h1 class="display-4"><?php echo $treadname; ?></h1>
            <p class="lead"><?php echo $treaddesc; ?></p>
            <hr class="my-2">
            <p style="font-size: 20px; font-weight: normal;">- <em><?php echo $user; ?></em></p>
