<?php
	require "includes/fb-login.php"; 
	require "api/snacktack.php";
	  
	//Grab our data before we include our form PHP code
	$st_user = st_user_register($user_profile, true);
	st_loginonly_check($st_user, $facebook, "profile.php?nologin=1&url=".urlencode("eventinfo.php?id=".$_GET['id']));

	$event = NULL;
	if ($_GET['id'])
	{
		$event = st_events_getEvent($_GET['id']);
		
		if ($event->array['ID'] < 0)
			$event = NULL;
	}
	
	if (!$event)
		header("Location: eventinfo.php?id=".$_GET['id']."&msg=".urlencode("That is an invalid event.")."&type=error");
	
	$isTacked = st_tack_isTacked($event->array['ID'], $st_user->array['ID']);

	//If it is, take it out
	if ($isTacked)
	{
		if (st_tack_setTacked($event->array['ID'], $st_user->array['ID'], false))
			header("Location: eventinfo.php?id=".$_GET['id']."&msg=".urlencode("You have un-tacked this event.")."&type=success");
		else
			header("Location: eventinfo.php?id=".$_GET['id']."&msg=".urlencode("Unknown error. Try again. (STack01)")."&type=error");
	}
	//If not, put it in there
	else
	{
		if (st_tack_setTacked($event->array['ID'], $st_user->array['ID'], true))
			header("Location: eventinfo.php?id=".$_GET['id']."&msg=".urlencode("You have tacked this event.")."&type=success");
		else
			header("Location: eventinfo.php?id=".$_GET['id']."&msg=".urlencode("Unknown error. Try again. (STack02)")."&type=error");		
	}
?>