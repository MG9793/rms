<?php
    session_start();
    require_once "../db/config/conn.php";
    require_once "../db/config/deleteRow.php";

    if (!isset($_SESSION['admin_login'])) {
        header("location: ../login.php");
    } else {

        // query ชื่อผู้ใช้งาน
        $id = $_SESSION['admin_login'];
        $stmt = $conn->query("SELECT name, lastname, username FROM user_info WHERE id = $id");
        $stmt->execute();
        $userName_query = $stmt->fetch(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>บันทึกค่าใช้จ่าย (ยอดรวม) | ระบบบริหารจัดการใบเสร็จ</title>

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
          background-color: lightyellow;
          transform: scale(1.05);
        }
    </style>
</head>
<body>

    <!-- navbar ห้ามลบ -->
    <?php include 'include/navbar.php'; ?>

    <!-- pagename ห้ามลบ -->
    <section class="container mt-2">
        <legend class="fw-bold text-dark text-center border border-3 border-light bg-secondary shadow-sm p-2"><i class="fa-solid fa-1 border rounded p-1 bg-dark text-light"></i> บันทึกค่าใช้จ่าย (ยอดรวม)</legend>
    </section>

    <!-- input ห้ามลบ -->
    <section class="container">
        <div class="row">
            <div class="col-md center-screen">
                <div class="row row-cols-2 row-cols-md-6 g-2">

                    <?php

                        $stmt = $conn->query("SELECT * FROM site_info");
                        $stmt->execute();
                        $allSite = $stmt->fetchAll();

                        foreach($allSite as $fetch_allSite) {
                    ?>

                    <div class="col">
                        <a href="#" data-bs-toggle="modal" data-bs-target="#selectVAT<?php echo $fetch_allSite['id']; ?>">
                            <div class="card h-100 shadow dashboard">
                                <div class="card-body text-center">
                                    <img src="../image/icon/construction.png" class="mx-auto d-block mb-3 w-50">
                                    <h5 class="card-title fw-bold mt-2"><?php echo $fetch_allSite['site_name']; ?></h5>
                                </div>
                            </div>
                        </a>
                    </div>


                    <!-- Modal 1 -->
                    <div class="modal fade" id="selectVAT<?php echo $fetch_allSite['id']; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel"><i class="fa-solid fa-2 border rounded p-2 bg-dark text-light"></i> เลือกประเภทการคำนวณภาษี (VAT)</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <form action="../db/db_expense.php" method="POST">
                                        <div class="mb-0 text-center">
                                            <img src="../image/icon/tax.png" class="w-25" alt=""><br>
                                            <!-- <input type="hidden" readonly value="<?php //echo $userAccount['id_users']; ?>" required class="form-control" name="id_site"> -->
                                            <input type="hidden" class="form-control" name="siteName" value="<?php echo $fetch_allSite['site_name']; ?>" readonly>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="submit" class="btn btn-success w-100" name="expenseHead_vat">VAT</button>
                                            <button type="submit" class="btn btn-danger w-100" name="#">No VAT</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php } ?>
                </div>
            </div>
        </div>
    </section>


    <!-- Modal 2 -->
    <!-- <div class="modal fade" id="expenseDetailsVAT" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true" data-bs-backdrop="static" data-bs-keyboard="false">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel"><i class="fa-solid fa-3 border rounded p-2 bg-dark text-light"></i> บันทึกค่าใช้จ่ายรวมภาษี (VAT)</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="#" method="POST">
                        <input type="hidden" readonly value="<?php //echo $userAccount['id_users']; ?>" required class="form-control" name="id_site">
                        <div class="row">
                            <div class="col-md-6">
                                <label class="form-label fw-bold" for="receiptNo">เลขที่ใบเสร็จ :</label>
                                <input type="text" class="form-control" placeholder="กรุณากรอกเลขที่ใบเสร็จ..." name="receiptNo" id="receiptNo" required>
                            </div>
                            <div class="col-md-4">
                                <label class="form-label fw-bold" for="buyDate">วันที่ซื้อ :</label>
                                <input type="date" class="form-control" name="buyDate" id="buyDate" required>
                            </div>
                        </div>
                        <div class="row mt-3">
                            <div class="col-md-6">
                                <label class="form-label fw-bold" for="sellerName">ชื่อผู้ขาย :</label>
                                <input type="text" class="form-control" name="sellerName" id="sellerName" placeholder="กรุณากรอกชื่อผู้ขาย..." required>
                            </div>
                            <div class="col-md-4">
                                <label class="form-label fw-bold" for="taxID">เลขประจำตัวผู้เสียภาษี :</label>
                                <input type="text" class="form-control" name="taxID" id="taxID" placeholder="กรุณากรอกเลขประจำตัวผู้เสียภาษี..." required>
                            </div>
                        </div>
                        <div>หมายเหตุ : หากไม่พบชื่อผู้ขายให้ไปที่เมนูตั้งค่า และเพิ่มรายการผู้ขาย</div>

                        <hr class="headerUnderline mt-4">
                        <div class="row">
                            <div class="col-md-4">
                                <label class="col-form-label fw-bold">ยอดรวม :</label>
                                <input type="number" class="form-control" name="expenseTotal" id="expenseTotal" list="expenseTotal" oninput="calculateVAT()" required>
                            </div>
                            <div class="col-md-2">
                                <label class="col-form-label fw-bold">+ VAT 7% :</label>
                                <input type="number" class="form-control" name="expenseVAT" id="expenseVAT" list="expenseVAT" required disabled>
                            </div>
                            <div class="col-md-4">
                                <label class="col-form-label fw-bold">รวมสุทธิ :</label>
                                <input type="number" class="form-control" name="expenseSUM" id="expenseSUM" list="expenseSUM" required disabled>
                            </div>
                        </div>

                        <div class="row mt-4">
                            <div class="col-md">
                                <button type="submit" class="btn btn-dark text-light w-100"><i class="fa-solid fa-floppy-disk"></i> Save</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div> -->

    <script>
        function calculateVAT() {
            var price = document.getElementById("expenseTotal").value;
            var vat = price * 0.07;
            document.getElementById("expenseVAT").value = vat.toFixed(2);
            document.getElementById("expenseSUM").value = (parseFloat(price) + vat).toFixed(2);
        }
    </script>

</body>
</html>

<?php } ?>