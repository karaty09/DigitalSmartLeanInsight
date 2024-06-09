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
    <title>ข้อมูลส่วนตัว</title>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

    <!-- Google Font -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Sarabun&display=swap" rel="stylesheet">

    <!-- CSS Style -->
    <link rel="stylesheet" href="../assets/src/styles/stylesBody.css">
    <link rel="stylesheet" href="../admin/styles/stylesInfoAdmin.css">
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
                    <a href="#" class="blue-block" style="text-decoration: none; color: black;"> ข้อมูลส่วนตัว</a>
                </div>
                <div class="mt-4">
                    <a href="./addEmployee.php" class="white-block" style="text-decoration: none; color: grey;"> นำเข้าข้อมูลของพนักงาน</a>
                </div>
            </div>
            <div class="col-md-9 col-12" style="padding: 20px; height: 100%;">
                <div class="row">
                    <div class="col-12">
                        <h4 style="color: #03045E; margin-bottom: 20px;">ข้อมูลส่วนตัว</h4>
                    </div>
                </div>
                <div class="d-flex align-items-center justify-content-center" style="background-color: #F7F9F9; border: 2px solid #979A9A; border-radius: 10px; padding: 20px;">
                    <div class="row d-flex align-items-center">
                        <div class="col-md-5 col-12 d-flex justify-content-md-end justify-content-center">
                            <?php
                            $personalInfo = $db->prepare('SELECT * FROM tb_employee WHERE emp_code = :username');
                            $personalInfo->bindParam(':username', $username);
                            $personalInfo->execute();
                            $personalInfo_result = $personalInfo->fetch(PDO::FETCH_ASSOC);
                            if ($personalInfo_result && isset($personalInfo_result['image_profile'])) {
                                $image_profile_url = filter_var($personalInfo_result['image_profile'], FILTER_SANITIZE_URL);
                                echo '<img src="../assets/img/imgProfile/' . $image_profile_url . '" class="profile-style">';
                            } else {
                                echo '<img src="../assets/img/imgProfile/userDefault.jpg" class="profile-style">';
                            }
                            ?>
                        </div>
                        <div class="col-md-7 col-12">
                            <div class="d-flex justify-content-md-start justify-content-center">
                                <?php echo "<h3>" . $personalInfo_result['firstname_thai'] . ' ' . $personalInfo_result['lastname_thai'] . "</h3>"; ?>
                            </div>
                            <div class="d-flex justify-content-md-start justify-content-center">
                                <?php echo "<h6>ตำแหน่ง: " . $personalInfo_result['position_name'] . "</h6>"; ?>
                            </div>
                        </div>
                        <div>
                            <hr>
                        </div>
                        <div class="col-md-12 col-12 mb-3">
                            <h6 class="fw-bold">รายละเอียดเพิ่มเติม</h6>
                        </div>
                        <div class="col-md-6 col-12">
                            <?php
                            echo "<h6>รหัสพนักงาน: </h6>" . "<h6 class='form-control mb-3'> " . $personalInfo_result['emp_code'] . "</h6>";
                            echo "<h6>หน่วยงาน: </h6>" . "<h6 class='form-control mb-3'> " . $personalInfo_result['section_name'] . "</h6>";
                            ?>
                        </div>
                        <div class="col-md-6 col-12">
                            <?php
                            echo "<h6>สังกัด: </h6>" . "<h6 class='form-control mb-3'> " . $personalInfo_result['department_name'] . "</h6>";
                            echo "<h6>ผู้บังคับบัญชา: </h6>" . "<h6 class='form-control mb-3'> " . $personalInfo_result['report_name'] . "</h6>";
                            ?>
                        </div>
                    </div>
                </div>
                <div class="col-12 mt-2 d-flex align-items-center justify-content-md-end justify-content-center">
                    <button type="button" class="btn btn-warning button-size" onclick="location.href='./editInfoAdmin.php'">แก้ไขข้อมูลส่วนตัว</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Footer -->
    <?php include '../assets/src/footer.php' ?>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js" integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous"></script>

    <!-- SweetAlert2 -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</body>

</html>