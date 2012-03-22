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

require_once('api/private/pass/sql.php');

/**
 * Object to do SQL operations on:
 *   
 *     $st_sql 
 *
 */
 


class st_mysql
{
    public $link;
    
	public function __construct()
	{
	    //@$mysqli = new mysqli($db_host, $db_user, $db_pass, $db_name);

		//if (mysqli_connect_errno()) {
		//	die('<h1>Could not connect to the database</h1><h2>Please try again after a few moments.</h2>');
		//}
		
		//$mysqli->set_charset("utf8");

		//Connect to our MySQL service
		global $db_host;
		global $db_user;
		global $db_pass;
		global $db_name;
		$this->link = mysql_connect($db_host, $db_user, $db_pass) 
			or die('<h1>Could not connect to the database</h1><h2>Please try again after a few moments.</h2>');	
		//Select our database
		mysql_select_db($db_name, $this->link);
	}
	
	public function __destruct() {
		//Object being deleted.  Free up any resources we need.       
		mysql_close($this->link);
    }
} 

//Different variable to keep it in scopt so it doesn't get destroyed early
$st_sql_d = new st_mysql(); 
//Simplify the resources connection
$st_sql = $st_sql_d->link;


/*
$st_sql = mysql_connect($db_host, $db_user, $db_pass) 
	or die('<h1>Could not connect to the database</h1><h2>Please try again after a few moments.</h2>');	
//Select our database
mysql_select_db($db_name, $st_sql);
*/
?>