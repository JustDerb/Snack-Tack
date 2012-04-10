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

	<h1>SnackTack API Testing Ground</h1>
	<p><a href="index.php">User</a> | <a href="events.php">Events</a> | <a href="awards.php">Awards</a></p>

	<?php if ($user): ?>
		<p><?php 
			$st_user = st_user_getData($user_profile['id']);
			if ($_POST['form'] == 'createEvent')
			{
				$event = new st_arr_event();
	    		$event->array["creatorID"] = $st_user->array['ID'];
	    		$event->array["Name"] = $_POST['eventName'];
	    		$event->array["Description"] = $_POST['eventDescription'];
	    		//$event->array["Type"][] = $_POST['eventName'];
	    		$event->array["WhenStart"] = "";
	    		$event->array["WhenEnd"] = "";
	    		$event->array["Location"] = $_POST['location'];
	    		$event->array["FacebookEvent"] = $_POST['eventFBurl'];
	    		$event->array["Organization"] = $_POST['eventOrg'];	
				
				st_events_createEvent($event);
			}			
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
		<h2>Testing Features</h2>
		<h3>Events</h3>
		<h4>Create Event</h4>
		<form method="post">
			<p>Creator ID: <?php print($st_user->array['ID']); ?><input type="hidden" name="eventID" value="<?php print($st_user->array['ID']); ?>"></p>
			<p>Network ID: <?php print($st_user->array['Network']); ?><input type="hidden" name="eventID" value="<?php print($st_user->array['Network']); ?>"></p>
			<p>Name: <input type="text" name="eventName"></p>
			<p>Description: <input type="text" name="eventDescription"></p>
			<p>Type: 
				<select name="eventType[]" multiple="multiple">
					<?php
						$types = st_types_getList();
						foreach($types as $type)
						{
							print('<option value="'.$type->array['ID'].'">'.$type->array['Category'].' - '.$type->array['Name'].'</option>');
						}
					?>
				</select>
			</p>
			<p>When: <input type="text" name="eventDate"> at <input type="text" name="eventTimeStart"> to <input type="text" name="eventTimeEnd"></p>
			<p>Location: <input type="text" name="location"></p>
			<p>FB Event? <input type="url" name="eventFBurl"></p>
			<p>Organization: <input type="text" name="eventOrg"></p>
			<input type="hidden" name="form" value="createEvent">
			<input type="submit" name="submit" value="Create">
		</form>
		<h4>Search Event</h4>
		<h4>Delete Event</h4>
	<?php endif ?>
</body>
</html>