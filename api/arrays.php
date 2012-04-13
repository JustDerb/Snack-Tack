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
    
    public function toJSON($options = 0)
    {
    	return json_encode($this->array, $options);
    }
}



/*
 * EVENT array
 * 
 * Holds information about events (For adding/deleting/modifying)
 *	
 */
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
    		"TYPE" => "EVENT",
    		"ID" => "-1",
    		"NetworkID" => "-1",
    		"creatorID" => "-1",
    		"Name" => "",
    		"Description" => "",
    		"Type" => array(),
    		"WhenStart" => new DateTime(),
    		"WhenEnd" => new DateTime(),
    		"Location" => "", //Will be location array
    		"FacebookEvent" => "", 
    		"Organization" => "" //Will be organization
    	);
    }
}

/*
 * USER array
 * 
 * Holds information about users (For adding/deleting/modifying)
 *	
 */
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
    		"TYPE" => "USER",
    		"ID" => "-1",
    		"fbID" => "-1",
    		"Registered" => new DateTime(),
    		"Phone" => "",
    		"Network" => "-1"
       	);
    }
}

/*
 * AWARD array
 * 
 * Holds information about awards, or thumb-tacks
 *	
 */
class st_arr_award extends st_a_array {
	public function __construct() 
	{
       parent::__construct();
       //Construct our array
       $this->initArray();
    }
    
    private function initArray()
    {
    	$this->array = array(
    		"TYPE" => "AWARD",
    		"ID" => "-1",
    		"Name" => "",
    		"Description" => "",
    		"Icon" => "",
    		"Received" => new DateTime()
       	);
    }
    
    
}

/*
 * TYPES array
 * 
 * Holds information about types of events
 * e.i: Pizza, Ice Cream, T-Shirts....
 *	
 */
class st_arr_types extends st_a_array {    
    public function __construct() 
	{
       parent::__construct();
       //Construct our array
       $this->initArray();
    }
    
    private function initArray()
    {
    	$this->array = array(
			"TYPE" => "TYPES",
			"ID" => "-1",
			"Name" => "",
			"Description" => "",
			"CategoryID" => "-1",
			"Category" => "",
			"CategoryDescription" => "",
			"Icon" => ""
       	);
    }

}

/*
 * MESSAGE array
 * 
 * Array to show that something went wrong (or right)
 *
 */
class st_arr_message extends st_a_array {	
	public function __construct($error = 0, $message = "", $URL = "") 
	{
       parent::__construct();
       //Construct our array
       $this->initArray($error, $message, $URL);
    }
    
    private function initArray($error, $message, $URL)
    {
    	$this->array = array(
    		"TYPE" => "MESSAGE",
    		"Error" => $error,
    		"Message" => $message,
    		"URL" => $URL
       	);
    }
}

/*
 * LOCATION array
 * 
 * Array to hold common locations
 *
 */
class st_arr_location extends st_a_array {	
	public function __construct($error = false) 
	{
       parent::__construct();
       //Construct our array
       $this->initArray();
    }
    
    private function initArray()
    {
    	$err = "0";
    	if ($this->error)
    		$err = "1";
    	$this->array = array(
    		"TYPE" => "LOCATION",
    		"NetworkID" => "-1",
    		"LocationID" => "-1",
    		"Name" => "",
    		"Room" => "",
    		"Address" => ""
       	);
    }
}

?>
