<?php
    include 'includes/conn.php';
    session_start();
    if(!isset($_SESSION['alogin']))
	{	
	    header('location:index.php');
	}
?>

<!DOCTYPE html>

<head>
    <link rel="stylesheet" href="css/table.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <title>Monitor Bookings</title>
    <link href="img/logo.png" rel="icon">
    <style>
		.pagenavigation{
            margin-top: 10px;
            width: 100%;
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
		}
        .pagenavigation ul li a{
            color: black;
            text-decoration: none;
        }
        ul .active{
            background-color: blueviolet;
        }
        .tablebody{
            min-height: 68vh;
        }
	</style>
</head>

<body>
    <?php
    include 'includes/header.php';
    ?>
    <div class="container">
        <div class="title">Monitor Bookings</div><br>
        <hr><br>
        <div class="tablebody">
            <table width="98%">
                <tr>
                    <th style="width: 50px;">Order ID</th>
                    <th>Consumer Name</th>
                    <th>Supplier Name</th>
                    <th style="width: 100px;">Vehicle Title</th>
                    <th style="width: 100px;">Trip Start Date</th>
                    <th style="width: 100px;">Trip End Date</th>
                    <th>Location</th>
                    <th>Drive Option</th>
                    <th>Message</th>
                    <th>Totalcost</th>
                    <th>Status</th>
                </tr>

                <?php
                            
                if(isset($_GET['page']))
                {
                    $page = $_GET['page'];
                }
                else{
                    $page = 1;
                }
                $contents_per_page = 10;
                $offset = ($page-1)*$contents_per_page;

                $sql = "SELECT * FROM tbl_reserve ORDER BY id DESC limit $offset,$contents_per_page";
                $result = mysqli_query($conn, $sql);

                if (mysqli_num_rows($result) > 0)
                {
                    while ($value = mysqli_fetch_assoc($result)) 
                    {
                        $stmt1 = "SELECT * FROM tbl_customer WHERE customer_id = ".$value['customersid'];
                        $stmt2 = "SELECT * FROM tbl_customer WHERE customer_id = ".$value['suppliersid'];

                        
                        $stmt3 = "SELECT * FROM tbl_vehicles WHERE id = ".$value['vehicleid'];
                       

                        $rs1 = $conn->query($stmt1);
                        $rs2 = $conn->query($stmt2);
                        $rs3 = $conn->query($stmt3);

                        $row1 = $rs1->fetch_assoc();
                        $row2 = $rs2->fetch_assoc();
                        $row3 = $rs3->fetch_assoc();
                ?>

                <tr>
                    <td>
                        <?php echo $value['id']; ?>
                    </td>
                    <td>
                        <a href="viewuser.php?id=<?php echo $value['customersid'];?>"><?php echo $row1['customer_uname']; ?></a>
                    </td>
                    <td>
                        <a href="viewuser.php?id=<?php echo $value['suppliersid'];?>"><?php echo $row2['customer_uname']; ?></a>
                    </td>
                    <td>
                        <a href="viewpost.php?id=<?php echo $value['vehicleid'];?>&category=<?php echo $value['category'];?>"><?php echo $row3['title']; ?></a>
                    </td>
                    <td>
                        <?php echo $value['sdate']."<br>".$value['stime']; ?>
                    </td>
                    <td>
                        <?php echo $value['edate']."<br>".$value['etime']; ?>
                    </td>
                    <td>
                        <?php echo $value['location']; ?>
                    </td>
                    <td>
                        <?php 
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
                        ?>
                    </td>
                    <td><?php echo $value['message']; ?></td>
                    <td>
                        <?php echo $value['totalcost']; ?>
                    </td>
                    <td>
                        <?php echo $value['status']; ?>
                    </td>
                    <?php
                    }
                }
                else
                {
                    $nopage = 1;
                    echo '<tr><td colspan="11"> No Bookings made yet</td></tr>';
                }
                ?>
                </tr>
            </table>
        </div>
        <div class="pagenavigation">
            <?php
            if(!isset($nopage))
            {
                $sql = "SELECT * FROM tbl_reserve";
                
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
                            echo "monitorbookings.php?page=".$p;
                        }
                    ?>">&lt</a>
                </li>
                <?php
                    for($pagec=1;$pagec<=$total_num_pages;$pagec++)
                    {
                ?>
                <li <?php if($page==$pagec){ echo 'class="active"';}?>>
                    <a href="monitorbookings.php?page=<?php echo $pagec;?>">
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
                            echo "monitorbookings.php?page=".$p;
                        }
                    ?>">&gt</a>
                </li>
            </ul>
            <?php
            }
            ?>
		</div>
    </div>
</body>

</html>

