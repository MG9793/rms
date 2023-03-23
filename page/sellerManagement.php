<?php
    session_start();
    require_once "../db/config/conn.php";
    require_once "../db/config/deleteRow.php";

    if (!isset($_SESSION['admin_login'])) {
        header("location: ../login.php");
    } else {

        // query ชื่อผู้ใช้งาน
        $id = $_SESSION['admin_login'];
        $stmt = $conn->query("SELECT name, lastname FROM user_info WHERE id = $id");
        $stmt->execute();
        $userName_query = $stmt->fetch(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>จัดการผู้ขาย (Seller Management) | ระบบบริหารจัดการใบเสร็จ</title>

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
    </style>
</head>
<body>

    <!-- navbar ห้ามลบ -->
    <?php include 'include/navbar.php'; ?>

    <!-- pagename ห้ามลบ -->
    <section class="container mt-2">
        <legend class="fw-bold text-dark text-center border border-3 border-light bg-secondary shadow-sm p-2">จัดการผู้ขาย (Seller Management)</legend>
    </section>
    
    <!-- input ห้ามลบ -->
    <section class="container">
        <div class="collapse show" id="collapseForm">
            <fieldset class="p-3 shadow-sm mt-2">
                <h5 class="fw-bold"><i class="fa-solid fa-plus"></i> เพิ่มข้อมูลผู้ขาย</h5>

                <form action="#" method="POST">
                    <div class="row mb-3">
                        <div class="col-md-8">
                            <label for="sellerName" class="form-label fw-bold">ชื่อผู้ขาย :</label>
                            <input type="text" class="form-control" name="sellerName" id="sellerName" placeholder="ชื่อผู้ขาย..." required>
                        </div>
                        <div class="col-md-4">
                            <label for="sellerID" class="form-label fw-bold">เลขประจำตัวผู้เสียภาษี :</label>
                            <input type="text" class="form-control" name="sellerID" id="sellerID" placeholder="เลขประจำตัวผู้เสียภาษี..." required>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="" id="exampleCheck1" onchange="toggleInput()">
                                <label class="form-check-label" for="exampleCheck1">สำนักงานใหญ่</label>
                            </div>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-8">
                            <label for="exampleFormControlInput1" class="form-label fw-bold">ชื่อสถานประกอบการ (กรณีไม่ใช่สำนักงานใหญ่) :</label>
                            <input type="text" class="form-control" name="sellerBranch" id="exampleFormControlInput1" placeholder="ชื่อสถานประกอบการ..." required>
                        </div>
                    </div>


                    <div class="row mb-2">
                        <div class="col-md-8">
                            <button type="submit" class="btn btn-primary w-100" name="addSeller"><i class="fa-solid fa-plus"></i> เพิ่ม</button>
                        </div>
                    </div>
                </form>
            </fieldset>
        </div>
    </section>  <!-- Closing Tag Container -->

    <script>
        function toggleInput() {
            var input = document.getElementById("exampleFormControlInput1");
            if (document.getElementById("exampleCheck1").checked) {
                input.disabled = true;
            } else {
                input.disabled = false;
            }
        }
    </script>


    <section class="container">
        <div class="collapse show" id="collapseTable">
            <fieldset class="p-3 shadow-sm mt-2">
                <h5 class="fw-bold"><i class="fa-solid fa-table-list"></i> รายการผู้ขายทั้งหมด</h5>
                <table class="table table-striped table-hover table-sm table-bordered css-serial">
                    <thead class="bg-dark text-light">
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">ชื่อผู้ขาย</th>
                            <th scope="col">สถานประกอบการ</th>
                            <th scope="col">เลขประจำตัวผู้เสียภาษี</th>
                            <th scope="col">แก้ไข/อัพเดทข้อมูล</th>
                        </tr>
                    </thead>
                    <tbody class="align-middle">
                        <tr>
                            <td></td>
                            <td>ร้าน A</td>
                            <td>สาขา AA</td>
                            <td>0000000000000</td>
                            <td>
                                <div class="btn-group" role="group" aria-label="Basic outlined example">
                                    <button type="button" class="btn btn-sm btn-outline-dark" data-bs-toggle="modal" data-bs-target="#modalEditRecord<?php //echo $fetch_incomeHead['id']; ?>"><i class="fas fa-edit"></i></button>
                                    <button type="button" class="btn btn-sm btn-outline-danger" data-bs-toggle="modal" data-bs-target="#modalDeleteRecord<?php //echo $fetch_incomeHead['id']; ?>"><i class="fas fa-trash"></i></button>
                                </div>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </fieldset>
        </div>
    </section>

    

    <!-- <script>
        function calculateDays() {
            var startDate = new Date(document.getElementById("projectStart").value);
            var endDate = new Date(document.getElementById("projectEnd").value);
            var timeDiff = Math.abs(endDate.getTime() - startDate.getTime());
            var diffDays = Math.ceil(timeDiff / (1000 * 3600 * 24));
            document.getElementById("totalDays").value = diffDays;
        }
    </script> -->

    <?php include "modal/modal_editSeller.php"; ?>
    <?php include "modal/modal_editPassword.php"; ?>
</body>
</html>

<?php } ?>