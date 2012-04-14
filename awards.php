<?php 
	require "includes/fb-login.php"; 
	require "api/snacktack.php"; 
	include "includes/displayEventAwardInfo.php";
	
	//Grab our data before we include our form PHP code
	$st_user = st_user_register($user_profile, true);
	st_loginonly_check($st_user, $facebook, "profile.php?nologin=1&url=awards.php");
?>
<html>
	<head>
<?php require "includes/head.php"; ?>
	</head>
	<body onload="setTimeout(function() { window.scrollTo(0, 1) }, 100);">
<?php include "includes/header.php"; ?>
		
		<h2>Awards</h2>
		<ul class="info">
			<li>Currently Earned</li>
<?php
	$awards = st_award_getAll($st_user->array['ID']);
	
	if (empty($awards))
		print('<li class="empty">You don\'t have any awards!</li>');
	else
		foreach ($awards as $award)
		{
			$award = $award->array;
			printEventAwardInfo($award['Icon'], $award['Name'], $award['Name'], $award['Description'], $award['Received'], "", false);	
			/*print(
				'<li><div>
					<table>
						<tr>
							<td rowspan="4" valign="top" width="50"><img src="' . $award['Icon'] . '" alt="' . $award['Name'] . '" /></td>
						</tr>
						<tr>
							<td><p class="nameNormal">' . $award['Name'] . '</p></td>
						</tr>
						<tr>
							<td><p class="descriptionNormal">' . $award['Description'] . '</p></td>
						</tr>
						<tr>
							<td><p class="timeSmall">Received (' . $award['Received']->format('m/d/y') . ')</p></td>
						</tr>
					</table>
				</div></li>');*/
			}
?>
		</ul>
		<div id="back" name="back" onclick="window.history.back();">Back</div>		

<?php include "includes/labelfix.php"; ?>
	</body>
</html>
