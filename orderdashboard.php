<?php
    include 'includes/conn_login_signup.php';
    session_start();
    if(!isset($_SESSION['log_status']))
    {
        header('location:login.php');
    }

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="images/pictures/logo.png" rel="icon">
    <title>Order Request Dashboard</title>
    <style>
        *{
            padding: 0;
            margin: 0;
            box-sizing: border-box;
        }
        .heading{
            height: 11vh;
        }
        .container {
            width: 1920px;
        }

        .container .sub-container{
            min-height: 78vh;
            padding: 2px;
        }

        .container .sub-container .title {
            font-size: 24px;
            padding: 10px;
            width: 1520px;
            height: 50px;
            position: sticky;
            left: 0px;
        }

        .container .sub-container table {
            table-layout: auto;
            border-collapse: collapse;
        }

        .container .sub-container table tr th {
            padding: 10px;
            font-size: 14px;
            background-color: blueviolet;
            border: 0.5px solid black;
            line-height: 24px;
            text-align: center;
        }

        .container .sub-container table tr td {
            padding: 5px;
            font-size: 14px;
            border: 0.5px solid black;
            min-width: 120px;
            max-width: 180px;
            word-wrap: break-word;
            line-height: 24px;
            text-align: center;
        }
        /* .container table tr td a{
            color: black;
        } */

        .container .sub-container table tr td button{
            width:100%;
            padding: 2px;
            margin: 2px;
            border-radius: 2px;
            background-color: rgba(137, 43, 226, 0.753);
            text-transform: uppercase;
            transition: all .3s;
            cursor: pointer;
        }

        .container .sub-container table tr td button:hover{
            background-color: rgba(130, 35, 220, 0.4)
        }
        .unclickable{
            opacity: 50%;
            pointer-events: none; 
        }
        .sticky{
            position: sticky;
            top: 82px;
            z-index: 1;
        }
        .sticky2{
            position: sticky;
            left: 0px;
            background-color: white;
            box-shadow: inset -0.3px 0px 0px black, inset 0.3px 0px 0px black;
        }
        .pagenavigation{
            margin-top: 10px;
            width: 1520px;
            height: 28px;
            display: flex;
            justify-content: center;
            position: sticky;
            left: 5px;
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
        .footer{
            width:1520px;
            height: auto;
            position: sticky;
            left: 0px
        }
    </style>
</head>
<body>
    <div class="heading">
        <?php
        include 'includes/heading.php';
        ?>
    </div>
    
    <div class="container">
        <div class="sub-container">
            <div class="title">Your Order Request</div>
            
            <table width="100%">
                <tr class="sticky">
                    <th class="sticky2">Order ID</th>
                    <th>Customer Name</th>
                    <th>Vehicle Title</th>
                    <th>Trip Start Date</th>
                    <th>Trip End Date</th>
                    <th>Location</th>
                    <th>Driving Option</th>
                    <th>Message</th>
                    <th>Total Cost</th>
                    <th>Payment Method</th>
                    <th>Payment Details</th>
                    <th>Payment Status</th>
                    <th>Payment Action</th>
                    <th>Status</th>
                    <th>Action</th>
                </tr>

                <?php
                if(isset($_GET['page'])){
                    $page = $_GET['page'];
                }
                else{
                    $page = 1;
                }
                $contents_per_page = 10;
                $offset = ($page-1)*$contents_per_page;

                $sql = "SELECT * FROM tbl_reserve WHERE suppliersid = ".$_SESSION['id']." ORDER BY id DESC limit $offset,$contents_per_page";
                $result = mysqli_query($conn, $sql);

                if (mysqli_num_rows($result) > 0) 
                {
                    while ($value = mysqli_fetch_assoc($result)) 
                    {
                        $stmt1 = "SELECT * FROM tbl_customer WHERE customer_id = ".$value['customersid'];
                        $rs1 = $conn->query($stmt1);
                        $row1 = $rs1->fetch_assoc();

                        if($value['category']=='fourwheelers')
                            $stmt2 = "SELECT * FROM tbl_vehicles  WHERE id = ".$value['vehicleid'];
                        else   
                            $stmt2 = "SELECT * FROM tbl_vehicles WHERE id  = ".$value['vehicleid'];
                        $rs2 = $conn->query($stmt2);
                        $row2 = $rs2->fetch_assoc();

                        $stmt3 = "SELECT * FROM tbl_payment WHERE reservationid = ".$value['id'];
                        $rs3 = mysqli_query($conn,$stmt3);
                        $row3 = mysqli_fetch_assoc($rs3);



                ?>

                <tr>
                    <td class="sticky2"><?php echo $value['id']; ?></td>
                    <td><a href="viewprofile.php?id=<?php echo $row1['customer_id'];?>"><?php echo $row1['customer_uname']; ?></a></td>
                    <td><a href="viewproduct.php?id=<?php echo $row2['id'];?>&category=<?php echo $row2['category'];?>"><?php echo $row2['title'] ?></a></td>
                    <td><?php echo $value['sdate']; echo "<br>"; echo $value['stime'];?></td>
                    <td><?php echo $value['edate']; echo "<br>"; echo $value['etime'];?></td>
                    <td><?php echo $value['location']; ?></td>
                    <td><?php 
                    if($value['driveoption'] == 0)
                    {
                        echo "Not Defined";
                    }
                    else if($value['driveoption'] == 1)
                    {
                        echo "Self Drive";
                    }
                    else
                    {
                        echo "Hire Driver";
                    }
                    ?></td>
                    <td><?php echo $value['message']; ?></td>
                    <td><?php echo $value['totalcost']; ?></td>
                    <td><?php if(empty($row3['ptype'])){ echo "Not Selected";} else if($row3['ptype']==1) {echo "Cash on Delivery";} else {echo "Online Payment";} ?></td>
                    <?php 
                    if(!empty($row3['payfile'])){ 
                    ?>
                    <td><a href="upload/files/paymentfiles/<?php echo $row3['payfile'];?>" target="_blank" rel="noopener noreferrer"><button>View</button></a></td>
                    <?php 
                        }
                    else{
                    ?>
                    <td>No files</td>
                    <?php
                    }
                    ?>
                    <td>
                        <?php 
                        if(!empty($row3['status']))
                        {
                            echo $row3['status'];
                        } 
                        else
                        { 
                            echo "NULL";
                        }
                        ?>
                    </td>
                    <td>
                        <a href="paymentreceive.php?id=<?php echo $value['id'];?>" <?php if(empty($row3['status']) || $value['status']=='Unavailable' || $value['status']=='Cancelled' || $value['status']=='Completed'){echo 'class = "unclickable"';} else{ if($row3['status'] == "Received"){ echo 'class="unclickable"';} }?>>
                            <button onclick="confirmReceived()">Received</button>
                        </a>
                        
                    </td>
                    <td><?php echo $value['status']; ?></td>
                    <td>
                        
                        <?php
                        if($value['status'] == "Pending" || $value['status'] == "Waiting For Payment" || $value['status'] == "Cancelled" || $value['status'] == "Unavailable")
                        {
                        ?>
                            <a href="orderavailable.php?id=<?php echo $value['id'];?>" <?php if($value['status']=="Cancelled" || $value['status'] == "Unavailable") echo 'class = "unclickable"';?>><button>Available</button></a>
                            <a href="ordercancel.php?id=<?php echo $value['id'];?>" <?php if($value['status']=="Cancelled" || $value['status'] == "Unavailable") echo 'class = "unclickable"';?>><button onclick="confirmCancel()">Cancel</button></a>
                        <?php
                        }
                        if($value['status'] == "Verifying Payment")
                        {
                        ?>
                            <a href="orderconfirm.php?id=<?php echo $value['id'];?>"><button>Confirm</button></a>
                            <a href="ordercancel.php?id=<?php echo $value['id'];?>"><button onclick="confirmCancel()">Cancel</button></a>
                        <?php
                        }
                        if($value['status']=='Confirmed')
                        {
                        ?>
                            <a href="orderdeliver.php?id=<?php echo $value['id'];?>"><button>Delivering</button></a>
                        <?php
                        }
                        if($value['status']=='Delivering')
                        {
                        ?>
                            <a href="ordercomplete.php?id=<?php echo $value['id'];?>"><button>Complete</button></a>
                        <?php
                        }
                        ?>

                    </td>
                    <?php
                    }
                }
                else
                {
                ?>
                <tr id="empty">
                    <td colspan="14">No requests yet</td>
                </tr>
                <?php
                }
                ?>
                
                </tr>
            </table>
        </div>
        <div class="pagenavigation">
            <?php
            if(!isset($nopage))
            {
                $sql = "SELECT * FROM tbl_reserve WHERE suppliersid = ".$_SESSION['id'];
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
                            echo "orderdashboard.php?page=".$p;
                        }
                    ?>">&lt</a>
                </li>
                <?php
                    for($pagec=1;$pagec<=$total_num_pages;$pagec++)
                    {
                ?>
                <li <?php if($page==$pagec){ echo 'class="active"';}?>>
                    <a href="orderdashboard.php?page=<?php echo $pagec;?>">
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
                            echo "orderdashboard.php?page=".$p;
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
        function confirmReceived()
        {
            let cv = confirm("Confirm Payment Received?");
            if(!cv)
            {
                event.preventDefault();
            }
        }
        function confirmCancel()
        {
            let cv = confirm("Confirm Cancel?");
            if(!cv)
            {
                event.preventDefault();
            }
        }
    </script>
    
</body>
</html>