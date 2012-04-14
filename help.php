<?php
	require "includes/fb-login.php"; 
	require "api/snacktack.php";
?>
<html>
	<head>
<?php require "includes/head.php"; ?>
	</head>
	<body>
<?php include "includes/header.php"; ?>

		<h2>About</h2>
<?php
	$about_array = array(
		"What is this website about?" => "This website was created from a discussion that stemmed from the ISU Engineering Facebook group about how it was hard to find, and keep track of a lot of pizza sales on campus.",
		"Can I help you guys?" => "Sure! But the only way we need help right now is for you to plan, or promote events on your campus to get the word out!",
		"Where can I send suggestions?" => "We will have a form set up sometime in the near future. You can also leave comments on the ISU Engineering Facebook group page."
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
