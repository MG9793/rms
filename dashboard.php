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
            background-color: rgb(15, 49, 147);
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
    </style>
</head>
<body>
    
    <nav class="navbar navbar-expand-lg text-light px-4">
        <div class="container">
            <a class="navbar-brand"><img src="image/logo/logo.jpg" style="width:80px"></a>
            <h5 class="fw-bold">สิทธิชัย เอ็นจิเนียริ่ง - ระบบจัดการใบเสร็จ v1.00</h5>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            
            <div class="collapse navbar-collapse" id="navbarNavDropdown">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link " href="dashboard.php"><i class="fa-solid fa-gauge-high"></i> แดชบอร์ด</a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false"><i class="fa-solid fa-sack-dollar"></i> บันทึกรายรับ</a>
                        <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <li><a class="dropdown-item text-black" href="#"><i class="fa-solid "></i> ยอดรวม </a></li>
                            <li><a class="dropdown-item text-black" href="#"><i class="fa-solid "></i> รายละเอียด </a></li>
                        
                        </ul>
                    </li>
                    

                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false"><i class="fa-solid fa-sack-dollar"></i> บันทึกค่าใช้จ่าย</a>
                        <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                            
                            <li><a class="dropdown-item text-black" href="#"><i class="fa-solid "></i> มีภาษี</a></li>
                            <li><a class="dropdown-item text-black" href="#"><i class="fa-solid "></i> ไม่มีภาษี </a></li>
                        
                        </ul>
                    </li>
                    

                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false"><i class="fa-solid fa-sheet-plastic"></i> รายงาน</a>
                        <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <li><a class="dropdown-item text-black" href="#"><i class="fa-solid "></i> ภาษีซื้อ</a></li>
                            <li><a class="dropdown-item text-black" href="#"><i class="fa-solid "></i> สรุปรายรับ-รายจ่าย</a></li>
                            <li><a class="dropdown-item text-black" href="#"><i class="fa-solid "></i> สรุปรายรับ</a></li>
                            <li><a class="dropdown-item text-black" href="#"><i class="fa-solid "></i> สรุปรายจ่าย</a></li>
                            <li><a class="dropdown-item text-black" href="#"><i class="fa-solid "></i> สรุปยอดไซต์งาน(VAT)</a></li>
                            <li><a class="dropdown-item text-black" href="#"><i class="fa-solid "></i> สรุปยอดไซต์งาน(NO VAT)</a></li>
                            <li><a class="dropdown-item text-black" href="#"><i class="fa-solid "></i> สรุปยอดไซต์งาน(ทั้งหมด)</a></li>
                            <li><a class="dropdown-item text-black" href="#"><i class="fa-solid "></i> กระจายค่าใช้จ่าย</a></li>
                        </ul>
                    </li>

                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false"><i class="fa-solid fa-gears"></i> ตั้งค่า</a>
                        <ul class="dropdown-menu" aria-labelledby="navbarDropdown">

                            <li><a class="dropdown-item text-black" href="page/userManagement.php"><i class="fa-solid "></i> เพิ่มผู้ใช้งาน</a></li>
                            <li><a class="dropdown-item text-black" href="#"><i class="fa-solid "></i> เพิ่มไซต์งาน</a></li>
                            <li><a class="dropdown-item text-black" href="#"><i class="fa-solid "></i> เพิ่มรายการสินค้า</a></li>
                            <li><a class="dropdown-item text-black" href="#"><i class="fa-solid "></i> เพิ่มข้อมูลผู้ขาย</a></li>
                        </ul>
                    </li>

                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false"><i class="fa-solid fa-circle-user"></i> ผู้ใช้งาน</a>
                        <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                            <li><a class="dropdown-item text-secondary disabled" style="font-size: 15px;"><i class="fa-solid fa-user"></i> สิทธิชัย</a></li>
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
        <h2 class="fw-bold" style="color: rgb(15, 49, 147)"><i class="fa-solid fa-gauge-high"></i> บิล VAT</h2>
        <hr class="dashboard">
        <fieldset>
            
            <div class="row">
                <div class="col-xl-4 col-md-12 mb-2">
                <div class="card">
                <div class="card bg-dark text-white text-center">
                <div class="card-header">
                    <h2>01/66</h2>
                    </div>
                        </div>
                    
                        <div class="card-body ">
                            <div class="d-flex justify-content-between p-md-1">
                                
                                <div class="d-flex flex-row">
                                    
                                    <div>
                                        <h4>ยอดซื้อ</h4>
                                        <p class="mb-0">ภาษีซื้อ</p>
                                    </div>
                                </div>
                                <div class="align-self-center">
                                        <h4>10,000,000.00</h4>
                                        <p class="mb-0" >700,000.00</p>
                                </div>
                            </div>
                        </div>
                    
                        </div>
                </div>
                <div class="col-xl-4 col-md-12 mb-2">
                <div class="card">
                <div class="card bg-dark text-white text-center">
                <div class="card-header">
                    <h2>02/66</h2>
                    </div>
                        </div>
                    
                        <div class="card-body ">
                            <div class="d-flex justify-content-between p-md-1">
                                
                                <div class="d-flex flex-row">
                                    
                                    <div>
                                        <h4>ยอดซื้อ</h4>
                                        <p class="mb-0">ภาษีซื้อ</p>
                                    </div>
                                </div>
                                <div class="align-self-center">
                                        <h4>10,000,000.00</h4>
                                        <p class="mb-0" >700,000.00</p>
                                </div>
                            </div>
                        </div>
                    
                        </div>
                </div>
                <div class="col-xl-4 col-md-12 mb-2">
                <div class="card">
                <div class="card bg-dark text-white text-center">
                <div class="card-header">
                    <h2>03/66</h2>
                    </div>
                        </div>
                    
                        <div class="card-body ">
                            <div class="d-flex justify-content-between p-md-1">
                                
                                <div class="d-flex flex-row">
                                    
                                    <div>
                                        <h4>ยอดซื้อ</h4>
                                        <p class="mb-0">ภาษีซื้อ</p>
                                    </div>
                                </div>
                                <div class="align-self-center">
                                        <h4>10,000,000.00</h4>
                                        <p class="mb-0" >700,000.00</p>
                                </div>
                            </div>
                        </div>
                    
                        </div>
                </div>

                <div class="col">

    </div>
                
            </div>
            </br>
            <div class="row">
                <div class="col-xl-4 col-md-12 mb-2">
                <div class="card">
                <div class="card bg-dark text-white text-center">
                <div class="card-header">
                    <h2>04/66</h2>
                    </div>
                        </div>
                    
                        <div class="card-body ">
                            <div class="d-flex justify-content-between p-md-1">
                                
                                <div class="d-flex flex-row">
                                    
                                    <div>
                                        <h4>ยอดซื้อ</h4>
                                        <p class="mb-0">ภาษีซื้อ</p>
                                    </div>
                                </div>
                                <div class="align-self-center">
                                        <h4>10,000,000.00</h4>
                                        <p class="mb-0" >700,000.00</p>
                                </div>
                            </div>
                        </div>
                    
                        </div>
                </div>
                <div class="col-xl-4 col-md-12 mb-2">
                <div class="card">
                <div class="card bg-dark text-white text-center">
                <div class="card-header">
                    <h2>05/66</h2>
                    </div>
                        </div>
                    
                        <div class="card-body ">
                            <div class="d-flex justify-content-between p-md-1">
                                
                                <div class="d-flex flex-row">
                                    
                                    <div>
                                        <h4>ยอดซื้อ</h4>
                                        <p class="mb-0">ภาษีซื้อ</p>
                                    </div>
                                </div>
                                <div class="align-self-center">
                                        <h4>10,000,000.00</h4>
                                        <p class="mb-0" >700,000.00</p>
                                </div>
                            </div>
                        </div>
                    
                        </div>
                </div>
                <div class="col-xl-4 col-md-12 mb-2">
                <div class="card">
                <div class="card bg-dark text-white text-center">
                <div class="card-header">
                    <h2>06/66</h2>
                    </div>
                        </div>
                    
                        <div class="card-body ">
                            <div class="d-flex justify-content-between p-md-1">
                                
                                <div class="d-flex flex-row">
                                    
                                    <div>
                                        <h4>ยอดซื้อ</h4>
                                        <p class="mb-0">ภาษีซื้อ</p>
                                    </div>
                                </div>
                                <div class="align-self-center">
                                        <h4>10,000,000.00</h4>
                                        <p class="mb-0" >700,000.00</p>
                                </div>
                            </div>
                        </div>
                    
                        </div>
                </div>

                <div class="col">

    </div>
                
            </div>
            </br>
            <div class="row">
                <div class="col-xl-4 col-md-12 mb-2">
                <div class="card">
                <div class="card bg-dark text-white text-center">
                <div class="card-header">
                    <h2>07/66</h2>
                    </div>
                        </div>
                    
                        <div class="card-body ">
                            <div class="d-flex justify-content-between p-md-1">
                                
                                <div class="d-flex flex-row">
                                    
                                    <div>
                                        <h4>ยอดซื้อ</h4>
                                        <p class="mb-0">ภาษีซื้อ</p>
                                    </div>
                                </div>
                                <div class="align-self-center">
                                        <h4>10,000,000.00</h4>
                                        <p class="mb-0" >700,000.00</p>
                                </div>
                            </div>
                        </div>
                    
                        </div>
                </div>
                <div class="col-xl-4 col-md-12 mb-2">
                <div class="card">
                <div class="card bg-dark text-white text-center">
                <div class="card-header">
                    <h2>08/66</h2>
                    </div>
                        </div>
                    
                        <div class="card-body ">
                            <div class="d-flex justify-content-between p-md-1">
                                
                                <div class="d-flex flex-row">
                                    
                                    <div>
                                        <h4>ยอดซื้อ</h4>
                                        <p class="mb-0">ภาษีซื้อ</p>
                                    </div>
                                </div>
                                <div class="align-self-center">
                                        <h4>10,000,000.00</h4>
                                        <p class="mb-0" >700,000.00</p>
                                </div>
                            </div>
                        </div>
                    
                        </div>
                </div>
                <div class="col-xl-4 col-md-12 mb-2">
                <div class="card">
                <div class="card bg-dark text-white text-center">
                <div class="card-header">
                    <h2>09/66</h2>
                    </div>
                        </div>
                    
                        <div class="card-body ">
                            <div class="d-flex justify-content-between p-md-1">
                                
                                <div class="d-flex flex-row">
                                    
                                    <div>
                                        <h4>ยอดซื้อ</h4>
                                        <p class="mb-0">ภาษีซื้อ</p>
                                    </div>
                                </div>
                                <div class="align-self-center">
                                        <h4>10,000,000.00</h4>
                                        <p class="mb-0" >700,000.00</p>
                                </div>
                            </div>
                        </div>
                    
                        </div>
                </div>

                <div class="col">

    </div>
                
            </div>
    </br>
    <div class="row">
                <div class="col-xl-4 col-md-12 mb-2">
                <div class="card">
                <div class="card bg-dark text-white text-center">
                <div class="card-header">
                    <h2>10/66</h2>
                    </div>
                        </div>
                    
                        <div class="card-body ">
                            <div class="d-flex justify-content-between p-md-1">
                                
                                <div class="d-flex flex-row">
                                    
                                    <div>
                                        <h4>ยอดซื้อ</h4>
                                        <p class="mb-0">ภาษีซื้อ</p>
                                    </div>
                                </div>
                                <div class="align-self-center">
                                        <h4>10,000,000.00</h4>
                                        <p class="mb-0" >700,000.00</p>
                                </div>
                            </div>
                        </div>
                    
                        </div>
                </div>
                <div class="col-xl-4 col-md-12 mb-2">
                <div class="card">
                <div class="card bg-dark text-white text-center">
                <div class="card-header">
                    <h2>11/66</h2>
                    </div>
                        </div>
                    
                        <div class="card-body ">
                            <div class="d-flex justify-content-between p-md-1">
                                
                                <div class="d-flex flex-row">
                                    
                                    <div>
                                        <h4>ยอดซื้อ</h4>
                                        <p class="mb-0">ภาษีซื้อ</p>
                                    </div>
                                </div>
                                <div class="align-self-center">
                                        <h4>10,000,000.00</h4>
                                        <p class="mb-0" >700,000.00</p>
                                </div>
                            </div>
                        </div>
                    
                        </div>
                </div>
                <div class="col-xl-4 col-md-12 mb-2">
                <div class="card">
                <div class="card bg-dark text-white text-center">
                <div class="card-header">
                    <h2>12/66</h2>
                    </div>
                        </div>
                    
                        <div class="card-body ">
                            <div class="d-flex justify-content-between p-md-1">
                                
                                <div class="d-flex flex-row">
                                    
                                    <div>
                                        <h4>ยอดซื้อ</h4>
                                        <p class="mb-0">ภาษีซื้อ</p>
                                    </div>
                                </div>
                                <div class="align-self-center">
                                        <h4>10,000,000.00</h4>
                                        <p class="mb-0" >700,000.00</p>
                                </div>
                            </div>
                        </div>
                    
                        </div>
                </div>

                <div class="col">

    </div>
                
            </div>
        </fieldset>
    </section>

    <?php include "page/modal/modal_editPassword.php"; ?>




    
</body>
</html>

<?php // } ?>