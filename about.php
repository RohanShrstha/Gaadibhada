<?php
    session_start();
?>
<!DOCTYPE html>
<html>

<head>
    <link rel="stylesheet" href="css/about.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <title>About</title>
    <link href="images/pictures/logo.png" rel="icon">
</head>

<body>
    <?php
        include 'includes/heading.php';
    ?>
    
    <br><br><br><br>
    <div class="cover">
        <img src="images/pictures/forabout.jpg" class="image" width="100%" height="50%">
    </div>
    <br><br>
    <h1>About Us</h1>
    <img class="makemoney" src="images/pictures/makemoney.png">
    <div class="about">   
    <p>Gaadibhada is an e-commerce platform that offers a solution for all the automobile rental needs of the customers.
        This web application provides varieties of automobiles such as scooters, bikes, cars, jeeps, buses, lorries, and
        other automobiles, which can be rented quickly and easily.<br><br>
        The primary goal of this project is to create a platform for bridging the gap between rental service providers and
        customers. This system is an online booking system designed to meet the specific needs of vehicle rental companies,
        travel agencies and travel companies. Here the suppliers can easily list and manage their different types of services.
        Customers who are interested in renting a vehicle can explore all the available options and rent the vehicle of their
        choice easily and quickly, just at the click of their mouse. This website will replace the traditional process of renting
        the vehicles, by automating the rental process. It'll also provides smooth and organized travel to the customers along
        with easy bookings and multiple payment options through the website.<br><br>
        Gaadibhada  will provide numerous advantages to both rental service providers and customers. To sell their services
        to customers, the various small to large rental vendors will use a common marketplace platform. They can provide a variety
        of services such as two-wheelers, four-wheelers, exotic vehicles, delivery vehicles, traveling vehicles, and so on. They 
        can easily post and update their services, as well as target various types of customers based on their services. They will 
        see an increase in their client base, which will increase their overall profit. Customers will also have access to a proper 
        online platform for renting automobiles. They will have a wide range of options to explore and choose different types of
        vehicles based on their needs. They won't have to go to the shop in person. They can conduct all of their research and 
        comparisons online, which saves them time and effort. They can also obtain detailed information about the various vehicles
        . And, because there will be a variety of vendors, there will be competition among sellers, which will benefit the customer
        with good discounts and lower prices. As a result, we anticipate that the final product will meet all of the needs of the 
        suppliers and customers. The web-application will be simple, interactive, informative, and manageable, allowing suppliers 
        to list their services and customers to easily obtain the various services offered.
    </p>
            
    </div>
    <br><br>
    <h1 class="developers">Our Developers</h1>
    <div class="row">
        <div class="column">
            <div class="card">
            <img src="images/pictures/rohan.jpg" alt="Rohan" class="developerimage" style="width:100%">
                <div class="container">
                    <h2>Rohan Shrestha</h2>
                    <p class="title">Developer</p>
                    <p>Mostly Worked on Frontend by using HTML, CSS and JavaScript. </p>
                    <p><a href="mailto:rohanshrstha@gmail.com"><button class="button">Contact</button></a></p>
                </div>
            </div>
        </div>

        <div class="column">
            <div class="card">
                <img src="images/pictures/sagar.jpg" alt="Sagar"  class="developerimage" style="width:100%">
                <div class="container">
                    <h2>Sagar Ghalan</h2>
                    <p class="title">Developer</p>
                    <p>Some text that describes me lorem ipsum ipsum lorem.</p>
                    <p><a href="mailto:sghalan1311@gmail.com"><button class="button">Contact</button></a></p>
                </div>
            </div>
        </div>
    </div>

    <br>
    <?php
        include 'includes/footer.php';
    ?>
</body>