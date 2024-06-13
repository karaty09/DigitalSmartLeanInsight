<?php
require_once '../../db/connect.php';

$searchCompany = isset($_GET['searchCompany']) ? $_GET['searchCompany'] : '';

if ($searchCompany !== '') {
    $searchCompany_query = "SELECT DISTINCT department_name FROM tb_employee WHERE company_name = :company_name";
    $stmt = $db->prepare($searchCompany_query);
    $stmt->bindParam(':company_name', $searchCompany);
} else {
    $searchCompany_query = "SELECT DISTINCT department_name FROM tb_employee";
    $stmt = $db->prepare($searchCompany_query);
}

$stmt->execute();
$results = $stmt->fetchAll(PDO::FETCH_ASSOC);
echo json_encode($results);

?>
