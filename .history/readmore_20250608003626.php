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

    <title>Form</title>

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

    

    $id = $_GET['catid'];
    $sql = "SELECT * FROM `category` WHERE category_id=$id";
    $result = mysqli_query($conn, $sql);

    while ($row = mysqli_fetch_assoc($result)) {
        $catname = $row['category_name'];
        $catdesc = $row['category_desc'];
    }

    ?>
    <?php
    $showalert = false;
    $method = $_SERVER['REQUEST_METHOD'];
    if($method == 'POST'){
        $th_title = $_POST['title'];
        $th_desc = $_POST['desc'];

        $th_title = str_replace("<", "&lt", $th_title);
        $th_title =str_replace(">", "&gt", $th_title);

        $th_desc = str_replace("<", "&lt", $th_desc);
        $th_desc = str_replace(">", "&gt", $th_desc);


        $userid = $_SESSION['id'];

        $sql = "INSERT INTO `tread` (`tread_title`, `tread_desc`, `tread_cat_id`, `tread_user_id`, `timestamp`) VALUES ('$th_title', '$th_desc', '$id', '$userid', current_timestamp())";
        $result = mysqli_query($conn, $sql);
        
        $showalert = true;
        if($showalert){
