<?php
    include 'includes/conn.php';
    include 'includes/userSessionDetails.php';

    session_start();
    if(!isset($_SESSION['log_status']))
    {
        header('location:login.php');
    }

    //reading previous data from database
    $stmt = "SELECT * FROM tbl_customer WHERE customer_id =".$_SESSION['id']."";
    $res = mysqli_query($conn,$stmt);
    $val = mysqli_fetch_assoc($res);

    if(isset($_POST['submit']))
    {
        if(isset($_POST['nuname']))
        {
            $nusername = $_POST['nuname'];
        }
        else
        {
            $nusername = $val['customer_uname'];
        }
        
        $phone = $_POST['nphone'];
        $dob = $_POST['dob'];
        $address = $_POST['naddress'];
        $country = $_POST['country'];
        $city = $_POST['city'];
        $license = $_POST['ql'];

        $profileimg = $_FILES['pimg'];
        

        $errorCount = 0;

        if($license == '1')
        {
            if(($_FILES['licenseimg']['size'])>0)
            {
                $licenseimg = $_FILES['licenseimg'];
                if($licenseimg['size'] > 3000000)
                {
                    $errorlicense = "License Image Size cannot be more than 3 MB";
                    $errorCount ++;
                }
                if($licenseimg['size'] > 0 && $licenseimg['size'] < 3000000)
                {
                    $imgEx = pathinfo($licenseimg['name'],PATHINFO_EXTENSION);
                    $imgExlc = strtolower($imgEx);
                    $allowedEx=array('jpg','jpeg','png');
                    
                    if(!(in_array($imgExlc,$allowedEx)))
                    {
                        $errorlicense = "Invalid extension";
                        $errorCount ++;
                    }
                }
            }
            else if(isset($val['customer_licensep']))
            {
                if($val['customer_licensep'] != 'default.png')
                {
                    $licenseimgName = $val['customer_licensep'];
                }
            }
            else
            {
                $errorlicense = "Please provide the License Photo";
                $errorCount ++;
            }
              
        }
        else
        {
            $licenseimgName = 'default.png';
        }

        if(!isset($_POST['ngender']))
        {
            $errorgender = "Select your gender";
            $errorCount ++;
        }
        else
        {
            $gender = $_POST['ngender'];
        }

        if(strlen($nusername) == 0)
        {
            $errorusername = "Username Cannot be empty";
            $errorCount++;
        }
        else if(strlen($nusername) < 5 || strlen($nusername)>20)
        {
            $errorusername = "Username must be between 5 and 20 characters";
            $errorCount++;
        }
        else if(!(preg_match('/^[a-zA-Z0-9\.\_]+$/',$nusername)))
        {
            $errorusername = "Only . and _ special characters are allowed";
            $errorCount++;
        }
        else{
            if($nusername != $val['customer_uname'])
            {
                $n = $nusername;
                $stmt = "SELECT * FROM tbl_customer WHERE customer_uname = '$n'";
                $rs = mysqli_query($conn,$stmt);
                if(mysqli_num_rows($rs) >0)
                {
                    $errorusername = "Username already exists";
                    $errorCount++;
                }
            }
        }


        if($val['type'] == 'Supplier')
        {
            if(isset($_POST['bname']))
            {
                $businessname = $_POST['bname'];
            }
            else
            {
                $businessname = $val['businessname'];
            }
            if(strlen($businessname) == 0)
            {
                $errorbname = "Business name Cannot be empty";
                $errorCount++;
            }
            else if(!(preg_match('/^[a-zA-Z\s]+$/',$businessname)))
            {
                $errorbname = "Only alphabets are allowed";
                $errorCount++;
            }
            else if(strlen($businessname)<8 || strlen($businessname)>100)
            {
                $errorbname = "Business name must be between 8 to 100 characters";
                $errorCount++;
            }
        }

        if(empty($phone))
        {
            $errorphone = "Phone Number Cannot be empty";
            $errorCount ++;
        }
        else if(!preg_match("/^[0-9]{10}$/",$phone))
        {
            $errorphone = "Please enter valid Phone Number";
            $errorCount ++;
        }

        if(empty($dob))
        {
            $errordob = "Date of Birth Cannot be empty";
            $errorCount ++;
        }
        if(empty($country))
        {
            $errorcountry = "Country Cannot be empty";
            $errorCount ++;
        }
        if(empty($city))
        {
            $errorcity = "City Cannot be empty";
            $errorCount ++;
        }
        if(empty($address))
        {
            $erroraddress = "Address Cannot be empty";
            $errorCount ++;
        }

        if($profileimg['size'] > 3000000)
        {
            $errorprofile = "Profile Image Size cannot be more than 3 MB";
            $errorCount ++;
        }
        if($profileimg['size'] > 0 && $profileimg['size'] < 3000000)
        {
            $imgEx = pathinfo($profileimg['name'],PATHINFO_EXTENSION);
            $imgExlc = strtolower($imgEx);
            $allowedEx = array('jpg','jpeg','png');
            
            if(!(in_array($imgExlc,$allowedEx)))
            {
                $errorprofile = "Invalid extension";
                $errorCount ++;
            }
        }

        

        if($errorCount == 0)
        {
            if($profileimg['size']>0)
            {
                $profileimgName = uniqid("IMg-",true).'.'.$imgExlc;
                $profileimgPath = 'upload/images/profileImage/'.$profileimgName;
                move_uploaded_file($profileimg['tmp_name'],$profileimgPath);
            }
            else
            {
                $profileimgName = $val['customer_pimage'];
            }
            if($_FILES['licenseimg']['size']>0)
            {
                $licenseimgName = uniqid("IMg-",true).'.'.$imgExlc;
                $licenseimgPath = 'upload/images/licenseImage/'.$licenseimgName;
                move_uploaded_file($licenseimg['tmp_name'],$licenseimgPath);
                echo $licenseimgName;
            }
            else if($licenseimgName == 'default.png')
            {
                $licenseimgName = 'default.png';
            }
            else
            {
                $licenseimgName = $val['customer_licensep'];
            }

            if($val['type'] == 'Supplier')
                $sql = "UPDATE tbl_customer SET customer_uname = '$nusername', customer_phone = '$phone', customer_gender = '$gender', customer_dob = '$dob', customer_country = '$country', customer_city = '$city', customer_address = '$address', customer_pimage = '$profileimgName' , customer_licensep = '$licenseimgName', businessname = '$businessname', status = 2 WHERE customer_id = ".$_SESSION['id']."";
            else
                $sql = "UPDATE tbl_customer SET customer_uname = '$nusername', customer_phone = '$phone', customer_gender = '$gender', customer_dob = '$dob', customer_country = '$country', customer_city = '$city', customer_address = '$address', customer_pimage = '$profileimgName' , customer_licensep = '$licenseimgName', status = 2 WHERE customer_id = ".$_SESSION['id']."";

            if(mysqli_query($conn,$sql))
            {
                echo "<script> alert('Profile Update Successfully')</script>";
                header('location:profile.php');
            }
            else
                echo "<script> alert('Error in Updating Profile')</script>";
        }
        
        
    }
    if(isset($_SESSION['incompleteprofile']))
    {
        echo "<script>alert('Complete Profile to continue Reservation')</script>";
        unset($_SESSION['incompleteprofile']);
    }


?>
<!DOCTYPE html>
<html>

<head>
    <link rel="stylesheet" href="css/editprofile.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

    <title>Profile Edit</title>
    <link href="images/pictures/logo.png" rel="icon">
    <style>
        .header{
            height: 11vh;
        }
        label{
            display: block;
        }
        .error
        {
            color: red;
            /* height: 30px; */
        }
    </style>

</head>

<body>
    <div class="header">
        <?php
        include 'includes/heading.php';
        ?>
    </div>
    <div class="cover">
        <img src="images/pictures/profilepic.jpg" width="100%">
    </div>

    <div class="setting">
        <h2>General Setting</h2>
        <form method="post" action="#" enctype="multipart/form-data" id="mainform">
            <!-- Profile Picture -->
            <label for="img1">Profile Picture (<i>.jpg, .jpeg, .png</i>)</label>
            <input type="file" name="pimg" id="pimg" class="field">
            <?php
                if(isset($errorprofile))
                {
            ?>
            <div class="error">
                <?php echo $errorprofile; ?>
            </div>
            <?php
                }
            ?>
            <img id="preview-pimg" width="60%">

            <!-- Username -->
            <label for="uname">Username</label>
            <input type="text" id="nuname" class="field" name="nuname" value="<?php if(isset($_POST['nuname'])){ echo $_POST['nuname'];}else{ echo $val['customer_uname'];}?>">
            <?php
                if(isset($errorusername))
                {
            ?>
            <div class="error">
                <?php echo $errorusername; ?>
            </div>
            <?php
                }
            ?>

            <!-- E-MAIL -->
            <label for="email">E-mail</label>
            <input type="text" id="email" name="nemail" class="field" placeholder="<?php echo $val['customer_uemail'];?>" disabled>

            <!-- Businessname -->
            <?php
            if($val['type']=="Supplier")
            {
            ?>
                <label for="uname">Business Name</label>
                <input type="text" id="bname" class="field" name="bname" value="<?php if(isset($_POST['bname'])){ echo $_POST['bname'];}else{ echo $val['businessname'];}?>">
                <?php
                    if(isset($errorbname))
                    {
                ?>
                <div class="error">
                    <?php echo $errorbname; ?>
                </div>
                <?php
                    }
                ?>
            <?php
            }
            ?>

            <!-- Phone Number -->
            <label for="phone">Phone Number</label>
            <input type="number" id="phone" name="nphone" class="field" value = "<?php if(isset($_POST['nphone'])){ echo $_POST['nphone'];}else{ echo $val['customer_phone'];}?>">
            <?php
                if(isset($errorphone))
                {
            ?>
            <div class="error">
                <?php echo $errorphone; ?>
            </div>
            <?php
                }
            ?>

            <!-- Gender -->
            <label for="gender">Gender</label>
            <input type="radio" name="ngender" value="M" <?php 
            if(isset($_POST['ngender']))
            { 
                if($_POST['ngender']=='M')
                { echo "checked";}
            }
            else
            {
                if($val['customer_gender'] == 'M')
                {
                    echo "checked";
                }
            }
            ?>> Male &nbsp;
            <input type="radio" name="ngender" value="F" style="margin-bottom: 20px;" <?php 
            if(isset($_POST['ngender']))
            { 
                if($_POST['ngender']=='F')
                { echo "checked";}
            }
            else
            {
                if($val['customer_gender'] == 'F')
                {
                    echo "checked";
                }
            }
            ?>> Female
            <?php
                if(isset($errorgender))
                {
            ?>
            <div class="error">
                <?php echo $errorgender; ?>
            </div>
            <?php
                }
            ?>

            <!-- Date of Birth -->
            <label for="date">Date of birth</label>
            <input type="text" id="date" name="dob" placeholder="YYYY-MM-DD" value = "<?php if(isset($_POST['dob'])){ echo $_POST['dob'];}else{ echo $val['customer_dob'];}?>" class="field">
            <?php
                if(isset($errordob))
                {
            ?>
            <div class="error">
                <?php echo $errordob; ?>
            </div>
            <?php
                }
            ?>

            <!-- Country -->
            <label for="country">Country</label>
            <input type="text" id="country" class="field" name="country" value="<?php if(isset($_POST['country'])){ echo $_POST['country'];}else{ echo $val['customer_country'];}?>">
            <?php
                if(isset($errorcountry))
                {
            ?>
            <div class="error">
                <?php echo $errorcountry; ?>
            </div>
            <?php
                }
            ?>

            <!-- City -->
            <label for="city">City</label>
            <input type="text" id="city" class="field" name="city" value="<?php if(isset($_POST['city'])){ echo $_POST['city'];}else{ echo $val['customer_city'];}?>">
            <?php
                if(isset($errorcity))
                {
            ?>
            <div class="error">
                <?php echo $errorcity; ?>
            </div>
            <?php
                }
            ?>

            <!-- Address -->
            <label for="address">Address</label>
            <textarea id="message" class="field" name="naddress"><?php if(isset($_POST['naddress'])){ echo $_POST['naddress'];}else{ echo $val['customer_address'];}?></textarea>
            <?php
                if(isset($erroraddress))
                {
            ?>
            <div class="error">
                <?php echo $erroraddress; ?>
            </div>
            <?php
                }
            ?>

            <!-- License query -->
            <label for="qlicense">Do you have driving license?</label>
            <input type="radio" id="ql" name="ql" value="1" <?php if(isset($_POST['ql'])){ if($_POST['ql']==1){echo "checked";}}else{ if($val['customer_licensep'] !="default.png") echo 'Checked';}?>>Yes &nbsp;
            <input type="radio" id="ql1" name="ql" value="0" style="margin-bottom: 20px;" <?php if(isset($_POST['ql'])){ if($_POST['ql']==0){echo "checked";}}else{ if($val['customer_licensep'] =="default.png") echo 'Checked';}?>>No

            <div class="license" id="license">

                <!-- License -->
                <label for="img2">Upload License <Picture></Picture> (<i>.jpg, .jpeg, .png</i>)</label>
                <input type="file" name="licenseimg" id="licenseimg" class="field">
                <?php
                    if(isset($errorlicense))
                    {
                ?>
                <div class="error">
                    <?php echo $errorlicense; ?>
                </div>
                <?php
                    }
                ?>
                <img id="preview-licenseimg" width="60%";>
            </div>

            <!-- Submit -->
            <div class="button">
                <input type="submit" value="Submit Changes" name="submit">
            </div>
        </form>
    </div>

    <script>
        function readURL(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();
                reader.onload = function(e) {
                    imgId = '#preview-' + $(input).attr('id');
                    $(imgId).attr('src', e.target.result);
                }
                reader.readAsDataURL(input.files[0]);
            }
        }
        $("form#mainform input[type='file']").change(function() {
            readURL(this);
        });

        $(document).ready(function(){
            <?php
                if(isset($_POST['ql']))
                {
                    if($_POST['ql'] != '0')
                    {
                        echo "$('#license').show();";
                    }
                    else{
                        echo "$('#license').hide();";
                    }
                }
                else if($val['customer_licensep'] != 'default.png')
                {
                    echo "$('#license').show();";
                }
                else
                {
                    echo "$('#license').hide();";
                }
            ?>
            $('#ql').click(function(){
                $('#license').show();
            })
            $('#ql1').click(function(){
                $('#license').hide();
            })
        })
    </script>

    <?php
    include 'includes/footer.php';
    ?>
</body>

</html>