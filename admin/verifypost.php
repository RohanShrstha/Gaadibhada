<?php
include 'includes/conn.php';
if(isset($_GET['id']) && isset($_GET['category']))
{
    
    $id = $_GET['id'];
    $category = $_GET['category'];

    $stmt = "UPDATE tbl_vehicles SET status = 'Verified' WHERE id = '$id' AND category='$category'";

    if(mysqli_query($conn,$stmt))
    {
        echo "
        <script>
            alert('Post Verified');
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