<?php
	//This PHP code assumes these are called before inclusion
	//$st_user = st_user_register($user_profile, true);

	if($_POST['form'] == 'phoneset')
	{
		//Error checking
		if (!preg_match("/^\(?([0-9]{3})\)?[-. ]?([0-9]{3})[-. ]?([0-9]{4})$/i", $_POST['phone']))
			array_push($form['msg']['error'],'Invalid phone number.');
		else
		{
			require 'api/google/googlevoice.php';
			
			$_POST['phone'] = str_replace(array(' ','.','-','(',')'), "", $_POST['phone']);
			$token = st_user_generatePhoneToken($st_user);
			
			$gv = new GoogleVoice($googlevoice_email, $googlevoice_password);
			if ($token->array['Error'] == 0)
			{
				$gv->sms($_POST['phone'], 'Your verification code is: '.$token->array['URL']);
				array_push($form['msg']['message'],'Verification number sent.');
				$showPhone = false;
			}
			else
			{
				array_push($form['msg']['error'],$token->array['Message']);
			}
		}
	}
	else if ($_POST['form'] == 'phoneverification')
	{
		$showPhone = false;
		//Error checking
		if (!preg_match("/^\(?([0-9]{3})\)?[-. ]?([0-9]{3})[-. ]?([0-9]{4})$/i", $_POST['phone']))
		{
			array_push($form['msg']['error'],'Invalid phone number.');
			$showPhone = true;
		}
		else
		{
			$_POST['phone'] = str_replace(array(' ','.','-','(',')'), "", $_POST['phone']);

			$token = st_user_getPhoneToken($st_user);
			if ($token->array['Error'] == 0)
			{
				if (strcmp($token->array['URL'],$_POST['phoneVerify']) == 0)
				{
					$message = st_user_setPhone($st_user->array['fbID'], $_POST['phone']);
					if ($message->array['Error'] == 0)
					{
						//Redirect to profile
						header('Location: profile.php?newphone=1');
						$showPhone = true;
					}
					else
					{
						array_push($form['msg']['error'],$token->array['Message']);
						$showPhone = true;
					}
				}
				else
					array_push($form['msg']['error'],'Invalid verification code. Try again.');
			}
			else
			{
				array_push($form['msg']['error'],$token->array['Message']);
				$showPhone = true;
			}
		}
	}	
?>