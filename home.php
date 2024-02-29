<?php
    session_start();
?>
<!DOCTYPE html>
<html>

<head>
    <link rel="stylesheet" href="css/home.css">
    <title>Gaadibhada</title>
    <link href="images/pictures/logo.png" rel="icon">
</head>

<body>
    <?php
        include 'includes/heading.php';
    ?>
    <br><br><br><br>
    <div class="slideshow-container">
        <div class="mySlides fade">
            <div class="numbertext">1 / 5</div>
            <img src="images/pictures/rent.jpg" style="width:100%">
            <div class="text">Rent whatever Vehicle <br>You want without any Hesistation</div>
        </div>

        <div class="mySlides fade">
            <div class="numbertext">2 / 5</div>
            <img src="images/pictures/bikeride.jpg" style="width:100%">
            <div class="text">Every day is a Good Day<br><b>For a Ride</b></div>
        </div>

        <div class="mySlides fade">
            <div class="numbertext">3 / 5</div>
            <img src="images/pictures/carjeep.jpg" style="width:100%">
            <div class="text">Price is what you PAY<br>Value is what you GET</div>
        </div>

        <div class="mySlides fade">
            <div class="numbertext">4 / 5</div>
            <img src="images/pictures/1car.jpg" style="width:100%">
            <div class="text">No Road is too Long<br>When you have Good Company</div>
        </div>

        <div class="mySlides fade">
            <div class="numbertext">5 / 5</div>
            <img src="images/Pictures/jeep1.jpg" style="width:100%">
            <div class="text"><b>Travel !!!<br>Before you run out of Time...</div>
        </div>
    </div>
    <br>

    <div style="text-align:center">
        <span class="dot" onclick="currentSlide(1)"></span>
        <span class="dot" onclick="currentSlide(2)"></span>
        <span class="dot" onclick="currentSlide(3)"></span>
        <span class="dot" onclick="currentSlide(4)"></span>
        <span class="dot" onclick="currentSlide(5)"></span>
    </div>
  
    <div class="slides"> 
        <div class="slidepics"> 
            <table >
                <tr>
                    <td><img class="slideimage"  src="images/pictures/slides/1.jpg"></td>
                    <td><div class="slidetext"><h2>Find the perfect vehicle <span class="color">to conquer the great outdoors</span></h2><br>
                    <p>Go prepared in a rugged 4x4 to take on winter roads with ease, or a camper van to take you to the trees.</p><br>
                    <a href="services.php"><button class="button"><span>Explore Vehicles</span></button></a></td>
                    </div></td>
                </tr>
            </table>
        </div>

        <div class="slidepics">
        <table>
                <tr>
                    <td><img class="slideimage"  src="images/pictures/slides/2.jpg"></td>
                    <td><div class="slidetext">
                    <h2>Find the perfect vehicle <span class="color">to unwind for the weekend</span></h2><br>
                    <p>From daily drivers to spirited sports cars, ditch the grind with convenient nearby cars.</p><br>
                    <a href="services.php"><button class="button"><span>Explore Vehicles</span></button></a>
                    </div></td>
                </tr>
            </table>
        </div>

        <div class="slidepics">
        <table>
                <tr>
                    <td><img class="slideimage"  src="images/pictures/slides/3.jpg"></td>
                    <td><div class="slidetext">
                    <h2>Find the perfect vehicle <span class="color">to upgrade your vacation plans</span></h2><br>
                    <p>Skip the rental vehicle counter and find the perfect car to complement your vacation vibe.</p><br>
                    <a href="services.php"><button class="button"><span>Explore Vehicles</span></button></a>
                    </div></td>
                </tr>
            </table>
        </div>

        <div class="slidepics">
        <table>
                <tr>
                    <td><img class="slideimage"  src="images/pictures/slides/4.jpg"></td>
                    <td><div class="slidetext">
                    <h2>Find the perfect vehicle <span class="color">for scenic corners & curves</span></h2><br>
                    <p>Get your fill of high-performance thrills, with the richest selection of luxury and exotic vehicles anywhere.</p><br>
                    <a href="services.php"><button class="button"><span>Explore Vehicles</span></button></a>
                    </div></td>
                </tr>
            </table>
        </div>

        <div class="slidepics">
        <table>
                <tr>
                    <td><img class="slideimage"  src="images/pictures/slides/5.jpg"></td>
                    <td><div class="slidetext">
                    <h2>Find the perfect vehicle <span class="color">to try before you buy</span></h2><br>
                    <p>Make sure your future wheels work well with your lifestyle by taking your time in the driver's seat.</p><br>
                    <a href="services.php"><button class="button"><span>Explore Vehicles</span></button></a>
                    </div></td>
                </tr>
            </table>
        </div>

        <button class="prev" onclick="plusDivs(-1)">&#10094;</button>
        <button class="next" onclick="plusDivs(1)">&#10095;</button>
    </div>

    <script src="js/homeScript.js"></script>

    <div class="services">Our Services</div>

    <div class="btn" >
        <button class="abcd"><a href="products.php?category=twowheelers&type=Bike"><img src="images/pictures/bike2.jpg" width="100%">Bike</a></button>

        <button class="abcd"><a href="products.php?category=twowheelers&type=Scooter"><img src="images/pictures/scooter.jpg" width="100%">Scooter</a></button>

        <button class="abcd"><a href="products.php?category=fourwheelers&type=Car"><img src="images/pictures/car.jpg" width="100%">Car</a></button>
        
        <button class="abcd"><a href="products.php?category=fourwheelers&type=Jeep"><img src="images/pictures/jeep.jpg" width="100%">Jeeps</a></button>

        <button class="abcd"><a href="products.php?category=fourwheelers&type=Bus"><img src="images/pictures/bus.jpg" width="100%">Bus</a></button>

        <button class="abcd"><a href="products.php?category=fourwheelers&type=Van"><img src="images/pictures/Van.jpg" width="100%">Van</a></button>
        
        <button class="abcd"><a href="products.php?category=fourwheelers&type=Delivery Truck"><img src="images/pictures/pickuptruck.jpg" width="100%">Pick up Truck</a></button>
    </div>

    
    <div class="description">
        <img src='images/pictures/mancar.JPG' class="des-img">
        <img src='images/pictures/journey.jpg' class="des">
    </div>

    <div class="hands">
        <img class="handimage" src="images/pictures/hands.jpg">
        <div class="becomesupplier"><p class="handtext"><a href="services.php"><button class="button"><span>Rent a Vehicle</span></button>
        </a><br>Find the perfect vehicle for your next adventure, tour and travel.</p></div>
        <div class="becomehost"><p class="handtext"><a href="becomehost.php"><button class="button"><span>Become a Host</span></button></a>
        <br>Accelerate your entrepreneurship and start building a small vehicle sharing business on Gaadibhada.</p></div>
    </div>
    
    <?php
        include 'includes/footer.php';
    ?>

</body>

</html>