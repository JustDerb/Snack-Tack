<?php 
	require "includes/fb-login.php"; 
	require "api/snacktack.php"; 
	//Grab our data before we include our form PHP code
	$st_user = st_user_register($user_profile, true);
	$networks = st_user_getNetworks($user, $facebook);
	require "actions/submitprofile.php";
	
	$networks_string = "";
	$gotone = false;
	foreach ($networks as $network)
	{
		if ($network['type'] == 'college')
		{
			$networks_string = $networks_string.'<li><input type="radio" name="networkOption" value="' . $network['nid'] . '" id="' . $network['nid'] . '" ';
			if ($network['nid'] == $st_user->array['Network'])
			{
				$gotone = true;
				$networks_string = $networks_string.'checked';
			}
			$networks_string = $networks_string.' /><label for="' . $network['nid'] . '">' . $network['name'] . '</label></li>';
		}
	}
	if (!$gotone)
	{
		$networks_string = $networks_string.'<li><strong>You are not in any college networks!</strong></li>';
		array_push($form['msg']['error'],"Uh-oh! You need to be in a college network to be able to use this site! Please log into Facebook and check to make sure you are accepted into a college network.");
	}
?>
<html>
	<head>
<?php require "includes/head.php"; ?>
		<script type="text/javascript" src="js/profile.js"></script>
	</head>
	<body>	
		<script type="text/javascript">// <![CDATA[ function BlockMove(event) { event.preventDefault(); } // ]]></script>
		<div id="header">
			<a href="index.php"><img src="img/logo_mini.png" id="logo" /></a>
<?php if ($user): ?>
			<a href="profile.php"><img src="https://graph.facebook.com/<?php echo $user; ?>/picture" alt="" id="fbPicture" /></a>
<?php endif ?>
			<div id="clear"></div>
		</div>
		
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
