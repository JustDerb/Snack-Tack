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
			<a href="index.php"><img src="img/logo_mini.png" /></a>
		</div>

		<form>
			<ul>
				<li>Search Options</li>
				<li class="info">
					<input type="radio" name="searchOption" value="byFoodType" />By Food Type
					<input type="radio" name="searchOption" value="byOrganization" />By Organization
				</li>
				<li class="info"><input type="text" placeholder="Search Terms" name="searchTerms" id="searchTerms" autocapitalizer="on" autocorrect="off" autocomplete="off" />
			</ul>
		</form>


		<ul id="searchResults">
			<li><a>Search Results</a></li>
		</ul>

		<div id="back" name="back" onclick="window.location.replace('index.php')">Back</div>
	</body>
</html>
