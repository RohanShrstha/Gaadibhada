<?php
    include 'includes/conn.php';
    session_start();
    if(!isset($_SESSION['alogin']))
	{
		header('location:index.php');
	}
    $id = $_GET['id'];

    $stmt = "SELECT * FROM tbl_customer WHERE customer_id = '$id'";
    $res = mysqli_query($conn,$stmt);
    $val = mysqli_fetch_assoc($res);
?>

<!DOCTYPE html>

<head>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <title>User Details</title>
    <link href="img/logo.png" rel="icon">
    <style>
        * {
        margin: 0px;
        padding: 0px;
        }
        .container {
            width: 83%;
            margin-left: 250px;
            padding-top: 86px;
            margin-bottom: 30px;
        }
        .profilepic img {
            width: 100%;
            height: 100%;
            border-radius: 50%;
        }

        #licensepreview {
            font-size: 22px;
            font-weight: 600;
            color: blueviolet;
            text-decoration: underline;
        }

        .upperdetail span {
            font-size: 16px;
            font-weight: 500;
        }

        .button a {
            color: white;
        }

        .cover {
            position: relative;
        }

        .profilepic {
            position: relative;
            height: 15vw;
            width: 15vw;
            border-radius: 50%;
            margin: -12% 0 0 38%;
            background-color: aqua;
        }

        .dcontainer {
            margin: 1% 16% 120px 15%;
            display: flex;
            justify-content: center;
        }

        .details {
            width: 800px;
            display: flex;
            justify-content: space-around;
        }

        .upperdetail p {
            font-size: 25px;
            font-weight: bold;
        }

        .lowerdetail {
            margin-bottom: 1px;
            font-size: 20px;
            line-height: 1.6;
        }

        .details .lowerdetail h2 {
            font-size: 30px;
            margin: 0 auto 10px;
            text-decoration: underline;
        }
    </style>
</head>

<body>
    <?php
    include 'includes/header.php';
    ?>
    <div class="container">
        <div class="cover">
            <img src="img/profcov.jpg" width="100%">
        </div>

        <div class="profilepic">
            <img src="../upload/images/profileImage/<?php echo $val['customer_pimage'];?>">
        </div>

        <div class="dcontainer">
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
                        Gender: <?php if($val['customer_gender']=="M"){ echo "Male";} else{ echo "Female";};?><br>
                        Date of Birth: <?php echo $val['customer_dob'];?><br>
                        Address: <?php echo $val['customer_address'];?><br>
                        City: <?php echo $val['customer_city'];?><br>
                        Country: <?php echo $val['customer_country'];?><br>
                        Joined on: <?php echo $val['joindate'];?><br>
                        <?php
                        if($val['customer_licensep'] != "default.png")
                        {
                        ?>
                            <a id="licensepreview" href="../upload/images/licenseImage/<?php echo $val['customer_licensep'];?>" target="_blank" rel="noopener noreferrer">Preview License</a><br>
                        <?php
                        }
                        ?>
                </div>

            </div>
        </div>
    </div>
</body>

</html>