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


//For individual page
function st_events_getEvent($eventID)
{

}

//For users page
function st_events_getUsersEvents($internalID)
{

}

//For users page
function st_events_getUsersTacked($internalID)
{

}


function st_events_getEvents($page, $numItems, $sorting = "date")
{
	return st_events_lookupEvent("", $page, $numItems, $sorting);
}


//For searchs
function st_events_lookupEvent($searchTerms, $page, $numItems, $sorting = "date")
{
	$events = array();
	
	if ($days >= 0)
	{
	
	}
	
	return $events;
}

function st_events_createEvent($event_arr)
{
	if (get_class($event_arr) != 'st_arr_event')
	{
		return new st_arr_message(1, "[st_events_createEvent] $event_arr is not of type st_arr_message");
	}
	
	/*
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
    		"Organization" => "" //Will 
    	*/
	
	//Check for any errors
	if (!preg_match("/^[\d\w\s\$\.]{8,64}$/i", $event_arr->array['Name']))
		return new st_arr_message(1, "Name must be 8 to 64 characters long and include alpha-numberic, whitespace, or $ or .");
	if (!$event_arr->array['WhenStart'])
		return new st_arr_message(1, "Invalid start date.");
	if (!$event_arr->array['WhenEnd'])
		return new st_arr_message(1, "Invalid start date.");
	if (!preg_match("/^[\d\w\s\,\(\)\-]{4,64}$/i", $event_arr->array['Location']))
		return new st_arr_message(1, "Location must be 4 to 64 characters long and include alpha-numberic, whitespace, or ,()-");	
	
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
	
	if ($result)
		return new st_arr_message(0, "Event: ".$event_arr->array['Name']." has been added.");	
	else
		return new st_arr_message(1, "MySQL Error: ".mysql_error($st_sql));	
}

//Implement last!
function st_events_deleteEvent()
{

}



?>