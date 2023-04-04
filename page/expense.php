<?php
    require_once "../include/dependency.php";
    require_once "../include/header.php";
    require_once "../db/config/deleteRow.php";
    

    $bill = $conn->prepare("SELECT* FROM bill_head");
    $bill->execute();
    $rs = $bill->fetchAll();

    $site_name = $conn->prepare("SELECT site_name FROM site_info");
    $site_name->execute();
    $rs_site = $site_name->fetchAll();

    $sales_name = $conn->prepare("SELECT * FROM sales_info");
    $sales_name->execute();
    $rs_sales = $sales_name->fetchAll();

      
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
        <button type="button" class="btn btn-light w-100" data-bs-toggle="collapse" href="#displayInput" aria-expanded="false" aria-controls="displayInput"><i class="fa-solid fa-plus"></i> บันทึกรายจ่าย</button>
            
        <div class="fw-bold text-dark bg-secondary shadow-sm p-3 collapse mt-2" id="displayInput">
            <form action="../db/db_expense.php" method="POST">    
                <div class="row">
                    <div class="col-md-4">
                        <label class="form-label fw-bold" for="siteName">ไซต์งาน :</label>
                        <select name="siteName" class="form-select" id="siteName">
                            <option value="">กรุณาเลือกไซต์งาน</option>
                            <?php 
                                foreach($rs_site as $row_site)
                                    {
                                        echo '<option value="'.$row_site["site_name"].'">'.$row_site["site_name"].'</option>';
                                    }
                            ?>  
                        </select>
                    </div>

                    <div class="col-md-4">
                        <label class="form-label fw-bold" for="receiptNo">เลขที่ใบเสร็จ :</label>
                        <input type="text" class="form-control" placeholder="กรุณากรอกเลขที่ใบเสร็จ..." name="receiptNo" id="receiptNo" required>
                    </div>
                    <div class="col-md-4">
                        <label class="form-label fw-bold" for="buyDate">วันที่ซื้อ :</label>
                        <input type="date" class="form-control" name="buyDate" id="buyDate" required>
                    </div>
                </div>


                <div class="row mt-2">
                    <div class="col-md-4">
                        <label class="form-label fw-bold" for="salesName">ชื่อผู้ขาย :</label>
                        <select name="salesName" class="form-select" id="salesName" onChange="taxID();">
                            <option value="">กรุณาเลือกผู้ขาย</option>
                            <?php 
                                foreach($rs_sales as $row_sales)
                                    {
                                        echo '<option value="'.$row_sales["sales_name"].$row_sales["tax_no"].'">'.$row_sales["sales_name"].'</option>';
                                    }
                            ?>
                        </select>
                    </div>

                    <div class="col-md-4">
                        <label class="form-label fw-bold" for="taxNO">เลขประจำตัวผู้เสียภาษี (13 หลัก) :</label>
                        <input type="text" class="form-control" name="taxNO" id="taxNO" minlength="13" maxlength="13" placeholder="กรุณากรอกเลขประจำตัวผู้เสียภาษี" required>
                    </div>
                        
                    <input type="hidden" class="form-control" name="sales" id="sales" required>
                    <div class="col-md-2">
                        <label class="form-label fw-bold" for="type">ประเภท :</label>
                        <select name="type" id="type" class="form-control" required>
                            <option value="" >--เลือกประเภท--</option>
                            <option value="ค่าวัสดุ" >ค่าวัสดุ</option>
                            <option value="ค่าแรง" >ค่าแรง</option>
                        </select>
                    </div>

                    <div class="col-md-2">
                        <label class="form-label fw-bold" for="calVat">คำนวนภาษี :</label>
                        <select name="calVat" id="calVat" class="form-control" onChange="changetextbox();" required>
                            <option value="" >--เลือกการคำนวนภาษี--</option>
                            <option value="VAT" >VAT</option>
                            <option value="noVAT">noVAT</option>
                        </select>
                    </div>
                </div>


                <div class="row">    
                    <div class="col-md-4">
                        <label class="col-form-label fw-bold">รวมเงินค่าสินค้าและค่าขนส่ง :</label>
                        <input type="text" class="form-control" name="expenseSUM" id="expenseSUM" list="expenseSUM">
                    </div>

                    <div class="col-md-2">
                        <label class="col-form-label fw-bold">ภาษีมูลค่าเพิ่ม :</label>
                        <input type="text" class="form-control" name="expenseVAT" id="expenseVAT" list="expenseVAT">
                    </div>
                                
                    <div class="col-md-2">
                        <label class="col-form-label fw-bold">จำนวนเงินทั้งสิ้น :</label>
                        <input type="number" class="form-control" name="expenseTotal" id="expenseTotal" list="expenseTotal"  oninput="calculateVAT()" required>
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
        <fieldset class="p-3 shadow-sm mt-2">
            <table class="table table-striped table-hover shadow-sm css-serial" id="myTable">
                <thead>
                    <tr >
                        <th scope="col" style="text-align:center;">#</th>
                        <th scope="col" style="text-align:center;">วันที่ซื้อ</th>
                        <th scope="col" style="text-align:center;">เลขที่ใบเสร็จ</th>
                        <th scope="col" style="text-align:center;">ชื่อผู้ขาย</th>
                        <th scope="col" style="text-align:center;">เลขประจำตัวผู้เสียภาษี</th>
                        <th scope="col" style="text-align:center;">ยอดรวม</th>
                        <th scope="col" style="text-align:center;">แก้ไข</th>
                    </tr>
                </thead>
                <tbody>


                <!-- query ตาราง ห้ามลบ -->
                <?php
                        $stmt = $conn->query("SELECT * FROM bill_head ORDER BY id DESC");
                        $stmt->execute();
                        $bill = $stmt->fetchAll();

                        if (!$bill) {
                           
                        } else {
                            foreach ($bill as $fetch_bill) {
                    ?>

                    <tr style="text-align:center;">
                        <td></td>
                        <td><?php echo $fetch_bill['buy_date']; ?></td>
                        <td><?php echo $fetch_bill['receipt_no']; ?></td>
                        <td><?php echo $fetch_bill['sales_name']; ?></td>
                        <td><?php echo $fetch_bill['tax_no']; ?></td>
                        <td><?php echo number_format(($fetch_bill['sum']),2); ?></td>
                        <td>
                            <form action="../db/db_expense.php" method="POST">
                                <input type="hidden" class="form-control" name="id" value="<?php echo $fetch_bill['id']; ?>" readonly>
                                <div class="btn-group" role="group" aria-label="Basic outlined example">
                                    <button type="submit" class="btn btn-sm btn-outline-dark" name="expenseLine"><i class="fas fa-edit"></i></button>
                                    <button type="button" class="btn btn-sm btn-outline-danger" data-bs-toggle="modal" data-bs-target="#modalDeleteBill<?php echo $fetch_bill['id']; ?>"><i class="fas fa-trash"></i></button>
                                </div>
                            </form>
                        </td>
                    </tr>


                    <!-- Modal ยืนยันลบข้อมูล ห้ามลบ -->
                    <div class="modal fade" id="modalDeleteBill<?php echo $fetch_bill['id']; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title"> ลบรายการ</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <h6 class="text-center">กรุณายืนยันการลบรายการ</h6>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">ยกเลิก</button>
                                    <a data-id="<?php echo $fetch_bill['id']; ?>" href="?deleteBill=<?php echo $fetch_bill['id']; ?>" class="btn btn-danger"><i class="fas fa-trash"></i> ยืนยัน</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php } } ?>        <!-- endforeach -->
                </tbody>
            </table>
        </fieldset>
    </section>  

    
    <script>
        var select_box_element_site = document.querySelector('#siteName');

        dselect(select_box_element_site, {
            search: true
        });
    </script>

    <script>
        var select_box_element_sales = document.querySelector('#salesName');
        
        dselect(select_box_element_sales, {
            search: true
        });
    </script>

    <script>
        function taxID() {
            if(document.getElementById("salesName").value === ''){
                document.getElementById("taxNO").value = '';
            }else{
                var tax_sales = document.getElementById("salesName").value;
                document.getElementById("sales").value = tax_sales.slice(0,-13);
                document.getElementById("taxNO").value = tax_sales.slice(-13);
            }
        }
    </script>

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
        function changetextbox() {
            if(document.getElementById("calVat").value === "VAT"){
                document.getElementById("expenseSUM").value = "";;
                document.getElementById("expenseVAT").value = "";;
                document.getElementById("expenseTotal").value = "";

                $vatC = 0.07;
            }
            else if (document.getElementById("calVat").value === "noVAT"){
                document.getElementById("expenseSUM").value = "";;
                document.getElementById("expenseVAT").value = "";;
                document.getElementById("expenseTotal").value = "";;

                $vatC = 0;
            }
        }
    </script>

    <script>
        function changetax() {
            if(document.getElementById("calVat").value === "VAT"){
                document.getElementById("expenseSUM").value = "";;
                document.getElementById("expenseVAT").value = "";;
                document.getElementById("expenseTotal").value = "";

                $vatC = 0.07;

            }
            else if (document.getElementById("calVat").value === "noVAT"){
                document.getElementById("expenseSUM").value = "";;
                document.getElementById("expenseVAT").value = "";;
                document.getElementById("expenseTotal").value = "";;

                $vatC = 0;
            }
        }
    </script>

    <script>
        function calculateVAT() {
            var price = document.getElementById("expenseTotal").value;
            var vat = price * $vatC;
            document.getElementById("expenseVAT").value = vat.toFixed(2);
            document.getElementById("expenseSUM").value = (parseFloat(price) - vat).toFixed(2);
        }
    </script>

    <script>
        function calculateSum() {
            var price = document.getElementById("itemPrice").value;
            var quantity = document.getElementById("unitPrice").value;
            var sum = price * quantity;

            document.getElementById("itemSum").value = parseFloat(sum).toFixed(2);
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
