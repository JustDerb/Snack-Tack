<?php
/**
* Copyright 2011 Facebook, Inc.
*
* Licensed under the Apache License, Version 2.0 (the "License"); you may
* not use this file except in compliance with the License. You may obtain
* a copy of the License at
*
* http://www.apache.org/licenses/LICENSE-2.0
*
* Unless required by applicable law or agreed to in writing, software
* distributed under the License is distributed on an "AS IS" BASIS, WITHOUT
* WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied. See the
* License for the specific language governing permissions and limitations
* under the License.
*/

require '../api/fbsdk/facebook.php';
require '../api/snacktack.php';

// Create our Application instance (replace this with your appId and secret).
$facebook = new Facebook(array(
  'appId' => '116798491783875',
  'secret' => '9367c3a6f4bfd318cf405d014841ea41',
));

// Get User ID
$user = $facebook->getUser();

// We may or may not have this data based on whether the user is logged in.
//
// If we have a $user id here, it means we know the user is logged into
// Facebook, but we don't know if the access token is valid. An access
// token is invalid if the user logged out of Facebook.

if ($user) {
  try {
    // Proceed knowing you have a logged in user who's authenticated.
    $user_profile = $facebook->api('/me');
  } catch (FacebookApiException $e) {
    error_log($e);
    $user = null;
  }
}

// Login or logout url will be needed depending on current user state.
if ($user) {
  $logoutUrl = $facebook->getLogoutUrl();
} else {
  $loginUrl = $facebook->getLoginUrl();
}

?>
<!doctype html>
<html xmlns:fb="http://www.facebook.com/2008/fbml">
<head>
	<title>SnackTack | API Testing Ground</title>
	<style>
		body {
		font-family: 'Lucida Grande', Verdana, Arial, sans-serif;
		}
		h1 a {
		text-decoration: none;
		color: #3b5998;
		}
		h1 a:hover {
		text-decoration: underline;
		}
	</style>
</head>
<body>
	<h3>GET</h3>
	<pre><?php print_r($_GET); ?></pre>
	<h3>POST</h3>
	<pre><?php print_r($_POST); ?></pre>
	
	<?php
		if ($_POST['form'] == 'saveUserData')
		{
			//print('Saving...');
			if (st_user_setNetwork($user_profile['id'], $_POST['userNetworkID']))
				print('<b>Error (Setting Network): '.mysql_error().'</b>');
			if (st_user_setPhone($user_profile['id'], $_POST['userPhone']))
				print('<b>Error (Setting Phone): '.mysql_error().'</b>');
		}
	?>

	<h1>SnackTack API Testing Ground</h1>
	
	<?php if ($user): ?>
		<p><?php 
			$st_user = st_user_getData($user_profile['id']);
			if ($user != NULL)
				print("You are already registered!");
			else
			{
				$st_user = st_user_register($user_profile); 
				print("Congratulations! You have been registered!");
			}
		?></p>
		<a href="<?php echo $logoutUrl; ?>">Logout</a>
	<?php else: ?>
		<div>
			Login using OAuth 2.0 handled by the PHP SDK: <a href="<?php echo $loginUrl; ?>">Login with Facebook</a>
		</div>
	<?php endif ?>
	
	<?php if ($user): ?>
		<h2>You (<?php print($user_profile['name']); ?>) User: <?php echo $user; ?></h2>
		<img src="https://graph.facebook.com/<?php echo $user; ?>/picture">
		<?php if ($_GET['me']): ?>
			<h3>Your User Object (/me)</h3>
			<pre><?php print_r($user_profile); ?></pre>
			<h3>Your networks</h3>
			<pre><?php 
				print_r(st_user_getNetworks($user, $facebook)); 
			?></pre>
			<p><a href="?me=0">Hide /me data</a></p>
		<?php else: ?>
			<p><a href="?me=1">Show /me data</a></p>
		<?php endif ?>
		<h2>Testing Features</h2>
		<h3>User Data</h3>
		<form method="post">
			<p><b>Internal ID:</b> <?php print($st_user->array['ID']); ?><input type="hidden" id="userID" value="</b> <?php print($st_user->array['ID']); ?>"></p>
			<p><b>User ID:</b> <?php print($st_user->array['fbID']); ?></p>
			<p><b>Registered:</b> <?php print($st_user->array['Registered']); ?></p>
			<p><b>Phone:</b> <input type="text" name="userPhone" value="<?php print($st_user->array['Phone']); ?>"></p>
			<p><b>Network ID:</b> <select name="userNetworkID">
				<?php
					$networks = st_user_getNetworks($user, $facebook);
				?>
				<optgroup label="Current Network:">
						<?php 
							$gotone = false;
							foreach ($networks as $element)
							{
								if ($element['nid'] == $st_user->array['Network'])
								{
									$gotone = true;
									print('<option value="'.$element['nid'].'" selected="">'.$element['name'].'</option>');
								}
							}
							if (!$gotone)
							{
								print('<option value="-1" selected="">NONE</option>');
							}
						?>
				</optgroup>
				<optgroup label="Select network:">
					<?php
						
						$gotone = false;
						foreach ($networks as $element)
						{
							if ($element['type'] == 'college')
							{
								$gotone = true;
								print('<option value="'.$element['nid'].'">'.$element['name'].'</option>');
							}
						}
						if (!$gotone)
						{
							print(
								'<option value="-1">
									NONE
								</option>');
						}
					?>
					
				</optgroup>
				
			</select></p>
			<input type="hidden" name="form" value="saveUserData">
			<p><input type="submit" name="submit" value="Save"></p>
		</form>
		<h3>Events</h3>
		<p>Create Event</p>
		<p>Search Event</p>
		<p>Delete Event</p>
		<h3>Awards</h3>
		<pre><?php print_r(st_award_getAll($st_user->array['ID'])); ?></pre>
	<?php endif ?>
</body>
</html>