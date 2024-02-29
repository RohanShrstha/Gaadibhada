<?php
	$serverName = 'localhost';
	$dbname = 'gaadibhada';
	$dbuser = 'root';
	$dbpass = '';
	$conn = mysqli_connect($serverName,$dbuser,$dbpass,$dbname);

	if(!($conn)){
		echo "error occured in db connection".mysqli_connect_error();
	}

?>