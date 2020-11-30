<?php
session_start();
if(isset($_SESSION['logout'])){
        ?>
            <script>alert('You are logged out ! Please Login to continue.')</script>
        <?php
        session_destroy();
        session_unset();
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

    <title>Login</title>
</head>

<body>
<?php

        $login = false;
        $showerror = false;
        
        $server = 'localhost';
        $user = 'root';
        $pass = '';
        $data = 'forum';
        
        $conn = mysqli_connect($server,$user,$pass,$data);

        if($_SERVER['REQUEST_METHOD']=='POST'){

            $username = $_POST['username'];
            $pass = $_POST['pass'];

            $sql = "SELECT * FROM `personal` WHERE `username` LIKE '$username' AND `password` LIKE '$pass'";
            $result = mysqli_query($conn , $sql);
            $num = mysqli_num_rows($result);

            if($num == 1){
                while($row = mysqli_fetch_assoc($result)){

                    session_start();
                    $_SESSION['loggedin'] = true;
                    $_SESSION['username'] = $username;
                    $_SESSION['alert'] = true;
                    header("location: mainpageform.php");
                }
            }
            else{
                $showerror = true;
            }

        }
    
    
    ?>

<?php
        if($showerror){
            echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
            <strong>Error !</strong> wrong credentials.
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
           </div>';
        }



    ?>

    <h1 class="text-center">Login</h1>
    <br>

    
    

    <div class="container">
        <form action="log.php" method="POST">
            <div class="form-group">
                <label for="username">Username</label>
                <input type="text" class="form-control" id="username" name="username" aria-describedby="emailHelp" required>
                <!-- <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone
                    else.</small> -->
            </div>
            <div class="form-group">
                <label for="pass">Password</label>
                <input type="password" class="form-control" id="pass" name="pass" aria-describedby="emailHelp" required>
                <!-- <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone
                    else.</small> -->
            </div>

            <button type="submit" class="btn btn-primary">Submit</button>
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