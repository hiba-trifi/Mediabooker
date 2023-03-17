<?php 
require_once '../includes/dbh.inc.php';
error_reporting(E_ERROR | E_PARSE);
session_start();
$id_mb = $_SESSION["Id"];

$stmt = $pdo->prepare("DELETE FROM reservation WHERE id_mb = :id_mb");
$stmt->bindParam(':id_mb', $id_mb);
$stmt->execute();

$stmt = $pdo->prepare("DELETE FROM member WHERE id_mb = :id_mb");
$stmt->bindParam(':id_mb', $id_mb);
$stmt->execute();

session_destroy();
header('location:./landing_page_user.php');
?>