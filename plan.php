<?php 
	require "includes/fb-login.php"; 
	require "api/snacktack.php"; 
	//Grab our data before we include our form PHP code
	$st_user = st_user_register($user_profile, true);
	require "actions/submitplan.php";
?>
<html>
	<head>
<?php require "includes/head.php"; ?>	
		<script type="text/javascript" src="js/plan.js"></script>
	</head>
	<body>
		<script type="text/javascript">// <![CDATA[ function BlockMove(event) { event.preventDefault(); } // ]]></script>
		<div id="header">
			<a href="index.php"><img src="img/logo_mini.png" id="logo" /></a>
<?php if ($user): ?>
			<a href="profile.php"><img src="https://graph.facebook.com/<?php print($user); ?>/picture" alt="" id="fbPicture" /></a>
<?php endif ?>
			<div id="clear"></div>
		</div>
		
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

		
		<form id="eventForm" name="eventForm" method="post">
			<ul class="form">
				<li>Basic Info</li>
				<li><input type="text" placeholder="Event Name" name="eventName" id="eventName" autocapitalizer="on" autocorrect="off" autocomplete="off" value="<?php if ($_POST['eventName']) print($_POST['eventName']); ?>"/></li>
				<li>
					<textarea placeholder="Event Description" name="eventDescription" id="eventDescription" rows="3" wrap="on"><?php if ($_POST['eventDescription']) print($_POST['eventDescription']); ?></textarea>
				</li>
			</ul>
			
			<ul class="form">
				<li>Food Options</li>
<?php
	$types = st_types_getList();
	foreach($types as $type)
	{
		print('<li><input type="checkbox" name="foodOptions[]" id="'.$type->array['ID'].'" value="'.$type->array['ID'].'"');
		if ($_POST['foodOptions'])
		{
    		$types = $_POST['foodOptions'];
    		foreach ($types as $key => $value)
    		{
    			if ($value == $type->array['ID'])
    				print('checked');
    		}
		}
		print('>');
		print($type->array['Category'].' - '.$type->array['Name']);
		print('</label></li>');
	}
?>
			</ul>
			
			<ul class="form">
				<li>Day</li>
				<li>
					<select name="month">
<?php 
	$months = array("Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec");
	$current_month = Date("M");
	foreach ($months as $month)
	{
		print("<option value=\"" . $month . "\"");
		if (array_key_exists('month', $_POST))
		{
			if (strcasecmp($_POST['month'],$month) == 0)
				print("selected=\"selected\"");
		}
		else
			if (strcasecmp($current_month, $month) == 0)
				print("selected=\"selected\"");
		print(">" . $month . "</option>");
	}
?>
					</select>
					
					<select name="date">
<?php
	$current_date = Date("j");
	for ($i = 1; $i < 32; $i++)
	{
		print("<option value=\"" . $i . "\"");
		if (array_key_exists('date', $_POST))
		{
			if (strcasecmp($_POST['date'],$i) == 0)
				print("selected=\"selected\"");
		}
		else
			if (strcasecmp($current_date, $i) == 0)
				print("selected=\"selected\"");
		print(">" . $i . "</option>");
	}
?>
					</select>
					
					<select name="year">
<?php
	$current_year = Date("Y");
	for ($i = 0; $i <= 1; $i++)
	{
		$year = ($current_year+$i);
		print("<option value=\"" . ($year) . "\"");
		if (array_key_exists('year', $_POST))
		{
			if (strcasecmp($_POST['year'],($year)) == 0)
				print("selected=\"selected\"");
		}
		else
			if (strcasecmp($current_year, ($year)) == 0)
				print("selected=\"selected\"");
		print(">" . ($year) . "</option>");
	}
?>
					</select>
				</li>
			</ul>
			
			<ul class="form">
				<li>Time</li>
				<li>
					Start
					<select name="startHour">
<?php
	$current_hour = Date("g");
	for ($i = 1; $i < 13; $i++)
	{
		print("<option value=\"" . $i . "\"");
		if (array_key_exists('startHour', $_POST))
		{
			if (strcasecmp($_POST['startHour'],$i) == 0)
				print("selected=\"selected\"");
		}
		else
			if (strcasecmp($current_hour, $i) == 0)
				print("selected=\"selected\"");
		print(">" . $i . "</option>");
	}
?>
					</select>
					:
					<select name="startMinute">
<?php 
	$minutes = array("00","10","15","30","45","50");
	$current_minutes = Date("i");
	foreach ($minutes as $minute)
	{
		print("<option value=\"" . $minute . "\"");
		if (array_key_exists('startMinute', $_POST))
		{
			if (strcasecmp($_POST['startMinute'],$minute) == 0)
				print("selected=\"selected\"");
		}
		//else
		//	if (strcasecmp($current_minutes, $minute) == 0)
		//		print("selected=\"selected\"");
		print(">" . $minute . "</option>");
	}
?>
					</select>
					&nbsp;&nbsp;
					<select name="startAMPM">
<?php
	$AMPM = array("AM","PM");
	$current_AMPM = Date("A");
	foreach ($AMPM as $AMPM2)
	{
		print("<option value=\"" . $AMPM2 . "\"");
		if (array_key_exists('startAMPM', $_POST))
		{
			if (strcasecmp($_POST['startAMPM'],$AMPM2) == 0)
				print("selected=\"selected\"");
		}
		else
			if (strcasecmp($current_AMPM, $AMPM2) == 0)
				print("selected=\"selected\"");
		print(">" . $AMPM2 . "</option>");
	}
?>
					</select>
				</li>
				<li>
					End&nbsp;
					<select name="endHour">
<?php
	$current_hour = Date("g");
	for ($i = 1; $i < 13; $i++)
	{
		print("<option value=\"" . $i . "\"");
		if (array_key_exists('endHour', $_POST))
		{
			if (strcasecmp($_POST['endHour'],$i) == 0)
				print("selected=\"selected\"");
		}
		else
			if (strcasecmp($current_hour, $i) == 0)
				print("selected=\"selected\"");
		print(">" . $i . "</option>");
	}
?>
					</select>
					:
					<select name="endMinute">
<?php 
	$minutes = array("00","10","15","30","45","50");
	$current_minutes = Date("i");
	foreach ($minutes as $minute)
	{
		print("<option value=\"" . $minute . "\"");
		if (array_key_exists('endMinute', $_POST))
		{
			if (strcasecmp($_POST['endMinute'],$minute) == 0)
				print("selected=\"selected\"");
		}
		//else
		//	if (strcasecmp($current_minutes, $minute) == 0)
		//		print("selected=\"selected\"");
		print(">" . $minute . "</option>");
	}
?>
					</select>
					&nbsp;&nbsp;
					<select name="endAMPM">
<?php
	$AMPM = array("AM","PM");
	$current_AMPM = Date("A");
	foreach ($AMPM as $AMPM2)
	{
		print("<option value=\"" . $AMPM2 . "\"");
		if (array_key_exists('endAMPM', $_POST))
		{
			if (strcasecmp($_POST['endAMPM'],$AMPM2) == 0)
				print("selected=\"selected\"");
		}
		else
			if (strcasecmp($current_AMPM, $AMPM2) == 0)
				print("selected=\"selected\"");
		print(">" . $AMPM2 . "</option>");
	}
?>
					</select>					
				</li>
			</ul>

			<ul class="form">
				<li>Place</li>
				<li><input type="text" placeholder="Event Location" name="location" id="location" autocapitalizer="on" autocorrect="off" autocomplete="off" value="<?php if ($_POST['location']) print($_POST['location']); ?>" /></li>
			</ul>

			<ul class="form">
				<li>Facebook Event URL</li>
				<li><input type="text" placeholder="(Optional)" name="fburl" id="fburl" autocapitalizer="off" autocorrect="off" autocomplete="off" value="<?php if ($_POST['fburl']) print($_POST['fburl']); ?>" /></li>
			</ul>
			<!-- Put in later
			<ul>
				<li class="head">Organization</li>
				<li><input type="text" placeholder="Name of Organization" name="organization" id="organization" autocapitalizer="on" autocorrect="off" autocomplete="off" value="<?php if ($_POST['organization']) print($_POST['organization']); ?>" /></li>
			</ul>
			-->
			<input type="hidden" name="form" value="plan" />
			<div id="submit" name="submit" onclick="return validateForm()">Submit</div>
			<div id="cancel" name="cancel" onclick="window.history.back()">Cancel</div>
		</form>
<?php include "includes/labelfix.php"; ?>
	</body>
</html>
