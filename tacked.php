<?php require "includes/fb-login.php"; 
	  require "api/snacktack.php"; 
	  //Grab our data before we include our form PHP code
	$st_user = st_user_register($user_profile, true);
	st_loginonly_check($st_user, $facebook, "profile.php?nologin=1&url=tacked.php");
?>
<html>
	<head>
<?php require "includes/head.php"; ?>
	</head>
	<body>
<?php include "includes/header.php"; ?>



		<div id="back" name="back" onclick="window.history.back();">Back</div>	
<?php include "includes/labelfix.php"; ?>
	</body>
</html>