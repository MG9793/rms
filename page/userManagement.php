<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>จัดการผู้ใช้งาน | โปรแกรมจัดการใบเสร็จ - Version 1.00</title>

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
            background-color: rgb(15, 49, 147);
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

        .userManagement {
            background-color: #fff;
            border-top: 2px dotted #000;
        }
    </style>
</head>
<body>

<nav class="navbar navbar-expand-lg text-light px-4">
        <div class="container">
            <a class="navbar-brand"><img src="../image/logo/logo.jpg" style="width:80px"></a>
            <h5 class="fw-bold">สิทธิชัย เอ็นจิเนียริ่ง - ระบบจัดการใบเสร็จ v1.00</h5>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            
            <div class="collapse navbar-collapse" id="navbarNavDropdown">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="../index.php"><i class="fa-solid fa-gauge-high"></i> แดชบอร์ด</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#"><i class="fa-solid fa-dollar-sign"></i> บันทึกรายรับ</a>
                    </li>

                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false"><i class="fa-solid fa-sack-dollar"></i> บันทึกค่าใช้จ่าย</a>
                        <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <li><a class="dropdown-item text-black" href="#"><i class="fa-solid fa-person-digging"></i> ค่าแรง (LA)</a></li>
                            <li><a class="dropdown-item text-black" href="#"><i class="fa-solid fa-building"></i> สำนักงานใหญ่ (HQ)</a></li>
                            <li><a class="dropdown-item text-black" href="#"><i class="fa-solid fa-trowel-bricks"></i> ไซต์งาน (OA)</a></li>
                        </ul>
                    </li>

                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false"><i class="fa-solid fa-sheet-plastic"></i> รายงาน</a>
                        <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <li><a class="dropdown-item text-black" href="#"><i class="fa-solid fa-file-invoice-dollar"></i> ภาษีซื้อ</a></li>
                            <li><a class="dropdown-item text-black" href="#"><i class="fa-solid fa-book"></i> สรุปค่าใช้จ่าย</a></li>
                        </ul>
                    </li>

                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false"><i class="fa-solid fa-gears"></i> ตั้งค่า</a>
                        <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <li><a class="dropdown-item text-black" href="#"><i class="fa-solid fa-building-circle-check"></i> ไซต์งาน</a></li>
                            <li><a class="dropdown-item text-black disabled"><i class="fa-solid fa-user-gear"></i> ผู้ใช้งาน</a></li>
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

    <section class="container mt-3">
        <h2 class="fw-bold" style="color: rgb(15, 49, 147)"><i class="fa-solid fa-user-group"></i> ระบบจัดการผู้ใช้งาน (User Management)</h2>
        <hr class="userManagement">
        <div class="d-flex">
            <a class="btn btn-dark" role="button" data-bs-toggle="collapse" href="#collapseTable" aria-expanded="false" aria-controls="collapseTable"><i class="fa-solid fa-table-list"></i> ซ่อน/แสดง ผู้ใช้งานทั้งหมด</a>
            <a class="btn btn-dark mx-2" role="button" data-bs-toggle="collapse" href="#collapseForm" aria-expanded="false" aria-controls="collapseForm"><i class="fa-solid fa-list"></i> ซ่อน/แสดง ฟอร์มเพิ่มผู้ใช้งาน</a>
        </div>
    
        <div class="collapse show" id="collapseTable">
            <fieldset class="p-3 shadow-sm mt-2">
                <legend class="fw-bold"><i class="fa-solid fa-user-gear"></i> ผู้ใช้งานทั้งหมด (All Users)</legend>
                <table class="table table-striped table-hover table-sm table-bordered css-serial">
                    <thead class="bg-dark text-light">
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">ชื่อ</th>
                            <th scope="col">นามสกุล</th>
                            <th scope="col">ตำแหน่ง</th>
                            <th scope="col">อีเมลล์</th>
                            <th scope="col">สถานะ</th>
                            <th scope="col">แก้ไข</th>
                        </tr>
                    </thead>
                    <tbody class="align-middle">
                        <tr>
                            <td></td>
                            <td>Danai</td>
                            <td>Jantapalaboon</td>
                            <td>Front-End Developer</td>
                            <td>danai.j@sodsaisoft.com</td>
                            <td><span class="badge bg-success">Admin</span></td>
                            <td>
                                <div class="input-group">
                                    <div class="input-group-append">
                                        <button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#modalEditUser<?php //echo $userAccount['id_users']; ?>"><i class="fas fa-edit"></i></button>
                                        <button type="button" class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target=""><i class="fas fa-trash"></i></button>
                                    </div>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td></td>
                            <td>Hermione</td>
                            <td>Granger</td>
                            <td>FullStack Developer</td>
                            <td>hermione.g@sodsaisoft.com</td>
                            <td><span class="badge bg-warning">User</span></td>
                            <td>
                                <div class="input-group">
                                    <div class="input-group-append">
                                        <button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#modalEditUser<?php //echo $userAccount['id_users']; ?>"><i class="fas fa-edit"></i></button>
                                        <button type="button" class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target=""><i class="fas fa-trash"></i></button>
                                    </div>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td></td>
                            <td>นายทดสอบ</td>
                            <td>นามสกุลทดสอบ</td>
                            <td>test01</td>
                            <td>admin01@admin.com</td>
                            <td><span class="badge bg-warning">User</span></td>
                            <td>
                                <div class="input-group">
                                    <div class="input-group-append">
                                        <button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#modalEditUser<?php //echo $userAccount['id_users']; ?>"><i class="fas fa-edit"></i></button>
                                        <button type="button" class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target=""><i class="fas fa-trash"></i></button>
                                    </div>
                                </div>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </fieldset>
        </div>

        <div class="collapse show" id="collapseForm">
            <fieldset class="p-3 shadow-sm mt-2">
                <legend class="fw-bold"><i class="fa-solid fa-user-plus"></i> เพิ่มผู้ใช้งาน (Add Users)</legend>

                <form action="#" method="POST">
                    <div class="row mb-3">
                        <div class="col-md">
                            <label for="FormControlName" class="form-label fw-bold">ชื่อ :</label>
                            <input type="text" name="name" class="form-control" id="FormControlName" placeholder="Your name.." required>
                        </div>
                        <div class="col-md">
                            <label for="FormControlLastname" class="form-label fw-bold">นามสกุล :</label>
                            <input type="text" name="lastName" class="form-control" id="FormControlLastname" placeholder="Your Lastname.." required>
                        </div>
                        <div class="col-md">
                        <label for="position" class="form-label fw-bold">ตำแหน่ง :</label>
                            <select class="form-select" aria-label="position" name="position" required>
                                <option>ตำแหน่ง 1</option>
                                <option>ตำแหน่ง 2</option>
                                <option>ตำแหน่ง 3</option>
                            </select>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-md-4">
                            <label for="FormControlEmail" class="form-label fw-bold">Email Address (ใช้เป็น Username) :</label>
                            <input type="email" name="email" class="form-control" id="FormControlEmail" placeholder="name@example.com" required>
                        </div>
                        <div class="col-md-4">
                            <label for="userStatus" class="form-label fw-bold">สถานะการใช้งานระบบ :</label>
                            <select class="form-select" aria-label="userStatus" name="userStatus" required>
                                <option>Admin</option>
                                <option>User</option>
                            </select>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-md-4">
                            <label for="FormControlPassword" class="form-label fw-bold">Password (อย่างน้อย 8 ตัวอักษร) :</label>
                            <input type="password" name="password" class="form-control" id="FormControlPassword" placeholder="xxxxxxxx" minlength="8" required>
                        </div>
                        <div class="col-md-4">
                            <label for="FormControlConfirmPassword" class="form-label fw-bold">Confirm Password :</label>
                            <input type="password" name="confirmPassword" class="form-control" id="FormControlConfirmPassword" placeholder="xxxxxxxx" minlength="8" required>
                        </div>
                    </div>

                    <div class="row mb-2">
                        <div class="col-md-8">
                            <button type="submit" name="registerUser" class="btn btn-danger w-100"><i class="fa-solid fa-user-plus"></i> Register</button>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-8">
                            <button type="reset" class="btn btn-dark w-100"><i class="fa-solid fa-rotate-right"></i> Reset</button>
                        </div>
                    </div>
                </form>


            </fieldset>
        </div>



    </section>  <!-- Closing Tag Container -->


    <?php include "modal/modal_editUser.php"; ?>
    <?php include "modal/modal_editPassword.php"; ?>
</body>
</html>