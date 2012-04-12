<?php
	//This PHP code assumes these are called before inclusion
	//$st_user = st_user_register($user_profile, true);
	if (isset($st_user))
	{
		$form['msg'] = array();
		$form['msg']['error'] = array();
		$form['msg']['message'] = array();
		$form['msg']['success'] = array();
		$changed_user_info = false;
		
		if (array_key_exists('phone', $_POST))
		{
		}
				
					
		array_push($form['msg']['message'],'<pre>'.print_r($_POST,true).'</pre>');
	}
?>