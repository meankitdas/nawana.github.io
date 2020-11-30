<?php session_start(); ?>
<style>
    #style{
        margin-left: -7px!important;
        
    }
    #search{
        margin-right: 7px;
        border-radius: 6rem;
    }
    #b1{
        border-radius: 6rem;
    }
    #b2{
        border-radius: 6rem;
    }
    #s1{
        border-radius: 6rem;
    }
</style>
<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <a class="navbar-brand" href="index.php">Nawana</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
        aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav mr-auto">
            <li class="nav-item active">
                <a class="nav-link" href="index.php">Home</a>
            </li>
            <!-- <li class="nav-item">
                <a class="nav-link" href="about.php">About</a>
            </li> -->
            <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown"
                            aria-haspopup="true" aria-expanded="false">
                            Top Category
                        </a>
                        <div class="dropdown-menu" aria-labelledby="navbarDropdown">

            <?php
                $sql = "SELECT * FROM `category` LIMIT 3";
                $result = mysqli_query($conn,$sql);
                while($row = mysqli_fetch_assoc($result)){
                    $name = $row['category_name'];
                    $id = $row['category_id'];
                    echo '
                        
                            <a class="dropdown-item" href="readmore.php?catid='. $id.'">'. $name.'</a>
                        '
                            
                    ;
                }

            ?>
            </div>
            </li>
            <!-- <li class="nav-item">
                <a class="nav-link" href="contact.php">Contact</a>
            </li> -->
        </ul>
        <div class="row row-lg-3">
            <form class="form-inline my-2 my-lg-0"  method="GET" action="searchresult.php">
                <input class="form-control mr-sm-2" type="search" name="search" placeholder="Search" id="s1" aria-label="Search">
                <button class="btn btn-success my-2 my-sm-0" type="submit" id="search">Search</button>
            </form>

            <?php

                if(!isset($_SESSION['loggedinasperyou'])){
                    echo '<div class="row row-lg-3 mx-0 mr-2" id="style">
                        <button class="btn btn-outline-success ml-2 mx-0" id="b1" data-toggle="modal" data-target="#signupModal">SignUp</button>
                        <button class="btn btn-outline-success ml-2 mx-0 mr-2" id="b2" data-toggle="modal"
                            data-target="#loginModal">Login</button>
                    </div>';
                }
                elseif (isset($_SESSION['loggedinasperyou']) && $_SESSION['loggedinasperyou'] == true) {
                    
                    echo '<div class="row row-lg-3 mx-0 mr-2" id="style">
                    <button class="btn btn-outline-success ml-2 mx-0 mr-2" id="b2" data-toggle="modal" data-target="#logoutModal">Logout</button>
                </div>';
                }
            ?>
        </div>
 
    <?php include '_signupmodal.php'; 
    include '_loginmodal.php'; 
    include '_logoutmodal.php';
        
    
?>
    </div>
</nav>