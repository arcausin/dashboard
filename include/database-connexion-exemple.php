<?php
$servername = "localhost";
$username = "root";
$password = "";
$databasename = "dashboard";
$encoding = "utf8";

try {
  $conn_dashboard = new PDO("mysql:host=$servername;dbname=$databasename;charset=$encoding", $username, $password);
  // set the PDO error mode to exception
  $conn_dashboard->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch(PDOException $e) {
  echo "Connection failed: " . $e->getMessage();
}
?>
