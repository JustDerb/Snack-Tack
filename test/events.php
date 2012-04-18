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


require_once 'includes/code_formatter.php';

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
	$title = 'Events';
	include 'includes/top.php';
	include 'includes/left.php';
?>
<?php if ($user): ?>
	<div id="middle">
		<h2>Testing Features</h2>
		<h3>Events</h3>
		<h4>Create Event</h4>
		<?php 
			if ($_POST['form'] == 'createEvent')
			{
				$event = new st_arr_event();
	    		$event->array["creatorID"] = $st_user->array['ID'];
	    		$event->array["NetworkID"] = $st_user->array['Network'];
	    		$event->array["Name"] = $_POST['eventName'];
	    		$event->array["Description"] = $_POST['eventDescription'];
	    		if ($_POST['eventType'])
	    		{
		    		$types = $_POST['eventType'];
		    		foreach ($types as $key => $value)
		    		{
		    			$event->array["Type"][] = $value;
		    		}
	    		}
	    		$event->array["WhenStart"] = st_DateTime_getDateTime($_POST['eventDateYear'],$_POST['eventDateMonth'],$_POST['eventDateDay'],$_POST['eventTimeStartHour'],$_POST['eventTimeStartMinute'],$_POST['eventTimeStartPMAM'] == 'AM');
	    		$event->array["WhenEnd"] = st_DateTime_getDateTime($_POST['eventDateYear'],$_POST['eventDateMonth'],$_POST['eventDateDay'],$_POST['eventTimeEndHour'],$_POST['eventTimeEndMinute'],$_POST['eventTimeEndPMAM'] == 'AM');;
	    		$event->array["Location"] = $_POST['eventLocation'];
	    		$event->array["FacebookEvent"] = $_POST['eventFBurl'];
	    		$event->array["Organization"] = $_POST['eventOrg'];	
				
				print('<pre>'.print_r($event,true).'</pre>');
				
				print('<pre>'.print_r(st_events_createEvent($event),true).'</pre>');
			}
		?>
		<form method="post">
			<table>
				<tr>
					<td>Creator ID:</td>
					<td><?php print($st_user->array['ID']); ?><input type="hidden" name="eventID" value="<?php print($st_user->array['ID']); ?>"/></td>
				</tr>
				<tr>
					<td>Network ID:</td>
					<td><?php print($st_user->array['Network']); ?><input type="hidden" name="eventNetworkID" value="<?php print($st_user->array['Network']); ?>"/></td>
				</tr>
				<tr>
					<td>Name:</td>
					<td><input type="text" name="eventName" value="Name <?php print(rand()); ?>"/></td>
				</tr>
				<tr>
					<td>Description:</td>
					<td><textarea name="eventDescription">This is a test description.</textarea>
					</td>
				</tr>
				<tr>
					<td>Type:</td>
					<td>
						<select name="eventType[]" multiple="multiple">
							<?php
								$types = st_types_getList();
								foreach($types as $type)
								{
									print('<option value="'.$type->array['ID'].'">'.$type->array['Category'].' - '.$type->array['Name'].'</option>');
								}
							?>
						</select>
					</td>
				</tr>
				<tr>
					<td>When:</td>
					<td>
						<select name="eventDateMonth">
						<?php 
							$months = array("Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec");
							foreach ($months as $month)
								echo "<option value=\"" . $month . "\">" . $month . "</option>";
						?>
						</select>
						<select name="eventDateDay">
						<?php
							for ($i = 1; $i < 32; $i++)
								echo "<option value=\"" . $i . "\">" . $i . "</option>";
						?>
						</select>
						<select name="eventDateYear">
							<?php
							for ($i = 2012; $i < 2013; $i++)
								echo "<option value=\"" . $i . "\">" . $i . "</option>";
							?>
						</select>
					</td>
				</tr>
				<tr>
					<td>Time Start:</td>
					<td>					
						<select name="eventTimeStartHour">
							<?php
							for ($i = 1; $i < 13; $i++)
								echo "<option value=\"" . $i . "\">" . $i . "</option>";
							?>
						</select>
						<select name="eventTimeStartMinute">
							<?php
							$minutes = array("00","10","15","30","45","50");
							foreach ($minutes as $min)
								echo "<option value=\"" . $min . "\">" . $min . "</option>";
							?>
						</select>	
						<select name="eventTimeStartPMAM">
							<option value="AM">AM</option>
							<option value="PM">PM</option>
						</select>
					</td>
				</tr>
				<tr>
					<td>Time End:</td>
					<td>					
						<select name="eventTimeEndHour">
							<?php
							for ($i = 1; $i < 13; $i++)
								echo "<option value=\"" . $i . "\">" . $i . "</option>";
							?>
						</select>
						<select name="eventTimeEndMinute">
							<?php
							$minutes = array("00","10","15","30","45","50");
							foreach ($minutes as $min)
								echo "<option value=\"" . $min . "\">" . $min . "</option>";
							?>
						</select>	
						<select name="eventTimeEndPMAM">
							<option value="AM">AM</option>
							<option value="PM">PM</option>
						</select>
					</td>
				</tr>
				<tr>
					<td>Location:</td>
					<td><input type="text" name="eventLocation" value="Coover Hall Room <?php print(rand(1000,9999)); ?>"/></td>
				</tr>
				<tr>
					<td>FB Event?</td>
					<td><input type="url" name="eventFBurl"/></td>
				</tr>
				<tr>
					<td>Organization:</td>
					<td><input type="text" name="eventOrg"/></td>
				</tr>
				<tr>
					<td><input type="hidden" name="form" value="createEvent"/></td>
					<td><input type="submit" name="submit" value="Create"/></td>
				</tr>
			</table>
		</form>
		<h4>Search Event</h4>
		<form method="post">
			<table>
				<tr>
					<td>User ID:</td>
					<td><?php print($st_user->array['ID']); ?><input type="hidden" name="eventID" value="<?php print($st_user->array['ID']); ?>"/></td>
				</tr>
				<tr>
					<td>Network ID:</td>
					<td><?php print($st_user->array['Network']); ?><input type="hidden" name="eventID" value="<?php print($st_user->array['Network']); ?>"/></td>
				</tr>
				<tr>
					<td>Search:</td>
					<td><input type="text" name="eventSearch" value="<?php if($_POST['eventSearch']) print $_POST['eventSearch'];?>"/></td>
				</tr>
				<tr>
					<td>Days Ahead: (NUMBER)</td>
					<td><input type="text" name="eventDays" value="<?php if($_POST['eventDays']) print $_POST['eventDays']; else print 0; ?>"/></td>
				</tr>
				<tr>
					<td><input type="hidden" name="form" value="searchEvent"/></td>
					<td><input type="submit" name="submit" value="Search"/></td>
				</tr>
			</table>
		</form>
		<h5>Results</h5>
		<?php
			if ($_POST['form'] == 'searchEvent')
			{
				printCode(st_events_lookupEvent($_POST['eventSearch'], $_POST['eventDays'], "date"),true);
			}
		?>
		<h4>User</h4>
		<form method="post">
			<table>
				<tr>
					<td>Get user Events (ID):</td>
					<td><input type="text" name="eventUser" value="<?php if ($_POST['eventUser']) print($_POST['eventUser']); else print($st_user->array['ID']);?>"/></td>
				</tr>
				<tr>
					<td><input type="hidden" name="form" value="userAllEvent"/></td>
					<td><input type="submit" name="submit" value="Search"/></td>
				</tr>
			</table>
		</form>
		<h5>Result</h5>
		<?php
			if ($_POST['form'] == 'userAllEvent')
			{
				printCode(st_events_getUsersEvents($_POST['eventUser']),true);
			}
		?>
		<h4>Delete Event</h4>
		<form method="post">
			<table>
				<tr>
					<td>Event ID:</td>
					<td><input type="text" name="eventSearch"/></td>
				</tr>
				<tr>
					<td><input type="hidden" name="form" value="deleteEvent"/></td>
					<td><input type="submit" name="submit" value="Delete"/></td>
				</tr>
			</table>
		</form>
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