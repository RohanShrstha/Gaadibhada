<?php
	session_start();
	include 'includes/conn.php';
	if(!isset($_SESSION['alogin']))
	{
		header('location:index.php');
	}
	$rs = mysqli_query($conn,"SELECT * FROM tbl_customer");
	$numUsers = mysqli_num_rows($rs);

	$sql1 = "SELECT * FROM tbl_vehicles";
	$rs1 = mysqli_query($conn,$sql1);
	$vehicelCount = mysqli_num_rows($rs1);

	$sql2 = "SELECT * FROM tbl_features";
	$rs2 = mysqli_query($conn,$sql2);
	$featureCount = mysqli_num_rows($rs2);

	$sql3 = "SELECT * FROM tbl_brand";
	$rs3 = mysqli_query($conn,$sql3);
	$brandCount = mysqli_num_rows($rs3);

	$sql4 = "SELECT * FROM tbl_payment";
	$rs4 = mysqli_query($conn,$sql4);
	$payCount = mysqli_num_rows($rs4);
	
	$sql5 = "SELECT * FROM tbl_reserve";
	$rs5 = mysqli_query($conn,$sql5);
	$bookingCount = mysqli_num_rows($rs5);

	$sql6 = "SELECT * FROM tbl_suggestion";
	$rs6 = mysqli_query($conn,$sql6);
	$suggestionCount = mysqli_num_rows($rs6);


?>
<!doctype html>

<head>
	<link rel="stylesheet" href="css/dashboard.css">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
	<title>Dashboard</title>
	<link href="img/logo.png" rel="icon">
</head>

<body>
	<?php
	include 'includes/header.php';
	?>
	<div class="container">
		<div class="title">Dashboard</div><br>
		<hr>
		<div class="big-diagram">
			<div class="small-diagram" style="background-color:rgb(255, 254, 77);">
				<h2><?php echo $numUsers;?></h2>
				<p>Registered Users</p>
				<a href="manageusers.php">Full Details<i class="fa fa-arrow-right"></i></a>
			</div>
					
			<div class="small-diagram" style="background-color:rgb(138, 135, 220);">
				<h2><?php echo $vehicelCount;?></h2>
				<p>Listed Vehicles</p>
				<a href="managevehicles.php">Full Details<i class="fa fa-arrow-right"></i></a>
			</div>

			<div class="small-diagram" style="background-color:rgb(83, 246, 75);">
				<h2><?php echo $bookingCount;?></h2>
				<p>Total Bookings</p>
				<a href="monitorbookings.php">Full Details<i class="fa fa-arrow-right"></i></a>
			</div>

			<div class="small-diagram" style="background-color:rgb(255, 215, 0);">
				<h2><?php echo $payCount;?></h2>
				<p>Total Payments</p>
				<a href="managecontactusquery.php">Full Details<i class="fa fa-arrow-right"></i></a>
			</div>

			<div class="small-diagram" style="background-color:rgb(253, 34, 180);">
				<h2><?php echo $brandCount;?></h2>
				<p>Listed Brands</p>
				<a href="managebrand.php">Full Details<i class="fa fa-arrow-right"></i></a>
			</div>

			<div class="small-diagram" style="background-color:rgb(135, 206, 235);">
				<h2><?php echo $featureCount;?></h2>
				<p>Listed Features</p>
				<a href="managebrand.php">Full Details<i class="fa fa-arrow-right"></i></a>
			</div>

			<div class="small-diagram" style="background-color:rgb(255, 38, 0);">
				<h2><?php echo $suggestionCount;?></h2>
				<p>Contact Us Queries</p>
				<a href="managecontactusquery.php">Full Details<i class="fa fa-arrow-right"></i></a>
			</div>	
		</div>
	</div>
</body>

</html>