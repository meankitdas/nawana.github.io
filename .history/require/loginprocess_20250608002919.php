<?php
session_start();
if(isset($_SESSION['readmore']) && $_SESSION['readmore'] == true){

        $showerror = "false";
        $method  = $_SERVER['REQUEST_METHOD'];

        if($method == 'POST'){
            require "_dbconn.php";
            $email = $_POST['email'];
            $password = $_POST['password'];

            $existsql = "SELECT * FROM `user` WHERE `email` LIKE '$email'";
            $result = mysqli_query($conn, $existsql);
            $num = mysqli_num_rows($result);

            if($num == 1){
                while($row = mysqli_fetch_assoc($result)){
                    if(password_verify($password,$row['password'])){
                        // $login = true;
                        
                        $_SESSION['loggedinasperyou'] = true;
                        $_SESSION['email'] = $email;
                        $_SESSION['id'] = $row['user_id'];
                        $a = $_SESSION['site'];
                        header("location: /nawana.github.io/readmore.html?catid=$a");
                        exit();
                        // echo 'yeh';
                    }
                    else{
                        $showerror = "uyjsd1";
                        $a = $_SESSION['site'];
                        $_SESSION['pass_not'] = true;
                        header("location: /form/readmore.php?catid=$a&error=$showerror");
                        // echo 'u r not';
                        exit();
                    }
                }
            }
            else{
                $showerror = "uyjsd2";
                $a = $_SESSION['site'];
                $_SESSION['acc_not'] = true;
                header("location: /form/readmore.php?catid=$a&lon=$showerror");
            }
        }

}
elseif (isset($_SESSION['comment']) && $_SESSION['comment'] == true){
    $showerror = "false";
        $method  = $_SERVER['REQUEST_METHOD'];

        if($method == 'POST'){
            require "_dbconn.php";
            $email = $_POST['email'];
            $password = $_POST['password'];

            $existsql = "SELECT * FROM `user` WHERE `email` LIKE '$email'";
            $result = mysqli_query($conn, $existsql);
            $num = mysqli_num_rows($result);

            if($num == 1){
                while($row = mysqli_fetch_assoc($result)){
                    if(password_verify($password,$row['password'])){
                        // $login = true;
                        
                        $_SESSION['loggedinasperyou'] = true;
                        $_SESSION['email'] = $email;
                        $_SESSION['id'] = $row['user_id'];
            
                        $a = $_SESSION['tsite'];
                        header("location: /form/tread.php?treadid=$a");
                        exit();
                        // echo 'yeh';
                    }
                    else{
                        $showerror = "uyjsd1";
                        $a = $_SESSION['tsite'];
                        header("location: /form/tread.php?treadid=$a&error=$showerror");
                        $_SESSION['pass_not'] = true;
                        // echo 'u r not';
                        exit();
                    }
                }
            }
            else{
                $showerror = "uyjsd2";
                $a = $_SESSION['tsite'];
                $_SESSION['acc_not'] = true;
                header("location: /form/tread.php?treadid=$a&lon=$showerror");
            }
        }
}
else{
    $showerror = "false";
    $method  = $_SERVER['REQUEST_METHOD'];

        if($method == 'POST'){
            require "_dbconn.php";
            $email = $_POST['email'];
            $password = $_POST['password'];

            $existsql = "SELECT * FROM `user` WHERE `email` LIKE '$email'";
            $result = mysqli_query($conn, $existsql);
            $num = mysqli_num_rows($result);

            if($num == 1){
                while($row = mysqli_fetch_assoc($result)){
                    if(password_verify($password,$row['password'])){
                        // $login = true;
                        // session_start();
                        $_SESSION['loggedinasperyou'] = true;
                        $_SESSION['email'] = $email;
                        $_SESSION['id'] = $row['user_id'];
                        $_SESSION['ex'] = true;
                        header("location: /form/index.php");
                        exit();
                        // echo 'yeh';
                    }
                    else{
                        $showerror = "uyjsd1";
                        $_SESSION['pass_not'] = true;
                        header("location: /form/index.php?error=$showerror");
                        // echo 'u r not';
                        exit();
                    }
                }
            }
            else{
                $showerror = "uyjsd2";
                $_SESSION['acc_not'] = true;
                header("location: /form/index.php?lon=$showerror");
            }
        }
}






?>