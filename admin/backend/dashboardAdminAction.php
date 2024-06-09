<?php
$searchCompany = 'Is Not Null';
$searchDepartment = 'Is Not Null';
$searchSection = 'Is Not Null';
$start_date = '2024-01-01';
$end_date = '2024-12-31';

// Card 1  
function getLevelS3S4($db, $start_date, $end_date, $searchDepartment, $searchSection, $searchCompany)
{
    $searchCompanyTrimmed = trim($searchCompany); // ตัดช่องว่างที่อยู่ด้านหน้าและด้านหลังของ string

    $sql = "SELECT COUNT(e.level_name) AS total_s3_s4 FROM tb_employee e 
    LEFT JOIN tb_product p ON p.emp_code = e.emp_code WHERE p.start_date BETWEEN :start_date AND :end_date AND e.level_name LIKE 'S3%'";

    if ($searchDepartment !== null && $searchDepartment !== 'Is Not Null') {
        $sql .= " AND e.department_name = :searchDepartment";
    }

    if ($searchSection !== null && $searchSection !== 'Is Not Null') {
        $sql .= " AND e.section_name = :searchSection";
    }

    if ($searchCompany !== null && $searchCompany !== 'Is Not Null') {
        $sql .= " AND e.company_name = :searchCompany";
    }

    $stmt = $db->prepare($sql);
    $stmt->bindParam(':start_date', $start_date);
    $stmt->bindParam(':end_date', $end_date);

    if ($searchDepartment !== null && $searchDepartment !== 'Is Not Null') {
        $stmt->bindParam(':searchDepartment', $searchDepartment);
    }

    if ($searchSection !== null && $searchSection !== 'Is Not Null') {
        $stmt->bindParam(':searchSection', $searchSection);
    }

    if ($searchCompany !== null && $searchCompany !== 'Is Not Null') {
        $stmt->bindParam(':searchCompany', $searchCompanyTrimmed);
    }

    $stmt->execute();
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
    return $row['total_s3_s4'];
}

// Card 2 
function getLevelS1S2($db, $start_date, $end_date, $searchDepartment, $searchSection, $searchCompany)
{
    $searchCompanyTrimmed = trim($searchCompany); // ตัดช่องว่างที่อยู่ด้านหน้าและด้านหลังของ string

    $sql = "SELECT COUNT(e.level_name) AS total_s1_s2 FROM tb_employee e 
    LEFT JOIN tb_product p ON p.emp_code = e.emp_code WHERE p.start_date BETWEEN :start_date AND :end_date AND e.level_name LIKE 'S1%'";

    if ($searchDepartment !== null && $searchDepartment !== 'Is Not Null') {
        $sql .= " AND e.department_name = :searchDepartment";
    }

    if ($searchSection !== null && $searchSection !== 'Is Not Null') {
        $sql .= " AND e.section_name = :searchSection";
    }

    if ($searchCompany !== null && $searchCompany !== 'Is Not Null') {
        $sql .= " AND e.company_name = :searchCompany";
    }

    $stmt = $db->prepare($sql);
    $stmt->bindParam(':start_date', $start_date);
    $stmt->bindParam(':end_date', $end_date);

    if ($searchDepartment !== null && $searchDepartment !== 'Is Not Null') {
        $stmt->bindParam(':searchDepartment', $searchDepartment);
    }

    if ($searchSection !== null && $searchSection !== 'Is Not Null') {
        $stmt->bindParam(':searchSection', $searchSection);
    }

    if ($searchCompany !== null && $searchCompany !== 'Is Not Null') {
        $stmt->bindParam(':searchCompany', $searchCompanyTrimmed);
    }

    $stmt->execute();
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
    return $row['total_s1_s2'];
}

// Card 3  
function getLevelO3O5($db, $start_date, $end_date, $searchDepartment, $searchSection, $searchCompany)
{
    $searchCompanyTrimmed = trim($searchCompany); // ตัดช่องว่างที่อยู่ด้านหน้าและด้านหลังของ string

    $sql = "SELECT COUNT(e.level_name) AS total_o3_o5 FROM tb_employee e
    LEFT JOIN  tb_product p ON p.emp_code = e.emp_code WHERE p.start_date BETWEEN :start_date AND :end_date AND e.level_name LIKE 'O3%'";

    if ($searchDepartment !== null && $searchDepartment !== 'Is Not Null') {
        $sql .= " AND e.department_name = :searchDepartment";
    }

    if ($searchSection !== null && $searchSection !== 'Is Not Null') {
        $sql .= " AND e.section_name = :searchSection";
    }

    if ($searchCompany !== null && $searchCompany !== 'Is Not Null') {
        $sql .= " AND e.company_name = :searchCompany";
    }

    $stmt = $db->prepare($sql);
    $stmt->bindParam(':start_date', $start_date);
    $stmt->bindParam(':end_date', $end_date);

    if ($searchDepartment !== null && $searchDepartment !== 'Is Not Null') {
        $stmt->bindParam(':searchDepartment', $searchDepartment);
    }

    if ($searchSection !== null && $searchSection !== 'Is Not Null') {
        $stmt->bindParam(':searchSection', $searchSection);
    }

    if ($searchCompany !== null && $searchCompany !== 'Is Not Null') {
        $stmt->bindParam(':searchCompany', $searchCompanyTrimmed);
    }

    $stmt->execute();
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
    return $row['total_o3_o5'];
}

// Card 4
function getESTValue($db, $start_date, $end_date, $searchDepartment, $searchSection, $searchCompany)
{
    $searchCompanyTrimmed = trim($searchCompany); // ตัดช่องว่างที่อยู่ด้านหน้าและด้านหลังของ string
    $sql = "SELECT SUM(p.est_values) AS total_est FROM tb_product p
    LEFT JOIN tb_employee e ON e.emp_code = p.emp_code WHERE p.start_date BETWEEN :start_date AND :end_date";
    if ($searchDepartment !== null && $searchDepartment !== 'Is Not Null') {
        $sql .= " AND e.department_name = :searchDepartment";
    }

    if ($searchSection !== null && $searchSection !== 'Is Not Null') {
        $sql .= " AND e.section_name = :searchSection";
    }

    if ($searchCompany !== null && $searchCompany !== 'Is Not Null') {
        $sql .= " AND e.company_name = :searchCompany";
    }
    $stmt = $db->prepare($sql);
    $stmt->bindParam(':start_date', $start_date);
    $stmt->bindParam(':end_date', $end_date);
    if ($searchDepartment !== null && $searchDepartment !== 'Is Not Null') {
        $stmt->bindParam(':searchDepartment', $searchDepartment);
    }
    if ($searchSection !== null && $searchSection !== 'Is Not Null') {
        $stmt->bindParam(':searchSection', $searchSection);
    }
    if ($searchCompany !== null && $searchCompany !== 'Is Not Null') {
        $stmt->bindParam(':searchCompany', $searchCompanyTrimmed);
    }
    $stmt->execute();
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
    return $row['total_est'];
}

// Chart 1
function getImpactData($db, $start_date, $end_date, $searchDepartment, $searchSection, $searchCompany)
{
    $searchCompanyTrimmed = trim($searchCompany); // ตัดช่องว่างที่อยู่ด้านหน้าและด้านหลังของ string

    $sql = "SELECT p.impact, COUNT(impact) AS total_impact FROM tb_product p 
    LEFT JOIN tb_employee e  ON e.emp_code = p.emp_code WHERE p.start_date BETWEEN :start_date AND :end_date";

    if ($searchDepartment !== null && $searchDepartment !== 'Is Not Null') {
        $sql .= " AND e.department_name = :searchDepartment";
    }

    if ($searchSection !== null && $searchSection !== 'Is Not Null') {
        $sql .= " AND e.section_name = :searchSection";
    }

    if ($searchCompany !== null && $searchCompany !== 'Is Not Null') {
        $sql .= " AND e.company_name = :searchCompany";
    }

    $sql .= " GROUP BY p.impact ORDER BY total_impact DESC";

    // Prepare and execute the statement
    $stmt = $db->prepare($sql);
    $stmt->bindParam(':start_date', $start_date);
    $stmt->bindParam(':end_date', $end_date);
    if ($searchDepartment !== null && $searchDepartment !== 'Is Not Null') {
        $stmt->bindParam(':searchDepartment', $searchDepartment);
    }
    if ($searchSection !== null && $searchSection !== 'Is Not Null') {
        $stmt->bindParam(':searchSection', $searchSection);
    }
    if ($searchCompany !== null && $searchCompany !== 'Is Not Null') {
        $stmt->bindParam(':searchCompany', $searchCompanyTrimmed);
    }
    $stmt->execute();
    $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);

    $name_impact = [];
    $total_impact = [];
    $total_count = 0; // Initialize total count

    foreach ($rows as $row) {
        $name_impact[] = $row['impact'];
        $total_impact[] = $row['total_impact'];
        $total_count += $row['total_impact']; // Calculate total count
    }

    return [
        'name_impact' => $name_impact,
        'total_impact' => $total_impact,
        'total_count' => $total_count
    ];
}

// Chart 2
function getActualCompletionDateData($db, $start_date, $end_date, $searchDepartment, $searchSection, $searchCompany)
{
    $searchCompanyTrimmed = trim($searchCompany); // ตัดช่องว่างที่อยู่ด้านหน้าและด้านหลังของ string

    $sql = "SELECT p.project_title, CONVERT(VARCHAR, p.start_date, 23) AS Dates, COUNT(p.status) AS results_service FROM tb_product p 
    LEFT JOIN tb_employee e ON e.emp_code = p.emp_code WHERE p.start_date BETWEEN :start_date AND :end_date AND p.status = 'Done' ";

    if ($searchDepartment !== null && $searchDepartment !== 'Is Not Null') {
        $sql .= " AND e.department_name = :searchDepartment";
    }

    if ($searchSection !== null && $searchSection !== 'Is Not Null') {
        $sql .= " AND e.section_name = :searchSection";
    }

    if ($searchCompany !== null && $searchCompany !== 'Is Not Null') {
        $sql .= " AND SUBSTRING(e.company_name, 1, 4) = :searchCompany";
    }

    $sql .= " GROUP BY p.project_title, CONVERT(VARCHAR,p.start_date, 23) ORDER BY CONVERT(VARCHAR,p.start_date, 23) ASC";

    $stmt = $db->prepare($sql);
    $stmt->bindParam(':start_date', $start_date);
    $stmt->bindParam(':end_date', $end_date);

    // Bind parameters if they are not null and not equal to 'Is Not Null'
    if ($searchDepartment !== null && $searchDepartment !== 'Is Not Null') {
        $stmt->bindParam(':searchDepartment', $searchDepartment);
    }
    if ($searchSection !== null && $searchSection !== 'Is Not Null') {
        $stmt->bindParam(':searchSection', $searchSection);
    }
    if ($searchCompany !== null && $searchCompany !== 'Is Not Null') {
        $searchCompanyTrimmed = trim($searchCompany, "= '");
        $stmt->bindParam(':searchCompany', $searchCompanyTrimmed);
    }

    $stmt->execute();
    $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);

    // Initialize array to store project data
    $project_data = [];

    // Loop through the fetched rows
    foreach ($rows as $row) {
        $project_title = $row['project_title'];
        $results_service = $row['results_service'];
        $date = $row['Dates'];

        // Create an object to store project data
        $project = [
            'project_title' => $project_title,
            'results_service' => $results_service,
            'date' => $date
        ];

        // Add the project data object to the array
        $project_data[] = $project;
    }

    return [
        'project_data' => $project_data // Add project data to the return array
    ];
}

// Chart 3
function getNeedDigitalData($db, $start_date, $end_date, $searchDepartment, $searchSection, $searchCompany)
{
    $searchCompanyTrimmed = trim($searchCompany); // ตัดช่องว่างที่อยู่ด้านหน้าและด้านหลังของ string

    $sql = "SELECT e.division_name, COUNT(p.need_support) AS total_need FROM tb_product p 
    LEFT JOIN tb_employee e  ON e.emp_code = p.emp_code WHERE p.start_date BETWEEN :start_date AND :end_date";

    // Add filters based on user input
    if ($searchDepartment !== null && $searchDepartment !== 'Is Not Null') {
        $sql .= " AND e.department_name = :searchDepartment";
    }

    if ($searchSection !== null && $searchSection !== 'Is Not Null') {
        $sql .= " AND e.section_name = :searchSection";
    }

    if ($searchCompany !== null && $searchCompany !== 'Is Not Null') {
        $sql .= " AND SUBSTRING(e.company_name, 1, 4) = :searchCompany";
    }

    // Complete the query with GROUP BY and ORDER BY
    $sql .= " GROUP BY e.division_name ORDER BY total_need DESC";

    $stmt = $db->prepare($sql);
    $stmt->bindParam(':start_date', $start_date);
    $stmt->bindParam(':end_date', $end_date);

    // Bind parameters if they are not null and not equal to 'Is Not Null'
    if ($searchDepartment !== null && $searchDepartment !== 'Is Not Null') {
        $stmt->bindParam(':searchDepartment', $searchDepartment);
    }
    if ($searchSection !== null && $searchSection !== 'Is Not Null') {
        $stmt->bindParam(':searchSection', $searchSection);
    }
    if ($searchCompany !== null && $searchCompany !== 'Is Not Null') {
        $searchCompanyTrimmed = trim($searchCompany, "= '");
        $stmt->bindParam(':searchCompany', $searchCompanyTrimmed);
    }

    $stmt->execute();
    $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);

    $name_need = [];
    $total_need = [];
    foreach ($rows as $row) {
        $name_need[] = $row['division_name'];
        $total_need[] = $row['total_need'];
    }

    return [
        'name_need' => $name_need,
        'total_need' => $total_need
    ];
}

// Chart 4
function getvalueTop5Data($db, $start_date, $end_date, $searchDepartment, $searchSection, $searchCompany)
{
    $searchCompanyTrimmed = trim($searchCompany); // ตัดช่องว่างที่อยู่ด้านหน้าและด้านหลังของ string

    $sql = "SELECT p.project_title, SUM(p.est_values) AS total_Actual 
    FROM tb_product p LEFT JOIN tb_employee e ON e.emp_code = p.emp_code 
    WHERE p.start_date BETWEEN :start_date AND :end_date";
    // Add filters based on user input
    if ($searchDepartment !== null && $searchDepartment !== 'Is Not Null') {
        $sql .= " AND e.department_name = :searchDepartment";
    }

    if ($searchSection !== null && $searchSection !== 'Is Not Null') {
        $sql .= " AND e.section_name = :searchSection";
    }

    if ($searchCompany !== null && $searchCompany !== 'Is Not Null') {
        $sql .= " AND SUBSTRING(e.company_name, 1, 4) = :searchCompany";
    }

    $sql .= " GROUP BY p.project_title, p.start_date ORDER BY total_Actual DESC";
    $stmt = $db->prepare($sql);
    $stmt->bindParam(':start_date', $start_date);
    $stmt->bindParam(':end_date', $end_date);

    // Bind parameters if they are not null and not equal to 'Is Not Null'
    if ($searchDepartment !== null && $searchDepartment !== 'Is Not Null') {
        $stmt->bindParam(':searchDepartment', $searchDepartment);
    }
    if ($searchSection !== null && $searchSection !== 'Is Not Null') {
        $stmt->bindParam(':searchSection', $searchSection);
    }
    if ($searchCompany !== null && $searchCompany !== 'Is Not Null') {
        $searchCompanyTrimmed = trim($searchCompany, "= '");
        $stmt->bindParam(':searchCompany', $searchCompanyTrimmed);
    }

    $stmt->execute();
    $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);

    $name_Actual = [];
    $total_Actual = [];
    foreach ($rows as $row) {
        $name_Actual[] = $row['project_title'];
        $total_Actual[] = $row['total_Actual'];
    }

    return [
        'name_Actual' => $name_Actual,
        'total_Actual' => $total_Actual
    ];
}

function getTableData($db, $start_date, $end_date, $searchDepartment, $searchSection, $searchCompany)
{
    $searchCompanyTrimmed = trim($searchCompany); // ตัดช่องว่างที่อยู่ด้านหน้าและด้านหลังของ string

    // ตาราง เปลี่ยนการ Query ใหม่
    $sql = "SELECT e.prefix_thai, e.firstname_thai, e.lastname_thai, e.emp_code, e.location_name, e.division_name, e.department_name, e.section_name,
    p.product_id, p.impact, p.budget, p.est_values, p.pl_level, p.group_name, p.project_title, p.description, p.key_stakeholders, p.system_flow, p.start_date,
    p.end_date, p.project_sponsor, p.key_activities, p.kpi_lean_mandays, p.attach_design_pdf, p.target_completion_date, p.actual_completion_date, 
    p.attach_result_pdf, p.need_support, p.area FROM tb_product p INNER JOIN tb_employee e ON p.emp_code = e.emp_code 
    WHERE start_date BETWEEN :start_date AND :end_date";

    if ($searchDepartment !== null && $searchDepartment !== 'Is Not Null') {
        $sql .= " AND e.department_name = :searchDepartment";
    }
    if ($searchSection !== null && $searchSection !== 'Is Not Null') {
        $sql .= " AND e.section_name = :searchSection";
    }
    if ($searchCompany !== null && $searchCompany !== 'Is Not Null') {
        $sql .= " AND e.company_name = :searchCompany";
    }

    $stmt = $db->prepare($sql);
    $stmt->bindParam(':start_date', $start_date);
    $stmt->bindParam(':end_date', $end_date);

    // Bind parameters if they are not null and not equal to 'Is Not Null'
    if ($searchDepartment !== null && $searchDepartment !== 'Is Not Null') {
        $stmt->bindParam(':searchDepartment', $searchDepartment);
    }

    if ($searchSection !== null && $searchSection !== 'Is Not Null') {
        $stmt->bindParam(':searchSection', $searchSection);
    }

    if ($searchCompany !== null && $searchCompany !== 'Is Not Null') {
        $stmt->bindParam(':searchCompany', $searchCompanyTrimmed);
    }

    $stmt->execute();
    $row = $stmt->fetchAll(PDO::FETCH_ASSOC);
    return $row;
}

// Get Started Data for Card and Chart
$total_level_s3s4 = getLevelS3S4($db, $start_date, $end_date, $searchDepartment, $searchSection, $searchCompany);
$total_level_s1s2 = getLevelS1S2($db, $start_date, $end_date, $searchDepartment, $searchSection, $searchCompany);
$total_level_o3o5 = getLevelO3O5($db, $start_date, $end_date, $searchDepartment, $searchSection, $searchCompany);
$total_est_value = getESTValue($db, $start_date, $end_date, $searchDepartment, $searchSection, $searchCompany);

$impactData = getImpactData($db, $start_date, $end_date, $searchDepartment, $searchSection, $searchCompany);
$name_impact = $impactData['name_impact'];
$total_impact = $impactData['total_impact'];
$total_count = $impactData['total_count'];

$actualCompletionDateData = getActualCompletionDateData($db, $start_date, $end_date, $searchDepartment, $searchSection, $searchCompany);
$project_data = $actualCompletionDateData['project_data'];

$needDigitalData = getNeedDigitalData($db, $start_date, $end_date, $searchDepartment, $searchSection, $searchCompany);
$name_need = $needDigitalData['name_need'];
$total_need = $needDigitalData['total_need'];

$valueTop5Data = getvalueTop5Data($db, $start_date, $end_date, $searchDepartment, $searchSection, $searchCompany);
$name_Actual = $valueTop5Data['name_Actual'];
$total_Actual = $valueTop5Data['total_Actual'];

$tableData = getTableData($db, $start_date, $end_date, $searchDepartment, $searchSection, $searchCompany);

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['submit'])) {
    $start_date = $_POST['start-date'];
    $end_date = $_POST['end-date'];
    $searchCompany = $_POST['searchCompany'];
    $searchDepartment = $_POST['searchDepartment'];
    $searchSection = $_POST['searchSection'];

    // ทำต่อไปตามความเหมาะสม เช่น การใช้ค่าที่ได้รับในการสร้าง query สำหรับค้นหาในฐานข้อมูล
    $total_level_s3s4 = getLevelS3S4($db, $start_date, $end_date, $searchDepartment, $searchSection, $searchCompany);
    $total_level_s1s2 = getLevelS1S2($db, $start_date, $end_date, $searchDepartment, $searchSection, $searchCompany);
    $total_level_o3o5 = getLevelO3O5($db, $start_date, $end_date, $searchDepartment, $searchSection, $searchCompany);
    $total_est_value = getESTValue($db, $start_date, $end_date, $searchDepartment, $searchSection, $searchCompany);

    $impactData = getImpactData($db, $start_date, $end_date, $searchDepartment, $searchSection, $searchCompany);
    $name_impact = $impactData['name_impact'];
    $total_impact = $impactData['total_impact'];
    $total_count = $impactData['total_count'];

    $actualCompletionDateData = getActualCompletionDateData($db, $start_date, $end_date, $searchDepartment, $searchSection, $searchCompany);
    $project_data = $actualCompletionDateData['project_data'];

    $needDigitalData = getNeedDigitalData($db, $start_date, $end_date, $searchDepartment, $searchSection, $searchCompany);
    $name_need = $needDigitalData['name_need'];
    $total_need = $needDigitalData['total_need'];

    $valueTop5Data = getvalueTop5Data($db, $start_date, $end_date, $searchDepartment, $searchSection, $searchCompany);
    $name_Actual = $valueTop5Data['name_Actual'];
    $total_Actual = $valueTop5Data['total_Actual'];

    $tableData = getTableData($db, $start_date, $end_date, $searchDepartment, $searchSection, $searchCompany);
}

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['all'])) {
    $searchCompany = 'Is Not Null';
    $searchDepartment = 'Is Not Null';
    $searchSection = 'Is Not Null';
    $start_date = '2024-01-01';
    $end_date = '2024-12-31';

    // ทำต่อไปตามความเหมาะสม เช่น การใช้ค่าที่ได้รับในการสร้าง query สำหรับค้นหาในฐานข้อมูล
    $total_level_s3s4 = getLevelS3S4($db, $start_date, $end_date, $searchDepartment, $searchSection, $searchCompany);
    $total_level_s1s2 = getLevelS1S2($db, $start_date, $end_date, $searchDepartment, $searchSection, $searchCompany);
    $total_level_o3o5 = getLevelO3O5($db, $start_date, $end_date, $searchDepartment, $searchSection, $searchCompany);
    $total_est_value = getESTValue($db, $start_date, $end_date, $searchDepartment, $searchSection, $searchCompany);

    $impactData = getImpactData($db, $start_date, $end_date, $searchDepartment, $searchSection, $searchCompany);
    $name_impact = $impactData['name_impact'];
    $total_impact = $impactData['total_impact'];
    $total_count = $impactData['total_count'];

    $actualCompletionDateData = getActualCompletionDateData($db, $start_date, $end_date, $searchDepartment, $searchSection, $searchCompany);
    $project_data = $actualCompletionDateData['project_data'];

    $needDigitalData = getNeedDigitalData($db, $start_date, $end_date, $searchDepartment, $searchSection, $searchCompany);
    $name_need = $needDigitalData['name_need'];
    $total_need = $needDigitalData['total_need'];

    $valueTop5Data = getvalueTop5Data($db, $start_date, $end_date, $searchDepartment, $searchSection, $searchCompany);
    $name_Actual = $valueTop5Data['name_Actual'];
    $total_Actual = $valueTop5Data['total_Actual'];

    $tableData = getTableData($db, $start_date, $end_date, $searchDepartment, $searchSection, $searchCompany);
}
