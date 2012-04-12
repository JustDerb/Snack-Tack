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
		
		<h2>Awards</h2>
		<ul>
			<li class="head">Currently Earned</li>
<?php
	$awards = st_award_getAll($st_user->array['ID']);
	
	if (empty($awards))
		print('<li class="empty">You don\'t have any awards!</li>');
	else
		foreach ($awards as $award)
		{
			$award = $award->array;
			print(
				'<li><div class="award">
					<table>
						<tr>
							<td rowspan="4" valign="top" width="50"><img src="../' . $award['Icon'] . '" alt="' . $award['Name'] . '" /></td>
						</tr>
						<tr>
							<td><div class="name">' . $award['Name'] . '</div></td>
						</tr>
						<tr>
							<td><div class="description">' . $award['Description'] . '</div></td>
						</tr>
						<tr>
							<td><div class="time">Received (' . $award['Received']->format('m/d/y') . ')</div></td>
						</tr>
					</table>
				</div></li>');
			}
?>
		</ul>
		<div id="back" name="back" onclick="window.location.replace('profile.php')">Back</div>		

<?php include "includes/labelfix.php"; ?>
	</body>
</html>
