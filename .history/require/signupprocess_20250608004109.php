<?php

session_start();
if(isset($_SESSION['readmore']) && $_SESSION['readmore'] == true){
    $showerror = false;
    $showalert= false;
    $signup = "false";
    $pass = "false";


    $method = $_SERVER['REQUEST_METHOD'];
    if($method == 'POST'){
        require "_dbconn.php";

        $email = $_POST['email'];
        $password = $_POST['password'];
        $cpassword = $_POST['cpassword'];

        $existsql = "SELECT * FROM `user` WHERE `email` LIKE '$email'";
        $result = mysqli_query($conn, $existsql);
        $num = mysqli_num_rows($result);

        if($num == 1){
            $showerror = "BDI*XJDHH1!SJJ$/VJ%%VSJ404a";
            $a = $_SESSION['site'];
            $_SESSION['email_exist'] = true;
            header("location: /nawana.github.io/readmore.php?catid=$a&signup=false&pass=$showerror");
            exit();
        }
        else{
            if($password == $cpassword){
                $hash = password_hash($password, PASSWORD_BCRYPT);
                $sql = "INSERT INTO `user` (`email`, `password`, `date & time`) VALUES ('$email', '$hash', current_timestamp())";
                $result = mysqli_query($conn, $sql);

                if($result){
                    $showalert = true;
                    $a = $_SESSION['site'];
                    
                    header("location: /nawana.github.io/readmore.php?catid=$a&signup=true");
                    exit();
                }
                else{
                    $showerror = "101";
                    $a = $_SESSION['site'];
                    
                    header("location: /nawana.github.io/readmore.php?catid=$a&signup=false&pass=$showerror");
                }
            }
            else{
                $showerror = "$@abm*HJG@JK%JKKOO*101";
                $a = $_SESSION['site'];
                $_SESSION['no_match'] = true;
                header("location: /nawana.github.io/readmore.php?catid=$a&signup=false&pass=$showerror");
            }
        }
    }

}
elseif (isset($_SESSION['comment']) && $_SESSION['comment'] == true){
    $showerror = false;
    $showalert= false;
    $signup = "false";
    $pass = "false";


    $method = $_SERVER['REQUEST_METHOD'];
    if($method == 'POST'){
        require "_dbconn.php";

        $email = $_POST['email'];
        $password = $_POST['password'];
        $cpassword = $_POST['cpassword'];

        $existsql = "SELECT * FROM `user` WHERE `email` LIKE '$email'";
        $result = mysqli_query($conn, $existsql);
        $num = mysqli_num_rows($result);

        if($num == 1){
            $showerror = "BDI*XJDHH1!SJJ$/VJ%%VSJ404a";
            $a = $_SESSION['tsite'];
            $_SESSION['email_exist'] = true;
            header("location: /nawana.github.io/tread.php?treadid=$a&signup=false&pass=$showerror");
            exit();
        }
        else{
            if($password == $cpassword){
                $hash = password_hash($password, PASSWORD_BCRYPT);
                $sql = "INSERT INTO `user` (`email`, `password`, `date & time`) VALUES ('$email', '$hash', current_timestamp())";
                $result = mysqli_query($conn, $sql);

                if($result){
                    $showalert = true;
                    $a = $_SESSION['site'];
                    
                    
                    header("location: /nawana.github.io/tread.php?treadid=$a&signup=true");
                    exit();
                }
                else{
                    $showerror = "101";
                    $a = $_SESSION['site'];
                    $_SESSION['no_match'] = true;
                    header("location: /nawana.github.io/tread.php?treadid=$a&signup=false&pass=$showerror");
                }
            }
            else{
                $showerror = "$@abm*HJG@JK%JKKOO*101";
                $a = $_SESSION['site'];
                $_SESSION['no_match'] = true;
                header("location: /nawana.github.io/tread.php?treadid=$a&signup=false&pass=$showerror");
            }
        }
    }
}
else{
    $showerror = false;
    $showalert= false;
    $signup = "false";
    $pass = "false";


    $method = $_SERVER['REQUEST_METHOD'];
    if($method == 'POST'){
        require "_dbconn.php";

        $email = $_POST['email'];
        $password = $_POST['password'];
        $cpassword = $_POST['cpassword'];

        $existsql = "SELECT * FROM `user` WHERE `email` LIKE '$email'";
        $result = mysqli_query($conn, $existsql);
        $num = mysqli_num_rows($result);

        if($num == 1){
            $showerror = "BDI*XJDHH1!SJJ$/VJ%%VSJ404a";
            $_SESSION['email_exist'] = true;
            header("location: /nawana.github.io/index.php?signup=false&pass=$showerror");
            exit();
        }
        else{
            if($password == $cpassword){
                $hash = password_hash($password, PASSWORD_BCRYPT);
                $sql = "INSERT INTO `user` (`email`, `password`, `date & time`) VALUES ('$email', '$hash', current_timestamp())";
                $result = mysqli_query($conn, $sql);

                if($result){
                    $showalert = true;
                    header("location: /nawana.github.io/index.php?signup=true");
                    exit();
                }
                else{
                    $showerror = "101";
                    header("location: /nawana.github.io/index.php?signup=false&pass=$showerror");
                }
            }
            else{
                $showerror = "$@abm*HJG@JK%JKKOO*101";
                $_SESSION['no_match'] = true;
                header("location: /nawana.github.io/index.php?signup=false&pass=$showerror");
            }
        }
    }

}
?>
