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


function st_award_give($internalID, $awardID)
{
	if ($internalID < 0)
		return false;
		
	global $st_sql;
	
	$internalID = mysql_real_escape_string($internalID,$st_sql);
	$awardID =    mysql_real_escape_string($awardID,$st_sql);		
	
	//Check for record
	$query = "INSERT INTO userawards(user,awardid,received) VALUES ('$internalID','$awardID',NOW())";
	$result = mysql_query($query, $st_sql);
		
	return $result;
}

// TODO: NOT DONE!
function st_award_getAll($internalID)
{
	$awards = array();
	
	if ($internalID < 0)
		return $awards;
		
	global $st_sql;
	
	$internalID = mysql_real_escape_string($internalID,$st_sql);	
	
	//Check for record
	$query = "SELECT * FROM userawards u,awards a WHERE user='$internalID' and u.awardid=a.id ORDER BY u.received DESC";
	$result = mysql_query($query, $st_sql);
	
	while ($row = mysql_fetch_assoc($result)) {
		$award = new st_arr_award();
		$award->array['ID'] = $row['awardid'];
		$award->array['Name'] = $row['name'];
		$award->array['Description'] = $row['description'];
		$award->array['Icon'] = $row['icon'];
		$award->array['Received'] = st_DateTime_MySQLtoPHP($row['received']);
	    array_push($awards, $award);
	}
		
	return $awards;
}


/****************************************************************************
 *  INDIVIDUAL AWARD FUNCTIONS                                              *
 ****************************************************************************/

/**
 * User has registered with Snack Tack
 */
function st_award_registered($internalID)
{
	return st_award_give($internalID, 1);
}



?>