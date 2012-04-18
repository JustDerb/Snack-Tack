<?php 
	require "includes/fb-login.php"; 
	require "api/snacktack.php"; 
	
	//Grab our data before we include our form PHP code
	$st_user = st_user_register($user_profile, true);
	st_loginonly_check($st_user, $facebook, "profile.php?nologin=1&url=phone.php");
	
	$form['msg'] = array();
	$form['msg']['error'] = array();
	$form['msg']['message'] = array();
	$form['msg']['success'] = array();
			
	$showPhone = true;
	
	require 'actions/submitphone.php';
?>
<html>
	<head>
<?php require "includes/head.php"; ?>
		<script type="text/javascript" src="js/phone.js"></script>
<?php require 'includes/analytics.php"; ?>
	</head>
	<body onload="setTimeout(function() { window.scrollTo(0, 1) }, 100);">	
		<script type="text/javascript">// <![CDATA[ function BlockMove(event) { event.preventDefault(); } // ]]></script>
		<div id="header">
			<a href="index.php"><img src="img/logo_mini.png" id="logo" /></a>
<?php if ($user): ?>
			<a href="profile.php"><img src="https://graph.facebook.com/<?php echo $user; ?>/picture" alt="" id="fbPicture" /></a>
<?php endif ?>
			<div id="clear"></div>
		</div>
		
		<h2>Set Phone Number</h2>		
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
		<form method="post" id="phoneForm" name="phoneForm">
			<ul class="form">
				<li>Phone</li>
<?php if($showPhone): ?>
				<li>We use your phone to send you text messages when a Tacked event is about to start.</li>
				<input type="hidden" name="form" value="phoneset" />
				<li><input type="text" name="phone" placeholder="555-555-5555" autocorrect="off" autocomplete="off" value="<?php 
	if ($_POST['phone'])
		print($_POST['phone']);
	else
		print($st_user->array['Phone']); 
?>"/></li>
<?php else: ?>
				<li>Please enter the verification code that has been sent to your phone. 
				    If you do not recieve your code, please hit back and start the process over.</li>
				<input type="hidden" name="phone" value="<?php print($_POST['phone']); ?>" />
				<input type="hidden" name="form" value="phoneverification" />
				<li><input type="text" name="phoneVerify" placeholder="Verification Code" autocorrect="off" autocomplete="off" value=""/></li>
<?php endif ?>
			</ul>
			
			<div id="submit" name="submit" onclick="return validateForm();">Submit</div>
<?php if (!$showPhone): ?>
			<div id="back" name="back" onclick="window.location.replace('profile.php')">Back</div>
<?php else: ?>
			<div id="back" name="back" onclick="window.history.back();">Back</div>
<?php endif ?>
		</form>
<?php endif ?>
			
<?php include "includes/labelfix.php"; ?>
	</body>
</html>
