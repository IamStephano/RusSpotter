<?php
require("db.php");
$lat = $_POST['latitude'];
$long = $_POST['longitude'];
$desc = 'rus';

// Opens a connection to a MySQL server
$connection=mysqli_connect($server, $username, $password);
if (!$connection) {
  die('Not connected : ' . mysqli_error($connection));
}

// Set the active MySQL database
$db_selected = mysqli_select_db($connection, $database);
if (!$db_selected) {
  die ('Can\'t use db : ' . mysqli_error($connection));
}


$sql = mysqli_query( $connection, "INSERT INTO rusmap (id, lat, lng, des, time) VALUE ('%d','$lat','$long','rus',NOW())" ) or die ( mysqli_error($connection) );



?>