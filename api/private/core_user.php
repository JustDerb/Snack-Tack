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
	
	$fbID = mysql_real_escape_string($fbID,$st_sql);	
	$number = mysql_real_escape_string($number,$st_sql);
	
	//Update record
	$query = "UPDATE users SET phone='$number' WHERE fbid='$fbID'";
	$result = mysql_query($query, $st_sql);
	
	return $result;
}

function st_user_setNetwork($fbID, $networkid)
{
	global $st_sql;
	
	$fbID = mysql_real_escape_string($fbID,$st_sql);	
	$networkid = mysql_real_escape_string($networkid,$st_sql);
	
	//Update record
	$query = "UPDATE users SET networkid='$networkid' WHERE fbid='$fbID'";
	$result = mysql_query($query, $st_sql);
	
	return $result;
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