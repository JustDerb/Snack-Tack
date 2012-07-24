<?php
	//This PHP code assumes these are called before inclusion
	//$st_user = st_user_register($user_profile, true);
	//$networks = st_user_getNetworks($user, $facebook);
	if (isset($st_user) && isset($networks))
	{
		$changed_user_info = false;
		
		if (array_key_exists('phone', $_POST))
		{
			//Set phone
			$result = st_user_setPhone($st_user->array['fbID'], $_POST['phone']);
			if ($result->array['Error'] == 1)
				array_push($msg['error'],$result->array['Message']);
			else 
			{
				$changed_user_info = true;
				if (trim($result->array['Message']) != "")
					array_push($msg['success'],$result->array['Message']);
				//else
				//	array_push($msg['message'],"Phone number not changed.");
			}
			//if (array_key_exists('phoneVerify', $_POST))
			//{
			//}
		}
		
		if (array_key_exists('networkOption', $_POST))
		{
			//Check if network changed
			if ($st_user->array['Network'] != $_POST['networkOption'])
			{
				//Set network
				$isValid = false;
				foreach ($networks as $network)
				{
					if ($network['type'] == 'college')
					{
						if ($network['nid'] == $_POST['networkOption'])
						{
							$isValid = true;
							$result = st_user_setNetwork($st_user->array['fbID'], $_POST['networkOption']);
							break;
						}
					}
				}
				if (!$isValid)
				{
					array_push($msg['error'],"Invalid network.");
				}
				else
				{
					$changed_user_info = true;
					$message = trim($result->array['Message']);
					if (!empty($message))
						array_push($msg['success'],$result->array['Message']);
				}
			}
		}
		
		if ($changed_user_info)
			$st_user = st_user_register($user_profile, true);
			
		//array_push($msg['message'],'<pre>'.print_r($_POST,true).'</pre>');
	}
?>