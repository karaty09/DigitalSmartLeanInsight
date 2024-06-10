<style>
    /* ซ่อนการกรอกข้อมูล */
    .hidden {
        display: none;
    }
</style>

<div class="center">
    <div class="col-2">
        <img src="../assets/img/home.png" style="width: 50px; height: 50px; margin-bottom: 5px;"><br>
        <button type="button" href="" class="button" onclick="hrefRoleHome(<?php echo $role ?>)">HOME</button>
    </div>
    <div class="col-2">
        <img src="../assets/img/New_project.png" style="width: 50px; height: 50px; margin-bottom: 5px;"><br>
        <button type="button" class="button" data-bs-toggle="modal" data-bs-target="#exampleModal">ADD PROJECT</button>
    </div>
    <div class="col-2">
        <img src="../assets/img/recommend.png" style="width: 50px; height: 50px; margin-bottom: 5px;"><br>
        <button type="button" href="" class="button" onclick="hrefRoleRecommend(<?php echo $role ?>)">My Project</button>
    </div>
    <div class="col-2">
        <img src="../assets/img/dashboard.png" style="width: 50px; height: 50px; margin-bottom: 5px;"><br>
        <button type="button" href="" class="button" onclick="hrefRoleDashboard(<?php echo $role ?>)">DASHBOARD</button>
    </div>
</div>

<!-- popup -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-title">
                <center>
                    <h1 style="margin-top: 20px; margin-bottom: 30px; color: #03045E; font-weight: bold;">Add Project
                    </h1>
                </center>
                <center>
                    <div style="width: 90%; height: 20px; margin-left: 10px; margin-right: 10px; background-color: #CAE9FF">
                    </div>
                </center>
            </div>
            <div class="modal-body" style="margin-left: 45px; margin-right: 45px;">
                <form id="modalForm" method="post" enctype="multipart/form-data">
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="recipient-name" class="col-form-label"><span style="color: red;">*</span>
                                Project Title :</label>
                            <input type="text" class="form-control" name="project_title" id="Project_Title" required>
                        </div>
                        <div class="form-group col-md-3">
                            <label for="message-text" class="col-form-label">
                                <span style="color: red;">*</span> Group :
                            </label>
                            <div class="dropdown">
                                <button class="btn btn-outline-secondary dropdown-toggle btn-block" type="button" id="groupdropdown" name="group" data-bs-toggle="dropdown" aria-expanded="false">
                                    Type Project
                                </button>
                                <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                                    <li><a class="dropdown-item" onclick="selectProjectgrop('Project (New)')">Project
                                            (New)</a></li>
                                    <li><a class="dropdown-item" onclick="selectProjectgrop('Improvement (Old)')">Improvement
                                            (Old)</a></li>
                                </ul>
                            </div>
                            <input type="hidden" id="groupInput" name="group" required>
                        </div>
                        <div class="form-group col-md-3">
                            <label for="message-text" class="col-form-label">
                                <span style="color: red;">*</span> Impact :
                            </label>
                            <div class="dropdown">
                                <button class="btn btn-outline-secondary dropdown-toggle btn-block" type="button" id="impactdropdown" name="impact" data-bs-toggle="dropdown" aria-expanded="false">
                                    Impact
                                </button>
                                <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton2">
                                    <li><a class="dropdown-item" onclick="selectProjectimpact('Maximize %AF')">Maximize
                                            %AF</a></li>
                                    <li><a class="dropdown-item" onclick="selectProjectimpact('Waste Circularity Center')">Waste Circularity
                                            Center</a></li>
                                    <li><a class="dropdown-item" onclick="selectProjectimpact('Turn Clinker to Cement & Mortar')">Turn
                                            Clinker to Cement & Mortar</a></li>
                                    <li><a class="dropdown-item" onclick="selectProjectimpact('Maximize Renewable Power')">Maximize Renewable
                                            Power</a></li>
                                    <li><a class="dropdown-item" onclick="selectProjectimpact('New Business')">New
                                            Business</a></li>
                                    <li><a class="dropdown-item" onclick="selectProjectimpact('Data Driven')">Data
                                            Driven</a></li>
                                    <li><a class="dropdown-item" onclick="selectProjectimpact('Lean Process')">Lean Process</a></li>
                                </ul>
                            </div>
                            <input type="hidden" id="impactInput" name="impact" required>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="message-text" class="col-form-label"><span style="color: red;">*</span> Description
                            :</label>
                        <textarea class="form-control" name="description" id="Description" required></textarea>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-4">
                            <label for="recipient-name" class="col-form-label">Project Sponsor :</label>
                            <input type="text" class="form-control" name="project_sponsor" id="Project_ponsor">
                        </div>
                        <div class="form-group col-md-4">
                            <label for="recipient-name" class="col-form-label">Budget (Baht) :</label>
                            <input type="text" class="form-control" name="budget" id="Budget">
                        </div>
                        <div class="form-group col-md-4">
                            <label for="recipient-name" class="col-form-label">Estimated value (Baht) :</label>
                            <input type="text" class="form-control" name="estimated_value" id="Estimated_value">
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-4">
                            <label for="message-text" class="col-form-label">Key Stakeholders :</label>
                            <textarea class="form-control" name="key_stakeholder" id="Key_Stakeholders"></textarea>
                        </div>
                        <div class="form-group col-md-4">
                            <label for="message-text" class="col-form-label">Key Activities :</label>
                            <textarea class="form-control" name="key_activitie" id="Key_Activities"></textarea>
                        </div>
                        <div class="form-group col-md-4">
                            <label for="message-text" class="col-form-label">KPI / Lean Mandays :</label>
                            <textarea class="form-control" name="kpi_lean_manday" id="KPI"></textarea>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-4">
                            <label for="message-text" class="col-form-label">Start Date :</label>
                            <input type="date" class="form-control" name="start_date" id="Start_Date">
                        </div>
                        <div class="form-group col-md-4">
                            <label for="message-text" class="col-form-label">End Date :</label>
                            <input type="date" class="form-control" name="end_date" id="End_Date">
                        </div>
                        <div class="form-group col-md-4">
                            <label for="message-text" class="col-form-label">Target Completion Date :</label>
                            <input type="date" class="form-control" name="target_completion_date" id="Target">
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-4">
                            <label for="message-text" class="col-form-label">Attach Idea PDF :</label>
                            <input type="file" accept=".pdf" class="form-control" name="design_pdf" id="Attach_Idea">
                        </div>
                        <div class="form-group col-md-4">
                            <label for="message-text" class="col-form-label">Attach Results PDF :</label>
                            <input type="file" accept=".pdf" class="form-control" name="results_pdf" id="Attach_Result">
                        </div>
                        <div class="form-group col-md-4">
                            <label for="message-text" class="col-form-label">System Flow :</label>
                            <input type="file" accept=".drawio,.vsdx,.vsd" class="form-control" name="system_flow" id="System_Flow">
                        </div>
                    </div>
                    Need Suport
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="select" id="Digital" value="Digital&Technology">
                        <label class="form-check-label" for="Digital">
                            Digital&Technology
                        </label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="select" id="Other" value="Other">
                        <label class="form-check-label" for="Other">
                            Other
                        </label>
                        <div id="additional-input" class="hidden">
                            <input type="text" class="form-control" id="otherdetail" name="other_detail" placeholder="Please specify">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary" name="save" id="save">Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
    //มีค่าอยู่ก่อนที่ฟอร์มจะถูกส่งไปยังเซิร์ฟเวอร์ หากไม่มีค่าจะให้แสดงข้อความแจ้งเตือนว่าให้เลือกค่าก่อน
    function hrefRoleHome(role) {
        if (role == 1)
            window.location.href = '../admin/homeAdmin.php';
    }

    function hrefRoleRecommend(role) {
        if (role == 1)
            window.location.href = '../admin/recommendAdmin.php';
    }

    function hrefRoleDashboard(role) {
        if (role == 1)
            window.location.href = '../admin/dashboardAdmin.php';
    }

    function selectProjectgrop(projectName) {
        document.getElementById('groupdropdown').innerText = projectName;
        document.getElementById('groupInput').value = projectName; // Update hidden input value
    }

    function selectProjectimpact(projectName) {
        document.getElementById('impactdropdown').innerText = projectName;
        document.getElementById('impactInput').value = projectName; // Update hidden input value
    }

    document.addEventListener('DOMContentLoaded', function() {
        const form = document.querySelector('form');
        form.addEventListener('submit', function(event) {
            const groupInput = document.getElementById('groupInput');
            const impactInput = document.getElementById('impactInput');

            if (!groupInput.value) {
                event.preventDefault();
                // alert('Please select a Group.');
            }

            if (!impactInput.value) {
                event.preventDefault();
                // alert('Please select an Impact.');
            }
        });

        const today = new Date();
        const startDate = today.toISOString().split('T')[0];
        document.getElementById('Start_Date').value = startDate;

        const endOfYear = new Date(today.getFullYear(), 11, 31);
        const endDate = endOfYear.toISOString().split('T')[0];

        document.getElementById('End_Date').value = endDate;
        document.getElementById('Target').value = endDate;
    });

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

    // ซ่อนช่องกรอกข้อมูลเพิ่มเติม
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

    // Set default dates
    document.addEventListener('DOMContentLoaded', (event) => {
        const today = new Date();
        const startDate = today.toISOString().split('T')[0];
        document.getElementById('Start_Date').value = startDate;

        // กำหนดให้ end_date เป็นวันที่ 31 ธันวาคมของปีปัจจุบัน
        const endOfYear = new Date(today.getFullYear(), 11, 32);
        const endDate = endOfYear.toISOString().split('T')[0];

        document.getElementById('End_Date').value = endDate;
        document.getElementById('Target').value = endDate;
    });
</script>