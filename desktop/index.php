<?php
	require_once("../includes/fb-login.php"); 
	require_once("../api/snacktack.php");
?>
<!DOCTYPE html>
<html>
<?php
$ST_HEADER_TITLE = "SnackTack";
$ST_HEADER_EXTRAS = <<<EOT
    <script src="js/desktop.js"></script>
EOT;
require_once("includes/header.php");

?>
<body>
<?php 
    require_once("includes/navbar.php");
?>
<div class="container-fluid" style="margin-top:10px">
<?php if ($user): // USER IS LOGGED IN ----------------------------------- ?>
    <div class="row-fluid">
        <div class="span4">
<?php
    require_once("includes/profile-plate.php");
    require_once("includes/tab-plan.php");
    require_once("includes/tab-promote.php");
    require_once("includes/footer.php");
?>
        </div>
        <div class="span8 snack-container">
<?php
    require_once("includes/mainfeed.php");
?>
        </div>
    </div>
<?php else: // USER IS NOT LOGGED IN ----------------------------------- ?>
    <div class="row-fluid snack-welcome">
        <div class="span8 offset2 well">
            <h1>SnackTack</h1>
            <h3 class="muted">College snack sales just got easier.</h3>
            <p>Manage, update, find, and subscribe to school fundraisers/sales easily with Snack Tack.</p>
        </div>
    </div>
<?php
    require_once("includes/footer.php");
?>
<?php endif ?>
</div>
</body>
</html>
