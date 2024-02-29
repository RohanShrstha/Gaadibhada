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
    <title>Manage Users</title>
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
	<div class="title">Registered Users</div><br><hr><br>
        <div class="tablebody">
            <table style="width: 98%;">
                <tr>
                    <th style="width: 4%;">Id</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Profile Complete</th>
                    <th>Driving License</th>
                    <th>Reg Date</th>
                    <th>Details</th>
                    <th>Type</th>
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
                $contents_per_page = 12;
                $offset = ($page-1)*$contents_per_page;

                $sql = "SELECT * FROM tbl_customer ORDER BY customer_id DESC limit $offset,$contents_per_page";
                $result = mysqli_query($conn, $sql);
                if (mysqli_num_rows($result) > 0) {
                    while ($value = mysqli_fetch_assoc($result)) {
                ?>

                <tr>
                    <td><?php echo $value['customer_id'] ?></td>
                    <td><?php echo $value['customer_uname']; ?></td>
                    <td><?php echo $value['customer_uemail']; ?></td>
                    <td>
                        <?php 
                        if($value['customer_phone'] == '' || $value['customer_dob'] == '' || $value['customer_country'] == '' || $value['customer_city'] == '' || $value['customer_address'] == '')
                        {
                            echo 'Incomplete <i class="fa fa-times" style="color : red;"></i>';
                        }
                        else
                        {
                            echo 'Complete <i class="fa fa-check" style="color: green;"></i>';
                        }
                        ?>
                    <td>
                    <?php 
                        if($value['customer_licensep'] == 'default.png')
                        {
                            echo 'No';
                        }
                        else
                        {
                            echo 'Yes';
                        }
                        ?>
                    </td>
                    <td><?php echo $value['joindate']; ?></td>
                    <td><a href="viewuser.php?id=<?php echo $value['customer_id'];?>">View</a></td>
                    <td><?php echo $value['type'];?></td>
                    <td>
                        <?php
                        if ($value['status'] == 0)
                            echo 'Unverified <i class="fa fa-times" style="color: red;"></i>';
                        else if($value['status'] == 2)
                            echo 'Updated <i class="fa fa-check" style="color: blue;"></i>';
                        else 
                            echo 'Verified <i class="fa fa-check" style="color: green;"></i>';
                        ?>
                    </td>
                    <td>
                        <a href="verifyuser.php?id=<?php echo $value['customer_id'];?>"><button>Verify</button></a>
                    </td>
                    <?php 
                        }
                    }
                    else
					{
						$nopage = 1;
						echo '<tr><td colspan="9"> No User registered yet</td></tr>';
					}
                    ?>
                </tr>
            </table>
        </div>
        <div class="pagenavigation">
            <?php
            if(!isset($nopage))
            {
                $sql = "SELECT * FROM tbl_customer";
                
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
                            echo "manageusers.php?page=".$p;
                        }
                    ?>">&lt</a>
                </li>
                <?php
                    for($pagec=1;$pagec<=$total_num_pages;$pagec++)
                    {
                ?>
                <li <?php if($page==$pagec){ echo 'class="active"';}?>>
                    <a href="manageusers.php?page=<?php echo $pagec;?>">
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
                            echo "manageusers.php?page=".$p;
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