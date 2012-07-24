<?php require "../includes/fb-login.php"; 
	  require "../api/snacktack.php"; 
	  //Grab our data before we include our form PHP code
	$st_user = st_user_register($user_profile, true);
	st_loginonly_check($st_user, $facebook, "profile.php?nologin=1&url=promote.php");
?>
<html>
	<head>
<?php require "../includes/head.php"; ?>
<?php require "../includes/analytics.php"; ?>
	</head>
	<body onload="setTimeout(function() { window.scrollTo(0, 1) }, 100);">
<?php include "includes/header.php"; ?>

		<ul class="message">
			<li class="success">
				The promote option is coming soon!
			</li>
			<li class="message">
				Use this option to promote events that are not on Snack Tack, 
				is not your event, but you want other people to know about it!
				When the owner of the event sees your event, he or she can then
				claim it as their own! (Also, your helping the Snack Tack community
				and the event owners - a win-win!)
			</li>
		</ul>

		<div id="back" name="back" onclick="window.history.back();">Back</div>	
<?php include "includes/labelfix.php"; ?>
	</body>
</html>
