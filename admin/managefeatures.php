<?php
    session_start();
    if(!isset($_SESSION['alogin']))
	{	
	    header('location:index.php');
	}
?>
<!DOCTYPE html>

<head>
    <link rel="stylesheet" href="css/table.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <title>Manage Features</title>
    <link href="img/logo.png" rel="icon">
    <style>
        .fbutton{
            display: flex;
            justify-content: space-evenly;
            align-items: baseline;
        }
        .fbutton a{
            text-decoration: none;
        }
    </style>
</head>

<body>
    <?php
    include 'includes/header.php';
    ?>
    <div class="container">
        <div class="title">Manage Featuress</div><br>
        <hr><br>
        <!-- Four Wheelers -->
        <div class="category">Four Wheelers</div>
        <table width="98%">
            <tr>
                <th style="width: 50px;">S.N.</th>
                <th>Name</th>
                <th>Create Date</th>
                <th>Update Date</th>
                <th>Action</th>
            </tr>

            <?php
            $sql = "SELECT * FROM tbl_features WHERE category = 'fourwheelers' ORDER BY id DESC";
            $result = mysqli_query($conn, $sql);
            $count=1;
            if (mysqli_num_rows($result) > 0) {
                while ($value = mysqli_fetch_assoc($result)) {
            ?>
            <tr>
                <td><?php echo htmlentities($count); ?></td>
                <td><?php echo $value['name']; ?></td>
                <td><?php echo $value['createdate']; ?></td>
                <td><?php echo $value['updatedate'];?></td>
                <td>
                    <div class="fbutton">
                        <a href="editfeature.php?id=<?php echo $value['id']; ?>&category=<?php echo $value['category'];?>">
                            <button class="fbutton">
                                <i class='fas fa-edit' style='font-size:20px; color:white;'></i>EDIT
                            </button>
                        </a>
                        <a href="deletefeature.php?id=<?php echo $value['id']; ?>&category=<?php echo $value['category'];?>" onclick="confirmDelete()">
                            <button class="fbutton">
                                <i class='far fa-trash-alt' style='font-size:20px;color:white;'></i>DELETE
                            </button>
                        </a>
                    </div>
                </td>
                <?php
                $count=$count+1; }
            }
            ?>
            </tr>
        </table>
        <br><br>

        <!-- Two Wheelers -->
        <div class="category">Two Wheelers</div>
        <table width="98%">
            <tr>
                <th style="width: 50px;">S.N.</th>
                <th>Name</th>
                <th>Create Date</th>
                <th>Update Date</th>
                <th>Action</th>
            </tr>

            <?php
            $sql = "SELECT * FROM tbl_features WHERE category = 'twowheelers' ORDER BY id DESC";
            $result = mysqli_query($conn, $sql);
            $count=1;
            if (mysqli_num_rows($result) > 0) {
                while ($value = mysqli_fetch_assoc($result)) {
            ?>
            <tr>
                <td><?php echo htmlentities($count); ?></td>
                <td><?php echo $value['name']; ?></td>
                <td><?php echo $value['createdate']; ?></td>
                <td><?php echo $value['updatedate']; ?></td>
                <td>
                    <div class="fbutton">
                        <a href="editfeature.php?id=<?php echo $value['id']; ?>&category=<?php echo $value['category'];?>">
                            <button class="fbutton">
                                <i class='fas fa-edit' style='font-size:20px; color:white;'></i>EDIT
                            </button>
                        </a>
                        <a href="deletefeature.php?id=<?php echo $value['id']; ?>&category=<?php echo $value['category'];?>" onclick="confirmDelete()">
                            <button class="fbutton">
                                <i class='far fa-trash-alt' style='font-size:20px;color:white;'></i>DELETE
                            </button>
                        </a>
                    </div>
                </td>
                <?php
                $count=$count+1; }
            }
            ?>
            </tr>
        </table>
    </div>
</body>
<script>
    function confirmDelete(){
        confirmValue = confirm('Delete feature?');
        if(!confirmValue)
        {
            event.preventDefault();
        }
    }
</script>
</html>