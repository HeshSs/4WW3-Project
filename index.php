<?php

header('Content-Type: application/json');

// Variables
$servername = "sql6.freesqldatabase.com";
$port = "3306";
$dbname = "sql6456226";
$charset = 'utf8' ;
$username = "sql6456226";
$password = "8FSZa1P9gF";
$pdo = connect($servername, $port, $dbname, $charset, $username, $password);

function connect($servername, $port, $dbname, $charset, $username, $password) {
    try {
        $dsn = "mysql:host=$servername;port=$port;dbname=$dbname;charset=$charset";
        $pdo = new PDO($dsn, $username, $password);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        return $pdo;
    } catch (PDOException $e) {
        echo "Connection failed: ". $e->getMessage() . "\n";
    }
}

function insertRow($spotName, $spotLatitude, $spotLongitude, $spotType, $spotDescription) {
    // SQL Command to insert row
    $insertValues = "INSERT INTO spots (name, latitude, longitude, location_type, description) 
    VALUES ('$spotName', $spotLatitude, $spotLongitude, $spotType, '$spotDescription')";
    // Run the insert row command
    return $insertValues;
}

if (!function_exists('str_contains')) {
    function str_contains(string $haystack, string $needle): bool
    {
        return '' === $needle || false !== strpos($haystack, $needle);
    }
}

// SQL Command to create table
$createTable = "CREATE TABLE spots (
    id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255) NOT NULL,
    latitude DOUBLE PRECISION NOT NULL,
    longitude DOUBLE PRECISION NOT NULL,
    location_type INT NOT NULL,
    description varchar(511)
    )";

// Run the create table command (Already done)
// $pdo->query($createTable);

// SQL Command to remove everything from table
// $removeAll = "DELETE FROM spots";

// Run the remove all  command
// $pdo->query($removeAll);

// Rows to insert
$insertRow1 = insertRow('First-Aid Kit Spot', 43.26350049157633, -79.91766767857462, 0, 'This First-Aid kit is located at MUSC.');
$insertRow2 = insertRow('First-Aid Kit Spot', 43.26278765892196, -79.91766372192467, 0, 'This First-Aid kit is located at Mills.');
$insertRow3 = insertRow('First-Aid Kit Spot', 43.26209985774714, -79.92019797028367, 0, 'This First-Aid kit is located at BSB.');
$insertRow4 = insertRow('Emergency Telephone Spot', 43.263422451519816, -79.91762002305562, 1, 'This Emergency Telephone is located at Musc.');
$insertRow5 = insertRow('Emergency Telephone Spot', 43.26276359358968, -79.91758481896233, 1, 'This Emergency Telephone is located at Mills.');
$insertRow6 = insertRow('Emergency Telephone Spot', 43.261894130582725, -79.92020484788813, 1, 'This Emergency Telephone is located at BSB.');

// Add the row to the database
// $pdo->query($insertRow6);

// Get spots table rows
$getTable = $pdo->query("SELECT * FROM spots");
$arr = array();

// Loop through the rows
while ($row = $getTable->fetch()) {
    // Get row data
    $row_data = $row['name'] . ", " . $row['latitude'] . ", " . $row['longitude'] . ", " . $row['location_type'] . ", " . $row['description'];
    // Add the row to the array
    array_push($arr, $row_data);
}

if (htmlspecialchars($_GET["table"]) === "spots") {
    // Return all spots
    echo json_encode($arr);
} else if (htmlspecialchars($_GET["q"]) != "") {

    // Query value
    $query = $_GET["q"];
    $closeSpots = array();

    // If searching using Coordinates i.e. (lat, long)
    if (substr($query, 0, 1) == "(") {
        $pair = explode (",", substr($query, 1, strlen($query) - 2));
        foreach ($arr as &$row) {
            $row_data = explode (",", $row);
            $inLat = abs(floatval($row_data[1]) - floatval($pair[0])) < 0.001;
            $inLong = abs(floatval($row_data[2]) - floatval($pair[1])) < 0.001;
            if ($inLat or $inLong) {
                array_push($closeSpots, $row);
            }
        }

    // If searching anything else
    } else {
        foreach ($arr as &$row) {
            $row_data = explode (",", $row);
            foreach(explode (" ", $query) as &$word)
            if (str_contains(strtolower($row_data[0]), strtolower($word))) {
                array_push($closeSpots, $row);
                break;
            }
        }
    }
    // Return the found spots
    echo json_encode($closeSpots);
}
?>