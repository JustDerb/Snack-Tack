<?php require "includes/fb-login.php"; 
	  require "api/snacktack.php"; ?>
<html>
	<head>
<?php require "includes/head.php"; ?>
		<script type="text/javascript" src="js/find.js"></script>
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

		<form method="get" id="findForm">
			<ul class="form">
				<li>Search Options</li>
				<li><input type="text" placeholder="Search Terms" name="terms" id="searchTerms" autocapitalizer="on" autocorrect="off" autocomplete="off" value="<?php if ($_GET['terms']) print($_GET['terms']); ?>"/>
				<!--
				<li><input type="radio" name="searchOption" value="byFoodType" id="byFoodType" checked /><label for="byFoodType">By Food Type</label></li>
				<li><input type="radio" name="searchOption" value="byOrganization" id="byOrganization" /><label for="byOrganization">By Organization</label></li>
				-->
			</ul>
		</form>

<?php if($_GET['terms']): ?>
		<ul class="link" id="searchResults">
			<li>Search Results</li>
<?php
	$events = st_events_lookupEvent($_GET['terms'], 7, "date");
	foreach($events as $event)
	{
		print('
			<li>
				<a class="today" href="eventinfo.php?id=' . $event->array["ID"] . '">
					<table>
						<tr>
							<td><div class="name">' . $event->array["Name"] . '</div></td>
						</tr>
						<tr>
							<td><div class="description">' . $event->array["Description"] . '</div></td>
						</tr>
					</table>
				</a>
			</li>');
	}
?>
		</ul>
<?php endif ?>
		<div id="submit" name="submit" onclick="return validateForm();">Submit</div>
		<div id="back" name="back" onclick="window.history.back();">Back</div>
<?php include "includes/labelfix.php"; ?>
	</body>
</html>

