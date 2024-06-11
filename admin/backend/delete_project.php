<?php
require_once '../../db/connect.php';

header('Content-Type: application/json');

$data = json_decode(file_get_contents('php://input'), true);

if (isset($data['id'])) {
    $productId = $data['id'];
    
    $sql = "DELETE FROM tb_product WHERE product_id = :product_id";
    $stmt = $db->prepare($sql);
    $stmt->bindParam(':product_id', $productId, PDO::PARAM_INT);

    if ($stmt->execute()) {
        echo json_encode(['success' => true]);
    } else {
        echo json_encode(['success' => false, 'error' => 'Failed to execute statement']);
    }
} else {
    echo json_encode(['success' => false, 'error' => 'Invalid ID']);
}
?>
