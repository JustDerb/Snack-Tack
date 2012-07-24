<?php require "../includes/fb-login.php"; 
	  require "../api/snacktack.php"; 
	  include_once "includes/displayEventAwardInfo.php";
	  //Grab our data before we include our form PHP code
	$st_user = st_user_register($user_profile, true);
	st_loginonly_check($st_user, $facebook, "profile.php?nologin=1&url=tacked.php");
?>
<html>
	<head>
<?php require "../includes/head.php"; ?>
<?php require "../includes/analytics.php"; ?>
	</head>
	<body onload="setTimeout(function() { window.scrollTo(0, 1) }, 100);">
<?php include "includes/header.php"; ?>

	<h2>Your Tacked Events</h2>
<?php 
	$eventIDs = st_tack_getTacked($st_user->array['ID']);
	if (empty($eventIDs))
		print('
			<ul class="info">
				<li>Tacked Events</li>
				<li>You don\'t have any tacked events... :(</li>');
	else
	{
		print('
			<ul class="link">
			<li>Tacked Events</li>
		');
		foreach ($eventIDs as $eventID)
		{
			$event = st_events_getEvent($eventID);
			
			$multipleTypes = false;
			$types = $event->array['Type'];
			if (count($types) > 1)
				$multipleTypes = true;
				
			$type = st_types_getType($types[0]);
			printEventAwardInfo('../'.$type->array['Icon'], $type->array['Name'], $event->array['Name'], $event->array['Description'], $event->array['WhenStart'], "eventinfo.php?id=" . $event->array['ID'], true, $multipleTypes);	
		}
	}
	print('</ul>');
?>


		<div id="back" name="back" onclick="window.history.back();">Back</div>	
<?php include "includes/labelfix.php"; ?>
	</body>
</html>
