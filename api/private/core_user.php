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

function st_user_isRegistered($fbID)
{
	global $st_sql;
	
	$fbID = mysql_real_escape_string($fbID,$st_sql);	
	
	//Check for record
	$query = "SELECT * FROM users WHERE fbID='$fbID'";
	$result = mysql_query($query, $st_sql);
	
	$rows = mysql_num_rows($result);
	if ($rows < 1)
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
		return $user;
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

// TODO: NOT DONE!
function st_user_setPhone($fbID, $number)
{
	global $st_sql;
	
	$fbID = mysql_real_escape_string($fbID,$st_sql);	
	$number = mysql_real_escape_string($number,$st_sql);
	
	//Update record
	$query = "UPDATE users SET 'phone'='$number' WHERE 'fbID'='$fbID'";
	$result = mysql_query($query, $st_sql);
}

// TODO: NOT DONE!
function st_user_setNetwork($fbID, $network)
{
	global $st_sql;
	
	$fbID = mysql_real_escape_string($fbID,$st_sql);	
	$network = mysql_real_escape_string($network,$st_sql);
	
	//Update record
	$query = "UPDATE users SET 'networkid'='$network' WHERE 'fbID'='$fbID'";
	$result = mysql_query($query, $st_sql);
}



function st_user_register($facebookProfile, $check = false)
{
	if ($check)
	{
		if (st_user_isRegistered($fbID))
			return st_user_getData($fbID);
	}
	
	global $st_sql;

    $user = new st_arr_user();
	$user->array['fbID'] = $facebookProfile['id'];
	$user->array['Registered'] = new DateTime(); //Now
	
	$fbID =             mysql_real_escape_string($user->array['fbID'],$st_sql);
	$registerTimeDate = mysql_real_escape_string(st_DateTime_PHPtoMySQL($user->array['Registered']),$st_sql);
	$phone =            mysql_real_escape_string($user->array['Phone'],$st_sql);
	$networkID =        mysql_real_escape_string($user->array['Network'],$st_sql);
	
	//Insert new record
	$query = "INSERT INTO users(fbID,registered,phone,networkid) VALUES ('$fbID','$registerTimeDate','$phone','$networkID')";// OUTPUT INSERTED.id AS 'newID' ";
	$result = mysql_query($query, $st_sql);
		
	return $user;
}
?>