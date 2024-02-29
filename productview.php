<?php
include 'includes/conn.php';
include 'includes/userSessionDetails.php';
session_start();

if(isset($_GET['id']) && isset($_GET['category']))
{

    $id = $_GET['id'];
    $category = $_GET['category'];

    if(strlen($category) == 0 || strlen($id) == 0)
    {
        header('location:services.php');
    }


    //to get license status of user
    if(isset($_SESSION['id'])){

    
    $stmt1 = "SELECT * FROM tbl_customer where customer_id =".$_SESSION['id'];
    $r1 = mysqli_query($conn,$stmt1);
    $cv = mysqli_fetch_assoc($r1);
    }

    
    $sql = "SELECT * FROM tbl_vehicles WHERE id = '$id' AND category = '$category'AND status = 'Verified'";
    

    $res = mysqli_query($conn,$sql);
    $v = mysqli_fetch_assoc($res); 
    if(isset($_SESSION['id']))
        {
            $customerid = $_SESSION['id'];
        }
    if(isset($v['supplierid']))
        $supplierid = $v['supplierid'];
    if(isset($v['selfdrive']))
    {
        $selfdrive = $v['selfdrive'];
    }
    if(isset($v['price']))
        $price = intval($v['price']);

    if(isset($_POST['reserve']))
    {
        if(isset($_SESSION['log_status']))
        {
            
            if($_SESSION['profilecomplete'] == 1)
            {
                if($_SESSION['customer_status'] == 1)
                {
                    if(($cv['customer_licensep'] =='default.png') && ($category == "twowheelers"))
                    {
                        echo "<script>alert('You do not have license to reserve two wheelers')</script>";
                        
                    }
                    else
                    {
                        
                        include 'includes/getDay.php';

                        $sdate = $_POST['sdate'];
                        $stime = $_POST['stime'];
                        $edate = $_POST['edate'];
                        $etime = $_POST['etime'];
                        $location = $_POST['location'];

                        if(isset($_POST['driveoption']))
                            $driveoption = $_POST['driveoption'];
                        else
                            $driveoption = 2;
                        
                        $priceperday = intval($price);
                        $day = getDay($sdate,$edate);
                        $totalcost = $priceperday * $day;

                        if(isset($_POST['message']))
                        {
                            $message = $_POST['message'];
                        }
                        else{
                            $message = "";
                        }

                        $tsdate = strtotime($sdate);
                        $tedate = strtotime($edate);
                        
                        $rs = $conn->query("SELECT * FROM tbl_reserve WHERE vehicleid = '$id' AND category = '$category' AND status = 'Confirmed'");
                        if($rs->num_rows>0)
                        {
                            
                            while($row = $rs->fetch_assoc())
                            {
                                $dsdate = strtotime($row['sdate']);
                                $dedate = strtotime($row['edate']);
                                if($tsdate>=$dsdate && $tsdate <= $dedate)
                                {
                                    $serror = 'error';
                                }
                                if($tedate>=$dsdate && $tedate <= $dedate)
                                {
                                    $eerror = 'error';
                                }
                            }
                        }
                        

                        if(!isset($serror) && !isset($eerror))
                        {
                            $sql = "INSERT INTO tbl_reserve(customersid,suppliersid,vehicleid,category,sdate,stime,edate,etime,location,driveoption,message,priceperday,totalcost) VALUES('$customerid','$supplierid','$id','$category','$sdate','$stime','$edate','$etime','$location','$driveoption','$message','$priceperday','$totalcost')";

                            if(mysqli_query($conn,$sql))
                            {
                                header('location:reservations.php');
                            }
                            else
                            {
                                echo "<script>alert('Error in Reserving');</script>";
                            }
                        }
                        else
                        {
                            echo"<script>window.location.href='#form'</script>";
                        }
                    }
                   
                }
                else
                {
                    echo "
                    <script>
                        alert('Your account is not verified yet. Please wait for account verification');
                    </script>";
                }
                
            }
            else
            {
                $_SESSION['incompleteprofile'] = 1;
                header('location:editprofile.php');
            }
            
        }
        else
        {
            $_SESSION['message'] = "Please Login to Reserve";
            header('location:login.php');
        }
        
    }

    


?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/productview.css">
    <script src="js/reserveformvalidate.js"></script>
    <title>Product view</title>
    <link href="images/pictures/logo.png" rel="icon">
</head>
<body>
    <div class="header">
        <?php
            include 'includes/heading.php';
        ?>
    </div>
    <div class="container">
        <?php
       
        $sql = "SELECT * FROM tbl_vehicles WHERE id='$id' AND status = 'Verified' AND category='$category'";
        $result = mysqli_query($conn,$sql);
       
        if(mysqli_num_rows($result)>0)
        {
            $value = mysqli_fetch_assoc($result);
        ?>
        <div class="imgsection">
            <div class="slideshow-container">
                <?php
                    if($value['img1'] != "")
                    {
                        echo '<div class="mySlides">
                                <img src="upload/images/vehicleImage/'.$value['img1'].'">
                            </div>';
                    }
                    if($value['img2'] != "")
                    {
                        echo '<div class="mySlides">
                                <img src="upload/images/vehicleImage/'.$value['img2'].'">
                            </div>';
                    }
                    if($value['img3'] != "")
                    {
                        echo '<div class="mySlides">
                                <img src="upload/images/vehicleImage/'.$value['img3'].'">
                            </div>';
                    }
                    if($value['img4'] != "")
                    {
                        echo '<div class="mySlides">
                                <img src="upload/images/vehicleImage/'.$value['img4'].'">
                            </div>';
                    }
                ?>
                <a class="prev" onclick="plusSlides(-1)">&#10094;</a>
                <a class="next" onclick="plusSlides(1)">&#10095;</a>
            </div>
        </div>
        <div class="sub-container">
            <section>
            <div class="productinfo">
                <div class="title"><?php echo $value['title'];?></div>
                <hr>
                <div class="price">Price: Rs. <?php echo $value['price'];?></div>
                <div class="detailinfo">
                    <div class="details">
                        <div class="sub-title">Details</div>
                        <table>
                            <tr>
                                <td><b>Brand</b></td>
                                <td><?php echo $value['brand'];?></td>
                            </tr>
                            <tr>
                                <td><b>Type</b></td>
                                <td><?php echo $value['type'];?></td>
                            </tr>
                            <?php
                            if($category == 'fourwheelers')
                            {

                            ?>
                            <tr>
                                <td><b>Seats</b></td>
                                <td><?php echo $value['seats'];?></td>
                            </tr>
                            <tr>
                                <td><b>Doors</b></td>
                                <td><?php echo $value['doors'];?></td>
                            </tr>
                            <?php
                            }
                            ?>
                            <tr>
                                <td><b>Fuel Type</b></td>
                                <td><?php echo $value['fuel'];?></td>
                            </tr>
                            <tr>
                                <td><b>Mileage</b></td>
                                <td><?php echo $value['mileage'];?> km</td>
                            </tr>
                            <tr>
                                <td><b>Engine</b></td>
                                <td><?php echo $value['engine'];?> CC</td>
                            </tr>
                            <tr>
                                <td><b>Make year</b></td>
                                <td><?php echo $value['makeyear'];?></td>
                            </tr>
                        </table>
                    </div>
                    <div class="features">
                        <div class="sub-title">Features</div>
                        <ul>
                        <?php
                            $features = explode(',',$value['features']);
                            foreach($features as $v)
                            {
                                echo "<li>".$v."</li>";
                            }
                        ?>
                        </ul>
                    </div>
                </div>
                <div class="description">
                    <div class="sub-title">Description</div>
                    <div class="text"><?php echo $value['description'];?>
                    </div>
                </div>
                <div class="host">
                    <div class="sub-title">Hosted By:</div>
                    <div class="detail">
                        <?php
                            $stmt = "SELECT * FROM tbl_customer where customer_id =".$value['supplierid'];
                            $r = mysqli_query($conn,$stmt);
                            $sv = mysqli_fetch_assoc($r);
                        ?>
                        <div class="profile link">
                            <div class="pimg"><img src="upload/images/profileImage/<?php echo $sv['customer_pimage'];?>"></div>
                        </div>
                        <div class="hinfo">
                            <div class="hostname link"><b><?php echo $sv['businessname'];?></b></div>
                            <div class="hostdetail">Joined : <?php echo $sv['joindate'];?></div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="bookform">
                <div class="formbody">
                    <!-- <form action="#" id="form" method="post"> -->
                    <form action="#" id="form" method="post" onsubmit="return reserveValidate()">
                        <div class="input-boxes">
                            <div class="label">Trip Start</div>
                            <input type="date" name="sdate" id="sdate" <?php if(isset($_POST['sdate'])){ echo 'value="'.$_POST['sdate'].'""';}?>>
                            <input type="time" name="stime" id="stime" <?php if(isset($_POST['stime'])){ echo 'value="'.$_POST['stime'].'""';}?>>
                            <div class="msg"><?php if(isset($serror)){ echo "Selected Date Unavaliable";}?></div>
                        </div>
                        <div class="input-boxes">
                            <div class="label">Trip End</div>
                            <input type="date" name="edate" id="edate" <?php if(isset($_POST['edate'])){ echo 'value="'.$_POST['edate'].'""';}?>>
                            <input type="time" name="etime" id="etime" <?php if(isset($_POST['etime'])){ echo 'value="'.$_POST['etime'].'""';}?>>
                            <div class="msg"><?php if(isset($eerror)){ echo "Selected Date Unavaliable";}?></div>
                        </div>
                        <div class="input-boxes">
                            <div class="label">Pickup or Drop location</div>
                            <textarea name="location" id="location"><?php if(isset($_POST['location'])){ echo $_POST['location'];}?></textarea>
                            <div class="msg"></div>
                        </div>
                        <?php
                            if($category == 'fourwheelers' && $selfdrive == '1')
                            {
                        ?>
                        <div class="input-boxes">
                            <div class="label">Driving Options</div>
                            <input type="radio" name="driveoption" id="driveoption" value="1"
                            <?php 
                            if(isset($_POST['driveoption']))
                            { 
                                if($_POST['driveoption'] == 1)
                                { echo 'checked';}
                            }
                            if(isset($_SESSION['license_status']))
                            {
                                if($_SESSION['license_status'] == 0)
                                {
                                    echo "disabled";
                                }
                            }
                            ?>
                            >Self
                            <input type="radio" name="driveoption" id="driveoption" value="2" 
                            <?php
                            if(isset($_POST['driveoption']))
                            {
                                if($_POST['driveoption'] == 2)
                                { echo 'checked';}
                            }
                            ?>>Hire a driver
                            <div class="msg"></div>
                        </div>
                        <?php
                            }
                        ?>
                        <div class="input-boxes">
                            <div class="label">Message  <span>(if you want to leave any message)</span></div>
                            <textarea name="message" id="message"><?php if(isset($_POST['message'])){ echo $_POST['message'];}?></textarea>
                            <div class="msg"></div>
                        </div>
                        <div class="button">
                            <center>
                                <?php
                                if(isset($_SESSION['id']))
                                {
                                ?>
                                <input type="submit" name="reserve" id="reserve" value="Reserve">
                                <?php
                                }
                                else
                                {
                                ?>
                                <input type="button" id="reserve" value="Login to Reserve" onclick="window.location.href='login.php'">
                                <?php
                                }
                                ?>
                            </center>
                        </div>
                        <div class="info">
                            <?php 
                                if(isset($_SESSION['customer_status']))
                                {
                                    if(($_SESSION['customer_status']) == 0)
                                    {
                                        echo '<center style="margin-top: 10px; color: red;"> !! Account is not verified yet to reserve</center>';
                                    }
                                }
                            ?>
                        </div>
                    </form>
                </div>
                <?php
                    if(isset($_SESSION['id']))
                    {
                    ?>
                    <div class="bookinfo">
                        <div class="title">Vehicle Unavaiable dates</div>
                        <div class="info">
                            <?php
                            $rs = $conn->query("SELECT * FROM tbl_reserve WHERE vehicleid = '$id' AND category = '$category' AND status = 'Confirmed'");
                            if($rs->num_rows>0)
                            {
                                while($row = $rs->fetch_assoc())
                                    echo $row['sdate']." to ".$row['edate']."<br>";
                            }
                            else
                            {
                                echo "None";
                            }
                            ?>
                        </div>
                    </div>
                    <?php
                    }
                ?>
            </div>
            </section>
        </div>
        <?php
        }
        else
        {
            echo '<div style="margin: auto; padding: 50px;"><center>No post found</center></div>';
        }
        ?>
    </div>
    <div class="footer">
		<?php
			include 'includes/footer.php';
		?>
	</div>
    <script>
        var slideIndex = 1;
        showSlides(slideIndex);
        function plusSlides(n) {
            showSlides(slideIndex += n);
        }
        function showSlides(n) {
            var i;
            var slides = document.getElementsByClassName("mySlides");
            if(n > slides.length) {
            slideIndex = 1
            }
            if(n < 1) {
            slideIndex = slides.length
            }
            for(i = 0; i < slides.length; i++) {
            slides[i].style.display = "none";
            }
            slides[slideIndex - 1].style.display = "block";
        }
    </script>
</body>
</html>
<?php
}
else
{
    header('location:services.php');
}

?>