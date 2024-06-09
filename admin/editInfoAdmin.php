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
    <title>แก้ไขข้อมูลส่วนตัว</title>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

    <!-- Google Font -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Sarabun&display=swap" rel="stylesheet">

    <!-- CSS Style -->
    <link rel="stylesheet" href="../assets/src/styles/stylesBody.css">
    <link rel="stylesheet" href="../admin/styles/stylesEditInfoAdmin.css">
</head>

<body>
    <!-- Navbar -->
    <?php include '../admin/navbarAdmin.php' ?>

    <!-- Title -->
    <?php include '../assets/src/title.php' ?>

    <!-- Content -->
    <form id="editInfoForm" method="post" enctype="multipart/form-data">
        <div class="container-fluid">
            <div class="row" style="margin-left: 40px; margin-right: 40px;">
                <div class="col-md-3 col-12" style="padding: 20px">
                    <div class="mt-2">
                        <a href="#" class="blue-block" style="text-decoration: none; color: black;"> ข้อมูลส่วนตัว</a>
                    </div>
                    <div class="mt-4">
                        <a href="./addEmployee.php" class="white-block" style="text-decoration: none; color: grey;"> นำเข้าข้อมูลของพนักงาน</a>
                    </div>
                </div>
                <div class="col-md-9 col-12" style="padding: 20px; height: 100%;">
                    <div class="row">
                        <div class="col-12">
                            <h4 style="color: #03045E; margin-bottom: 20px;">แก้ไขข้อมูลส่วนตัว</h4>
                        </div>
                    </div>
                    <div class="d-flex align-items-center" style="background-color: #F7F9F9; border: 2px solid #979A9A; border-radius: 10px; padding: 20px;">
                        <div class="row d-flex align-items-center">
                            <div class="row">
                                <?php
                                $personalInfo_edit = $db->prepare('SELECT firstname_thai, lastname_thai, position_name, section_name, department_name, report_name, image_profile FROM tb_employee WHERE emp_code = :username');
                                $personalInfo_edit->bindParam(':username', $username);
                                $personalInfo_edit->execute();
                                $personalInfo_edit_result = $personalInfo_edit->fetch(PDO::FETCH_ASSOC);
                                ?>
                                <div class="col-md-12 col-12 mb-1">
                                    <h6 class="fw-bold">รายละเอียดข้อมูล</h6>
                                    <hr>
                                </div>
                                <div class="col-md-6 col-12 mb-3">
                                    <h6>SCG ID</h6>
                                    <input type="text" id="username" name="username" placeholder="0150-020xxx" required class="form-control border border-2 rounded-2 input-style" value="<?php echo $username; ?>" readonly>
                                </div>
                                <div class="col-md-6 col-12">
                                    <h6>เลือกรูปภาพ</h6>
                                    <input type="file" name="img_edit" id="img_edit" accept="image/*" class="form-control">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6 col-12 mb-3">
                                    <h6>ชื่อ</h6>
                                    <input type="text" id="fname" name="fname" placeholder="ชื่อ" autocomplete="off" required class="form-control border border-2 rounded-2" value="<?php echo $personalInfo_edit_result['firstname_thai']; ?>">
                                </div>
                                <div class="col-md-6 col-12 mb-3">
                                    <h6>นามสกุล</h6>
                                    <input type="text" id="lname" name="lname" placeholder="นามสกุล" autocomplete="off" required class="form-control border border-2 rounded-2" value="<?php echo $personalInfo_edit_result['lastname_thai']; ?>">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6 col-12 mb-3">
                                    <h6>ตำแหน่ง</h6>
                                    <input type="text" id="position" name="position" placeholder="ตำแหน่ง" autocomplete="off" required class="form-control border border-2 rounded-2" value="<?php echo $personalInfo_edit_result['position_name']; ?>">
                                </div>
                                <div class="col-md-6 col-12 mb-3">
                                    <h6>หน่วยงาน</h6>
                                    <input type="text" id="section" name="section" placeholder="หน่วยงาน" autocomplete="off" required class="form-control border border-2 rounded-2" value="<?php echo $personalInfo_edit_result['section_name']; ?>">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6 col-12 mb-3">
                                    <h6>สังกัด</h6>
                                    <input type="text" id="department" name="department" placeholder="สังกัด" autocomplete="off" required class="form-control border border-2 rounded-2" value="<?php echo $personalInfo_edit_result['department_name']; ?>">
                                </div>
                                <div class="col-md-6 col-12 mb-3">
                                    <h6>ผู้บังคับบัญชา</h6>
                                    <input type="text" id="report_name" name="report_name" placeholder="ผู้บังคับบัญชา" autocomplete="off" required class="form-control border border-2 rounded-2" value="<?php echo $personalInfo_edit_result['report_name']; ?>">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 mt-2 d-flex align-items-center justify-content-md-end justify-content-center">
                        <button type="button" id="cancel" class="btn btn-secondary m-1" onclick="location.href='./infoAdmin.php';">ยกเลิก</button>
                        <button type="submit" id="submit_data" class="btn btn-success">บันทึกข้อมูล</button>
                    </div>
                </div>
            </div>
        </div>
    </form>

    <!-- Footer -->
    <?php include '../assets/src/footer.php' ?>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js" integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous"></script>

    <!-- SweetAlert2 -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
        document.getElementById('editInfoForm').addEventListener('submit', function(event) {
            event.preventDefault(); // ป้องกันการส่งฟอร์มแบบปกติ

            var imageInput = document.getElementById('img_edit');
            var file = imageInput.files[0];
            var formData = new FormData();
            formData.append('imageFile', file);
            formData.append('username', document.getElementById('username').value);
            formData.append('fname', document.getElementById('fname').value);
            formData.append('lname', document.getElementById('lname').value);
            formData.append('position', document.getElementById('position').value);
            formData.append('section', document.getElementById('section').value);
            formData.append('department', document.getElementById('department').value);
            formData.append('report_name', document.getElementById('report_name').value);

            console.log(formData);

            fetch('../admin/backend/editInfoAdminAction.php', {
                    method: 'POST',
                    body: formData
                })
                .then(response => response.text())
                .then(data => {
                    console.log(data);
                    Swal.fire({
                        title: "บันทึกข้อมูลสำเร็จ",
                        icon: "success",
                    }).then((result) => {
                        if (result.isConfirmed) {
                            window.location.href = './infoAdmin.php';
                        }
                    });
                })
                .catch(error => {
                    console.error('Error:', error);
                    alert('An error occurred. Please try again.');
                });
        });
    </script>
</body>

</html>