<?php
	if (!$_GET['d'])
		header('Location: http://m.snacktack.com');

	require "includes/fb-login.php"; 
	require "api/snacktack.php";
?>
<html>
	<head>
		<title>Snack Tack</title>
		<link rel="stylesheet" href="css/reset.css" type="text/css" />
		<link rel="stylesheet" href="css/desktop.css" type="text/css" media="screen" />
		<link rel="icon" type="image/png" href="img/icon.ico">
		<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.3.2/jquery.min.js"></script>
		<meta property="og:site_name" content="Snack Tack" >
<?php require "includes/analytics.php"; ?>
	</head>
	<body>
		<div class="bar bar-top">
			<div class="wndcontent">
				<div class="logo"><a href="index.php"><img src="img/logo_mini.png" id="logo" /></a></div>
				<span class="tabprofile"><a href="#">Profile</a></span>
				<form class="search">
					<input type="text" name="s" />
				</form>
			</div>
			<div class="clear"></div>
		</div>
		<div class="wndcontent">
			<div class="mainContent">
				<div id="contentwrapper">
					<div id="contentcolumn">
						<div class="innertube">
							<div class="window">
								<div class="fill-width border-bottom text-large bold">
									<div class="innertube">Upcoming Events</div>
								</div> 
								<ul class="ul-event">
									<li>
										<table class="table-event fill-width">
											<tr>
												<td rowspan="3">
													ICON
												</td>
												<td>
													<span class="text-main bold">EVENT NAME</span>
													<span class="text-detail">(Location)</span>
													<span class="text-detail right">Time</span>
												</td>
											</tr>
											<tr>
												<td class="text-main">
													EVENT DESCRIPTION
												</td>
											</tr>
											<tr>												
												<td class="text-detail">
													<a href="#">Expand</a>
												</td>
											</tr>
										</table>
									</li>
									<li>
										<table class="table-event fill-width">
											<tr>
												<td rowspan="3">
													ICON
												</td>
												<td>
													<span class="text-main bold">EVENT NAME</span>
													<span class="text-detail">(Location)</span>
													<span class="text-detail right">Time</span>
												</td>
											</tr>
											<tr>
												<td class="text-main">
													EVENT DESCRIPTION
												</td>
											</tr>
											<tr>												
												<td class="text-detail">
													<a href="#">Expand</a>
												</td>
											</tr>
										</table>
									</li>
								</ul>
								<div class="innertube">
									<a class="button text-main fill-auto no-underline" href="#">
										See More Events
									</a>
								</div>
							</div>						
						</div>
					</div>
				</div>
				<div id="leftcolumn">
					<div class="innertube">
						<div class="window">
							<div class="border-bottom" style="width:100%">
								<div class="innertube">
									<div class="left">
										ICON
									</div>
									<div class="left">
										<div class="text-main">Justin 'Pepper' Derby</div>
										<div class="text-detail"><a href="#">View my profile page</a></div>
									</div>
									<div class="clear"></div>
								</div>
							</div>
							<div class="border-bottom fill-width">
								<div class="border-right left">
									<div class="innertube">
										<div class="text-main">ICON</div>
										<div class="text-detail">SMS Enabled</div>
									</div>
								</div> 
								<div class="border-right left">
									<div class="innertube">
										<div class="text-main">2 Upcoming</div>
										<div class="text-detail">Tacked Events</div>
									</div>
								</div> 
								<div class="left">
									<div class="innertube">
										<div class="text-main">3</div>
										<div class="text-detail">Awards</div>
									</div>
								</div> 
								<div class="clear"></div>
							</div>
							<div class="fill-width">
								<div class="innertube">
									<ul class="ul-buttons">
										<li><a class="button text-main no-underline" href="#">Plan</a></li>
										<li><a class="button text-main no-underline" href="#">Promote</a></li>
									</ul>
									<div class="clear"></div>
								</div>
							</div>
						</div>
						<div class="window">
							<div class="innertube">
								<form>
									<fieldset>
										<input name="eventName" placeholder="Event Name..." />
										<input name="eventDesc" placeholder="Event Description..." />
									</fieldset>
									<fieldset>
										<input name="eventName" placeholder="Day, Time, Duration..." />
										<input name="eventLoc" placeholder="Location..." />
										<input name="eventURl" placeholder="Event URL..." />
									</fieldset>
								</form>
							</div>
						</div>
						<div class="window">
							<div class="innertube text-detail center">
								<a href="#">About</a> <a href="#">Help</a> <a href="#">Legal</a>
								<br />
								© 2012 Snack Tack
							</div>
						</div>
					</div>
				</div>
				<div class="clear"></div>
			</div>
		</div>
		<div class="bar bar-bottom">
			<div class="wndcontent">
				<div class="logo"><a href="index.php"><img src="img/logo_mini.png" id="logo" /></a></div>
			</div>
			<div class="clear"></div>
		</div>
</body>
</html>
