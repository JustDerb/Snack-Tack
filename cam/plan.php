<html>
	<head>
		<title>Snack Tack</title>
		<link rel="stylesheet" href="css/snacktack.css" type="text/css" media="screen" />
	</head>
	<body>
		<img src="img/snacktack.png" />
		<h1>Plan an Event</h1>
		<form method="post">
			<ul>
				<li>Basic Info</li>
				<li class="info"><input type="text" placeholder="Event Name" name="eventName" id="eventName" autocapitalizer="on" autocorrect="off" autocomplete="off"></li>
				<li class="info"><textarea placeholder="Event Description" name="eventName" id="eventName" rows="3" wrap="on"></textarea></li>
			</ul>
			
			<ul>
				<li>Food Options</li>
				<li class="info"><input type="checkbox" name="foodOptions" value="pizza" />Pizza</li>
				<li class="info"><input type="checkbox" name="foodOptions" value="ice cream" />Ice Cream</li>
				<li class="info"><input type="checkbox" name="foodOptions" value="root beer floats" />Root Bear Floats</li>
				<li class="info"><input type="checkbox" name="foodOptions" value="apparel" />Apparel</li>
				<li class="info"><input type="checkbox" name="foodOptions" value="other"/>Other</li>
			</ul>
			
			<ul>
				<li>Day</li>
				<li class="info">
					<select>
<?php 
	$days = array("Mon", "Tue", "Wed", "Thu", "Fri", "Sat", "Sun");
	foreach ($days as $day)
		echo "<option value=\"" . $day . "\">" . $day . "</option>";
?>
					</select>
					
					<select>
<?php 
	$months = array("Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec");
	foreach ($months as $month)
		echo "<option value=\"" . $month . "\">" . $month . "</option>";
?>
					</select>
					
					<select>
<?php
	for ($i = 1; $i < 32; $i++)
		echo "<option value=\"" . $i . "\">" . $i . "</option>";
?>
					</select>
					
					<select>
						<option value="2012">2012</option>
					</select>
				</li>
			</ul>
			
			<ul>
				<li>Time</li>
				<li class="info">
				
				</li>
			</ul>

	</body>
</html>
