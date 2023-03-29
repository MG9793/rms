<?php
    session_start();
    require_once "../db/config/conn.php";
    require_once "../db/config/deleteRow.php";

    if (!isset($_SESSION['admin_login'])) {
        header("location: ../login.php");
    } else {

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
    <title>บันทึกค่าใช้จ่าย (รายละเอียดสินค้า) | ระบบบริหารจัดการใบเสร็จ</title>

    <!-- Dependency ห้ามลบ -->
    <?php include "include/dependency.php"; ?>

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
    </style>
</head>
<body>

    <!-- navbar ห้ามลบ -->
    <?php include 'include/navbar.php'; ?>

    <!-- pagename ห้ามลบ -->
    <section class="container mt-2">
        <legend class="fw-bold text-dark text-center border border-3 border-light bg-secondary shadow-sm p-2"><i class="fa-solid fa-1 border rounded p-1 bg-dark text-light"></i> บันทึกค่าใช้จ่าย (รายละเอียดสินค้า)</legend>
    </section>

    <!-- input ห้ามลบ -->
    <section class="container">
        <input class="form-control" type="text" placeholder="ค้นหาเลขที่ใบเสร็จ">
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


    <!-- Modal 1 -->
    <div class="modal fade" id="selectVAT" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel"><i class="fa-solid fa-2 border rounded p-2 bg-dark text-light"></i> เลือกประเภทการคำนวณภาษี (VAT)</h5>
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
                    <button type="submit" class="btn btn-success w-100" data-bs-toggle="modal" data-bs-target="#expenseDetailsVAT">VAT</button>
                    <button type="submit" class="btn btn-danger w-100" data-bs-toggle="modal" data-bs-target="#MA_Head_NoVAT">No VAT</button>
                </div>
            </div>
        </div>
    </div>


    <!-- Modal 2 -->
    <div class="modal fade" id="expenseDetailsVAT" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true" data-bs-backdrop="static" data-bs-keyboard="false">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel"><i class="fa-solid fa-3 border rounded p-2 bg-dark text-light"></i> บันทึกค่าใช้จ่ายรวมภาษี (VAT)</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="#" method="POST">
                        <!-- <div class="text-center"><img src="../image/icon/cost.png" class="w-25" alt=""></div> -->
                        <input type="hidden" readonly value="<?php //echo $userAccount['id_users']; ?>" required class="form-control" name="id_site">
                        <div class="row">
                            <div class="col-md d-flex">
                                <div>เลขที่ใบเสร็จ :</div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md">
                                <label class="col-form-label fw-bold"><i class="fa-solid fa-plus"></i> เพิ่มรายการค่าใช้จ่าย :</label>
                            </div>
                            <div class="col-md-2">
                                <label class="col-form-label fw-bold">จำนวน :</label>
                            </div>
                            <div class="col-md-2">
                                <label class="col-form-label fw-bold">ราคา/หน่วย :</label>
                            </div>
                            <div class="col-md-2">
                                <label class="col-form-label fw-bold">รวม :</label>
                            </div>
                            <div class="col-md-1">
                                <label class="col-form-label fw-bold">ลบ</label>
                            </div>
                        </div>
                        <div class="row" id="items-row">
                            <div class="col-md my-1">
                                <input type="text" class="form-control" name="addItems" id="addItems" list="addItems" required>
                            </div>
                            <div class="col-md-2 my-1">
                                <input type="number" class="form-control" name="itemPrice" id="itemPrice" oninput="calculateSum()" required>
                            </div>
                            <div class="col-md-2 my-1">
                                <input type="number" class="form-control" name="unitPrice" id="unitPrice" oninput="calculateSum()" required>
                            </div>
                            <div class="col-md-2 my-1">
                                <input type="number" class="form-control" name="itemSum" id="itemSum" disabled required>
                            </div>
                            <div class="col-md-1 my-1">
                                <button type="button" class="btn btn-danger btn-sm remove-item-btn"><i class="fas fa-trash"></i></button>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-5">
                                <button type="button" class="btn btn-primary w-100 mt-2" id="add-item-btn">Add Item</button>
                            </div>
                        </div>
                        <div>หมายเหตุ : หากไม่พบรายการค่าใช้จ่ายให้ไปที่เมนูตั้งค่า และเพิ่มรายการบันทึก</div>
                        <hr class="headerUnderline mt-4">
                        <div class="row">
                            <div class="col-md-5">
                                <label class="col-form-label fw-bold">ยอดรวม :</label>
                                <input type="number" class="form-control" name="addItems" id="addItems" list="addItems" required>
                            </div>
                            <div class="col-md-2">
                                <label class="col-form-label fw-bold">+ VAT 7% :</label>
                                <input type="number" class="form-control" name="addItems" id="addItems" list="addItems" required>
                            </div>
                            <div class="col-md-4">
                                <label class="col-form-label fw-bold">รวมสุทธิ :</label>
                                <input type="number" class="form-control" name="addItems" id="addItems" list="addItems" required>
                            </div>
                        </div>

                        <div class="row mt-4">
                            <div class="col-md">
                                <button type="submit" class="btn btn-dark text-light w-100"><i class="fa-solid fa-floppy-disk"></i> Save</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>




    <script>
        $(document).ready(function() {
            $("#add-item-btn").click(function() {
                var newRow = $("#items-row").clone();
                newRow.find("input").val("");
                $("#items-row").after(newRow);
            });

            $(document).on("click", ".remove-item-btn", function() {
                $(this).parents(".row").remove();
            });
        });
    </script>

    <script>
        function calculateSum() {
            var price = document.getElementById("itemPrice").value;
            var quantity = document.getElementById("unitPrice").value;
            var sum = price * quantity;

            document.getElementById("itemSum").value = parseFloat(sum).toFixed(2);;
        }

        // function calculateVAT() {
        //     var price = document.getElementById("itemsQty").value;
        //     var vat = price * 0.07;
        //     document.getElementById("itemsPrice").value = vat.toFixed(2);
        //     document.getElementById("itemsVAT").value = (parseFloat(price) + vat).toFixed(2);
        // }
    </script>

</body>
</html>

<?php } ?>