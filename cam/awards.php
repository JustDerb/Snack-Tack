<?php 
	require "includes/fb-login.php"; 
	require '../api/snacktack.php'; 
	//Grab our data before we include our form PHP code
	$st_user = st_user_register($user_profile, true);
?>
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
			<li class="head">Awards</li>
<?php
	$awards = st_award_getAll($st_user->array['ID']);
	//$numAwards = 0;
	
	if (empty($awards))
		print('<li>You don\'t have any awards!</li>');
	else
		foreach ($awards as $award)
		{
			$award = $award->array;
			print('<li><div class="award"><img src="../' . $award['Icon'] . '" alt="' . $award['Name'] . '" /><strong>' . $award['Name'] . '</strong> ' . $award['Description'] . ' (' . $award['Received']->format('m/d/y') . ')</div></li>');
			//$numAwards++;
		}
	//if ($numAwards == 0)
	//	print('<li>You don\'t have any awards!</li>');
?>
		</ul>

<?php include "includes/labelfix.php"; ?>
	</body>
</html>
