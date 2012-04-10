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
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
	<title>SnackTack API Testing Ground</title>
	<link rel="stylesheet" href="css/testing.css" type="text/css" media="all" />
	<meta http-equiv="content-type" content="text/html; charset=iso-8859-1" />
	<meta name="MSSmartTagsPreventParsing" content="TRUE" />
	<meta http-equiv="expires" content="-1" />
	<meta http-equiv= "pragma" content="no-cache" />
</head>
<body>
<?php
	$title = 'Awards';
	include 'includes/top.php';
	include 'includes/left.php';
?>
<?php if ($user): ?>
	<div id="middle">
		<h2>Testing Features</h2>
		<h3>Awards</h3>
		<pre><?php print_r(st_award_getAll($st_user->array['ID'])); ?></pre>
	</div>
	<div id="middle">
		<h2>Facebook API /me Array</h2>
		<?php if ($_GET['me']): ?>
			<p><a href="?me=0">Hide /me data</a></p>
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
	</div>
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