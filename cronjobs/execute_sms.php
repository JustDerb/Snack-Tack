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
	$query = $query."      u.id=t.userid AND e.id=t.eventid ";
	$query = $query."  AND t.userid=6 ";
	$query = $query."  AND TIME_TO_SEC(TIMEDIFF(e.dateStart,NOW())) >= 0 ";
	$query = $query."  AND TIME_TO_SEC(TIMEDIFF(e.dateStart,NOW())) < TIME_TO_SEC(TIME('00:15:00')) ";
	
	$result = mysql_query($query, $st_sql);	
	
	while ($row = mysql_fetch_assoc($result)) {
		$time = date('g:ia', strtotime($row['dateStart']));
		$gv->sms($row['phone'], 'Snack Tack: Event "'.$row['name'].'" is starting soon! ('.$time.' @ '.$row['locationstr'].')');
		print($gv->status);
		//if($gv->info['http_code'] != 200)
			//Error sending!
	}
}
else
{
	//Error authenticating!
}


?>