<?php
include 'includes/conn.php';
if(isset($_GET['id']))
{
    
    $id = $_GET['id'];
    $stmt = "UPDATE tbl_customer SET status = 1 WHERE customer_id = '$id'";
    if(mysqli_query($conn,$stmt))
    {
        echo "
        <script>
            alert('User Verified');
            window.location = 'manageusers.php';
        </script>";
    }
    else
    {
        echo "
        <script>
            alert('Error in performing operation');
            window.location = 'manageusers.php';
        </script>";
    }
}
else
{
    header('location:manageusers.php');
}