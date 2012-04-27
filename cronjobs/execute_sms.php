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
	//SELECT e.name,e.description,e.dateStart,e.dateEnd,t.userid,t.eventid FROM tacked t,users u,events e WHERE u.id=t.userid AND e.id=t.eventid AND t.userid=6
	$gv->sms('PHONE', 'MESSAGE HERE');
	//if ($gv->info['http_code'] != 200)
		//Error sending!
}
else
{
	//Error authenticating!
}


?>