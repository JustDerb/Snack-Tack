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
		<script type="text/javascript" src="../../js/find.js"></script>
		<script type="text/javascript">// <![CDATA[ function BlockMove(event) { event.preventDefault(); } // ]]></script>
		<div id="header">
			<a href="index.php"><img src="../img/logo_mini.png" id="logo" /></a>
<?php if ($user): ?>
			<a href="profile.php"><img src="https://graph.facebook.com/<?php echo $user; ?>/picture" alt="" id="fbPicture" /></a>
<?php endif ?>
			<div id="clear"></div>
		</div>
	</head>
	<body onload="setTimeout(function() { window.scrollTo(0, 1) }, 100);">

<?php if (array_key_exists('terms', $_GET)): ?>
		<ul class="message">
			<li class="error">No events found. Try broadening your search criteria.</li>
		</ul>
<?php endif ?>

		<form method="get" id="findForm">
			<ul class="form">
				<li>Search Options</li>
				<li><input type="text" placeholder="Search Terms" name="terms" id="searchTerms" autocapitalizer="on" autocorrect="off" autocomplete="off" value="<?php if ($_GET['terms']) print($_GET['terms']); ?>"/>
			</ul>
		</form>

<?php if(array_key_exists('terms', $_GET)): ?>
		<ul class="link" id="searchResults">
			<li>Search Results</li>
		</ul>
<?php endif ?>
		<div id="submit" name="submit" onclick="return validateForm();">Submit</div>
		<div id="back" name="back" onclick="window.location.replace('index.php');">Back</div>
<?php include "../includes/labelfix.php"; ?>
	</body>
</html>

