<?php
    include 'includes/conn.php';
    session_start();
    if(!isset($_SESSION['log_status']))
    {
        $_SESSION['message'] = "Please Login to View Reservations";
        header('location:login.php');
    }
    
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reservations</title>
    <link href="images/pictures/logo.png" rel="icon">
    <style>
        *{
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        .container{
            width: 100%;
            min-height: 80vh;
            display: flex;
            justify-content: center;
            flex-wrap: wrap;
        }
        section{
            width: 80vw;
            min-height: 70vh;
            padding: 5px;
        }
        .section-title{
            width: 100%;
            height: 50px;
            text-align: center;
            font-size: 2em;
            font-weight: 600;
        }
        .info-card{
            width: 100%;
            height: 340px;
            border: 2px solid black;
            border-radius: 8px;
            display: flex;
            padding: 1px;
            margin-bottom: 10px;
        }
        .img-section{
            width: 30%;
            height: 100%;
            padding: 5px;
        }
        .info-card .img-section .title a{
            color: black;
        }
        .img-section a img{
            width: 100%;
            height: 100%;
            border-radius: 8px;
            object-fit: cover;
        }
        .info-section{
            width: 70%;
            padding: 5px;
        }
        .title{
            width: 100%;
            height: 5vh;
            font-size: 1.5em;
            font-weight: bold;
            padding: 5px;
        }
        .info-section .title a:hover{
            color: blueviolet;
        }
        .info-box{
            width: 100%;
            height: auto;
            display: flex;
        }
        .reservedetails{
            width: 70%;
            height: auto;
        }
        .text{
            font-size: 1.2em;
            font-weight: bold;
            padding: 5px;
        }
        .sub-text{
            display: inline-block;
            width: 40%;
            font-size: 1.2em;
            padding: 5px 15px;
        }
        .status-section{
            width: 30%;
        }
        .buttons{
            margin: 30px 0px;
            width: 100%;
            height: auto;
            display: flex;
            flex-wrap: wrap;
            justify-content: space-around;
            align-content: center;
        }
        .buttons button{
            min-width: 100px;
            height: 5vh;
            background-color: blueviolet;
            border-radius: 8px;
            font-size: 1.2em; 
            margin-top: 10px;
            padding: 5px;
            color: white;
            cursor: pointer;
        }
        button:hover{
            background-color: rgb(140, 28, 244);
            transform: scale(1.1);
        }
        a{
            text-decoration: none;
            color: black;
        }
        .unclickable{
            pointer-events: none;
            opacity: 50%;
        }
        .semi-unclick{
            pointer-events: none;
            cursor: default;
            background-color
        }
        .header{
            height: 11vh;
        }
        #location{
            width: 100%;
            height: auto;
            word-wrap: break-word;
        }
        .pagenavigation{
            margin: 10px;
            width: 80vw;
            height: auto;
            display: flex;
            justify-content: center;
        }
        .pagenavigation ul li{
            display: inline-block;
            margin: 0px;
            padding: 1px;
            border: solid black 1px;
        }
		.pagenavigation ul li:hover{
			transform: scale(1.1);
            background-color: blueviolet;
		}
        .pagenavigation ul li a{
            color: black;
            text-decoration: none;
        }
        .active{
            background-color: blueviolet;
        }
        .displaynone{
            display: none;
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
        <section>
            <div class="section-title">
                Your Reservations
            </div>
        <?php
            if(isset($_GET['page'])){
                $page = $_GET['page'];
            }
            else{
                $page = 1;
            }
            $contents_per_page = 6;
            $offset = ($page-1)*$contents_per_page;

            $sql = "SELECT * FROM tbl_reserve WHERE customersid = ".$_SESSION['id']." ORDER BY id DESC limit $offset,$contents_per_page";
            $result = mysqli_query($conn,$sql);
            if(mysqli_num_rows($result) > 0)
            {
                while($value = mysqli_fetch_assoc($result))
                {
                    $id = $value['vehicleid'];
                    if($value['category'] == 'fourwheelers')
                    {
                        $stmt = "SELECT * FROM tbl_vehicles WHERE id = '$id'";
                    }
                    else
                    {
                        $stmt = "SELECT * FROM tbl_vehicles WHERE id = '$id'";  
                    }
                    $rs = mysqli_query($conn,$stmt);
                    $v = mysqli_fetch_assoc($rs);
        ?>
            <div class="info-card">
                <div class="img-section">
                    <a href="productview.php?id=<?php echo$v['id'];?>&category=<?php echo $v['category'];?>">
                        <img src="upload/images/vehicleImage/<?php echo $v['img1'];?>" alt="img not found">
                    </a>
                </div>
                <div class="info-section">
                    <div class="title">
                        <a href="productview.php?id=<?php echo$v['id'];?>&category=<?php echo $v['category'];?>">
                        <?php echo $v['title'];?>
                        </a>
                    </div>
                    <hr>
                    <div class="info-box">
                        <div class="reservedetails">
                            <div class="text">Trip Start</div>
                            <div class="sub-text">Date: <?php echo $value['sdate'];?></div>
                            <div class="sub-text">Time: <?php echo $value['stime'];?></div>
                            <div class="text">Trip End</div>
                            <div class="sub-text">Date: <?php echo $value['edate'];?></div>
                            <div class="sub-text">Time: <?php echo $value['etime'];?></div>
                            <div class="text">Pickup or Drop location</div>
                            <div class="sub-text" id="location"><?php echo $value['location'];?></div>
                            <div class="text">Total Price</div>
                            <div class="sub-text">Rs: <?php echo $value['totalcost'];?></div>
                        </div>
                        <div class="status-section">
                            <div class="statusdetails">
                                <div class="text">Status: <?php if($v['status'] =='Deleted' || $v['status'] == 'Delete Read'){ echo 'Post Deleted';}
                                else{ echo $value['status'];}?></div>
                                
                                <div class="buttons 
                                <?php 
                                    if($v['status'] =='Deleted' || $v['status'] == 'Delete Read')
                                    {
                                        echo "displaynone";
                                    }
                                    else
                                    {
                                        if($value['status'] == 'Cancelled' || $value['status'] == 'Unavailable'){ echo "unclickable";} 
                                        if($value['status'] == 'Completed') {echo "displaynone";}
                                    }
                                ?>
                                ">
                                    <a href="reservationupdate.php?id=<?php echo $value['id'];?>&category=<?php echo $value['category']?>"<?php if($value['status'] == 'Confirmed' || $value['status'] == 'Verifying Payment' || $value['status']=='Delivering'){ echo 'class="semi-unclick"';}?>><button>Update</button></a>
                                    <a href="reservationcancel.php?id=<?php echo $value['id'];?>&category=<?php echo $value['category']?>" <?php if($value['status']=='Delivering'){ echo 'class="semi-unclick"';}?>><button onclick="cancelconfirm()">Cancel</button></a>

                                    <?php
                                    if($value['status'] == 'Waiting For Payment')
                                    {
                                    ?>
                                        <a href="proceedtopay.php?id=<?php echo $value['id'];?>&category=<?php echo $value['category']?>" ><button>Proceed To Pay</button></a>
                                    <?php
                                    }
                                    ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        <?php
                }
            }
            else{
                echo "<center>You haven't reserved any vehicles yet</center>";
                $nopage = 1;
            }

        ?>
        
        </section>
        <div class="pagenavigation">
            <?php
            if(!isset($nopage))
            {
                $sql = "SELECT * FROM tbl_reserve WHERE customersid = ".$_SESSION['id'];
                $count = mysqli_query($conn,$sql);
                $total_num_pages = ceil(mysqli_num_rows($count)/$contents_per_page);
            ?>
            <ul>
                <li>
                    <a href="<?php
                        if($page<=1){
                            echo '#';
                        }
                        else{
                            $p = $page-1;
                            // echo "products.php?page=".$p;
                            echo "reservations.php?page=".$p;
                        }
                    ?>">&lt</a>
                </li>
                <?php
                    for($pagec=1;$pagec<=$total_num_pages;$pagec++)
                    {
                ?>
                <li <?php if($page==$pagec){ echo 'class="active"';}?>>
                    <a href="reservations.php?page=<?php echo $pagec;?>">
                        <?php echo $pagec;?>
                    </a>
                </li>
                <?php
                    }
                ?>
                <li>
                    <a href="<?php
                        if($page>=$total_num_pages){
                            echo '#';
                        }
                        else{
                            $p=$page+1;
                            echo "reservations.php?page=".$p;
                        }
                    ?>">&gt</a>
                </li>
            </ul>
            <?php
            }
            ?>
		</div>
        
    </div>
    <div class="footer">
        <?php
            include 'includes/footer.php';
        ?>
    </div>
    <script>
        function cancelconfirm()
        {
            var confirmValue = confirm("Do you want to cancel your reservation?");
            if(!confirmValue)
            {
                event.preventDefault();
            }
        }
    </script>
</body>
</html>