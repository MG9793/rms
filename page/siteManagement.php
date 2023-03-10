<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>จัดการไซต์งาน | โปรแกรมจัดการใบเสร็จ - Version 1.00</title>

    <!-- Font Kanit -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Kanit:wght@300&display=swap" rel="stylesheet">

    <!-- Bootstrap5.3.0 -->
    <link rel="stylesheet" href="../resources/lib/bootstrap5.3.0/css/bootstrap.min.css">
    <script src="../resources/lib/bootstrap5.3.0/js/bootstrap.bundle.min.js"></script>

    <!-- Font Awesome6.2.1 -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/fontawesome.min.css" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/brands.min.css" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/solid.min.css" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <!-- <link rel="stylesheet" href="../resources/lib/fontawesome6.2.1/css/fontawesome.css">
    <link rel="stylesheet" href="../resources/lib/fontawesome6.2.1/css/brands.css">
    <link rel="stylesheet" href="../resources/lib/fontawesome6.2.1/css/solid.css"> -->

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

        .css-serial {
            counter-reset: serial-number;
            border-radius: .4em;
            overflow: hidden;
        }

        .css-serial td:first-child:before {
            counter-increment: serial-number;
            content: counter(serial-number);
        }

        fieldset {
            background-color: #fff;
            border-radius: .4em;
        }

        .headerUnderline {
            background-color: #fff;
            border-top: 2px dotted #000;
        }
    </style>
</head>
<body>

<nav class="navbar navbar-expand-lg text-light px-4 bg-dark">
        <div class="container">
            <a class="navbar-brand"><img src="../image/logo/logo.jpg" class="rounded" style="width:80px"></a>
            <h5 class="text-light">สิทธิชัย เอนจิเนียริ่ง - ระบบจัดการใบเสร็จ v1.00</h5>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            
            <div class="collapse navbar-collapse" id="navbarNavDropdown">
                <ul class="navbar-nav ms-auto">
                    <!-- <li class="nav-item">
                        <a class="nav-link" href="../index.php"><i class="fa-solid fa-gauge-high"></i> แดชบอร์ด</a>
                    </li> -->
                    <li class="nav-item">
                        <a class="nav-link" href="../index.php">แดชบอร์ด</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="../index.php">บันทึกค่าใช้จ่าย</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="../index.php">กระจายค่าใช้จ่าย</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="../index.php">บันทึกรายรับ</a>
                    </li>
                    <!-- <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false"><i class="fa-solid fa-dollar-sign"></i> บันทึกรายรับ</a>
                        <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <li><a class="dropdown-item text-black" href="#">บันทึกรายรับ (Head)</a></li>
                            <li><a class="dropdown-item text-black" href="#">บันทึกรายรับ (Line)</a></li>
                        </ul>
                    </li>

                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false"><i class="fa-solid fa-paint-roller"></i> ค่าวัสดุ</a>
                        <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <li><a class="dropdown-item text-black" href="recordHeadMA.php">ยอดรวม</a></li>
                            <li><a class="dropdown-item text-black" href="recordLineMA.php"><i class="fa-solid fa-list"></i> รายละเอียดสินค้า</a></li>
                        </ul>
                    </li> -->

                    <!-- <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false"><i class="fa-solid fa-person-digging"></i> ค่าแรง</a>
                        <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <li><a class="dropdown-item text-black" href="recordHeadLA.php">ยอดรวม</a></li>
                            <li><a class="dropdown-item text-black" href="#"><i class="fa-solid fa-list"></i> รายละเอียดสินค้า</a></li>
                        </ul>
                    </li> -->

                    <!-- <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false"><i class="fa-solid fa-sheet-plastic"></i> รายงาน</a>
                        <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <li><a class="dropdown-item text-black" href="#"><i class="fa-solid fa-file-invoice-dollar"></i> ภาษีซื้อ</a></li>
                            <li><a class="dropdown-item text-black" href="siteSummary.php"><i class="fa-solid fa-book"></i> สรุปค่าใช้จ่าย</a></li>
                        </ul>
                    </li> -->

                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false"><i class="fa-solid fa-gears"></i> ตั้งค่า</a>
                        <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <li><a class="dropdown-item text-black" href="listItemsManagement.php"><i class="fa-solid fa-clipboard"></i> รายการบันทึก</a></li>
                            <li><a class="dropdown-item text-black" href="sellerManagement.php"><i class="fa-solid fa-cart-shopping"></i> ข้อมูลผู้ขาย</a></li>
                            <li><a class="dropdown-item text-black disabled" href="#"><i class="fa-solid fa-building-circle-check"></i> ไซต์งาน</a></li>
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
            <script type="text/javascript" src="../resources/js/displayDateTime.js"></script>
        </div>
    </nav>

    <!-- <section class="container mt-3">
        <h2 class="fw-bold text-dark"><i class="fa-solid fa-building-circle-check"></i> ระบบจัดการไซต์งาน</h2>
        <hr class="headerUnderline">
        <div class="d-flex">
            <a class="btn btn-dark" role="button" data-bs-toggle="collapse" href="#collapseTable" aria-expanded="false" aria-controls="collapseTable"><i class="fa-solid fa-table-list"></i> ซ่อน/แสดง ไซต์งานทั้งหมด</a>
            <a class="btn btn-dark mx-2" role="button" data-bs-toggle="collapse" href="#collapseForm" aria-expanded="false" aria-controls="collapseForm"><i class="fa-solid fa-list"></i> ซ่อน/แสดง ฟอร์มเพิ่มไซต์งาน</a>
            <select class="form-select w-25" aria-label="filterProjectStatus">
                <option selected>ตัวกรองสถานะโครงการ...</option>
                <option>อยู่ระหว่างดำเนินโครงการ</option>
                <option>ปิดโครงการ</option>
            </select>
        </div>
    </section> -->
    
    <section class="container mt-2">
        <legend class="fw-bold text-dark text-center border border-3 border-light bg-secondary shadow-sm p-2">จัดการไซต์งาน (Site Management)</legend>
        <!-- <hr class="headerUnderline"> -->
    </section>


    <section class="container">
        <div class="collapse show" id="collapseForm">
            <fieldset class="p-3 shadow-sm mt-2">
                <h5 class="fw-bold"><i class="fa-solid fa-plus"></i> เพิ่มไซต์งาน</h5>

                <form action="#" method="POST">
                    <div class="row mb-3">
                        <div class="col-md-8">
                            <label for="projectName" class="form-label fw-bold">ชื่อไซต์งาน :</label>
                            <input type="text" name="projectName" class="form-control" id="projectName" placeholder="ไซต์งาน.." required>
                        </div>
                        <div class="col-md-4">
                            <label for="projectAbbreviation" class="form-label fw-bold">อักษรย่อไซต์งาน :</label>
                            <input type="text" name="projectAbbreviation" class="form-control" id="projectAbbreviation" required>
                        </div>
                    </div>

                    <!-- <div class="row mb-3">
                        <div class="col-md-8">
                            <label for="projectAddress" class="form-label fw-bold">ที่ตั้งโครงการ :</label>
                            <input type="text" name="projectAddress" class="form-control" id="projectAddress" placeholder="ที่อยู่.." required>
                        </div>
                        <div class="col-md-4">
                            <label for="projectStatus" class="form-label fw-bold">สถานะโครงการ :</label>
                            <select class="form-select" aria-label="projectStatus" name="projectStatus" required>
                                <option>อยู่ระหว่างดำเนินโครงการ</option>
                                <option>ปิดโครงการ</option>
                            </select>
                        </div>
                    </div> -->

                    <!-- <div class="row mb-3">
                        <div class="col-md-4">
                            <label for="projectStart" class="form-label fw-bold">วันเริ่มต้นโครงการ :</label>
                            <input type="date" name="projectStart" class="form-control" id="projectStart" onchange="calculateDays()" required>
                        </div>
                        <div class="col-md-4">
                            <label for="projectEnd" class="form-label fw-bold">วันสิ้นสุดโครงการ :</label>
                            <input type="date" name="projectEnd" class="form-control" id="projectEnd" onchange="calculateDays()" required>
                        </div>
                        <div class="col-md-4">
                            <label for="totalDays" class="form-label fw-bold">จำนวนวัน :</label>
                            <input type="number" name="totalDays" class="form-control" id="totalDays" readonly>
                        </div>
                    </div> -->

                    <div class="row mb-2">
                        <div class="col-md-8">
                            <button type="submit" name="addSite" class="btn btn-primary w-100"><i class="fa-solid fa-plus"></i> เพิ่ม</button>
                        </div>
                        <!-- <div class="col-md-2">
                            <button type="reset" class="btn btn-warning w-100"><i class="fa-solid fa-rotate-right"></i> เคลียร์</button>
                        </div> -->
                    </div>
                </form>
            </fieldset>
        </div>
    </section>  <!-- Closing Tag Container -->


    <section class="container">
        <div class="collapse show" id="collapseTable">
            <fieldset class="p-3 shadow-sm mt-2">
                <h5 class="fw-bold"><i class="fa-solid fa-table-list"></i> รายการไซต์งานทั้งหมด</h5>
                <table class="table table-striped table-hover table-sm table-bordered css-serial">
                    <thead class="bg-dark text-light">
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">ชื่อไซต์งาน</th>
                            <th scope="col">อักษรย่อ</th>
                            <!-- <th scope="col">ที่ตั้ง</th>
                            <th scope="col">สถานะโครงการ</th> -->
                            <th scope="col">แก้ไข/อัพเดทข้อมูล</th>
                        </tr>
                    </thead>
                    <tbody class="align-middle">
                        <tr>
                            <td></td>
                            <td>โครงการ A</td>
                            <td>AA</td>
                            <!-- <td>000/00 เขต aaa แขวง bbb กรุงเทพฯ 10210</td>
                            <td><span class="badge bg-success">อยู่ระหว่างดำเนินโครงการ</span></td> -->
                            <td>
                                <div class="btn-group" role="group" aria-label="Basic outlined example">
                                    <button type="button" class="btn btn-sm btn-outline-dark"><i class="fas fa-edit"></i></button>
                                    <button type="button" class="btn btn-sm btn-outline-danger"><i class="fas fa-trash"></i></button>
                                </div>
                                <!-- <div class="input-group">
                                    <div class="input-group-append">
                                        <button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#modalEditSite<?php //echo $userAccount['id_users']; ?>"><i class="fas fa-edit"></i></button>
                                        <button type="button" class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target=""><i class="fas fa-trash"></i></button>
                                    </div>
                                </div> -->
                            </td>
                        </tr>
                        <tr>
                            <td></td>
                            <td>โครงการ B</td>
                            <td>BB</td>
                            <!-- <td>000/00 เขต aaa แขวง bbb กรุงเทพฯ 10210</td>
                            <td><span class="badge bg-success">อยู่ระหว่างดำเนินโครงการ</span></td> -->
                            <td>
                                <div class="btn-group" role="group" aria-label="Basic outlined example">
                                    <button type="button" class="btn btn-sm btn-outline-dark"><i class="fas fa-edit"></i></button>
                                    <button type="button" class="btn btn-sm btn-outline-danger"><i class="fas fa-trash"></i></button>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td></td>
                            <td>โครงการ C</td>
                            <td>CC</td>
                            <!-- <td>000/00 เขต aaa แขวง bbb กรุงเทพฯ 10210</td>
                            <td><span class="badge bg-dark">ปิดโครงการ</span></td> -->
                            <td>
                                <div class="btn-group" role="group" aria-label="Basic outlined example">
                                    <button type="button" class="btn btn-sm btn-outline-dark"><i class="fas fa-edit"></i></button>
                                    <button type="button" class="btn btn-sm btn-outline-danger"><i class="fas fa-trash"></i></button>
                                </div>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </fieldset>
        </div>
    </section>


    <script>
        function calculateDays() {
            var startDate = new Date(document.getElementById("projectStart").value);
            var endDate = new Date(document.getElementById("projectEnd").value);
            var timeDiff = Math.abs(endDate.getTime() - startDate.getTime());
            var diffDays = Math.ceil(timeDiff / (1000 * 3600 * 24));
            document.getElementById("totalDays").value = diffDays;
        }
    </script>

    <?php include "modal/modal_editSite.php"; ?>
    <?php include "modal/modal_editPassword.php"; ?>
</body>
</html>