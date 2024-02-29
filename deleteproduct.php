<?php

    include 'includes/conn.php';

    $id = $_GET['id'];

    session_start();
    $category = $_SESSION['category'];
    if($category == 'fourwheelers')
    {
        $sql = "UPDATE tbl_vehicles SET status = 'Deleted' WHERE id = '$id'";
    }
    else
    {
        $sql = "UPDATE tbl_vehicles SET status = 'Deleted' WHERE id = '$id'";
    }
    
    mysqli_query($conn,$sql);

    header('location:myposts.php');

?>