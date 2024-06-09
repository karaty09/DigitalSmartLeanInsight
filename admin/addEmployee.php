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
    <title>นำเข้าข้อมูลของพนักงาน</title>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

    <!-- Google Font -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Sarabun&display=swap" rel="stylesheet">

    <!-- CSS Style -->
    <link rel="stylesheet" href="../assets/src/styles/stylesBody.css">
    <link rel="stylesheet" href="../admin/styles/stylesAddEmployee.css">
</head>

<body>
    <!-- Navbar -->
    <?php include '../admin/navbarAdmin.php' ?>

    <!-- Title -->
    <?php include '../assets/src/title.php' ?>

    <!-- Content -->
    <div class="container-fluid">
        <div class="row" style="margin-left: 40px; margin-right: 40px;">
            <div class="col-md-3 col-12" style="padding: 20px">
                <div class="mt-2">
                    <a href="./infoAdmin.php" class="white-block" style="text-decoration: none; color: grey;"> ข้อมูลส่วนตัว</a>
                </div>
                <div class="mt-4">
                    <a href="#" class="blue-block" style="text-decoration: none; color: black;"> นำเข้าข้อมูลของพนักงาน</a>
                </div>
            </div>
            <div class="col-md-9 col-12" style="padding: 20px; height: 100%;">
                <h4 style="color: #03045E; margin-bottom: 20px;">นำเข้าข้อมูลของพนักงาน</h4>
                <div class="d-flex align-items-center justify-content-center" style="background-color: #F7F9F9; border: 2px dashed #979A9A; border-radius: 10px;">
                    <div class="mt-10">
                        <input type="file" id="input" accept=".xls, .xlsx" onchange="displayFileName()" multiple />
                        <div class="custom-input-files">
                            <center>
                                <img src="../assets/img/import.png" alt="" style="width: 100px; height: 100px; margin-bottom: 5px"><br>
                                <span id="fileName">Import File (.xls, .xlsx)</span>
                            </center>
                        </div>
                    </div>
                </div>
                <div class="d-flex justify-content-center mt-3">
                    <button id="import-button" type="button" class="btn btn-success">นำเข้าข้อมูล</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Footer -->
    <?php include '../assets/src/footer.php' ?>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js" integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous"></script>

    <!-- Include xlsx library -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/xlsx/0.17.4/xlsx.full.min.js"></script>

    <!-- SweetAlert2 -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <!-- Custom File Input -->
    <script>
        document.querySelector('.custom-input-files').addEventListener('click', function() {
            document.getElementById('input').click();
        });

        function displayFileName() {
            const fileInput = document.getElementById('input');
            const fileNameDisplay = document.getElementById('fileName');

            if (fileInput.files.length > 0) {
                const fileName = fileInput.files[0].name;
                fileNameDisplay.textContent = `ไฟล์ที่เลือก: ${fileName}`;
            } else {
                fileNameDisplay.textContent = '';
            }
        }
    </script>

    <!-- Send Excel to SQL Server -->
    <script>
        document.getElementById('import-button').addEventListener('click', function() {
            var input = document.getElementById('input');
            if (input.files.length === 0) {
                Swal.fire({
                    icon: "error",
                    title: "กรุณาเลือกไฟล์!",
                });
                return;
            }

            var file = input.files[0];
            var reader = new FileReader();

            reader.onload = function(e) {
                var data = new Uint8Array(e.target.result);
                var workbook = XLSX.read(data, {
                    type: 'array'
                });
                var firstSheetName = workbook.SheetNames[0];
                var worksheet = workbook.Sheets[firstSheetName];
                var json = XLSX.utils.sheet_to_json(worksheet);

                // Ensure JSON data has expected columns
                json = json.map(row => ({
                    com_code: row["Com Code"] || "",
                    emp_code: row["SCG Employee ID"] || "",
                    prefix_thai: row["Name Prefix (Thai)"] || "",
                    firstname_thai: row["First Name (Thai)"] || "",
                    lastname_thai: row["Last Name (Thai)"] || "",
                    prefix_eng: row["Name Prefix (Eng)"] || "",
                    firstname_eng: row["First Name (Eng)"] || "",
                    lastname_eng: row["Last Name (Eng)"] || "",
                    position_name: row["Position Name (Thai)"] || "",
                    section_name: row["Section (Thai)"] || "",
                    sub_department_name: row["Sub1-Department (Thai)"] || "",
                    department_name: row["Department (Thai)"] || "",
                    short_division_name: row["Short Division"] || "",
                    division_name: row["Division (Thai)"] || "",
                    pl: row["PL"] || "",
                    level_name: row["Level"] || "",
                    age: row["อายุตัว"] || "",
                    length_service: row["อายุงาน"] || "",
                    company_name: row["Company (Thai)"] || "",
                    sub_business_unit: row["Sub1-1 Business Unit (Thai)"] || "",
                    email: row["Email Address Business"] || "",
                    phone_number: row["เบอร์โทร"] || "",
                    report_name: row["Report to Name"] || "",
                    manager_email: row["Manager's Email"] || "",
                    cost_center: row["Cost Center"] || "",
                    org_id: row["Org ID"] || "",
                    location_name: row["Location"] || "",
                    role_id: row["Role"] || "",
                    status_name: row["Status"] || ""
                }));

                // Send the JSON data to the PHP script using fetch API
                fetch('../admin/backend/addEmployeeAction.php', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json'
                        },
                        body: JSON.stringify(json)
                    })
                    .then(response => response.text())
                    .then(data => {
                        Swal.fire({
                            title: "บันทึกข้อมูลสำเร็จ",
                            icon: "success",
                        }).then((result) => {
                            if (result.isConfirmed) {
                                location.reload();
                            }
                        });
                    })
                    .catch(error => {
                        console.error('Error:', error);
                    });
            };

            reader.readAsArrayBuffer(file);
        });
    </script>
</body>

</html>