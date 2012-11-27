<?php
$dir = dirname(__FILE__);
?>
<head>
	<meta http-equiv="Content-Type" content="text/html;charset=utf-8" />
	<title>
	<?php 
	    if($ST_HEADER_TITLE)
	        echo $ST_HEADER_TITLE;
	    else
	        echo "SnackTack"
	?>
	</title>
	<link href="../css/bootstrap.min.css" rel="stylesheet">
	<link href="../css/desktop2.css" rel="stylesheet">

	<script src="http://code.jquery.com/jquery-latest.js"></script>
	<script src="../js/bootstrap.min.js"></script>

	<?php
	    if ($ST_HEADER_EXTRAS)
	        echo $ST_HEADER_EXTRAS;
	    require_once($dir."/../../includes/analytics.php");
	?>

	<script type="text/javascript">
		var GB_ROOT_DIR = "../js/greybox/";
	</script>
	<script type="text/javascript" src="../js/greybox/AJS.js"></script>
	<script type="text/javascript" src="../js/greybox/AJS_fx.js"></script>
	<script type="text/javascript" src="../js/greybox/gb_scripts.js"></script>
	<link href="../js/greybox/gb_styles.css" rel="stylesheet" type="text/css" />
</head>
