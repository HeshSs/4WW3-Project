<?php


function connect($servername, $port, $dbname, $charset, $username, $password) {
    try {

        $dsn = "mysql:host=$servername;port=$port;dbname=$dbname;charset=$charset";
        $pdo = new PDO($dsn, $username, $password);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
        echo "Connection Okay\n";
        return $pdo;
    
    } catch (PDOException $e) {
        echo "Connection failed: ". $e->getMessage() . "\n";
    }
}

function insertRow($spotName, $spotLatitude, $spotLongitude, $spotType, $spotDescription) {
    // SQL Command to insert row
    $insertValues = "INSERT INTO Spots (SpotName, SpotLatitude, SpotLongitude, SpotType, SpotDescription) 
    VALUES ('$spotName', $spotLatitude, $spotLongitude, $spotType, '$spotDescription')";

    // Run the insert row command
    return $insertValues;
}
?>