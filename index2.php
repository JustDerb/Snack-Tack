<!DOCTYPE html>
<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html;charset=utf-8" />
		<title>SnackTack</title>
		<link href="css/bootstrap.min.css" rel="stylesheet">
		<link href="css/desktop2.css" rel="stylesheet">
		<script src="http://code.jquery.com/jquery-latest.js"></script>
		<script src="js/bootstrap.min.js"></script>
		<script src="js/desktop.js"></script>
	</head>
	<body>
	    <div class="navbar navbar-static-top" id="navbar-top">
	    	<div class="navbar-inner">
			    <div class="container-fluid" style="margin:10px 0">
			    	<a href="index.php"><img src="img/logo_mini.png" id="logo" alt="SnackTack" /></a>
		    	    <div class="btn-group pull-right spacer-small">
					    <button class="btn"><i class="icon-user"></i> Profile</button>
					    <button class="btn dropdown-toggle" data-toggle="dropdown">
					    <span class="caret"></span>
					    </button>
					    <ul class="dropdown-menu">
					    	<li><a href="#"><i class="icon-bell"></i> Tacked Events</a></li>
					    	<li><a href="#"><i class="icon-th-list"></i> My Planned Events</a></li>
					    	<li><a href="#"><i class="icon-gift"></i> Awards</a></li>
					    	<li><a href="#"><i class="icon-wrench"></i> Settings</a></li>
					    	<li class="divider"></li>
					    	<li><a href="#"><i class="icon-off"></i> Logout</a></li>
					    </ul>
				    </div>
			    	<form class="navbar-search pull-right">
				    	<input type="text" class="search-query" placeholder="Search">
				    </form>
		    	</div>
	    	</div>
    	</div>
		<div class="container-fluid" style="margin-top:10px">
			<div class="row-fluid">
				<div class="span4">
					<div class="snack-container">
						<table class="table" style="margin-bottom:0">
							<thead>
								<tr>
									<td colspan="3">
									<img class="img-rounded" src="img/types/box.png" alt="Event Icon">
									<h3 style="display:inline-table">Profile Name</h3>
									</td>
								</tr>
							</thead>
							<tbody>
								<tr>
									<td>
									<div><span class="badge badge-success"><i class="icon-ok icon-white"></i></span></div>
									<small class="muted">SMS Enabled</small>
									</td>
									<td class="row-left-border">
									<div><span class="badge badge-info"><i class="icon-bell icon-white"></i> 2 Upcoming</span></div>
									<small class="muted">Tacked Events</small>
									</td>
									<td class="row-left-border">
									<div><span class="badge badge-info"><i class="icon-gift icon-white"></i> 2</span></div>
									<small class="muted">Awards</small>
									</td>
								</tr>
								<tr>
									<td colspan="3">
										<div class="btn-group">
											<button class="btn btn-inverse" style="width:50%" id="tab-plan-btn">Plan</button>
											<button class="btn" style="width:50%" id="tab-promote-btn">Promote</button>
										</div>
									</td>
								</tr>
							</tbody>
						</table>
					</div>
					<div class="well well-small" id="tab-plan">
					    <form>
					    	<legend>Plan Event</legend>
					    	<div class="input-prepend">
								<span class="add-on"><i class="icon-exclamation-sign"></i></span>
								<input class="span11" type="text" name="eventName" placeholder="Event Name...">
							</div>
							<div class="input-prepend">
								<span class="add-on"><i class="icon-exclamation-sign"></i></span>
								<textarea class="span11" name="eventDesc" placeholder="Event Description..." rows="3"></textarea>
							</div>
							<div class="input-prepend">
								<span class="add-on"><i class="icon-exclamation-sign"></i></span>
								<input class="span11" type="text" name="eventDateTime" placeholder="Day, Time, Duration...">
							</div>
							<div class="input-prepend">
								<span class="add-on"><i class="icon-exclamation-sign"></i></span>
								<input class="span11" type="text" name="eventLoc" placeholder="Location...">
							</div>
							<div class="input-prepend">
								<span class="add-on"><i class="icon-exclamation-sign"></i></span>
								<input class="span11" type="text" name="eventURl" placeholder="Event URL...">
							</div>
							<button class="btn btn-large btn-inverse btn-block" type="submit">Plan</button>
					    </form>
					</div>
					<div class="well well-small" id="tab-promote" style="display:none">
					    <form>
					    	<legend>Promote Event</legend>
					    	<div class="input-prepend">
								<span class="add-on"><i class="icon-exclamation-sign"></i></span>
								<input class="span11" type="text" name="eventName" placeholder="Event Name...">
							</div>
							<div class="input-prepend">
								<span class="add-on"><i class="icon-exclamation-sign"></i></span>
								<textarea class="span11" name="eventDesc" placeholder="Event Description..." rows="3"></textarea>
							</div>
							<div class="input-prepend">
								<span class="add-on"><i class="icon-exclamation-sign"></i></span>
								<input class="span11" type="text" name="eventDateTime" placeholder="Day, Time, Duration...">
							</div>
							<div class="input-prepend">
								<span class="add-on"><i class="icon-exclamation-sign"></i></span>
								<input class="span11" type="text" name="eventLoc" placeholder="Location...">
							</div>
							<div class="input-prepend">
								<span class="add-on"><i class="icon-exclamation-sign"></i></span>
								<input class="span11" type="text" name="eventURl" placeholder="Event URL...">
							</div>
							<div class="dropdown">
							<div class="input-prepend">
								<span class="add-on"><i class="icon-exclamation-sign"></i></span>
								<input class="span11" type="text" name="eventOwner" placeholder="Event Owner (Facebook search)">
							</div>
							    <ul class="dropdown-menu form-shifted" role="menu" aria-labelledby="dLabel">
							    <li><a tabindex="-1" href="#">Action</a></li>
							    <li><a tabindex="-1" href="#">Another action</a></li>
							    <li><a tabindex="-1" href="#">Something else here</a></li>
							    <li class="divider"></li>
							    <li><a tabindex="-1" href="#">Separated link</a></li>
							    </ul>
						    </div>
							<label class="checkbox form-shifted">
								<input type="checkbox" value="">
								This is not my event, but someone else's.
							</label>							
							<button class="btn btn-large btn-inverse btn-block" type="submit">Promote</button>
					    </form>
					</div>
					<div class="snack-container"  style="text-align:center">
						<div><small><a href="#">About</a> - <a href="#">Help</a> - <a href="#">Legal</a></small></div>
						<div><small class="muted">Copyright 2012 Snack Tack</small></div>
					</div>
				</div>
				<div class="span8 snack-container">
					<table class="table table-hover" style="margin-bottom:0">
						<thead>
							<tr>
								<th colspan="3">Upcoming Events</th>
							</tr>
						</thead>
						<tbody>
							<?php
							$event = <<<EOT
							<tr>
								<td><img src="img/types/box.png" alt="Event Icon"></td>
								<td>
								<span class="event-title">Bacon Charity</span> <span class="event-location muted">(Ag Building)</span>
								<div class="event-description">Bacon ipsum dolor sit amet tail ex reprehenderit shank enim cillum velit. Et aliquip short ribs, prosciutto labore excepteur corned beef ad sunt veniam. Est pork chop ad veniam excepteur. Aliquip ut aute, ball tip brisket et fugiat...</div>
								<div class="expand muted"><a href="#">Expand...</a></div>
								</td>
								<td class="muted">
								<time></time>
								<div class="event-time pull-right">Thu Sep 4th</div>
								<div class="event-time pull-right">@ 4:00pm-7:00pm</div>
								</td>
							</tr>
EOT;
							for ($i=0; $i<15; $i++)
								echo $event;
							?>
						</tbody>
						<tfoot>
							<tr>
								<td colspan="3"><button class="btn btn-large btn-block" type="button">Load More Events</button></td>
							</tr>
						</tfoot>
					</table>
				</div>
			</div>
		</div>
   	</body>
</html>

