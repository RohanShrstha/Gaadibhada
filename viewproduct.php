<?php
include 'includes/conn.php';
include 'includes/userSessionDetails.php';
session_start();

$id = $_GET['id'];
$category = $_GET['category'];

if($category == 'fourwheelers')
{
    $sql = "SELECT * FROM tbl_vehicles WHERE id = '$id'";
}
if($category == 'twowheelers')
{
    $sql = "SELECT * FROM tbl_vehicles WHERE id = '$id'";
}
$res = mysqli_query($conn,$sql);
$v = mysqli_fetch_assoc($res); 
if(isset($_SESSION['id']))
    {
        $customerid = $_SESSION['id'];
    }
$supplierid = $v['supplierid'];
if(isset($v['selfdrive']))
{
    $selfdrive = $v['selfdrive'];
}

$price = intval($v['price']);

if(isset($_POST['reserve']))
{
    if(isset($_SESSION['log_status']))
    {
        if($_SESSION['profilecomplete'] == 1)
        {
            include 'includes/getDay.php';

            $sdate = $_POST['sdate'];
            $stime = $_POST['stime'];
            $edate = $_POST['edate'];
            $etime = $_POST['etime'];
            $location = $_POST['location'];
            if(empty($_POST['driveoption']))
            {
                $driveoption = NULL;
            }
            else{
                $driveoption = $_POST['driveoption'];
            }
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

            $sql = "INSERT INTO tbl_reserve(customersid,suppliersid,vehicleid,category,sdate,stime,edate,etime,location,driveoption,message,priceperday,totalcost) VALUES('$customerid','$supplierid','$id','$category','$sdate','$stime','$edate','$etime','$location','$driveoption','$message','$priceperday','$totalcost')";

            if(mysqli_query($conn,$sql))
            {
                // echo "<script>alert('Vehicle Reserve Request has been sent');</script>";
                // $_SESSION['request_message'] = "Vehicle Reserve Request has been sent";
                header('location:reservations.php');
            }
            else
            {
                echo "<script>alert('Error in Reserving');</script>";
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

if($category == 'fourwheelers')
{
    $sql = "SELECT * FROM tbl_vehicles WHERE id='$id'";
    $result = mysqli_query($conn,$sql);
}
else if($category == 'twowheelers')
{
    $sql = "SELECT * FROM tbl_vehicles WHERE id='$id'";
    $result = mysqli_query($conn,$sql);
}
else
{
    echo "No Product Found";
}

if(mysqli_num_rows($result)>0)
{
    $value = mysqli_fetch_assoc($result);

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/viewproduct.css">
    <script src="js/reserveformvalidate.js"></script>
    <title>Gaadibhada</title>
    <style>
        .alertmsg{
            width: 100%;
            height: 5vh;
            background-color: brown;
            border: 2px solid black;
            position: absolute;
        }
    </style>
</head>
<body>
    <div class="header">
        <?php
            include 'includes/heading.php';
        ?>
    </div>
    <div class="container">
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
                    <div class="title"><?php echo $value['title']?></div>
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
                </section>
            </div>
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
?>