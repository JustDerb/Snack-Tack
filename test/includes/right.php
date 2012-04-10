<div id="right">
	<h2 style="text-align:center">PHP Stuff</h2>
	<h3>GET</h3>
	<pre><?php print_r($_GET); ?></pre>
	<h3>POST</h3>
	<pre><?php print_r($_POST); ?></pre>	
	<?php if ($user): ?>
	<h2><?php print($user_profile['name']); ?></h2>
	<h3>User: <?php echo $user; ?></h3>
	<?php endif ?>
</div>