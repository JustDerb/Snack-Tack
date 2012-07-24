<?php
	require "../includes/fb-login.php"; 
	require "../api/snacktack.php";
?>
<html>
	<head>
<?php require "../includes/head.php"; ?>
<?php require "../includes/analytics.php"; ?>
	</head>
	<body onload="setTimeout(function() { window.scrollTo(0, 1) }, 100);">
<?php include "includes/header.php"; ?>

<?php if ($user): ?>
		<h2>Howdy, <?php echo $user_profile['first_name']; ?>!</h2>
<?php endif ?>

		<ul class="link">
			<li>Events</li>
			<li><a href="today.php">Today's Events</a></li>
<?php if ($user): ?>
			<li><a href="tacked.php">Your Tacked Events</a></li>
<?php endif ?>
		</ul>
		
		<ul class="link">
			<li>Event Management</li>
<?php if ($user): ?>
			<li><a href="plan.php">Plan</a></li>
<?php endif ?>
			<li><a href="find.php">Find</a></li>
<?php if ($user): ?>
			<li><a href="promote.php">Promote</a></li>
<?php endif ?>
		</ul>
	
		<ul class="link">
			<li>Settings</li>
			<li><a href="profile.php">Profile</a></li>
			<li><a href="help.php">Help</a></li>
			<li><a href="terms.php">Privacy, Terms</a></li>
		</ul>

<?php include "includes/labelfix.php"; ?>
	</body>
</html>
