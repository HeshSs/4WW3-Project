<?php

$servername = "ww3-database.cp0wobp38lvg.us-east-2.rds.amazonaws.com";
$database = "WW3_database";
$username = "admin";
$password = "adminadmin";
$charset = "utf8mb4";

try {

$dsn = "mysql:host=$servername;dbname=$database;charset=$charset";
$pdo = new PDO($dsn, $username, $password);
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

echo "Connection Okay";

return $pdo;

}

catch (PDOException $e)

{
echo "Connection failed: ". $e->getMessage();
}

?>