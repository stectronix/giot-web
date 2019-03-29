<?php 
	// $hostname = "localhost";
	// $database = "giotdb";
	// $username = "root";
	// $password = "";

	// $con = new mysqli($hostname, $username, $password, $database);
	// $caracteres = $con->query("SET NAMES 'utf8'");

	$hostname = "localhost";
	$database = "tarek_giotdb";
	$username = "tarek_admin";
	$password = "AccubCirpOtyim5";

	$con = new mysqli($hostname, $username, $password, $database);
	$caracteres = $con->query("SET NAMES 'utf8'");

?>