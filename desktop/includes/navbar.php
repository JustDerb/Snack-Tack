<?php
require_once("../includes/fb-login.php"); 
require_once("../api/snacktack.php");

/**
 * Split a given URL into its components.
 * Uses parse_url() followed by parse_str() on the query string.
 *
 * @param string $url The string to decode.
 * @return array Associative array containing the different components.
 */
function parse_url_detail($url){
    $parts = parse_url($url);

    if(isset($parts['query'])) {
        parse_str(urldecode($parts['query']), $parts['query']);
    }

    return $parts;
}
?>
<div class="navbar navbar-static-top" id="navbar-top">
	<div class="navbar-inner">
	    <div class="container-fluid" style="margin:10px 0">
	    	<a href="index.php"><img src="../img/logo_mini.png" id="logo" alt="SnackTack" /></a>
<?php if ($user): ?>
    	    <div class="btn-group pull-right">
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
			    	<li><a href="<?php echo($logoutUrl); ?>"><i class="icon-off"></i> Logout</a></li>
			    </ul>
		    </div>
		    <form class="navbar-search pull-right spacer-small">
		    	<input type="text" class="search-query" placeholder="Search">
		    </form>
<?php else: ?>
<?php
$loginParts = parse_url_detail($loginUrl);
$facebookBase = $loginParts['scheme'].'://'.$loginParts['host'].$loginParts['path'];
?>
            <form method="get" action="<?php echo($facebookBase); ?>" class="pull-right" style="margin:0">
            <div class="spacer-small">
			    <button class="btn btn-primary" type="submit">Login with Facebook</button> 
<?php
    foreach ($loginParts['query'] as $key => $value) {
        // On desktop, don't give them the mobile login
        if ($key != 'display' && $value != 'touch')
            echo ('			    <input type="hidden" name="'.$key.'" value="'.$value.'" />');
    }
?>
		    </div>
		    </form>
		    
<?php endif ?>
    	</div>
	</div>
</div>
