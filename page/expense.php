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

    if (!isset($_SESSION['site'])) {
        //  header("location: incomeRecord.php");
        $site="";
      } else {

      // ดึง sitename จาก session
      $site = $_SESSION['site'];
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
</head>
<body>
    
    <!-- pagename ห้ามลบ -->
    <section class="container mt-2">
        <div class="container border border-3 border-light bg-secondary shadow-sm">
            <legend class="fw-bold text-dark text-center p-2">บันทึกรายจ่าย </legend>
            <form action="../db/db_expense.php" method="POST">

                <div class="row mb-2">
                    <div class="col-md-4">
                        <label class="form-label fw-bold" for="siteName">ไซต์งาน :</label>
                        <select name="siteName" class="form-select" id="siteName">
                            
                            <?php 
                                    if($_SESSION['site']=="") { ?>

                                        <option value="">กรุณาเลือกไซต์งาน</option>
                                        <?php
                                    foreach($rs_site as $row_site) {
                                        echo '<option value="'.$row_site["site_name"].'">'.$row_site["site_name"].'</option>';
                                    }
                                    } else {
                                    echo '<option value="' .$_SESSION["site"]. '">' .$_SESSION["site"]. '</option>';

                                    foreach($rs_site as $row_site) {
                                        echo '<option value="'.$row_site["site_name"].'">'.$row_site["site_name"].'</option>';
                                    }

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

                <div class="row mb-2">
                    <div class="col-md-4">
                        <label class="form-label fw-bold" for="salesName">ชื่อผู้ขาย :</label>
                        <select class="form-select" name="salesName" id="salesName" onChange="taxID();">
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
                        <input type="text" class="form-control" name="taxNO" id="taxNO" minlength="13" maxlength="13" placeholder="กรุณากรอกเลขประจำตัวผู้เสียภาษี" readonly required>
                        <input type="hidden" class="form-control" name="sales" id="sales" required>
                    </div>
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
                            <option value="">--เลือกการคำนวนภาษี--</option>
                            <option value="VAT">VAT</option>
                            <option value="noVAT">noVAT</option>
                        </select>
                    </div>
                </div>

                <div class="row mb-3"> 
                    <div class="col-md-4">
                        <label class="form-label fw-bold">รวมเงินค่าสินค้าและค่าขนส่ง :</label>
                        <input type="text" class="form-control" name="expenseSUM" id="expenseSUM" list="expenseSUM">
                    </div>
                    <div class="col-md-4">
                        <label class="form-label fw-bold">ภาษีมูลค่าเพิ่ม :</label>
                        <input type="text" class="form-control" name="expenseVAT" id="expenseVAT" list="expenseVAT">
                    </div>
                    <div class="col-md-4">
                        <label class="form-label fw-bold">จำนวนเงินทั้งสิ้น :</label>
                        <input type="number" class="form-control" name="expenseTotal" id="expenseTotal" list="expenseTotal" oninput="calculateVAT()" required>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-12">
                        <button type="submit" class="btn btn-success w-100" name="add_billHead">บันทึก</button>
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

                    <tr >
                        <th scope="col" style="text-align:center;">#</th>
                        <th scope="col" style="text-align:center;">ไซต์งาน</th>
                        <th scope="col" style="text-align:center;">เลขที่ใบเสร็จ</th>
                        <th scope="col" style="text-align:center;">วันที่ซื้อ</th>
                        <th scope="col" style="text-align:center;">ชื่อผู้ขาย</th>
                        <th scope="col" style="text-align:center;">เลขประจำตัวผู้เสียภาษี</th>
                        <th scope="col" style="text-align:center;">ประเภท</th>
                        <th scope="col" style="text-align:center;">จำนวนเงินทั้งสิ้น</th>
                        <th scope="col" style="text-align:center;">แก้ไข/ลบ</th>
                    </tr>
                </thead>
                <tbody>
                <!-- query ตาราง ห้ามลบ -->
                <?php
                 
                        if($site!="") { 
                            $site=$_SESSION['site'];
                            $stmt = $conn->query("SELECT * FROM bill_head WHERE site_name = '$site' ORDER BY id DESC");
                        $stmt->execute();
                        $bill = $stmt->fetchAll();
                        }else{
                        $stmt = $conn->query("SELECT * FROM bill_head ORDER BY id DESC");
                        $stmt->execute();
                        $bill = $stmt->fetchAll();
                    }
                        if (!$bill) {
                           
                        } else {
                            foreach ($bill as $fetch_bill) {
                    ?>

                    <tr style="text-align:center;">
                        <td></td>
                        <td><?php echo $fetch_bill['site_name']; ?></td>
                        <td><?php echo $fetch_bill['receipt_no']; ?></td>
                        <td><?php echo $fetch_bill['buy_date']; ?></td>
                        <td><?php echo $fetch_bill['sales_name']; ?></td>
                        <td><?php echo $fetch_bill['tax_no']; ?></td>
                        <td><?php echo $fetch_bill['type']; ?></td>
                        <td><?php echo number_format(($fetch_bill['total']),2); ?></td>
                        <td>
                            <div class="btn-group" role="group" aria-label="Basic outlined example">
                                <button type="button" class="btn btn-sm btn-outline-dark" data-bs-toggle="modal" data-bs-target="#modalEditBill<?php echo $fetch_bill['id']; ?>"><i class="fas fa-edit"></i></button>
                                <button type="button" class="btn btn-sm btn-outline-danger" data-bs-toggle="modal" data-bs-target="#modalDeleteBill<?php echo $fetch_bill['id']; ?>"><i class="fas fa-trash"></i></button>
                            </div>
                        </td>
                    </tr>


                    <!-- Modal Edit billHead -->
                    <div class="modal fade" id="modalEditBill<?php echo $fetch_bill['id']; ?>" tabindex="-1" aria-labelledby="modalEditBill" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="modalEditBill"><i class="fa-solid fa-pen-to-square"></i> แก้ไขรายการรายจ่าย</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>

                                <div class="modal-body">
                                    <form action="../db/db_expense.php" method="POST">
                                        <div class="mb-0">
                                            <input type="hidden" class="form-control" name="id" value="<?php echo $fetch_bill['id']; ?>" readonly required>
                                            <label for="editSiteName" class="col-form-label">ไซต์งาน :</label>
                                            <input type="text" class="form-control" name="editSiteName" id="editSiteName" list="edit_SiteName" value="<?php echo $fetch_bill['site_name']; ?>" required>
                                        </div>
                                        <div class="mb-0">
                                            <label for="editReceiptNo" class="col-form-label">เลขที่ใบเสร็จ :</label>
                                            <input type="text" class="form-control" name="editReceiptNo" id="editReceiptNo" value="<?php echo $fetch_bill['receipt_no']; ?>" required>
                                        </div>
                                        <div class="mb-0">
                                            <label for="editBuyDate" class="col-form-label">วันที่ซื้อ :</label>
                                            <input type="date" class="form-control" name="editBuyDate" id="editBuyDate" value="<?php echo $fetch_bill['buy_date']; ?>" required>
                                        </div>
                                        <div class="mb-0">
                                            <label for="editSalesName" class="col-form-label">ชื่อผู้ขาย :</label>
                                            <input type="text" class="form-control" name="editSalesName" id="editSalesName" list="edit_SalesName" value="<?php echo $fetch_bill['sales_name']; ?>" required readonly style="background-color: rgb(235, 235, 235);">
                                        </div>
                                        <div class="mb-0">
                                            <label for="editTaxNO" class="col-form-label">เลขประจำตัวผู้เสียภาษี (13 หลัก) :</label>
                                            <input type="text" class="form-control" name="editTaxNO" id="editTaxNO" minlength="13" maxlength="13" value="<?php echo $fetch_bill['tax_no']; ?>" required readonly style="background-color: rgb(235, 235, 235);">
                                        </div>
                                        <div class="mb-0">
                                            <label for="editType" class="col-form-label">ประเภท :</label>
                                            <select class="form-select" aria-label="editType" name="editType" required>
                                                <option>ค่าวัสดุ</option>
                                                <option>ค่าแรง</option>
                                            </select>
                                        </div>
                                        <div class="mb-2">
                                            <label for="editExpenseTotal" class="col-form-label">จำนวนเงินทั้งสิ้น :</label>
                                            <input type="number" class="form-control" name="editExpenseTotal" id="editExpenseTotal" value="<?php echo $fetch_bill['total']; ?>" required readonly style="background-color: rgb(235, 235, 235);">
                                        </div>
                                        <p>* หากต้องการแก้ไขชื่อผู้ขาย, จำนวนเงิน ให้ลบรายการแล้วบันทึกใหม่</p>

                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                            <button type="submit" class="btn btn-dark w-25" name="edit_billHead"><i class="fa-solid fa-floppy-disk"></i> Save</button>
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
                                    <h5 class="modal-title"> ลบรายการ</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <h6 class="text-center">กรุณายืนยันการลบรายการ</h6>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">ยกเลิก</button>
                                    <a data-id="<?php echo $fetch_bill['id']; ?>" href="?delete_BillHead=<?php echo $fetch_bill['id']; ?>" class="btn btn-danger"><i class="fas fa-trash"></i> ยืนยัน</a>
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


    <!-- Autocomplete -->
    <datalist id="edit_SiteName">
        <?php
            $stmt = $conn->query("SELECT site_name FROM site_info");
            $stmt->execute();
            $site = $stmt->fetchAll();

            if (!$site) {            
            
            } else {
                foreach ($site as $fetch_site) {
        ?>

        <option value="<?php echo $fetch_site['site_name']; ?>"></option>
        <?php } } ?>
    </datalist>


    <!-- Autocomplete -->
    <datalist id="edit_SalesName">
        <?php
            $stmt = $conn->query("SELECT sales_name FROM sales_info");
            $stmt->execute();
            $sales = $stmt->fetchAll();

            if (!$sales) {            
            
            } else {
                foreach ($sales as $fetch_sales) {
        ?>

        <option value="<?php echo $fetch_sales['sales_name']; ?>"></option>
        <?php } } ?>
    </datalist>

    
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

