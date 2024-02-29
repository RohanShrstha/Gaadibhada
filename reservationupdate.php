<?php
    include 'includes/conn.php';
    include 'includes/userSessionDetails.php';
    session_start();
    $id = $_GET['id'];
    $category = $_GET['category'];


    $stmt = "SELECT * FROM tbl_reserve where id = '$id' AND category = '$category'";
    $result = mysqli_query($conn,$stmt);
    if(mysqli_num_rows($result)==1)
    {
        $value = mysqli_fetch_assoc($result);
    }
    else
    {
        header('location:reservations.php');
    }
    $vid = $value['vehicleid'];
    if($category == 'fourwheelers')
    {
        $sql = "SELECT * FROM tbl_vehicles WHERE id = '$vid'";
    }
    if($category == 'twowheelers')
    {
        $sql = "SELECT * FROM tbl_vehicles WHERE id = '$vid'";
    }
    $res = mysqli_query($conn,$sql);
    $v = mysqli_fetch_assoc($res); 
    
    // $vehicleid = $v['id'];
    if(isset($v['selfdrive']))
        $selfdrive = $v['selfdrive'];
    $price = intval($v['price']);

    if(isset($_POST['reserve']))
    {

        include 'includes/getDay.php';

        if(empty($_POST['sdate']))
        {
            $sdate = $value['sdate'];
        }
        else{
            $sdate = $_POST['sdate'];
            $tsdate = strtotime($sdate);
        }
        if(empty($_POST['stime']))
        {
            $stime = $value['stime'];
        }
        else{
            $stime = $_POST['stime'];
        }
        if(empty($_POST['edate']))
        {
            $edate = $value['edate'];
            $tedate = strtotime($edate);
        }
        else{
            $edate = $_POST['edate'];
        }
        if(empty($_POST['etime']))
        {
            $etime = $value['etime'];
        }
        else{
            $etime = $_POST['etime'];
        }
        if(empty($_POST['location']))
        {
            $location = $value['location'];
        }
        else{
            $location = $_POST['location'];
        }
        
        if(empty($_POST['driveoption']))
        {
            $driveoption = $value['driveoption'];
        }
        else{
            $driveoption = $_POST['driveoption'];
        }
        
        if(isset($_POST['message']))
        {
            $message = $_POST['message'];
        }
        else{
            $message = $value['message'];
        }

        $priceperday = $price;
        $day = getDay($sdate,$edate);
        $totalcost = $priceperday * $day;

       
        
        $rs = $conn->query("SELECT * FROM tbl_reserve WHERE vehicleid = '$vid' AND category = '$category' AND status = 'Confirmed'");
        if($rs->num_rows>0)
        {
            
            while($row = $rs->fetch_assoc())
            {
                $dsdate = strtotime($row['sdate']);
                $dedate = strtotime($row['edate']);
                if(isset($tsdate))
                {
                    if($tsdate>=$dsdate && $tsdate <= $dedate)
                    {
                        $serror = 'error';
                    }
                }
                if(isset($tedate))
                {
                    if($tedate>=$dsdate && $tedate <= $dedate)
                    {
                        $eerror = 'error';
                    }
                }
            }
        }

        if($category == 'fourwheelers')
        {
            $sql = "UPDATE tbl_reserve SET sdate = '$sdate', stime = '$stime', edate = '$edate', etime = '$etime', location = '$location', driveoption = '$driveoption', message = '$message', priceperday = '$priceperday', totalcost = '$totalcost', status = 'Pending' WHERE id='$id' AND category ='$category'";
        }
        else{
            $sql = "UPDATE tbl_reserve SET sdate = '$sdate', stime = '$stime', edate = '$edate', etime = '$etime', location = '$location', message = '$message', priceperday = '$priceperday', totalcost = '$totalcost', status = 'Pending' WHERE id='$id' AND category ='$category'";
        }
        
        // $sql = "INSERT INTO tbl_reserve(customersid,suppliersid,vehicleid,category,sdate,stime,edate,etime,location,driveoption,message,priceperday,totalcost) VALUES('$customerid','$supplierid','$vehicleid','$category','$sdate','$stime','$edate','$etime','$location','$driveoption','$message','$priceperday','$totalcost')";

        if(!isset($serror) && !isset($eerror))
        {
            if(mysqli_query($conn,$sql))
            {
                echo "<script>alert('Vehicle Reserve Request has been Updated');</script>";
                header('location:reservations.php?id='.$id.'&category='.$category);
            }
            else
            {
                echo "<script>alert('Error in Updating');</script>";
            }
        }
        else
        {
            echo"<script>window.location.href='#form'</script>";
        }
    }

?>

<html>
    <head>
    <link href="images/pictures/logo.png" rel="icon">
    <title>Reservation Update</title>
    <script src="js/reserveformupdate.js"></script>
        <style>
            .error{
            width: 100%;
            min-height: 2vh;
            padding: 5px 2px;
            font-size: 1.2rem;
            color: red;
            font-style: italic;
            }
            .header{
                width: 100%;
                height: 11vh;
                background-color: black;
            }
            .bookform{
                width: 100%;
                min-height: 80vh;
                margin-bottom: 10px;
                padding: 20px 0px;
            }
            .title{
                width: 100%;
                height: 6vh;
                font-size: 2em;
                text-align: center;
            }
            .formbody{
                width: 100%;
                height: auto;
                margin-top: 10px;
                display: flex;
                justify-content: center;
            }
            form{
                width: 31vw;
                border: 2px solid black;
                border-radius: 8px;
                padding: 5px;
            }
            .input-boxes{
                width: 100%;
                min-height: 12vh;
                padding: 5px;
                font-size: 1.2em;
                box-sizing: border-box;
                border-bottom: 2px solid black;
            }
            /* .info-display{
                width: 100%;
                height: auto;
                padding: 5px;
                font-size: 1.2em;
                box-sizing: border-box;
            } */
            .label{
                width: 100%;
                min-height: 4vh;
                height: auto;
                font-weight: bold;
            }
            .info .label{
                font-weight: lighter;
            }
            #sdate, #stime, #edate, #etime{
                width: 13.5vw;
                height: 4vh;
                padding: 2px;
                margin: 0px 5px;
                font-size: 16px;
            }
            textarea{
                width: 100%;
                height: 8vh;
                font-size: 1.2rem;
                padding: 5px;
            }
            #driveoption{
                width: 3vw;
            }
            span{
                font-size: 0.98rem;
            }
            #reserve{
                margin: 5px 0px;
                width: 5vw;
                height: 4vh;
                border-radius: 8px;
                font-size: 1rem;
                cursor: pointer;
                color:white;
                background-color: blueviolet;
            }
            #reserve:hover{
                transform: scale(1.1);
            }
            
            .info{
                width: inherit;
                height: inherit;
                display: flex;
                justify-content: center;
                padding: 5px;
            }
            .noborder{
                border: none;
            }
            .button{
                padding: 5px 0px 0px;
                display: flex;
                justify-content: space-evenly;
            }
            .bookinfo{
                background: beige;
                min-height: 100px;
                width: 300px;
                padding: 5px;
                border-radius: 8px;
                margin: 10px 0px;
                position: absolute;
                right: 12%;
            }
            .bookinfo .title{
                font-size: 18px;
                font-weight: 600;
                border-bottom: 1px solid black;
            }
            .bookinfo .info{
                padding: 2px 10px;
                line-height: 24px;
            }
            .msg{
                color: red;
                padding: 2px 5px;
            }
        </style>
    </head>
    <body>
        <div class="header">
            <?php
                include 'includes/heading.php';
            ?>
        </div>
        <div class="bookform">
            <div class="title">Update Reserve Form</div>
            <div class="formbody">
            <form action="#" id="form" method="post" onsubmit="return reserveValidate()">
                <div class="input-boxes">
                    <div class="label">Trip Start</div>
                    <input type="date" name="sdate" id="sdate" value="<?php if(isset($_POST['sdate'])){ echo $_POST['sdate'];} else{ echo $value['sdate'];}?>">
                    <input type="time" name="stime" id="stime" value="<?php if(isset($_POST['stime'])){ echo $_POST['stime'];} else{ echo $value['stime'];}?>">
                    <div class="msg"><?php if(isset($serror)){ echo "Selected Date Unavaliable";}?></div>
                </div>
                <div class="input-boxes">
                    <div class="label">Trip End</div>
                    <input type="date" name="edate" id="edate" value="<?php if(isset($_POST['edate'])){ echo $_POST['edate'];} else{ echo $value['edate'];}?>">
                    <input type="time" name="etime" id="etime" value="<?php if(isset($_POST['etime'])){ echo $_POST['etime'];} else{ echo $value['etime'];}?>">
                    <div class="msg"><?php if(isset($eerror)){ echo "Selected Date Unavaliable";}?></div>
                </div>
                <div class="input-boxes">
                    <div class="label">Pickup or Drop location</div>
                    <textarea name="location" id="location"><?php if(isset($_POST['location'])){ echo $_POST['location'];} else{ echo $value['location'];}?></textarea>
                    <div class="msg"></div>
                </div>
                 <?php
                    if($category == 'fourwheelers' && $selfdrive == '1')
                    {
                ?>
                <div class="input-boxes">
                    <div class="label">Driving Options</div>
                    <input type="radio" name="driveoption" id="driveoption" value = "1" <?php if(isset($_POST['driveoption'])){ if($_POST['driveoption'] == '1') echo"checked";} else{if($value['driveoption'] == '1'){echo 'checked';}}?>>Self Drive
                    <input type="radio" name="driveoption" id="driveoption" value = "2" <?php if(isset($_POST['driveoption'])){ if($_POST['driveoption'] == '2') echo"checked";} else{if($value['driveoption'] == '2'){echo 'checked';}}?>>Hire a driver
                    <div class="msg"></div>
                </div>
                <?php
                    }
                ?>
                <div class="input-boxes">
                    <div class="label">Message  <span>(if you want to leave any message)</span></div>
                    <textarea name="message" id="message"><?php if(isset($_POST['message'])){ echo $_POST['message'];} else{ echo $value['message'];}?></textarea>
                    <div class="msg"></div>
                </div>
                <div class="button">
                    
                        <input type="submit" name="reserve" id="reserve" onclick="updateconfirm()" value="Update">
                        <input type="button" id="reserve" value="Cancel" onclick="cancelconfirm()">
                </div>
            </form>
                <?php
                    if(isset($_SESSION['id']))
                    {
                    ?>
                    <div class="bookinfo">
                        <div class="title">Vehicle Unavaiable dates</div>
                        <div class="info">
                            <?php
                            $rs = $conn->query("SELECT * FROM tbl_reserve WHERE vehicleid = '$vid' AND category = '$category' AND status = 'Confirmed'");
                            if($rs->num_rows>0)
                            {
                                while($row = $rs->fetch_assoc())
                                    echo $row['sdate']." to ".$row['edate']."<br>";
                            }
                            else
                            {
                                echo "None";
                            }
                            ?>
                        </div>
                    </div>
                    <?php
                    }
                ?>
            </div>
        </div>
        
        <script>
            function updateconfirm()
            {
                let confirmValue = confirm('Do you want to Update?');
                if(!confirmValue)
                    event.preventDefault();
            }
            function cancelconfirm()
            {
                let confirmValue = confirm('Do you want to Cancel Update?');
                if(confirmValue)
                    window.location.href="reservations.php";
            }
        </script>
        <div class="footer">
            <?php
                include 'includes/footer.php';
            ?>
        </div>
    </body>
</html>