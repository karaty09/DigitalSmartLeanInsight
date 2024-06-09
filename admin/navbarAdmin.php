<?php
require_once '../db/connect.php';
$username = $_SESSION['user_login'];
?>

<nav class="navbar navbar-light bg-light border-bottom">
    <div class="container-fluid">
        <a class="navbar-brand" href="../admin/homeAdmin.php">
            <img src="../assets/img/sitemap.png" alt="" width="110" height="60">
        </a>
        <div class="dropdown d-flex align-items-center">
            <button class="dropdown-toggle btn btn-light border-0" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
                <span style='color: #03045E; font-weight: bold'>Admin</span>
                <svg xmlns="http://www.w3.org/2000/svg" width="40" height="40" fill="#7BA7D7" class="bi bi-person-fill" viewBox="0 0 16 16">
                    <path d="M3 14s-1 0-1-1 1-4 6-4 6 3 6 4-1 1-1 1zm5-6a3 3 0 1 0 0-6 3 3 0 0 0 0 6" />
                </svg>
            </button>
            <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="dropdownMenuButton1">
                <li><a class="dropdown-item" style="margin-bottom: 10px;" href="./infoAdmin.php">ข้อมูลส่วนตัว</a></li>
                <li><a class="dropdown-item" style="margin-bottom: 10px;" href="./addEmployee.php">นำเข้าข้อมูลของพนักงาน</a></li>
                <li><a class="dropdown-item" style="margin-bottom: 10px;" href="../login/logout.php">ออกจากระบบ</a></li>
            </ul>
        </div>
    </div>
</nav>