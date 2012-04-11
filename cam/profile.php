<?php 
	require "includes/fb-login.php"; 
	require '../api/snacktack.php'; 
	//Grab our data before we include our form PHP code
	$st_user = st_user_register($user_profile, true);
	$networks = st_user_getNetworks($user, $facebook);
	require 'actions/submitprofile.php';
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
		<ul>
<?php if ($user): ?>
			<li id="connect"><a href="<?php echo $logoutUrl; ?>">Logout of Snack Tack</a></li>
<?php else: ?>
			<li id="connect"><a href="<?php echo $loginUrl; ?>">Connect with Facebook</a></li>
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
			<ul>
				<li class="head">Networks</li>
<?php 
	$gotone = false;
	foreach ($networks as $network)
	{
		if ($network['type'] == 'college')
		{
			print('<li><input type="radio" name="networkOption" value="' . $network['nid'] . '" id="' . $network['nid'] . '" ');
			if ($network['nid'] == $st_user->array['Network'])
			{
				$gotone = true;
				print('checked');
			}
			print(' /><label for="' . $network['nid'] . '">' . $network['name'] . '</label></li>');
		}
	}
?>
			</ul>
			<ul>
				<li class="head">Phone</li>
				<li>We use your phone to send you text messages when a Tacked event is about to start.</li>
				<li><input type="text" name="phone" placeholder="555-555-5555" autocorrect="off" autocomplete="off" value="<?php print($st_user->array['Phone']); ?>"/></li>
<?php if ($form['verifyPhone']): ?>
				<li><input type="text" name="phoneVerify" placeholder="Verification Code" autocorrect="off" autocomplete="off" value=""/></li>
<?php endif ?>
			</ul>
			<input type="hidden" name="form" value="Profile" />
			<div id="submit" name="submit" onclick="return validateForm()">Submit</div>
			<div id="back" name="back" onclick="window.location.replace('index.php')">Back</div>
		</form>
<?php endif ?>
		
<?php include "includes/labelfix.php"; ?>
	</body>
</html>
