<?php
$dataBaseServer = "localhost";
$databaseusername = "root";
$databasepaswword = "";
$databasename = "gestion_mediatheque";
try {
    $pdo = new PDO("mysql:host=$dataBaseServer;dbname=$databasename", $databaseusername, $databasepaswword);
} catch (PDOException $e) {
    die("Connection failed: " . $e->getMessage());
}
?>