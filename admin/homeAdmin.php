<?php
require_once '../db/connect.php';
session_start();
$username = $_SESSION['user_login'];
$role = $_SESSION['role'];
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>หน้าหลัก</title>

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

    <!-- Google Font -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Sarabun&display=swap" rel="stylesheet">

    <!-- CSS Style -->
    <link rel="stylesheet" href="../assets/src/styles/stylesBody.css">
    <link rel="stylesheet" href="../assets/src/styles/stylesMenu.css">
    <link rel="stylesheet" href="../admin/styles/stylesHomeAdmin.css">
</head>
<style>
    /* ซ่อนการกรอกข้อมูล */
    .hidden {
        display: none;
    }
</style>

<body>

    <!-- Navbar -->
    <?php include '../admin/navbarAdmin.php' ?>

    <!-- Title -->
    <?php include '../assets/src/title.php' ?>

    <!-- Content -->
    <?php include '../assets/src/menu.php' ?>

    <!-- Search Box -->
    <div class="container d-flex justify-content-center mt-5">
        <form class="form-inline d-flex">
            <div class="form-group mb-2 me-2">
                <input type="text" class="form-control" id="searchInput" placeholder="Search">
            </div>
            <button type="submitserch" class="btn btn-primary mb-2">Search</button>
        </form>
    </div>

    <div class="container">
        <h5 class="text-left">ข้อมูลทั้งหมด</h5><br>
    </div>

    <div class="container mb-3">
        <div style="overflow-x:auto;">
            <table class="table custom-table" id="tb-data">
                <thead>
                    <tr class="text-center">
                        <th class="align-middle">No.</th>
                        <th class="align-middle">Edit</th>
                        <!-- <th class="align-middle">Comment</th> -->
                        <th class="align-middle">Location</th>
                        <th class="align-middle">Impact</th>
                        <th class="align-middle">Butget</th>
                        <th class="align-middle">EST Values</th>
                        <th class="align-middle">Emp Name</th>
                        <th class="align-middle">PL Level</th>
                        <th class="align-middle">Group</th>
                        <th class="align-middle">Project Title</th>
                        <th class="align-middle">Discription</th>
                        <th class="align-middle">Key Stakeholders</th>
                        <th class="align-middle">System Flow</th>
                        <th class="align-middle">Stat Date</th>
                        <th class="align-middle">End Date</th>
                        <th class="align-middle">Team Project</th>
                        <th class="align-middle">Key Activities</th>
                        <th class="align-middle">KPI / Lean Mandays</th>
                        <th class="align-middle">Attach Idea</th>
                        <th class="align-middle">Target Completion Date</th>
                        <th class="align-middle">Actual Completion Date</th>
                        <th class="align-middle">Attach Results PDF</th>
                        <th class="align-middle">%KPL Results</th>
                        <th class="align-middle">Division</th>
                        <th class="align-middle">Department</th>
                        <th class="align-middle">Section</th>
                        <th class="align-middle">Status</th>
                        <th class="align-middle">Need Support</th>
                        <!-- <th class="align-middle">Area</th> -->
                    </tr>
                </thead>
                <tbody class="text-center">
                    <?php
                    $no = 1;
                    $sql = "SELECT * FROM tb_product p JOIN tb_employee e ON p.emp_code = e.emp_code";
                    $stmt = $db->prepare($sql);
                    $stmt->execute();
                    $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
                    if (!empty($results)) {
                        foreach ($results as $row) {
                            $modalId = 'detail_' . $row['product_id'];
                            $modalEdit = 'edit_' . $row['product_id'];
                            echo '<tr>';
                            echo '<td class="text-left">' . $no . '</td>'; // เพิ่มคอลัมน์ No.
                            echo '<td class="text-left">
                                    <div class="button-container">
                                        <button type="button" class="btn btn-circle btn-yellow" data-bs-toggle="modal" data-bs-target="#' . $modalEdit . '">
                                            <i class="bi bi-pencil"></i>
                                        </button>
                                        <button type="button" class="btn btn-circle btn-red delete-btn" data-id="' . $row['product_id'] . '">
                                            <i class="bi bi-trash"></i>
                                        </button>
                                    </div>
                                </td>';
                            echo '<!-- ModalEdit -->
                            <form id="' . $row['product_id'] . '" method="post" enctype="multipart/form-data">
                                <div class="modal fade" id="' . $modalEdit . '" tabindex="-1" aria-labelledby="EditModalLabel" aria-hidden="true">
                                    <div class="modal-dialog modal-xl">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <div class="modal-title">
                                                <center>
                                                    <h1 style="margin-top: 20px; margin-bottom: 30px; color: #03045E; font-weight: bold;">Edit</h1>
                                                </center>
                                                <center>
                                                    <div style="width: 90%; height: 20px; margin-left: 10px; margin-right: 10px; background-color: #CAE9FF"></div>
                                                </center>
                                            </div>
                                            <div class="modal-body" style="margin-left: 45px; margin-right: 45px;">
                                                <input type="hidden" data-id="editProductId" name="editProductId" value="' . $row['product_id'] . '">
                                                <div class="form-row">
                                                    <div class="form-group col-md-6">
                                                        <label for="project_title" class="col-form-label"><span style="color: red;">*</span> Project Title :</label>
                                                        <input type="text" class="form-control" name="project_title" id="project_title" required value="' . (!empty($row['project_title']) ? $row['project_title'] : '-') . '">
                                                    </div>
                                                    <div class="form-group col-md-3">
                                                        <label for="group_name" class="col-form-label"><span style="color: red;">*</span> Group :</label>
                                                        <div class="dropdown">
                                                            <button class="btn btn-outline-secondary dropdown-toggle btn-block" type="button" id="group_name" name="group" data-bs-toggle="dropdown" aria-expanded="false">
                                                            ' . (!empty($row['group_name']) ? $row['group_name'] : '-') . ' 
                                                            </button>
                                                            <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                                                                <li><a class="dropdown-item" onclick="selectProjectGroup(\'Project (New)\')">Project (New)</a></li>
                                                                <li><a class="dropdown-item" onclick="selectProjectGroup(\'Improvement (Old)\')">Improvement (Old)</a></li>
                                                            </ul>
                                                        </div>
                                                        <input type="hidden" id="groupInput" name="group" required>
                                                    </div>
                                                    <div class="form-group col-md-3">
                                                        <label for="impactdropdown" class="col-form-label"><span style="color: red;">*</span> Impact :</label>
                                                        <div class="dropdown">
                                                            <button class="btn btn-outline-secondary dropdown-toggle btn-block" type="button" id="impactdropdown" name="impactdropdown" data-bs-toggle="dropdown" aria-expanded="false">
                                                            ' . (!empty($row['impact']) ? $row['impact'] : '-') . '
                                                            </button>
                                                            <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton2">
                                                                <li><a class="dropdown-item" onclick="selectProjectImpact(\'Maximize %AF\')">Maximize %AF</a></li>
                                                                <li><a class="dropdown-item" onclick="selectProjectImpact(\'Waste Circularity Center\')">Waste Circularity Center</a></li>
                                                                <li><a class="dropdown-item" onclick="selectProjectImpact(\'Turn Clinker to Cement & Mortar\')">Turn Clinker to Cement & Mortar</a></li>
                                                                <li><a class="dropdown-item" onclick="selectProjectImpact(\'Maximize Renewable Power\')">Maximize Renewable Power</a></li>
                                                                <li><a class="dropdown-item" onclick="selectProjectImpact(\'New Business\')">New Business</a></li>
                                                                <li><a class="dropdown-item" onclick="selectProjectImpact(\'Data Driven\')">Data Driven</a></li>
                                                                <li><a class="dropdown-item" onclick="selectProjectImpact(\'Lean Process\')">Lean Process</a></li>
                                                            </ul>
                                                        </div>
                                                        <input type="hidden" id="impactInput" name="impact" required>
                                                    </div>
                                                </div>
                                                <div class="mb-3">
                                                    <label for="description" class="col-form-label"><span style="color: red;">*</span> Description :</label>
                                                    <textarea class="form-control" name="description" id="description">' . (!empty($row['description']) ? $row['description'] : '-') . '</textarea>
                                                </div>
                                                <div class="form-row">
                                                    <div class="form-group col-md-4">
                                                        <label for="project_sponsor" class="col-form-label">Team Project :</label>
                                                        <input type="text" class="form-control" name="project_sponsor" id="project_sponsor" value="' . (!empty($row['project_sponsor']) ? $row['project_sponsor'] : '-') . '">
                                                    </div>
                                                    <div class="form-group col-md-4">
                                                        <label for="budget" class="col-form-label">Budget (Baht) :</label>
                                                        <input type="text" class="form-control" name="budget" id="budget" value="' . (!empty($row['budget']) ? $row['budget'] : '-') . '">
                                                    </div>
                                                    <div class="form-group col-md-4">
                                                        <label for="est_values" class="col-form-label">Estimated Value (Baht) :</label>
                                                        <input type="text" class="form-control" name="est_values" id="est_values" value="' . (!empty($row['est_values']) ? $row['est_values'] : '-') . '">
                                                    </div>
                                                </div>
                                                <div class="form-row">
                                                    <div class="form-group col-md-4">
                                                        <label for="key_stake" class="col-form-label">Key Stakeholders :</label>
                                                        <textarea class="form-control" name="key_stake" id="key_stake">' . (!empty($row['key_stakeholders']) ? $row['key_stakeholders'] : '-') . '</textarea>
                                                    </div>
                                                    <div class="form-group col-md-4">
                                                        <label for="key_activities" class="col-form-label">Key Activities :</label>
                                                        <textarea class="form-control" name="key_activities" id="key_activities">' . (!empty($row['key_activities']) ? $row['key_activities'] : '-') . '</textarea>
                                                    </div>
                                                    <div class="form-group col-md-4">
                                                        <label for="kpi" class="col-form-label">KPI / Lean Mandays :</label>
                                                        <textarea class="form-control" name="kpi_lean_mandays" id="kpi_lean_mandays">' . (!empty($row['kpi_lean_mandays']) ? $row['kpi_lean_mandays'] : '-') . '</textarea>
                                                    </div>
                                                </div>
                                                <div class="form-row">
                                                    <div class="form-group col-md-4">
                                                        <label for="start_date" class="col-form-label">Start Date :</label>
                                                        <input type="date" class="form-control" name="start_date" id="start_date" value="' . (!empty($row['start_date']) ? $row['start_date'] : '-') . '">
                                                    </div>
                                                    <div class="form-group col-md-4">
                                                        <label for="end_date" class="col-form-label">End Date :</label>
                                                        <input type="date" class="form-control" name="end_date" id="end_date" value="' . (!empty($row['end_date']) ? $row['end_date'] : '-') . '">
                                                    </div>
                                                    <div class="form-group col-md-4">
                                                        <label for="target_completion_date" class="col-form-label">Target Completion Date :</label>
                                                        <input type="date" class="form-control" name="target_completion_date" id="target_completion_date" value="' . (!empty($row['target_completion_date']) ? $row['target_completion_date'] : '-') . '">
                                                    </div>
                                                </div>
                                                <div class="form-row">
                                                    <div class="form-group col-md-4">
                                                        <label for="Attach_Idea" class="col-form-label">Attach Idea PDF :</label>
                                                        <input type="file" accept=".pdf" class="form-control" name="design_pdf" id="Attach_Idea" onchange="displayFileName()">
                                                    </div>
                                                    <div class="form-group col-md-4">
                                                        <label for="Attach_Result" class="col-form-label">Attach Results PDF :</label>
                                                        <input type="file" accept=".pdf" class="form-control" name="results_pdf" id="Attach_Result">
                                                    </div>
                                                    <div class="form-group col-md-4">
                                                        <label for="System_Flow" class="col-form-label">System Flow :</label>
                                                        <input type="file" accept=".drawio,.vsdx,.vsd" class="form-control" name="system_flow" id="System_Flow">
                                                    </div>
                                                </div>
                                                    Need Support
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="radio" name="select" id="Digital" value="Digital&Technology"' . ((!empty($row['need_support']) && $row['need_support'] == 'Digital&Technology') ? ' checked' : '') . '>
                                                        <label class="form-check-label" for="Digital">Digital&Technology</label>
                                                    </div>
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="radio" name="select" id="Other" value="Other"' . ((!empty($row['need_support']) && $row['need_support'] == 'Other') ? ' checked' : '') . '>
                                                        <label class="form-check-label" for="Other">Other</label>
                                                        <div id="additional-input"' . ((!empty($row['need_support']) && $row['need_support'] == 'Other') ? '' : ' class="hidden"') . '>
                                                            <input type="text" class="form-control" id="other_detail" name="other_detail" placeholder="Please specify" value="' . (!empty($row['other_detail']) ? $row['other_detail'] : '') . '">
                                                        </div>
                                                    </div>
                                                <br>
                                                <center style="color: #03045E;">อัพเดตข้อมูลเพิ่มเติม</center>
                                                <div class="form-row">
                                                    <div class="form-group col-md-4">
                                                        <label for="actual_completion_date" class="col-form-label">Actual Completion Date :</label>
                                                        <input type="date" class="form-control" name="actual_completion_date" id="actual_completion_date" value="' . (!empty($row['actual_completion_date']) ? $row['actual_completion_date'] : '-') . '">
                                                    </div>
                                                    <div class="form-group col-md-4">
                                                        <label for="kpi_result" class="col-form-label">%KPI Results (%) :</label>
                                                        <input type="text" class="form-control" name="kpi_result" id="kpi_result" value="' . (!empty($row['kpi_result']) ? $row['kpi_result'] : '-') . '">
                                                    </div>
                                                    <div class="form-group col-md-4">
                                                        Status :
                                                        <div class="form-check">
                                                            <input class="form-check-input" type="radio" name="status" id="Statusprogress" value="In Progress"' . ((!empty($row['status']) && $row['status'] == 'In Progress') ? ' checked' : '') . '>
                                                            <label class="form-check-label" for="Statusprogress">In Progress</label>
                                                        </div>
                                                        <div class="form-check">
                                                            <input class="form-check-input" type="radio" name="status" id="Statusdone" value="Done"' . ((!empty($row['status']) && $row['status'] == 'Done') ? ' checked' : '') . '>
                                                            <label class="form-check-label" for="Statusdone">Done</label>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                    <button type="button" id="saveChanges" class="btn btn-primary" onclick="handleEditSubmit()">Save changes</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </form>
                            ';
                            // echo '<td class="text-left">
                            //     <button type="button" class="btn btn-circle btn-blue">
                            //         <i class="bi bi-chat-dots"></i>
                            //     </button>
                            // </td>';
                            echo '<td class="text-left">' . (!empty($row['location']) ? $row['location'] : '-') . '</td>';
                            echo '<td class="text-left">' . (!empty($row['impact']) ? $row['impact'] : '-') . '</td>';
                            echo '<td class="text-right">' . (!empty($row['budget']) ? number_format($row['budget']) : '-') . '</td>';
                            echo '<td class="text-right">' . (!empty($row['est_values']) ? number_format($row['est_values']) : '-') . '</td>';
                            echo '<td class="text-left">' . (!empty($row['emp_name']) ? $row['emp_name'] : '-') . '</td>';
                            echo '<td class="text-left">' . (!empty($row['pl_level']) ? $row['pl_level'] : '-') . '</td>';
                            echo '<td class="text-left">' . (!empty($row['group_name']) ? $row['group_name'] : '-') . '</td>';
                            echo '<td class="text-left">' . (!empty($row['project_title']) ? $row['project_title'] : '-') . '</td>';
                            echo '<td>
                            <center>
                                <button type="button" class="btn btn-circle btn-grey" data-bs-toggle="modal" data-bs-target="#' . $modalId . '">
                                    <i class="bi bi-three-dots"></i>
                                </button>
                            </center>
                            </td>';
                            echo '<!-- Modal -->
                            <div class="modal fade" id="' . $modalId . '" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
                                <div class="modal-dialog modal-lg modal-dialog-centered modal-dialog-scrollable" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLongTitle">Detail</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="custom-modal-body">
                                            ' . (!empty($row['description']) ? $row['description'] : '-') . '
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                        </div>
                                    </div>
                                </div>
                            </div>';
                            echo '<td class="text-left">' . (!empty($row['key_stakeholders']) ? $row['key_stakeholders'] : '-') . '</td>';
                            echo '<td>
                            <center>
                                <a id="' . $modalId . '"  href="../assets/data/idea_pdf/' . (!empty($row['attach_design_pdf']) ? $row['attach_design_pdf'] : '-') . '" class="btn btn-circle btn-yellow" download>
                                    <i class="bi bi-diagram-3-fill"></i>
                                </a>
                            </center>
                            </td>';
                            echo '<td class="text-left">' . (!empty($row['start_date']) ? $row['start_date'] : '-') . '</td>';
                            echo '<td class="text-left">' . (!empty($row['end_date']) ? $row['end_date'] : '-') . '</td>';
                            echo '<td class="text-left">' . (!empty($row['project_sponsor']) ? $row['project_sponsor'] : '-') . '</td>';
                            echo '<td class="text-left">' . (!empty($row['key_activities']) ? $row['key_activities'] : '-') . '</td>';
                            echo '<td class="text-left">' . (!empty($row['kpi_lean_mandays']) ? $row['kpi_lean_mandays'] : '-') . '</td>';
                            echo '<td>
                            <center>
                                <a id="' . $modalId . '"  href="../assets/data/idea_pdf/' . (!empty($row['attach_design_pdf']) ? $row['attach_design_pdf'] : '-') . '" class="btn btn-circle btn-document" download>
                                    <i class="bi bi-file-earmark"></i>
                                </a>
                            </center>
                            </td>';
                            echo '<td class="text-left">' . (!empty($row['target_completion_date']) ? $row['target_completion_date'] : '-') . '</td>';
                            echo '<td class="text-left">' . (!empty($row['actual_completion_date']) ? $row['actual_completion_date'] : '-') . '</td>';
                            echo '<td>
                            <center>
                                <a id="' . $modalId . '"  href="../assets/data/idea_pdf/' . (!empty($row['attach_result_pdf']) ? $row['attach_result_pdf'] : '-') . '" class="btn btn-circle btn-document" download>
                                    <i class="bi bi-file-earmark"></i>
                                </a>
                            </center>
                            </td>';
                            echo '<td class="text-left">' . (!empty($row['kpi_result']) ? $row['kpi_result'] : '-') . '</td>';
                            echo '<td class="text-left">' . (!empty($row['division_name']) ? $row['division_name'] : '-') . '</td>';
                            echo '<td class="text-left">' . (!empty($row['department_name']) ? $row['department_name'] : '-') . '</td>';
                            // echo '<td class="text-left">' . (!empty($row['department_name']) ? $row['department_name'] : '-') . '</td>';
                            echo '<td class="text-left">' . (!empty($row['section_name']) ? $row['section_name'] : '-') . '</td>';
                            echo '<td class="text-left">' . (!empty($row['status']) ? $row['status'] : '-') . '</td>';
                            if (!empty($row['need_support'])) {
                                if ($row['need_support'] === 'Digital&Technology') {
                                    $supportValue = (!empty($row['need_support']) ? $row['need_support'] : '-');
                                } else {
                                    $supportValue = (!empty($row['other_detail']) ? $row['other_detail'] : '-');
                                }
                            } else {
                                $supportValue = '-';
                            }

                            echo '<td class="text-left">' . $supportValue . '</td>';
                            // echo '<td class="text-left">' . (!empty($row['area']) ? $row['area'] : '-') . '</td>';
                            echo '</tr>';
                            $no++;
                        }
                    } else {
                        echo '<tr><td colspan="30">ไม่พบข้อมูล</td></tr>';
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>



    <!-- Footer -->
    <?php include '../assets/src/footer.php' ?>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js" integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous"></script>

    <!-- SweetAlert2 -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <!-- //เพิ่มข้อมูล -->
    <script>
        document.getElementById('modalForm').addEventListener('submit', function(event) {
            event.preventDefault(); // ป้องกันการส่งฟอร์มแบบปกติ

            if (document.getElementById('groupInput') === null || document.getElementById('impactInput') === null ||
                document.getElementById('groupInput').value.trim() === '' || document.getElementById('impactInput').value.trim() === '') {
                Swal.fire({
                    icon: 'error',
                    title: 'กรุณากรอก Group และ Impact ให้ครบถ้วน',
                    showConfirmButton: false,
                    timer: 1500
                });
                return;
            } else {
                var Attach_Idea = document.getElementById('Attach_Idea');
                var Attach_Idea_file = Attach_Idea.files[0];

                var Attach_Result = document.getElementById('Attach_Result');
                var Attach_Result_file = Attach_Result.files[0];

                var System_Flow = document.getElementById('System_Flow');
                var System_Flow_file = System_Flow.files[0];

                var formData = new FormData();
                formData.append('design_pdf', Attach_Idea_file);
                formData.append('results_pdf', Attach_Result_file);
                formData.append('system_flow', System_Flow_file);
                formData.append('project_title', document.getElementById('Project_Title').value);
                formData.append('description', document.getElementById('Description').value);
                formData.append('group', document.getElementById('groupInput').value);
                formData.append('impact', document.getElementById('impactInput').value);
                formData.append('project_sponsor', document.getElementById('Project_ponsor').value);
                formData.append('budget', document.getElementById('Budget').value);
                formData.append('estimated_value', document.getElementById('Estimated_value').value);
                formData.append('key_stakeholders', document.getElementById('keystakeholders').value);
                formData.append('key_activitie', document.getElementById('Key_Activities').value);
                formData.append('kpi_lean_manday', document.getElementById('KPI').value);
                formData.append('start_date', document.getElementById('Start_Date').value);
                formData.append('end_date', document.getElementById('End_Date').value);
                formData.append('target_completion_date', document.getElementById('Target').value);
                var selectedOption = document.querySelector('input[name="select"]:checked');
                if (selectedOption) {
                    formData.append('select', selectedOption.value);
                }
                formData.append('other_detail', document.getElementById('otherdetail').value);
                var status = 'In Progress';
                formData.append('status', status);
                var emp_code = '<?php echo $username; ?>';
                formData.append('emp_code', emp_code);

                fetch('../admin/backend/db_add_project.php', {
                        method: 'POST',
                        body: formData
                    })
                    .then(response => response.text())
                    .then(data => {
                        Swal.fire({
                            title: "บันทึกข้อมูลสำเร็จ",
                            icon: "success",
                        }).then((result) => {
                            if (result.isConfirmed) {
                                window.location.href = '../admin/homeAdmin.php';
                            }
                        });
                    })
                    .catch(error => {
                        console.error('Error:', error);
                        alert('An error occurred. Please try again.');
                    });
            }
        });
    </script>
    <!-- //ลบข้อมูล -->
    <script>
        document.addEventListener('DOMContentLoaded', (event) => {
            document.querySelectorAll('.delete-btn').forEach(button => {
                button.addEventListener('click', function() {
                    const productId = this.getAttribute('data-id');
                    // console.log('Product ID:', productId); // ดูค่าที่ถูกส่งไปยังเซิร์ฟเวอร์

                    Swal.fire({
                        title: 'คุณแน่ใจหรือไม่?',
                        text: "คุณจะไม่สามารถย้อนกลับได้!",
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#3085d6',
                        cancelButtonColor: '#d33',
                        confirmButtonText: 'Yes,Delete!'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            fetch('../admin/backend/delete_project.php', {
                                    method: 'POST',
                                    headers: {
                                        'Content-Type': 'application/json'
                                    },
                                    body: JSON.stringify({
                                        id: productId
                                    })
                                })
                                .then(response => {
                                    // console.log('Response status:', response.status);
                                    // console.log('Response body used:', response.bodyUsed);
                                    if (!response.ok) {
                                        throw new Error('Network response was not ok');
                                    }
                                    return response.text(); // อ่านเนื้อหาจากการตอบกลับเป็นข้อความ
                                })
                                .then(text => {
                                    // console.log('Response text:', text); // ดูค่าที่ได้รับจากเซิร์ฟเวอร์เป็นข้อความ
                                    const data = JSON.parse(text); // แปลงข้อความเป็น JSON
                                    // console.log('Response data:', data); // ดูค่าที่ได้รับจากเซิร์ฟเวอร์ในรูปแบบ JSON
                                    if (data.success) {
                                        Swal.fire(
                                            'ลบแล้ว!',
                                            'ข้อมูลของคุณถูกลบแล้ว.',
                                            'success'
                                        ).then((result) => {
                                            if (result.isConfirmed) {
                                                // ลบแถวที่เกี่ยวข้องออกจากตาราง
                                                button.closest('tr').remove();
                                            }
                                        });
                                    } else {
                                        Swal.fire(
                                            'ผิดพลาด!',
                                            'เกิดข้อผิดพลาดในการลบข้อมูล: ' + (data.error || ''),
                                            'error'
                                        );
                                    }
                                })
                                .catch(error => {
                                    // console.error('Error:', error);
                                    Swal.fire(
                                        'ผิดพลาด!',
                                        'เกิดข้อผิดพลาดในการลบข้อมูล.',
                                        'error'
                                    );
                                });
                        }
                    });
                });
            });
        });
    </script>
    <!-- //แก้ไขข้อมูล -->
    <script>
        function handleEditSubmit() {
            var modal = document.querySelector('.modal.show');
            var formData = new FormData();
            formData.append('product_id', modal.querySelector('[name="editProductId"]').value);
            formData.append('project_title', modal.querySelector('[name="project_title"]').value);
            formData.append('description', modal.querySelector('[name="description"]').value);
            formData.append('project_sponsor', modal.querySelector('[name="project_sponsor"]').value);
            formData.append('key_stakeholders', modal.querySelector('[name="key_stake"]').value);
            formData.append('budget', modal.querySelector('[name="budget"]').value);
            formData.append('est_values', modal.querySelector('[name="est_values"]').value);
            formData.append('kpi_lean_mandays', modal.querySelector('[name="kpi_lean_mandays"]').value);
            formData.append('key_activities', modal.querySelector('[name="key_activities"]').value);
            formData.append('start_date', modal.querySelector('[name="start_date"]').value);
            formData.append('end_date', modal.querySelector('[name="end_date"]').value);
            formData.append('target_completion_date', modal.querySelector('[name="target_completion_date"]').value);
            formData.append('actual_completion_date', modal.querySelector('[name="actual_completion_date"]').value);
            formData.append('kpi_result', modal.querySelector('[name="kpi_result"]').value);
            console.log(formData.get("product_id"));
            console.log(formData.get("project_title"));
            console.log(formData.get("description"));
            console.log(formData.get("project_sponsor"));
            console.log(formData.get("key_stakeholders"));
            console.log(formData.get("budget"));
            console.log(formData.get("est_values"));
            console.log(formData.get("start_date"));
            console.log(formData.get("end_date"));
            console.log(formData.get("target_completion_date"));
            console.log(formData.get("actual_completion_date"));
            console.log(formData.get("kpi_result"));
            console.log("FormData created:", formData);
            console.log(formData);
            fetch('../admin/backend/editproject.php', {
                    method: 'POST',
                    body: formData
                })
                .then(response => response.text())
                .then(data => {
                    console.log("Response received:", data);
                    Swal.fire({
                        title: "แก้ไขข้อมูลสำเร็จ",
                        icon: "success",
                    }).then((result) => {
                        if (result.isConfirmed) {
                            window.location.href = './homeAdmin.php';
                        }
                    });
                })
                .catch(error => {
                    console.error('Error:', error);
                    alert('An error occurred. Please try again.');
                });
        }
    </script>
    <!-- ปุ่ม other -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const otherRadio = document.getElementById('Other');
            const additionalInput = document.getElementById('additional-input');

            otherRadio.addEventListener('change', function() {
                if (otherRadio.checked) {
                    additionalInput.classList.remove('hidden');
                }
            });

            const digitalRadio = document.getElementById('Digital');
            digitalRadio.addEventListener('change', function() {
                if (digitalRadio.checked) {
                    additionalInput.classList.add('hidden');
                }
            });
        });
    </script>

</body>

</html>