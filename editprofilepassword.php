<?php
include "includes/conn.php";
session_start();
if(!isset($_SESSION['log_status']))
{
    header('location:login.php');
}

if(isset($_SESSION['id']))
{
    if(isset($_POST['submit']))
    {
        function test_input($data)
        {
            $data = trim($data);    
            $data = stripslashes($data);
            $data = htmlspecialchars($data);
            return $data;
        }
        $opass = test_input($_POST['opass']);
        $pass = test_input($_POST['npass']);
        $cpass = test_input($_POST['cpass']);

        if(!empty($opass))
        {
            $rs = $conn->query("SELECT * FROM tbl_customer WHERE customer_id=".$_SESSION['id']);
            $row = $rs->fetch_assoc();

            if($row['customer_upass'] == md5($opass))
            {
                if(empty($pass)){
                    $error="New Password cannot be empty";
                }
                elseif(strlen($pass)<8){
                    $error = "Password cannot be less than 8 characters";
                }elseif(strlen($pass)>20){
                    $error = "Password cannot be more than 20 characters";
                }
                elseif(!preg_match("/^(?=.*[A-Z])(?=.*[\w])(?=.*[0-9])(?=.*[a-z]).{8,20}$/",$pass)){
                    $error = "Aleast one character must be of lowercase<br>one of Uppercase , one number<br>and one special character";
                }elseif(empty($cpass)){
                    $error="Confirm Password cannot be empty";
                }
                elseif($pass == $cpass){
                    $pass = md5($pass);
                    $stmt="UPDATE tbl_customer SET customer_upass = '$pass' WHERE customer_id=".$_SESSION['id'];
                    if(mysqli_query($conn,$stmt)){
                        $msg = "Password has been reset";
                    }
                }
                else{
                    $error = "Password and Cofirm Password doesn't match";
                }

            }
            else
            {
                $error = "Old password doesn't match";
            }
        }
        else
        {
            $error = "Old Password Cannot be empty";
        }  
    }
}
else{
    header ('location:profile.php');
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
<title>Rent Vehicle</title>
    <link href="images/pictures/logo.png" rel="icon">
    <link rel="stylesheet" href="css/forgot-reset.css">
    <link href="images/pictures/logo.png" rel="icon">
    <title>Password Edit</title>
</head>
<body>
    <div class="heading">
        <?php
            include 'includes/heading.php';
        ?>
    </div>
    <div class="container">
        <div class="form-container">
            <div class="title">Reset Password</div>
            <div class="form">
                <form action="#" method="post">
                <div class="input-box">
                        <input type="password" placeholder="Old Password" name="opass">
                    </div>
                    <div class="input-box">
                        <input type="password" placeholder="New Password" name="npass">
                    </div>
                    <div class="input-box">
                        <input type="password" placeholder="Confirm Password" name="cpass">
                    </div>
                    <div class="
                    <?php
                            if(isset($error)){
                                echo "error";
                            }else if($msg){
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
                        
                        <input type="submit" value="Submit" name="submit">
                        <input type="button" Value="Cancel" onclick="window.location.href='profile.php'">
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div class="footer">
        <?php
            include 'includes/footer.php';
        ?>
    </div>
</body>
</html>