<?php 
	require "../includes/fb-login.php"; 
	require "../api/snacktack.php";
	include "includes/displayEventAwardInfo.php";
	
	if (array_key_exists('terms', $_GET))
	{
		$events = st_events_lookupEvent($_GET['terms'], 7, "date", $_GET['fo']);
	}
?>
<html>
	<head>
<?php require "../includes/head.php"; ?>
		<script type="text/javascript" src="../js/find.js"></script>
<?php require "../includes/analytics.php"; ?>
	</head>
	<body onload="setTimeout(function() { window.scrollTo(0, 1) }, 100);">
<?php include "includes/header.php"; ?>

<?php if (array_key_exists('terms', $_GET) && empty($events)): ?>
		<ul class="message">
			<li class="error">No events found. Try broadening your search criteria.</li>
		</ul>
<?php endif ?>

		<form method="get" id="findForm">
			<ul class="form">
				<li>Search Options</li>
				<li><input type="text" placeholder="Search Terms" name="terms" id="searchTerms" autocapitalizer="on" autocorrect="off" autocomplete="off" value="<?php if ($_GET['terms']) print($_GET['terms']); ?>"/>
			</ul>
			<ul class="form">
				<li>Food Options</li>
<?php
	$types = st_types_getList();
	foreach($types as $type)
	{
		print('<li><input type="checkbox" name="fo[]" id="'.$type->array['ID'].'" value="'.$type->array['ID'].'"');
		if ($_POST['fo'])
		{
    		$types = $_POST['fo'];
    		foreach ($types as $key => $value)
    		{
    			if ($value == $type->array['ID'])
    				print('checked');
    		}
		}
		print('><label for="'.$type->array['ID'].'">');
		printEventAwardInfo('../'.$type->array['Icon'], $type->array['Name'], $type->array['Name'], $type->array['Description'], $type->array['Category'], "", false,false,false);
		//print($type->array['Category'].' - '.$type->array['Name']);
		print('</label></li>');
	}
?>
				<!--
				<li><input type="radio" name="searchOption" value="byFoodType" id="byFoodType" checked /><label for="byFoodType">By Food Type</label></li>
				<li><input type="radio" name="searchOption" value="byOrganization" id="byOrganization" /><label for="byOrganization">By Organization</label></li>
				-->
			</ul>
		</form>

<?php if(array_key_exists('terms', $_GET) && !empty($events)): ?>
		<ul class="link" id="searchResults">
			<li>Search Results</li>
<?php
		foreach($events as $event)
		{
			$multipleTypes = false;
			$types = $event->array['Type'];
			if (count($types) > 1)
				$multipleTypes = true;
				
			$type = st_types_getType($types[0]);
			printEventAwardInfo('../'.$type->array['Icon'], $type->array['Name'], $event->array['Name'], $event->array['Description'], $event->array['WhenStart'], "eventinfo.php?id=" . $event->array['ID'], true, $multipleTypes);		
		}
?>
		</ul>
<?php endif ?>
		<div id="submit" name="submit" onclick="return validateForm();">Submit</div>
		<div id="back" name="back" onclick="window.location.replace('index.php');">Back</div>
<?php include "includes/labelfix.php"; ?>
	</body>
</html>

