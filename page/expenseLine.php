<?php
    require_once "../include/dependency.php";
    require_once "../include/header.php";
    require_once "../db/config/deleteRow.php";

    if (!isset($_SESSION['select_expenseLine'])) {
        header("location: expense.php");
    } else {

    // ดึง id จาก session
    $id = $_SESSION['select_expenseLine'];

    $stmt = $conn->query("SELECT * FROM bill_head WHERE id = $id");
    $stmt->execute();
    $selectLine_query = $stmt->fetch(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <!-- script Datables ห้ามลบจ้า -->
    <script>
        $(document).ready( function () {
            $('#myTable').DataTable();
        } );
    </script>

    <!-- Bootstrap CSS -->
    <script src="../resources/lib/dselect.js"></script>
</head>
<body>
    
    <!-- pagename ห้ามลบ -->
    <section class="container mt-2">

        <!-- button แสดง/ซ่อน input -->
        <button type="button" class="btn btn-light w-100" data-bs-toggle="collapse" href="#displayInput" aria-expanded="false" aria-controls="displayInput"><i class="fa-solid fa-plus"></i> บันทึกรายจ่าย (รายละเอียด)</button>
        
        <div class="text-dark bg-secondary shadow-sm mt-2 p-3 collapse" id="displayInput">
            <h6><b>ชื่อไซต์งาน : </b> <i><?php echo $selectLine_query['site_name']; ?></i><br>
                <b>เลขที่ใบเสร็จ : </b> <?php echo $selectLine_query['receipt_no']; ?><br>
                <b>ชื่อผู้ขาย : </b> <?php echo $selectLine_query['sales_name']; ?><br>
                <b>เลขประจำตัวผู้เสียภาษี : </b> <?php echo $selectLine_query['tax_no']; ?></h6>
                <hr>


            <form action="../db/db_expense.php" method="POST">
                <div class="row">
                    <div class="col-md">
                        <label class="col-form-label fw-bold"><i class="fa-solid fa-plus"></i> รายการ :</label>
                    </div>
                    <div class="col-md-2">
                        <label class="col-form-label fw-bold">จำนวน :</label>
                    </div>
                    <div class="col-md-2">
                        <label class="col-form-label fw-bold">ราคา/หน่วย :</label>
                    </div>
                    <div class="col-md-2">
                        <label class="col-form-label fw-bold">ยอดรวม :</label>
                    </div>
                    <div class="col-md-1">
                        <label class="col-form-label fw-bold">ลบ</label>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md">
                        <input type="text" class="form-control" name="addItems" id="addItems" list="addItems" required>
                    </div>
                    <div class="col-md-2">
                        <input type="number" class="form-control" name="itemPrice" id="itemPrice" oninput="calculateSum()" required>
                    </div>
                    <div class="col-md-2">
                        <input type="number" class="form-control" name="unitPrice" id="unitPrice" oninput="calculateSum()" required>
                    </div>
                    <div class="col-md-2">
                        <input type="number" class="form-control" name="itemSum" id="itemSum" required>
                    </div>
                    <div class="col-md-1 my-1">
                        <button type="button" class="btn btn-danger remove-item-btn"><i class="fas fa-trash"></i></button>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-5">
                        <button type="button" class="btn btn-primary mt-2 w-100" id="add-item-btn">Add Item</button>
                    </div>
                </div>
                <div>หมายเหตุ : หากไม่พบรายการค่าใช้จ่ายให้ไปที่เมนูตั้งค่า และเพิ่มรายการบันทึก</div>
                <div class="row">
                    <div class="col-md-11 text-end">
                        <div><h5>จำนวนเงินทั้งสิ้น <b><?php echo number_format(($selectLine_query['sum']),2) ?></b> บาท</h5></div>
                    </div>
                </div>

                <div class="row mt-4">
                    <div class="col-md">
                        <button type="submit" class="btn btn-success text-light w-100"><i class="fa-solid fa-floppy-disk"></i> บันทึก</button>
                    </div>
                </div>
            </form>
        </div>
    </section>


    <!-- input ห้ามลบ -->
    <section class="container">
        <fieldset class="p-3 shadow-sm mt-2">
            <table class="table table-striped table-hover shadow-sm css-serial" id="myTable">
                <thead>
                    <tr >
                        <th scope="col" style="text-align:center;">#</th>
                        <th scope="col" style="text-align:center;">เลขที่ใบเสร็จ</th>
                        <th scope="col" style="text-align:center;">จำนวน</th>
                        <th scope="col" style="text-align:center;">ราคา/หน่วย</th>
                        <th scope="col" style="text-align:center;">ยอดรวม</th>
                        <th scope="col" style="text-align:center;">แก้ไข</th>
                    </tr>
                </thead>
                <tbody>


                <!-- query ตาราง ห้ามลบ -->
                <?php
                        $stmt = $conn->query("SELECT * FROM bill_line WHERE id = $id ORDER BY id DESC");
                        $stmt->execute();
                        $bill = $stmt->fetchAll();

                        if (!$bill) {
                           
                        } else {
                            foreach ($bill as $fetch_bill) {
                    ?>

                    <tr style="text-align:center;">
                        <td></td>
                        <td><?php echo $fetch_bill['receipt_no']; ?></td>
                        <td><?php echo $fetch_bill['amount']; ?></td>
                        <td><?php echo $fetch_bill['price']; ?></td>
                        <td><?php echo $fetch_bill['discount']; ?></td>
                        <td><?php echo number_format(($fetch_bill['total']),2); ?></td>
                        <td>
                            <div class="btn-group" role="group" aria-label="Basic outlined example">
                                <button type="submit" class="btn btn-sm btn-outline-dark" name="expenseLine"><i class="fas fa-edit"></i></button>
                                <button type="button" class="btn btn-sm btn-outline-danger" data-bs-toggle="modal" data-bs-target="#modalDeleteBill<?php echo $fetch_bill['id']; ?>"><i class="fas fa-trash"></i></button>
                            </div>
                        </td>
                    </tr>
                    <?php } } ?>
                </tbody>
            </table>
        </fieldset>
    </section>



<!-- Modal -->
<!-- <div class="modal fade" id="expenseDetailsVAT<?php //echo $fetch_bill['id']; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true" data-bs-backdrop="static" data-bs-keyboard="false">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
            <div class="modal-header">
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="../db/db_expense.php" method="POST">
                        <input type="hidden" value="<?php //echo $fetch_bill['receipt_no']; ?>" required class="form-control" name="receipt_line">
                        <div class="row">
                        
                            <div class="col-md d-flex" >
        
                                <div><h5>เลขที่ใบสั่งซื้อ <b><?php //echo $fetch_bill['receipt_no']; ?></b></h5></div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md">
                                <label class="col-form-label fw-bold"></i> รายการ :</label>
                            </div>
                            <div class="col-md-2">
                                <label class="col-form-label fw-bold">จำนวน :</label>
                            </div>
                            <div class="col-md-2">
                                <label class="col-form-label fw-bold">ราคา/หน่วย :</label>
                            </div>
                            <div class="col-md-2">
                                <label class="col-form-label fw-bold">จำนวนเงิน :</label>
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
                                <input type="number" class="form-control" name="itemSum" id="itemSum"  required>
                            </div>
                            <div class="col-md-1 my-1">
                                <button type="button" class="btn btn-danger btn-sm remove-item-btn"><i class="fas fa-trash"></i></button>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-5">
                                <button type="button" class="btn btn-primary w-20 mt-2" id="add-item-btn">เพิ่มรายการ</button>
                            </div>
                        </div>

                        <hr class="headerUnderline mt-4">
                        <div class="row">
                            
                            <div class="col-md-4" style="text-align:right;width:90%;">
                            <div ><h5>จำนวนเงินทั้งสิ้น <b><?php //echo number_format(($fetch_bill['sum']),2) ?></b> บาท</h5></div>
                            </div>
                        </div>

                        <div class="row mt-4">
                            <div class="col-md">
                                <button type="submit" class="btn btn-success text-light w-100"><i class="fa-solid fa-floppy-disk"></i> บันทึก</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div> -->




</body>
</html>

<?php } ?>