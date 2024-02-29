<?php
 include 'includes/conn.php';
 session_start();
 if(!isset($_SESSION['log_status']))
    {
        header('location:login.php');
    }
 $id = $_GET['id'];

 if($_SERVER['REQUEST_METHOD']=="POST")
 {
     if(isset($_POST['post']))
     {
        if(isset($delete))
        {
            if($delete)
            {
                echo 'ok';
            }
            else{
                echo 'not ok';
            }
        }
        
         $title = $_POST['title'];
         $brand = $_POST['brand'];
         $type = $_POST['type'];
         $description = $_POST['description'];
         $makeyear = $_POST['makeyear'];
         $engine = $_POST['engine'];
         $transmission = $_POST['transmission'];
         $fuel = $_POST['fuel'];
         $mileage = $_POST['mileage'];
         $doors = $_POST['doors'];
         $seats = $_POST['seats'];
         $price = $_POST['price'];
         $selfdrive = $_POST['self-drive'];
         if(isset($_POST['chk'])){
             $features = implode(',',$_POST['chk']);
         }
         else{
             $features = NULL;
         }
         
         function imageUpload($image)
         {
            
             $imgName = $image['name'];
             $imgSize = $image['size'];
             $imgError = $image['error'];
             $imgTmpName = $image['tmp_name'];
 
             if($imgError == 0)
             {
                $imgEx = pathinfo($imgName,PATHINFO_EXTENSION);
                $imgExlc = strtolower($imgEx);
                
                $newImgName = uniqid("IMG-",true).'.'.$imgExlc;
                $imgPath = 'upload/images/vehicleImage/'.$newImgName;
                move_uploaded_file($imgTmpName,$imgPath);
                return $newImgName;

             }
             else
             {
                return "Error";
             }
         }
 
         function fileUpload($file)
         {
             $fileName = $file['name'];
             $fileSize = $file['size'];
             $fileError = $file['error'];
             $fileTmpName = $file['tmp_name'];
 
             if($fileError === 0)
             { 
                $fileEx = pathinfo($fileName,PATHINFO_EXTENSION);
                $fileExlc = strtolower($fileEx);
                
                $newFileName = uniqid("FILE-",true).'.'.$fileExlc;
                $filePath = 'upload/files/legaldocuments/'.$newFileName;
                move_uploaded_file($fileTmpName,$filePath);
                return $newFileName;
            }
            else
            {
                return "Error";
            }
        }
        $sql = "SELECT * FROM tbl_vehicles WHERE id='$id'";
        $result0 = mysqli_query($conn,$sql);
        if(mysqli_num_rows($result0)>0)
        {
            $prevalue = mysqli_fetch_assoc($result0);
        }
        $img1 = $prevalue['img1'];
        $img2 = $prevalue['img2'];
        $img3 = $prevalue['img3'];
        $img4 = $prevalue['img4'];
        $billbookd = $prevalue['billbookd'];
        $insuranced = $prevalue['insuranced'];

         if($_FILES['img1']['size']>0){
             $img1 = imageUpload($_FILES['img1']);
         }
         if($_FILES['img2']['size']>0){
             $img2 = imageUpload($_FILES['img2']);
         }
         if($_FILES['img3']['size']>0){
             $img3 = imageUpload($_FILES['img3']);
         }
         if($_FILES['img4']['size']>0){
             $img4 = imageUpload($_FILES['img4']);
         }
 
         if($_FILES['billbookd']['size']>0){
             $billbookd = fileUpload($_FILES['billbookd']);
         }
         if($_FILES['insuranced']['size']>0){
             $insuranced = fileUpload($_FILES['insuranced']);
         }
         $sql = "UPDATE tbl_vehicles SET title = '$title', brand = '$brand', type = '$type', description = '$description', makeyear = '$makeyear', engine = '$engine', transmission = '$transmission', fuel = '$fuel', mileage = '$mileage', doors = '$doors', seats = '$seats', features = '$features', price = '$price', img1 = '$img1', img2 = '$img2', img3 = '$img3', img4 = '$img4', billbookd = '$billbookd', insuranced = '$insuranced', selfdrive = '$selfdrive', status = 'Updating' WHERE id = '$id'";

        if(mysqli_query($conn,$sql)){
            header('location:mypostview.php?id='.$id.'&category=fourwheelers');
        }
        else{
            echo "Failed";
        }
     }     
 }
?>
<html>
    <head>
        <link rel="stylesheet" href="css/productaddform.css">
        <link href="images/pictures/logo.png" rel="icon">
        <title>Update Product</title>
        <style>
            .preview{
                width: 80%; 
                height: 15vh;
            }
            .previewf{
                width: 100%;
                height: 10vh;
                font-size: 0.9em;
                padding: 5px;
                box-sizing: border-box;
            }
            .preview img, .previewf embed{
                width: 100%;
                height: 100%;
            }
        </style>
        <script src="js/validateUpdate0.js"></script>
    </head>
    <body>
        <div class="header">
            <?php
                include 'includes/heading.php';
            ?>
        </div>
        <div class="container">
            <div class="form-body">
                <div class="title">
                    Update a post
                </div>
                <div class="form">
                    <?php
                        $sql = "SELECT * FROM tbl_vehicles WHERE id='$id'";
                        $result0 = mysqli_query($conn,$sql);
                        if(mysqli_num_rows($result0)>0)
                        {
                            $prevalue=mysqli_fetch_assoc($result0);

                    ?>
                    <form action="#" method="post" id="form" enctype="multipart/form-data">
                        <div class="lable">Enter the title *</div>
                        <div class="input-box">
                            <input type="text" name="title"  id="title" value="<?php echo $prevalue['title'];?>">
                            <div class="msg"></div>
                        </div>
                        <div class="category">
                            <div class="content-box">
                                <div class="lable">Select Brand</div>
                                <div class="input-box">
                                    <select name="brand" id="brand">
                                        <option value="0">Brand *</option>
                                        <?php
                                        $sql = "SELECT * FROM tbl_brand WHERE category='fourwheelers' ORDER BY name";
                                        $result = mysqli_query($conn,$sql);
                                        if(mysqli_num_rows($result)>0)
                                        {
                                            while($value = mysqli_fetch_assoc($result))
                                            {
                                        ?>
                                        <option value="<?php echo $value['name'];?>" <?php if($prevalue['brand'] == $value['name']){echo "selected";}?>><?php echo $value['name'];?></option>
                                        <?php
                                            }
                                        }
                                        ?>

                                    </select>
                                    <div class="msg"></div>
                                </div>
                            </div>
                            <div class="content-box">
                                <div class="lable">Select Type</div>
                                <div class="input-box">
                                    <select name="type" id="type">
                                        <option value="0">Type *</option>
                                        <?php
                                        $sql = "SELECT * FROM tbl_type0 ORDER BY name";
                                        $result = mysqli_query($conn,$sql);
                                        if(mysqli_num_rows($result)>0)
                                        {
                                            while($value = mysqli_fetch_assoc($result))
                                            {
                                        ?>
                                        <option value="<?php echo $value['name'];?>" <?php if($prevalue['type'] == $value['name']){echo "selected";}?>><?php echo $value['name'];?></option>
                                        <?php
                                            }
                                        }
                                        ?>
                                    </select>
                                    <div class="msg"></div>
                                </div>
                            </div>
                        </div>
                        <div class="lable">Description *</div>
                        <div class="input-box1">
                            <textarea name="description" id="description"><?php  
                                    if($prevalue['description']!= "")
                                    {
                                        $v = chop($prevalue['description']);
                                        echo $v;
                                    }
                                ?></textarea>
                            <div class="msg"></div>
                        </div>
                        <div class="lable" id="break"><b>Specifications *</b></div>
                        <div class="specification">
                            
                            <div class="content-box">
                                <div class="lable">Make Year *</div>
                                <div class="input-box">
                                    <input type="text" id="makeyear" name="makeyear" value="<?php echo $prevalue['makeyear'];?>">
                                    <div class="msg"></div>
                                </div>
                            </div>
                            <div class="content-box">
                                <div class="lable">Engine*</div>
                                <div class="input-box">
                                    <input type="text" id="engine" name="engine" placeholder="CC" value="<?php echo $prevalue['engine'];?>">
                                    <div class="msg"></div>
                                </div>
                            </div>
                            <div class="content-box">
                                <div class="lable">Transmission*</div>
                                <div class="input-box">
                                    <select name="transmission" id="transmission">
                                        <option value="0">Select</option>
                                        <option value="Automatic" <?php if($prevalue['transmission'] == 'Automatic'){echo "selected";}?>>Automatic</option>
                                        <option value="Manual" <?php if($prevalue['transmission'] == 'Manual'){echo "selected";}?>>Manual</option>
                                    </select>
                                    <div class="msg"></div>
                                </div>
                            </div>
                            <div class="content-box">
                                <div class="lable">Fuel *</div>
                                <div class="input-box">
                                    <select name="fuel" id="fuel">
                                        <option value="0">Select</option>
                                        <option value="Petrol" <?php if($prevalue['fuel'] == 'Petrol'){echo "selected";}?>>Petrol</option>
                                        <option value="Diesel" <?php if($prevalue['fuel'] == 'Diesel'){echo "selected";}?>>Diesel</option>
                                        <option value="Electric" <?php if($prevalue['fuel'] == 'Electric'){echo "selected";}?>>Electric</option>
                                    </select>
                                    <div class="msg"></div>
                                </div>
                            </div>
                            <div class="content-box">
                                <div class="lable">Mileage *</div>
                                <div class="input-box">
                                    <input type="text" id="mileage" name="mileage" placeholder="KM" value="<?php echo $prevalue['mileage'];?>">
                                    <div class="msg"></div>
                                </div>
                            </div>
                            <div class="content-box">
                                <div class="lable">Doors *</div>
                                <div class="input-box">
                                    <input type="text" id="doors" name="doors" value="<?php echo $prevalue['doors'];?>">
                                    <div class="msg"></div>
                                </div>
                            </div>
                            <div class="content-box">
                                <div class="lable">Seats *</div>
                                <div class="input-box">
                                    <input type="text" id="seats" name="seats" value="<?php echo $prevalue['seats'];?>">
                                    <div class="msg"></div>
                                </div>
                            </div>
                        </div>
                        <div class="lable" id="break"><b>Features</b></div>
                        <div class="features">
                            <?php
                            $sql = "SELECT * FROM tbl_features WHERE category = 'fourwheelers' ORDER BY name";
                            $result = mysqli_query($conn,$sql);
                            if(mysqli_num_rows($result)>0)
                            {
                                while($value = mysqli_fetch_assoc($result))
                                {
                            ?>
                            <div class="feature">
                                <input type="checkbox" name="chk[]" value="<?php echo $value['name'];?>" <?php if(strstr($prevalue['features'],$value['name'])){ echo "checked";}?> > <?php echo $value['name'];?>
                            </div>
                            <?php
                                }
                            }
                            ?>
                        </div>
                        <div class="lable" id="break"><b>Price Per Day *</b></div>
                        <div class="content-box">
                            <div class="input-box">
                                <input type="text" id="price" name="price" placeholder="IN NPR" value="<?php echo $prevalue['price'];?>">
                                <div class="msg"></div>
                            </div>
                        </div>
                        <div class="lable" id="break"><b>Allow customer to self drive? *</b></div>
                        <div class="content-box">
                            <div class="radiobox">
                                <input type="radio" id="selfdrive" name="self-drive" value="1" <?php if($prevalue['selfdrive'] == '1'){echo "checked";}?>>Yes
                                <input type="radio" id="selfdrive" name="self-drive" value="0" <?php if($prevalue['selfdrive'] == '0'){echo "checked";}?>>No
                                <div class="msg"></div>
                            </div>
                        </div>
                        <div class="lable" id="break"><b>Upload Images * </b><span>(in jpg format)</span></div>
                        <div class="image-select">
                            
                            <div class="select">
                                <div class="text">image 1</div>
                                <?php
                                if($prevalue['img1'] != "")
                                {
                                    echo '<div class="preview">
                                    <img src="upload/images/vehicleImage/'.$prevalue['img1'].'">
                                    </div>';
                                }
                                ?>
                                <input type="file" id="img1" name="img1">
                               
                            </div>
                            <div class="select">
                                <div class="text">image 2</div>
                                <?php
                                if($prevalue['img2'] != "")
                                {
                                    echo '<div class="preview">
                                    <img src="upload/images/vehicleImage/'.$prevalue['img2'].'">
                                    </div>';
                                }
                                ?>
                                <input type="file" id="img2" name="img2">
                                <?php
                                if(!empty($prevalue['img2']))
                                {
                                ?>
                                <a href="delete.php?id=<?php echo $prevalue['id']; ?>&file=<?php echo $prevalue['img2'];?>&filename=img2"><input type="button" value="delete"></a>
                                <?php
                                }
                                ?>
                            </div>
                            <div class="select">
                                <div class="text">image 3</div>
                                <?php
                                if($prevalue['img3'] != "")
                                {
                                    echo '<div class="preview">
                                    <img src="upload/images/vehicleImage/'.$prevalue['img3'].'">
                                    </div>';
                                }
                                ?>
                                <input type="file" id="img3" name="img3">
                                <?php
                                if(!empty($prevalue['img3']))
                                {
                                ?>
                                <a href="delete.php?id=<?php echo $prevalue['id']; ?>&file=<?php echo $prevalue['img3'];?>&filename=img3"><input type="button" value="delete"></a>
                                <?php
                                }
                                ?>
                            </div>
                            <div class="select">
                                <div class="text">image 4</div>
                                <?php
                                if($prevalue['img4'] != "")
                                {
                                    echo '<div class="preview">
                                    <img src="upload/images/vehicleImage/'.$prevalue['img4'].'">
                                    </div>';
                                }
                                ?>
                                <input type="file" id="img4" name="img4">
                                <?php
                                if(!empty($prevalue['img2']))
                                {
                                ?>
                                <a href="delete.php?id=<?php echo $prevalue['id']; ?>&file=<?php echo $prevalue['img4'];?>&filename=img4"><input type="button" value="delete"></a>
                                <?php
                                }
                                ?>
                            </div>
                            <div class="msg"></div>
                        </div>
                        <div class="lable" id="break"><b>Upload legal Documents *</b><span>(in PDF or DOCX format)</span></div>
                        <div class="document-select">
                            <div class="select">
                                <div class="text">Bill Book Details</div>
                                <?php
                                if($prevalue['billbookd'] != "")
                                {
                                    echo '<div class="previewf">
                                    <a href="upload/files/'.$prevalue['billbookd'].'" target="_blank" rel="noopener noreferrer">'.$prevalue['billbookd'].'</a>
                                    </div>';
                                }
                                ?>
                                <input type="file" id="billbookd" name="billbookd">
                            </div>
                            <div class="select">
                                <div class="text">Insurance Details</div>
                                <?php
                                if($prevalue['insuranced'] != "")
                                {
                                    echo '<div class="previewf">
                                    <a href="upload/files/'.$prevalue['insuranced'].'" target="_blank" rel="noopener noreferrer">'.$prevalue['insuranced'].'</a>
                                    </div>';
                                }
                                ?>
                                <input type="file" id="insuranced" name="insuranced">
                            </div>
                            <div class="msg"></div>
                        </div>
                        <?php
                        }
                        ?>
                        <div class="buttons">
                            <div class="post">
                                <input id="button" type="submit" value="Update" name="post" onclick="validate()">
                            </div>
                            <div class="cancel">
                                <input id="button" type="button" name="cancel" value="Cancel" onclick="cancelconfirm()">
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        
        <script>
            function cancelconfirm()
            {
                let confirmValue = confirm('Do you want to cancel?');
                if(confirmValue)
                {
                    window.location = 'mypostview.php?id=<?php echo $id;?>&category=fourwheelers';
                }
            }
            
        </script>
    </body>
</html>