<div id="top">
	<div style="float:left">
		<h1>SnackTack API Testing Ground - <?php print $title; ?></h1>
	</div>
	<div style="float:right">
		<?php if ($user): ?>
			<p><?php 
				$st_user = st_user_getData($user_profile['id']);
				if ($st_user != NULL)
					print("You are already registered!");
				else
				{
					$st_user = st_user_register($user_profile); 
					if ($st_user == NULL)
						$user = NULL;
					else
						print("Congratulations! You have been registered!");
				}
			?></p>
			<a href="<?php echo $logoutUrl; ?>">Logout</a>
		<?php else: ?>
			<div>
				Login using OAuth 2.0 handled by the PHP SDK: <a href="<?php echo $loginUrl; ?>">Login with Facebook</a>
			</div>
		<?php endif ?>
	</div>
	<?php if ($user): ?>
	<div style="float:right; margin-right:10px">
		<img src="https://graph.facebook.com/<?php echo $user; ?>/picture" alt=""/>
	</div>
	<?php endif ?>
	<div style="clear:both"></div>
</div>
