<?php
    require_once "../include/header.php";
    require_once "../include/dependency.php";
?>
<head>
<style>
    div.headReport {
        text-align: left;
        background-color: #D3D3D3;
        border-radius: 5px;
    }
    iframe {
        height :700px;
        width :100%;
        display:block;

    }
    menu {
        display:block;
        margin-bottom: -4;
        width: auto; 
        height: 16px;
    }
    a:link {
        color: green;
        background-color: transparent;
        text-decoration: none;
    }
    a:visited {
        color: black;
        background-color: transparent;
        text-decoration: none;
    }
    a:hover {
        color: white;
        background-color: transparent;
    }
    a:active {
        color: yellow;
        background-color: transparent;
    }

    .table-hover tbody tr:hover td, .table-hover tbody tr:hover th {
        background-color: rgb(52, 89, 230);
        color: white;
    }

    .hidden {
        display: none;
    }
</style>
    

</head>
<body>


    <section class="container my-3">
        <div class="card px-4">
            <div class="card-body">                          
                <div class="headReport">
                    <h5 class="fw-bold p-2 text-center">กรุณาเลือกข้อมูล | ระบบรายงาน</h5>
                </div>

                <table class="table table-sm table-striped table-hover mt-3">
                    <thead style="background-color: #D3D3D3;">
                        <tr>
                            <th scope="col" class="fw-bold">รหัส</th>
                            <th scope="col" class="fw-bold">ชื่อรายงาน (TH)</th>
                            <th scope="col" class="fw-bold">ผู้ใช้ล่าสุด</th>
                            <th scope="col" class="fw-bold">วันเวลาที่ใช้งานล่าสุด</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr class="clickable-row" data-href="#expenseSummary">
                            <th scope="row">SUM001</th>
                            <td>รายงานสรุปค่าใช้จ่าย</td>
                            <td></td>
                            <td></td>
                        </tr>
                        <tr class="clickable-row" data-href="#sampleB">
                            <th scope="row">SUM002</th>
                            <td>รายงานสรุปรายรับ</td>
                            <td></td>
                            <td></td>
                        <tr class="clickable-row" data-href="#siteSummary">
                            <th scope="row">SUM003</th>
                            <td>สรุปโครงการก่อสร้าง</td>
                            <td></td>
                            <td></td>
                        </tr>
                        <tr class="clickable-row" data-href="#reportTax">
                            <th scope="row">SUM004</th>
                            <td>สรุปรายงานภาษีซื้อ</td>
                            <td></td>
                            <td></td>
                        </tr>
                        <tr>
                            <th scope="row">SUM005</th>
                            <td></td>
                            <td></td>
                            <td></td>
                        </tr>
                        <tr>
                            <th scope="row">SUM006</th>
                            <td></td>
                            <td></td>
                            <td></td>
                        </tr>
                    </tbody>
                </table>

                <!-- แสดงชื่อรายงานที่เลือก -->
                <p class="text-center text-primary fw-bold" id="reportName"></p>



                <!-- สรุปค่าใช้จ่าย -->
                <div class="row hidden content" id="expenseSummary">
                    <div class="row">
                        <div class="col-md-4 mx-auto">
                            <label for="yearSelect" class="form-label fw-bold">ประจำปี :</label>
                            <select class="form-select" aria-label="Default select example" id="yearSelect">
                                <option value="2565">2565</option>
                                <option value="2566">2566</option>
                                <option value="2567">2567</option>
                                <option value="2568">2568</option>
                                <option value="2569">2569</option>
                            </select>
                        </div>
                    </div>

                    <div class="row text-center mt-3">
                        <div class="col-md">
                            <button type="submit" class="btn btn-sm btn-primary w-25" name="submit_reportTax"><i class="fa-solid fa-magnifying-glass"></i> ดูรายงาน</button>
                        </div>
                    </div>
                </div>



                <!-- สรุปรายรับ -->
                <div class="row hidden content" id="sampleB">
                    <div class="row">
                        <div class="col-md-4 mx-auto">
                            <label for="yearSelect" class="form-label fw-bold">ประจำปี :</label>
                            <select class="form-select" aria-label="Default select example" id="yearSelect">
                                <option value="2565">2565</option>
                                <option value="2566">2566</option>
                                <option value="2567">2567</option>
                                <option value="2568">2568</option>
                                <option value="2569">2569</option>
                            </select>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-12 text-center my-3">
                            <b><i class="fa-solid fa-building-circle-arrow-right"></i> เลือกไซต์งาน</b>

                            <?php
                                $stmt = $conn->query("SELECT site_name FROM site_info");
                                $stmt->execute();
                                $site = $stmt->fetchAll();

                                foreach ($site as $row) {

                                    echo '<div class="d-flex justify-content-center">';
                                    echo '<div class="form-check">';
                                    echo '<input class="form-check-input" type="checkbox" value="' . $row['site_name'] . '" id="' . $row['site_name'] . '" name="' . $row['site_name'] . '">';
                                    echo '<label class="form-check-label" for="' . $row['site_name'] . '">' . $row['site_name'] . '</label>';
                                    echo '</div>';
                                    echo '</div>';

                                }
                            ?>

                        </div>
                    </div>

                    <div class="row text-center mt-2">
                        <div class="col-md">
                            <button type="submit" class="btn btn-sm btn-primary w-25" name="submit_reportTax"><i class="fa-solid fa-magnifying-glass"></i> ดูรายงาน</button>
                        </div>
                    </div>
                </div>


                <!-- สรุปโครงการก่อสร้าง -->
                <div class="row hidden content" id="siteSummary">
                    <div class="row">
                        <div class="col-md-4 mx-auto">
                            <label for="yearSelect" class="form-label fw-bold">ประจำปี :</label>
                            <select class="form-select" aria-label="Default select example" id="yearSelect">
                                <option value="2565">2565</option>
                                <option value="2566">2566</option>
                                <option value="2567">2567</option>
                                <option value="2568">2568</option>
                                <option value="2569">2569</option>
                            </select>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-12 text-center my-3">
                            <b><i class="fa-solid fa-building-circle-arrow-right"></i> เลือกไซต์งาน</b>

                            <?php
                                $stmt = $conn->query("SELECT site_name, site_abbre FROM site_info");
                                $stmt->execute();
                                $site = $stmt->fetchAll();

                                foreach ($site as $row) {

                                    echo '<div class="d-flex justify-content-center">';
                                    echo '<div class="form-check">';
                                    echo '<input class="form-check-input" type="checkbox" value="' . $row['site_name'] . '" id="' . $row['site_name'] . '" name="' . $row['site_name'] . '">';
                                    echo '<label class="form-check-label" for="' . $row['site_name'] . '">' . $row['site_name'] . ' | ' . $row['site_abbre'] . '</label>';
                                    echo '</div>';
                                    echo '</div>';

                                }
                            ?>

                        </div>
                    </div>

                    <div class="row text-center mt-2">
                        <div class="col-md">
                            <button type="submit" class="btn btn-sm btn-primary w-25" name="submit_reportTax"><i class="fa-solid fa-magnifying-glass"></i> ดูรายงาน</button>
                        </div>
                    </div>
                </div>



                <!-- สรุปรายการภาษีซื้อ -->
                <div class="row hidden content" id="reportTax">
                    <div class="d-flex justify-content-center">
                        <div class="col-md-3">
                            <label for="monthSelect" class="form-label fw-bold">ประจำเดือน :</label>
                            <select class="form-select" aria-label="Default select example" id="monthSelect">
                                <option value="1">มกราคม</option>
                                <option value="2">กุมภาพันธ์</option>
                                <option value="3">มีนาคม</option>
                                <option value="4">เมษายน</option>
                                <option value="5">พฤษภาคม</option>
                                <option value="6">มิถุนายน</option>
                                <option value="7">กรกฎาคม</option>
                                <option value="8">สิงหาคม</option>
                                <option value="9">กันยายน</option>
                                <option value="10">ตุลาคม</option>
                                <option value="11">พฤศจิกายน</option>
                                <option value="12">ธันวาคม</option>
                            </select>
                        </div>
                        <div class="col-md-2 mx-2">
                            <label for="yearSelect" class="form-label fw-bold">ประจำปี :</label>
                            <select class="form-select" aria-label="Default select example" id="yearSelect">
                                <option value="2565">2565</option>
                                <option value="2566">2566</option>
                                <option value="2567">2567</option>
                                <option value="2568">2568</option>
                                <option value="2569">2569</option>
                            </select>
                        </div>
                        <!-- <div class="col-md-5">
                            <label for="companySelect" class="form-label fw-bold">ชื่อบริษัท :</label>
                            <select class="form-select" aria-label="Default select example" id="companySelect">
                                <option>บริษัท สิทธิชัยเอนจิเนียริ่ง จำกัด</option>
                            </select>
                        </div> -->
                    </div>

                    <div class="row text-center mt-3">
                        <div class="col-md">
                            <button type="submit" class="btn btn-sm btn-primary w-25" name="submit_reportTax"><i class="fa-solid fa-magnifying-glass"></i> ดูรายงาน</button>
                        </div>
                    </div>
                </div>




            </div>
        </div>
    </section>


    <script>
        $(document).ready(function() {
            
            $(".hidden").hide();
            $(".clickable-row").click(function() {
                var href = $(this).data("href");
                $(".selected").removeClass("selected").find(".content").hide();
                $(href).show().parent().addClass("selected");
            });
        });
    </script>



    <script>
        const rows = document.querySelectorAll("table tbody tr");
        const reportName = document.querySelector("#reportName");

        rows.forEach((row) => {
            row.addEventListener("click", () => {
                const code = row.querySelector("th").textContent;
                const name = row.querySelector("td:nth-child(2)").textContent;
                reportName.textContent = code + " | " + name;
            });
        });
    </script>


</body>
</html>

