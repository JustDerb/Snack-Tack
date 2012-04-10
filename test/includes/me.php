<?php
require_once 'includes/code_formatter.php';
?>
<div id="middle">
	<h2>Facebook API /me Array</h2>
	<?php if ($_GET['me']): ?>
		<p><a href="?me=0">Hide /me data</a></p>
		<h3>Your User Object (/me)</h3>
		<?php printCode($user_profile, true); ?>
		<h3>Your networks</h3>
		<?php 
			printCode(st_user_getNetworks($user, $facebook), true); 
		?>
		<p><a href="?me=0">Hide /me data</a></p>
	<?php else: ?>
		<p><a href="?me=1">Show /me data</a></p>
	<?php endif ?>
</div>
