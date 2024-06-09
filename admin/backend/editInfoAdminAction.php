<?php
require_once '../../db/connect.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $emp_code = $_POST['username'];
    $fname = $_POST['fname'];
    $lname = $_POST['lname'];
    $position = $_POST['position'];
    $section = $_POST['section'];
    $department = $_POST['department'];
    $report_name = $_POST['report_name'];
    $image_profile = $_FILES['imageFile']['name'];

    $targetDir = "../../assets/img/imgProfile/";
    $targetFilePath = $targetDir . $image_profile;
    move_uploaded_file($_FILES['imageFile']['tmp_name'], $targetFilePath);

    $stmt = $db->prepare("UPDATE tb_employee SET firstname_thai = :firstname_thai, lastname_thai = :lastname_thai, position_name = :position_name, 
    section_name = :section_name, department_name = :department_name, report_name = :report_name, image_profile = :image_profile WHERE emp_code = :emp_code");
    $stmt->bindParam(':emp_code', $emp_code);
    $stmt->bindParam(':firstname_thai', $fname);
    $stmt->bindParam(':lastname_thai', $lname);
    $stmt->bindParam(':position_name', $position);
    $stmt->bindParam(':section_name', $section);
    $stmt->bindParam(':department_name', $department);
    $stmt->bindParam(':report_name', $report_name);
    $stmt->bindParam(':image_profile', $image_profile);
    $stmt->execute();
}
?>
