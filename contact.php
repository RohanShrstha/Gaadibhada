<?php
    session_start();
    error_reporting(0);
    include "includes/conn.php";
    if(isset($_POST['submit']))
    {
        $cname = $_POST['cname'];
        $email = $_POST['email'];
        $phone = $_POST['phone'];
        $message = $_POST['message'];
        // database insert SQL code
        $sql = "INSERT INTO tbl_suggestion (cname, email, phone, message) VALUES ('$cname', '$email ', '$phone', '$message')";
        // insert in database 
        if($submit = mysqli_query($conn, $sql)){
            $msg = "Your message has been sent Successfully. We will contact you shortly.";
        }
        else {
            $error="Error to sent a message";	
        }
    }
?>

<!DOCTYPE html>
<html>

<head>
    <link rel="stylesheet" href="css/contact.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <title>Contact Us</title>
    <link href="images/pictures/logo.png" rel="icon">
    <style>
        .errorWrap {
            padding: 10px;
            margin: 0 155px 10px 0;
            background: #fff;
            border-left: 4px solid #dd3d36;
            -webkit-box-shadow: 0 1px 1px 0 rgba(0,0,0,.1);
            box-shadow: 0 1px 1px 0 rgba(0,0,0,.1);
        }
        .succWrap{
            padding: 10px;
            margin: 0 155px 10px 0;
            background: #fff;
            border-left: 4px solid #5cb85c;
            -webkit-box-shadow: 0 1px 1px 0 rgba(0,0,0,.1);
            box-shadow: 0 1px 1px 0 rgba(0,0,0,.1);
        }
    </style>
</head>

<body>
    <?php
        include 'includes/heading.php';
    ?>
    <br><br><br><br>
    <div class="about">
            <img src="images/pictures/forcontact.jpg" style="width:100%">
            <div class="text">Contact Us</div>
        </div>
        
    <div class="form-container">
        <div class="container">
            <br>
            <span style="margin:500px 0 0 0;">Would like to talk to us?</span>
            <h2>Contact Details</h2>
            <div class="input-box">
                <p><i class="fas fa-map-marker-alt"></i> Solteemode, Kathmandu, Nepal </p>
                <p><i class="fas fa-phone-alt"></i> 01-4444444 </p>
                <p><i class="fas fa-mobile-alt"></i> +977 - 9841000000 </p>
                <p><i class="fas fa-envelope"></i> info@gaadibhada.com </p>
                <p><i class="fas fa-envelope"></i> gaadibhadatravel@gmail.com </p>
            </div>
            <div class="social-links">
                <a href="https://www.facebook.com/" class="links"><i class="fab fa-facebook"></i></a>
                <a href="https://www.instagram.com/" class="links"><i class="fab fa-instagram"></i></a>
                <a href="https://www.twitter.com/" class="links"><i class="fab fa-twitter"></i></a>
            </div>
        </div>
        <div class="complain-form">
            <br>
            <span>Any Suggestions?</span>
            <h2>Get in Touch</h2>
            <?php 
				if($error){?><div class="errorWrap"><strong>ERROR</strong>:<?php echo htmlentities($error); ?> </div><?php } 
				else if($msg){?><div class="succWrap"><strong>SUCCESS</strong>:<?php echo htmlentities($msg); ?> </div><?php }?>
            <form method="POST" action="#">
                <p><i class="fas fa-user-alt"></i><input type="text" class="field" name="cname" placeholder="Your Name here" required></p>
                <p><i class="fas fa-envelope"></i><input type="text" class="field" name="email" placeholder="Your Email here" required></p>
                <p><i class="fas fa-phone-alt"></i><input type="text" class="field" name="phone" placeholder="Phone Number" required></p>
                <div class="comment"><i class="fas fa-comments"></i><textarea placeholder="Message" name="message" class="field" required></textarea></div>
                <input type="submit" value="Send" name="submit" class="btn" id="myButton">
                    <br><br><br>
            </form>
        </div>
    </div>
    <div class="mapouter">
        <div class="gmap_canvas">
            <iframe width="100%" height="434" id="gmap_canvas" src="https://maps.google.com/maps?q=Solteemode%20Kathmandu&t=&z=13&ie=UTF8&iwloc=&output=embed"></iframe>
        </div>
    </div>
</body>
</html>