<?php
    require_once "../include/dependency.php";
    require_once "../include/header.php";
    require_once "../db/config/deleteRow.php";

    // ดึง id จาก session
    $selectedValue = $_SESSION['edit_billLine'];

    // query bill_line
    $stmt = $conn->query("SELECT * FROM bill_line WHERE receipt_no = '$selectedValue'");
    $selectLine_query = $stmt->fetch(PDO::FETCH_ASSOC);

    // query sum of selected bill_line
    $billLine = $conn->query("SELECT SUM(total) AS lineTotal FROM bill_line WHERE receipt_no = '$selectedValue'");
    $sumLine = $billLine->fetch(PDO::FETCH_ASSOC);

    // query bill_head
    $stmt = $conn->query("SELECT * FROM bill_head WHERE receipt_no = '$selectedValue'");
    $selectHead_query = $stmt->fetch(PDO::FETCH_ASSOC);
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

    <script src="../resources/lib/dselect.js"></script>
    
</head>
<body>
    

    <!-- input ห้ามลบ -->
    <section class="container my-2">
        <fieldset class="p-3 shadow-sm">
            <h5 class="fw-bold text-dark text-center p-2">แก้ไขรายการ</h5>



            <h6><b>เลขที่ใบเสร็จ : </b> <i><?php echo $selectLine_query['receipt_no']; ?></i><br>
                <b>ไซต์งาน : </b> <?php echo $selectHead_query['site_name']; ?><br>
                <b>ชื่อผู้ขาย : </b> <?php echo $selectHead_query['sales_name']; ?><br>
                <b>เลขประจำตัวผู้เสียภาษี : </b> <?php echo $selectHead_query['tax_no']; ?>
            </h6>
            <hr>




            <form action="../db/db_expense.php" method="POST">

                <?php
                    $bill_no = $selectLine_query['receipt_no'];

                    $stmt = $conn->query("SELECT * FROM bill_line WHERE receipt_no = '$bill_no'");
                    $stmt->execute();
                    $bill = $stmt->fetchAll();

                    $num_rows = count($bill);
                ?>




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
                    </div>


                <?php

                    for ($i = 0; $i < $num_rows; $i++) {
                        $fetch_bill = $bill[$i];

                        echo "<div class='row'>";

                        echo "<div class='col-md-6 my-1'>";
                        echo "<input type='hidden' name='id_$i' value='" . $fetch_bill['id'] . "' readonly>";
                        echo "<input type='text' class='form-control' name='addItems_$i' value='" . $fetch_bill['item_name'] . "' list='addItems_$i' required>";
                        echo "</div>";

                        echo "<div class='col-md-2 my-1'>";
                        echo "<input type='number' class='form-control qty' name='qty_$i' value='" . $fetch_bill['qty'] . "' required>";
                        echo "</div>";

                        echo "<div class='col-md-2 my-1'>";
                        echo "<input type='number' class='form-control amount' name='amount_$i' value='" . $fetch_bill['amount'] . "' step='.01' required>";
                        echo "</div>";

                        echo "<div class='col-md-2 my-1'>";
                        echo "<input type='number' class='form-control total' name='total_$i' value='" . $fetch_bill['total'] . "' step='.01' required readonly>";
                        echo "</div>";

                        echo "</div>";


                        echo "<datalist id='addItems_$i'>";
                        $stmt = $conn->query("SELECT item_name FROM item_info");
                        $stmt->execute();
                        $item = $stmt->fetchAll();
                        if (!$item) {
                        } else {
                            foreach ($item as $fetch_item) {
                                echo "<option value='" . $fetch_item['item_name'] . "'>";
                            }
                        }
                        echo "</datalist>";
                    }
                    
                ?>

                    <div class='row'>
                        <div class='col-md'></div>
                        <div class='col-md-2'>
                            <label class="col-form-label fw-bold">ยอดเงินตามใบเสร็จ :</label>
                            <input type='number' class='form-control' value='<?php echo $selectHead_query["total"]; ?>' readonly style="background-color: rgb(235, 235, 235);">
                        </div>
                        <div class='col-md-2'>
                            <label class="col-form-label fw-bold">ยอดเงินที่บันทึก :</label>
                            <input type='number' class='form-control sumResult' name='sumResult' value='<?php echo $sumLine['lineTotal']; ?>' readonly style="background-color: rgb(235, 235, 235);">
                        </div>
                    </div>

                <input type="hidden" name="num_rows" value="<?php echo $num_rows; ?>">
                <input type="hidden" name="get_receiptNo" value="<?php echo $selectLine_query['receipt_no']; ?>" readonly>
                <button type="submit" name="update_billLine" class="btn btn-success text-light w-100 mt-3"><i class="fa-solid fa-floppy-disk"></i> บันทึก</button>
            </form>
            
        </fieldset>
    </section>




    <!-- calculate autosum แต่ละแถว -->
    <script>
        $('.qty, .amount').on('input', function() {
            var row = $(this).closest('.row'); // Get the parent row
            var qty = row.find('.qty').val(); // Get the value of the qty input
            var price = row.find('.amount').val(); // Get the value of the price input
            var result = qty * price; // Calculate the result
            row.find('.total').val(result); // Set the value of the result input
        });
    </script>


    <!-- calculate autosum ทุกแถว -->
    <script>
        $('.qty, .amount').on('input', function() {
            var total = 0; // Initialize the total
            $('.total').each(function() {
                total += parseInt($(this).val()); // Add the value of each result input to the total
            });
            $('.sumResult').val(total); // Set the value of the sumResult input to the total
        });
    </script>




</body>
</html>