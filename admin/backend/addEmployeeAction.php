<?php
require_once '../../db/connect.php';

try {
    // Get the raw POST data
    $json = file_get_contents('php://input');
    $data = json_decode($json, true);

    if ($data === null) {
        throw new Exception("Invalid JSON data");
    }

    // Begin a transaction
    $db->beginTransaction();

    // Table name
    $tableName = 'tb_employee';

    // Prepare the SQL statements for insert and update
    $columns = array_keys($data[0]);
    $columnList = implode(", ", $columns);
    $placeholders = implode(", ", array_fill(0, count($columns), "?"));

    $insertSQL = "INSERT INTO $tableName ($columnList) VALUES ($placeholders)";
    $updateSQL = "UPDATE $tableName SET com_code = ?, prefix_thai = ?, firstname_thai = ?, lastname_thai = ?, prefix_eng = ?, firstname_eng = ?, lastname_eng = ?
    , position_name = ?, section_name = ?, sub_department_name = ?, department_name = ?, short_division_name = ?, division_name = ?, pl = ?, level_name = ?, age = ?
    , length_service = ?, company_name = ?, sub_business_unit = ?, email = ?, phone_number = ?, report_name = ?, manager_email = ?, cost_center = ?
    , org_id = ?, location_name = ?, role_id = ?, status_name = ? WHERE emp_code = ?";

    $insertStmt = $db->prepare($insertSQL);
    $updateStmt = $db->prepare($updateSQL);

    // Execute the appropriate statement for each row
    foreach ($data as $row) {
        // Check if emp_code already exists
        $checkSQL = "SELECT COUNT(*) FROM $tableName WHERE emp_code = ?";
        $checkStmt = $db->prepare($checkSQL);
        $checkStmt->execute([$row['emp_code']]);
        $exists = $checkStmt->fetchColumn();

        if ($exists) {
            // Update existing record
            $updateStmt->execute([$row['com_code'], $row['prefix_thai'], $row['firstname_thai'], $row['lastname_thai'], $row['prefix_eng'], $row['firstname_eng']
            , $row['lastname_eng'], $row['position_name'], $row['section_name'], $row['sub_department_name'], $row['department_name'], $row['short_division_name']
            , $row['division_name'], $row['pl'], $row['level_name'], $row['age'], $row['length_service'], $row['company_name'], $row['sub_business_unit']
            , $row['email'], $row['phone_number'], $row['report_name'], $row['manager_email'], $row['cost_center'], $row['org_id'], $row['location_name']
            , $row['role_id'], $row['status_name'], $row['emp_code']]);
        } else {
            // Insert new record
            $insertStmt->execute(array_values($row));
        }
    }

    // Commit the transaction
    $db->commit();
    echo "Data successfully imported to the database.";

} catch (Exception $e) {
    // Rollback the transaction if something went wrong
    if ($db->inTransaction()) {
        $db->rollBack();
    }
    echo "Failed: " . $e->getMessage();
}
?>

