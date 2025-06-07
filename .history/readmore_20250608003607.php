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
