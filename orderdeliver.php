<?php
include 'includes/conn.php';
session_start();

if(isset($_GET['id']))
{
    $id = $_GET['id'];
    $sql = "UPDATE tbl_reserve SET status = 'Delivering' WHERE id = '$id'";
    if(mysqli_query($conn,$sql))
    {
        header('location:orderdashboard.php');
    }
    else
    {
        echo"<script>
            alert('Unable to perform action');
            window.location.href='orderdashboard.php';
        </script>";
    }
}
else
{
    header('location:orderdashboard.php');
}