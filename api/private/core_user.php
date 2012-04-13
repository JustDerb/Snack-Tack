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
require_once $dir.'/../fbsdk/facebook.php';
require_once $dir.'/../arrays.php';
require_once $dir.'/sql_functions.php';
//Registering awards
require_once $dir.'/core_awards.php';

function st_user_isRegistered($fbID)
{
	if (st_user_getData($fbID) == NULL)
		return false;
	else
		return true;
}

function st_user_isValidUser($st_user, $facebookObj)
{
	if (empty($st_user->array['fbID']))
		return new st_arr_message(1, "Invalid Facebook ID.");
		
	$networks = st_user_getNetworks($st_user->array['fbID'], $facebookObj);
	foreach ($networks as $network)
	{
		if ($network['type'] == 'college')
		{
			if ($network['nid'] == $st_user->array['Network'])
			{
				return new st_arr_message(0, $network['nid']);
			}
		}
	}
	
	return new st_arr_message(1, "Invalid Facebook network.", "profile?nonetwork=1");
}


function st_user_getData($fbID)
{
	global $st_sql;
	
	$fbID = mysql_real_escape_string($fbID,$st_sql);	
	
	//Check for record
	$query = "SELECT * FROM users WHERE fbID='$fbID'";
	$result = mysql_query($query, $st_sql);
	
	$user = new st_arr_user();
	$array = mysql_fetch_assoc($result);
	
	if (!$array)
	{
		return NULL;
	}
	else
	{
		$user->array['ID'] = $array['id'];
		$user->array['fbID'] = $array['fbid'];
		$user->array['Registered'] = $array['registered'];
		$user->array['Phone'] = $array['phone'];
		$user->array['Network'] = $array['networkid'];
		return $user;
	}
}

function st_user_setPhone($fbID, $number)
{
	global $st_sql;
	
	//Error checking
	if (!preg_match("/^\(?([0-9]{3})\)?[-. ]?([0-9]{3})[-. ]?([0-9]{4})$/i", $number))
		return new st_arr_message(1, "Invalid phone number.");
	$number = str_replace(array(' ','.','-','(',')'), "", $number);
	
	$fbID = mysql_real_escape_string($fbID,$st_sql);	
	$number = mysql_real_escape_string($number,$st_sql);
	
	//Update record
	$query = "UPDATE users SET phone='$number' WHERE fbid='$fbID'";
	$result = mysql_query($query, $st_sql);
	
	if (mysql_affected_rows($st_sql) == 0)
		return new st_arr_message(0, "");
	else
		return new st_arr_message(0, "Phone number updated.");
}

function st_user_setNetwork($fbID, $networkid)
{
	global $st_sql;
	
	$fbID = mysql_real_escape_string($fbID,$st_sql);	
	$networkid = mysql_real_escape_string($networkid,$st_sql);
	
	//Update record
	$query = "UPDATE users SET networkid='$networkid' WHERE fbid='$fbID'";
	$result = mysql_query($query, $st_sql);
	
	if (mysql_affected_rows($st_sql) == 0)
		return new st_arr_message(0, "");
	else
		return new st_arr_message(0, "Primary network updated.");
}

function st_user_getNetworks($fbID, $facebookObj)
{
	$fql = 'SELECT affiliations FROM user WHERE uid='.$fbID;
	$array = $facebookObj->api(array(
                       'method' => 'fql.query',
                       'query' => $fql,
                     ));
	return $array[0]['affiliations'];
}

function st_user_register($facebookProfile, $check = false)
{
	if (empty($facebookProfile['id']))
		return NULL;

	if ($check)
	{
		if (st_user_isRegistered($facebookProfile['id']))
			return st_user_getData($facebookProfile['id']);
	}
	
	global $st_sql;

	$fbID =             mysql_real_escape_string($facebookProfile['id'],$st_sql);
	$registerTimeDate = mysql_real_escape_string(st_DateTime_PHPtoMySQL(new DateTime()),$st_sql);
	$phone =            "";
	$networkID =        "";
	
	//Insert new record
	$query = "INSERT INTO users(fbID,registered,phone,networkid) VALUES ('$fbID','$registerTimeDate','$phone','$networkID')";// OUTPUT INSERTED.id AS 'newID' ";
	$result = mysql_query($query, $st_sql);
	
	$user = st_user_getData($facebookProfile['id']);
	
	//Give user award
	if (!st_award_registered($user->array['ID']))
		print mysql_error($st_sql); // TODO: REMOVE
				
	return $user;
}
?>