<?php

$host = "localhost";
$database = "userOrigenDeLosMemes";
$user = "root";
$password = "Maullino1011";

try {
  $conn = new PDO("mysql:host=$host;dbname=$database", $user, $password);
  // foreach ($conn->query("SHOW DATABASES") as $row) {
  //  print_r($row);
  //}
  //die();
} catch (PDOException $e) {
  die("PDO Connection Error: " . $e->getMessage());
}