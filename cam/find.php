<?php require "includes/fb-login.php"; 
	  require '../api/snacktack.php'; ?>
<html>
	<head>
		<title>Snack Tack</title>
		<link rel="stylesheet" href="css/snacktack.css" type="text/css" media="screen" />
		<link rel="icon" type="image/png" href="img/icon.ico">
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

		<form>
			<ul>
				<li>Search Options</li>
				<li class="info"><input type="text" placeholder="Search Terms" name="searchTerms" id="searchTerms" autocapitalizer="on" autocorrect="off" autocomplete="off" />
				<li class="info"><input type="radio" name="searchOption" value="byFoodType" id="byFoodType" checked /><label for="byFoodType">By Food Type</label></li>
				<li class="info"><input type="radio" name="searchOption" value="byOrganization" id="byOrganization" /><label for="byOrganization">By Organization</li>
				</li>
			</ul>
		</form>


		<ul id="searchResults">
			<li><a>Search Results</a></li>
		</ul>

		<div id="back" name="back" onclick="window.location.replace('index.php')">Back</div>
<?php include "includes/labelfix.php"; ?>
	</body>
</html>
