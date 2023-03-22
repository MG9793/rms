<?php session_start(); ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>เข้าสู่ระบบ | ระบบบริหารจัดการใบเสร็จ</title>

    <!-- Bootstrap5.3.0 -->
    <link rel="stylesheet" href="resources/lib/bootstrap5.3.0/css/bootstrap.min.css">
    <script src="resources/lib/bootstrap5.3.0/js/bootstrap.bundle.min.js"></script>

    <style>
        /* kanit-300 - latin_thai */
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
            font-family: 'Kanit', sans-serif;
            background-color: rgb(245, 245, 245);
            margin: 0;
            padding: 0;
        }

        .card-body h2 {
            color: rgb(15, 49, 147);
        }
    </style>
</head>


<body>

    <div class="vh-100 d-flex justify-content-center align-items-center">
        <div class="container">
            <div class="row d-flex justify-content-center">
                <div class="col-12 col-md-8 col-lg-6">
                    <div class="card bg-white shadow-lg">
                        <div class="card-body p-5">

                            <!-- ส่วนฟอร์ม login ห้ามลบ -->
                            <form class="mb-3 mt-md-4" action="db/config/login.php" method="POST">
                                <h2 class="fw-bold mb-2 text-uppercase "><img src="image/logo/logo.jpg" class="rounded" style="width: 80px"> Sithichai Engineering</h2>
                                <p class="mb-5">ระบบบริหารจัดการใบเสร็จ (Version 1.00) - กรุณาเข้าสู่ระบบ</p>
                                <div class="mb-3">
                                    <label for="text" class="form-label ">ชื่อผู้ใช้งาน :</label>
                                    <input type="text" class="form-control" name="loginUser" placeholder="username...">
                                </div>
                                <div class="mb-3">
                                    <label for="password" class="form-label ">รหัสผ่าน :</label>
                                    <input type="password" class="form-control" name="loginPassword" placeholder="*******">
                                </div>
                                <div class="d-grid">
                                    <a type="submit" class="btn btn-outline-dark" href="index.php">Login</a>
                                </div>
                            </form>


                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <!-- footer ห้ามลบ -->
    <footer class="fixed-bottom text-center">
        <p>Receipt Management System &copy; <script>document.write(new Date().getFullYear())</script> Sithichai Engineering, All Rights Reserved.</p>
    </footer>






</body>

</html>