<?php
header('Content-Type: application/json');
include 'db.php';

$data = json_decode(file_get_contents("php://input"), true);
$id = $data['id'];

$sql = "UPDATE promotions SET
        title = :title,
        description = :description,
        promo_code = :promo_code,
        discount_type = :discount_type,
        discount_value = :discount_value,
        service = :service,
        start_date = :start_date,
        end_date = :end_date,
        image_url = :image_url,
        is_active = :is_active
        WHERE id = :id";

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
    ':is_active' => $data['isActive'] ? 1 : 0,
    ':id' => $id
]);

echo json_encode(['status' => 'success']);
?>
