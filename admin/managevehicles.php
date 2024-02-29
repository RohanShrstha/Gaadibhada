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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <title>Manage Vehicles</title>
    <link href="img/logo.png" rel="icon">
</head>

<body>
    <?php
    include 'includes/header.php';
    ?>
    <div class="container">
        <div class="title">Manage Vehicles</div><br>
        <hr><br>
        <!-- Four Wheelers -->
        <div class="category">Four Wheelers</div>
        <table width="98%">
            <tr>
                <th style="width: 50px;">Vehicle Id</th>
                <th>Title</th>
                <th>Brand</th>
                <th>Type</th>
                <th>Price per day</th>
                <th>Supplier id</th>
                <th>Details</th>
                <th>Status</th>
                <th>Action</th>
            </tr>

            <?php
            $sql = "SELECT * FROM tbl_vehicles WHERE category = 'fourwheelers' ORDER BY id DESC";
            $result = mysqli_query($conn, $sql);
            if (mysqli_num_rows($result) > 0) {
                while ($value = mysqli_fetch_assoc($result)) {
                    $rs1 = mysqli_fetch_assoc(mysqli_query($conn,"SELECT * FROM tbl_customer WHERE customer_id = ".$value['supplierid']));
            ?>
            <tr>
                <td><?php echo $value['id']; ?></td>
                <td id="fixwidth"><?php echo $value['title']; ?></td>
                <td><?php echo $value['brand']; ?></td>
                <td><?php echo $value['type']; ?></td>
                <td><?php echo $value['price']; ?></td>
                <td><a href="viewuser.php?id=<?php echo $value['supplierid'];?>"><?php echo $rs1['customer_uname']; ?></a></td>
                <td><a href="viewpost.php?id=<?php echo $value['id'];?>&category=<?php echo $value['category'];?>">View</a></td>
                <td>
                    <?php 
                    echo $value['status'];
                        if($value['status']=="Verified")
                        { 
                            echo ' <i class="fa fa-check" style="color: green;"></i>';
                        }
                        else if($value['status']=="Updating")
                        {
                            echo '<i class="fa fa-check" style="color: blue;"></i>';
                        }
                        else if($value['status']=="Deleted")
                        {
                            echo '<i class="fa fa-times" style="color: red;"></i>';
                        }
                        else
                        {
                            echo '<i class="fa fa-check" style="color: orange;"></i>';
                        }
                    ?>
                </td>
                <td>
                    <?php
                        if($value['status']=="Verified")
                        { 
                        ?>
                            <a href="unverifypost.php?id=<?php echo $value['id'];?>&category=<?php echo $value['category'];?>"><button>Unverify</button></a>
                        <?php
                        }
                        if($value['status']=="Updating" || $value['status']=="Pending")
                        {
                        ?>
                            <a href="verifypost.php?id=<?php echo $value['id'];?>&category=<?php echo $value['category'];?>"><button>Verify</button></a>
                        <?php
                        }
                        if($value['status']=="Deleted")
                        {
                        ?>
                            <a href="verifyreaddelete.php?id=<?php echo $value['id'];?>"><button>Read</button></a>
                        <?php
                        }
                    
                    ?>
                </td>
                <?php
                 }
            }
            else
            {
                echo '<tr><td colspan="9"> No Vehicles posted yet</td></tr>';
            }
            ?>
            </tr>
        </table><br><br>

        <!-- Two Wheelers -->
        <div class="category">Two Wheelers</div>
        <table width="98%">
            <tr>
                <th style="width: 50px;">Vehicle Id</th>
                <th>Title</th>
                <th>Brand</th>
                <th>Type</th>
                <th>Price per day</th>
                <th>Supplier id</th>
                <th>Details</th>
                <th>Status</th>
                <th>Action</th>
            </tr>

            <?php
            $sql = "SELECT * FROM tbl_vehicles WHERE category = 'twowheelers' ORDER BY id DESC";
            $result = mysqli_query($conn, $sql);
            if (mysqli_num_rows($result) > 0) {
                while ($value = mysqli_fetch_assoc($result)) {
                    $rs2 = mysqli_fetch_assoc(mysqli_query($conn,"SELECT * FROM tbl_customer WHERE customer_id = ".$value['supplierid']));
            ?>
            <tr>
                <td><?php echo $value['id']; ?></td>
                <td id="fixwidth"><?php echo $value['title']; ?></td>
                <td><?php echo $value['brand']; ?></td>
                <td><?php echo $value['type']; ?></td>
                <td><?php echo $value['price']; ?></td>
                <td><a href="viewuser.php?id=<?php echo $value['supplierid'];?>"><?php echo $rs2['customer_uname']; ?></a></td>
                <td><a href="viewpost.php?id=<?php echo $value['id'];?>&category=<?php echo $value['category'];?>">View</a></td>
                <td>
                    <?php 
                    echo $value['status'];
                        if($value['status']=="Verified")
                        { 
                            echo ' <i class="fa fa-check" style="color: green;"></i>';
                        }
                        else if($value['status']=="Updating")
                        {
                            echo '<i class="fa fa-check" style="color: blue;"></i>';
                        }
                        else if($value['status']=="Deleted")
                        {
                            echo '<i class="fa fa-times" style="color: red;"></i>';
                        }
                        else
                        {
                            echo '<i class="fa fa-check" style="color: orange;"></i>';
                        }
                    ?>
                </td>
                <td>
                    <?php
                        if($value['status']=="Verified")
                        { 
                        ?>
                            <a href="unverifypost.php?id=<?php echo $value['id'];?>&category=<?php echo $value['category'];?>"><button>Unverify</button></a>
                        <?php
                        }
                        if($value['status']=="Updating" || $value['status']=="Pending")
                        {
                        ?>
                            <a href="verifypost.php?id=<?php echo $value['id'];?>&category=<?php echo $value['category'];?>"><button>Verify</button></a>
                        <?php
                        }
                    
                    ?>
                </td>
                <?php
                 }
            }
            else
            {
                echo '<tr><td colspan="9"> No Vehicles posted yet</td></tr>';
            }
            ?>
            </tr>
        </table>
    </div>
</body>

</html>