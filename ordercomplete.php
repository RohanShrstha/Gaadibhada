<?php
include 'includes/conn.php';
session_start();

if(isset($_GET['id']))
{
    $id = $_GET['id'];
    $stmt = "SELECT * FROM tbl_payment WHERE reservationid =".$id;
    $rs = mysqli_query($conn,$stmt);
    $row = mysqli_fetch_assoc($rs);
    if($row['status'] == 'Received')
    {
        $sql = "UPDATE tbl_reserve SET status = 'Completed' WHERE id = '$id'";
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
        echo"<script>
            alert('Payment not confirmed yet');
            window.location.href='orderdashboard.php';
        </script>";
    }
    
}
else
{
    header('location:orderdashboard.php');
}