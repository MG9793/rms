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
                        <label for="itemName" class="col-form-label fw-bold"><i class="fa-solid fa-plus"></i> รายการ :</label>
                    </div>
                    <div class="col-md-2">
                        <label for="itemPrice" class="col-form-label fw-bold">จำนวน :</label>
                    </div>
                    <div class="col-md-2">
                        <label for="unitPrice" class="col-form-label fw-bold">ราคา/หน่วย :</label>
                    </div>
                    <div class="col-md-2">
                        <label for="itemSum" class="col-form-label fw-bold">ยอดรวม :</label>
                    </div>
                    <div class="col-md-1">
                        <label class="col-form-label fw-bold">ลบ</label>
                    </div>
                </div>
                <div class="row" id="item_fields">
                    <div class="col-md">
                        <input type="hidden" class="form-control" name="receiptNo" value="<?php echo $selectLine_query['receipt_no']; ?>" readonly>
                        <input type="text" class="form-control" name="itemName[]" id="itemName" list="addItems" required>
                    </div>
                    <div class="col-md-2">
                        <input type="number" class="form-control" name="itemQty[]" id="itemQty" oninput="calculateSum()" required>
                    </div>
                    <div class="col-md-2">
                        <input type="number" class="form-control" name="unitPrice[]" id="unitPrice" oninput="calculateSum()" required>
                    </div>
                    <div class="col-md-2">
                        <input type="number" class="form-control" name="itemTotal[]" id="itemTotal" required>
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
                <div class="row">
                    <div class="col-md-11 text-end">
                        <div><h5>จำนวนเงินทั้งสิ้น <b><?php echo number_format(($selectLine_query['sum']),2) ?></b> บาท</h5></div>
                    </div>
                </div>

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


    <!-- Autocomplete -->
    <datalist id="addItems">
        <?php
            $stmt = $conn->query("SELECT item_name FROM bill_line");
            $stmt->execute();
            $item = $stmt->fetchAll();

            if (!$item) {            
            
            } else {
                foreach ($item as $fetch_item) {
        ?>

        <option value="<?php echo $fetch_item['item_name']; ?>"></option>
        <?php } } ?>
    </datalist>


    <!-- สคริป ยอดรวม -->
    <script>
        function calculateSum() {
            var price = document.getElementById("itemQty").value;
            var quantity = document.getElementById("unitPrice").value;
            var sum = price * quantity;

            document.getElementById("itemTotal").value = parseFloat(sum).toFixed(2);;
        }
    </script>


    <!-- สคริป ยอดรวม สำหรับปุ่ม Add -->
    <script>
        function calculateSum_add(uniqueId) {
            var price = document.getElementById("itemQty_add" + uniqueId).value;
            var quantity = document.getElementById("unitPrice_add" + uniqueId).value;
            var sum = price * quantity;

            document.getElementById("itemTotal_add" + uniqueId).value = parseFloat(sum).toFixed(2);;
        }
    </script>


    <!-- input ห้ามลบ -->
    <section class="container">
        <fieldset class="p-3 shadow-sm my-2">
            <table class="table table-striped table-hover shadow-sm css-serial" id="myTable">
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


                    <!-- query ตาราง ห้ามลบ -->
                    <?php
                        $receiptNo = $selectLine_query['receipt_no'];

                        $stmt = $conn->query("SELECT * FROM bill_line WHERE receipt_no = '$receiptNo'");
                        $stmt->execute();
                        $bill = $stmt->fetchAll();

                        if (!$bill) {
                           
                        } else {
                            foreach ($bill as $fetch_bill) {
                    ?>

                    <tr style="text-align:center;">
                        <td></td>
                        <td><?php echo $fetch_bill['receipt_no']; ?></td>
                        <td><?php echo $fetch_bill['item_name']; ?></td>
                        <td><?php echo $fetch_bill['qty']; ?></td>
                        <td><?php echo $fetch_bill['amount']; ?></td>
                        <td><?php echo number_format(($fetch_bill['total']), 2); ?></td>
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







</body>
</html>

<?php } ?>