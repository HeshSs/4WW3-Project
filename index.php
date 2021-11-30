<?php
// $dbhost = $_SERVER['ww3-database.cp0wobp38lvg.us-east-2.rds.amazonaws.com'];
$dbport = "3306";
// $dbname = $_SERVER['WW3_database'];
$servername = "ww3-database.cp0wobp38lvg.us-east-2.rds.amazonaws.com";
$database = "WW3_database";
$username = "admin";
$password = "adminadmin";
// $charset = "utf8mb4";

$charset = 'utf8' ;

try {

// $dsn = "mysql:host={$dbhost};port={$dbport};dbname={$dbname};charset={$charset}";
$dsn = "mysql:host=$servername;port=$dbport;dbname=$database;charset=$charset";
$pdo = new PDO($dsn, $username, $password);
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

echo "Connection Okay\n";

return $pdo;

}

catch (PDOException $e)

{
echo "Connection failed: ". $e->getMessage() . "\n";
}

?>