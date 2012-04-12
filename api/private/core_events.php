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

/*
Event Array
	"ID" => "-1",
	"NetworkID" => "-1",
	"creatorID" => "-1",
	"Name" => "",
	"Description" => "",
	"Type" => array(),
	"WhenStart" => new DateTime(),
	"WhenEnd" => new DateTime(),
	"Location" => "", //Will be location array
	"FacebookEvent" => "", 
	"Organization" => "" //Will be organization array
*/
    
//For individual page
function st_events_getEvent($eventID)
{
	$event = new st_arr_event();

	if(!is_numeric($eventID))
		return $event;
		
	global $st_sql;
	
	$eventID = mysql_real_escape_string($eventID,$st_sql);
	
	$query = "SELECT * FROM events e,eventstypes t WHERE id='$eventID' AND e.id=t.eventid";
	$result = mysql_query($query, $st_sql);	
	
	$eventCreated = false;
	while ($row = mysql_fetch_assoc($result)) {
		//Each row carries a different type
		array_push($alreadyAddedEvent->array['Type'], $row['typeid']);
		if (!$eventCreated)
		{
			$event->array['ID'] = $row['id'];
			$event->array['NetworkID'] = $row['networkid'];
			$event->array['creatorID'] = $row['owner'];
			$event->array['Name'] = $row['name'];
			$event->array['Description'] = $row['description'];
			$event->array['WhenStart'] = st_DateTime_MySQLtoPHP($row['dateStart']);
			$event->array['WhenEnd'] = st_DateTime_MySQLtoPHP($row['dateEnd']);
			$event->array['Location'] = $row['locationstr'];
			$event->array['FacebookEvent'] = $row['fbEvent'];
			$event->array['Organization'] = $row['organizationid'];
		    $eventCreated = true;
	    }
	}
	
	return $event;
}

//For users page
function st_events_getUsersEvents($internalID)
{
	$events = array();

	if(!is_numeric($internalID))
		return $event;
		
	global $st_sql;
	
	$internalID = mysql_real_escape_string($internalID,$st_sql);
	
	$query = "SELECT * FROM events e WHERE owner='$internalID'";
	$result = mysql_query($query, $st_sql);	

	while ($row = mysql_fetch_assoc($result)) {
		array_push($events, st_events_getEvent($row['id']));
	}
	
	return $event;

}

//For users page
function st_events_getUsersTacked($internalID)
{

}


function st_events_getEvents($daysAhead = 0, $sorting = "date")
{
	return st_events_lookupEvent("", $daysAhead, $sorting);
}


//For searchs
function st_events_lookupEvent($searchTerms, $daysAhead, $sorting = "date")
{
	$events = array();
	
	//if ($page < 0 || !is_numeric($page))
	//	$page = 0;
	//if (!is_numeric($numItems))
	//	$numitems = 10;
	//if ($numItems < 1)
	//	$numitems = 1;
	if ($daysAhead < 0 || !is_numeric($daysAhead))
		$daysAhead = 0;
		
	global $st_sql;
	
	$searchTerms = mysql_real_escape_string($searchTerms,$st_sql);
	$daysAhead = mysql_real_escape_string($daysAhead,$st_sql);
	
	//if ($sorting == "date")
		$sort = " ORDER BY e.dateStart ASC";
	
	//Check for record
	$query = "SELECT * FROM events e,eventstypes t WHERE ((name LIKE '%$searchTerms%')) AND e.id=t.eventid ";
	$query = $query." AND (e.dateStart < DATE_ADD(NOW(),INTERVAL ".$daysAhead." DAY) AND (e.dateEnd > NOW())) ";
	$query = $query.$sort;
	$result = mysql_query($query, $st_sql);
	//if (!$result)
	//	print($query);
	
	while ($row = mysql_fetch_assoc($result)) {
		$foundEvent = false;
		//For loop to add the types into array (NOTE: need to figure out if SQL can do this)
		foreach ($events as $alreadyAddedEvent)
		{
			if ($alreadyAddedEvent->array['ID'] == $row['id'])
			{
				$foundEvent = true;
				array_push($alreadyAddedEvent->array['Type'], $row['typeid']);
				break;
			}
		}
		if (!$foundEvent)
		{
			$event = new st_arr_event();	
			$event->array['ID'] = $row['id'];
			$event->array['NetworkID'] = $row['networkid'];
			$event->array['creatorID'] = $row['owner'];
			$event->array['Name'] = $row['name'];
			$event->array['Description'] = $row['description'];
			array_push($event->array['Type'], $row['typeid']);
			$event->array['WhenStart'] = st_DateTime_MySQLtoPHP($row['dateStart']);
			$event->array['WhenEnd'] = st_DateTime_MySQLtoPHP($row['dateEnd']);
			$event->array['Location'] = $row['locationstr'];
			$event->array['FacebookEvent'] = $row['fbEvent'];
			$event->array['Organization'] = $row['organizationid'];
		    array_push($events, $event);
	    }
	}
		
	return $events;
}

function st_events_createEvent($event_arr)
{
	if (get_class($event_arr) != 'st_arr_event')
	{
		return new st_arr_message(1, "[st_events_createEvent] $event_arr is not of type st_arr_message");
	}
	
	
	
	//Check for any errors
	if (!preg_match("/^[\d\w\s\$\.\,\(\)\-]{8,64}$/i", $event_arr->array['Name']))
		return new st_arr_message(1, "Name must be 8 to 64 characters long and include alpha-numberic, whitespace, or $.,()-");
	if (!$event_arr->array['WhenStart'])
		return new st_arr_message(1, "Invalid start date.");
	if (!$event_arr->array['WhenEnd'])
		return new st_arr_message(1, "Invalid start date.");
	if ($event_arr->array['WhenStart'] > $event_arr->array['WhenEnd'])
		return new st_arr_message(1, "Invalid date range. Start date is after it ends.");
	if (!preg_match("/^[\d\w\s\,\(\)\-]{4,64}$/i", $event_arr->array['Location']))
		return new st_arr_message(1, "Location must be 4 to 64 characters long and include alpha-numberic, whitespace, or ,()-");	
	if (count($event_arr->array['Type']) == 0)
		return new st_arr_message(1, "No event type specified.");
	
	if (!is_int($event_arr->array['Organization']))
	{
		$event_arr->array['Organization'] = -1;
	}
	
	
	global $st_sql;
	
	//Escape all our data
	$creator = mysql_real_escape_string($event_arr->array['creatorID'],$st_sql);
	$networkID = mysql_real_escape_string($event_arr->array['NetworkID'],$st_sql);	
	$name = mysql_real_escape_string($event_arr->array['Name'],$st_sql);	
	$description = mysql_real_escape_string($event_arr->array['Description'],$st_sql);	
	$start = mysql_real_escape_string(st_DateTime_PHPtoMySQL($event_arr->array['WhenStart']),$st_sql);	
	$end = mysql_real_escape_string(st_DateTime_PHPtoMySQL($event_arr->array['WhenEnd']),$st_sql);	
	$location = mysql_real_escape_string($event_arr->array['Location'],$st_sql);	
	$fburl = mysql_real_escape_string($event_arr->array['FacebookEvent'],$st_sql);	
	$orgID = mysql_real_escape_string($event_arr->array['Organization'],$st_sql);		
	
	//Check for record
	$query = <<<EOT
	INSERT INTO events 
	(owner,networkid,name,description,dateStart,dateEnd,locationstr,organizationid,fbEvent) 
	VALUES 
	('$creator','$networkID','$name','$description','$start','$end','$location','$orgID','$fburl')
EOT;
	$result = mysql_query($query, $st_sql);
	
	$eventidquery = <<<EOT
	SELECT id FROM events WHERE  
	owner='$creator' AND networkid='$networkID' AND name='$name' AND description='$description' AND dateStart='$start'
	AND dateEnd='$end' AND locationstr='$location' AND organizationid='$orgID' AND fbEvent='$fburl'
EOT;
	$resultid = mysql_query($eventidquery, $st_sql);
	$resultid_arr = mysql_fetch_array($resultid);
	$eventid = $resultid_arr['id'];
	
	$values = "";
	$types = $event_arr->array['Type'];
	foreach ($types as $type)
	{
		$typeid = $location = mysql_real_escape_string($type,$st_sql);
		$values = $values."('".$eventid."','".$typeid."'), ";
	}
	//Remove last to characters to make it valid SQL
	$values = substr($values, 0, -2);
	
	$query2 = <<<EOT
	INSERT INTO eventstypes 
	(eventid,typeid) 
	VALUES 
	$values
EOT;
	$result2 = mysql_query($query2, $st_sql);

	
	if ($result && $result2)
		return new st_arr_message(0, "Event: ".$event_arr->array['Name']." has been added.", "eventinfo.php?id=".$eventid."&created=1");	
	else
		return new st_arr_message(1, "MySQL Error: ".mysql_error($st_sql));	
}

//Implement last!
function st_events_deleteEvent()
{

}



?>