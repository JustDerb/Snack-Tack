<?php
	require "includes/fb-login.php"; 
	require "api/snacktack.php";
	include "includes/displayEventAwardInfo.php";
	  
	$event = NULL;
	if ($_GET['id'])
	{
		$event = st_events_getEvent($_GET['id']);
		
		if ($event->array['ID'] < 0)
			$event = NULL;
	}
	
	$st_user = st_user_register($user_profile, true);
	
	//Show any messages we need
	$msg = array('error' => array(), 'message' => array(), 'success' => array());
	if (array_key_exists('msg', $_GET))
	{
		if (array_key_exists('type', $_GET))
		{
			if (strcasecmp($_GET['type'], "error") == 0)
				$msg['error'][] = htmlentities($_GET['msg']);
			else if (strcasecmp($_GET['type'], "success") == 0)
				$msg['success'][] = htmlentities($_GET['msg']);
			else 
				$msg['message'][] = htmlentities($_GET['msg']);
		}
		else
			$msg['message'][] = htmlentities($_GET['msg']);
	}
?>
<html>
	<head>
<?php require "includes/head.php"; ?>
<?php require "includes/analytics.php"; ?>
	</head>
	<body onload="setTimeout(function() { window.scrollTo(0, 1) }, 100);">
<?php include "includes/header.php"; ?>

<?php if ($msg): ?>
		<ul class="message">
			<?php
				if (is_array($msg['error']))
				{
					foreach ($msg['error'] as $message)
					{
						print('<li class="error">'.$message.'</li>');
					}
				}
				if (is_array($msg['success']))
				{
					foreach ($msg['success'] as $message)
					{
						print('<li class="success">'.$message.'</li>');
					}
				}
				if (is_array($msg['message']))
				{
					foreach ($msg['message'] as $message)
					{
						print('<li class="message">'.$message.'</li>');
					}
				}
			?>
		</ul>
<?php endif ?>

		<h2>Event Information</h2>
<?php if ($event): ?>
		<ul class="info">
			<li class="head">Basic Info</li>
			<li><?php print($event->array['Name']); ?></li>
			<li><?php print($event->array['Description']); ?></li>
		</ul>

		<ul class="info">
			<li class="head">What's being sold</li>
<?php 
			//foreach all food options - don't include "Food - " part 
	$types = $event->array['Type'];
	foreach ($types as $typeid)
	{
		$type = st_types_getType($typeid);
		printEventAwardInfo($type->array['Icon'], $type->array['Name'], $type->array['Name'], $type->array['Description'], $type->array['Category'], "", false);
	}
?>
		</ul>

		<ul class="info">
			<li class="head">Day and Time</li>
<?php
	print('<li>'.($event->array["WhenStart"]->format("l, F j Y")).'</li>');
	print('<li><strong>Start</strong> @ '.($event->array['WhenStart']->format('g:ia')));
	print(' | <strong>End</strong> @ '.($event->array['WhenEnd']->format('g:ia')).'</li>');
?>
		</ul>
		
		<ul class="info">
			<li class="head">Location</li>
			<li><?php print($event->array['Location']); ?></li>
		</ul>

<!--
		<ul class="info">
			<li class="head">Organization</li>
			<li>Not done!</li>
		</ul>
-->
<?php if (!empty($event->array['FacebookEvent'])): ?>
		<ul class="info">
			<li class="head">Facebook Event URL</li>
			<li><a href="<?php print($event->array['FacebookEvent']); ?>">To the Facebook!</a></li>
		</ul>
<?php endif ?>		

<?php if ($st_user): ?>
<?php
	if(st_tack_isTacked($event->array['ID'], $st_user->array['ID']) == true)
		$tack = "Untack";
	else
		$tack = "Tack";
?>

		<ul class="link">
			<li><?php print($tack); ?></li>
			<li><a href="tackevent.php?id=<?php print($_GET['id']); ?>"><img src="img/types/default.png" alt="Tack" /><strong><?php print($tack); ?></strong> this event</a></li>
		</ul>
<?php endif ?>	

<?php else: ?>
		<ul class="info">
			<li class="head">Uh-Oh!</li>
			<li>This is an invalid event or it has been deleted!</li>
		</ul>
<?php endif ?>
		
<?php if (isset($_GET['created'])): ?>
		<div id="back" name="back" onclick="window.location.replace('index.php')">Home</div>
<?php else: ?>
		<div id="back" name="back" onclick="window.history.back();">Back</div>		
<?php endif ?>
		
<?php include "includes/labelfix.php"; ?>
	</body>
</html>
