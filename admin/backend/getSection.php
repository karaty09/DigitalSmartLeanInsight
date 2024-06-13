<?php
require_once '../../db/connect.php';

$searchDepartment = isset($_GET['searchDepartment']) ? $_GET['searchDepartment'] : '';

if ($searchDepartment !== '') {
    $searchDepartment_query = "SELECT DISTINCT section_name FROM tb_employee WHERE department_name = :company_name";
    $stmt = $db->prepare($searchDepartment_query);
    $stmt->bindParam(':company_name', $searchDepartment);
} else {
    $searchDepartment_query = "SELECT DISTINCT section_name FROM tb_employee";
    $stmt = $db->prepare($searchDepartment_query);
}

$stmt->execute();
$results = $stmt->fetchAll(PDO::FETCH_ASSOC);
echo json_encode($results);

?>
