<?php require "includes/fb-login.php"; 
	  require '../api/snacktack.php'; ?>
<html>
	<head>
		<title>Snack Tack</title>
		<link rel="stylesheet" href="css/snacktack.css" type="text/css" media="screen" />
		<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.3.2/jquery.min.js"></script>
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
<?php if ($user): ?>
			<li><a class="link" href="<?php echo $logoutUrl; ?>">Logout of Facebook</a></li>
<?php else: ?>
			<li><a class="link" href="<?php echo $loginUrl; ?>">Connect with Facebook</a></li>
<?php endif ?>
		</ul>

<?php if ($user): ?>
		<form>
			<ul>
				<li>Networks</li>
				<li class="info"><input type="radio" name="networkOption" value="herp" id="herp" /><label for="herp">Herp</label></li>
				<li class="info"><input type="radio" name="networkOption" value="derp" id="derp" /><label for="derp">Derp</label></li>
			</ul>
		</form>
<?php endif ?>
		
		<div id="back" name="back" onclick="window.location.replace('index.php')">Back</div>
<?php include "includes/labelfix.php"; ?>
	</body>
</html>
