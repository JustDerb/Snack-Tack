<!DOCTYPE html>
<html>

<head>
<meta content="text/html; charset=utf-8" http-equiv="Content-Type">
<title>Snack Tack | Home</title>
<link rel="stylesheet" type="text/css" href="css/reset.css" media="screen">
<link rel="stylesheet" type="text/css" href="css/main.css" media="screen">

<script type="text/javascript">
	/*** Temporary text filler function. Remove when deploying template. ***/
	var gibberish=["This is just some filler text", "Welcome to Dynamic Drive CSS Library", "Demo content nothing to read here"]
	function filltext(words){
		for (var i=0; i<words; i++)
			document.write(gibberish[Math.floor(Math.random()*3)]+" ")
	}
</script>

</head>

<body>
	<div class="maincontainer">
		<div class="header">
			<div class="innertube hflist">
				<h1>Picture of logo</h1>
				<ul>
					<li><a href="plan.php" id="fixed">Plan</a></li>
					<li><a href="find.php" id="fixed">Find</a></li>
					<li><a href="promote.php" id="fixed">Promote</a></li>
				</ul>
				<div id="clear"></div> 
			</div>
		</div>
		
		<div class="contentwrapper">
			<div class="contentcolumn">
				<div class="innertube">
					<p><b>Content Column: <em>Fluid</em></b></p>
					<p><a href="example.php">OAuth Login With Facebook</a></p>
					<p><a href="test/">API Testing</a></p>
					<p><a href="cam/">Mobile</a></p>
					<p><script type="text/javascript">filltext(45)</script></p>
				</div>
			</div>
		</div>
		
		<div class="rightcolumn">
			<div class="innertube">
				<b>Right Column: <em>200px</em></b> <script type="text/javascript">filltext(14)</script>
			</div>
		</div>
	
		<div class="footer hflist">
			<p>Copyright lolol 2012</p>
			<ul>
				<li><a href="privacy.php">Privacy</a></li>
				<li><a href="tos.php">Terms</a></li>
				<li><a href="support.php">Support</a></li>
			</ul> 
			<div id="clear"></div> 
		</div>
	</div>
</body>
</html>