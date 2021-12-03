<?php
	// Database credentials
	define('DB_SERVER', 'sql6.freesqldatabase.com');
	define('DB_USERNAME', 'sql6456226');
	define('DB_PASSWORD', '8FSZa1P9gF');
	define('DB_NAME', 'sql6456226');

	// Attempt to connect to MySQL database
	$mysql_db = new mysqli(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);

	if (!$mysql_db) {
		die("Error: Unable to connect " . $mysql_db->connect_error);
	}