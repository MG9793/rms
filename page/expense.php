<?php
    require_once "../include/dependency.php";
    require_once "../include/header.php";
    require_once "../db/config/deleteRow.php";
    

    $bill = $conn->prepare("SELECT* FROM bill_head");
    $bill->execute();
    $rs = $bill->fetchAll();

   
      
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
</head>
<body>
    
    <!-- pagename ห้ามลบ -->
    <section class="container mt-2">

        <div class="fw-bold text-dark bg-secondary shadow-sm p-2 ">
        <legend class="fw-bold text-dark text-center  p-1"> บันทึกรายจ่าย </legend>
        <form action="#" method="POST">
                        <!-- <div class="text-center"><img src="../image/icon/cost.png" class="w-25" alt=""></div> -->
                        <input type="hidden" readonly value="<?php //echo $userAccount['id_users']; ?>" required class="form-control" name="id_site">
                        <div class="row">
                            <div class="col-md-6">
                                <label class="form-label fw-bold" for="receiptNo">เลขที่ใบเสร็จ :</label>
                                <input type="text" class="form-control" placeholder="กรุณากรอกเลขที่ใบเสร็จ..." name="receiptNo" id="receiptNo" required>
                            </div>
                            <div class="col-md-4">
                                <label class="form-label fw-bold" for="buyDate">วันที่ซื้อ :</label>
                                <input type="date" class="form-control" name="buyDate" id="buyDate" required>
                            </div>
                        </div>
                        <div class="row mt-3">
                            <div class="col-md-6">
                                <label class="form-label fw-bold" for="sellerName">ชื่อผู้ขาย :</label>
                                <input type="text" class="form-control" name="sellerName" id="sellerName" placeholder="กรุณากรอกชื่อผู้ขาย..." required>
                            </div>
                            <div class="col-md-4">
                                <label class="form-label fw-bold" for="taxID">เลขประจำตัวผู้เสียภาษี :</label>
                                <input type="text" class="form-control" name="taxID" id="taxID" placeholder="กรุณากรอกเลขประจำตัวผู้เสียภาษี..." required>
                            </div>
                        </div>
                       
                        <div class="row">
                        <div class="col-md-4">
                                <label class="col-form-label fw-bold">รวมเงินค่าสินค้าและค่าขนส่ง :</label>
                                <input type="number" class="form-control" name="expenseSUM" id="expenseSUM" list="expenseSUM" required disabled>
                            </div>
                            <div class="col-md-2">
                                <label class="col-form-label fw-bold">ภาษีมูลค่าเพิ่ม :</label>
                                <input type="number" class="form-control" name="expenseVAT" id="expenseVAT" list="expenseVAT">
                            </div>
                            
                            <div class="col-md-4">
                                <label class="col-form-label fw-bold">จำนวนเงินทั้งสิ้น :</label>
                                <input type="number" class="form-control" name="expenseTotal" id="expenseTotal" list="expenseTotal" oninput="calculateVAT()" required>
                            </div>
                        </div>

                        <div class="row mt-4">
                            <div class="col-md">
                                <button type="submit" class="btn btn-success text-light w-100">บันทึก</button>
                            </div>
                        </div>
                    </form>
 
    </div>
    </section>

    <!-- input ห้ามลบ -->
    <section class="container">
        

        <fieldset class="p-3 shadow-sm mt-3">
            <table class="table table-striped table-hover shadow-sm css-serial" id="myTable">
                <thead>

                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">วันที่ซื้อ</th>
                        <th scope="col">เลขที่ใบเสร็จ</th>
                        <th scope="col">ชื่อผู้ขาย</th>
                        <th scope="col">เลขประจำตัวผู้เสียภาษี</th>
                        <th scope="col">ยอดรวม</th>
                        <th scope="col">แก้ไข</th>
                    </tr>
                </thead>
                <tbody>
                <!-- query ตาราง ห้ามลบ -->
                <?php
                        $stmt = $conn->query("SELECT * FROM bill_head");
                        $stmt->execute();
                        $bill = $stmt->fetchAll();

                        if (!$bill) {
                           
                        } else {
                            foreach ($bill as $fetch_bill) {
                    ?>

                    <tr>
                        <td></td>
                        <td><?php echo $fetch_bill['sales_date']; ?></td>
                        <td><?php echo $fetch_bill['receipt_no']; ?></td>
                        <td><?php echo $fetch_bill['sales_name']; ?></td>
                        <td><?php echo $fetch_bill['tax_no']; ?></td>
                        <td><?php echo number_format(($fetch_bill['sum']),2); ?></td>
                        <td>
                            <div class="btn-group" role="group" aria-label="Basic outlined example">
                            <button type="button" class="btn btn-sm btn-outline-dark" data-bs-toggle="modal" data-bs-target="#expenseDetailsVAT<?php echo $fetch_bill['id']; ?>"><i class="fas fa-edit"></i></button>
                 
                                <button type="button" class="btn btn-sm btn-outline-danger" data-bs-toggle="modal" data-bs-target="#modalDeleteBill<?php echo $fetch_bill['id']; ?>"><i class="fas fa-trash"></i></button>
                            </div>
                        </td>
                    </tr>


<!-- Modal -->
<div class="modal fade" id="expenseDetailsVAT<?php echo $fetch_bill['id']; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true" data-bs-backdrop="static" data-bs-keyboard="false">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
            <div class="modal-header">
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="#" method="POST">
                        <!-- <div class="text-center"><img src="../image/icon/cost.png" class="w-25" alt=""></div> -->
                        <input type="hidden" readonly value="<?php echo $fetch_bill['id']; ?>" required class="form-control" name="id_site">
                        <div class="row">
                        
                            <div class="col-md d-flex" >
                                
                                <div><h5>เลขที่ใบสั่งซื้อ <b><?php echo $fetch_bill['receipt_no']; ?></b></h5></div>
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
                                <input type="number" class="form-control" name="itemSum" id="itemSum" disabled required>
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
                            <div ><h5>จำนวนเงินทั้งสิ้น <b><?php echo number_format(($fetch_bill['sum']),2) ?></b> บาท</h5></div>
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
    </div>

 <!-- Modal ยืนยันลบข้อมูล ห้ามลบ -->
 <div class="modal fade" id="modalDeleteBill<?php echo $fetch_bill['id']; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title"><i class="fas fa-trash"></i> ยืนยันลบรายการสินค้า ?</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <h6 class="text-center">ต้องการลบรายการสินค้าหรือไม่ ? กรุณายืนยัน</h6>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                    <a data-id="<?php echo $fetch_bill['id']; ?>" href="?deleteBill=<?php echo $fetch_bill['id']; ?>" class="btn btn-danger"><i class="fas fa-trash"></i> Delete</a>
                                </div>
                            </div>
                        </div>
                    </div>

                    <?php } } ?>        <!-- endforeach -->
                
                         
                    </tr>
                </tbody>
            </table>
        </fieldset>
    </section>  

    




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
        function calculateVAT() {
            var price = document.getElementById("expenseTotal").value;
            var vat = price * 0.07;
            document.getElementById("expenseVAT").value = vat.toFixed(2);
            document.getElementById("expenseSUM").value = (parseFloat(price) - vat).toFixed(2);
        }
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

