<?php 
	require "../includes/fb-login.php"; 
	require "../api/snacktack.php";
?>
<html>
	<head>
		<title>Snack Tack</title>
		<link rel="stylesheet" href="../css/snacktack.css" type="text/css" media="screen" />
		<link rel="icon" type="image/png" href="../img/icon.ico">
		<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.3.2/jquery.min.js"></script>
		<meta name="viewport" content="user-scalable=no, width=device-width, initial-scale=1, maximum-scale=1" />
		<meta name="apple-mobile-web-app-capable" content="yes" />
		<meta property="og:site_name" content="Snack Tack" >
		<script type="text/javascript">// <![CDATA[ function BlockMove(event) { event.preventDefault(); } // ]]></script>
		<div id="header">
			<a href="index.php"><img src="../img/logo_mini.png" id="logo" /></a>
<?php if ($user): ?>
			<a href="profile.php"><img src="https://graph.facebook.com/<?php echo $user; ?>/picture" alt="" id="fbPicture" /></a>
<?php endif ?>
			<div id="clear"></div>
		</div>
		<script type="text/javascript">var fb_auth_token = "<?php echo ($facebook->getAccessToken()); ?>"</script>
	</head>
	<body onload="setTimeout(function() { window.scrollTo(0, 1) }, 100);">
		<form method="get" id="findForm">
			<ul class="form">
				<li>Search Options</li>
				<li><input type="text" placeholder="Search Terms" name="terms" id="orgtext" autocapitalizer="on" autocorrect="off" autocomplete="off" value="<?php if ($_GET['terms']) print($_GET['terms']); ?>"/>
			</ul>
		</form>
		<ul class="info" id="resultsTable">
			<li>Search Results</li>
		</ul>
		<div id="submit" name="submit" onclick="return validateForm();">Submit</div>
		<div id="back" name="back" onclick="window.location.replace('index.php');">Back</div>
		<div class="facebookfeed" id="resultsJSON"></div>
		<script type="text/javascript" src="js/ajax_groups.js"></script>
<?php include "../includes/labelfix.php"; ?>
	</body>
</html>

