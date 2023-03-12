<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>บันทึกค่าวัสดุ (MA) | โปรแกรมจัดการใบเสร็จ - Version 1.00</title>

    <!-- Font Kanit -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Kanit:wght@300&display=swap" rel="stylesheet">

    <!-- Bootstrap5.3.0 -->
    <link rel="stylesheet" href="../resources/lib/bootstrap5.3.0/css/bootstrap.min.css">
    <script src="../resources/lib/bootstrap5.3.0/js/bootstrap.bundle.min.js"></script>

    <!-- Font Awesome6.2.1 -->
    <link rel="stylesheet" href="../resources/lib/fontawesome6.2.1/css/fontawesome.css">
    <link rel="stylesheet" href="../resources/lib/fontawesome6.2.1/css/brands.css">
    <link rel="stylesheet" href="../resources/lib/fontawesome6.2.1/css/solid.css">

    <!-- jQuey 3.6.1 -->
    <script type="text/javascript" src="https://code.jquery.com/jquery-3.6.1.min.js"></script>

    <!-- DataTables CDN -->
    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.13.1/js/jquery.dataTables.js"></script>
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.13.1/css/jquery.dataTables.css">

    <style>
        body {
            /* background-color: rgb(139, 166, 243); */
            background-color: rgb(245, 245, 245);
            font-family: 'Kanit', sans-serif;
            margin: 0;
            padding: 0;
        }

        .navbar {
            /* background-color: rgb(15, 49, 147); */
        }

        .navbar .nav-item a {
            color: #fff;
        }

        .navbar .nav-item a:hover {
            color: yellow;
        }

        .headerUnderline {
            background-color: #fff;
            border-top: 2px dotted #000;
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

        .css-serial {
            counter-reset: serial-number; /* Set the serial number counter to 0 */
        }

        .css-serial td:first-child:before {
            counter-increment: serial-number; /* Increment the serial number counter */
            content: counter(serial-number); /* Display the counter */
        }
    </style>
</head>
<body>

<nav class="navbar navbar-expand-lg text-light px-4 bg-dark">
        <div class="container">
            <a class="navbar-brand"><img src="../image/logo/logo.jpg" class="rounded" style="width:80px"></a>
            <h5 class="text-light">สิทธิชัย เอนจิเนียริ่ง - ระบบบริหารจัดการใบเสร็จ</h5>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            
            <div class="collapse navbar-collapse" id="navbarNavDropdown">
            <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="../index.php">แดชบอร์ด</a>
                    </li>

                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">บันทึกค่าใช้จ่าย</a>
                        <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <li><a class="dropdown-item text-black disabled" href="#">ยอดรวม</a></li>
                            <li><a class="dropdown-item text-black" href="expenseDetails.php">รายละเอียดสินค้า</a></li>
                        </ul>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" href="../index.php">กระจายค่าใช้จ่าย</a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" href="../index.php">บันทึกรายรับ</a>
                    </li>

                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false"><i class="fa-solid fa-gears"></i> ตั้งค่า</a>
                        <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <li><a class="dropdown-item text-black" href="listItemsManagement.php"><i class="fa-solid fa-clipboard"></i> รายการบันทึก</a></li>
                            <li><a class="dropdown-item text-black" href="sellerManagement.php"><i class="fa-solid fa-cart-shopping"></i> ข้อมูลผู้ขาย</a></li>
                            <li><a class="dropdown-item text-black" href="siteManagement.php"><i class="fa-solid fa-building-circle-check"></i> ไซต์งาน</a></li>
                            <li><a class="dropdown-item text-black" href="userManagement.php"><i class="fa-solid fa-user-gear"></i> ผู้ใช้งาน</a></li>
                        </ul>
                    </li>

                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false"><i class="fa-solid fa-circle-user"></i> ผู้ใช้งาน</a>
                        <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                            <li><a class="dropdown-item text-secondary disabled" style="font-size: 15px;"><i class="fa-solid fa-user"></i> Danai Jantapalaboon</a></li>
                            <li><a class="dropdown-item text-secondary disabled" style="font-size: 15px;"><i class="fa-solid fa-clock"></i> <span id="date"></span> <span id="clock"></span> </a></li>
                            <li><hr class="dropdown-divider"></li>
                            <li><a class="dropdown-item text-black" href="#" data-bs-toggle="modal" data-bs-target="#modalPassword<?php //echo $userAccount['id_users']; ?>"><i class="fa-solid fa-key"></i> เปลี่ยนรหัสผ่าน</a></li>
                            <li><a class="dropdown-item text-black" href="#"><i class="fa-solid fa-right-from-bracket"></i> ออกจากระบบ</a></li>
                        </ul>
                    </li>
                </ul>
            </div>
            <script type="text/javascript" src="resources/js/displayDateTime.js"></script>
        </div>
    </nav>


    <section class="container mt-3">
        <h2 class="fw-bold text-dark"><i class="fa-solid fa-1 border rounded p-2 bg-dark text-light"></i> บันทึกค่าใช้จ่าย (ยอดรวม)</h2>
        <hr class="headerUnderline">

        <div class="row">
            <div class="col-md center-screen">
                <div class="row row-cols-2 row-cols-md-6 g-2">
                    <div class="col">
                        <a href="#" data-bs-toggle="modal" data-bs-target="#selectVAT">
                        <div class="card h-100 shadow dashboard">
                            <div class="card-body text-center">
                                <img src="../image/icon/construction.png" class="mx-auto d-block mb-3 w-50">
                                <h5 class="card-title fw-bold mt-2">ไซต์งาน 1</h5>
                            </div>
                        </div>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>




    <!-- Modal 1 -->
    <div class="modal fade" id="selectVAT" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel"><i class="fa-solid fa-2 border rounded p-2 bg-dark text-light"></i> กรุณาเลือกประเภทการคำนวณภาษี (VAT)</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="#" method="POST">
                        <div class="mb-0 text-center">
                            <img src="../image/icon/tax.png" class="w-25" alt=""><br>
                            <input type="hidden" readonly value="<?php //echo $userAccount['id_users']; ?>" required class="form-control" name="id_site">
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-success w-100" data-bs-toggle="modal" data-bs-target="#expenseDetailsVAT">VAT</button>
                    <button type="submit" class="btn btn-danger w-100" data-bs-toggle="modal" data-bs-target="#MA_Head_NoVAT">No VAT</button>
                </div>
            </div>
        </div>
    </div>


    <!-- Modal 2 -->
    <div class="modal fade" id="expenseDetailsVAT" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true" data-bs-backdrop="static" data-bs-keyboard="false">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel"><i class="fa-solid fa-3 border rounded p-2 bg-dark text-light"></i> บันทึกค่าใช้จ่ายรวมภาษี (VAT)</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="#" method="POST">
                        <!-- <div class="text-center"><img src="../image/icon/cost.png" class="w-25" alt=""></div> -->
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
                                <input type="text" class="form-control" placeholder="กรุณากรอกชื่อผู้ขาย..." name="sellerName" id="sellerName" required>
                            </div>
                            <div class="col-md-4">
                                <label class="form-label fw-bold" for="taxID">เลขประจำตัวผู้เสียภาษี :</label>
                                <input type="text" class="form-control" placeholder="กรุณากรอกเลขประจำตัวผู้เสียภาษี..." name="taxID" id="taxID" required>
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