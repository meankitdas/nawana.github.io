<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
    <style>
        #foot{
            min-height: 433px;
        }
        #img{
            border-radius: 4rem;
        }
        #read{
            border-radius: 6rem;
        }
    </style>
    <title>Home</title>
</head>

<body>
<?php include 'require/_dbconn.php'; ?>
    <?php include "require/_header.html"; ?>
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
    elseif(isset($_SESSION['no_match']) && $_SESSION['no_match'] == true) {
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
        
        if(isset($_SESSION['loggedinasperyou']) && $_SESSION['loggedinasperyou'] == true){
            echo '<div class="alert alert-success text-center my-0" style="padding: 3px;" role="alert">
            Welcome <b>'. $_SESSION['email'].'</b>
          </div>';
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

    if(isset($_SESSION['readmore']) && $_SESSION['readmore'] == true){
        unset($_SESSION['readmore']);
    }
    elseif(isset($_SESSION['comment']) && $_SESSION['comment'] == true){
        unset($_SESSION['comment']);
    }


?>



    <div id="carouselExampleFade" class="carousel slide carousel-fade" data-ride="carousel">
