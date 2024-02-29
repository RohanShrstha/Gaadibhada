<?php
    include 'includes/conn.php';
    session_start();
    if(!isset($_SESSION['log_status']))
    {
        header('location:login.php');
    }
    $nopage = 1;
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>My Posts</title>
	<link rel="stylesheet" href="css/myposts.css">
    <link href="images/pictures/logo.png" rel="icon">
    <style>
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
		<div class="container-content">
			<div class="caption"><h1>Your Posts</h1></div>
			<div class="item-container">
                <?php
                    if(isset($_GET['page'])){
                        $page = $_GET['page'];
                    }
                    else{
                        $page = 1;
                    }
                    $contents_per_page = 6;
                    $offset = ($page-1)*$contents_per_page;
                    
                    $sql = "SELECT * FROM tbl_vehicles WHERE supplierid =".$_SESSION['id']." AND status != 'Deleted' AND status != 'Delete Read' ORDER BY id DESC limit $offset,$contents_per_page";
                    $result = mysqli_query($conn,$sql);
                    if(mysqli_num_rows($result)>0)
                    {
                        while($value=mysqli_fetch_assoc($result))
                        {
                            $id = $value['id'];
                ?>
                <div class="item">
					<div class="item-card">
						<div class="image">
                            <?php
                                if($value['img1'] != '')
                                {
                                    echo '<img src="upload/images/vehicleImage/'.$value['img1'].'">';
                                }
                            ?>
						</div>
                        <hr>
						<div class="description">
							<div class="title"><?php echo $value['title'];?></div>
							<div class="info">
								<div class="brand">Brand: <?php echo $value['brand'];?></div>
								<div class="price">Price: Rs. <?php echo $value['price'];?>/day</div>
							</div>
                            <div class="button">
                                <a href="mypostview.php?id=<?php echo $id;?>&category=<?php echo $value['category'];?>"><button>View Details</button></a>
                            </div>

						</div>
					</div>
				</div>
                 <?php
                        }
                    }
                    else {
                        echo "<center style='margin: auto; padding-top: 50px;'>You haven't post any vehicles yet</center>";
                    }
                
                ?>
			</div>
		</div>
        <div class="pagenavigation">
            <?php
            
                $sql = "SELECT * FROM tbl_vehicles WHERE supplierid =".$_SESSION['id']." AND status != 'Deleted' AND status != 'Delete Read'";
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
                            echo "myposts.php?page=".$p;
                        }
                    ?>">&lt</a>
                </li>
                <?php
                    for($pagec=1;$pagec<=$total_num_pages;$pagec++)
                    {
                ?>
                <li <?php if($page==$pagec){ echo 'class="active"';}?>>
                    <a href="myposts.php?page=<?php echo $pagec;?>">
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
                            echo "myposts.php?page=".$p;
                        }
                    ?>">&gt</a>
                </li>
            </ul>
            
		</div>
	</div>
	<div class="footer">
        <?php
            include 'includes/footer.php';
        ?>
    </div>
</body>
</html>