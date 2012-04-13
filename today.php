<?php require "includes/fb-login.php"; 
	  require "api/snacktack.php"; ?>
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
			$types = $event->array['Type'];
			$type = st_types_getType($types[0]);
			print('
				<li><div class="table"><a href="eventinfo.php?id=' . $event->array["ID"] . '">
					<table>
						<tr>
							<td rowspan="4" valign="top" width="50"><img src="' . $type->array['Icon'] . '" alt="' . $type->array['Name'] . '" /></td>
						</tr>
						<tr>
							<td><div class="name">' . $event->array["Name"] . '</div></td>
						</tr>
						<tr>
							<td><div class="time">@ ' . $event->array["WhenStart"]->format("h:ia") . '</div></td>
						</tr>
						<tr>
							<td><div class="description">' . $event->array["Description"] . '</div></td>
						</tr>
					</table>
				</a></div></li>');
		}
	}
?>
		</ul>

		<div id="back" name="back" onclick="window.location.replace('index.php')">Back</div>
<?php include "includes/labelfix.php"; ?>
	</body>
</html>
