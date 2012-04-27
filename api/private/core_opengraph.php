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

function st_opengraph_submitAction($facebook, $action, $object, $url)
{
	//if (!isArray($object))
	//	throw new Exception('st_opengraph_submitAction($action, $object) - $object needs to be an array.');
		
	try {
		// Proceed knowing you have a logged in user who's authenticated.
		//$param = $object;
		$param = array($object => $url);
		$fbresult = $facebook->api('/me/snacktack:'.$action,'POST',$param);
	} catch (Exception $e) {
		$fbresult = $e->getMessage();
	}
		
	return $fbresult;
}

?>