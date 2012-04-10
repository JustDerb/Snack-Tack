<html>
	<head>
		<title>Snack Tack</title>
		<link rel="stylesheet" href="css/jqtouch.css" type="text/css" media="screen" />
		<link rel="stylesheet" href="css/theme.css" type="text/css" media="screen" />	
		<script type="text/javascript" src="js/jquery.1.3.2.min.js"></script>
		<script type="text/javascript" src="js/jqtouch.min.js"></script>
		<script type="text/javascript">
			var jQT = $.jQTouch({
				icon: '../img/snacktack.jpg',
				statusBar: 'black'
			});
		</script>
	</head>
	<body>
		<div id="home">
			<div class="toolbar">
				<h1>Snack Tack</h1>
			</div>
			<ul class="rounded">
				<li class="forward"><a href="#">Sign in with Facebook</a></li>
			</ul>
			<h2>Snack</h2>
			<ul class="rounded">
				<li class="arrow"><a href="#plan">Plan</a></li>
				<li class="arrow"><a href="#find">Find</a></li>
				<li class="arrow"><a href="#promote">Promote</a></li>
			</ul>
			<ul class="rounded">
				<li class="arrow"><a href="#about">About</a></li>
				<li class="arrow"><a href="#privacy">Privacy</a></li>
				<li class="arrow"><a href="#terms">Terms</a></li>
				<li class="arrow"><a href="#support">Support</a></li>
			</ul>
		</div>
		

		<div id="plan">
			<div class="toolbar">
				<h1>Plan</h1>
				<a class="button back" href="#">Back</a>
				<a class="button flip" href="#createEntry">+</a>
			</div>
		</div>
		<div id="createEntry">
			<div class="toolbar">
				<h1>Plan an Event</h1>
				<a class="button cancel" href="#">Cancel</a>
			</div>
			<form method="post">
				<h2>Basic Info</h2>
				<ul>
					<li><input type="text" placeholder="Event Name" name="eventName" id="eventName" autocapitalizer="on" autocorrect="off" autocomplete="off" /></li>
					<li><input type="text" placeholder="Event Description" name="eventDescription" id="eventDescription" autocapitalizer="on" autocorrect="off" autocomplete="off" /></li>
				</ul>

				<h2>Food Options</h2>
				<ul>
					<li><input type="checkbox" name="foodOptions" value="pizza" title="Pizza" /></li>
					<li><input type="checkbox" name="foodOptions" value="ice cream" title="Ice Cream" /></li>
					<li><input type="checkbox" name="foodOptions" value="root beer floats" title="Root Beer Floats" /></li>
					<li><input type="checkbox" name="foodOptions" value="apparel" title="Apparel" /></li>
					<li><input type="checkbox" name="foodOptions" value="other"/>
						<input type="text" placeholder="Other" name="otherText" id="otherText" autocapitalizater="on" autocorrect="on" autocomplete="off" /></li>
				</ul>

				<h2>Time and Place<h2>

				<h2>Facebook Event Page</h2>
				<ul>
					<li><input type="url" placeholder="URL (optional)" name="facebookEventURL" id="facebookEventURL" autocapitalization="off" autocorrect="off" autocomplete="off" /></li>
				</ul>

				<h2>Group/Organization</h2>
				<ul>
					<li><input type="text" placeholder="Group/Organization Name" name="groupName" id="groupName" autocapitalizer="on" autocorrect="off" autocomplete="off" /></li>
				</ul>

				<a href="#" class="whiteButton" style="margin: 0 10px 0 10px;" action="submit">Submit</a>
			</form>
		</div>


		<div id="find">
			<div class="toolbar">
				<h1>Find</h1>
				<a class="button back" href="#">Back</a>
			</div>
			<form>
			<h2>Search By...</h2>
				<ul>
					<li><input type="checkbox" name="searchOptions" value="eventName" title="Event Name" /></li>
					<li><input type="checkbox" name="searchOptions" value="eventDate" title="Event Date" /></li>
					<li><input type="checkbox" name="searchOptions" value="eventGroup" title="Event Group" /></li>
				</ul>
			</form>
		</div>


		<div id="promote">
			<div class="toolbar">
				<h1>Promote</h1>
				<a class="button back" href="#">Back</a>
			</div>
		</div>
		

		<div id="about">
			<div class="toolbar">
				<h1>About</h1>
				<a class="button back" href="#">Back</a>
			</div>
			<div>
				<p class="info">Snack Tack lets you create and find food events on campus</p>
			</div>
		</div>
	</body>
</html>
