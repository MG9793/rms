<?php
    session_start();
    require_once "db/config/conn.php";
    require_once "db/config/deleteRow.php";
    

    if (!isset($_SESSION['admin_login'])) {
        header("location: login.php");
    } else {
        require_once "db/db_dashboard.php";
        

        

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/logo/logo.jpg" href="image/logo/logo.jpg" />
    <title>Sithichai Engineering</title>

    <!-- Bootstrap5.3.0 -->
    <link rel="stylesheet" href="resources/lib/bootstrap5.3.0/css/bootstrap.min.css">
    <script src="resources/lib/bootstrap5.3.0/js/bootstrap.bundle.min.js"></script>

    <!-- Font Awesome6.2.1 -->
    <link rel="stylesheet" href="resources/lib/fontawesome6.2.1/css/fontawesome.css">
    <link rel="stylesheet" href="resources/lib/fontawesome6.2.1/css/brands.css">
    <link rel="stylesheet" href="resources/lib/fontawesome6.2.1/css/solid.css">

    <!-- Font kanit-300 ห้ามเอาออก -->
    <style>
        @font-face {
            font-display: swap;
            font-family: 'Kanit';
            font-style: normal;
            font-weight: 300;
            src: url('resources/fonts/kanit-v12-latin_thai-300.eot'); /* IE9 Compat Modes */
            src: url('resources/fonts/kanit-v12-latin_thai-300.eot?#iefix') format('embedded-opentype'), /* IE6-IE8 */
                url('resources/fonts/kanit-v12-latin_thai-300.woff2') format('woff2'), /* Super Modern Browsers */
                url('resources/fonts/kanit-v12-latin_thai-300.woff') format('woff'), /* Modern Browsers */
                url('resources/fonts/kanit-v12-latin_thai-300.ttf') format('truetype'), /* Safari, Android, iOS */
                url('resources/fonts/kanit-v12-latin_thai-300.svg#Kanit') format('svg'); /* Legacy iOS */
        }

        body {
            background-color: rgb(230, 230, 230);
            font-family: 'Kanit', sans-serif;
            margin: 0;
            padding: 0;
        }

        .navbar .nav-item a {
            color: #fff;
        }

        .navbar .nav-item a:hover {
            color: yellow;
        }

        .monthColor {
            background-color: grey;
        }
    </style>
</head>
<body>
    
    <!-- navbar ห้ามลบ -->
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
                        <a class="nav-link disabled" href="index.php">แดชบอร์ด</a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">บันทึกค่าใช้จ่าย</a>
                        <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <li><a class="dropdown-item text-black" href="page/expenseTotal.php">ยอดรวม</a></li>
                            <li><a class="dropdown-item text-black" href="page/expenseDetails.php">รายละเอียดสินค้า</a></li>
                        </ul>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">กระจายค่าใช้จ่าย</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="page/incomeRecord.php">บันทึกรายรับ</a>
                    </li>

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
                            <li><a class="dropdown-item text-black disabled lh-1" style="font-size: 15px;"><i class="fa-solid fa-user"></i> <?php echo $userName_query['name'] . ' ' . $userName_query['lastname']; ?></a></li>
                            <li><a class="dropdown-item text-black disabled lh-1" style="font-size: 15px;"><i class="fa-solid fa-clock"></i> <span id="date"></span> <span id="clock"></span> </a></li>
                            <li><hr class="dropdown-divider"></li>
                            <li><a class="dropdown-item text-black" href="#" data-bs-toggle="modal" data-bs-target="#modalPassword<?php echo $userName_query['username']; ?>"><i class="fa-solid fa-key"></i> เปลี่ยนรหัสผ่าน</a></li>
                            <li><a class="dropdown-item text-black" href="db/config/logout.php"><i class="fa-solid fa-right-from-bracket"></i> ออกจากระบบ</a></li>
                        </ul>
                    </li>
                </ul>
            </div>
            <script type="text/javascript" src="resources/js/displayDateTime.js"></script>
        </div>
    </nav>

    <!-- Edit Password ห้ามลบ -->
    <div class="modal fade" id="modalPassword<?php echo $userName_query['username']; ?>" tabindex="-1" aria-labelledby="modalPassword" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalPassword"><i class="fa-solid fa-pen-to-square"></i> แก้ไขรหัสผ่าน (Edit Password)</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <div class="modal-body">
                    <form action="db/db_userManagement.php" method="POST">
                        <div class="mb-0">
                            <label for="text" class="col-form-label font-weight-normal">ชื่อผู้ใช้ :</label>
                            <input type="text" class="form-control" name="getUsername" value="<?php echo $userName_query['username']; ?>" required readonly>
                        </div>
                        <hr>
                        <div class="mb-0">
                            <label for="password" class="col-form-label font-weight-normal">รหัสผ่าน (อย่างน้อย 8 ตัวอักษร) :</label>
                            <input type="password" class="form-control" name="password" id="password" minlength="8" required>
                        </div>
                        <div class="mb-2">
                            <label for="confirmPassword" class="col-form-label font-weight-normal">ยืนยันรหัสผ่าน :</label>
                            <input type="password" class="form-control" name="confirmPassword" id="confirmPassword" minlength="8" required>
                        </div>

                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-dark" name="editPassword"><i class="fa-solid fa-floppy-disk"></i> Save</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- pagename ห้ามลบ 
 
    <section class="container mt-2">
        <legend class="fw-bold text-dark text-center border border-3 border-light bg-secondary shadow-sm p-2">แดชบอร์ด</legend>
    </section>
-->
    <!-- pagename ห้ามลบ -->
    <section class="container mt-3">
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
                                    <h6 class="fw-bold">ไซต์งาน</h6>
                                </div>
                            </div>
                            <div class="align-self-center">
                                <h6 class="mb-0"><?php echo $site_rowCount ?></h6>
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
                                    <h6 class="fw-bold">ค่าวัสดุ</h6>
                                </div>
                            </div>
                            <div class="align-self-center">
                                <h6 class="mb-0"><?php echo number_format(($materialSum),2) ?></h6>
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
                                    <h6 class="fw-bold">ค่าแรง</h6>
                                </div>
                            </div>
                            <div class="align-self-center">
                                <h6 class="mb-0"><?php echo number_format(($labourSum),2) ?></h6>
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
                                    <h6 class="fw-bold">รวม</h6>
                                </div>
                            </div>
                            <div class="align-self-center">
                                <h6 class="mb-0"><?php echo number_format(($materialSum+$labourSum),2) ?></h6>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    <br>

 
            <legend class="fw-bold"><i class="fa-solid fa-book"></i> สรุปยอดซื้อ (VAT)</legend>
            <div class="row">
                <div class="col-xl-4 col-md-12 mb-2">
                    <div class="fw-bold text-center border p-2 bg-dark text-light rounded"><?php echo date("01/Y") ?></div>
                    <div class="card">
                        <div class="card-body">
                            <div class="d-flex justify-content-between p-md-1">
                                <div class="d-flex flex-row">
                                    <div class="align-self-center">
                                        <h2 class="mb-0 fw-bold"><i class="fa-solid fa-sack-dollar text-success"></i> ยอดซื้อ</h2>
                                    </div>
                                    <div class="mt-2" style="margin-left: 120px">
                                        <h4><?php echo number_format(($sumM01),2) ?></h4>
                                    </div>
                                </div>
                            </div>
                            <div class="d-flex justify-content-between p-md-1">
                                <div class="d-flex flex-row">
                                    <div class="align-self-center">
                                        <h2 class="mb-0 fw-bold"><i class="fa-solid fa-receipt text-info"></i> VAT</h2>
                                    </div>
                                    <div class="mt-3" style="margin-left: 180px">
                                        <h4><?php echo number_format(($vatM01),2) ?></h4>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-xl-4 col-md-12 mb-2">
                    <div class="fw-bold text-center border p-2 bg-dark text-light rounded"><?php echo date("02/Y") ?></div>
                    <div class="card">
                        <div class="card-body">
                            <div class="d-flex justify-content-between p-md-1">
                                <div class="d-flex flex-row">
                                    <div class="align-self-center">
                                        <h2 class="mb-0 fw-bold"><i class="fa-solid fa-sack-dollar text-success"></i> ยอดซื้อ</h2>
                                    </div>
                                    <div class="mt-2" style="margin-left: 120px">
                                        <h4><?php echo number_format(($sumM02),2) ?></h4>
                                    </div>
                                </div>
                            </div>
                            <div class="d-flex justify-content-between p-md-1">
                                <div class="d-flex flex-row">
                                    <div class="align-self-center">
                                        <h2 class="mb-0 fw-bold"><i class="fa-solid fa-receipt text-info"></i> VAT</h2>
                                    </div>
                                    <div class="mt-3" style="margin-left: 180px">
                                        <h4><?php echo number_format(($vatM02),2) ?></h4>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-xl-4 col-md-12 mb-2">
                    <div class="fw-bold text-center border p-2 bg-dark text-light rounded"><?php echo date("03/Y") ?></div>
                    <div class="card">
                        <div class="card-body">
                            <div class="d-flex justify-content-between p-md-1">
                                <div class="d-flex flex-row">
                                    <div class="align-self-center">
                                        <h2 class="mb-0 fw-bold"><i class="fa-solid fa-sack-dollar text-success"></i> ยอดซื้อ</h2>
                                    </div>
                                    <div class="mt-2" style="margin-left: 120px">
                                        <h4><?php echo number_format(($sumM03),2) ?></h4>
                                    </div>
                                </div>
                            </div>
                            <div class="d-flex justify-content-between p-md-1">
                                <div class="d-flex flex-row">
                                    <div class="align-self-center">
                                        <h2 class="mb-0 fw-bold"><i class="fa-solid fa-receipt text-info"></i> VAT</h2>
                                    </div>
                                    <div class="mt-3" style="margin-left: 180px">
                                        <h4><?php echo number_format(($vatM03),2) ?></h4>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-xl-4 col-md-12 mb-2">
                    <div class="fw-bold text-center border p-2 bg-dark text-light rounded"><?php echo date("04/Y") ?></div>
                    <div class="card">
                        <div class="card-body">
                            <div class="d-flex justify-content-between p-md-1">
                                <div class="d-flex flex-row">
                                    <div class="align-self-center">
                                        <h2 class="mb-0 fw-bold"><i class="fa-solid fa-sack-dollar text-success"></i> ยอดซื้อ</h2>
                                    </div>
                                    <div class="mt-2" style="margin-left: 120px">
                                        <h4><?php echo number_format(($sumM04),2) ?></h4>
                                    </div>
                                </div>
                            </div>
                            <div class="d-flex justify-content-between p-md-1">
                                <div class="d-flex flex-row">
                                    <div class="align-self-center">
                                        <h2 class="mb-0 fw-bold"><i class="fa-solid fa-receipt text-info"></i> VAT</h2>
                                    </div>
                                    <div class="mt-3" style="margin-left: 180px">
                                        <h4><?php echo number_format(($vatM04),2) ?></h4>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-xl-4 col-md-12 mb-2">
                    <div class="fw-bold text-center border p-2 bg-dark text-light rounded"><?php echo date("05/Y") ?></div>
                    <div class="card">
                        <div class="card-body">
                            <div class="d-flex justify-content-between p-md-1">
                                <div class="d-flex flex-row">
                                    <div class="align-self-center">
                                        <h2 class="mb-0 fw-bold"><i class="fa-solid fa-sack-dollar text-success"></i> ยอดซื้อ</h2>
                                    </div>
                                    <div class="mt-2" style="margin-left: 120px">
                                        <h4><?php echo number_format(($sumM05),2) ?></h4>
                                    </div>
                                </div>
                            </div>
                            <div class="d-flex justify-content-between p-md-1">
                                <div class="d-flex flex-row">
                                    <div class="align-self-center">
                                        <h2 class="mb-0 fw-bold"><i class="fa-solid fa-receipt text-info"></i> VAT</h2>
                                    </div>
                                    <div class="mt-3" style="margin-left: 180px">
                                        <h4><?php echo number_format(($vatM05),2) ?></h4>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-xl-4 col-md-12 mb-2">
                    <div class="fw-bold text-center border p-2 bg-dark text-light rounded"><?php echo date("06/Y") ?></div>
                    <div class="card">
                        <div class="card-body">
                            <div class="d-flex justify-content-between p-md-1">
                                <div class="d-flex flex-row">
                                    <div class="align-self-center">
                                        <h2 class="mb-0 fw-bold"><i class="fa-solid fa-sack-dollar text-success"></i> ยอดซื้อ</h2>
                                    </div>
                                    <div class="mt-2" style="margin-left: 120px">
                                        <h4><?php echo number_format(($sumM06),2) ?></h4>
                                    </div>
                                </div>
                            </div>
                            <div class="d-flex justify-content-between p-md-1">
                                <div class="d-flex flex-row">
                                    <div class="align-self-center">
                                        <h2 class="mb-0 fw-bold"><i class="fa-solid fa-receipt text-info"></i> VAT</h2>
                                    </div>
                                    <div class="mt-3" style="margin-left: 180px">
                                        <h4><?php echo number_format(($vatM06),2) ?></h4>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>


                <div class="col-xl-4 col-md-12 mb-2">
                    <div class="fw-bold text-center border p-2 bg-dark text-light rounded"><?php echo date("07/Y") ?></div>
                    <div class="card">
                        <div class="card-body">
                            <div class="d-flex justify-content-between p-md-1">
                                <div class="d-flex flex-row">
                                    <div class="align-self-center">
                                        <h2 class="mb-0 fw-bold"><i class="fa-solid fa-sack-dollar text-success"></i> ยอดซื้อ</h2>
                                    </div>
                                    <div class="mt-2" style="margin-left: 120px">
                                        <h4><?php echo number_format(($sumM07),2) ?></h4>
                                    </div>
                                </div>
                            </div>
                            <div class="d-flex justify-content-between p-md-1">
                                <div class="d-flex flex-row">
                                    <div class="align-self-center">
                                        <h2 class="mb-0 fw-bold"><i class="fa-solid fa-receipt text-info"></i> VAT</h2>
                                    </div>
                                    <div class="mt-3" style="margin-left: 180px">
                                        <h4><?php echo number_format(($vatM07),2) ?></h4>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>


                <div class="col-xl-4 col-md-12 mb-2">
                    <div class="fw-bold text-center border p-2 bg-dark text-light rounded"><?php echo date("08/Y") ?></div>
                    <div class="card">
                        <div class="card-body">
                            <div class="d-flex justify-content-between p-md-1">
                                <div class="d-flex flex-row">
                                    <div class="align-self-center">
                                        <h2 class="mb-0 fw-bold"><i class="fa-solid fa-sack-dollar text-success"></i> ยอดซื้อ</h2>
                                    </div>
                                    <div class="mt-2" style="margin-left: 120px">
                                        <h4><?php echo number_format(($sumM08),2) ?></h4>
                                    </div>
                                </div>
                            </div>
                            <div class="d-flex justify-content-between p-md-1">
                                <div class="d-flex flex-row">
                                    <div class="align-self-center">
                                        <h2 class="mb-0 fw-bold"><i class="fa-solid fa-receipt text-info"></i> VAT</h2>
                                    </div>
                                    <div class="mt-3" style="margin-left: 180px">
                                        <h4><?php echo number_format(($vatM08),2) ?></h4>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>


                <div class="col-xl-4 col-md-12 mb-2">
                    <div class="fw-bold text-center border p-2 bg-dark text-light rounded"><?php echo date("09/Y") ?></div>
                    <div class="card">
                        <div class="card-body">
                            <div class="d-flex justify-content-between p-md-1">
                                <div class="d-flex flex-row">
                                    <div class="align-self-center">
                                        <h2 class="mb-0 fw-bold"><i class="fa-solid fa-sack-dollar text-success"></i> ยอดซื้อ</h2>
                                    </div>
                                    <div class="mt-2" style="margin-left: 120px">
                                        <h4><?php echo number_format(($sumM09),2) ?></h4>
                                    </div>
                                </div>
                            </div>
                            <div class="d-flex justify-content-between p-md-1">
                                <div class="d-flex flex-row">
                                    <div class="align-self-center">
                                        <h2 class="mb-0 fw-bold"><i class="fa-solid fa-receipt text-info"></i> VAT</h2>
                                    </div>
                                    <div class="mt-3" style="margin-left: 180px">
                                        <h4><?php echo number_format(($vatM09),2) ?></h4>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-4 col-md-12 mb-2">
                    <div class="fw-bold text-center border p-2 bg-dark text-light rounded"><?php echo date("10/Y") ?></div>
                    <div class="card">
                        <div class="card-body">
                            <div class="d-flex justify-content-between p-md-1">
                                <div class="d-flex flex-row">
                                    <div class="align-self-center">
                                        <h2 class="mb-0 fw-bold"><i class="fa-solid fa-sack-dollar text-success"></i> ยอดซื้อ</h2>
                                    </div>
                                    <div class="mt-2" style="margin-left: 120px">
                                        <h4><?php echo number_format(($sumM10),2) ?></h4>
                                    </div>
                                </div>
                            </div>
                            <div class="d-flex justify-content-between p-md-1">
                                <div class="d-flex flex-row">
                                    <div class="align-self-center">
                                        <h2 class="mb-0 fw-bold"><i class="fa-solid fa-receipt text-info"></i> VAT</h2>
                                    </div>
                                    <div class="mt-3" style="margin-left: 180px">
                                        <h4><?php echo number_format(($vatM10),2) ?></h4>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>


                <div class="col-xl-4 col-md-12 mb-2">
                    <div class="fw-bold text-center border p-2 bg-dark text-light rounded"><?php echo date("11/Y") ?></div>
                    <div class="card">
                        <div class="card-body">
                            <div class="d-flex justify-content-between p-md-1">
                                <div class="d-flex flex-row">
                                    <div class="align-self-center">
                                        <h2 class="mb-0 fw-bold"><i class="fa-solid fa-sack-dollar text-success"></i> ยอดซื้อ</h2>
                                    </div>
                                    <div class="mt-2" style="margin-left: 120px">
                                        <h4><?php echo number_format(($sumM11),2) ?></h4>
                                    </div>
                                </div>
                            </div>
                            <div class="d-flex justify-content-between p-md-1">
                                <div class="d-flex flex-row">
                                    <div class="align-self-center">
                                        <h2 class="mb-0 fw-bold"><i class="fa-solid fa-receipt text-info"></i> VAT</h2>
                                    </div>
                                    <div class="mt-3" style="margin-left: 180px">
                                        <h4><?php echo number_format(($vatM11),2) ?></h4>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                                
                <div class="col-xl-4 col-md-12 mb-2">
                    <div class="fw-bold text-center border p-2 bg-dark text-light rounded"><?php echo date("12/Y") ?></div>
                    <div class="card">
                        <div class="card-body">
                            <div class="d-flex justify-content-between p-md-1">
                                <div class="d-flex flex-row">
                                    <div class="align-self-center">
                                        <h2 class="mb-0 fw-bold"><i class="fa-solid fa-sack-dollar text-success"></i> ยอดซื้อ</h2>
                                    </div>
                                    <div class="mt-2" style="margin-left: 120px">
                                        <h4><?php echo number_format(($sumM12),2) ?></h4>
                                    </div>
                                </div>
                            </div>
                            <div class="d-flex justify-content-between p-md-1">
                                <div class="d-flex flex-row">
                                    <div class="align-self-center">
                                        <h2 class="mb-0 fw-bold"><i class="fa-solid fa-receipt text-info"></i> VAT</h2>
                                    </div>
                                    <div class="mt-3" style="margin-left: 180px">
                                        <h4><?php echo number_format(($vatM12),2) ?></h4>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>


        <hr>
    </section>
    
</body>
</html>

<?php  } ?>