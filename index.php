<?php
	require "includes/fb-login.php"; 
	require "api/snacktack.php";
?>
<html>
	<head>
		<title>Snack Tack</title>
		<link rel="stylesheet" href="css/reset.css" type="text/css" />
		<link rel="stylesheet" href="css/desktop.css" type="text/css" media="screen" />
		<link rel="icon" type="image/png" href="img/icon.ico">
		<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.3.2/jquery.min.js"></script>
		<meta property="og:site_name" content="Snack Tack" >
<?php require "includes/analytics.php"; ?>
	</head>
	<body>
		<div class="topbar">
			<div class="wndcontent">
				<div class="logo">LOGO</div>
				<span class="tabprofile"><a href="#">Profile</a></span>
				<form class="search">
					<input type="text" name="s" />
				</form>
			</div>
			<div class="clear"></div>
		</div>
		<div class="wndcontent">
			Content
		</div>
	</body>
</html>
