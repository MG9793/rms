<?php
    // if (!isset($_SESSION['admin_login'])) {
    //     header("location: login.php");
    // } else {
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>บันทึกรายจ่าย | โปรแกรมจัดการใบเสร็จ - Version 1.00</title>

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
    <!-- <link rel="stylesheet" href="resources/lib/fontawesome6.2.1/css/fontawesome.css">
    <link rel="stylesheet" href="resources/lib/fontawesome6.2.1/css/brands.css">
    <link rel="stylesheet" href="resources/lib/fontawesome6.2.1/css/solid.css"> -->

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

        .dashboard {
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
          background-color: floralwhite;
          transform: scale(1.05);
        }
    </style>
</head>
<body>
    
    <nav class="navbar navbar-expand-lg text-light px-4 bg-dark">
        <div class="container">
            <a class="navbar-brand"><img src="../image/logo/logo.jpg" class="rounded" style="width:80px"></a>
            <h5 class="fw-bold">สิทธิชัย เอนจิเนียริ่ง - ระบบจัดการใบเสร็จ v1.00</h5>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            
            <div class="collapse navbar-collapse" id="navbarNavDropdown">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="../index.php"><i class="fa-solid fa-gauge-high"></i> แดชบอร์ด</a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false"><i class="fa-solid fa-dollar-sign"></i> บันทึกรายรับ</a>
                        <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <li><a class="dropdown-item text-black" href="#">บันทึกรายรับ (Head)</a></li>
                            <li><a class="dropdown-item text-black" href="#">บันทึกรายรับ (Line)</a></li>
                            <li><a class="dropdown-item text-black" href="#"><i class="fa-solid fa-building"></i> สำนักงานใหญ่ (HQ)</a></li>
                            <li><a class="dropdown-item text-black" href="#"><i class="fa-solid fa-trowel-bricks"></i> ไซต์งาน (OA)</a></li>
                        </ul>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-warning disabled" href="#"><i class="fa-solid fa-sack-dollar"></i> บันทึกรายจ่าย</a>
                    </li>

                    <!-- <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false"><i class="fa-solid fa-sack-dollar"></i> ค่าใช้จ่าย (Line)</a>
                        <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <li><a class="dropdown-item text-black" href="page/recordLineMA.php"><i class="fa-solid fa-paint-roller"></i> บันทึกค่าวัสดุ (MA)</a></li>
                            <li><a class="dropdown-item text-black" href="#"><i class="fa-solid fa-person-digging"></i> บันทึกค่าแรง (LA)</a></li>
                            <li><a class="dropdown-item text-black" href="#"><i class="fa-solid fa-building"></i> สำนักงานใหญ่ (HQ)</a></li>
                            <li><a class="dropdown-item text-black" href="#"><i class="fa-solid fa-trowel-bricks"></i> ไซต์งาน (OA)</a></li>
                        </ul>
                    </li> -->

                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false"><i class="fa-solid fa-sheet-plastic"></i> รายงาน</a>
                        <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <li><a class="dropdown-item text-black" href="#"><i class="fa-solid fa-file-invoice-dollar"></i> ภาษีซื้อ</a></li>
                            <li><a class="dropdown-item text-black" href="siteSummary.php"><i class="fa-solid fa-book"></i> สรุปค่าใช้จ่าย</a></li>
                        </ul>
                    </li>

                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false"><i class="fa-solid fa-gears"></i> ตั้งค่า</a>
                        <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
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


    <section class="container mt-3 text-center">
        <h2 class="fw-bold text-dark"><i class="fa-solid fa-1 border rounded p-2 bg-dark text-light"></i> กรุณาเลือกรายจ่ายที่ต้องการบันทึก</h2>
        <hr class="dashboard">

        <div class="row justify-content-md-center">
            <div class="col-md-6">
                <div class="row row-cols-2 row-cols-md-2 g-2">
                    <div class="col">
                        <a href="recordHeadMA.php">
                        <div class="card h-100 shadow">
                            <div class="card-body text-center">
                                <img src="../image/icon/cost.png" class="mx-auto d-block mb-3 w-50">
                                <h5 class="card-title fw-bold mt-2">บันทึกค่าวัสดุ (MA-Head)</h5>
                            </div>
                        </div>
                        </a>
                    </div>
                    <div class="col">
                        <a href="recordLineMA.php">
                        <div class="card h-100 shadow">
                            <div class="card-body text-center">
                                <img src="../image/icon/cost.png" class="mx-auto d-block mb-3 w-50">
                                <h5 class="card-title fw-bold mt-2">บันทึกค่าวัสดุ (MA-Line)</h5>
                            </div>
                        </div>
                        </a>
                    </div>
                    <div class="col">
                        <a href="#">
                        <div class="card h-100 shadow">
                            <div class="card-body text-center">
                                <img src="../image/icon/expenses.png" class="mx-auto d-block mb-3 w-50">
                                <h5 class="card-title fw-bold mt-2">บันทึกค่าแรง (LA-Head)</h5>
                            </div>
                        </div>
                        </a>
                    </div>
                    <div class="col">
                        <a href="#">
                        <div class="card h-100 shadow">
                            <div class="card-body text-center">
                                <img src="../image/icon/expenses.png" class="mx-auto d-block mb-3 w-50">
                                <h5 class="card-title fw-bold mt-2">บันทึกค่าแรง (LA-Line)</h5>
                            </div>
                        </div>
                        </a>
                    </div>
                </div>
            </div>
        </div>




    </section>

    <?php include "modal/modal_editPassword.php"; ?>


    
</body>
</html>

<?php // } ?>