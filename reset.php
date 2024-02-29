<?php
include "includes/conn.php";

if(isset($_GET['email'])){
    $email = $_GET['email'];

    if(isset($_POST['submit'])){
        function test_input($data) {
            $data = trim($data);    
            $data = stripslashes($data);
            $data = htmlspecialchars($data);
            return $data;
        }
        $pass = test_input($_POST['pass']);
        $cpass = test_input($_POST['cpass']);

        if(empty($pass)){
            $error="Password cannot be empty";
        }
        elseif(strlen($pass)<8){
            $error = "Password cannot be less than 8 characters";
        }elseif(strlen($pass)>20){
            $error = "Password cannot be more than 20 characters";
        }
        elseif(!preg_match("/^(?=.*[A-Z])(?=.*[\w])(?=.*[0-9])(?=.*[a-z]).{8,20}$/",$pass)){
            $error = "Aleast one character must be of lowercase one of Uppercase , one number and one special character";
        }elseif(empty($cpass)){
            $error="Confirm Password cannot be empty";
        }
        elseif($pass == $cpass){
            $pass = md5($pass);
            $stmt="UPDATE tbl_customer SET customer_upass = '$pass' WHERE customer_uemail='$email'";
            if(mysqli_query($conn,$stmt)){
                $msg = "Password has been reset";
            }
        }
        else{
            $error = "Password and Cofirm Password doesn't match";
        }
    }
}
else{
    header ('location:login.php');
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Password Reset</title>
    <link href="images/pictures/logo.png" rel="icon">
    <link href="images/pictures/logo.png" rel="icon">
    <link rel="stylesheet" href="css/forgot-reset.css">
</head>
<body>
    <?php
        include 'includes/heading.php';
    ?>
    <div class="container">
        <div class="form-container">
            <div class="title">Reset Password</div>
            <div class="form">
                <form action="#" method="post">
                    <div class="input-box">
                        <input type="password" placeholder="Password" name="pass">
                    </div>
                    <div class="input-box">
                        <input type="password" placeholder="Confirm Password" name="cpass">
                    </div>
                    <div class="
                    <?php
                            if(isset($error)){
                                echo "error";
                            }else if(isset($msg)){
                                echo "msg";
                            }
                            else{
                                echo "none";
                            }
                    ?>
                        ">
                        <?php
                            if(isset($error)){
                                echo $error;
                            }
                            if(isset($msg)){
                                echo $msg;
                            }
                        ?>
                    </div>
                    <div class="input-box button">
                        
                        <input type="submit" value="Send" name="submit">
                    </div>
                </form>
                <a href="login.php"> Go back to login </a>
            </div>
        </div>
    </div>
</body>
</html>