<?php
	require('lib/db.php');
		
// Opens a connection to a MySQL server
$connection=mysqli_connect ($server, $username, $password);
if (!$connection) {
  die('Not connected : ' . mysqli_error($connection));
}

// Set the active MySQL database
$db_selected = mysqli_select_db($connection, $database);
if (!$db_selected) {
  die ('Can\'t use db : ' . mysqli_error($connection));
}


//$query = mysqli_query($connection, "INSERT INTO rusmap_archive (id, lat, lng, des, time, approved) SELECT id, lat, lng, des, time, approved FROM zombiemap WHERE (time < NOW() - INTERVAL 5 MINUTE)") or die ( mysqli_error($connection) );
$sql = mysqli_query( $connection, "DELETE FROM rusmap WHERE (time < NOW() - INTERVAL 5 MINUTE)") or die ( mysqli_error($connection) );

?>
<script>


	
</script>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="viewport" content="user-scalable=no, initial-scale=1.0, maximum-scale=1.0 minimal-ui"/>
<meta name="apple-mobile-web-app-capable" content="yes"/>
<meta name="apple-mobile-web-app-status-bar-style" content="black">

<link rel="apple-touch-icon-precomposed" sizes="114x114" href="images/splash/splash-icon.png">
<link rel="apple-touch-icon-precomposed" sizes="180x180" href="images/splash/splash-icon-big.png">

<title>RusSpotter v1.0</title>

<link href="css/style.css" rel="stylesheet" type="text/css">
<link href="css/framework.css" rel="stylesheet" type="text/css">
<link href="https://use.fontawesome.com/releases/v5.0.6/css/all.css" rel="stylesheet">
<link href="css/animate.css" rel="stylesheet" type="text/css">

<script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDnnVEW705vAk2948hb7ciGAtaQgK0I764"></script>
<script src="https://developers.google.com/maps/documentation/javascript/examples/markerclusterer/markerclusterer.js"></script>
<script type="text/javascript" src="js/jquery.js"></script>
<script type="text/javascript" src="js/jqueryui.js"></script>
<script type="text/javascript" src="js/framework.plugins.js"></script>
<script type="text/javascript" src="js/custom.js"></script>
<script type="text/javascript" src="js/MainMap.js"></script>
<script type="text/javacsript" src="https://code.jquery.com/jquery-3.1.0.min.js"></script>
<script type="text/javascript" src="js/jquery.min.js"></script>
	

</head>

<?php
	require('header.php');	
?>
<div class="all-elements">
	<div class="snap-drawers">
				<div class="snap-drawer snap-drawer-left">
					<div class="sidebar-header" style="overflow:hidden;">
						<a href="#"><i class="fa fa-times"></i></a>
					</div>

					<div class="sidebar-divider">
						Menu
					</div>

					<ul class="sidebar-navigation">
						<li><a href="index.php"><i class="fa fa-map"></i>Kort<i class="fa fa-circle"></i></a></li>
						<li><a href="http://madsfoek.dk"><i class="fa fa-book"></i>Mads Føk<i class="fa fa-circle"></i></a></li>
						<li><a href="about.php"><i class="fa fa-info"></i>Om Siden<i class="fa fa-circle"></i></a></li>
					</ul>
					<div class="sidebar-divider">
					Stefan Kröll Rasmussen
					</div>
					<div class="sidebar-divider" style="margin-top: -5px;border-top: none;">
					Copyright 2018. All rights reserved.
					</div>
					
				</div>
			</div>
	<div id="content" class="snap-content">
		<div id="main-area">
			<div id="map" style="overflow:visible"></div>
			<a href="#" onclick="addOrSaveMarker(this)"><div id="spotted-button"><i class="fa fa-male" style="line-height:100px"></i></div></a>
			<a href="#" onclick="updateMarkers()"><div id="refresh-button"><i class="fa fa-sync-alt" style="line-height:50px"></i></div></a>
		</div>
	</div>
</div>
</body>
