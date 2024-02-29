<?php
    include 'includes/conn.php';
    session_start();
    if(!isset($_SESSION['log_status']))
    {
        header('location:login.php');
    }

    $stmt = "SELECT * FROM tbl_customer WHERE customer_id =".$_SESSION['id']."";
    $res = mysqli_query($conn,$stmt);
    $val = mysqli_fetch_assoc($res);
?>
<!DOCTYPE html>
<html>

<head>

    <link rel="stylesheet" href="css/profile.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <title>Profile</title>
    <link href="images/pictures/logo.png" rel="icon">      
    <style>
        header{
            height: 11vh;
        }
        .profilepic img{
            width: 100%;
            height: 100%;
            border-radius: 50%;
        }
        #licensepreview{
            font-size: 22px;
            font-weight: 600;
            color: blueviolet;
            text-decoration: underline;
        }
        .upperdetail span{
            font-size: 16px;
            font-weight: 500;
        }
        .button a{
            color: white;
            text-decoration: none;
        }
    </style>
</head>

<body>
    <header>
        <?php
        include 'includes/heading.php';
        ?>
    </header>
    <div class="cover">
        <img src="images/pictures/profcov.jpg" width="100%">
    </div>

    <div class="profilepic">
        <img src="upload/images/profileImage/<?php echo $val['customer_pimage'];?>">
    </div>

    <div class="container">
        <div class="details">
            <div class="upperdetail">
                <p>
                    <?php echo $val['customer_uname']; if($val['status']=='1'){ echo ' <i class="fa fa-check-circle" style="color: green;"></i>'; }?><br>
                    <?php echo $val['customer_uemail'];?> <br> <br>
                </p>
            </div>
            <h2>Information</h2>
            <p>
                Phone Number: <?php echo $val['customer_phone'];?><br>
                Gender: <?php if($val['customer_gender']=="M"){ echo "Male";} else{ echo "Female";};?><br>
                Date of Birth: <?php echo $val['customer_dob'];?><br>
                Address: <?php echo $val['customer_address'];?><br>
                City: <?php echo $val['customer_city'];?><br>
                Country: <?php echo $val['customer_country'];?><br>
                Joined on: <?php echo $val['joindate'];?><br>
                <a id="licensepreview" href="upload/images/licenseImage/<?php echo $val['customer_licensep'];?>" target="_blank" rel="noopener noreferrer">Preview License</a><br>
            </p>
            <div class="buttonloc">
                <button class="button"><a href="editprofile.php">Edit Profile</a></button>
                <button class="button"><a href="editprofilepassword.php">Change Password</a></button>
                <button class="button"><a href="reservations.php">My Bookings</a></button>
                <?php
                //to find the order request pending numbers
                $stmt = "SELECT * FROM tbl_reserve WHERE suppliersid = ".$val['customer_id']." AND status != 'Unavailable' AND status != 'Cancelled' AND status != 'Completed' ";
                $rs = mysqli_query($conn,$stmt);
                $rowCount = mysqli_num_rows($rs);
                if(isset($_SESSION['type']))
                {
                    if($_SESSION['type']=='Supplier')
                    {
                ?>
                <button class="button"><a href="myposts.php">My Post</a></button>
                <button class="button"><a href="orderdashboard.php">Order Requests (<?php if(isset($rowCount)) echo $rowCount;?>)</a></button>
                <?php
                    }
                }
                ?>
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