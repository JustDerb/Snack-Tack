<?php require "includes/fb-login.php"; 
	  require '../api/snacktack.php'; ?>
<html>
	<head>
<?php require "includes/head.php"; ?>	
		<script type="text/javascript" src="js/plan.js"></script>
	</head>
	<body>
		<script type="text/javascript">// <![CDATA[ function BlockMove(event) { event.preventDefault(); } // ]]></script>
		<div id="header">
			<a href="index.php"><img src="img/logo_mini.png" id="logo" /></a>
<?php if ($user): ?>
			<a href="profile.php"><img src="https://graph.facebook.com/<?php echo $user; ?>/picture" alt="" id="fbPicture" /></a>
<?php endif ?>
		<div id="clear"></div>
		</div>
		
		<form id="eventForm" name="eventForm" method="post">
			<ul>
				<li>Basic Info</li>
				<li class="info"><input type="text" placeholder="Event Name" name="eventName" id="eventName" autocapitalizer="on" autocorrect="off" autocomplete="off" /></li>
				<li class="info"><textarea placeholder="Event Description" name="eventDescription" id="eventDescription" rows="3" wrap="on"></textarea></li>
			</ul>
			
			<ul>
				<li>Food Options</li>
				<li class="info"><input type="checkbox" name="foodOptions" id="pizza" value="pizza" /><label for="pizza">Pizza</label></li>
				<li class="info"><input type="checkbox" name="foodOptions" id="ice cream" value="ice cream" /><label for="ice cream">Ice Cream</label></li>
				<li class="info"><input type="checkbox" name="foodOptions" id="root beer floats" value="root beer floats" /><label for="root beer floats">Root Beer Floats</label></li>
				<li class="info"><input type="checkbox" name="foodOptions" id="apparel" value="apparel" /><label for="apparel">Apparel</label></li>
				<li class="info"><input type="checkbox" name="foodOptions" id="other" value="other"/><label for="other">Other</label></li>
			</ul>
			
			<ul>
				<li>Day</li>
				<li class="info">
					
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
					<label>Start&nbsp;&nbsp;</label>
					<select name="startHour">
<?php
	for ($i = 1; $i < 13; $i++)
		echo "<option value=\"" . $i . "\">" . $i . "</option>";
?>
					</select>
					:
					<select name="startMinute">
						<option>00</option>
						<option>10</option>
						<option>15</option>
						<option>30</option>
						<option>45</option>
						<option>50</option>
					</select>
					&nbsp;&nbsp;
					<select name="startAMPM">
						<option>AM</option>
						<option>PM</option>
					</select>
				</li>
				<li class="info">
					<label>End&nbsp;&nbsp;&nbsp;</label>
					<select name="startHour">
<?php
	for ($i = 1; $i < 13; $i++)
		echo "<option value=\"" . $i . "\">" . $i . "</option>";
?>
					</select>
					:
					<select name="startMinute">
						<option>00</option>
						<option>10</option>
						<option>15</option>
						<option>30</option>
						<option>45</option>
						<option>50</option>
					</select>
					&nbsp;&nbsp;
					<select name="startAMPM">
						<option>AM</option>
						<option>PM</option>
					</select>					
				</li>
			</ul>

			<ul>
				<li>Place</li>
				<li class="info"><input type="text" placeholder="Event Location" name="location" id="location" autocapitalizer="on" autocorrect="off" autocomplete="off" /></li>
			</ul>

			<ul>
				<li>Facebook Event URL</li>
				<li class="info"><input type="text" placeholder="(Optional)" name="fburl" id="fburl" autocapitalizer="off" autocorrect="off" autocomplete="off" /></li>
			</ul>

			<ul>
				<li>Organization</li>
				<li class="info"><input type="text" placeholder="Name of Organization" name="organization" id="organization" autocapitalizer="on" autocorrect="off" autocomplete="off" /></li>
			</ul>
			
			<div id="submit" name="submit" onclick="return validateForm()">Submit</div>
			<div id="cancel" name="cancel" onclick="window.location.replace('index.php')">Cancel</div>
		</form>
<?php include "includes/labelfix.php"; ?>
	</body>
</html>
