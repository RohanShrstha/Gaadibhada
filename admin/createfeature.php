<?php
    session_start();
    include "includes/conn.php";
    include('includes/config.php');
	if(!isset($_SESSION['alogin']))
	{	
	    header('location:index.php');
	}

    if(isset($_POST['submit']))
    {
        $category = $_POST['category']; 
        $featurename = $_POST['featurename'];
        // database insert SQL code
        if($category == "twowheelers") 
            $sql = "INSERT INTO tbl_features (name,category) VALUES ('$featurename','twowheelers')";
        else
            $sql = "INSERT INTO tbl_features (name,category) VALUES ('$featurename','fourwheelers')";
        // insert in database 
        if($submit = mysqli_query($conn, $sql)){
            echo "<script>
                alert('Feature Created Successfully');
                window.location='managefeatures.php';
            </script>";
        }
        else {
            echo "<script>
                alert('Error in creating feature');
            </script>";	
        }
    }
?>
 
<!DOCTYPE html>
<head>
<link rel="stylesheet" href="css/form.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <title>Create Feature</title>
    <link href="img/logo.png" rel="icon">
</head>

<body>
<?php
    include 'includes/header.php';
?>
<div class="container">
    <div class="title">Create Feature</div><br><hr><br>
        <div class="form-container">  
            <form method="POST" action="#">
                <table>
                    <tr><td colspan="3" bgcolor="#e1e1d0">Form Fields</td></tr>
                    <tr>
                        <div class="input-box">
                            <td><label>Category</label></td>
                            <td colspan="2">
                                <select name="category" class="abc">
                                    <option value="fourwheelers">Four Wheelers</option>
                                    <option value="twowheelers">Two Wheelers</option>
                                </select>
                            </td>
                        </div>
                    </tr>

                    <tr>
                        <div class="input-box">
                            <td><label>Feature Name</label></td>
                            <td colspan="2"><input type="text" class="abc" name="featurename"  id="featurename" required></td>
                        </div>
                    </tr>
                    
                    <tr>
                        <td></td>
                        <td><input type="submit" value="Submit" name="submit" class="button"></td>
                    </tr>
                </table>
            </form>
        </div>
    </div>	
</div>
</body>
</html>