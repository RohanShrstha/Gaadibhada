<?php
include 'includes/conn.php';
session_start();
if(!isset($_SESSION['log_status']))
{
    header('location:login.php');
}

 if($_SERVER['REQUEST_METHOD']=="POST")
 {
     if(isset($_POST['post']))
     {
         $title = $_POST['title'];
         $brand = $_POST['brand'];
         $type = $_POST['type'];
         $description = $_POST['description'];
         $makeyear = $_POST['makeyear'];
         $engine = $_POST['engine'];
         $transmission = $_POST['transmission'];
         $fuel = $_POST['fuel'];
         $mileage = $_POST['mileage'];
         $price = $_POST['price'];
         $supplierid = $_SESSION['id'];
         $category = 'twowheelers';
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
                $imgPath = 'upload/images//vehicleImage/'.$newImgName;
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

         $img1 = $img2 = $img3 = $img4 = $billbookd = $insuranced = NULL;
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
         $sql = "INSERT INTO tbl_vehicles(title,brand,type,description,makeyear,engine,transmission,fuel,mileage,features,price,img1,img2,img3,img4,billbookd,insuranced,supplierid,category) VALUES('$title','$brand','$type',
             '$description','$makeyear','$engine','$transmission','$fuel','$mileage','$features','$price','$img1','$img2','$img3','$img4','$billbookd','$insuranced','$supplierid','$category')";
        if(mysqli_query($conn,$sql)){
            $stmt = "UPDATE tbl_customer SET type = 'Supplier'";
            mysqli_query($conn,$stmt);
            header('location:myposts.php');
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
        <script src="js/validatePost1.js"></script>
        <link href="images/pictures/logo.png" rel="icon">
        <title>Add Product</title>
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
                    Post a vehicle
                </div>
                <div class="form">
                    <form action="#" method="post" id="form" enctype="multipart/form-data">
                        <div class="lable">Enter the title *</div>
                        <div class="input-box">
                            <input type="text" name="title"  id="title">
                            <div class="msg"></div>
                        </div>
                        <div class="category">
                            <div class="content-box">
                                <div class="lable">Select Brand</div>
                                <div class="input-box">
                                    <select name="brand" id="brand">
                                        <option value="0">Brand *</option>
                                        <?php
                                        $sql = "SELECT * FROM tbl_brand WHERE category = 'twowheelers' ORDER BY name";
                                        $result = mysqli_query($conn,$sql);
                                        if(mysqli_num_rows($result)>0)
                                        {
                                            while($value = mysqli_fetch_assoc($result))
                                            {
                                        ?>
                                        <option value="<?php echo $value['name'];?>"><?php echo $value['name'];?></option>
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
                                        $sql = "SELECT * FROM tbl_type1 ORDER BY name";
                                        $result = mysqli_query($conn,$sql);
                                        if(mysqli_num_rows($result)>0)
                                        {
                                            while($value = mysqli_fetch_assoc($result))
                                            {
                                        ?>
                                        <option value="<?php echo $value['name'];?>"><?php echo $value['name'];?></option>
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
                            <textarea name="description" id="description"></textarea>
                            <div class="msg"></div>
                        </div>
                        <div class="lable" id="break"><b>Specifications *</b></div>
                        <div class="specification">
                            
                            <div class="content-box">
                                <div class="lable">Make Year *</div>
                                <div class="input-box">
                                    <input type="text" id="makeyear" name="makeyear">
                                    <div class="msg"></div>
                                </div>
                            </div>
                            <div class="content-box">
                                <div class="lable">Engine*</div>
                                <div class="input-box">
                                    <input type="text" id="engine" name="engine" placeholder="CC">
                                    <div class="msg"></div>
                                </div>
                            </div>
                            <div class="content-box">
                                <div class="lable">Transmission*</div>
                                <div class="input-box">
                                    <select name="transmission" id="transmission">
                                        <option value="0">Select</option>
                                        <option value="Automatic">Automatic</option>
                                        <option value="Manual">Manual</option>
                                    </select>
                                    <div class="msg"></div>
                                </div>
                            </div>
                            <div class="content-box">
                                <div class="lable">Fuel *</div>
                                <div class="input-box">
                                    <select name="fuel" id="fuel">
                                        <option value="0">Select</option>
                                        <option value="Petrol">Petrol</option>
                                        <option value="Diesel">Diesel</option>
                                        <option value="Electric">Electric</option>
                                    </select>
                                    <div class="msg"></div>
                                </div>
                            </div>
                            <div class="content-box">
                                <div class="lable">Mileage *</div>
                                <div class="input-box">
                                    <input type="text" id="mileage" name="mileage" placeholder="KM">
                                    <div class="msg"></div>
                                </div>
                            </div>
                            
                        </div>
                        <div class="lable" id="break"><b>Features</b></div>
                        <div class="features">
                        <?php
                            $sql = "SELECT * FROM tbl_features WHERE category = 'twowheelers' ORDER BY name";
                            $result = mysqli_query($conn,$sql);
                            if(mysqli_num_rows($result)>0)
                            {
                                while($value = mysqli_fetch_assoc($result))
                                {
                            ?>
                            <div class="feature">
                                <input type="checkbox" name="chk[]" value="<?php echo $value['name'];?>"> <?php echo $value['name'];?>
                            </div>
                            <?php
                                }
                            }
                            ?>
                        </div>
                        <div class="lable" id="break"><b>Price Per Day *</b></div>
                        <div class="content-box">
                            <div class="input-box">
                                <input type="text" id="price" name="price" placeholder="IN NPR">
                                <div class="msg"></div>
                            </div>
                        </div>
                        <div class="lable" id="break"><b>Upload Images * </b><span>(in jpg format)</span></div>
                        <div class="image-select">
                            <div class="select">
                                <div class="text">image 1</div>
                                <input type="file" id="img1" name="img1">
                            </div>
                            <div class="select">
                                <div class="text">image 2</div>
                                <input type="file" id="img2" name="img2">
                            </div>
                            <div class="select">
                                <div class="text">image 3</div>
                                <input type="file" id="img3" name="img3">
                            </div>
                            <div class="select">
                                <div class="text">image 4</div>
                                <input type="file" id="img4" name="img4">
                            </div>
                            <div class="msg"></div>
                        </div>
                        <div class="lable" id="break"><b>Upload legal Documents *</b><span>(in PDF or DOCX format)</span></div>
                        <div class="document-select">
                            <div class="select">
                                <div class="text">Bill Book Details</div>
                                <input type="file" id="billbookd" name="billbookd">
                            </div>
                            <div class="select">
                                <div class="text">Insurance Details</div>
                                <input type="file" id="insuranced" name="insuranced">
                            </div>
                            <div class="msg"></div>
                        </div>
                        <div class="buttons">
                            <div class="post">
                                <input id="button" type="submit" value="Post" name="post" onclick="validate()">
                            </div>
                            <div class="cancel">
                                <input id="button" type="reset" value="Cancel">
                            </div>
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
    </body>
</html>