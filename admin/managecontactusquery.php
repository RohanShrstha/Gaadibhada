<?php
    include 'includes/conn.php';
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
    <title>Contact Us Queries</title>
    <link href="img/logo.png" rel="icon">

</head>

<body>
<?php
        include 'includes/header.php';
    ?>
	<div class="container">
	<div class="title">Manage Contact Us Queries</div><br><hr><br>

        <table style="width: 98%;">
            <tr>
                <th style="width: 4%;">S.N.</th>
                <th style="width: 10%;">Name</th>
                <th style="width: 16%;">Email</th>
                <th style="width: 10%;">Contact No</th>
                <th style="width: 30%;">Message</th>
                <th style="width: 12.5%;">Posting date</th>
                <th style="width: 8%;">Status</th>
            </tr>

            <?php
            $sql = "SELECT * FROM tbl_suggestion ORDER BY customer_id DESC";
            $result = mysqli_query($conn, $sql);
            $count=1;
            if (mysqli_num_rows($result) > 0) {
                while ($value = mysqli_fetch_assoc($result)) {
            ?>

            <tr>
                <td><?php echo htmlentities($count); ?></td>
                <td><?php echo $value['cname']; ?></td>
                <td><a href="mailto:<?php  echo $value['email'];?>" class="nounderline"><?php echo $value['email']; ?></td></a>
                <td><?php echo $value['phone']; ?></td>
                <td><?php echo $value['message']; ?></td>
                <td><?php echo $value['PostingDate']; ?></td>
                <td>
                    <?php
                    if($value['status'] == 'Pending')
                    {
                    ?>
                        <a href="readcontactus.php?id=<?php echo $value['customer_id'];?>" onclick="confirmAction()"><button><?php echo $value['status'];?></button></a>
                    <?php
                    }
                    else
                    {
                    ?>
                        <?php echo $value['status'];?>
                    <?php
                    } 
                    ?>
                </td>
                
                <?php
                $count=$count+1; }
                }
                else
                {
                    echo '<tr><td colspan="7"> No Vehicles posted yet</td></tr>';
                }
                ?>
            </tr>      
        </table>
        <script>
            function confirmAction(){
                let cv = confirm('Change Status to Read?');
                if(!cv)
                {
                    event.preventDefault();
                }
            }
        </script>
	</div>
</body>
</html>