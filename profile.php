<?php 
	require "includes/fb-login.php"; 
	require "api/snacktack.php"; 
	//Grab our data before we include our form PHP code
	$st_user = st_user_register($user_profile, true);
	$msg = array();
	$msg['error'] = array();
	$msg['message'] = array();
	$msg['success'] = array();
	
	if (array_key_exists('nologin', $_GET))
		array_push($msg['error'],"You need to login to access that page!");
	if (array_key_exists('newphone', $_GET))
		array_push($msg['success'],"Phone updated!");
	
	if ($user)
	{
		$networks = st_user_getNetworks($user, $facebook);
		require "actions/submitprofile.php";
		
		$num_networks = 0;
		//No network selected
		if ($st_user->array['Network'] < 1)
		{
			$last_network = "";
			foreach ($networks as $network)
			{
				if ($network['type'] == 'college')
				{
					$last_network = $network;
					$num_networks++;
				}
			}
			//Set user's network if theres only 1
			if ($num_networks == 1)
			{
				$result = st_user_setNetwork($st_user->array['fbID'], $last_network['nid']);
				if ($result->array['Error'] == 1)
					array_push($msg['error'],$result->array['Message']);
				else
				{
					
					$st_user->array['Network'] = $last_network['nid'];
					$message = trim($result->array['Message']);
					if (!empty($message))
						array_push($msg['success'],$result->array['Message']);
				}
			}
			
		}
		$networks_string = "";
		$num_networks = 0;
		foreach ($networks as $network)
		{
			if ($network['type'] == 'college')
			{
				$last_network = $network;
				$networks_string = $networks_string.'<li><input type="radio" name="networkOption" value="' . $network['nid'] . '" id="' . $network['nid'] . '" ';
				if ($network['nid'] == $st_user->array['Network'])
				{
					$networks_string = $networks_string.'checked';	
				}
				$networks_string = $networks_string.' /><label for="' . $network['nid'] . '">' . $network['name'] . '</label></li>';
				$num_networks++;
			}
		}
		if ($num_networks == 0 || array_key_exists('nocollege', $_GET))
		{
			array_push($msg['error'],"Uh-oh! You need to be in a college network to be able to use this site!");
		}
		if ($num_networks == 0)
		{
			$networks_string = $networks_string.'<li><strong>You are not in any college networks!</strong></li>';
			array_push($msg['error'],"Please log into Facebook and check to make sure you are accepted into a college network.");
		}
	}
?>
<html>
	<head>
<?php require "includes/head.php"; ?>
		<script type="text/javascript" src="js/profile.js"></script>
<?php require "includes/analytics.php"; ?>
	</head>
	<body onload="setTimeout(function() { window.scrollTo(0, 1) }, 100);">	
<?php include "includes/header.php"; ?>
		
		<h2>Profile</h2>
		<ul id="connect">
<?php if ($user): ?>
			<li><a href="<?php echo $logoutUrl; ?>">Logout of Snack Tack</a></li>
		</ul>
		<ul class="link">
			<li>Awards</li>
			<li><a href="awards.php">View Your Awards</a></li>
<?php else: ?>
			<li><a href="<?php echo $loginUrl; ?>">Connect with Facebook</a></li>
<?php endif ?>
		</ul>
		
<?php if ($msg): ?>
		<ul class="message">
			<?php
				if (is_array($msg['error']))
				{
					foreach ($msg['error'] as $msg)
					{
						print('<li class="error">'.$msg.'</li>');
					}
				}
				if (is_array($msg['success']))
				{
					foreach ($msg['success'] as $msg)
					{
						print('<li class="success">'.$msg.'</li>');
					}
				}
				if (is_array($msg['message']))
				{
					foreach ($msg['message'] as $msg)
					{
						print('<li class="message">'.$msg.'</li>');
					}
				}
			?>
		</ul>
<?php endif ?>

<?php if ($user): ?>
		<h2>Settings</h2>
		<form method="post" id="profileForm" name="profileForm">
			<ul class="form">
				<li>Networks</li>
<?php 
	print($networks_string);
?>
			</ul>
			<div id="submit" name="submit" onclick="return validateForm();">Submit</div>
			<ul class="link">
				<li>Phone</li>
				<li><a href="phone.php">Update Number (<?php if (!empty($st_user->array['Phone'])) print($st_user->array['Phone']); else print('Not Set'); ?>)</a></li>
			</ul>
			<input type="hidden" name="form" value="Profile" />
			
<?php if ($_GET['state']): ?>
			<div id="back" name="back" onclick="window.location.replace('index.php')">Back</div>
<?php else: ?>
			<div id="back" name="back" onclick="window.history.back();">Back</div>
<?php endif ?>
		</form>
<?php endif ?>
			
<?php include "includes/labelfix.php"; ?>
	</body>
</html>
