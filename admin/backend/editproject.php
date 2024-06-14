<?php
require_once '../../db/connect.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $productid = $_POST['product_id'];
    $projecttitle = $_POST['project_title'];
    $groupname = isset($_POST['group']) && !empty($_POST['group']) ? $_POST['group'] : null;
    $impact = isset($_POST['impact']) && !empty($_POST['impact']) ? $_POST['impact'] : null;
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
    $status = $_POST['status'];

    // ตั้งค่าประเภทไฟล์ที่อนุญาต
    $allowedFileTypes = array('pdf', 'drawio', 'vsdx', 'vsd');

    // รับข้อมูลไฟล์ที่อัปโหลด
    $designPDF_fileName = $_FILES['design_pdf']['name'] ?? null;
    $designPDF_fileTmpName = $_FILES['design_pdf']['tmp_name'] ?? null;
    
    $resultsPDF_fileName = $_FILES['results_pdf']['name'] ?? null;
    $resultsPDF_fileTmpName = $_FILES['results_pdf']['tmp_name'] ?? null;
    
    $system_flow_fileName = $_FILES['system_flow']['name'] ?? null;
    $system_flow_fileTmpName = $_FILES['system_flow']['tmp_name'] ?? null;

    // แยกนามสกุลไฟล์
    $designPDF_fileExtension = $designPDF_fileName ? pathinfo($designPDF_fileName, PATHINFO_EXTENSION) : null;
    $resultsPDF_fileExtension = $resultsPDF_fileName ? pathinfo($resultsPDF_fileName, PATHINFO_EXTENSION) : null;
    $system_flow_fileExtension = $system_flow_fileName ? pathinfo($system_flow_fileName, PATHINFO_EXTENSION) : null;
    
    $uploadErrors = [];

    // ย้ายไฟล์ที่อัปโหลดไปยังตำแหน่งที่ต้องการ
    if ($designPDF_fileName && in_array($designPDF_fileExtension, $allowedFileTypes)) {
        $designPDF_targetDir = "../../assets/data/idea_pdf/";
        $designPDF_targetFilePath = $designPDF_targetDir . $designPDF_fileName;
        if (!move_uploaded_file($designPDF_fileTmpName, $designPDF_targetFilePath)) {
            $uploadErrors[] = "เกิดข้อผิดพลาดในการอัปโหลดไฟล์ Design PDF";
        }
    }

    if ($resultsPDF_fileName && in_array($resultsPDF_fileExtension, $allowedFileTypes)) {
        $resultsPDF_targetDir = "../../assets/data/result_pdf/";
        $resultsPDF_targetFilePath = $resultsPDF_targetDir . $resultsPDF_fileName;
        if (!move_uploaded_file($resultsPDF_fileTmpName, $resultsPDF_targetFilePath)) {
            $uploadErrors[] = "เกิดข้อผิดพลาดในการอัปโหลดไฟล์ Results PDF";
        }
    }

    if ($system_flow_fileName && in_array($system_flow_fileExtension, $allowedFileTypes)) {
        $system_flow_targetDir = "../../assets/data/system_flow/";
        $system_flow_targetFilePath = $system_flow_targetDir . $system_flow_fileName;
        if (!move_uploaded_file($system_flow_fileTmpName, $system_flow_targetFilePath)) {
            $uploadErrors[] = "เกิดข้อผิดพลาดในการอัปโหลดไฟล์ System Flow";
        }
    }

    if (!empty($uploadErrors)) {
        echo implode("<br>", $uploadErrors);
        exit;
    }

    try {
        // Start building the SQL query
        $sql = "UPDATE tb_product SET 
            project_title = :project_title, 
            description = :description, 
            project_sponsor = :project_sponsor, 
            budget = :budget, 
            est_values = :est_values, 
            key_stakeholders = :key_stakeholders, 
            key_activities = :key_activities, 
            kpi_lean_mandays = :kpi_lean_mandays, 
            start_date = :start_date, 
            end_date = :end_date, 
            target_completion_date = :target_completion_date, 
            actual_completion_date = :actual_completion_date, 
            kpi_result = :kpi_result,
            status = :status";

        // Add group_name to the query only if it's not null
        if ($groupname !== null) {
            $sql .= ", group_name = :group_name";
        }
        // Add impact to the query only if it's not null
        if ($impact !== null) {
            $sql .= ", impact = :impact";
        }

        if ($designPDF_fileName != null) {
            $sql .= ", attach_design_pdf = :attach_design_pdf";
        } 
        
        if ($resultsPDF_fileName != null) {
            $sql .= ", attach_result_pdf = :attach_result_pdf";
        }
        
        if ($system_flow_fileName != null) {
            $sql .= ", system_flow = :system_flow";
        }

        $sql .= " WHERE product_id = :product_id";

        // Prepare the statement
        $stmt = $db->prepare($sql);

        // Bind the parameters
        $stmt->bindParam(':product_id', $productid);
        $stmt->bindParam(':project_title', $projecttitle);
        if ($groupname !== null) {
            $stmt->bindParam(':group_name', $groupname);
        }
        if ($impact !== null) {
            $stmt->bindParam(':impact', $impact);
        }
        if ($designPDF_fileName != null) {
            $stmt->bindParam(':attach_design_pdf', $designPDF_fileName);
        } 
        
        if ($resultsPDF_fileName != null) {
            $stmt->bindParam(':attach_result_pdf', $resultsPDF_fileName);
        }
        
        if ($system_flow_fileName != null) {
            $stmt->bindParam(':system_flow', $system_flow_fileName);
        }
        $stmt->bindParam(':status', $status);
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

        // Execute the statement
        $stmt->execute();

        echo "Update successful";
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
}
?>
