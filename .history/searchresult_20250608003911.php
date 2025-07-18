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
