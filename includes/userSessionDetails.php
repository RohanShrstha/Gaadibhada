<?php
if(isset($_SESSION['log_status']))
{
    include 'conn.php';
    $uemail = $_SESSION['uemail'];
    $sql = "SELECT * FROM tbl_customer WHERE customer_uemail = '$uemail'";
    $result = mysqli_query($conn,$sql);
    $Values = mysqli_fetch_assoc($result);


    $_SESSION['id'] = $Values['customer_id'];
    $_SESSION['username'] = $Values['customer_uname'];
    $_SESSION['type'] = $Values['type'];

    if($Values['customer_gender'] == '' || $Values['customer_phone'] == '' || $Values['customer_dob'] == '' || $Values['customer_country'] == '' || $Values['customer_city'] == '' || $Values['customer_address'] == '')
        $_SESSION['profilecomplete'] = 0;
    else
        $_SESSION['profilecomplete'] = 1;
        
    if($Values['status'] == 0 || $Values['status'] == 2)
    {
        $_SESSION['customer_status'] = 0;
    }
    else
    {
        $_SESSION['customer_status'] = 1; 
    }
    
    //license status
    if($Values['customer_licensep']=='default.png')
    {
        $_SESSION['license_status'] = 0;
    }
    else
    {
        $_SESSION['license_status'] = 1;
    }

}