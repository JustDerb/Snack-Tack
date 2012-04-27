<?php
/**
 * Copyright 2012 Justin Derby
 *
 * Licensed under the Apache License, Version 2.0 (the "License"); you may
 * not use this file except in compliance with the License. You may obtain
 * a copy of the License at
 *
 *     http://www.apache.org/licenses/LICENSE-2.0
 *
 * Unless required by applicable law or agreed to in writing, software
 * distributed under the License is distributed on an "AS IS" BASIS, WITHOUT
 * WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied. See the
 * License for the specific language governing permissions and limitations
 * under the License.
 */
 
 
$dir = dirname(__FILE__);
require_once $dir.'/../arrays.php';
require_once $dir.'/sql_functions.php';


function st_tack_isTacked($eventID, $userID)
{
	global $st_sql;
		
	$userID = mysql_real_escape_string($userID,$st_sql);	
	$eventID = mysql_real_escape_string($eventID,$st_sql);
	
	//Check for record
	$query = "SELECT * FROM tacked WHERE eventID='$eventID' AND userID='$userID'";
	$result = mysql_query($query, $st_sql);
	
	$num = mysql_num_rows($result);

	return ($num >= 1);
}

function st_tack_setTacked($eventID, $userID, $tacked = true)
{
	global $st_sql;
	
	$userID = mysql_real_escape_string($userID,$st_sql);	
	$eventID = mysql_real_escape_string($eventID,$st_sql);
	
	//Set tacked
	if ($tacked)
		$query = "INSERT INTO tacked (eventid, userid, delay) VALUES ('$eventID', '$userID', '15')";
	else
		$query = "DELETE FROM tacked WHERE eventID='$eventID' AND userID='$userID'";
	
	$result = mysql_query($query, $st_sql);
	
	return mysql_affected_rows($st_sql) == 1;
}

function st_tack_getTacked($userID)
{
	global $st_sql;
	
	$events = array();		
	$userID = mysql_real_escape_string($userID,$st_sql);	
	
	//Check for record
	$query =        "SELECT t.eventid FROM tacked t,events e WHERE ";
	$query = $query."     t.userID='$userID' ";
	$query = $query." AND e.id=t.eventid ";
	$query = $query." AND (e.dateStart > NOW()) "; //Already passed?
	$query = $query." ORDER BY e.dateStart ASC";
	$result = mysql_query($query, $st_sql);
	
	while ($row = mysql_fetch_assoc($result)) {
		$events[] = $row['eventid'];
	}
	
	return $events;
}

?>