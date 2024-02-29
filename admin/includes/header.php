<?php
 include 'conn.php';
?>
<html>
	<head>
		<title>Rent Vehicle</title>
		<link href="../img/logo.png" rel="icon">
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
		<link rel="stylesheet" href="css/header.css">
	</head>
	<body>
	<nav>
        <div class="menu">
			<div class="logo">
				<a href="dashboard.php"><img src="img/logo1.png" width="330px" > </a>
			</div>

            <ul class="nav-links">
                <div class="dropdown">
                    <li><a href="" class="log"><i id="user" class="fas fa-user-cog"></i> Account</a></li>
                    <div class="dropdown-content">
                        <a href="change-password.php">Change Password</a>
                        <a href="logout.php">Log out</a>
                    </div>
                </div>
            </ul>

		</div>
	</nav>

	<div class="sidenav">
		<p class="main">Main</p>
		<a href="dashboard.php"><i class="fas fa-table"></i>Dashboard</a>
		<button class="dropdown-btn"><i class="far fa-clone"></i>Brands <i class="fa fa-caret-down"></i>
		</button>
		<div class="dropdown-container">
			<a href="createbrand.php">Create Brand</a>
			<a href="managebrand.php">Manage Brands</a>
		</div>
		<button class="dropdown-btn"><i class="far fa-clone"></i>Features <i class="fa fa-caret-down"></i>
		</button>
		<div class="dropdown-container">
			<a href="createfeature.php">Create Feature</a>
			<a href="managefeatures.php">Manage Feature</a>
		</div>
		<?php
			$sql1 = "SELECT * FROM tbl_vehicles WHERE status != 'Verified' AND status != 'Delete Read'";

			$rs1 = mysqli_query($conn,$sql1);

			$rowCount1 = mysqli_num_rows($rs1);
			$count = $rowCount1;

			
			$sql3 = "SELECT * FROM tbl_suggestion WHERE status ='Pending'";
			$rs3 = mysqli_query($conn,$sql3);
			$contactCount = mysqli_num_rows($rs3);
		
		?>
		<a href="managevehicles.php"><i class="fa fa-sitemap"></i> Manage Vehicles (<?php echo $count;?>) </a>
		<a href="monitorbookings.php"><i class="fa fa-book"></i> Monitor Booking</a>
		<a href="managecontactusquery.php"><i class="fa fa-desktop"></i>Manage Contact Us (<?php echo $contactCount;?>)</a>
		<?php
			$rs = mysqli_query($conn,"SELECT * FROM tbl_customer WHERE status = '0' OR status = '2'");
			$userCount = mysqli_num_rows($rs);
		?>
		<a href="manageusers.php"><i class="fa fa-users"></i> Manage Users (<?php echo $userCount;?>)</a></li>
		<a href="monitorpayment.php"><i class="fa fa-money"></i> Monitor Payment</a></li>
	</div>

	<script>
		var dropdown = document.getElementsByClassName("dropdown-btn");
		var i;

		for (i = 0; i < dropdown.length; i++) {
			dropdown[i].addEventListener("click", function() {
				this.classList.toggle("active");
				var dropdownContent = this.nextElementSibling;
				if (dropdownContent.style.display === "block") {
					dropdownContent.style.display = "none";
				} 
				else {
					dropdownContent.style.display = "block";
				}
			});
		}
	</script>

</body>
</html>
