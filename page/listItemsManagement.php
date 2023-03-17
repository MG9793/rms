<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>จัดการรายการสินค้า (Items Management) | ระบบบริหารจัดการใบเสร็จ</title>

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
                            <li><a class="dropdown-item text-black" href="expenseTotal.php">ยอดรวม</a></li>
                            <li><a class="dropdown-item text-black" href="expenseDetails.php">รายละเอียดสินค้า</a></li>
                        </ul>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" href="#">กระจายค่าใช้จ่าย</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="incomeRecord.php">บันทึกรายรับ</a>
                    </li>

                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false"><i class="fa-solid fa-gears"></i> ตั้งค่า</a>
                        <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <li><a class="dropdown-item text-black disabled" href="#"><i class="fa-solid fa-clipboard"></i> รายการสินค้า</a></li>
                            <li><a class="dropdown-item text-black" href="sellerManagement.php"><i class="fa-solid fa-cart-shopping"></i> ข้อมูลผู้ขาย</a></li>
                            <li><a class="dropdown-item text-black" href="siteManagement.php"><i class="fa-solid fa-building-circle-check"></i> ไซต์งาน</a></li>
                            <li><a class="dropdown-item text-black" href="userManagement.php"><i class="fa-solid fa-user-gear"></i> ผู้ใช้งาน</a></li>
                        </ul>
                    </li>

                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false"><i class="fa-solid fa-circle-user"></i> ผู้ใช้งาน</a>
                        <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                            <li><a class="dropdown-item text-black disabled lh-1" style="font-size: 15px;"><i class="fa-solid fa-user"></i> Danai Jantapalaboon</a></li>
                            <li><a class="dropdown-item text-black disabled lh-1" style="font-size: 15px;"><i class="fa-solid fa-clock"></i> <span id="date"></span> <span id="clock"></span> </a></li>
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


    <section class="container mt-2">
        <legend class="fw-bold text-dark text-center border border-3 border-light bg-secondary shadow-sm p-2">จัดการรายการสินค้า (Items Management)</legend>
        <!-- <hr class="headerUnderline"> -->
    </section>


    <section class="container">
        <div class="collapse show" id="collapseForm">
            <fieldset class="p-3 shadow-sm mt-2">
                <h5 class="fw-bold"><i class="fa-solid fa-plus"></i> เพิ่มรายการสินค้า</h5>

                <form action="#" method="POST">
                    <div class="row mb-3">
                        <div class="col-md-8">
                            <label for="listName" class="form-label fw-bold">ชื่อรายการ :</label>
                            <input type="text" name="listName" class="form-control" id="listName" placeholder="ชื่อรายการสินค้า..." required>
                        </div>
                        <div class="col-md-4">
                        <label for="listType" class="form-label fw-bold">ประเภทรายการ :</label>
                        <select class="form-select" aria-label="listType" name="listType" required>
                            <option selected>ค่าแรง</option>
                            <option>ค่าวัสดุ</option>
                        </select>
                        </div>
                    </div>


                    <div class="row mb-2">
                        <div class="col-md-8">
                            <button type="submit" name="addSeller" class="btn btn-primary w-100"><i class="fa-solid fa-plus"></i> เพิ่ม</button>
                        </div>
                    </div>
                    <!-- <div class="row">
                        <div class="col-md-8">
                            <button type="reset" class="btn btn-secondary w-100"><i class="fa-solid fa-rotate-right"></i> Reset</button>
                        </div>
                    </div> -->
                </form>
            </fieldset>
        </div>
    </section>  <!-- Closing Tag Container -->


    
    <section class="container">
        <div class="collapse show" id="collapseTable">
            <fieldset class="p-3 shadow-sm mt-2">
                <h5 class="fw-bold"><i class="fa-solid fa-table-list"></i> รายการสินค้าทั้งหมด</h5>
                <table class="table table-striped table-hover table-sm table-bordered css-serial">
                    <thead class="bg-dark text-light">
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">ชื่อรายการ</th>
                            <th scope="col">ประเภท</th>
                            <th scope="col">แก้ไข/อัพเดทข้อมูล</th>
                        </tr>
                    </thead>
                    <tbody class="align-middle">
                        <tr>
                            <td></td>
                            <td>เงินเดือน Staff (รวมค่าแรงรายวัน)</td>
                            <td><span class="badge bg-warning">ค่าแรง</span></td>
                            <td>
                                <div class="btn-group" role="group" aria-label="Basic outlined example">
                                    <a class="btn btn-sm btn-outline-dark" href="#" data-bs-toggle="modal" data-bs-target="#modalEditItems<?php //echo $userAccount['id_users']; ?>"><i class="fas fa-edit"></i></a>
                                    <button type="button" class="btn btn-sm btn-outline-danger"><i class="fas fa-trash"></i></button>
                                </div>
                            </td>
                        </tr>
                        <!-- <tr>
                            <td></td>
                            <td>ระดับบริหาร, ระดับวิศวกร, ระดับหัวหน้าโฟร์แมน, ระดับธุรการ</td>
                            <td><span class="badge bg-warning">ค่าแรง</span></td>
                            <td>
                                <div class="btn-group" role="group" aria-label="Basic outlined example">
                                    <button type="button" class="btn btn-sm btn-outline-dark"><i class="fas fa-edit"></i></button>
                                    <button type="button" class="btn btn-sm btn-outline-danger"><i class="fas fa-trash"></i></button>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td></td>
                            <td>ระดับแรงงาน</td>
                            <td><span class="badge bg-warning">ค่าแรง</span></td>
                            <td>
                                <div class="btn-group" role="group" aria-label="Basic outlined example">
                                    <button type="button" class="btn btn-sm btn-outline-dark"><i class="fas fa-edit"></i></button>
                                    <button type="button" class="btn btn-sm btn-outline-danger"><i class="fas fa-trash"></i></button>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td></td>
                            <td>BONUS, เงินสะสม 3%, เงินชดเชย</td>
                            <td><span class="badge bg-warning">ค่าแรง</span></td>
                            <td>
                                <div class="btn-group" role="group" aria-label="Basic outlined example">
                                    <button type="button" class="btn btn-sm btn-outline-dark"><i class="fas fa-edit"></i></button>
                                    <button type="button" class="btn btn-sm btn-outline-danger"><i class="fas fa-trash"></i></button>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td></td>
                            <td>ค่าแรงรายวัน (ส่วนผู้รับเหมา)</td>
                            <td><span class="badge bg-warning">ค่าแรง</span></td>
                            <td>
                                <div class="btn-group" role="group" aria-label="Basic outlined example">
                                    <button type="button" class="btn btn-sm btn-outline-dark"><i class="fas fa-edit"></i></button>
                                    <button type="button" class="btn btn-sm btn-outline-danger"><i class="fas fa-trash"></i></button>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td></td>
                            <td>ค่าเครื่องจักร, ยานพาหนะ</td>
                            <td><span class="badge bg-success">ค่าวัสดุ</span></td>
                            <td>
                                <div class="btn-group" role="group" aria-label="Basic outlined example">
                                    <button type="button" class="btn btn-sm btn-outline-dark"><i class="fas fa-edit"></i></button>
                                    <button type="button" class="btn btn-sm btn-outline-danger"><i class="fas fa-trash"></i></button>
                                </div>
                            </td>
                        </tr> -->
                        <tr>
                            <td></td>
                            <td>ค่าวัสดุก่อสร้าง</td>
                            <td><span class="badge bg-success">ค่าวัสดุ</span></td>
                            <td>
                                <div class="btn-group" role="group" aria-label="Basic outlined example">
                                    <a class="btn btn-sm btn-outline-dark" href="#" data-bs-toggle="modal" data-bs-target="#modalEditItems<?php //echo $userAccount['id_users']; ?>"><i class="fas fa-edit"></i></a>
                                    <button type="button" class="btn btn-sm btn-outline-danger"><i class="fas fa-trash"></i></button>
                                </div>
                            </td>
                        </tr>
                        <!-- <tr>
                            <td></td>
                            <td>ค่าวัสดุก่อสร้าง</td>
                            <td><span class="badge bg-success">ค่าวัสดุ</span></td>
                            <td>
                                <div class="input-group">
                                    <div class="input-group-append">
                                        <button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#modalEditSite<?php //echo $userAccount['id_users']; ?>"><i class="fas fa-edit"></i></button>
                                        <button type="button" class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target=""><i class="fas fa-trash"></i></button>
                                    </div>
                                </div>
                            </td>
                        </tr> -->
                    </tbody>
                </table>
            </fieldset>
        </div>
    </section>  <!-- Closing Tag Container -->





    <!-- <section class="container mt-3">
        <h2 class="fw-bold text-dark"><i class="fa-solid fa-clipboard"></i> เพิ่มรายการบันทึก</h2>
        <hr class="headerUnderline">
        <div class="d-flex">
            <a class="btn btn-dark" role="button" data-bs-toggle="collapse" href="#collapseTable" aria-expanded="false" aria-controls="collapseTable"><i class="fa-solid fa-table-list"></i> ซ่อน/แสดง รายการบันทึกทั้งหมด</a>
            <a class="btn btn-dark mx-2" role="button" data-bs-toggle="collapse" href="#collapseForm" aria-expanded="false" aria-controls="collapseForm"><i class="fa-solid fa-list"></i> ซ่อน/แสดง ฟอร์มเพิ่มรายการบันทึก</a>
            <select class="form-select w-25" aria-label="filterProjectStatus">
                <option selected>ตัวกรองสถานะโครงการ...</option>
                <option>อยู่ระหว่างดำเนินโครงการ</option>
                <option>ปิดโครงการ</option>
            </select>
        </div>
    </section>  Closing Tag Container -->


    <script>
        function calculateDays() {
            var startDate = new Date(document.getElementById("projectStart").value);
            var endDate = new Date(document.getElementById("projectEnd").value);
            var timeDiff = Math.abs(endDate.getTime() - startDate.getTime());
            var diffDays = Math.ceil(timeDiff / (1000 * 3600 * 24));
            document.getElementById("totalDays").value = diffDays;
        }
    </script>

    <?php include "modal/modal_editItems.php"; ?>
    <?php include "modal/modal_editPassword.php"; ?>
</body>
</html>