<?php
$dbport = "3306";
$servername = "ww3-database.cp0wobp38lvg.us-east-2.rds.amazonaws.com";
$database = "WW3_database";
$username = "admin";
$password = "adminadmin";
$charset = 'utf8' ;

try {

    $dsn = "mysql:host=$servername;port=$dbport;dbname=$database;charset=$charset";
    $pdo = new PDO($dsn, $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    echo "Connection Okay\n";

} catch (PDOException $e) {
    echo "Connection failed: ". $e->getMessage() . "\n";
}

try {

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
    
    // SQL Command to insert row
    $insertValues = "INSERT INTO Spots (SpotName, SpotLatitude, SpotLongitude, SpotType, SpotDescription)
                    VALUES ('First-Aid Kit Spot', 43.26350049157633, -79.91766767857462, 0, 'This First-Aid kit is located at MUSC.')";

    // Run the insert row command
    // $pdo->query($insertValues);


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