<?php
$host = $_ENV["DB_HOST"];
$user = $_ENV["DB_USER"];
$pass = $_ENV["DB_PASS"];
$db = $_ENV["DB_NAME"];
$port = $_ENV["DB_PORT"];
try {
  $koneksi = new mysqli($host, $user, $pass, $db, $port);
} catch (\Throwable $th) {
  die("Koneksi database gagal! " . $th->getMessage());
}
?>