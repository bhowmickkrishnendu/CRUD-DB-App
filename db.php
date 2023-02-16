<?php
error_reporting(0);

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "krish_contactdb";

// Create a PDO instance
try {
  $pdo = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
  // set the PDO error mode to exception
  $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch(PDOException $e) {
  echo "Connection failed: " . $e->getMessage();
}

// Return the PDO instance
return $pdo;
?>
