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
    <title>บันทึกรายรับ | ระบบบริหารจัดการใบเสร็จ</title>

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
        <legend class="fw-bold text-dark text-center border border-3 border-light bg-secondary shadow-sm p-2"><i class="fa-solid fa-1 border rounded p-1 bg-dark text-light"></i> บันทึกรายรับ</legend>
    </section>

    <!-- เลือกไซต์งาน ห้ามลบ -->
    <section class="container">
        <div class="row">
            <div class="col-md center-screen">
                <div class="row row-cols-2 row-cols-md-6 g-2">

                    <?php

                        $stmt = $conn->query("SELECT site_name FROM site_info");
                        $stmt->execute();
                        $allSite = $stmt->fetchAll();

                        foreach($allSite as $fetch_allSite) {
                    ?>

                    <div class="col">
                        <a href="#" data-bs-toggle="modal" data-bs-target="#selectRecord">
                            <div class="card h-100 shadow dashboard">
                                <div class="card-body text-center">
                                    <img src="../image/icon/cost.png" class="mx-auto d-block mb-3 w-50">
                                    <h5 class="card-title fw-bold mt-2"><?php echo $fetch_allSite['site_name']; ?></h5>
                                </div>
                            </div>
                        </a>
                    </div>
                    <?php } ?>
                </div>
            </div>
        </div>
    </section>




    <!-- Modal 1 -->
    <div class="modal fade" id="selectRecord" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel"><i class="fa-solid fa-2 border rounded p-2 bg-dark text-light"></i> เลือกประเภทการบันทึกรายรับ</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="#" method="POST">
                        <div class="mb-0 text-center">
                            <img src="../image/icon/money.png" class="w-25" alt=""><br>
                            <input type="hidden" readonly value="<?php //echo $userAccount['id_users']; ?>" required class="form-control" name="id_site">
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <a href="incomeRecord_Total.php" class="btn btn-success w-100">บันทึกยอดรวม</a>
                    <a href="" class="btn btn-dark w-100">บันทึกรายละเอียด</a>
                </div>
            </div>
        </div>
    </div>


    <script>
        function calculateVAT() {
            var price = document.getElementById("expenseTotal").value;
            var vat = price * 0.07;
            document.getElementById("expenseVAT").value = vat.toFixed(2);
            document.getElementById("expenseSUM").value = (parseFloat(price) + vat).toFixed(2);
        }
    </script>


    <?php include "modal/modal_editSite.php"; ?>
    <?php include "modal/modal_editPassword.php"; ?>
</body>
</html>

<?php } ?>