<?php 

	define("databaseServer", "localhost");
	define("databaseUser", "root");
	define("databasePassword", "");
	define("databaseName", "sistema_inscripcion_bd");

	// remote bd
	//define("databaseUser", "u887989201_root");
	//define("databasePassword", "AZK986889@m");
	//define("databaseName", "u887989201_ctt");

	function connectDatabase() {
		$connection = new mysqli(databaseServer, databaseUser, databasePassword, databaseName);
        //$connection = new mysqli("localhost", "root", "", "BDInstituto");
		if ($connection->connect_error) {
			die("Conection failed: " . $connection->connect_error);
		} else {
			return $connection;
		} 
	}

	function disconnectDatabase() {
		$connection->close();
	}

?>