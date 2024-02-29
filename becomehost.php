<?php
    session_start();
    if(!isset($_SESSION['log_status']))
    {
        header('location:login.php');
    }
?>
<html>
    <head>
    <link href="images/pictures/logo.png" rel="icon">
    <title>Add Product</title>
        <style>
            *{
                margin: 0px;
                padding: 0px;
                box-sizing: border-box;
            }
            .header{
                width: 100%;
                height: 11vh;
            }
            .containerb{
                width: 100%;
                height: 78vh;
                display: flex;
                justify-content: center;
            }
            .choice-wrapper{
                width: 70%;
                height: 52vh;
                top: 10vh;
                position: relative;
                border: 2px solid black;
                border-radius: 10px;
            }
            .title{
                width: 70vw;
                height: 6vh;
                font-size: 1.5em;
                padding-top: 10px;
                border-radius: 8px 8px 0px 0px;
                border: 1px solid black;
                background-color: blueviolet;
                color: white;
                text-align: center;
            }
            .choice-box{
                width: 100%;
                height: 40vh;
                top: 4vh;
                position: relative;
                display: flex;
                justify-content: space-evenly;
            }
            .four-wheeler, .two-wheeler{
                display: inline-block;
                width: 35vh;
                height: 40vh;
            }
            a{
                text-decoration: none;
                color: black;
                font-size: 1em;
            }
            .four-wheeler a img, .two-wheeler a img{
                width: 35vh;
                height: 35vh;
                border: 1px solid black;
                border-radius: 10px;
                object-fit: cover;
                box-shadow: 2px 0px 10px black;
            }
            #title{
                padding-top: 10px;
                text-align: center;
                height: 20px;
                font-size: 20px;
                font-weight: 600;
            }
            .four-wheeler:hover img, .two-wheeler:hover img{
                transform: scale(1.01);
            }
            #title:hover{
                color: blueviolet;
            }
            .footer{
                width: 100%;
                height: 11vh;
                background-color: black;
            }
        </style>
    </head>
    <body>
        <div class="header">
            <?php
                include 'includes/heading.php';
            ?>
        </div>
        <div class="containerb">
          
                <div class="choice-wrapper">
                    <div class="title">Select Category</div>
                    <div class="choice-box">
                        <div class="four-wheeler">
                            <a href="addfourwheelers.php">
                                <img src="images/pictures/carjeep.jpg">
                                <div id="title">Four-Wheelers</div>
                            </a>
                        </div>
                        <div class="two-wheeler">
                            <a href="addtwowheelers.php">
                                <img src="images/pictures/bike1.jpg">
                                <div id="title">Two-Wheelers</div>
                            </a>
                        </div>
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