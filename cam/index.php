<?php
	require "includes/fb-login.php"; 
	require "../api/snacktack.php";
?>
<html>
	<head>
<?php require "includes/head.php"; ?>
	</head>
	<body>
		<script type="text/javascript">// <![CDATA[ function BlockMove(event) { event.preventDefault(); } // ]]></script>
		<div id="header">
			<a href="index.php"><img src="img/logo_mini.png" id="logo" /></a>
<?php if ($user): ?>
			<a href="profile.php"><img src="https://graph.facebook.com/<?php echo $user; ?>/picture" alt="" id="fbPicture" /></a>
<?php endif ?>
			<div id="clear"></div>
		</div>

<?php if ($user): ?>
		<h2>Howdy, <?php echo $user_profile['first_name']; ?>!</h2>
<?php endif ?>

		<ul>
			<li class="head">Events</li>
			<li><a href="today.php">Today's Events</a></li>
<?php if ($user): ?>
			<li><a href="#">Your Tacked Events</a></li>
<?php endif ?>
		</ul>
		
		<ul>
			<li class="head">Event Management</li>
<?php if ($user): ?>
			<li><a href="plan.php">Plan</a></li>
<?php endif ?>
			<li><a href="find.php">Find</a></li>
<?php if ($user): ?>
			<li><a href="promote.php">Promote</a></li>
<?php endif ?>
		</ul>
	
		<ul>
			<li class="head">Settings</li>
			<li><a href="profile.php">Profile</a></li>
			<li><a href="help.php">Help</a></li>
			<li><a href="terms.php">Privacy, Terms</a></li>
		</ul>

	</body>
</html>
