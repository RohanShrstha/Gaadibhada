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
    <title>Monitor Payment</title>
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
	    <div class="title">Monitor Payment</div><br><hr><br>
        <div class="tablebody">
            <table style="width: 98%;">
                <tr>
                    <th style="width: 4%;">Id</th>
                    <th>Order ID</th>
                    <th>Customer</th>
                    <th>Supplier</th>
                    <th>Vehicle Title</th>
                    <th>Price</th>
                    <th>Payment method</th>
                    <th>Payment Description</th>
                    <th>Status</th>
                </tr>

                <?php

                if(isset($_GET['page'])){
                    $page = $_GET['page'];
                }
                else{
                    $page = 1;
                }
                $contents_per_page = 12;
                $offset = ($page-1)*$contents_per_page;

                $sql = "SELECT * FROM tbl_payment ORDER BY id DESC limit $offset,$contents_per_page";
                $result = mysqli_query($conn, $sql);
                if (mysqli_num_rows($result) > 0) {
                    while ($value = mysqli_fetch_assoc($result)) {

                        $stmt1 = "SELECT * FROM tbl_customer WHERE customer_id = ".$value['cid'];
                        $rs1 = $conn->query($stmt1);
                        $row1 = $rs1->fetch_assoc();


                        
                        $stmt2 = "SELECT * FROM tbl_vehicles  WHERE id = ".$value['vid'];
                        
                        $rs2 = $conn->query($stmt2);
                        $row2 = $rs2->fetch_assoc();

                        $stmt3 = "SELECT * FROM tbl_customer WHERE customer_id = ".$value['sid'];
                        $rs3 = $conn->query($stmt3);
                        $row3 = $rs3->fetch_assoc();

                ?>

                <tr>
                    <td><?php echo $value['id']; ?></td>
                    <td><?php echo $value['reservationid']; ?></td>
                    <td><a href="viewuser.php?id=<?php echo $row1['customer_id'];?>"><?php echo $row1['customer_uname']; ?></a></td>
                    <td><a href="viewuser.php?id=<?php echo $row3['customer_id'];?>"><?php echo $row3['customer_uname']; ?></a></td>
                    <td><a href="viewpost.php?id=<?php echo $row2['id'];?>&category=<?php echo $row2['category'];?>"><?php echo $row2['title']; ?></a></td>
                    <td><?php echo $value['totalcost']; ?></td>
                    <td>
                        <?php 
                            if($value['ptype'] == '1')
                            { 
                                echo "Cash On Delivery";
                            } 
                            else if($value['ptype'] == '2')
                            { 
                                echo "Online Payment";
                            }
                            else
                            { 
                                echo "No selected";
                            }
                        ?>
                    </td>
                    <td>
                        <?php 
                            if(!empty($value['payfile'])){ 
                        ?>
                        <a href="../upload/files/paymentfiles/<?php echo $value['payfile'];?>" target="_blank" rel="noopener noreferrer"><button>View</button></a>
                        <?php
                        } 
                        else{ 
                            echo "No files";
                            }
                        ?> 
                    </td>
                    <td>
                        <?php 
                            if($value['status'] == "Pending")
                            {
                                echo $value['status'].'<i class="fa fa-check" style="color : orange;"></i>';
                            }
                            else
                            {
                                echo $value['status'].'<i class="fa fa-check" style="color : green;"></i>';
                            }

                        ?>
                    </td>
                    <?php
                        }
                    }
                    else
                    {
                        $nopage = 1;
                        echo '<tr><td colspan="8"> No Payments made yet</td></tr>';
                    }
                    ?>
                </tr>
            </table>
        </div>
        <div class="pagenavigation">
            <?php
            if(!isset($nopage))
            {
                $sql = "SELECT * FROM tbl_payment";
                
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
                            echo "payment.php?page=".$p;
                        }
                    ?>">&lt</a>
                </li>
                <?php
                    for($pagec=1;$pagec<=$total_num_pages;$pagec++)
                    {
                ?>
                <li <?php if($page==$pagec){ echo 'class="active"';}?>>
                    <a href="payment.php?page=<?php echo $pagec;?>">
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
                            echo "payment.php?page=".$p;
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