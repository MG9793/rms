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
          background-color: pink;
          transform: scale(1.05);
        }

        .css-serial {
            counter-reset: serial-number; /* Set the serial number counter to 0 */
        }

        .css-serial td:first-child:before {
            counter-increment: serial-number; /* Increment the serial number counter */
            content: counter(serial-number); /* Display the counter */
        }

        fieldset {
            background-color: #fff;
            border-radius: .4em;
        }
    </style>

    <!-- script Datables ห้ามลบจ้า -->
    <script>
        $(document).ready( function () {
            $('#myTable').DataTable();
        } );
    </script>
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
                            <li><a class="dropdown-item text-black" href="page/expenseSum.php">ยอดรวม</a></li>
                            <li><a class="dropdown-item text-black disabled" href="page/#.php">รายละเอียดสินค้า</a></li>
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
        <h2 class="fw-bold text-dark"><i class="fa-solid fa-1 border rounded p-2 bg-dark text-light"></i> บันทึกค่าใช้จ่าย (รายละเอียดสินค้า)</h2>
        <hr class="headerUnderline">

        <div class="d-flex align-items-center">
            <input class="form-control" type="text" placeholder="ค้นหาเลขที่ใบเสร็จ">
        </div>
        <div><b>*หมายเหตุ :</b> หากไม่พบเลขที่ใบเสร็จให้บันทึกค่าใช้จ่าย (ยอดรวม) ก่อน</div>


        <fieldset class="p-3 shadow-sm mt-3">
            <table class="table table-striped table-hover shadow-sm css-serial" id="myTable">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">วันที่ซื้อ</th>
                        <th scope="col">เลขที่ใบเสร็จ</th>
                        <th scope="col">ชื่อผู้ขาย</th>
                        <th scope="col">เลขประจำตัวผู้เสียภาษี</th>
                        <th scope="col">ประเภท</th>
                        <th scope="col">บันทึก</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td></td>
                        <td>a0001</td>
                        <td>Site1</td>
                        <td>2</td>
                        <td>0022000231248</td>
                        <td><span class="badge bg-primary">ค่าวัสดุ</span></td>
                        <td>
                            <button type="button" class="btn btn-dark btn-sm w-50" data-bs-toggle="modal" data-bs-target="#selectVAT<?php //echo $userAccount['id_users']; ?>"><i class="fas fa-edit"></i></button>
                        </td>
                    </tr>
                </tbody>
            </table>
        </fieldset>
    </section>  <!-- Closing Tag Container -->

    <!-- <input type="text" class="form-control" name="addItems" id="addItems" list="addItems"> -->
    <!-- datalist สำหรับ Autocomplete ห้ามลบจ้า -->
    <!-- <datalist id="addItems">
        <option value="เงินเดือน Staff (รวมค่าแรงรายวัน)">
        <option value="ระดับบริหาร, ระดับวิศวกร, ระดับหัวหน้าโฟร์แมน, ระดับธุรการ">
        <option value="ระดับแรงงาน">
        <option value="BONUS, เงินสะสม 3%, เงินชดเชย">
        <option value="ค่าแรงรายวัน (ส่วนผู้รับเหมา)">
        <option value="ค่าแรงรายวัน">
        <option value="ค่าเงิน OT, ค่าเงินเพิ่ม 15%">
        <option value="เงินเดือนและค่าจ้างแรงงาน">
        <option value="ค่าแรงเหมา">
        <option value="ค่าเชื้อเพลิง หรือพลังงาน">
        <option value="ค่าไฟฟ้า">
        <option value="ค่าประปา">
        <option value="ค่าโทรศัพท์">
        <option value="รายจ่ายในการเดินทาง, ค่าที่พัก">
        <option value="ค่าระวาง, ค่าไปรษณีย์">
        <option value="ค่าขนส่ง">
        <option value="ค่าเช้า">
        <option value="ค่าซ่อมแซม">
        <option value="ค่าอะไหล่เครื่องมือ, เครื่องจักร">
        <option value="ค่ารับรอง">
        <option value="ค่านายหน้า ค่าโฆษณา">
        <option value="ค่าภาษีอากรอื่น">
        <option value="ดอกเบี้ยจ่าย">
        <option value="ค่าสอบบัญชี">
        <option value="รายจ่ายเพื่อการกุศลสาธารณะ">
        <option value="ค่าธรรมเนียมอื่น">
        <option value="ค่าวัสดุก่อสร้าง">
        <option value="ค่าวัสดุสิ้นเปลือง">
        <option value="ค่าเครื่องใช้สำนักงาน">
        <option value="ค่าเครื่องมือเครื่องใช้">
        <option value="ค่าเครื่องจักร, ยานพาหนะ">
        <option value="ค่ารักษาความปลอดภัย">
        <option value="ค่าแบบประกวดราคา">
        <option value="ค่าทดสอบวัสดุก่อสร้าง">
        <option value="ค่าทำความสะอาด">
        <option value="ค่าถ่ายเอกสารแบบพิมพ์">
        <option value="ค่าธรรมเนียมธนาคาร">
        <option value="ค่ารักษาพยาบาล">
        <option value="ค่าอบรม สัมมนา">
        <option value="ค่าสวัสดิการพนักงาน">
        <option value="ค่าประกันสังคม">
        <option value="ค่าเงินสมทบกองทุนเงินทดแทน">
        <option value="ค่าใช้จ่ายเบ็ดเตล็ด">
        <option value="รายจ่ายอื่นๆ">
    </datalist> -->


    <!-- Modal1 -->
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
                    <button type="submit" class="btn btn-success w-100" data-bs-toggle="modal" data-bs-target="#MA_Head">VAT</button>
                    <button type="submit" class="btn btn-danger w-100" data-bs-toggle="modal" data-bs-target="#MA_Head_NoVAT">No VAT</button>
                </div>
            </div>
        </div>
    </div>

    <script>
        // $(document).ready(function() {
        //     // When the add item button is clicked
        //     $("#add-item-btn").click(function() {
        //         // Clone the existing row of input fields
        //         var newRow = $("#items-row").clone();
        //         // Reset the values of the new input fields
        //         newRow.find("input").val("");
        //         // Append the new row of input fields to the end of the existing row
        //         $("#items-row").after(newRow);
        //     });

        //     // When the remove item button is clicked
        //     $(document).on("click", ".remove-item-btn", function() {
        //         // Remove the row of input fields that contains the clicked button
        //         $(this).parents(".row").remove();
        //     });
        // });
    </script>

    <script>
        function calculateVAT() {
            var price = document.getElementById("itemsQty").value;
            var vat = price * 0.07;
            document.getElementById("itemsPrice").value = vat.toFixed(2);
            document.getElementById("itemsVAT").value = (parseFloat(price) + vat).toFixed(2);
        }
    </script>


    <?php include "modal/modal_editSite.php"; ?>
    <?php include "modal/modal_editPassword.php"; ?>
</body>
</html>