<?php
ob_start();
session_start();
error_reporting(0);

$site_url="http://partha/calc";
$base_url="http://partha/calc";
define('SITE_URL',"http://partha/calc");
define('BASE_URL',"http://partha/calc");

$title="Calculator";
include "calculator.php";

$menus=array(
			"Refrigerated Temperature",
			"Volume",
			"Weight",
			"Current Shipping cost",
			"ThermalVIP+ Shipping cost",
			"Current parcel cost",
			"ThermalVIP+ parcel  cost",
			"Result"
			);
			

?>

<?php
$refg = $calcobj->getvolume("A","REFRIGERATED");
$crt = $calcobj->getvolume("A","CRT");
?>