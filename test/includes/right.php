<?php
require_once 'includes/code_formatter.php';
?>
<div id="right">
	<h2 style="text-align:center">PHP Stuff</h2>
	<h3>GET</h3>
	<?php printCode($_GET, true); ?>
	<h3>POST</h3>
	<?php printCode($_POST, true); ?>	
	<?php if ($user): ?>
	<h2><?php print($user_profile['name']); ?></h2>
	<h3>User: <?php echo $user; ?></h3>
	<?php endif ?>
</div>
<script type="text/javascript">
	$('#right').hover(function(){
		$('#right').animate({'width':800}, 300);
		//$('#middle').animate({'margin-right':870}, 300);
	},function(){
		$('#right').animate({'width':300}, 300);
		//$('#middle').animate({'margin-right':370},300);
	});
</script>
