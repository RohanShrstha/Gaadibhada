<?php
include 'includes/conn.php';
session_start();

if(isset($_GET['id']))
{
    $id = $_GET['id'];
    $stmt = "SELECT * FROM tbl_reserve WHERE id = '$id'";
    $rs = mysqli_query($conn,$stmt);
    $row = mysqli_fetch_assoc($rs);

    $tsdate = strtotime($row['sdate']);
    $tedate = strtotime($row['edate']);

    $error = 0;

    $stmt1 = "SELECT * FROM tbl_reserve WHERE vehicleid = ".$row['vehicleid']." AND status ='Confirmed'";
    $rs1 = mysqli_query($conn,$stmt1);
    if(mysqli_num_rows($rs1)>0)
    {
        while($row1 = mysqli_fetch_assoc($rs1))
        {
            $dsdate = strtotime($row1['sdate']);
            $dedate = strtotime($row1['edate']);

            if($tsdate>=$dsdate && $tsdate <= $dedate)
            {
                $error++;
            }
            if($tedate>=$dsdate && $tedate <= $dedate)
            {
                $error++;
            }
        }
    }
    if($error > 0)
    {
        $sql = "UPDATE tbl_reserve SET status = 'Unavailable' WHERE id = '$id'";
    }
    else
    {
        $sql = "UPDATE tbl_reserve SET status = 'Confirmed' WHERE id = '$id'";
    }

    if(mysqli_query($conn,$sql))
    {
        if($error > 0)
        {
            echo "<script>
            alert('Vehicle is already booked for the given date.');
            window.location = 'orderdashboard.php';
            </script>";
        }
        else
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