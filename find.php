<?php require "includes/fb-login.php"; 
	  require "api/snacktack.php"; ?>
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

		<form>
			<ul class="form">
				<li>Search Options</li>
				<li><input type="text" placeholder="Search Terms" name="searchTerms" id="searchTerms" autocapitalizer="on" autocorrect="off" autocomplete="off" />
				<li><input type="radio" name="searchOption" value="byFoodType" id="byFoodType" checked /><label for="byFoodType">By Food Type</label></li>
				<li><input type="radio" name="searchOption" value="byOrganization" id="byOrganization" /><label for="byOrganization">By Organization</li>
				</li>
			</ul>
		</form>


		<ul class="link"id="searchResults">
			<li>Search Results</li>
		</ul>

		<div id="back" name="back" onclick="window.history.back();">Back</div>
<?php include "includes/labelfix.php"; ?>
	</body>
</html>
