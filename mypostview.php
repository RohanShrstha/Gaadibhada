<?php
include 'includes/conn.php';

session_start();
if(!isset($_SESSION['log_status']))
{
    header('location:login.php');
}

if(empty($_GET['id'])||empty($_GET['category']))
{
    header('location:myposts.php');
}
$id = $_GET['id'];
$category = $_GET['category'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/mypostview.css">
    <link rel="stylesheet" href="css/mypostview_action.css">
    <link href="images/pictures/logo.png" rel="icon">
    <title>My post View</title>
</head>
<body>
    <div class="header">
        <?php
            include 'includes/heading.php';
        ?>
    </div>
    <div class="container">
        <?php
            
            $sql = "SELECT * FROM tbl_vehicles WHERE id='$id' AND category = '$category'";
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
                                <tr>
                                    <td><b>Seats</b></td>
                                    <td><?php echo $value['seats'];?></td>
                                </tr>
                                <tr>
                                    <td><b>Doors</b></td>
                                    <td><?php echo $value['doors'];?></td>
                                </tr>
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
                <div class="action-container">
                    <div class="a-content">
                        <div class="sub-title">Action</div>
                        <div class="status sub-title">Status: <span><?php echo $value['status']?></span>
                        </div>
                        <div class="buttons">
                            <a href="<?php if($value['category']=='fourwheelers'){ echo "updatefourwheelers.php";}else{ echo 'updatetwowheelers.php';}?>?id=<?php echo $id;?>"><button>Update</button></a>
                            <a href="deleteproduct.php?id=<?php echo $id;?>"><button onclick="deleteconfirm()">Delete</button></a>
                        </div>
                    </div>
                </div>
            </section>
        </div>
        <?php
            }
            else
            {
                echo '<div class="message">No File Found</div>';
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
        function deleteconfirm()
        {
            let confirmValue = confirm('Do you want to delete this post?');
            if(!confirmValue)
            {
                event.preventDefault();
            }
        }
</script>
</body>
</html>