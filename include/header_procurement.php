<?php
    //session_start();
    require_once "../db/config/conn.php";
    

    if (!isset($_SESSION['admin_login'])) {
        header("location: ../../index.php");
    } 

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
    <link rel="icon" type="../image/logo/logo.jpg" href="../image/logo/logo.jpg" />
    <title>Sithichai Engineering</title>

    <!-- Bootstrap5.3.0 -->
    <link rel="stylesheet" href="../resources/lib/bootstrap5.3.0/css/bootstrap.min.css">
    <script src="../resources/lib/bootstrap5.3.0/js/bootstrap.bundle.min.js"></script>

    <!-- Font Awesome6.2.1 -->
    <link rel="stylesheet" href="../resources/lib/fontawesome6.2.1/css/fontawesome.css">
    <link rel="stylesheet" href="../resources/lib/fontawesome6.2.1/css/brands.css">
    <link rel="stylesheet" href="../resources/lib/fontawesome6.2.1/css/solid.css">

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
            <a class="navbar-brand"><img src="../image/logo/logo.jpg" class="rounded" style="width:80px"></a>
            <h5 class="text-light">สิทธิชัย เอนจิเนียริ่ง - ระบบบริหารจัดการใบเสร็จ</h5>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            
            <div class="collapse navbar-collapse" id="navbarNavDropdown">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="../page/dashboard.php">แดชบอร์ด</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="../page/incomeRecord.php">บันทึกรายรับ</a>
                    </li>
                    <li class="nav-item">
                    <a class="nav-link" href="../page/expense.php"> บันทึกรายจ่าย</a>
                    </li>
                    <li class="nav-item">
                    <a class="nav-link" href="../page/chooseBillVat.php"> เลือกบิลVAT</a>
                    </li>
                   
             
                    
                  
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false"> รายงาน</a>
                        <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                        <li><a class="dropdown-item text-black" href="../report/filterTaxSummary.php"> ภาษีซื้อ</a></li>

                            <li><a class="dropdown-item text-black" href="../report/incomeReport.php"> สรุปรายรับ</a></li>

                        </ul>
                    </li>

                   

                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false"><i class="fa-solid fa-circle-user"></i> ผู้ใช้งาน</a>
                        <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                            <li><a class="dropdown-item text-black disabled lh-1" style="font-size: 15px;"><i class="fa-solid fa-user"></i> <?php echo $userName_query['name'] . ' ' . $userName_query['lastname']; ?></a></li>
                            <li><a class="dropdown-item text-black disabled lh-1" style="font-size: 15px;"><i class="fa-solid fa-clock"></i> <span id="date"></span> <span id="clock"></span> </a></li>
                            <li><hr class="dropdown-divider"></li>
                            <li><a class="dropdown-item text-black" href="#" data-bs-toggle="modal" data-bs-target="#modalPassword<?php echo $userName_query['username']; ?>"><i class="fa-solid fa-key"></i> เปลี่ยนรหัสผ่าน</a></li>
                            <li><a class="dropdown-item text-black" href="../db/config/logout.php"><i class="fa-solid fa-right-from-bracket"></i> ออกจากระบบ</a></li>
                        </ul>
                    </li>
                </ul>
            </div>
            <script type="text/javascript" src="../resources/js/displayDateTime.js"></script>
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
                        <br>
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

    
    
</body>
</html>
