<?php
    include "includes/conn_login_signup.php";
    session_start();
    function test_input($data) {
        $data = trim($data);    
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }
    // $errorMsg = null;
    if($_SERVER['REQUEST_METHOD']=='POST')
    {

        if(isset($_POST['submit']))
        {
            $uname = test_input($_POST['uname']);
            $uemail = test_input($_POST['uemail']);
            $upass = test_input($_POST['upass']);
            $cpass = test_input($_POST['cpass']);

            

            $sql = "SELECT * FROM tbl_customer WHERE customer_uname = '$uname' OR customer_uemail = '$uemail'";
            $result = mysqli_query($conn,$sql);

            if(mysqli_num_rows($result)>0)
            {
                $_SESSION['error'] = "Username or User E-mail already exists";
            }
            else
            {
                $pass = md5($upass);
                $stmt ="INSERT INTO tbl_customer (customer_uname,customer_uemail,customer_upass) VALUES('$uname','$uemail','$pass')";

                if(mysqli_query($conn,$stmt))
                {
                   
                    $_SESSION['msg'] = "User Registered";
                    header('location:login.php');
                }
                else
                {
                    $_SESSION['error'] = "Error in user registration. Please try again later.";
                }
            }
            

        }
    }

?>

<!DOCTYPE html>
<head>
    <link rel="stylesheet" href="css/loginsignup.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <title>Sign up</title>
    <link href="images/pictures/logo.png" rel="icon">
    <script type="text/javascript" src="js/signupvalidate.js"></script>
</head>

<body>
    <?php
        include 'includes/heading.php';
    ?>
    <?php
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
    <div class="wrapper">
        <div class="container">
            <div class="forms">
                <div class="form-content">
                    <div class="title">Signup</div>
                    <form action="#" method="post" onsubmit="return formvalidate()" id="form">
                        <div class="input-boxes">
                            <div class="input-box">
                                <i class="fas fa-user"></i>
                                <input type="text" placeholder="Username" name="uname" id="uname" value="<?php if(isset($uname)){ echo $uname;} ?>" onkeyup="namevalidation()" 
                                value="">
                                <div class="msg-box"></div>
                            </div>
                            <div class="input-box">
                                <i class="fas fa-envelope"></i>
                                <input type="text" placeholder="E-mail" name="uemail" id="uemail" onkeyup="emailvalidation()" value="<?php if(isset($uemail)){ echo $uemail;}?>">
                                <div class="msg-box"></div>
                            </div>
                            <div class="input-box">
                                <i class="fas fa-lock"></i>
                                <input type="password" placeholder="Password" name="upass" id="upass" onkeyup="passwordvalidation()">
                                <div class="msg-box"></div>
                            </div>
                            <div class="input-box">
                                <i class="fas fa-lock"></i>
                                <input type="password" placeholder="Confirm password" name="cpass" id="cpass" onkeyup="cpasswordvalidation()">
                                <div class="msg-box"></div>
                            </div>
                            <div class="button input-box">
                                <input type="submit" value="Sign Up" name="submit">
                                <div class="msg-box"></div>
                            </div>
                            <div class="text sign-up-text">Already have an account? <a href="login.php">Login now</a></div>
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
