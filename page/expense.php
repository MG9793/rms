<?php
    require_once "include/dependency.php";
    require_once "include/header.php";
    

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
                <?php foreach($rs as $row) { 
                    echo "<tr>";
                 ?>
                    <td></td>
                    <?php
                    echo "<td>" . $row['sales_date'] . "</td>";
                    echo "<td>" . $row['receipt_no'] . "</td>";
                    echo "<td>" . $row['sales_name'] . "</td>";
                    echo "<td>" . $row['tax_no'] . "</td>";
                    echo "<td>" . $row['sum'] . "</td>"; 
                    echo "<td>" . '<button type="button" class="btn btn-dark btn-sm w-50" data-bs-toggle="modal" data-bs-target="#expenseDetailsVAT"><i class="fas fa-edit"></i></button>' . "</td>"; 
                   
                         } ?>
                         
                    </tr>
                </tbody>
            </table>
        </fieldset>
    </section>  

    <!-- Modal -->
    <div class="modal fade" id="expenseDetailsVAT" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true" data-bs-backdrop="static" data-bs-keyboard="false">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
            <div class="modal-header">
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="#" method="POST">
                        <!-- <div class="text-center"><img src="../image/icon/cost.png" class="w-25" alt=""></div> -->
                        <input type="hidden" readonly value="<?php //echo $userAccount['id_users']; ?>" required class="form-control" name="id_site">
                        <div class="row">
                        
                            <div class="col-md d-flex" >
                                
                                <div><h5>เลขที่ใบสั่งซื้อ <b><?php echo $row['receipt_no']; ?></b></h5></div>
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
                            <div ><h5>จำนวนเงินทั้งสิ้น <b><?php echo number_format(($row['sum']),2) ?></b> บาท</h5></div>
                            </div>
                        </div>

                        <div class="row mt-4">
                            <div class="col-md">
                                <button type="submit" class="btn btn-success text-light w-100"><i class="fa-solid fa-floppy-disk"></i> Save</button>
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

