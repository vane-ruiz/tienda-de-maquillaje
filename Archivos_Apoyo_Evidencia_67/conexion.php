<?php
	 
	$mysqli = new mysqli('localhost', 'root', '', 'bd949596');
	$mysqli->set_charset("utf8");
	if($mysqli->connect_error){
		
		die('Error en la conexión: ' . $mysqli->connect_error);
		
	}
?>
