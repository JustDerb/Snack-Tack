<?php require "includes/fb-login.php"; 
	  require '../api/snacktack.php'; ?>
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

		<ul id="todaysEvents">
			<li class="head">Today's Events</li>
			<?php
				$eventsToday = st_events_getEvents(1);
				foreach ($eventsToday as $event)
				{
					print('<li class="link">');
					print('<a href="#">');
					print('<b>'.$event->array['Name'].'</b>');
					print('</a></li>');
				}
			?>
		</ul>

		<div id="back" name="back" onclick="window.location.replace('index.php')">Back</div>
<?php include "includes/labelfix.php"; ?>
	</body>
</html>
