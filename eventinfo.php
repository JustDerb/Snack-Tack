<?php require "includes/fb-login.php"; 
	  require "api/snacktack.php"; ?>
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

		<h2>Event Information</h2>
		<ul class="info">
			<li class="head">Basic Info</li>
			<li>Name</li>
			<li>Description</li>
		</ul>

		<ul class="info">
			<li class="head">What's being sold</li>
<?php //foreach all food options - don't include "Food - " part ?>
		</ul>

		<ul class="info">
			<li class="head">Day and Time</li>
			<li>Thursday, April 12th 2012</li>
			<li>
				Start @ HH:MM
				End @ HH:MM
			</li>
		</ul>

		<ul class="info">
			<li class="head">Organization</li>
			<li>Com Sci and Soft E Club</li>
		</ul>

		<ul class="info">
			<li class="head">Facebook Event URL</li>
			<li><a href="#">To the Facebook!</a></li>
		</ul>
		
<?php if (isset($_GET['home'])): ?>
		<div id="back" name="back" onclick="index.php">Home</div>
<?php else: ?>
		<div id="back" name="back" onclick="window.history.back();">Back</div>		
<?php endif ?>
		
<?php include "includes/labelfix.php"; ?>
	</body>
</html>
