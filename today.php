<?php 
	require "includes/fb-login.php"; 
	require "api/snacktack.php";
	include "includes/displayEventAwardInfo.php";
?>
<html>
	<head>
<?php require "includes/head.php"; ?>
<?php require "includes/analytics.php"; ?>
	</head>
	<body onload="setTimeout(function() { window.scrollTo(0, 1) }, 100);">
<?php include "includes/header.php"; ?>

		<h2>Events</h2>
<?php
	$events = st_events_getEvents(1);
	
	if (empty($events))
		print('
			<ul class="info">
				<li>Today</li>
				<li>There are no events today!</li>');
	else
	{
		print('
			<ul class="link">
			<li>Today</li>
		');
		foreach ($events as $event)
		{
			$multipleTypes = false;
			$types = $event->array['Type'];
			if (count($types) > 1)
				$multipleTypes = true;
				
			$type = st_types_getType($types[0]);
			printEventAwardInfo($type->array['Icon'], $type->array['Name'], $event->array['Name'], $event->array['Description'], $event->array['WhenStart'], "eventinfo.php?id=" . $event->array['ID'], true, $multipleTypes);	
		}
	}
?>
		</ul>

		<div id="back" name="back" onclick="window.location.replace('index.php')">Back</div>
<?php include "includes/labelfix.php"; ?>
	</body>
</html>
