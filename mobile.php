<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1" />
        <title>Snack Tack</title>
        <link rel="stylesheet" href="css/reset.css" type="text/css" media="screen" />
        <link rel="stylesheet" href="css/justin_mobile.css" type="text/css" media="screen" />
    </head>
    <body>
    	<div class="nav nav-left">
    		<div class="nav-content">
    			&lt; Left
    		</div>
    	</div>
    	<div class="nav nav-right">
    		<div class="nav-content">
    			Right &gt;
    		</div>
    	</div>
    	<div class="header clearfix">
    		<div class="container clearfix">
    			Snack Tack
    		</div>
    	</div>
    	
    	<ul>
    	<?php
    		function print_useless()
    		{
    			print '<li>
		    		<div class="event-description-wrapper">
						<div class="event-description">
							<div class="innertube">
								<p id="event-info">This is a generic description of the event...</p>
								<p id="event-details">Type: Pizza | Where: 1020 Coover Hall | $1/slice ($1 pop)</p>
							</div>
						</div>
					</div>
					<div class="event-picture">
						
					</div>
					<div class="clear"></div>
	    		</li>';
    		}
    	
    		for ($i=0; $i<20; $i++)
    		{
    			print_useless();
    		}
    	?>
    	</ul>
    	
    	<div class="footer">
    	</div>
    </body>
</html>