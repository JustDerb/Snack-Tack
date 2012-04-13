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


function st_types_getList()
{
	global $st_sql;
	
	$types = array();
	
	//Check for record
	$query = "SELECT t.id,c.id AS 'categoryid',c.name AS 'category',c.description AS 'categorydesc',t.name,t.description FROM `category` c, `types` t WHERE c.id=t.category ORDER BY c.id ASC";
	$result = mysql_query($query, $st_sql);
	
	while ($row = mysql_fetch_assoc($result)) {
		$type = new st_arr_types();
		$type->array['ID'] = $row['id'];
		$type->array['Name'] = $row['name'];
		$type->array['Description'] = $row['description'];
		$type->array['CategoryID'] = $row['categoryid'];
		$type->array['Category'] = $row['category'];
		$type->array['CategoryDescription'] = $row['categorydesc'];
		$type->array['Icon'] = $row['icon'];
	    array_push($types, $type);
	}
	
	return $types;
}

function st_types_getType($typeid)
{
	$type = new st_arr_types();
	
	global $st_sql;
	
	$typeid = st_mysql_encode($typeid,$st_sql);
		
	//Check for record
	$query = "SELECT t.id,t.icon,c.id AS 'categoryid',c.name AS 'category',c.description AS 'categorydesc',t.name,t.description FROM `category` c, `types` t WHERE c.id=t.category AND t.id='$typeid'";
	$result = mysql_query($query, $st_sql);
	
	$row = mysql_fetch_assoc($result);
	$type->array['ID'] = $row['id'];
	$type->array['Name'] = $row['name'];
	$type->array['Description'] = $row['description'];
	$type->array['CategoryID'] = $row['categoryid'];
	$type->array['Category'] = $row['category'];
	$type->array['CategoryDescription'] = $row['categorydesc'];
	$type->array['Icon'] = $row['icon'];
	
	return $type;
}

function st_types_search($name)
{

}

function st_types_addType($types_arr)
{
	//Admin only (Implement last)
}

function st_types_deleteTypes($typeID)
{
	//Admin only (Implement last)
}


?>