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
    $insertRow3 = insertRow('First-Aid Kit Spot', 43.26209985774714, -79.92019797028367, 0, 'This First-Aid kit is located at BSB.');
    $insertRow4 = insertRow('Emergency Telephone Spot', 43.263422451519816, -79.91762002305562, 1, 'This Emergency Telephone is located at Musc.');
    $insertRow5 = insertRow('Emergency Telephone Spot', 43.26276359358968, -79.91758481896233, 1, 'This Emergency Telephone is located at Mills.');
    $insertRow6 = insertRow('Emergency Telephone Spot', 43.261894130582725, -79.92020484788813, 1, 'This Emergency Telephone is located at BSB.');


    // Add the row to the database
    // $pdo->query($insertRow6);

    if (htmlspecialchars($_GET["table"]) === "spots") {
        echo "table";
//     if (True) {
        // Get table rows
        $getTable = $pdo->query("SELECT * FROM Spots");

        // Create file for spots
        $spots = fopen("spots.txt", "w") or die("Unable to open file!");

        // Loop through the rows
        while ($row = $getTable->fetch()) {
            // Print table row
            $txt = $row['SpotID'] . ", " . $row['SpotName'] . ", " . $row['SpotLatitude'] . ", " . $row['SpotLongitude'] . ", " . $row['SpotType'] . ", " . $row['SpotDescription'] . "\n";
            echo $txt;

            // Save the row to file
            fwrite($spots, $txt);
        }

        // Close the file
        fclose($spots);
    }



} catch (PDOException $e) {
    echo $e->getMessage() . "\n";
}

?>