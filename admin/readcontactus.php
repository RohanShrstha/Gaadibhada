<?php
include 'includes/conn.php';
if(isset($_GET['id']))
{
    $stmt = "UPDATE tbl_suggestion SET status = 'Read' WHERE customer_id = ".$_GET['id'];
    if(mysqli_query($conn,$stmt))
    {
        header('location:managecontactusquery.php');
    }
    else
    {
        echo"
            <script>
                alert('Error in performing the action')
            </script>
        ";
    }
}
else
{
    header('location:managecontactusquery.php');
}