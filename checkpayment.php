<?php
include 'includes/conn.php';
$stmt3 = "SELECT * FROM tbl_payment WHERE id = 6";
$rs3 = mysqli_query($conn,$stmt3);

$row3 = mysqli_fetch_assoc($rs3);
print_r($row3);

?>