<?php require "includes/fb-login.php"; 
	  require "../api/snacktack.php"; ?>
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
		<ul>
			<li class="head">Today</li>
<?php
	$events = st_events_getEvents(1);
	
	if (empty($events))
		print('<li class="empty">There are no events today!</li>');
	else
		foreach ($events as $event)
		{
			print('<li class="link"><a href="#"><strong>' . $event->array['Name'] . '</strong></a></li>');
		}
?>
		</ul>

		<div id="back" name="back" onclick="window.location.replace('index.php')">Back</div>
<?php include "includes/labelfix.php"; ?>
	</body>
</html>
