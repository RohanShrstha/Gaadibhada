<?php
include 'includes/conn.php';
if(isset($_GET['id']))
{
    
    $id = $_GET['id'];
    $stmt = "UPDATE tbl_vehicles SET status = 'Pending' WHERE id = '$id'";
    if(mysqli_query($conn,$stmt))
    {
        echo "
        <script>
            alert('Post unverified');
            window.location = 'managevehicles.php';
        </script>";
    }
    else
    {
        echo "
        <script>
            alert('Error in performing operation');
            window.location = managevehicles.php';
        </script>";
    }
}
else
{
    header('location:managevehicles.php');
}