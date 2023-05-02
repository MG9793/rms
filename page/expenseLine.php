<?php
    require_once "../include/dependency.php";
    require_once "../include/header.php";
    require_once "../db/config/deleteRow.php";


    if (!isset($_SESSION['receiptNo_billLine'])) {
        //  header("location: incomeRecord.php");
        $receiptNo = "";
      } else {

      // ดึง sitename จาก session
      $receiptNo = $_SESSION['receiptNo_billLine'];
      }
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
        /* .formSearch {
            display: inline-block;
            margin: 0;
        } */
    </style>
</head>
<body>
    
    <!-- pagename ห้ามลบ -->
    <section class="container mt-2">
        <div class="container border border-3 border-light bg-secondary shadow-sm">
            <legend class="fw-bold text-dark text-center p-2">บันทึกรายจ่าย (รายละเอียด) </legend>
            <form action="../db/db_expense.php" method="POST">
                    <div class="row">
                    <div class="col-md-5">
                    <label for="searchReceipt" class="form-label fw-bold">ค้นหาเลขที่ใบเสร็จ :</label>
                            <select class="form-select" name="searchReceipt" id="searchReceipt" required>
                            <?php 
                            $sumDiff = $_SESSION['Total_billLine'] - $_SESSION['lineTotal'];
                            
                            ?>
                                
                                <?php

                                    $receiptBill = $conn->prepare("SELECT receipt_no, total FROM bill_head");
                                    $receiptBill->execute();
                                    $receipt = $receiptBill->fetchAll();
                                    if($_SESSION['receiptNo_billLine']=="") { ?>

                                        <option value="">ค้นหาเลขที่ใบเสร็จ</option>
                                        <?php
                                    foreach($receipt as $serachReceipt) {
                                        echo '<option value="'.$serachReceipt["receipt_no"]. ' ">'.$serachReceipt["receipt_no"].'</option>';
                                    }
                                    } else {
                                    echo '<option value="' .$_SESSION["receiptNo_billLine"]. '">' .$_SESSION["receiptNo_billLine"]. '</option>';
                                    
                                    foreach($receipt as $serachReceipt) {
                                        echo '<option value="'.$serachReceipt["receipt_no"]. ' ">'.$serachReceipt["receipt_no"].'</option>';
                                    }
                                    
                                }
                                
                                
                                ?>
                            </select>


                            



                            </div>  
                        <div class="col-md-1" style="margin-top: 32px;">
                            <button type="submit" class="btn btn-light w-100"><i class="fa-solid fa-magnifying-glass"></i> ค้นหา</button>
                        </div>
                        <div class="col-md-2">
                        <label for="receiptTotal" class="form-label fw-bold">ยอดเงินตามใบเสร็จ :</label>
                        <input type="number" class="form-control" name="receiptTotal" id="receiptTotal" value="<?php echo $_SESSION['Total_billLine']; ?>" tabindex="-1" readonly required style="background-color: rgb(235, 235, 235);">
                    </div>
                    <div class="col-md-2">
                        <label for="lineTotal" class="form-label fw-bold">ยอดเงินที่บันทึก :</label>
                        <input type="number" class="form-control" name="lineTotal" id="lineTotal" value="<?php echo $_SESSION['lineTotal']; ?>" tabindex="-1" readonly required style="background-color: rgb(235, 235, 235);">
                    </div>
                    <div class="col-md-2">
                        <label for="sumDiff" class="form-label fw-bold">ส่วนต่าง :</label>
                        <input type="number" class="form-control text-danger" name="sumDiff" id="sumDiff" value="<?php echo $sumDiff; ?>" tabindex="-1" readonly required style="background-color: rgb(235, 235, 235);">
                    </div>
                </div>
                            </form>
                <form action="../db/db_expense.php" method="POST">
                <div class="row">
                    <div class="col-md-6">
                        <label for="itemName" class="col-form-label fw-bold">รายการ :</label>

                        <select class="form-select" name="itemName" id="itemName" required>
                            
                                
                                <?php

                                    $itemInfo = $conn->prepare("SELECT item_name FROM item_info");
                                    $itemInfo->execute();
                                    $item = $itemInfo->fetchAll();
                                   ?>

                                        <option value="">เลือกรายการสินค้า</option>
                                        <?php
                                    foreach($item as $itemName) {
                                        echo '<option value="'.$itemName["item_name"]. ' ">'.$itemName["item_name"].'</option>';
                                    }
                                   
                                    
                                
                                
                                
                                ?>
                            </select>



                    </div>
                    <div class="col-md-2">
                        <label for="itemQty" class="col-form-label fw-bold">จำนวน :</label>
                        <input type="number" class="form-control" name="itemQty" id="itemQty" oninput="calculateSum()" required>
                    </div>
                    <div class="col-md-2">
                        <label for="unitPrice" class="col-form-label fw-bold">ราคา/หน่วย :</label>
                        <input type="number" class="form-control" name="unitPrice" id="unitPrice" oninput="calculateSum()" step=".01" required>
                    </div>
                    <div class="col-md-2">
                        <label for="itemTotal" class="col-form-label fw-bold">ยอดรวม :</label>
                        <input type="number" class="form-control" name="itemTotal" id="itemTotal" step=".01" tabindex="-1" readonly required>
                    </div>
                </div>
                <div>หมายเหตุ : หากไม่พบรายการสินค้าให้ไปที่เมนูตั้งค่า</div>

                <div class="row">
                    <div class="col-md my-3">
                        <button type="submit" name="add_billLine" class="btn btn-success text-light w-100"><i class="fa-solid fa-floppy-disk"></i> บันทึก</button>
                    </div>
                </div>
                </form>

        </div>
    </section>


    <section class="container my-2">
        <fieldset class="p-3 shadow-sm">
            <table class="table table-sm table-striped table-hover shadow-sm css-serial" id="myTable">
                <thead>
                    <tr >
                        <th scope="col" style="text-align:center;">#</th>
                        <th scope="col" style="text-align:center;">เลขที่ใบเสร็จ</th>
                        <th scope="col" style="text-align:center;">รายการ</th>
                        <th scope="col" style="text-align:center;">จำนวน</th>
                        <th scope="col" style="text-align:center;">ราคา/หน่วย</th>
                        <th scope="col" style="text-align:center;">ยอดรวม</th>
                        <th scope="col" style="text-align:center;">ลบ</th>
                    </tr>
                </thead>
                <tbody>



                <?php
                
                    if (!$receiptNo) {
                        $stmt = $conn->query("SELECT * FROM bill_line");
                        $stmt->execute();
                        $bill = $stmt->fetchAll();
                        
                    } else {
                        $stmt = $conn->query("SELECT * FROM bill_line WHERE receipt_no = '$receiptNo'");
                        $stmt->execute();
                        $bill = $stmt->fetchAll();

                    }

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
                                <button type="button" class="btn btn-sm btn-outline-dark" data-bs-toggle="modal" data-bs-target="#modalEditBill<?php echo $fetch_bill['id']; ?>"><i class="fas fa-edit"></i></button>
                                <button type="button" class="btn btn-sm btn-outline-danger" data-bs-toggle="modal" data-bs-target="#modalDeleteBillList<?php echo $fetch_bill['id']; ?>"><i class="fas fa-trash"></i></button>
                            </div>
                        </td>
                    </tr>


                    <!-- Modal Edit billLine -->
                    <div class="modal fade" id="modalEditBill<?php echo $fetch_bill['id']; ?>" tabindex="-1" aria-labelledby="modalEditBill" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="modalEditBill"><i class="fa-solid fa-pen-to-square"></i> แก้ไขรายจ่าย (รายละเอียด)</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>

                                <div class="modal-body">
                                    <form action="../db/db_expense.php" method="POST">
                                        <div class="mb-0">
                                            <input type="hidden" class="form-control" name="id" value="<?php echo $fetch_bill['id']; ?>" readonly required>
                                            <label for="editReceiptNo" class="col-form-label">เลขที่ใบเสร็จ :</label>
                                            <input type="text" class="form-control" id="editReceiptNo" value="<?php echo $fetch_bill['receipt_no']; ?>" readonly required style="background-color: rgb(235, 235, 235);">
                                        </div>
                                        <div class="mb-0">
                                            <label for="editItems" class="col-form-label">รายการ :</label>
                                            <input type="text" class="form-control" name="editItems" id="editItems" list="addItems" value="<?php echo $fetch_bill['item_name']; ?>" required>
                                        </div>
                                        <div class="mb-0">
                                            <label for="editQty" class="col-form-label">จำนวน :</label>
                                            <input type="number" class="form-control" name="editQty" id="itemQty2" value="<?php echo $fetch_bill['qty']; ?>" oninput="calculateSum2()" required>
                                        </div>
                                        <div class="mb-0">
                                            <label for="editAmount" class="col-form-label">ราคา/หน่วย :</label>
                                            <input type="number" class="form-control" name="editAmount" id="unitPrice2" value="<?php echo $fetch_bill['amount']; ?>" step=".01" oninput="calculateSum2()" required>
                                        </div>
                                        <div class="mb-2">
                                            <label for="editTotal" class="col-form-label">ยอดรวม :</label>
                                            <input type="number" class="form-control" name="editTotal" id="itemTotal2" value="<?php echo $fetch_bill['total']; ?>" step=".01" required readonly>
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
                    </div>


                    <!-- Modal ยืนยันลบข้อมูล ห้ามลบ -->
                    <div class="modal fade" id="modalDeleteBillList<?php echo $fetch_bill['id']; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title fw-bold"> ลบรายการ</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    
                                    <h6 class="text-center">รายการ :<?php echo $fetch_bill['item_name']; ?></h6>
                                    <p class="text-center">ยอดรวม : <?php echo number_format(($fetch_bill['total']), 2); ?> บาท</p>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">ยกเลิก</button>
                                    <a data-id="<?php echo $fetch_bill['id']; ?>" href="?delete_BillLine=<?php echo $fetch_bill['id']; ?>" class="btn btn-danger"><i class="fas fa-trash"></i> ยืนยัน</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php } ?>
                </tbody>
            </table>
        </fieldset>
    </section>


   


    <!-- สคริป ค้นหาเลขที่ใบเสร็จ -->
    <script>
        var select_box_element_site = document.querySelector('#searchReceipt');
        dselect(select_box_element_site, {
            search: true
        });
    </script>


<script>
        var select_box_element_site2 = document.querySelector('#itemName');
        dselect(select_box_element_site2, {
            search: true
        });
    </script>


    <!-- สคริป ยอดรวม -->
    <script>
        function calculateSum() {
            var price = document.getElementById("itemQty").value;
            var quantity = document.getElementById("unitPrice").value;
            var sum = price * quantity;

            document.getElementById("itemTotal").value = parseFloat(sum).toFixed(2);
        }

        function calculateSum2() {
            var price = document.getElementById("itemQty2").value;
            var quantity = document.getElementById("unitPrice2").value;
            var sum = price * quantity;

            document.getElementById("itemTotal2").value = parseFloat(sum).toFixed(2);
        }
    </script>


    <!-- check ถ้า sumDiff = 0 disable button -->
    <script>
        const sumDiff = document.getElementById("sumDiff");
        const submitButton = document.querySelector('button[name="add_billLine"]');

        if (sumDiff.value === "0") {
            submitButton.disabled = true;
        }

        // Listen for changes in sumDiff value
        sumDiff.addEventListener("input", handleInputChange);

        function handleInputChange() {
            if (sumDiff.value === "0") {
            submitButton.disabled = true;
            } else {
            submitButton.disabled = false;
            }
        }
    </script>



</body>
</html>