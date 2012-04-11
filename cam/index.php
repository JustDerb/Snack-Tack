<?php require "includes/fb-login.php"; 
	  require '../api/snacktack.php'; ?>
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
