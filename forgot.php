<?php
include "includes/conn.php";

if(isset($_POST['submit'])){
    function test_input($data) {
        $data = trim($data);    
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }
    $email = test_input($_POST['email']);

    $regex_email = "/^[a-zA-Z\d\s\._]+@[a-z\.]+\.[a-z]{2,3}$/";
    if(!preg_match($regex_email,$email)){
        $error = "Invalid Email format";
    }
    else{
        $stmt="SELECT * FROM tbl_customer WHERE customer_uemail='$email'";
        $result = mysqli_query($conn,$stmt);

        if(mysqli_num_rows($result)==0){
            $error = "User E-mail doesn't exists";
        }
        else{
            header ('location:reset.php?email='.$email);
        }
    }

    
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
<title>Rent Vehicle</title>
    <link href="images/pictures/logo.png" rel="icon">
    <link rel="stylesheet" href="css/forgot-reset.css">
    <link href="images/pictures/logo.png" rel="icon">
    <title>Password Forgot</title>
    <style>
        .error{
            width: 100%;
            height:  auto;
            text-align: center;
            font-style: italic;
            color:  red;
        }
        .none{
            display: none;
        }
    </style>
</head>
<body>
    <?php
        include 'includes/heading.php';
    ?>
    <div class="container">
        <div class="form-container">
            <div class="title">Forgot Password</div>
            <div class="form">
                <form action="#" method="post">
                    <div class="input-box">
                        <input type="text" placeholder="E-mail *" name="email">
                    </div>
                    <div class="<?php
                        if(isset($error)){
                            echo "error";
                        }
                        else{
                            echo "none";
                        }
                        ?>">
                        <?php
                            if(isset($error)){
                                echo $error;
                            }
                        ?>
                    </div>
                    <div class="input-box button">
                        <input type="submit" value="Forgot Password" name="submit">
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>
</html>