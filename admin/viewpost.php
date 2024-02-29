<?php
    include 'includes/conn.php';
    session_start();
    if(!isset($_SESSION['alogin']))
	{
		header('location:index.php');
	}
    $id = $_GET['id'];
    $category = $_GET['category'];

    
    $sql = "SELECT * FROM tbl_vehicles WHERE id='$id' AND category='$category'";
    $result = mysqli_query($conn,$sql);
    

    if(mysqli_num_rows($result)>0)
    {
        $value = mysqli_fetch_assoc($result);
    }
    else
    {
        echo "No Product Found";
    }
?>

<!DOCTYPE html>

<head>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <title>Manage Vehicles</title>
    <link href="img/logo.png" rel="icon">
    <style>
        * {
    margin: 0px;
    padding: 0px;
        }
        .container {
            width: 84%;
            margin-left: 250px;
            padding-top: 86px;
            margin-bottom: 30px;
        }

        .container .imgsection {
            width: 100%;
            height: 35vw;
            background-color: #bbb;
        }

        .container .imgsection .slideshow-container {
            width: 100%;
            height: 100%;
            position: relative;
            margin: auto;
        }

        .container .imgsection .slideshow-container .mySlides {
            width: 100%;
            height: 100%;
        }

        .container .imgsection .slideshow-container img {
            width: 100%;
            height: 100%;
            object-fit: contain;
        }

        .prev,
        .next {
            cursor: pointer;
            position: absolute;
            top: 50%;
            width: auto;
            padding: 16px;
            margin-top: -22px;
            color: white;
            font-weight: bold;
            font-size: 18px;
            transition: 0.6s ease;
            border-radius: 0 3px 3px 0;
            user-select: none;
            color: black;
        }

        .prev {
            margin-left: 10px;
        }

        .next {
            margin-right: 10px;
        }

        .next {
            right: 0;
            border-radius: 3px 0 0 3px;
        }

        .prev:hover,
        .next:hover {
            background-color: rgba(0, 0, 0, 0.8);
        }

        .sub-container {
            width: 100%;
            height: auto;
            display: flex;
            justify-content: center;
            margin-top: 15px;
        }

        .sub-container section {
            width: 80vw;
            height: inherit;
            display: flex;
            justify-content: center;
        }

        .sub-container section .productinfo {
            width: 70%;
            height: auto;
        }

        .title {
            width: 100%;
            height: 8vh;
            font-size: 40px;
            font-weight: bold;
            padding: 5px;
            box-sizing: border-box;
        }

        .price {
            width: 100%;
            height: 4vh;
            font-size: 1.3rem;
            padding: 5px;
            box-sizing: border-box;
            font-weight: bold;
        }

        .detailinfo {
            width: 100%;
            height: auto;
            display: flex;
        }

        .details,
        .features {
            width: 50%;
            height: 40vh;
            padding: 5px;
            box-sizing: border-box;
        }

        .details {
            font-size: 1.2rem;
        }

        .sub-title {
            font-size: 1.4rem;
            font-weight: bold;
            margin: 5px 0px;
        }

        table {
            margin-left: 20px;
        }

        .features ul {
            margin-left: 30px;
            font-size: 1.2rem;
            display: flex;
            flex-wrap: wrap;
            flex-direction: row;
        }

        td {
            width: 10vw;
            height: 4vh;
        }

        .features ul li {
            width: 11vw;
            min-height: 4vh;
            height: auto;
            flex-grow: 1;
        }

        .description,
        .host {
            width: 100%;
            padding: 10px;
            box-sizing: border-box;
            font-size: 1.2rem;
        }

        .text {
            padding: 10px;
            box-sizing: border-box;
        }

        .host .detail {
            display: flex;
        }

        .detail {
            padding: 5px;
        }

        .profile {
            width: 4vw;
        }

        .pimg {
            height: 50px;
            width: 50px;
            background-color: #bbb;
            border-radius: 50%;
            display: inline-block;
        }

        .pimg img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            border-radius: 50%;
        }

        .link {
            cursor: pointer;
        }


        span {
            font-size: 0.98rem;
        }

        .legalinfo{
            background: beige;
            height: 200px;
            width: 30%;
            padding: 5px;
            border-radius: 8px;
            margin: 60px 50px;
            text-align: center;
        }
        .legalinfo .title{
            height: 4vh;
            padding: 2px;
            font-size: 18px;
            font-weight: 600;
            border-bottom: 1px solid black;
        }
        .legalinfo .info{
            padding: 2px 10px;
            line-height: 24px;
        }
        .legalinfo .info a button{
            width: 100%;
            height: 50px;
            background-color: blueviolet;
            color: white;
            cursor: pointer;
            border-radius: 10px;
            font-size: 18px;
            margin: 10px 0px;
        }
        .legalinfo .info a button:hover{
            opacity: 80%;
            transform: scale(1.01);
        }
    </style>
</head>

<body>
    <?php
    include 'includes/header.php';
    ?>
    <div class="container">
        <div class="imgsection">
            <div class="slideshow-container">
                <?php
                    if($value['img1'] != "")
                    {
                        echo '<div class="mySlides">
                                <img src="../upload/images/vehicleImage/'.$value['img1'].'">
                            </div>';
                    }
                    if($value['img2'] != "")
                    {
                        echo '<div class="mySlides">
                                <img src="../upload/images/vehicleImage/'.$value['img2'].'">
                            </div>';
                    }
                    if($value['img3'] != "")
                    {
                        echo '<div class="mySlides">
                                <img src="../upload/images/vehicleImage/'.$value['img3'].'">
                            </div>';
                    }
                    if($value['img4'] != "")
                    {
                        echo '<div class="mySlides">
                                <img src="../upload/images/vehicleImage/'.$value['img4'].'">
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
                            <div class="pimg"><img src="../upload/images/profileImage/<?php echo $sv['customer_pimage'];?>"></div>
                        </div>
                        <div class="hinfo">
                            <div class="hostname link"><b><?php echo $sv['customer_uname'];?></b></div>
                            <div class="hostdetail">Joined : <?php echo $sv['joindate'];?></div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="legalinfo">
                <div class="title">Legal Documents</div>
                <div class="info">
                    <a href="../upload/files/<?php echo $value['billbookd'];?>" target="_blank" rel="noopener noreferrer"><button>View Bill Book Document</button></a>
                    <a  href="../upload/files/<?php echo $value['insuranced'];?>" target="_blank" rel="noopener noreferrer"><button>View Insurance Document</button></a>
                </div>
            </div>
            </section>
        </div>
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