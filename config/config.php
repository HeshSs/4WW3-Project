<?php
	// Database credentials
	define('DB_SERVER', 'ww3-database.cp0wobp38lvg.us-east-2.rds.amazonaws.com');
	define('DB_USERNAME', 'admin');
	define('DB_PASSWORD', 'adminadmin');
	define('DB_NAME', 'WW3_database');

	// Attempt to connect to MySQL database
	$mysql_db = new mysqli(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);

	if (!$mysql_db) {
		die("Error: Unable to connect " . $mysql_db->connect_error);
	}