<?php
	$dbhost="localhost";
	$dbuser="root";
	$dbpass="";
	$db="cip";

	$conn=mysqli_connect($dbhost,$dbuser,$dbpass,$db);
	if(!$conn){


	die('Could not Connect My Sql:' .mysql_error());

}
?>