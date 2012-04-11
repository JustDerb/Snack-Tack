<?php require "includes/fb-login.php"; 
	  require '../api/snacktack.php'; ?>
<html>
	<head>
<?php require "includes/head.php"; ?>
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

		<ul>
<?php if ($user): ?>
			<li><a class="link" href="<?php echo $logoutUrl; ?>">Logout of Facebook</a></li>
<?php else: ?>
			<li><a class="link" href="<?php echo $loginUrl; ?>">Connect with Facebook</a></li>
<?php endif ?>
		</ul>

<?php if ($user): ?>
		<form method="post">
			<ul>
<?php
	$st_user = st_user_register($user_profile, true);
	$networks = st_user_getNetworks($user, $facebook);
?>
				<li>Networks</li>
<?php 
	$gotone = false;
	foreach ($networks as $element)
	{
		if ($element['type'] == 'college')
		{
			print('<li class="info"><input type="radio" name="networkOption" value="' . $element['nid'] . '" id="' . $element['nid'] . '" ');
			if ($element['nid'] == $st_user->array['Network'])
			{
				$gotone = true;
				print('checked');
			}
			print(' /><label for="' . $element['nid'] . '">' . $element['name'] . '</label></li>');
		}
	}
?>
			</ul>
		</form>
<?php endif ?>
		
		<div id="back" name="back" onclick="window.location.replace('index.php')">Back</div>
<?php include "includes/labelfix.php"; ?>
	</body>
</html>
