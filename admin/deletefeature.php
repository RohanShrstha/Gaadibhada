<?php
include "includes/conn.php";

if(isset($_GET['id']) && isset($_GET['category']))
{
    $id = $_GET['id'];
    $category = $_GET['category'];

    
    $sql = "DELETE FROM tbl_features WHERE id = '$id'";

    if(mysqli_query($conn,$sql))
    {
        echo "<script>
                alert('Deleted Successfully');
                window.location='managefeatures.php';
            </script>";
    }
    else
    {
        echo "<script>
                alert('Error in performing opertaion');
                window.location='managefeatures.php';
            </script>";
    }
}
else
{
    header('location:managefeatures.php');
}