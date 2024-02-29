<?php

include 'includes/conn.php';

$id = $_GET['id'];
$category = $_GET['category'];

$sql = "UPDATE tbl_reserve SET status = 'Cancelled' WHERE id = '$id'";

if(mysqli_query($conn,$sql))
{
    header('location:reservations.php');
}
else{
    echo "<script>alert('Error in Cancelling');</script>";
}

?>