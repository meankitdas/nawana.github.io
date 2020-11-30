<?php
    session_start();
    if(!isset($_SESSION['loggedin']) || $_SESSION['loggedin']!=true){
        header("location: log.php");
        exit;
    }

    $name = $_SESSION['username'];
    if($_SESSION['alert']){
        ?>
            <script>alert('You are logged in as <?php echo $name;?>')</script>
        <?php

        $_SESSION['alert'] = false;
    }
    
?>
<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css"
        integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">

    <title>Backend Form</title>
</head>

<body>
    <?php
        
        $server = 'localhost';
        $user = 'root';
        $pass = '';
        $data = 'forum';

        $conn = mysqli_connect($server,$user,$pass,$data);

        $showerror = false;
        $showalert = false;

        if($_SERVER['REQUEST_METHOD']=='POST'){

            $title = $_POST['title'];
            $desc = $_POST['desc'];
            
            $existsql = "SELECT * FROM `category` WHERE `category_name`LIKE '$title'";
            $result = mysqli_query($conn, $existsql);
            $num = mysqli_num_rows($result);

            if($num == 1){
                $showerror = true;
                
            }
            else{
                $sql = "INSERT INTO `category` (`category_name`, `category_desc`, `Date & time`) VALUES ('$title', '$desc', current_timestamp());";
                $result = mysqli_query($conn, $sql);
                $showalert = true;
            }

        }


    ?>

    <?php

        if($showalert){
            echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
            <strong>Success !</strong> Data submitted in the database.
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>';
        }

        if($showerror){
            echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
            <strong>Unsuccessful !</strong> The title is already existed.
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>';
        }
    
    
    
    ?>

    <h1 class="text-center"><u>Category</u></h1>
    <br>

    <div class="container">
        <form action="mainpageform.php" method="POST">
            <div class="form-group">
                <label for="title">Title</label>
                <input type="text" class="form-control" id="title" name="title" aria-describedby="emailHelp" required>
                <!-- <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone
                    else.</small> -->
            </div>
            <div class="form-group">
                <label for="desc">Desc</label>
                <textarea class="form-control" id="desc" name="desc" rows="3" required></textarea>
            </div>
            <button type="submit" class="btn btn-primary">Submit</button>
            <a href="logout.php" class="btn btn-outline-primary">Logout</a>
        </form>
    </div>
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