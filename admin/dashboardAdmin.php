<?php
include '../db/connect.php';
session_start();
$username = $_SESSION['user_login'];
$role = $_SESSION['role'];
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>

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
    <link rel="stylesheet" href="../admin/styles/stylesDashboard.css">

    <style>
        .dataTables_filter {
            float: right;
            margin-bottom: 10px;
        }

        .dataTables_filter input {
            width: 250px;
            border: 1px solid #ced4da;
            border-radius: 4px;
            padding: 5px;
        }

        .dataTables_length {
            display: none;
        }
    </style>

    <!-- Chart.js -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <!-- Dashboard Admin Action -->
    <?php include '../admin/backend/dashboardAdminAction.php'; ?>
</head>

<body>

    <!-- Navbar -->
    <?php include '../admin/navbarAdmin.php' ?>

    <!-- Title -->
    <?php include '../assets/src/title.php' ?>

    <!-- Menu -->
    <?php include '../assets/src/menu.php' ?>

    <!-- Content -->
    <div class="container mt-3 mb-3">
        <div class="card">

            <!-- Title Dashboard -->
            <h3 class="card-header text-center" style="background-color: #03045E; color: white;">Dashboard</h3>
            <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-4">
                            <label for="searchCompany">Company :</label>
                            <select id="searchCompany" name="searchCompany" class="form-control">
                                <option value="Is Not Null">All</option>
                                <?php
                                $company_query = "SELECT DISTINCT company_name FROM tb_employee";
                                $company_query_result = $db->prepare($company_query);
                                $company_query_result->execute();
                                while ($company_row = $company_query_result->fetch(PDO::FETCH_ASSOC)) { ?>
                                    <option value="<?= $company_row['company_name'] ?>"><?= $company_row['company_name'] ?></option>
                                <?php } ?>
                            </select>
                        </div>
                        <div class="col-md-4">
                            <label for="searchDepartment">Department :</label>
                            <select id="searchDepartment" name="searchDepartment" class="form-control">
                                <option value="Is Not Null">All</option>
                                <?php
                                $department_query = "SELECT DISTINCT department_name FROM tb_employee";
                                $department_query_result = $db->prepare($department_query);
                                $department_query_result->execute();
                                while ($department_row = $department_query_result->fetch(PDO::FETCH_ASSOC)) { ?>
                                    <option value="<?= $department_row['department_name'] ?>"><?= $department_row['department_name'] ?></option>
                                <?php } ?>
                            </select>
                        </div>
                        <div class="col-md-4">
                            <label for="searchSection">Section :</label>
                            <select id="searchSection" name="searchSection" class="form-control">
                                <option value="Is Not Null">All</option>
                                <?php
                                $section_query = "SELECT DISTINCT section_name FROM tb_employee";
                                $section_query_result = $db->prepare($section_query);
                                $section_query_result->execute();
                                while ($section_row = $section_query_result->fetch(PDO::FETCH_ASSOC)) { ?>
                                    <option value="<?= $section_row['section_name'] ?>"><?= $section_row['section_name'] ?></option>
                                <?php } ?>
                            </select>
                        </div>
                    </div>
                    <div class="row mt-3">
                        <div class="col-md-4">
                            <label for="start-date" class="mr-2">วันที่เริ่มต้น :</label>
                            <input type="date" id="start-date" name="start-date" class="form-control" />
                        </div>
                        <div class="col-md-4">
                            <label for="start-date" class="mr-2">วันที่สิ้นสุด:</label>
                            <input type="date" id="end-date" name="end-date" class="form-control" />
                        </div>
                        <div class="col-md-4">
                            <label for="start-date" class="mr-2">วันที่เลือก :</label>
                            <input type="text" id="selected-date" class="form-control" disabled />
                        </div>
                    </div>
                    <div class="row mt-3">
                        <div class="col-md-12 d-flex justify-content-end">
                            <button type="submit" id="submit" name="submit" class="m-1 btn btn-success">Submit</button>
                            <button type="submit" id="all" name="all" class="m-1 btn btn-danger">All</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <?php
    if (isset($_POST['submit'])) {
        echo "<script>document.getElementById('searchCompany').value = '" . $searchCompany . "';</script>";
        echo "<script>document.getElementById('searchDepartment').value = '" . $searchDepartment . "';</script>";
        echo "<script>document.getElementById('searchSection').value = '" . $searchSection . "';</script>";
        // แสดงสคริปต์ JavaScript โดยใช้ echo
        echo "<script>";
        echo "var startDate = '" . $start_date . "';";
        echo "var endDate = '" . $end_date . "';";

        // แปลงรูปแบบวันที่เป็นรูปแบบภาษาไทย
        echo "var startDateTh = new Date(startDate).toLocaleDateString('th-TH');";
        echo "var endDateTh = new Date(endDate).toLocaleDateString('th-TH');";

        // สร้างสตริปต์ JavaScript เพื่อกำหนดค่าให้กับ element ใน HTML
        echo "document.getElementById('selected-date').value = 'วันที่เริ่มต้น: ' + startDateTh + ' ถึงวันที่สิ้นสุด: ' + endDateTh;";
        echo "</script>";
    }
    ?>

    <div class="container mb-3">
        <div class="card">
            <div class="card-body">
                <div class="row mb-5">
                    <div class="col-md-3">
                        <div class="card shadow rounded s3-s4-box">
                            <div class="card-body">
                                <?php echo '<p class="fs-4 text-center" style="height: 20px;">' . $total_level_s3s4 . '</p>'; ?>
                                <p class="fs-4 text-center">S3 - S4 (Project Items)</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="card shadow rounded s1-s2-box">
                            <div class="card-body">
                                <?php echo '<p class="fs-4 text-center" style="height: 20px;">' . $total_level_s1s2 . '</p>'; ?>
                                <p class="fs-4 text-center">S1 - S2 (Project Items)</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="card shadow rounded o3-o5-box">
                            <div class="card-body">
                                <?php echo '<p class="fs-4 text-center" style="height: 20px;">' . $total_level_o3o5 . '</p>'; ?>
                                <p class="fs-4 text-center">O3 - O5 (Project Items)</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="card shadow rounded est-value-box">
                            <div class="card-body">
                                <?php echo '<p class="fs-4 text-center" style="height: 20px;">' . number_format($total_est_value, 0) . '</p>'; ?>
                                <p class="fs-4 text-center">EST Values (MB)</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row mb-5">
                    <div class="col-md-6">
                        <div class="d-flex align-items-center justify-content-center" style="height: 50vh">
                            <canvas id="chart1"></canvas>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="d-flex align-items-center justify-content-center" style="height: 50vh">
                            <canvas id="chart5"></canvas>
                        </div>
                    </div>
                </div>
                <div class="row mb-5">
                    <div class="col-md-6">
                        <div class="d-flex align-items-center justify-content-center" style="height: 50vh">
                            <canvas id="chart3"></canvas>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="d-flex align-items-center justify-content-center" style="height: 50vh">
                            <canvas id="chart4"></canvas>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="container mb-3">
        <div class="card">
            <h3 class="card-header" style="background-color: #03045E; color: white;">ตารางข้อมูล</h3>
            <div class="card-body">
                <div style="overflow-x:auto;">
                    <table id="tb-data" class="table custom-table" style="width:100%">
                        <thead>
                            <tr class="text-center">
                                <th class="align-middle">No.</th>
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

                            if (!empty($tableData)) {
                                foreach ($tableData as $row) {
                                    $modalId = 'detail_' . $row['product_id'];
                                    echo '<tr>';
                                    echo '<td class="text-left">' . $no . '</td>'; // เพิ่มคอลัมน์ No.
                                    echo '<td class="text-left">' . (!empty($row['location_name']) ? $row['location_name'] : '-') . '</td>';
                                    echo '<td class="text-left">' . (!empty($row['impact']) ? $row['impact'] : '-') . '</td>';
                                    echo '<td class="text-left">' . (!empty($row['budget']) ? $row['budget'] : '-') . '</td>';
                                    echo '<td class="text-left">' . (!empty($row['est_values']) ? $row['est_values'] : '-') . '</td>';
                                    echo '<td class="text-left">' . (!empty($row['firstname_thai'] . ' ' . $row['lastname_thai']) ? $row['firstname_thai'] . ' ' . $row['lastname_thai'] : '-') . '</td>';
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
        </div>
    </div>

    <!-- Footer -->
    <?php include '../assets/src/footer.php' ?>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js" integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous"></script>

    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>

    <!-- DataTables -->
    <script src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.21/js/dataTables.bootstrap4.min.js"></script>

    <!-- SweetAlert2 -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <!-- Select2 -->
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

    <!-- Chart.js -->
    <script src="../admin/js/chartDashboard.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chartjs-plugin-datalabels"></script>

    <!-- Date Config -->
    <script src="../admin/js/dateConfig.js"></script>

    <!-- Chart Query -->
    <script>
        // Chart 1
        var chart1_ctx = document.getElementById("chart1").getContext("2d");
        var chart1_labels = <?php echo json_encode($name_impact); ?>;
        var chart1_data = <?php echo json_encode($total_impact); ?>;
        chart1(chart1_ctx, chart1_labels, chart1_data);

        // Chart 2
        var monthNames = {
            '01': 'Jan',
            '02': 'Feb',
            '03': 'Mar',
            '04': 'Apr',
            '05': 'May',
            '06': 'Jun',
            '07': 'Jul',
            '08': 'Aug',
            '09': 'Sep',
            '10': 'Oct',
            '11': 'Nov',
            '12': 'Dec'
        };

        // แปลงข้อมูล JSON เป็น object
        var projectData = <?php echo json_encode($project_data); ?>;

        // สร้างออบเจ็กต์เพื่อจัดเก็บข้อมูลตามเดือน
        var monthData = {};

        // วนลูปผ่านข้อมูลทั้งหมด
        projectData.forEach(function(item) {
            // แยกวันที่เพื่อหาเดือน
            var dateParts = item.date.split("-");
            var month = dateParts[1];

            // ตรวจสอบว่ามี key เดือนนี้อยู่ในออบเจ็กต์หรือไม่
            if (!monthData[month]) {
                // สร้าง key ใหม่เพื่อเก็บข้อมูลของเดือนนี้
                monthData[month] = [];
            }

            // เพิ่มข้อมูลโปรเจคลงในออบเจ็กต์ของเดือน
            monthData[month].push(item);
        });

        // ข้อมูลที่จะนำมาสร้างเป็น stack bar chart
        var chartData = {
            labels: [], // เก็บเดือน
            datasets: [] // เก็บข้อมูลของแต่ละโปรเจค
        };

        // วนลูปผ่านข้อมูลทั้งหมด
        for (var month in monthData) {
            if (monthData.hasOwnProperty(month)) {
                var monthName = monthNames[month]; // ดึงชื่อเดือนแบบย่อจาก array monthNames
                chartData.labels.push(monthName); // เพิ่มเดือนแบบย่อลงใน labels

                var projectDataForMonth = monthData[month]; // ข้อมูลโปรเจคสำหรับเดือนนี้

                // สร้าง dataset สำหรับเดือนนี้
                var datasetForMonth = {
                    label: 'Project Complete', // ชื่อของ dataset เป็นชื่อเดือน
                    data: [], // เก็บจำนวนโปรเจคสำหรับแต่ละเดือน
                    backgroundColor: [], // สีของแท่ง
                    borderColor: [], // สีของเส้นขอบแท่ง
                    borderWidth: 1 // ความหนาของเส้นขอบแท่ง
                };

                // เติมข้อมูลโปรเจคและสีให้กับ datasetForMonth
                projectDataForMonth.forEach(function(item) {
                    datasetForMonth.data.push(item.results_service); // เพิ่มจำนวนโปรเจค
                    // เลือกสีแบบสุ่มหรือตามความต้องการ
                    var randomColor = '#' + Math.floor(Math.random() * 16777215).toString(16);
                    datasetForMonth.backgroundColor.push(randomColor); // เพิ่มสีของแท่ง
                    datasetForMonth.borderColor.push(randomColor); // เพิ่มสีของเส้นขอบแท่ง
                });

                chartData.datasets.push(datasetForMonth); // เพิ่ม dataset ลงใน chartData
            }
        }

        var chart2_ctx = document.getElementById("chart5").getContext("2d");
        var chart2_datasets = chartData;
        chart2(chart2_ctx, chart2_datasets);

        // Chart 3
        var chart3_ctx = document.getElementById("chart3").getContext("2d");
        var chart3_labels = <?php echo json_encode($name_need); ?>;
        var chart3_data = <?php echo json_encode($total_need); ?>;
        chart3(chart3_ctx, chart3_labels, chart3_data);

        // Chart 4
        var chart4_ctx = document.getElementById("chart4").getContext("2d");
        var chart4_labels = <?php echo json_encode($name_Actual); ?>;
        var chart4_data = <?php echo json_encode($total_Actual); ?>;
        chart4(chart4_ctx, chart4_labels, chart4_data);
    </script>

    <script>
        $(document).ready(function() {
            $('#tb-data').DataTable({
                language: {
                    search: "ค้นหา:",
                    searchPlaceholder: "ค้นหา"
                }
            });
        });
    </script>

</body>

</html>