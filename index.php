<?php

include "functions.php";

try {

    // Variables
    $servername = "ww3-database.cp0wobp38lvg.us-east-2.rds.amazonaws.com";
    $port = "3306";
    $dbname = "WW3_database";
    $charset = 'utf8' ;
    $username = "admin";
    $password = "adminadmin";

    // connect to database
    $pdo = connect($servername, $port, $dbname, $charset, $username, $password);

    // SQL Command to create table
    $createTable = "CREATE TABLE Spots (
        SpotID INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
        SpotName VARCHAR(255) NOT NULL,
        SpotLatitude DOUBLE PRECISION NOT NULL,
        SpotLongitude DOUBLE PRECISION NOT NULL,
        SpotType INT NOT NULL,
        SpotDescription varchar(511)
        )";
    
    // Run the create table command (Already done)
    // $pdo->query($createTable);
    
    // Rows to insert
    $insertRow1 = insertRow('First-Aid Kit Spot', 43.26350049157633, -79.91766767857462, 0, 'This First-Aid kit is located at MUSC.');
    $insertRow2 = insertRow('First-Aid Kit Spot', 43.26278765892196, -79.91766372192467, 0, 'This First-Aid kit is located at Mills.');

    // Add the row to the dataase
    // $pdo->query($insertRow2);

    // Get table rows
    $getTable = $pdo->query("SELECT * FROM Spots");

    // Print table rows
    while ($row = $getTable->fetch()) {
        echo $row['SpotID'] . "\n";
        echo $row['SpotLatitude'] . "\n";
        echo $row['SpotLongitude'] . "\n";
        echo $row['SpotType'] . "\n";
        echo $row['SpotDescription'] . "\n";
    }

} catch (PDOException $e) {
    echo $e->getMessage() . "\n";
}

?>