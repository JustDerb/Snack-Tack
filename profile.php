<?php 
	require "includes/fb-login.php"; 
	require "api/snacktack.php"; 
	//Grab our data before we include our form PHP code
	$st_user = st_user_register($user_profile, true);
	$form['msg'] = array();
	$form['msg']['error'] = array();
	$form['msg']['message'] = array();
	$form['msg']['success'] = array();
	
	if (array_key_exists('nologin', $_GET))
		array_push($form['msg']['error'],"You need to login to access that page!");
	
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
					array_push($form['msg']['error'],$result->array['Message']);
				else
				{
					
					$st_user->array['Network'] = $last_network['nid'];
					$message = trim($result->array['Message']);
					if (!empty($message))
						array_push($form['msg']['success'],$result->array['Message']);
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
					$num_networks++;
				}
				$networks_string = $networks_string.' /><label for="' . $network['nid'] . '">' . $network['name'] . '</label></li>';
			}
		}
		if ($num_networks == 0 || array_key_exists('nocollege', $_GET))
		{
			array_push($form['msg']['error'],"Uh-oh! You need to be in a college network to be able to use this site!");
		}
		if ($num_networks == 0)
		{
			$networks_string = $networks_string.'<li><strong>You are not in any college networks!</strong></li>';
			array_push($form['msg']['error'],"Please log into Facebook and check to make sure you are accepted into a college network.");
		}
	}
?>
<html>
	<head>
<?php require "includes/head.php"; ?>
		<script type="text/javascript" src="js/profile.js"></script>
	</head>
	<body>	
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
		
<?php if ($form['msg']): ?>
		<ul class="message">
			<?php
				if (is_array($form['msg']['error']))
				{
					foreach ($form['msg']['error'] as $msg)
					{
						print('<li class="error">'.$msg.'</li>');
					}
				}
				if (is_array($form['msg']['success']))
				{
					foreach ($form['msg']['success'] as $msg)
					{
						print('<li class="success">'.$msg.'</li>');
					}
				}
				if (is_array($form['msg']['message']))
				{
					foreach ($form['msg']['message'] as $msg)
					{
						print('<li class="message">'.$msg.'</li>');
					}
				}
			?>
		</ul>
<?php endif ?>

<?php if ($user): ?>
		<form method="post" id="profileForm" name="profileForm">
			<ul class="form">
				<li>Networks</li>
<?php 
	print($networks_string);
?>
			</ul>
			<ul class="form">
				<li>Phone</li>
				<li>We use your phone to send you text messages when a Tacked event is about to start.</li>
				<li><input type="text" name="phone" placeholder="555-555-5555" autocorrect="off" autocomplete="off" value="<?php 
	if ($_POST['phone'])
		print($_POST['phone']);
	else
		print($st_user->array['Phone']); 
?>"/></li>
<?php if ($form['verifyPhone']): ?>
				<li><input type="text" name="phoneVerify" placeholder="Verification Code" autocorrect="off" autocomplete="off" value=""/></li>
<?php endif ?>
			</ul>
			<input type="hidden" name="form" value="Profile" />
			<div id="submit" name="submit" onclick="return validateForm();">Submit</div>
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
