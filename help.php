<?php
	require "includes/fb-login.php"; 
	require "api/snacktack.php";
?>
<html>
	<head>
<?php require "includes/head.php"; ?>
<?php require "includes/analytics.php"; ?>
	</head>
	<body onload="setTimeout(function() { window.scrollTo(0, 1) }, 100);">
<?php include "includes/header.php"; ?>

		<h2>About</h2>
<?php
	$about_array = array(
		"What is this website about?" => "This website was created from a discussion that stemmed from the ISU Engineering Facebook group about how it was hard to find, and keep track of a lot of pizza sales on campus.",
		"Can I help you guys?" => "Sure! But the only way we need help right now is for you to plan, or promote events on your campus to get the word out!",
		"Where can I send suggestions?" => "We will have a form set up sometime in the near future. For now, please send an email to admin(at)snacktack.com."
		);

	foreach ($about_array as $question => $answer)
	{
		print('<ul class="info"><li>'.$question.'</li>');
		print('<li>'.$answer.'</li></ul>');
	}
?>
		
		<h2>Help</h2>
<?php
	$help_array = array(
		"What is 'Promote'?" => "This is where you can create an event that isn't actually your event.  This is used if you know that the event isn't in SnackTack, but you want people to know about it!  If the event owner finds this, than they can claim it as there own through a special process.",
		"How do I opt out of SMS alerts?" => "Visit the Profile page. Under the 'Phone' section, click 'Update Number'. Simply delete the number you have already and press 'Submit'. This will remove you from the text list so you do not receive them anymore.",
		"What if the event type that I want isn't there?" => "Select 'other' as the type and remeber to specify the goods being sold in the event description or name!"
		);

	foreach ($help_array as $question => $answer)
	{
		print('<ul class="info"><li>'.$question.'</li>');
		print('<li>'.$answer.'</li></ul>');
	}
?>

		<div id="back" name="back" onclick="window.history.back();">Back</div>
<?php include "includes/labelfix.php"; ?>
	</body>
</html>
