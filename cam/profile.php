<html>
	<head>
		<title>Snack Tack</title>
		<link rel="stylesheet" href="css/snacktack.css" type="text/css" media="screen" />
		<meta name="viewport" content="user-scalable=no, width=device-width, initial-scale=1, maximum-scale=1" />
		<meta name="apple-mobile-web-app-capable" content="yes" />
	</head>
	<body>	
		<div id="fb-root"></div>
		<script>
			(function(d, s, id) {
				var js, fjs = d.getElementsByTagName(s)[0];
				if (d.getElementById(id)) {return;}
				js = d.createElement(s); js.id = id;
				js.src = "//connect.facebook.net/en_US/all.js#xfbml=1&appId=116798491783875";
				fjs.parentNode.insertBefore(js, fjs);
			}(document, 'script', 'facebook-jssdk'));
		</script>
		<script type="text/javascript">// <![CDATA[ function BlockMove(event) { event.preventDefault() ; } // ]]></script>

		<div id="header">
			<a href="index.php"><img src="img/logo_mini.png" /></a>
		</div>

		<div class="fb-login-button" size="large" onlogin="Log.info('onlogin callback')">Connect</div>
		
		<div id="back" name="back" onclick="window.location.replace('index.php')">Back</div>
	</body>
</html>
