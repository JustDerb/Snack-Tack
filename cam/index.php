<html>
	<head>
		<title>Snack Tack</title>
		<link rel="stylesheet" href="css/snacktack.css" type="text/css" media="screen" />
	</head>
	<body>
		<img src="img/snacktack.png" />
		<div id="fb-root"></div>
		<script>
			(function(d, s, id) {
				var js, fjs = d.getElementsByTagName(s)[0];
				if (d.getElementById(id)) return;
				js = d.createElement(s); js.id = id;
				js.src = "//connect.facebook.net/en_US/all.js#xfbml=1&appID=APP_ID";
				fjs.parentNode.insertBefore(js, fjs);
			}(document, 'script', 'facebook-jssdk'));
		</script>
		<div class="fb-login-button" data-show-faces="false" data-width="500" data-max-rows="1"></div>

		<ul>
			<li><a>Events</a></li>
			<li><a href="plan.php" class="link">Plan</a></li>
			<li><a href="#" class="link">Find</a></li>
		</ul>

		<ul>
			<li><a>Settings</a></li>
			<li><a href="#" class="link">Profile</a></li>
			<li><a href="#" class="link">Help, Privacy, Terms</a></li>
		</ul>

	</body>
</html>
