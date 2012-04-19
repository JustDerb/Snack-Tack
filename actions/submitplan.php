<?php
	//This PHP code assumes these are called before inclusion
	//$st_user = st_user_register($user_profile, true);
	if (isset($st_user))
	{
		$msg = array('error' => array(), 'message' => array(), 'success' => array());
		//$changed_user_info = false;
		
		if (array_key_exists('form', $_POST))
		{
			if (!array_key_exists('eventName', $_POST) ||
				!array_key_exists('eventDescription', $_POST) ||
				!array_key_exists('foodOptions', $_POST) ||
				!array_key_exists('month', $_POST) ||
				!array_key_exists('date', $_POST) ||
				!array_key_exists('year', $_POST) ||
				!array_key_exists('startHour', $_POST) ||
				!array_key_exists('startMinute', $_POST) ||
				!array_key_exists('startAMPM', $_POST) ||
				!array_key_exists('endHour', $_POST) ||
				!array_key_exists('endMinute', $_POST) ||
				!array_key_exists('endAMPM', $_POST) ||
				!array_key_exists('location', $_POST) ||
				!array_key_exists('fburl', $_POST))// ||
				//!array_key_exists('organization', $_POST))
			{
				$msg['error'][] = 'Missing some data to create event.  Please try again.';
			}
			else
			{
				$event = new st_arr_event();
	    		$event->array["creatorID"] = $st_user->array['ID'];
	    		$event->array["NetworkID"] = $st_user->array['Network'];
	    		$event->array["Name"] = $_POST['eventName'];
	    		$event->array["Description"] = $_POST['eventDescription'];
	    		if ($_POST['foodOptions'])
	    		{
		    		$types = $_POST['foodOptions'];
		    		foreach ($types as $key => $value)
		    		{
		    			$event->array["Type"][] = $value;
		    		}
	    		}
	    		$event->array["WhenStart"] = st_DateTime_getDateTime($_POST['year'],$_POST['month'],$_POST['date'],$_POST['startHour'],$_POST['startMinute'],$_POST['startAMPM'] == 'AM');
	    		$event->array["WhenEnd"] = st_DateTime_getDateTime($_POST['year'],$_POST['month'],$_POST['date'],$_POST['endHour'],$_POST['endMinute'],$_POST['endAMPM'] == 'AM');;
	    		$event->array["Location"] = $_POST['location'];
	    		$event->array["FacebookEvent"] = $_POST['fburl'];
	    		$event->array["Organization"] = "-1";//$_POST['organization'];	
				
				$result = st_events_createEvent($event);
				
				if ($result->array['Error'] == 1)
				{
					$msg['error'][] = 'blah';
				}
				else
				{
					$message = trim($result->array['Message']);
					if (!empty($message))
					{
						$msg['success'][] = $result->array['Message'];
					}
					$redirect = trim($result->array['URL']);
					if (!empty($redirect))
						header( 'Location: '.$redirect ) ;
				}
			}
		}
		
		//For debugging purposes				
		//array_push($msg['message'],'<pre>'.print_r($_POST,true).'</pre>');
	}
?>