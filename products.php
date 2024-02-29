<?php
    include 'includes/conn.php';
	session_start();
	if(empty($_GET['category'])||empty($_GET['type']))
	{
		header('location:services.php');
	}
	
	$category = $_GET['category'];
	$type = $_GET['type'];
	
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Products</title>
	<link rel="stylesheet" href="css/product.css">
	<link href="images/pictures/logo.png" rel="icon">
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
        .active{
            background-color: blueviolet;
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
			<div class="caption"><h1><?php echo $type; ?></h1></div>
			<div class="item-container">
                <?php
					if(isset($_GET['page'])){
						$page = $_GET['page'];
					}
					else{
						$page = 1;
					}
					$contents_per_page = 9;
					$offset = ($page-1)*$contents_per_page;

					
					$sql = "SELECT * FROM tbl_vehicles WHERE type = '$type' AND category = '$category' AND status = 'Verified' limit $offset,$contents_per_page";
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
                                <a href="productview.php?id=<?php echo $id;?>&category=<?php echo $category; ?>"><button>View Details</button></a>
                            </div>

						</div>
					</div>
				</div>
                 <?php
                        }
                    }
					else
					{
						$nopage = 1;
						echo '<div class="nopost" style="margin: auto;">No Posts Found</div>';
					}
                
                ?>
			</div>
			<div class="pagenavigation">
			
				<?php
				if(!isset($nopage))
				{
					
					$sql = "SELECT * FROM tbl_vehicles WHERE type = '$type' AND category ='$category'";
					
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
								echo "products.php?category=".$category."&type=".$type."&page=".$p;
							}
						?>">&lt</a>
					</li>
					<?php
						for($pagec=1;$pagec<=$total_num_pages;$pagec++)
						{
					?>
					<li <?php if($page==$pagec){ echo 'class="active"';}?>>
						<a href="products.php?category=<?php echo $category;?>&type=<?php echo $type;?>&page=<?php echo $pagec;?>">
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
								echo "products.php?category=".$category."&type=".$type."&page=".$p;
							}
						?>">&gt</a>
					</li>
            	</ul>
				<?php
				}
				?>
			</div>
		</div>
	</div>
	<div class="footer">
		<?php
			include 'includes/footer.php';
		?>
	</div>
</body>
</html>