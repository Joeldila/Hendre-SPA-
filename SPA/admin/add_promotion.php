<?php
header('Content-Type: application/json');
include 'db.php';

$data = json_decode(file_get_contents("php://input"), true);

$sql = "INSERT INTO promotions (title, description, promo_code, discount_type, discount_value, service, start_date, end_date, image_url, is_active)
        VALUES (:title, :description, :promo_code, :discount_type, :discount_value, :service, :start_date, :end_date, :image_url, :is_active)";

$stmt = $pdo->prepare($sql);
$stmt->execute([
    ':title' => $data['title'],
    ':description' => $data['description'],
    ':promo_code' => $data['promoCode'],
    ':discount_type' => $data['discountType'],
    ':discount_value' => $data['discountValue'],
    ':service' => $data['service'],
    ':start_date' => $data['startDate'],
    ':end_date' => $data['endDate'],
    ':image_url' => $data['imageUrl'],
    ':is_active' => $data['isActive'] ? 1 : 0
]);

echo json_encode(['status' => 'success']);
?>
