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

require_once '../api/fbsdk/facebook.php';
require_once '../api/snacktack.php';

//start the session if necessary
if( session_id() ) {

} else {
	session_start();
}

// Create our Application instance (replace this with your appId and secret).
$facebook = new Facebook(array(
  'appId' => '116798491783875',
  'secret' => '9367c3a6f4bfd318cf405d014841ea41',
  'cookie' => true
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
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
<?php
	include 'includes/header.php';
?>
</head>
<body>
<?php
	$title = 'User';
	include 'includes/top.php';
	include 'includes/left.php';
?>
<?php if ($user): ?>
	<div id="middle">
		<?php
			if ($_POST['form'] == 'saveUserData')
			{
				//print('Saving...');
				if (!st_user_setNetwork($user_profile['id'], $_POST['userNetworkID']))
					print('<b>Error (Setting Network): '.mysql_error().'</b>');
				if (!st_user_setPhone($user_profile['id'], $_POST['userPhone']))
					print('<b>Error (Setting Phone): '.mysql_error().'</b>');
			}
		?>
		<h2>Testing Features</h2>
		<div id="area">
			<h3>User Data</h3>
			<form method="post">
				<table>
					<tr>
						<td>Internal ID:</td>
						<td><?php print($st_user->array['ID']); ?><input type="hidden" id="userID" value="</b> <?php print($st_user->array['ID']); ?>"/></td>
					</tr>
					<tr>
						<td>User ID:</td>
						<td><?php print($st_user->array['fbID']); ?></td>
					</tr>
					<tr>
						<td>Registered:</td>
						<td><?php print($st_user->array['Registered']); ?></td>
					</tr>
					<tr>
						<td>Phone:</td>
						<td><input type="text" name="userPhone" value="<?php print($st_user->array['Phone']); ?>"/></td>
					</tr>
					<tr>
						<td>Network ID:</td>
						<td>
							<select name="userNetworkID">
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
							</select>
						</td>
					</tr>
					<tr>
						<td><input type="hidden" name="form" value="saveUserData"/></td>
						<td><input type="submit" name="submit" value="Save"/></td>
					</tr>
				</table>
			</form>
		</div>
	</div>
	<?php
		include 'includes/me.php';
	?>
<?php else: ?>
	<div id="middle">
		<p>Please login to access testing features.</p>
	</div>
<?php endif ?>
<?php
	include 'includes/right.php';
?>
</body>
</html>