<html>
	<head>
		<title>Snack Tack</title>
		<link rel="stylesheet" href="css/snacktack.css" type="text/css" media="screen" />
		<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.3.2/jquery.min.js"></script>
		<script type="text/javascript" src="js/plan.js"></script>
		<meta name="viewport" content="user-scalable=no, width=device-width, initial-scale=1, maximum-scale=1" />
		<meta name="apple-mobile-web-app-capable" content="yes" />		
	</head>
	<body>
		<img src="img/snacktack.png" />
		<h1>Plan an Event!</h1>
		<form id="eventForm" name="eventForm" method="post">
			<ul>
				<li>Basic Info</li>
				<li class="info"><input type="text" placeholder="Event Name" name="eventName" id="eventName" autocapitalizer="on" autocorrect="off" autocomplete="off" /></li>
				<li class="info"><textarea placeholder="Event Description" name="eventDescription" id="eventDescription" rows="3" wrap="on"></textarea></li>
			</ul>
			
			<ul>
				<li>Food Options</li>
				<li class="info"><input type="checkbox" name="foodOptions" value="pizza" />Pizza</li>
				<li class="info"><input type="checkbox" name="foodOptions" value="ice cream" />Ice Cream</li>
				<li class="info"><input type="checkbox" name="foodOptions" value="root beer floats" />Root Beer Floats</li>
				<li class="info"><input type="checkbox" name="foodOptions" value="apparel" />Apparel</li>
				<li class="info"><input type="checkbox" name="foodOptions" value="other"/>Other</li>
			</ul>
			
			<ul>
				<li>Day</li>
				<li class="info">
					<select name="day">
<?php 
	$days = array("Sun", "Mon", "Tue", "Wed", "Thu", "Fri", "Sat");
	foreach ($days as $day)
		echo "<option value=\"" . $day . "\">" . $day . "</option>";
?>
					</select>
					
					<select name="month">
<?php 
	$months = array("Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec");
	foreach ($months as $month)
		echo "<option value=\"" . $month . "\">" . $month . "</option>";
?>
					</select>
					
					<select name="date">
<?php
	for ($i = 1; $i < 32; $i++)
		echo "<option value=\"" . $i . "\">" . $i . "</option>";
?>
					</select>
					
					<select name="year">
						<option value="2012">2012</option>
					</select>
				</li>
			</ul>
			
			<ul>
				<li>Time</li>
				<li class="info">
				
				</li>
			</ul>
			
			<div id="submit" name="submit" onclick="return validateForm()">Submit</div>
			<div id="cancel" name="cancel" onclick="window.location.replace('index.php')">Cancel</div>
	</body>
</html>
