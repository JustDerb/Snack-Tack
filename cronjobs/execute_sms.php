<?php
//Scan for SQL entries, than send message.
//
//http://stackoverflow.com/questions/9160710/sending-sms-using-cron-job-and-php
//
//Scan SQL database table (named 'smstacks'?) and send any that are within 15 minutes of an event.  
// Delete them from the table.  If there are any that are WAY before the current time, just delete them.  
// Do not send a text.
//
require_once '../api/private/sql_functions.php';
require_once '../api/google/googlevoice.php';

//Get our records
$gv = new GoogleVoice($googlevoice_email, $googlevoice_password);
if ($token->array['Error'] == 0)
{
	$query =        "SELECT "; 
	$query = $query."      e.name,e.description,e.dateStart,e.dateEnd,t.userid,t.eventid,u.phone,e.locationstr ";
	$query = $query." FROM ";
	$query = $query."      tacked t,users u,events e ";
	$query = $query." WHERE ";
	$query = $query."      u.id=t.userid AND e.id=t.eventid "; //Throw away some rows we do not want
	//$query = $query."  AND t.userid=6 "; //For testing
	$query = $query."  AND TIME_TO_SEC(TIMEDIFF(e.dateStart,NOW())) >= 0 "; //Hasn't already past
	$query = $query."  AND TIME_TO_SEC(TIMEDIFF(e.dateStart,NOW())) < TIME_TO_SEC(TIME('00:31:00')) "; //Within 31 minutes
	$query = $query."  AND t.sent=0 "; //Don't send it again
	
	$result = mysql_query($query, $st_sql);	
	
	while ($row = mysql_fetch_assoc($result)) {
		$time = date('g:ia', strtotime($row['dateStart']));
		//Make sure we have a valid phone number!
		if (preg_match("/^\(?([0-9]{3})\)?[-. ]?([0-9]{3})[-. ]?([0-9]{4})$/i", $row['phone']))
			$gv->sms($row['phone'], 'Snack Tack: Event "'.$row['name'].'" is starting soon! ('.$time.' @ '.$row['locationstr'].')');
		
		$updateq = "UPDATE tacked SET sent=1 WHERE userid='".$row['userid']."' AND eventid='".$row['eventid']."'";
		mysql_query($updateq, $st_sql);	
		//print($gv->status);
		//if($gv->info['http_code'] != 200)
			//Error sending!
	}
}
else
{
	//Error authenticating!
}


?>