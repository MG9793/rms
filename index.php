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
    <title>Dashboard | โปรแกรมจัดการใบเสร็จ - Version 1.00</title>

    <!-- Font Kanit -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Kanit:wght@300&display=swap" rel="stylesheet">

    <!-- Bootstrap5.3.0 -->
    <link rel="stylesheet" href="resources/lib/bootstrap5.3.0/css/bootstrap.min.css">
    <script src="resources/lib/bootstrap5.3.0/js/bootstrap.bundle.min.js"></script>

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

        .monthColor {
            background-color: grey;
        }
    </style>
</head>
<body>
    
    <nav class="navbar navbar-expand-lg text-light px-4 bg-dark">
        <div class="container">
            <a class="navbar-brand"><img src="image/logo/logo.jpg" class="rounded" style="width:80px"></a>
            <h5 class="text-light">สิทธิชัย เอนจิเนียริ่ง - ระบบบริหารจัดการใบเสร็จ</h5>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            
            <div class="collapse navbar-collapse" id="navbarNavDropdown">
                <ul class="navbar-nav ms-auto">
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
                    <!-- <li class="nav-item">
                        <a class="nav-link" href="#"><i class="fa-solid fa-gauge-high"></i> แดชบอร์ด</a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false"><i class="fa-solid fa-dollar-sign"></i> บันทึกค่าใช้จ่าย</a>
                        <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <li><a class="dropdown-item text-black" href="#"><i class="fa-regular fa-note-sticky"></i> บันทึกยอดรวม</a></li>
                            <li><a class="dropdown-item text-black" href="#"><i class="fa-solid fa-list"></i> บันทึกรายละเอียด</a></li>
                        </ul>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false"><i class="fa-solid fa-hand-holding-dollar"></i> บันทึกรายรับ</a>
                        <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <li><a class="dropdown-item text-black" href="#"><i class="fa-regular fa-note-sticky"></i> บันทึกยอดรวม</a></li>
                            <li><a class="dropdown-item text-black" href="#"><i class="fa-solid fa-list"></i> บันทึกรายละเอียด</a></li>
                        </ul>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#"><i class="fa-solid fa-comments-dollar"></i> กระแสค่าใช้จ่าย</a>
                    </li> -->
                    <!-- <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false"><i class="fa-solid fa-sheet-plastic"></i> รายงาน</a>
                        <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <li><a class="dropdown-item text-black" href="#"><i class="fa-solid fa-file-invoice-dollar"></i> ภาษีซื้อ</a></li>
                            <li><a class="dropdown-item text-black" href="page/siteSummary.php"><i class="fa-solid fa-book"></i> สรุปค่าใช้จ่าย</a></li>
                        </ul>
                    </li> -->

                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false"><i class="fa-solid fa-gears"></i> ตั้งค่า</a>
                        <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <li><a class="dropdown-item text-black" href="page/listItemsManagement.php"><i class="fa-solid fa-clipboard"></i> รายการบันทึก</a></li>
                            <li><a class="dropdown-item text-black" href="page/sellerManagement.php"><i class="fa-solid fa-cart-shopping"></i> ข้อมูลผู้ขาย</a></li>
                            <li><a class="dropdown-item text-black" href="page/siteManagement.php"><i class="fa-solid fa-building-circle-check"></i> ไซต์งาน</a></li>
                            <li><a class="dropdown-item text-black" href="page/userManagement.php"><i class="fa-solid fa-user-gear"></i> ผู้ใช้งาน</a></li>
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
        <h2 class="fw-bold text-dark">แดชบอร์ด</h2>
        <hr class="dashboard">

        <fieldset>
            <legend class="fw-bold"><i class="fa-solid fa-file-invoice-dollar"></i> สรุปรวม</legend>
            <div class="row">

                <div class="col-xl-3 col-md-12">
                    <div class="card h-100">
                        <div class="card-body">
                            <div class="d-flex justify-content-between p-md-1">
                                <div class="d-flex flex-row">
                                    <div class="align-self-center">
                                        <i class="fa-solid fa-building text-primary fa-3x me-4"></i>
                                    </div>
                                    <div class="d-flex align-items-center">
                                        <h6 class="fw-bold">ไซต์งานปัจจุบัน</h6>
                                    </div>
                                </div>
                                <div class="align-self-center">
                                    <h6 class="mb-0">6</h6>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-xl-3 col-md-12">
                    <div class="card h-100">
                        <div class="card-body">
                            <div class="d-flex justify-content-between p-md-1">
                                <div class="d-flex flex-row">
                                    <div class="align-self-center">
                                        <i class="fa-solid fa-gears text-success fa-3x me-4"></i>
                                    </div>
                                    <div class="d-flex align-items-center">
                                        <h6 class="fw-bold">ค่าวัสดุรวม</h6>
                                    </div>
                                </div>
                                <div class="align-self-center">
                                    <h6 class="mb-0">1,003,284,695</h6>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-xl-3 col-md-12">
                    <div class="card h-100">
                        <div class="card-body">
                            <div class="d-flex justify-content-between p-md-1">
                                <div class="d-flex flex-row">
                                    <div class="align-self-center">
                                        <i class="fa-solid fa-person text-warning fa-3x me-4"></i>
                                    </div>
                                    <div class="d-flex align-items-center">
                                        <h6 class="fw-bold">ค่าแรงรวม</h6>
                                    </div>
                                </div>
                                <div class="align-self-center">
                                    <h6 class="mb-0">120,284,695</h6>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-xl-3 col-md-12">
                    <div class="card h-100">
                        <div class="card-body">
                            <div class="d-flex justify-content-between p-md-1">
                                <div class="d-flex flex-row">
                                    <div class="align-self-center">
                                        <i class="fa-solid fa-wallet fa-3x text-danger me-4"></i>
                                    </div>
                                    <div class="d-flex align-items-center">
                                        <h6 class="fw-bold">รวมทั้งหมด</h6>
                                    </div>
                                </div>
                                <div class="align-self-center">
                                    <h6 class="mb-0">221,284,695</h6>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </fieldset>

        <hr>
        <div class="d-flex">
            <a class="btn btn-dark" role="button" data-bs-toggle="collapse" href="#collapseSummary1" aria-expanded="false" aria-controls="collapseSummary1"><i class="fa-solid fa-table-list"></i> สรุปยอดซื้อ (VAT)</a>
            <a class="btn btn-dark mx-2" role="button" data-bs-toggle="collapse" href="#collapseSummary2" aria-expanded="false" aria-controls="collapseSummary2"><i class="fa-solid fa-list"></i> สรุปยอดซื้อ (no VAT)</a>
        </div>

        <fieldset class="collapse hide mt-2" id="collapseSummary1">
            <legend class="fw-bold"><i class="fa-solid fa-book"></i> สรุปยอดซื้อ (VAT)</legend>
            <div class="row">
                <div class="col-xl-4 col-md-12 mb-2">
                    <div class="fw-bold text-center border p-2 bg-dark text-light rounded">01/2566</div>
                    <div class="card">
                        <div class="card-body">
                            <div class="d-flex justify-content-between p-md-1">
                                <div class="d-flex flex-row">
                                    <div class="align-self-center">
                                        <h2 class="mb-0 fw-bold"><i class="fa-solid fa-sack-dollar text-success"></i> ยอดซื้อ</h2>
                                    </div>
                                    <div class="mt-2" style="margin-left: 120px">
                                        <h4>76,456.00</h4>
                                    </div>
                                </div>
                            </div>
                            <div class="d-flex justify-content-between p-md-1">
                                <div class="d-flex flex-row">
                                    <div class="align-self-center">
                                        <h2 class="mb-0 fw-bold"><i class="fa-solid fa-receipt text-info"></i> VAT</h2>
                                    </div>
                                    <div class="mt-3" style="margin-left: 180px">
                                        <h4>7,504.00</h4>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-xl-4 col-md-12 mb-2">
                    <div class="fw-bold text-center border p-2 bg-dark text-light rounded">02/2566</div>
                    <div class="card">
                        <div class="card-body">
                            <div class="d-flex justify-content-between p-md-1">
                                <div class="d-flex flex-row">
                                    <div class="align-self-center">
                                        <h2 class="mb-0 fw-bold"><i class="fa-solid fa-sack-dollar text-success"></i> ยอดซื้อ</h2>
                                    </div>
                                    <div class="mt-2" style="margin-left: 120px">
                                        <h4>76,456.00</h4>
                                    </div>
                                </div>
                            </div>
                            <div class="d-flex justify-content-between p-md-1">
                                <div class="d-flex flex-row">
                                    <div class="align-self-center">
                                        <h2 class="mb-0 fw-bold"><i class="fa-solid fa-receipt text-info"></i> VAT</h2>
                                    </div>
                                    <div class="mt-3" style="margin-left: 180px">
                                        <h4>7,504.00</h4>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-xl-4 col-md-12 mb-2">
                    <div class="fw-bold text-center border p-2 bg-dark text-light rounded">03/2566</div>
                    <div class="card">
                        <div class="card-body">
                            <div class="d-flex justify-content-between p-md-1">
                                <div class="d-flex flex-row">
                                    <div class="align-self-center">
                                        <h2 class="mb-0 fw-bold"><i class="fa-solid fa-sack-dollar text-success"></i> ยอดซื้อ</h2>
                                    </div>
                                    <div class="mt-2" style="margin-left: 120px">
                                        <h4>76,456.00</h4>
                                    </div>
                                </div>
                            </div>
                            <div class="d-flex justify-content-between p-md-1">
                                <div class="d-flex flex-row">
                                    <div class="align-self-center">
                                        <h2 class="mb-0 fw-bold"><i class="fa-solid fa-receipt text-info"></i> VAT</h2>
                                    </div>
                                    <div class="mt-3" style="margin-left: 180px">
                                        <h4>7,504.00</h4>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-xl-4 col-md-12 mb-2">
                    <div class="fw-bold text-center border p-2 bg-dark text-light rounded">04/2566</div>
                    <div class="card">
                        <div class="card-body">
                            <div class="d-flex justify-content-between p-md-1">
                                <div class="d-flex flex-row">
                                    <div class="align-self-center">
                                        <h2 class="mb-0 fw-bold"><i class="fa-solid fa-sack-dollar text-success"></i> ยอดซื้อ</h2>
                                    </div>
                                    <div class="mt-2" style="margin-left: 120px">
                                        <h4>76,456.00</h4>
                                    </div>
                                </div>
                            </div>
                            <div class="d-flex justify-content-between p-md-1">
                                <div class="d-flex flex-row">
                                    <div class="align-self-center">
                                        <h2 class="mb-0 fw-bold"><i class="fa-solid fa-receipt text-info"></i> VAT</h2>
                                    </div>
                                    <div class="mt-3" style="margin-left: 180px">
                                        <h4>7,504.00</h4>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-xl-4 col-md-12 mb-2">
                    <div class="fw-bold text-center border p-2 bg-dark text-light rounded">05/2566</div>
                    <div class="card">
                        <div class="card-body">
                            <div class="d-flex justify-content-between p-md-1">
                                <div class="d-flex flex-row">
                                    <div class="align-self-center">
                                        <h2 class="mb-0 fw-bold"><i class="fa-solid fa-sack-dollar text-success"></i> ยอดซื้อ</h2>
                                    </div>
                                    <div class="mt-2" style="margin-left: 120px">
                                        <h4>76,456.00</h4>
                                    </div>
                                </div>
                            </div>
                            <div class="d-flex justify-content-between p-md-1">
                                <div class="d-flex flex-row">
                                    <div class="align-self-center">
                                        <h2 class="mb-0 fw-bold"><i class="fa-solid fa-receipt text-info"></i> VAT</h2>
                                    </div>
                                    <div class="mt-3" style="margin-left: 180px">
                                        <h4>7,504.00</h4>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-xl-4 col-md-12 mb-2">
                    <div class="fw-bold text-center border p-2 bg-dark text-light rounded">06/2566</div>
                    <div class="card">
                        <div class="card-body">
                            <div class="d-flex justify-content-between p-md-1">
                                <div class="d-flex flex-row">
                                    <div class="align-self-center">
                                        <h2 class="mb-0 fw-bold"><i class="fa-solid fa-sack-dollar text-success"></i> ยอดซื้อ</h2>
                                    </div>
                                    <div class="mt-2" style="margin-left: 120px">
                                        <h4>76,456.00</h4>
                                    </div>
                                </div>
                            </div>
                            <div class="d-flex justify-content-between p-md-1">
                                <div class="d-flex flex-row">
                                    <div class="align-self-center">
                                        <h2 class="mb-0 fw-bold"><i class="fa-solid fa-receipt text-info"></i> VAT</h2>
                                    </div>
                                    <div class="mt-3" style="margin-left: 180px">
                                        <h4>7,504.00</h4>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>


                <div class="col-xl-4 col-md-12 mb-2">
                    <div class="fw-bold text-center border p-2 bg-dark text-light rounded">07/2566</div>
                    <div class="card">
                        <div class="card-body">
                            <div class="d-flex justify-content-between p-md-1">
                                <div class="d-flex flex-row">
                                    <div class="align-self-center">
                                        <h2 class="mb-0 fw-bold"><i class="fa-solid fa-sack-dollar text-success"></i> ยอดซื้อ</h2>
                                    </div>
                                    <div class="mt-2" style="margin-left: 120px">
                                        <h4>76,456.00</h4>
                                    </div>
                                </div>
                            </div>
                            <div class="d-flex justify-content-between p-md-1">
                                <div class="d-flex flex-row">
                                    <div class="align-self-center">
                                        <h2 class="mb-0 fw-bold"><i class="fa-solid fa-receipt text-info"></i> VAT</h2>
                                    </div>
                                    <div class="mt-3" style="margin-left: 180px">
                                        <h4>7,504.00</h4>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>


                <div class="col-xl-4 col-md-12 mb-2">
                    <div class="fw-bold text-center border p-2 bg-dark text-light rounded">08/2566</div>
                    <div class="card">
                        <div class="card-body">
                            <div class="d-flex justify-content-between p-md-1">
                                <div class="d-flex flex-row">
                                    <div class="align-self-center">
                                        <h2 class="mb-0 fw-bold"><i class="fa-solid fa-sack-dollar text-success"></i> ยอดซื้อ</h2>
                                    </div>
                                    <div class="mt-2" style="margin-left: 120px">
                                        <h4>76,456.00</h4>
                                    </div>
                                </div>
                            </div>
                            <div class="d-flex justify-content-between p-md-1">
                                <div class="d-flex flex-row">
                                    <div class="align-self-center">
                                        <h2 class="mb-0 fw-bold"><i class="fa-solid fa-receipt text-info"></i> VAT</h2>
                                    </div>
                                    <div class="mt-3" style="margin-left: 180px">
                                        <h4>7,504.00</h4>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>


                <div class="col-xl-4 col-md-12 mb-2">
                    <div class="fw-bold text-center border p-2 bg-dark text-light rounded">09/2566</div>
                    <div class="card">
                        <div class="card-body">
                            <div class="d-flex justify-content-between p-md-1">
                                <div class="d-flex flex-row">
                                    <div class="align-self-center">
                                        <h2 class="mb-0 fw-bold"><i class="fa-solid fa-sack-dollar text-success"></i> ยอดซื้อ</h2>
                                    </div>
                                    <div class="mt-2" style="margin-left: 120px">
                                        <h4>76,456.00</h4>
                                    </div>
                                </div>
                            </div>
                            <div class="d-flex justify-content-between p-md-1">
                                <div class="d-flex flex-row">
                                    <div class="align-self-center">
                                        <h2 class="mb-0 fw-bold"><i class="fa-solid fa-receipt text-info"></i> VAT</h2>
                                    </div>
                                    <div class="mt-3" style="margin-left: 180px">
                                        <h4>7,504.00</h4>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-4 col-md-12 mb-2">
                    <div class="fw-bold text-center border p-2 bg-dark text-light rounded">10/2566</div>
                    <div class="card">
                        <div class="card-body">
                            <div class="d-flex justify-content-between p-md-1">
                                <div class="d-flex flex-row">
                                    <div class="align-self-center">
                                        <h2 class="mb-0 fw-bold"><i class="fa-solid fa-sack-dollar text-success"></i> ยอดซื้อ</h2>
                                    </div>
                                    <div class="mt-2" style="margin-left: 120px">
                                        <h4>76,456.00</h4>
                                    </div>
                                </div>
                            </div>
                            <div class="d-flex justify-content-between p-md-1">
                                <div class="d-flex flex-row">
                                    <div class="align-self-center">
                                        <h2 class="mb-0 fw-bold"><i class="fa-solid fa-receipt text-info"></i> VAT</h2>
                                    </div>
                                    <div class="mt-3" style="margin-left: 180px">
                                        <h4>7,504.00</h4>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>


                <div class="col-xl-4 col-md-12 mb-2">
                    <div class="fw-bold text-center border p-2 bg-dark text-light rounded">11/2566</div>
                    <div class="card">
                        <div class="card-body">
                            <div class="d-flex justify-content-between p-md-1">
                                <div class="d-flex flex-row">
                                    <div class="align-self-center">
                                        <h2 class="mb-0 fw-bold"><i class="fa-solid fa-sack-dollar text-success"></i> ยอดซื้อ</h2>
                                    </div>
                                    <div class="mt-2" style="margin-left: 120px">
                                        <h4>76,456.00</h4>
                                    </div>
                                </div>
                            </div>
                            <div class="d-flex justify-content-between p-md-1">
                                <div class="d-flex flex-row">
                                    <div class="align-self-center">
                                        <h2 class="mb-0 fw-bold"><i class="fa-solid fa-receipt text-info"></i> VAT</h2>
                                    </div>
                                    <div class="mt-3" style="margin-left: 180px">
                                        <h4>7,504.00</h4>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                                
                <div class="col-xl-4 col-md-12 mb-2">
                    <div class="fw-bold text-center border p-2 bg-dark text-light rounded">12/2566</div>
                    <div class="card">
                        <div class="card-body">
                            <div class="d-flex justify-content-between p-md-1">
                                <div class="d-flex flex-row">
                                    <div class="align-self-center">
                                        <h2 class="mb-0 fw-bold"><i class="fa-solid fa-sack-dollar text-success"></i> ยอดซื้อ</h2>
                                    </div>
                                    <div class="mt-2" style="margin-left: 120px">
                                        <h4>76,456.00</h4>
                                    </div>
                                </div>
                            </div>
                            <div class="d-flex justify-content-between p-md-1">
                                <div class="d-flex flex-row">
                                    <div class="align-self-center">
                                        <h2 class="mb-0 fw-bold"><i class="fa-solid fa-receipt text-info"></i> VAT</h2>
                                    </div>
                                    <div class="mt-3" style="margin-left: 180px">
                                        <h4>7,504.00</h4>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </fieldset>

        <hr>

        <fieldset class="collapse hide" id="collapseSummary2">
            <legend class="fw-bold"><i class="fa-solid fa-book"></i> สรุปยอดซื้อ (NO VAT)</legend>



            <div class="row">
                <div class="col-xl-4 col-md-12 mb-2">
                    <div class="fw-bold text-center border p-2 rounded text-light monthColor">01/2566</div>
                    <div class="card">
                        <div class="card-body">
                            <div class="d-flex justify-content-between p-md-1">
                                <div class="d-flex flex-row">
                                    <div class="align-self-center">
                                        <h2 class="mb-0 fw-bold"><i class="fa-solid fa-sack-dollar text-success"></i> ยอดซื้อ</h2>
                                    </div>
                                    <div class="mt-2" style="margin-left: 120px">
                                        <h4>76,456.00</h4>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-xl-4 col-md-12 mb-2">
                <div class="fw-bold text-center border p-2 rounded text-light monthColor">02/2566</div>
                    <div class="card">
                        <div class="card-body">
                            <div class="d-flex justify-content-between p-md-1">
                                <div class="d-flex flex-row">
                                    <div class="align-self-center">
                                        <h2 class="mb-0 fw-bold"><i class="fa-solid fa-sack-dollar text-success"></i> ยอดซื้อ</h2>
                                    </div>
                                    <div class="mt-2" style="margin-left: 120px">
                                        <h4>76,456.00</h4>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-xl-4 col-md-12 mb-2">
                <div class="fw-bold text-center border p-2 rounded text-light monthColor">03/2566</div>
                    <div class="card">
                        <div class="card-body">
                            <div class="d-flex justify-content-between p-md-1">
                                <div class="d-flex flex-row">
                                    <div class="align-self-center">
                                        <h2 class="mb-0 fw-bold"><i class="fa-solid fa-sack-dollar text-success"></i> ยอดซื้อ</h2>
                                    </div>
                                    <div class="mt-2" style="margin-left: 120px">
                                        <h4>76,456.00</h4>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-xl-4 col-md-12 mb-2">
                <div class="fw-bold text-center border p-2 rounded text-light monthColor">04/2566</div>
                    <div class="card">
                        <div class="card-body">
                            <div class="d-flex justify-content-between p-md-1">
                                <div class="d-flex flex-row">
                                    <div class="align-self-center">
                                        <h2 class="mb-0 fw-bold"><i class="fa-solid fa-sack-dollar text-success"></i> ยอดซื้อ</h2>
                                    </div>
                                    <div class="mt-2" style="margin-left: 120px">
                                        <h4>76,456.00</h4>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-xl-4 col-md-12 mb-2">
                <div class="fw-bold text-center border p-2 rounded text-light monthColor">05/2566</div>
                    <div class="card">
                        <div class="card-body">
                            <div class="d-flex justify-content-between p-md-1">
                                <div class="d-flex flex-row">
                                    <div class="align-self-center">
                                        <h2 class="mb-0 fw-bold"><i class="fa-solid fa-sack-dollar text-success"></i> ยอดซื้อ</h2>
                                    </div>
                                    <div class="mt-2" style="margin-left: 120px">
                                        <h4>76,456.00</h4>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-xl-4 col-md-12 mb-2">
                <div class="fw-bold text-center border p-2 rounded text-light monthColor">06/2566</div>
                    <div class="card">
                        <div class="card-body">
                            <div class="d-flex justify-content-between p-md-1">
                                <div class="d-flex flex-row">
                                    <div class="align-self-center">
                                        <h2 class="mb-0 fw-bold"><i class="fa-solid fa-sack-dollar text-success"></i> ยอดซื้อ</h2>
                                    </div>
                                    <div class="mt-2" style="margin-left: 120px">
                                        <h4>76,456.00</h4>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>


                <div class="col-xl-4 col-md-12 mb-2">
                <div class="fw-bold text-center border p-2 rounded text-light monthColor">07/2566</div>
                    <div class="card">
                        <div class="card-body">
                            <div class="d-flex justify-content-between p-md-1">
                                <div class="d-flex flex-row">
                                    <div class="align-self-center">
                                        <h2 class="mb-0 fw-bold"><i class="fa-solid fa-sack-dollar text-success"></i> ยอดซื้อ</h2>
                                    </div>
                                    <div class="mt-2" style="margin-left: 120px">
                                        <h4>76,456.00</h4>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>


                <div class="col-xl-4 col-md-12 mb-2">
                <div class="fw-bold text-center border p-2 rounded text-light monthColor">08/2566</div>
                    <div class="card">
                        <div class="card-body">
                            <div class="d-flex justify-content-between p-md-1">
                                <div class="d-flex flex-row">
                                    <div class="align-self-center">
                                        <h2 class="mb-0 fw-bold"><i class="fa-solid fa-sack-dollar text-success"></i> ยอดซื้อ</h2>
                                    </div>
                                    <div class="mt-2" style="margin-left: 120px">
                                        <h4>76,456.00</h4>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>


                <div class="col-xl-4 col-md-12 mb-2">
                <div class="fw-bold text-center border p-2 rounded text-light monthColor">09/2566</div>
                    <div class="card">
                        <div class="card-body">
                            <div class="d-flex justify-content-between p-md-1">
                                <div class="d-flex flex-row">
                                    <div class="align-self-center">
                                        <h2 class="mb-0 fw-bold"><i class="fa-solid fa-sack-dollar text-success"></i> ยอดซื้อ</h2>
                                    </div>
                                    <div class="mt-2" style="margin-left: 120px">
                                        <h4>76,456.00</h4>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-4 col-md-12 mb-2">
                <div class="fw-bold text-center border p-2 rounded text-light monthColor">10/2566</div>
                    <div class="card">
                        <div class="card-body">
                            <div class="d-flex justify-content-between p-md-1">
                                <div class="d-flex flex-row">
                                    <div class="align-self-center">
                                        <h2 class="mb-0 fw-bold"><i class="fa-solid fa-sack-dollar text-success"></i> ยอดซื้อ</h2>
                                    </div>
                                    <div class="mt-2" style="margin-left: 120px">
                                        <h4>76,456.00</h4>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>


                <div class="col-xl-4 col-md-12 mb-2">
                <div class="fw-bold text-center border p-2 rounded text-light monthColor">11/2566</div>
                    <div class="card">
                        <div class="card-body">
                            <div class="d-flex justify-content-between p-md-1">
                                <div class="d-flex flex-row">
                                    <div class="align-self-center">
                                        <h2 class="mb-0 fw-bold"><i class="fa-solid fa-sack-dollar text-success"></i> ยอดซื้อ</h2>
                                    </div>
                                    <div class="mt-2" style="margin-left: 120px">
                                        <h4>76,456.00</h4>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                                
                <div class="col-xl-4 col-md-12 mb-2">
                <div class="fw-bold text-center border p-2 rounded text-light monthColor">12/2566</div>
                    <div class="card">
                        <div class="card-body">
                            <div class="d-flex justify-content-between p-md-1">
                                <div class="d-flex flex-row">
                                    <div class="align-self-center">
                                        <h2 class="mb-0 fw-bold"><i class="fa-solid fa-sack-dollar text-success"></i> ยอดซื้อ</h2>
                                    </div>
                                    <div class="mt-2" style="margin-left: 120px">
                                        <h4>76,456.00</h4>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>




        </fieldset>







    </section>

    <?php include "page/modal/modal_editPassword.php"; ?>




    
</body>
</html>

<?php // } ?>