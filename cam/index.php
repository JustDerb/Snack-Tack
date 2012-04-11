<?php require "fb-login.php"; 
	  require '../api/snacktack.php'; ?>
<html>
	<head>
		<title>Snack Tack</title>
		<link rel="stylesheet" href="css/snacktack.css" type="text/css" media="screen" />
		<link rel="icon" type="image/png" href="img/icon.ico">
		<meta name="viewport" content="user-scalable=no, width=device-width, initial-scale=1, maximum-scale=1" />
		<meta name="apple-mobile-web-app-capable" content="yes" />
	</head>
	<body>
		<script type="text/javascript">// <![CDATA[ function BlockMove(event) { event.preventDefault(); } // ]]></script>
		<div id="header">
			<a href="index.php"><img src="img/logo_mini.png" id="logo" /></a>
<?php if ($user): ?>
			<img src="https://graph.facebook.com/<?php echo $user; ?>/picture" alt="" id="fbPicture" />
<?php endif ?>
		<div id="clear"></div>
		</div>
		<ul>
			<li><a>Events</a></li>
<?php if ($user): ?>
			<li><a href="plan.php" class="link">Plan</a></li>
<?php endif ?>
			<li><a href="find.php" class="link">Find</a></li>
<?php if ($user): ?>
			<li><a href="promote.php" class="link">Promote</a></li>
<?php endif ?>
		</ul>
	
		<ul>
			<li><a>Settings</a></li>
			<li><a href="profile.php" class="link">Profile</a></li>
			<li><a href="help.php" class="link">Help</a></li>
			<li><a href="terms.php" class="link">Privacy, Terms</a></li>
		</ul>

	</body>
</html>
