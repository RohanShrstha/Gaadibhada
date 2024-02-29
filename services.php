<?php
    include 'includes/conn.php';
    session_start();
?>
<!DOCTYPE html>
<html>

<head>
    <link rel="stylesheet" href="css/services.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <title>Services</title>
    <link href="images/pictures/logo.png" rel="icon">
</head>

<body>
    <?php
    include 'includes/heading.php';
    ?>
    <br><br><br><br>
    <div class="cover">
        <img src="images/pictures/carcollection.jpg" width="100%">
        <div class="text">
            <hr>
            <hr>
            <h2>Life is too Shot</h2><br>
            <p>To drive boring vehicles</p><br>
            <hr>
            <hr>
        </div>
    </div>


    <area>
    <div class="content">
        <div class="upper box">
            <div class="upper">
                <div class="topic">
                    <div class="two-wheel">
                        <h1>Two-Wheeler</h1>
                        <button class="button">
                            <a href="products.php?category=twowheelers&type=Bike">    
                                <img src="images/pictures/bike1.jpg" alt="Picture not supported" width="400">
                                <div class="overlay">Bike</div>
                            </a>
                        </button>&nbsp;&nbsp;&nbsp;
                        <button class="button">
                            <a href="products.php?category=twowheelers&type=Scooter">
                                <img src="images/pictures/scooter1.jpg" alt="Picture not supported" width="400">
                                <div class="overlay">Scooter</div>
                            </a>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="content">
        <div class="lower box">
            <div class="lower">
                <div class="topic">
                    <h1>Four-Wheeler</h1>
                    <div class="four-wheel">
                        <button class="button">
                            <a href="products.php?category=fourwheelers&type=Car">
                                <img src="images/pictures/car1.jpg" alt="Picture not supported" width="400">
                                <div class="overlay">Car</div>
                            </a>
                        </button>
                        &nbsp;&nbsp;&nbsp;&nbsp;
                        <button class="button">
                            <a href="products.php?category=fourwheelers&type=Jeep">
                                <img src="images/pictures/jeep10.jpg" alt="Picture not supported" width="400">
                                <div class="overlay">Jeep</div>
                            </a>
                        </button>
                        &nbsp;&nbsp;&nbsp;&nbsp;<br><br><br>
                        <button class="button">
                            <a href="products.php?category=fourwheelers&type=Bus">
                                <img src="images/pictures/bus1.jpg" alt="Picture not supported" width="400">
                                <div class="overlay">Bus</div>
                            </a>
                        </button>
                        &nbsp;&nbsp;&nbsp;&nbsp;
                        <button class="button">
                            <a href="products.php?category=fourwheelers&type=Van">
                                <img src="images/pictures/van1.jpeg" alt="Picture not supported" width="400">
                                <div class="overlay">Van</div>
                            </a>
                        </button>
                        &nbsp;&nbsp;&nbsp;&nbsp;<br><br><br>
                        <center>
                            <button class="button">
                                <a href="products.php?category=fourwheelers&type=Delivery Truck">
                                    <img src="images/pictures/truck1.jpg" alt="Picture not supported" width="400" >
                                <div class="overlay">Delivery Truck</div>
                                </a>
                            </button>
                        </center>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </area>
    <br><br>

    <?php
    include 'includes/footer.php';
    ?>
</body>

</html>