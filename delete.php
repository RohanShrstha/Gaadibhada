<?php
$id = $_GET['id'];
$file = $_GET['file'];
$filename = $_GET['filename'];
include 'includes/conn.php';

$stmt = "SELECT * FROM tbl_vehicles WHERE id = '$id'";
$rs = mysqli_query($conn,$stmt);
$result = mysqli_fetch_assoc($rs);

if($result['category'] =='twowheelers')
    header('location:updatetwowheelers.php?id='.$id);
else
    header('location:updatefourwheelers.php?id='.$id);

// $pathOfFile = $_SERVER['DOCUMENT_ROOT']."/cproject/gaadibhada/upload/images/vehicleImage/".$img;

//unlink("upload/images/vehicleImage/".$img);

if(unlink("upload/images/vehicleImage/".$file))
{
    $sql = "UPDATE tbl_vehicles SET ".$filename." = NULL WHERE id='$id'";
    if(mysqli_query($conn,$sql))
    {
        if($result['category'] =='twowheelers')
            header('location:updatetwowheelers.php?id='.$id);
        else
            header('location:updatefourwheelers.php?id='.$id);
    }
}
else
{
    if($result['category'] =='twowheelers')
        header('location:updatetwowheelers.php?id='.$id.'&error=true');
    else
        header('location:updatefourwheelers.php?id='.$id.'&error=true');
}


?>
