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


error_reporting(E_ALL ^ E_NOTICE);

/*
 * General utils
 */
function st_DateTime_PHPtoMySQL($phpdate)
{
    return $phpdate->format('Y-m-d H:i:s');
   //return date('Y-m-d H:i:s', $phpdate);
}

function st_DateTime_MySQLtoPHP($mysqldate)
{
   return new DateTime($mysqldate);
}
function st_DateTime_getDateTime($year, $month, $day, $hour, $minute, $am = true)
{
	if (!$am)
		$hour = $hour + 12;
	if ($hour >= 24)
		$hour = $hour - 24;
	return new DateTime($year.'-'.$month.'-'.$day.' '.$hour.':'.$minute.':00');
}
 
/*
 * Include library
 */
$dir = dirname(__FILE__);
include_once($dir.'/arrays.php');
include_once($dir.'/private/includes.php');

?>
