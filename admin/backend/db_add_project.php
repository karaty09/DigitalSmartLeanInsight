<?php
require_once '../../db/connect.php';
session_start();
$fullname = $_SESSION['firstname'] . ' ' . $_SESSION['lastname'];
$company = $_SESSION['company'];
$location = $_SESSION['location'];
$year = $_SESSION['year'];
$pl_level = $_SESSION['pl_level'];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $group = $_POST['group'];
    $impact = $_POST['impact'];
    $project_title = $_POST['project_title'];
    $budget = $_POST['budget'];
    $estimated_value = $_POST['estimated_value'];
    $description = $_POST['description'];
    $key_stakeholder = $_POST['key_stakeholder'];
    $key_activities = $_POST['key_activitie'];
    $kpi_lean_manday = $_POST['kpi_lean_manday'];
    $project_sponsor = $_POST['project_sponsor'];
    $need_support = $_POST['select'];
    $start_date = $_POST['start_date'];
    $end_date = $_POST['end_date'];
    $target_completion_date = $_POST['target_completion_date'];
    $other_detail = $_POST['other_detail'];
    $emp_code = $_POST['emp_code'];
    $status = $_POST['status'];

    // ตั้งค่าประเภทไฟล์ที่อนุญาต
    $allowedFileTypes = array('pdf', 'drawio', 'vsdx', 'vsd');

    // รับข้อมูลไฟล์ที่อัปโหลด
    $designPDF_fileName = $_FILES['design_pdf']['name'];
    $designPDF_fileTmpName = $_FILES['design_pdf']['tmp_name'];

    $resultsPDF_fileName = $_FILES['results_pdf']['name'];
    $resultsPDF_fileTmpName = $_FILES['results_pdf']['tmp_name'];

    $system_flow_fileName = $_FILES['system_flow']['name'];
    $system_flow_fileTmpName = $_FILES['system_flow']['tmp_name'];

    // แยกนามสกุลไฟล์
    $designPDF_fileExtension = pathinfo($designPDF_fileName, PATHINFO_EXTENSION);
    $resultsPDF_fileExtension = pathinfo($resultsPDF_fileName, PATHINFO_EXTENSION);
    $system_flow_fileExtension = pathinfo($system_flow_fileName, PATHINFO_EXTENSION);

    // ตรวจสอบประเภทไฟล์
    if (in_array($designPDF_fileExtension, $allowedFileTypes) && in_array($resultsPDF_fileExtension, $allowedFileTypes) && in_array($system_flow_fileExtension, $allowedFileTypes)) {
        $designPDF_targetDir = "../../assets/data/idea_pdf/";
        $designPDF_targetFilePath = $designPDF_targetDir . $designPDF_fileName;

        $resultsPDF_targetDir = "../../assets/data/result_pdf/";
        $resultsPDF_targetFilePath = $resultsPDF_targetDir . $resultsPDF_fileName;

        $system_flow_targetDir = "../../assets/data/system_flow/";
        $system_flow_targetFilePath = $system_flow_targetDir . $system_flow_fileName;

        // ย้ายไฟล์ที่อัปโหลดไปยังตำแหน่งที่ต้องการ
        if (move_uploaded_file($designPDF_fileTmpName, $designPDF_targetFilePath) && move_uploaded_file($resultsPDF_fileTmpName, $resultsPDF_targetFilePath) && move_uploaded_file($system_flow_fileTmpName, $system_flow_targetFilePath)) {
            echo "ไฟล์อัปโหลดสำเร็จ";
        } else {
            echo "เกิดข้อผิดพลาดในการอัปโหลดไฟล์";
        }
    } else {
        echo "ประเภทไฟล์ไม่ได้รับอนุญาต";
    }

    // SQL query
    $sql = "INSERT INTO tb_product 
            (group_name, project_title, description, key_stakeholders, impact, start_date, end_date, project_sponsor, 
            key_activities, budget, est_values, kpi_lean_mandays, need_support, target_completion_date, attach_design_pdf, 
            attach_result_pdf, system_flow, other_detail, com_code, emp_name, location, year, pl_level, status, emp_code)
            VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

    // เตรียม statement
    $stmt = $db->prepare($sql);

    // ข้อมูลที่จะใช้ใน query
    $params = array(
        $group, $project_title, $description, $key_stakeholder, $impact, $start_date, $end_date, $project_sponsor, $key_activities, 
        $budget, $estimated_value, $kpi_lean_manday, $need_support, $target_completion_date, $designPDF_fileName, $resultsPDF_fileName,
        $system_flow_fileName, $other_detail, $company, $fullname, $location, $year, $pl_level, $status, $emp_code
    );

    // ดำเนินการ statement พร้อมกับ parameter
    $stmt->execute($params);

    header("Location: ../homeAdmin.php");
}
