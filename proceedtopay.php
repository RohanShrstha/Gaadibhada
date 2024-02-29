<?php
    session_start();
    if(!isset($_SESSION['log_status']))
    {
        header('location:login.php');
    }
    include 'includes/conn.php';
    $id = $_GET['id'];
    $category = $_GET['category'];

    $sql = "SELECT * FROM tbl_reserve WHERE id = '$id' AND category = '$category'";
    $rs = mysqli_query($conn,$sql);
    $val = mysqli_fetch_assoc($rs);

    $vid = $val['vehicleid'];
    if($category == 'fourwheelers')
        $stmt = "SELECT * FROM tbl_vehicles WHERE id = '$vid'";
    else
        $stmt = "SELECT * FROM tbl_vehicles WHERE id = '$vid'";
    $rsv = mysqli_query($conn,$stmt);
    $vVal = mysqli_fetch_assoc($rsv);

    if(isset($_POST['confirm']))
    {
        $cid = $val['customersid'];
        $sid = $val['suppliersid'];
        $vid = $val['vehicleid'];
        $vcategory = $val['category'];
        $reservationid = $id;
        $totalcost = $val['totalcost'];
        

        if(isset($_POST['pmethod']))
        {
            $ptype = $_POST['pmethod'];
            if($_FILES['paymentfile']['size']>0)
            {
                $fileName = $_FILES['paymentfile']['name'];
                $fileTmpName = $_FILES['paymentfile']['tmp_name'];

                $fileEx = pathinfo($fileName,PATHINFO_EXTENSION);
                $fileExlc = strtolower($fileEx);
                
                $newFileName = uniqid("FILE-",true).'.'.$fileExlc;
                $filePath = 'upload/files/paymentfiles/'.$newFileName;
                move_uploaded_file($fileTmpName,$filePath);
            }
            else
            {
                $newFileName = "";
            }
            
            $sql = "INSERT INTO tbl_payment (cid,sid,vid,vcategory,reservationid,totalcost,ptype,payfile) VALUES('$cid','$sid','$vid','$vcategory','$reservationid','$totalcost','$ptype','$newFileName')";
            if(mysqli_query($conn,$sql))
            {
                $conn->query("UPDATE tbl_reserve SET status = 'Verifying Payment' WHERE id = '$id'");
                echo "<script>
                window.location.href = 'reservations.php';
                </script>";
            }
        }
        
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css"> 
    <title>Select Payment Method</title>
    <style>
        *{
            margin: 0px;
            padding: 0;
            box-sizing: border-box;
        }
        .header{
            background-color: black;
            height: 11vh;
        }
        .container{
            width: 100%;
            display: flex;
            justify-content: center;
            height: 90vh;
            padding: 10px 0px;
        }
        .container .box{
            width: 80vw;
            margin-top: 50px;
        }
        .paymentdetail, .paymentinfo{
            width: 100%;
            min-height: 80px;
            background-color: bisque;
            padding: 0px 50px;
            border: 1px solid black;
            border-radius: 10px;
            padding: 5px 20px;
            margin: 10px 0px;
        }
        .paymentdetail ul, .paymentinfo ul{
            list-style-type: none;
            font-size: 18px;
            line-height: 28px;
        }
        .method-container{
            margin-top: 10px;
        }
        form .pbuttons, form .fileupload{
            height: 80px;
            border: 1px solid black;
            border-radius: 10px;
            padding: 10px 0px;
            margin: 10px 0px;
        }
        
        form .pbuttons{
            display: flex;
            justify-content: center;
        }
        form .pbuttons .method{
            width: 330px;
            height: 40px;
            border: 1px solid black;
            margin: 5px;
            padding: 8px;
            position: relative;
            border-radius: 10px;
            font-size: 18px;
        }
        form .pbuttons .method input{
            position: absolute;
            margin: 5px;
            left: 92%;
        }
        form .button{
            width: 100%;
            height: 48px;
            margin-top: 20px;
            display: flex;
            justify-content: center;
        }
        form .button input{
            width: 100px;
            border: 1px solid black;
            border-radius: 10px;
            cursor: pointer;
            margin: 5px;
            background-color: blueviolet;
            color: white;
            font-size: 18px;
        }
        form .button input:hover{
            transform: scale(1.01);
        }
        .error{
            color: red;
            padding: 5px 0px;
            text-align: center;
        }
        .paymentinfo, .fileupload{
            display: none;
            line-height: 28px;
        }
        span{
            font-style: italic;
            font-size: 16px;
        }
    </style>
</head>
<body>
    <div class="header">
        <?php
            include 'includes/heading.php';
        ?>
    </div>
    <div class="container">
        <div class="box">
            <div class="paymentdetail">
                <ul>
                    <li>
                        <b>Order Id:</b> <?php echo $val['id'];?>
                    </li>
                    <li>
                        <b>Title:</b> : <?php echo $vVal['title'];?>
                    </li>
                    <li>
                        <b>Total Price:</b> : Rs. <?php echo $val['totalcost']?>
                    </li>
                </ul>
            </div>
            <div id="pd" class="paymentinfo">
                <ul>
                    <li>
                        <b>E-sewa Id</b> : 9812345678
                    </li>
                    <li>
                        <b>Khalti Id</b> : 9812345678
                    </li>
                    <li>
                        <b>Global IME Bank A/C</b> : 0022557755AB
                    </li>
                    <span>After payment please submit the payment bill</span>
                </ul>
            </div>
            <div class="method-container">
                <div class="title">Select Payment Option</div>
                <form action="#" method="post" id='pform' enctype="multipart/form-data">
                    <div class="pbuttons">
                        <div class="method">
                            <i class="fa fa-money"></i> Cash on Delivery <input type="radio" value="1" name="pmethod" oninput="checkValidate()"> 
                        </div>
                        <div class="method">
                            <i class="fa fa-credit-card"></i> Online payment <input type="radio" value="2" name="pmethod" oninput="checkValidate()" onclick="displaybox()"> 
                        </div>
                    </div>
                    <div class="fileupload" id='fu'>
                        <center>
                        Upload file:<input type="file" name="paymentfile" id="fupload" oninput="fileValidate()">
                        <br>
                        <span>Note: Only .pdf, .jpg, .jpeg extension allowed. File size cannot be more than 2 MB.</span>
                        </center>
                    </div>
                    
                    <div class="error" id="error">
                        <?php if(isset($error)) echo $error;?>
                    </div>

                    <div class="button">
                        <input type="submit" name="confirm" value="Confirm" onclick="confirmation()">
                        <input type="button" name="cancel" value="Cancel" onclick="cancelation()">
                    </div>
                </form>
            </div>
        </div>


    </div>
    <div class="footer">
        <?php
            include 'includes/footer.php';
        ?>
    </div>
    <script>
        function confirmation()
        {
            
            if(checkValidate() && fileValidate())
            {
                var confirmValue = confirm('Confirm Payment?');
                if(!confirmValue)
                {
                    event.preventDefault();
                }
            }
            else
            {
                event.preventDefault();
            }
        }
        function cancelation()
        {
            var confirmValue = confirm('Are you sure you want to cancel?');
            if(confirmValue)
            {
                window.location.href="reservations.php";
            } 
        }
        function displaybox(){
            var box = document.getElementById('pd');
            var uploadbox = document.getElementById('fu');
            box.style.display = 'block';
            uploadbox.style.display = 'block';
        }
        function checkValidate(){
            const paymethod = document.getElementsByName('pmethod');
            if(!(paymethod[0].checked || paymethod[1].checked))
            {
                document.getElementById('error').innerHTML = "Select a payment method";
                return false;
            }
            else
            {
                document.getElementById('error').innerHTML = "";
                return true;
            }
        }
        function fileValidate()
        {
            var file = document.getElementById('fupload');
            var fileValue = file.value;
            if(fileValue.length > 0)
            {
                var fileSize = file.files[0].size / 1024 / 1024;
                var allowedExtensions = /(\.pdf|\.jpg|\.jpeg)$/;
                
                
                if(!allowedExtensions.exec(fileValue)){
                    document.getElementById('error').innerHTML = "Invalid file extension";
                    return false;
                }
                else if (fileSize > 2) {
                    document.getElementById('error').innerHTML = " File size exceeds size limit";
                    return false;
                }
                else
                {
                    document.getElementById('error').innerHTML = "";
                    return true;
                }
            }
            else
            {
                document.getElementById('error').innerHTML = " File cannot be empty";
                return false;
            }
            
        }
    </script>
</body>
</html>