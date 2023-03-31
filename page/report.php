<?php
    // session_start();
    // require_once "../db/config/conn.php";
    // require_once "../db/config/deleteRow.php";

    // if (!isset($_SESSION['admin_login'])) {
    //     header("location: ../login.php");
    // } else {

    //     // query ชื่อผู้ใช้งาน
    //     $id = $_SESSION['admin_login'];
    //     $stmt = $conn->query("SELECT name, lastname, username FROM user_info WHERE id = $id");
    //     $stmt->execute();
    //     $userName_query = $stmt->fetch(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>จัดการไซต์งาน (Site Management) | ระบบบริหารจัดการใบเสร็จ</title>

    <!-- Dependency ห้ามลบ -->
    <?php include "include/dependency.php"; ?>

    <!-- Font kanit-300 ห้ามเอาออก -->
    <style>
        @font-face {
            font-display: swap;
            font-family: 'Kanit';
            font-style: normal;
            font-weight: 300;
            src: url('../resources/fonts/kanit-v12-latin_thai-300.eot'); /* IE9 Compat Modes */
            src: url('../resources/fonts/kanit-v12-latin_thai-300.eot?#iefix') format('embedded-opentype'), /* IE6-IE8 */
                url('../resources/fonts/kanit-v12-latin_thai-300.woff2') format('woff2'), /* Super Modern Browsers */
                url('../resources/fonts/kanit-v12-latin_thai-300.woff') format('woff'), /* Modern Browsers */
                url('../resources/fonts/kanit-v12-latin_thai-300.ttf') format('truetype'), /* Safari, Android, iOS */
                url('../resources/fonts/kanit-v12-latin_thai-300.svg#Kanit') format('svg'); /* Legacy iOS */
        }

        .col a {
            text-decoration: none;
            color: #000;
        }

        .col a:hover {
            color: #000;
        }

        .card {
            transition: transform .3s;
        }

        .card:hover {
          background-color: honeydew;
          transform: scale(1.05);
        }
    </style>
</head>
<body>

    <!-- navbar ห้ามลบ -->
    <?php include 'include/navbar.php'; ?>
    
    <!-- pagename ห้ามลบ -->
    <section class="container mt-2">
        <legend class="fw-bold text-dark text-center border border-3 border-light bg-secondary shadow-sm p-2">ระบบรายงาน (Report System)</legend>
    
    
    
        <div class="row">
            <div class="col-md-12">
                <div class="row row-cols-2 row-cols-md-4 g-2">
                    <div class="col">
                        <a href="#">
                            <div class="card h-100 shadow">
                                <div class="card-body text-center">
                                    <img src="../image/icon/taxes.png" class="mx-auto d-block mb-3 w-50">
                                    <h5 class="card-title fw-bold mt-2">รายงานภาษีซื้อ</h5>
                                </div>
                            </div>
                        </a>
                    </div>
                    <div class="col">
                        <a href="#">
                            <div class="card h-100 shadow">
                                <div class="card-body text-center">
                                    <img src="../image/icon/report.png" class="mx-auto d-block mb-3 w-50">
                                    <h5 class="card-title fw-bold mt-2">สรุปรายงานภาษีซื้อ</h5>
                                </div>
                            </div>
                        </a>
                    </div>
                    <div class="col">
                        <a href="#">
                            <div class="card h-100 shadow">
                                <div class="card-body text-center">
                                    <img src="../image/icon/cost.png" class="mx-auto d-block mb-3 w-50">
                                    <h5 class="card-title fw-bold mt-2">สรุปค่าใช้จ่ายรายเดือน</h5>
                                </div>
                            </div>
                        </a>
                    </div>
                    <div class="col">
                        <a href="#">
                            <div class="card h-100 shadow">
                                <div class="card-body text-center">
                                    <img src="../image/icon/office.png" class="mx-auto d-block mb-3 w-50">
                                    <h5 class="card-title fw-bold mt-2">สรุปโครงการก่อสร้าง</h5>
                                </div>
                            </div>
                        </a>
                    </div>
                    <div class="col">
                        <a href="#">
                            <div class="card h-100 shadow">
                                <div class="card-body text-center">
                                    <img src="../image/icon/money.png" class="mx-auto d-block mb-3 w-50">
                                    <h5 class="card-title fw-bold mt-2">สรุปรายรับ - รายจ่าย</h5>
                                </div>
                            </div>
                        </a>
                    </div>
                    <div class="col">
                        <a href="#">
                            <div class="card h-100 shadow">
                                <div class="card-body text-center">
                                    <img src="../image/icon/construction.png" class="mx-auto d-block mb-3 w-50">
                                    <h5 class="card-title fw-bold mt-2">สรุปโครงการก่อสร้าง</h5>
                                </div>
                            </div>
                        </a>
                    </div>
                    <div class="col">
                        <a href="#">
                            <div class="card h-100 shadow">
                                <div class="card-body text-center">
                                    <img src="../image/icon/salary.png" class="mx-auto d-block mb-3 w-50">
                                    <h5 class="card-title fw-bold mt-2">สรุปรายรับ (กำไร-ขาดทุน)</h5>
                                </div>
                            </div>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    
    
    
    
    
    </section>








</body>
</html>

<?php //} ?>