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