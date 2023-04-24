<?php
    require_once "../include/dependency.php";
    require_once "../include/header.php";
    require_once "../db/config/deleteRow.php";
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

    <style>
        .formEditDelete {
            display: inline-block;
            margin: 0;
        }
    </style>
</head>
<body>
    
    <!-- pagename ห้ามลบ -->
    <section class="container mt-2">
        <div class="container border border-3 border-light bg-secondary shadow-sm">
            <legend class="fw-bold text-dark text-center p-2">บันทึกรายจ่าย (รายละเอียด) </legend>

            <?php
                // Alert 
                if(isset($_SESSION['add_billLine_error'])) {
                    echo "<div class='alert alert-danger alert-dismissible fade show' role='alert'>";
                    echo "<button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>";
                    echo $_SESSION['add_billLine_error'];
                    unset($_SESSION['add_billLine_error']);
                    echo "</div>";
                }


                if(isset($_SESSION['add_billLine_success'])) {
                    echo "<div class='alert alert-success alert-dismissible fade show' role='alert'>";
                    echo "<button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>";
                    echo $_SESSION['add_billLine_success'];
                    unset($_SESSION['add_billLine_success']);
                    echo "</div>";
                }
            ?>

            <form action="../db/db_expense.php" method="POST">
                <div class="row">
                    <div class="col-md-5">
                        <label for="searchReceipt" class="form-label fw-bold">ค้นหาเลขที่ใบเสร็จ :</label>
                        <select class="form-select" name="searchReceipt" id="searchReceipt" onChange="fetchTotal();">
                            <option value="">ค้นหาเลขที่ใบเสร็จ</option>
                            <?php

                                $receiptBill = $conn->prepare("SELECT receipt_no, total FROM bill_head");
                                $receiptBill->execute();
                                $receipt = $receiptBill->fetchAll();

                                foreach($receipt as $serachReceipt) {
                                    echo '<option value="'.$serachReceipt["receipt_no"].'">'.$serachReceipt["receipt_no"].'</option>';
                                    // echo '<option value="'.$serachReceipt["receipt_no"].$serachReceipt["total"].'">'.$serachReceipt["receipt_no"].'</option>';
                                }

                            ?>
                        </select>
                    </div>
                    <div class="col-md-2">
                        <label for="receiptTotal" class="form-label fw-bold">ยอดเงินตามใบเสร็จ :</label>
                        <input type="number" class="form-control" name="receiptTotal" id="receiptTotal" readonly required style="background-color: rgb(235, 235, 235);">
                    </div>
                    <div class="col-md-4">
                        <label for="itemSum" class="form-label fw-bold">ยอดเงินที่บันทึก :</label>
                        <input type="number" class="form-control" name="itemSum" id="itemSum" readonly required style="background-color: rgb(235, 235, 235);">
                    </div>
                </div>
                <div class="row">
                    <div class="col-md">
                        <label for="itemName" class="col-form-label fw-bold"><i class="fa-solid fa-plus"></i> รายการ :</label>
                    </div>
                    <div class="col-md-2">
                        <label for="itemQty" class="col-form-label fw-bold">จำนวน :</label>
                    </div>
                    <div class="col-md-2">
                        <label for="unitPrice" class="col-form-label fw-bold">ราคา/หน่วย :</label>
                    </div>
                    <div class="col-md-2">
                        <label for="itemTotal" class="col-form-label fw-bold">ยอดรวม :</label>
                    </div>
                    <div class="col-md-1">
                        <label class="col-form-label fw-bold">ลบ</label>
                    </div>
                </div>
                <div class="row" id="item_fields">
                    <div class="col-md">
                        <input type="text" class="form-control" name="itemName[]" id="itemName" list="addItems" required>
                    </div>
                    <div class="col-md-2">
                        <input type="number" class="form-control" name="itemQty[]" id="itemQty" oninput="calculateSum()" required>
                    </div>
                    <div class="col-md-2">
                        <input type="number" class="form-control" name="unitPrice[]" id="unitPrice" oninput="calculateSum()" step=".01" required>
                    </div>
                    <div class="col-md-2">
                        <input type="number" class="form-control" name="itemTotal[]" id="itemTotal" step=".01" required>
                    </div>
                    <div class="col-md-1">
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-5">
                        <button type="button" class="btn btn-primary mt-2 w-100" id="add-item-btn" onclick="addRows()">Add Item</button>
                    </div>
                </div>
                <div>หมายเหตุ : หากไม่พบรายการค่าใช้จ่ายให้ไปที่เมนูตั้งค่า และเพิ่มรายการบันทึก</div>

                <div class="row mt-4">
                    <div class="col-md">
                        <button type="submit" name="add_billLine" class="btn btn-success text-light w-100"><i class="fa-solid fa-floppy-disk"></i> บันทึก</button>
                    </div>
                </div>
            </form>
        </div>
    </section>


    <!-- script Add InputField -->
    <script>
		function addRows() {
			var div = document.createElement("div");
            var uniqueId = Date.now(); // Generate a unique ID for each row
			div.innerHTML = '<div class="row">' +
                                '<div class="col-md mt-2">' +
                                    '<input type="text" class="form-control" name="itemName[]" list="addItems" required>' +
                                '</div>' +
                                '<div class="col-md-2 mt-2">' +
                                    '<input type="number" class="form-control" name="itemQty[]" id="itemQty_add' + uniqueId + '" oninput="calculateSum_add(' + uniqueId + ')" required>' +
                                '</div>' +
                                '<div class="col-md-2 mt-2">' +
                                    '<input type="number" class="form-control" name="unitPrice[]" id="unitPrice_add' + uniqueId + '" oninput="calculateSum_add(' + uniqueId + ')" required>' +
                                '</div>' +
                                '<div class="col-md-2 mt-2">' +
                                    '<input type="number" class="form-control" name="itemTotal[]" id="itemTotal_add' + uniqueId + '" required>' +
                                '</div>' +
                                '<div class="col-md-1 mt-2">' +
                                    '<button type="button" class="btn btn-danger" onclick="removeItem(this)"><i class="fas fa-trash"></i></button>' +
                                '</div>';
			document.getElementById("item_fields").appendChild(div);
		}
		
        function removeItem(button) {
            var row = button.parentNode.parentNode;
            row.parentNode.removeChild(row);
        }
	</script>


    <!-- input ห้ามลบ -->
    <section class="container my-2">
        <fieldset class="p-3 shadow-sm">
            <h5 class="fw-bold text-dark text-center p-2">เรียกดูรายการ</h5>
            <form method="POST">
                <label for="queryReceipt" class="form-label fw-bold">เลือกเลขที่ใบเสร็จ :</label>
                <div class="row">
                    <div class="col-md-10 d-flex">
                        <select class="form-select w-50" name="queryReceipt" id="queryReceipt" onChange="fetchTotal(); document.getElementById('receipt').value = this.value;">
                            <option value="">เลือกเลขที่ใบเสร็จ</option>
                                <?php

                                    $queryBill = $conn->prepare("SELECT DISTINCT receipt_no FROM bill_line");
                                    $queryBill->execute();
                                    $receipt = $queryBill->fetchAll();

                                    foreach($receipt as $selectReceipt) {
                                        echo '<option value="'.$selectReceipt["receipt_no"].'">'.$selectReceipt["receipt_no"].'</option>';
                                    }
                                    
                                ?>
                        </select>
                        <button type="submit" class="btn btn-light mx-2"><i class="fa-solid fa-magnifying-glass"></i> ค้นหา</button>
                    </div>
                </div>
            </form>

            <?php

            if (isset($_POST['queryReceipt'])) {
                $selectedValue = $_POST['queryReceipt'];
                // เปิด input hidden เพื่อส่งค่าไป form button แก้ไข
                // echo '<input type="hidden" class="form-control" name="get_receipt" id="get_receipt" value="' . $selectedValue . '" readonly>';

                // query ยอดเงิน head
                $billHead = $conn->query("SELECT SUM(total) AS headTotal FROM bill_head WHERE receipt_no = '$selectedValue'");
                $sumHead = $billHead->fetch(PDO::FETCH_ASSOC);
                $diff_sumHead = $sumHead['headTotal'];
                
                // query ยอดเงิน line
                $billLine = $conn->query("SELECT SUM(total) AS lineTotal FROM bill_line WHERE receipt_no = '$selectedValue'");
                $sumLine = $billLine->fetch(PDO::FETCH_ASSOC);
                $diff_sumLine = $sumLine['lineTotal'];

                $sumDiff = $diff_sumHead - $diff_sumLine;

            ?>


            <!-- แสดงปุ่มแก้ไขบิล/ลบบิล -->
            <div class="row">
                <div class="col-md">
                    <form action="../db/db_expense.php" method="POST" class="formEditDelete">
                        <input type="hidden" class="form-control" name="receipt" id="receipt" value="<?php echo $selectedValue; ?>" readonly>
                        <button type="submit" class="btn btn-outline-warning" name="editReceipt"><i class="fas fa-trash"></i> แก้ไขใบเสร็จ</button>
                    </form>
                    <button type="button" class="btn btn-outline-danger" data-bs-toggle="modal" data-bs-target="#modalDeleteBill<?php echo $selectedValue; ?>"><i class="fas fa-trash"></i> ลบใบเสร็จ</button>
                </div>
            </div>




            <!-- Modal ยืนยันลบข้อมูล ห้ามลบ -->
            <div class="modal fade" id="modalDeleteBill<?php echo $selectedValue; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title fw-bold"> ลบรายการ</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <h6 class="text-center">กรุณายืนยันการลบใบเสร็จเลขที่ : <?php echo $selectedValue; ?></h6>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">ยกเลิก</button>
                            <a data-id="<?php echo $selectedValue; ?>" href="?delete_Bill=<?php echo $selectedValue; ?>" class="btn btn-danger"><i class="fas fa-trash"></i> ยืนยัน</a>
                        </div>
                    </div>
                </div>
            </div>


            <!-- ส่วนตาราง เมื่อกดค้นหาแล้ว -->
            <table class="table table-sm table-striped table-hover shadow-sm css-serial" id="myTable">
                <thead>
                    <tr >
                        <th scope="col" style="text-align:center;">#</th>
                        <th scope="col" style="text-align:center;">เลขที่ใบเสร็จ</th>
                        <th scope="col" style="text-align:center;">รายการ</th>
                        <th scope="col" style="text-align:center;">จำนวน</th>
                        <th scope="col" style="text-align:center;">ราคา/หน่วย</th>
                        <th scope="col" style="text-align:center;">ยอดรวม</th>
                        <th scope="col" style="text-align:center;">แก้ไข</th>
                    </tr>
                </thead>
                <tbody>


                <?php
                
                    if ($sumDiff == 0) {
                        echo "<h5 class='text-center text-success fw-bold'><i class='fa-solid fa-check'></i> รายการถูกต้องแล้ว</h5>";
                    } else {
                         echo '<h5 class="text-center my-3"><b>ยอดเงินตามใบเสร็จ : </b> ' . number_format($sumHead['headTotal'], 2, '.', ',') . ' บาท &emsp; <b>ยอดเงินรวมจากรายการ : </b><u class="text-danger">' . number_format($sumLine['lineTotal'], 2, '.', ',') . '</u> บาท &emsp; <b>ขาดเหลืออีก : </b><u class="text-danger">' . number_format($sumDiff, 2, '.', ',') .'</u> บาท &emsp; <i class="text-danger"><i class="fa-solid fa-circle-xmark"></i> <i>ยอดไม่ถูกต้อง กรุณาตรวจสอบ</i></i></h5>';
                    }

                    // query ตาราง
                    $stmt = $conn->query("SELECT * FROM bill_line WHERE receipt_no = '$selectedValue'");
                    $stmt->execute();
                    $bill = $stmt->fetchAll();

                    foreach ($bill as $fetch_bill) {
                                
                ?>

                    <tr style="text-align:center;">
                        <td></td>
                        <td><?php echo $fetch_bill['receipt_no']; ?></td>
                        <td><?php echo $fetch_bill['item_name']; ?></td>
                        <td><?php echo $fetch_bill['qty']; ?></td>
                        <td><?php echo number_format(($fetch_bill['amount']), 2); ?></td>
                        <td><?php echo number_format(($fetch_bill['total']), 2); ?></td>
                        <td>
                            <div class="btn-group" role="group" aria-label="Basic outlined example">
                                <!-- <button type="button" class="btn btn-sm btn-outline-dark" data-bs-toggle="modal" data-bs-target="#modalEditBill<?php //echo $fetch_bill['id']; ?>"><i class="fas fa-edit"></i></button> -->
                                <button type="button" class="btn btn-sm btn-outline-danger" data-bs-toggle="modal" data-bs-target="#modalDeleteBillList<?php echo $fetch_bill['id']; ?>"><i class="fas fa-trash"></i></button>
                            </div>
                        </td>
                    </tr>


                    <!-- Modal Edit billLine
                    <div class="modal fade" id="modalEditBill<?php //echo $fetch_bill['id']; ?>" tabindex="-1" aria-labelledby="modalEditBill" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="modalEditBill"><i class="fa-solid fa-pen-to-square"></i> แก้ไขรายการรายจ่าย (รายละเอียด)</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>

                                <div class="modal-body">
                                    <form action="../db/db_expense.php" method="POST">
                                        <div class="mb-0">
                                            <input type="hidden" class="form-control" name="id" value="<?php //echo $fetch_bill['id']; ?>" readonly required>
                                            <label for="editReceiptNo" class="col-form-label">เลขที่ใบเสร็จ :</label>
                                            <input type="text" class="form-control" name="editReceiptNo" id="editReceiptNo" value="<?php //echo $fetch_bill['receipt_no']; ?>" readonly required style="background-color: rgb(235, 235, 235);">
                                        </div>
                                        <div class="mb-0">
                                            <label for="editItems" class="col-form-label">รายการ :</label>
                                            <input type="text" class="form-control" name="editItems" id="editItems" list="addItems" value="<?php //echo $fetch_bill['item_name']; ?>" required>
                                        </div>
                                        <div class="mb-0">
                                            <label for="editQty" class="col-form-label">จำนวน :</label>
                                            <input type="number" class="form-control" name="editQty" id="itemQty2" value="<?php //echo $fetch_bill['qty']; ?>" oninput="calculateSum2()" required>
                                        </div>
                                        <div class="mb-0">
                                            <label for="editAmount" class="col-form-label">ราคา/หน่วย :</label>
                                            <input type="number" class="form-control" name="editAmount" id="unitPrice2" value="<?php //echo $fetch_bill['amount']; ?>" oninput="calculateSum2()" required>
                                        </div>
                                        <div class="mb-2">
                                            <label for="editTotal" class="col-form-label">ยอดรวม :</label>
                                            <input type="number" class="form-control" name="editTotal" id="itemTotal2" value="<?php //echo $fetch_bill['total']; ?>" required>
                                        </div>
                                        <p>* หากต้องการแก้ไขเลขที่ใบเสร็จ, จำนวนเงิน ให้ลบรายการแล้วบันทึกใหม่</p>

                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                            <button type="submit" class="btn btn-dark w-25" name="edit_billLine"><i class="fa-solid fa-floppy-disk"></i> Save</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div> -->


                    <!-- Modal ยืนยันลบข้อมูล ห้ามลบ -->
                    <div class="modal fade" id="modalDeleteBillList<?php echo $fetch_bill['id']; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title fw-bold"> ลบรายการ</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <h6 class="text-center">กรุณายืนยันการลบรายการ : <?php echo $fetch_bill['item_name']; ?></h6>
                                    <p class="text-center">ยอดรวม : <?php echo number_format(($fetch_bill['total']), 2); ?> บาท</p>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">ยกเลิก</button>
                                    <a data-id="<?php echo $fetch_bill['id']; ?>" href="?delete_BillLine=<?php echo $fetch_bill['id']; ?>" class="btn btn-danger"><i class="fas fa-trash"></i> ยืนยัน</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php } } ?>
                </tbody>
            </table>
        </fieldset>
    </section>


    <!-- script ส่งค่าไป input อื่น -->
    <script>
    // var receiptValue = document.getElementById("get_receipt").value;
    // document.getElementById("receipt").value = receiptValue;
    </script>


    <!-- Autocomplete -->
    <datalist id="addItems">
        <?php
            $stmt = $conn->query("SELECT item_name FROM item_info");
            $stmt->execute();
            $item = $stmt->fetchAll();

            if (!$item) {            
            
            } else {
                foreach ($item as $fetch_item) {
        ?>

        <option value="<?php echo $fetch_item['item_name']; ?>"></option>
        <?php } } ?>
    </datalist>


    <!-- สคริป ยอดรวม สำหรับปุ่ม Add -->
    <script>
        function calculateSum_add(uniqueId) {
            var price = document.getElementById("itemQty_add" + uniqueId).value;
            var quantity = document.getElementById("unitPrice_add" + uniqueId).value;
            var sum = price * quantity;
            document.getElementById("itemTotal_add" + uniqueId).value = parseFloat(sum).toFixed(2);;

            
            // เอาค่ายอดรวมปุ่ม Add มาบวกใน input itemSum
            var itemQty = document.getElementById('itemQty_add' + uniqueId).value;
            var unitPrice = document.getElementById('unitPrice_add' + uniqueId).value;
            var itemTotal = itemQty * unitPrice;
            document.getElementById('itemTotal_add' + uniqueId).value = itemTotal.toFixed(2);
            calculateSum();
        }
    </script>


    <!-- สคริป ค้นหาเลขที่ใบเสร็จ -->
    <script>
        var select_box_element_site = document.querySelector('#searchReceipt');
        dselect(select_box_element_site, {
            search: true
        });


        var selectReceipt = document.querySelector('#queryReceipt');
        dselect(selectReceipt, {
            search: true
        });
    </script>


    <!-- Auto-Fill ยอดเงิน -->
    <script>
        function fetchTotal() {
            if (document.getElementById("searchReceipt").value === '') {
                document.getElementById("receiptTotal").value = '';

            } else {
                var total = document.getElementById("searchReceipt").value;
                // document.getElementById("receiptTotal").value = total.slice(10);
                document.getElementById("receiptTotal").value = total.slice(10);
            }
        }
    </script>



    <!-- สคริป ยอดรวม -->
    <script>
        function calculateSum() {
            var price = document.getElementById("itemQty").value;
            var quantity = document.getElementById("unitPrice").value;
            var sum = price * quantity;

            document.getElementById("itemTotal").value = parseFloat(sum).toFixed(2);


            // เอาค่ายอดรวมแถวแรกมาใส่ใน input itemSum
            var itemTotalInputs = document.getElementsByName('itemTotal[]');
            var total = 0;
            for (var i = 0; i < itemTotalInputs.length; i++) {
                total += parseFloat(itemTotalInputs[i].value) || 0;
            }
            document.getElementById('itemSum').value = total.toFixed(2);
        }

        // function calculateSum2() {
        //     var price = document.getElementById("itemQty2").value;
        //     var quantity = document.getElementById("unitPrice2").value;
        //     var sum = price * quantity;

        //     document.getElementById("itemTotal2").value = parseFloat(sum).toFixed(2);
        // }

    </script>

</body>
</html>