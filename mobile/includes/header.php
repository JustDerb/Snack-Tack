		<script type="text/javascript">// <![CDATA[ function BlockMove(event) { event.preventDefault(); } // ]]></script>
		
		<?php
			include '../includes/mobile_device_detect.php';
			if (!@mobile_device_detect()) {
				$notice = 
<<<EOT
		<div style="width:100%;background-color:#000000;color:#808080;text-align:center;font-size:1.5em;padding-bottom:0.5em;border-bottom:1px solid #FFFFFF">
			<img src="../img/types/icons/question.png" alt="" /> For now, we don't have a desktop version! (This site is better viewed on a tiny screen)
		</div>
EOT;
				print($notice);
			}
		?>
		
		<div id="header">
			<a href="../mobile/index.php"><img src="../img/logo_mini.png" id="logo" /></a>
<?php if ($user): ?>
			<a href="../mobile/profile.php"><img src="https://graph.facebook.com/<?php echo $user; ?>/picture" alt="" id="fbPicture" /></a>
<?php endif ?>
			<div id="clear"></div>
		</div>
