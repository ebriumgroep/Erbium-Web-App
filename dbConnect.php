<?php
	function connect_database(){
		$servername = "localhost";
	    $dUsername = "root";
	    $dPassword = "";
		$db = "id7227985_erbium";

		return new mysqli($servername, $dUsername, $dPassword, $db);
	}
?>