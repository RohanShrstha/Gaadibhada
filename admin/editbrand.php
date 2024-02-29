<?php
include "includes/conn.php";

if(isset($_GET['id']) && isset($_GET['category']))
{
    $id = $_GET['id'];
    
    $sql = "SELECT * FROM tbl_brand WHERE id = '$id'";

    $result = mysqli_query($conn,$sql);
    if(mysqli_num_rows($result)>0)
    {
        $row = mysqli_fetch_assoc($result);
    }
    else{
        echo "
            <script>
                alert('No such brand found');
                window.location='managebrand.php';
            </script>
        ";
    }
    
    if(isset($_POST['submit']))
    {
        $brandname = $_POST['brandname'];
        // database insert SQL code
        $sql = "UPDATE tbl_brand SET name = '$brandname' WHERE id = '$id'";
        // insert in database 
        if($submit = mysqli_query($conn, $sql)){
            echo "<script>
                alert('Updated Successfully');
                window.location='managebrand.php';
            </script>";
        }
        else {
            echo "<script>
            alert('Error in updating');
            window.location='managebrand.php';
        </script>";
        }
    }

}
else
{
    header('location:managebrand.php');
}
?>

<!DOCTYPE html>
<head>
<link rel="stylesheet" href="css/form.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <title>Edit Brand</title>
    <link href="img/logo.png" rel="icon">
</head>

<body>
<?php
    include 'includes/header.php';
?>
<div class="container">
    <div class="title">Edit Brand</div><br><hr><br>
        <div class="form-container">  
            <form method="POST" action="#">
                <table>
                    <tr><td colspan="3" bgcolor="#e1e1d0">Form Fields</td></tr>
                    <tr>
                        <div class="input-box">
                            <td><label>Brand Name</label></td>
                            <td colspan="2"><input type="text" class="abc" name="brandname"  id="brandname" value="<?php if(isset($brandname)){ echo $brandname;} else { echo $row['name'];}?>"></td>
                        </div>
                    </tr>
                    
                    <tr>
                        <td></td>
                        <td><input type="submit" value="Update" name="submit" class="button"></td>
                    </tr>
                </table>
            </form>
        </div>
    </div>	
</div>
</body>
</html>