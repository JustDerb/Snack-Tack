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

//require_once "file.php";

/**
 * Abstract array object that gives common functions for the array
 */
class st_a_array {
	public $array;
	
	public function __construct()
	{
		//Construct a blank array, just in case
		$this->array = array();
	}
	
	public function __destruct() {
		//Object being deleted.  Free up any resources we need.        
    }
}



/**
	
**/
class st_arr_event extends st_a_array {
	public function __construct() 
	{
       parent::__construct();
       //Construct our array
       $this->initArray();
    }
    
    private function initArray()
    {
    	$this->array = array(
    		"ID" => "",
    		"creatorID" => "",
    		"Name" => "",
    		"Description" => "",
    		"Type" => new arr_types(),
    		"When" => new DateTime(),
    		"Location" => new Location(),
    		"FacebookEvent" => "",
    		"Organization" => new arr_Org()
    	);
    }
}

class st_arr_user extends st_a_array {
	public function __construct() 
	{
       parent::__construct();
       //Construct our array
       $this->initArray();
    }
    
    private function initArray()
    {
    	$this->array = array(
    		"ID" => "",
    		"fbID" => "",
    		"Registered" => new DateTime(),
    		"Phone" => ""
       	);
    }
}


class st_arr_award extends st_a_array {
	public function __construct() 
	{
       parent::__construct();
    }
    
    
}

class st_arr_types extends st_a_array {
	public function __construct() 
	{
       parent::__construct();
    }
    
    /**public function addType(EventType t)
    {
    
    }
    
    public function removeType(EventType t)
    {
    
    }**/
}


class st_arr_message extends st_a_array {
	public function __construct() 
	{
       parent::__construct();
    }
}