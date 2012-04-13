<?php require "includes/fb-login.php"; 
	  require "api/snacktack.php"; 
	  
	$event = NULL;
	if ($_GET['id'])
	{
		$event = st_events_getEvent($_GET['id']);
		
		if ($event->array['ID'] < 0)
			$event = NULL;
	}
?>
<html>
	<head>
<?php require "includes/head.php"; ?>
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
		print(
			'<li><div class="award">
				<table>
					<tr>
						<td rowspan="4" valign="top" width="50"><img src="' . $type->array['Icon'] . '" alt="' . $type->array['Name'] . '" /></td>
					</tr>
					<tr>
						<td><div class="name">' . $type->array['Name'] . '</div></td>
					</tr>
					<tr>
						<td><div class="description">' . $type->array['Description'] . '</div></td>
					</tr>
					<tr>
						<td><div class="time">' . $type->array['Category'] . '</div></td>
					</tr>
				</table>
			</div></li>');
		//print('<li>'.($type->array['Name']).' ('.$type->array['Description'].')</li>');
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
