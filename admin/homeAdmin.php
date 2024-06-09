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
    <link rel="stylesheet" href="../admin/styles/styleHomeAdmin.css">
</head>

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
            <button type="submit" class="btn btn-primary mb-2">Search</button>
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
                        <th class="align-middle">Comment</th>
                        <th class="align-middle">Location</th>
                        <th class="align-middle">Impact</th>
                        <th class="align-middle">Butget</th>
                        <th class="align-middle">EST values</th>
                        <th class="align-middle">Emp Name</th>
                        <th class="align-middle">PL Level</th>
                        <th class="align-middle">Group</th>
                        <th class="align-middle">Project Title</th>
                        <th class="align-middle">Discription</th>
                        <th class="align-middle">Key Stakeholders</th>
                        <th class="align-middle">System Flow</th>
                        <th class="align-middle">Stat Date</th>
                        <th class="align-middle">End Date</th>
                        <th class="align-middle">Project Sponsor</th>
                        <th class="align-middle">Key Activities</th>
                        <th class="align-middle">KPI / Lean Mandays</th>
                        <th class="align-middle">Attach PDF</th>
                        <th class="align-middle">Target Completion Date</th>
                        <th class="align-middle">Actual Completion Date</th>
                        <th class="align-middle">Attach Results PDF</th>
                        <th class="align-middle">%KPL Results</th>
                        <th class="align-middle">Division</th>
                        <th class="align-middle">Department</th>
                        <th class="align-middle">Section</th>
                        <!-- <th class="align-middle">Status</th> -->
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
                            echo '<tr>';
                            echo '<td class="text-left">' . $no . '</td>'; // เพิ่มคอลัมน์ No.
                            echo '<td class="text-left">
                                    <div class="button-container">
                                        <button type="button" class="btn btn-circle btn-yellow">
                                            <i class="bi bi-pencil"></i>
                                        </button>
                                        <button type="button" class="btn btn-circle btn-red">
                                            <i class="bi bi-trash"></i>
                                        </button>
                                    </div>
                                </td>';
                            echo '<td class="text-left">
                                    <button type="button" class="btn btn-circle btn-blue">
                                        <i class="bi bi-chat-dots"></i>
                                    </button>
                                </td>';
                            echo '<td class="text-left">' . (!empty($row['location']) ? $row['location'] : '-') . '</td>';
                            echo '<td class="text-left">' . (!empty($row['impact']) ? $row['impact'] : '-') . '</td>';
                            echo '<td class="text-left">' . (!empty($row['budget']) ? $row['budget'] : '-') . '</td>';
                            echo '<td class="text-left">' . (!empty($row['est_values']) ? $row['est_values'] : '-') . '</td>';
                            echo '<td class="text-left">' . (!empty($row['emp_name']) ? $row['emp_name'] : '-') . '</td>';
                            echo '<td class="text-left">' . (!empty($row['pl_level']) ? $row['pl_level'] : '-') . '</td>';
                            echo '<td class="text-left">' . (!empty($row['group_name']) ? $row['group_name'] : '-') . '</td>';
                            echo '<td class="text-left">' . (!empty($row['project_title']) ? $row['project_title'] : '-') . '</td>';
                            echo '<td>
                            <center>
                                <button type="button" class="btn btn-circle btn-document" data-bs-toggle="modal" data-bs-target="#' . $modalId . '">
                                    <i class="bi bi-file-earmark"></i>
                                </button>
                            </center>
                            </td>';
                            echo '<!-- Modal -->
                            <div class="modal fade" id="' . $modalId . '" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLongTitle">Detail</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">';
                            echo (!empty($row['description']) ? $row['description'] : '-');
                            echo '    </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                        </div>
                                    </div>
                                </div>
                            </div>';
                            echo '<td class="text-left">' . (!empty($row['key_stakeholders']) ? $row['key_stakeholders'] : '-') . '</td>';
                            echo '<td>
                            <center>
                                <button type="button" class="btn btn-circle btn-yellow" onclick="downloadPDF()">
                                    <i class="bi bi-diagram-3-fill"></i>
                                </button>
                            </center>
                            </td>';
                            echo '<td class="text-left">' . (!empty($row['start_date']) ? $row['start_date'] : '-') . '</td>';
                            echo '<td class="text-left">' . (!empty($row['end_date']) ? $row['end_date'] : '-') . '</td>';
                            echo '<td class="text-left">' . (!empty($row['project_sponsor']) ? $row['project_sponsor'] : '-') . '</td>';
                            echo '<td class="text-left">' . (!empty($row['key_activities']) ? $row['key_activities'] : '-') . '</td>';
                            echo '<td class="text-left">' . (!empty($row['kpi_lean_mandays']) ? $row['kpi_lean_mandays'] : '-') . '</td>';
                            echo '<td>
                            <center>
                                <button type="button" class="btn btn-circle btn-document" onclick="downloadPDF()">
                                    <i class="bi bi-file-earmark"></i>
                                </button>
                            </center>
                            </td>';
                            echo '<td class="text-left">' . (!empty($row['target_completion_date']) ? $row['target_completion_date'] : '-') . '</td>';
                            echo '<td class="text-left">' . (!empty($row['actual_completion_date']) ? $row['actual_completion_date'] : '-') . '</td>';
                            echo '<td>
                            <center>
                                <a id="' . $modalId . '"  href="../assets/data/idea_pdf/' . (!empty($row['attach_design_pdf']) ? $row['attach_design_pdf'] : '-') . '" class="btn btn-circle btn-document" download>
                                    <i class="bi bi-file-earmark"></i>
                                </a>
                            </center>
                            </td>';
                            echo '<td class="text-left">' . (!empty($row['']) ? $row[''] : '-') . '</td>';
                            echo '<td class="text-left">' . (!empty($row['division_name']) ? $row['division_name'] : '-') . '</td>';
                            echo '<td class="text-left">' . (!empty($row['department_name']) ? $row['department_name'] : '-') . '</td>';
                            // echo '<td class="text-left">' . (!empty($row['department_name']) ? $row['department_name'] : '-') . '</td>';
                            echo '<td class="text-left">' . (!empty($row['section_name']) ? $row['section_name'] : '-') . '</td>';
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
                formData.append('key_stakeholder', document.getElementById('Key_Stakeholders').value);
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
                var status = 'Progress';
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


</body>

</html>