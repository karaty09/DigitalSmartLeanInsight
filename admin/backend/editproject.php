<?php
require_once '../../db/connect.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $productid = $_POST['product_id'];
    $projecttitle = $_POST['project_title'];
    // $groupname = $_POST['group'];
    // $impact = $_POST['impact'];
    $description = $_POST['description'];
    $projectsponsor = $_POST['project_sponsor'];
    $budget = $_POST['budget'];
    $estvalues = $_POST['est_values'];
    $keystakaholders = $_POST['key_stakeholders'];
    $keyactivities = $_POST['key_activities'];
    $kpileanmandays = $_POST['kpi_lean_mandays'];
    $startdate = $_POST['start_date'];
    $enddate = $_POST['end_date'];
    $targetcompletion_date = $_POST['target_completion_date'];
    $actualcompletion_date = $_POST['actual_completion_date'];
    $kpiresult = $_POST['kpi_result'];

    // $targetDir = "../../assets/img/imgProfile/";
    // $targetFilePath = $targetDir . $image_profile;
    // move_uploaded_file($_FILES['imageFile']['tmp_name'], $targetFilePath);

    try {
        $stmt = $db->prepare("UPDATE tb_product SET project_title = :project_title, description = :description, project_sponsor = :project_sponsor, budget = :budget,
        est_values = :est_values, key_stakeholders = :key_stakeholders, key_activities = :key_activities, kpi_lean_mandays = :kpi_lean_mandays, start_date = :start_date, end_date = :end_date, target_completion_date = :target_completion_date, actual_completion_date = :actual_completion_date, kpi_result = :kpi_result WHERE product_id = :product_id");
        $stmt->bindParam(':product_id', $productid);
        $stmt->bindParam(':project_title', $projecttitle);
        // $stmt->bindParam(':group_name', $groupname);
        // $stmt->bindParam(':impact', $impact);
        $stmt->bindParam(':description', $description);
        $stmt->bindParam(':project_sponsor', $projectsponsor);
        $stmt->bindParam(':budget', $budget);
        $stmt->bindParam(':est_values', $estvalues);
        $stmt->bindParam(':key_stakeholders', $keystakaholders);
        $stmt->bindParam(':key_activities', $keyactivities);
        $stmt->bindParam(':kpi_lean_mandays', $kpileanmandays);
        $stmt->bindParam(':start_date', $startdate);
        $stmt->bindParam(':end_date', $enddate);
        $stmt->bindParam(':target_completion_date', $targetcompletion_date);
        $stmt->bindParam(':actual_completion_date', $actualcompletion_date);
        $stmt->bindParam(':kpi_result', $kpiresult);
        $stmt->execute();
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
}
?>
