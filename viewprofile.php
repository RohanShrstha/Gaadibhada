<?php
    include 'includes/conn.php';
    session_start();
    $id = $_GET['id'];

    $stmt = "SELECT * FROM tbl_customer WHERE customer_id = '$id'";
    $res = mysqli_query($conn,$stmt);
    $val = mysqli_fetch_assoc($res);
?>
<!DOCTYPE html>
<html>

<head>

    <link rel="stylesheet" href="css/viewprofile.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <title>Gaadibhada</title>
    <link href="images/pictures/logo.png" rel="icon">      
    <style>
        
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
                    <?php echo $val['customer_uemail'];?> <br>
                    <br>
                </p>
            </div>
            
            <div class="lowerdetail">
                    <h2>Information</h2>
                    Phone Number: <?php echo $val['customer_phone'];?><br>
                    Date of Birth: <?php echo $val['customer_dob'];?><br>
                    Address: <?php echo $val['customer_address'];?><br>
                    City: <?php echo $val['customer_city'];?><br>
                    Country: <?php echo $val['customer_country'];?><br>
                    Joined on: <?php echo $val['joindate'];?><br>
                    <?php
                    if($val['customer_licensep'] != "default.png")
                    {
                    ?>
                        <a id="licensepreview" href="upload/images/licenseImage/<?php echo $val['customer_licensep'];?>" target="_blank" rel="noopener noreferrer">Preview License</a><br>
                    <?php
                    }
                    ?>
            </div>

        </div>
    </div>

    <?php
    include 'includes/footer.php';
    ?>
</body>

</html>