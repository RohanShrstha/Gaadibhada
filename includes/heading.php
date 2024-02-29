<?php
    include 'userSessionDetails.php';
?>

<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" href="css/heading.css">
    <link href="images/pictures/logo.png" rel="icon">
</head>


<nav>
    <div class="menu">
        <div class="logo">
            <a href="home.php"><img src="images/pictures/logo1.png" width="255px "></a>
        </div>

        <ul class="nav-links">
            <li><a href="home.php">Home</a></li>
            <li><a href="reservations.php" class="log">Reservation</a></li>
            <div class="dropdown">
                <li><a href="services.php" class="log">Services</a></li>
                <div class="dropdown-content">
                    <a href="products.php?category=fourwheelers&type=Car">Car</a>
                    <a href="products.php?category=fourwheelers&type=Jeep">Jeeps</a>
                    <a href="products.php?category=fourwheelers&type=Bus">Bus</a>
                    <a href="products.php?category=fourwheelers&type=Van">Van</a>
                    <a href="products.php?category=twowheelers&type=Bike">Bike</a>
                    <a href="products.php?category=twowheelers&type=Scooter">Scooter</a>
                    <a href="products.php?category=fourwheelers&type=Delivery Truck">Delivery Truck</a>
                </div>
            </div>
            <li><a href="about.php">About</a></li>
            <?php
            if(isset($_SESSION['log_status']))
            {
            ?>
            <li><a href="./becomehost.php"><?php  if($_SESSION['type']=='Consumer'){ echo"Become a Host";} else{ echo "Add a product";}?></a></li>
            <?php
            }
            ?>
            <li><a href="contact.php">Contact</a></li>
            <?php
                if(isset($_SESSION['log_status']))
                {
            ?>
            <div class="dropdown">
                <li><a href="profile.php" class="log"><?php echo $_SESSION['username']; ?></a></li>
                <div class="dropdown-content">
                    <a href="profile.php">Profile</a>
                    <?php
                    if(isset($_SESSION['type']))
                    {
                        if($_SESSION['type'] == 'Supplier')
                        {
                        //to find the order request pending numbers
                        $stmt = "SELECT * FROM tbl_reserve WHERE suppliersid = ".$_SESSION['id']." AND status != 'Unavailable' AND status != 'Cancelled' AND status != 'Completed' ";
                        $rs = mysqli_query($conn,$stmt);
                        $rowCount = mysqli_num_rows($rs);
                    ?>
                    <a href="myposts.php">My Posts</a>
                    <a href="orderdashboard.php">Order Requests (<?php if(isset($rowCount)) echo $rowCount;?>)</a>
                    <?php
                        }
                    }
                    ?>
                    <!-- <a href="contact.php">Contact</a> -->
                    <a href="logout.php">Logout</a>
                </div>
            </div>
            <?php
                }
                else{
            ?>
            <li><a href="login.php">Login</a></li>
            <li><a href="signup.php">Signup</a></li>
            <?php
                }
            ?>
        </ul>

    </div>
</nav>