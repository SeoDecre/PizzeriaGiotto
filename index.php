<?php
session_start();
echo 'PHP version: ' . phpversion();

//Unset the variables stored in session
unset($_SESSION['SESS_MEMBER_ID']);
unset($_SESSION['SESS_FIRST_NAME']);
?>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>Giotto's pizza</title>

    <link href="style/style.css" media="screen" rel="stylesheet" type="text/css"/>
    <!--
    <link href="templatemo_style.css" rel="stylesheet" type="text/css"/>

    <script src="lib/jquery.js" type="text/javascript"></script>
    <script src="src/facebox.js" type="text/javascript"></script>
    -->
    <script type="text/javascript">
        jQuery(document).ready(function ($) {
            $('a[rel*=facebox]').facebox({
                loadingImage: 'src/loading.gif',
                closeImage: 'src/closelabel.png'
            })
        })
    </script>
</head>
<body>
<div id="templatemo_container">
    <div id="templatemo_header_section"></div>
    <div id="templatemo_menu_bg">
        <div id="templatemo_menu">
            <ul>
                <li><a href="index.html" class="current">Home</a></li>
                <li><a href="aboutus.php">About Us</a></li>
                <li><a href="contact.php">Location</a></li>
                <li><a href="product.php">Product</a></li>
                <li><a href="loginindex.php">Order Now! </a></li>
                <li><a href="franchise.php">Franchise</a></li>
            </ul>
        </div>
    </div>
    <div id="templatemo_header_pizza"></div>
    <div id="templatemo_content">
        <div id="templatemo_content_left"><img src="images/main1.jpg" width="729" height="312"
                                               style="margin-left:-10px;"/></div>
        <div id="templatemo_card"></div>
    </div>
    <div id="templatemo_container_end"></div>
</div>
<div id="templatemo_footer">
    <div class="top"></div>
    <div class="middle">
        Copyright © Giotto's pizza
    </div>
    <div class="button"></div>
</div>
<div>
</div>
</body>

