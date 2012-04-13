<?php

$dir = dirname(__FILE__);
require_once $dir.'/../fbsdk/facebook.php';
require_once $dir.'/../arrays.php';
require_once $dir.'/core_user.php';

function st_loginonly_check($st_user, $facebookObj, $redirect_url = "")
{
	$message = st_user_isValidUser($st_user, $facebookObj);
	if ($message->array['Error'] == 1)
	{
		if (!empty($message->array['URL']))
			header( 'Location: '.$message->array['URL']) ;
		else if (!empty($redirect_url))
			header( 'Location: '.$redirect_url ) ;
	}
}
?>