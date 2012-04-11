<?php
	//This PHP code assumes these are called before inclusion
	//$st_user = st_user_register($user_profile, true);
	//$networks = st_user_getNetworks($user, $facebook);
	if (isset($st_user) && isset($networks))
	{
		if (array_key_exists('phone', $_POST))
		{
			//Set phone
			if (array_key_exists('phoneVerify', $_POST))
			{
			}
		}
		
		if (array_key_exists('networkOption', $_POST))
		{
			//Set network
		}
		
		$form['msg'] = array();
		$form['msg']['message'][] = '<pre>'.print_r($_POST,true).'</pre>';
	}
?>