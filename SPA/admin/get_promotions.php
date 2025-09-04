<?php
header('Content-Type: application/json');
include 'db.php';

$stmt = $pdo->query("SELECT * FROM promotions ORDER BY id DESC");
$promotions = $stmt->fetchAll(PDO::FETCH_ASSOC);

echo json_encode($promotions);
?>
