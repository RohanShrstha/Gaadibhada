<?php
    include "includes/conn_login_signup.php";
    session_start();
    function test_input($data) {
        $data = trim($data);    
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }
    if($_SERVER['REQUEST_METHOD'] =='POST')
    {
        if(isset($_POST['submit']))
        {
            $uemail = test_input($_POST['uemail']);
            $upass = md5(test_input($_POST['upass']));


            $stmt="SELECT * FROM tbl_customer WHERE customer_uemail ='$uemail' && customer_upass = '$upass' ";

            $result = mysqli_query($conn,$stmt);
            if(mysqli_num_rows($result)==1)
            {
                $_SESSION['log_status'] = true;
                $_SESSION['uemail'] = $uemail;
                header('location:home.php');
            }
            else
            {
                $_SESSION['error'] = "User E-mail or Password incorrect";
            }

        }
            
    }

?>

<!DOCTYPE html>

<head>
    <link rel="stylesheet" href="css/loginsignup.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <title>Login</title>
    <link href="images/pictures/logo.png" rel="icon">
</head>

<body>
    <?php
        include 'includes/heading.php';
    ?>
    <?php
    if(isset($_SESSION['msg']))
    {
    ?>
    <div class="successmsg">
        <?php 
            echo $_SESSION['msg'];
            unset($_SESSION['msg']);
        ?>
    </div>
    <?php
    }
    if(isset($_SESSION['error']))
    {
    ?>
    <div class="errormsg">
        <?php
            echo $_SESSION['error'];
            unset($_SESSION['error']);
        ?>
    </div>
    <?php
        }
    ?>
    <?php
    if(isset($_SESSION['message']))
    {
    ?>
    <div class="message">
        <?php
            echo $_SESSION['message'];
            unset($_SESSION['message']);
        ?>
    </div>
    <?php
        }
    ?>
    <div class="wrapper">
        <div class="container">
            <div class="forms">
                <div class="form-content">
                    <div class="title">Login</div>
                    <form action="#" method="post">
                        <div class="input-boxes">
                            <div class="input-box">
                                <i class="fas fa-envelope"></i>
                                <input type="text" placeholder="User E-mail" name="uemail">
                            </div>
                            <div class="input-box">
                                <i class="fas fa-lock"></i>
                                <input type="password" placeholder="Password" name="upass">
                            </div>
                            <div class="forgot">
                                <a href="forgot.php"><br>Forgot password?</a>
                            </div>
                            <div class="button input-box">
                                <input type="submit" value="Login" name="submit">
                            </div>
                            <div class="text sign-up-text">Don't have an account? <a href="signup.php">Sigup now</a></div>
                        </div>
                    </form>
                </div>
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