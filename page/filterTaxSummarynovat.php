<?php
session_start();
    require_once "../include/dependency.php";
    require_once "../include/header.php";
?>

<head>
    <style>
        div.headReport {
            text-align: left;
            background-color: #D3D3D3;
            border-radius: 5px;
        }
    </style>

    <!-- Custom CSS ค้นหา -->
    <script src="../resources/lib/dselect.js"></script>

    <!-- script Datables ห้ามลบจ้า -->
    <script>
        $(document).ready( function () {
            $('#myTable').DataTable();
        } );
    </script>

    <script>
        function toggleAll(source) {
        var checkboxes = document.querySelectorAll('input[type="checkbox"]');
        checkboxes.forEach(function(checkbox) {
            checkbox.checked = source.checked;
        });
        }
  </script>

</head>
<body>

    <section class="container-fluid my-3">
        <div class="card px-4">
            <div class="card-body">                          
                <div class="headReport">
                    <h5 class="fw-bold p-2 text-center">กรุณาเลือกข้อมูล | รายงานซื้อประจำเดือน (NO VAT) <?php echo $_SESSION['thisMonth']; ?></h5>
                </div>

                <?php
                    // Alert ไม่ได้เลือกรายการออกใบกำกับภาษี
                    if(isset($_SESSION['reportFailure'])) {
                        echo "<div class='alert alert-danger alert-dismissible fade show mt-2' role='alert'>";
                        echo "<button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>";
                        echo $_SESSION['reportFailure'];
                        unset($_SESSION['reportFailure']);
                        echo "</div>";
                    }

                    // query ตาราง
                    $thisMonth = $_SESSION['thisMonth'];
                    $stmt = $conn->query("SELECT * FROM bill_head WHERE DATE_FORMAT(buy_date, '%Y-%m') = '$thisMonth' AND vat = 0 AND report = 'N' ORDER BY buy_date ASC");
                    $tax = $stmt->fetchAll();

                    // query รวมยอดซื้อ
                    $sumBuy = $conn->query("SELECT SUM(sum) AS sumbuy FROM bill_head WHERE DATE_FORMAT(buy_date, '%Y-%m') = '$thisMonth' AND vat = 0 AND report = 'N'");
                    $query_sumBuy = $sumBuy->fetch(PDO::FETCH_ASSOC);

                    // query รวมยอดซื้อที่ออกรายงานแล้ว
                    $sumBuy_reported = $conn->query("SELECT SUM(sum) AS sumbuy_reported FROM bill_head WHERE DATE_FORMAT(buy_date, '%Y-%m') = '$thisMonth' AND vat = 0 AND report = 'Y'");
                    $query_sumBuy_reported = $sumBuy_reported->fetch(PDO::FETCH_ASSOC);
                ?>

                <form action="../db/db_filterTaxSummary_novat.php" method="POST">
                    <div class="row mt-3">
                        <div class="col-md-3 text-center">
                            <label for="selectedPrice" class="form-label fw-bold">รวมยอดซื้อที่เลือก :</label>
                            <h4 class="text-primary fw-bold" id="selectedPrice"><?php echo number_format($query_sumBuy['sumbuy'], 2); ?></h4>
                            <!-- <input type="number" class="form-control text-primary" name="selectedPrice" id="selectedPrice" value="<?php //echo $query_sumBuy['sumbuy']; ?>" required readonly min="0" step="any"> -->
                        </div>
                        <div class="col-md-3 text-center">
                            <label for="reportedPrice" class="form-label fw-bold">รวมยอดซื้อ (ออกรายงานแล้ว) :</label>
                            <h4 class="text-danger fw-bold" id="reportedPrice"><?php echo number_format($query_sumBuy_reported['sumbuy_reported'], 2); ?></h4>
                        </div>
                        <div class="col-md-3">
                            <label for="selectTime" class="form-label fw-bold">เดือน/ปี ที่ออกรายงาน (NO VAT) :</label>
                            <input type="month" class="form-control" name="selectTime" id="selectTime" required onchange="dateThaiFormat()">
                            <p class="text-primary fw-bold" id="sendReportDate" style="margin-bottom: -30px;"></p>
                        </div>
                        <div class="col-md-3" style="margin-top: 32px;">
                            <button type="submit" class="btn btn-primary w-100" name="sendReport"><i class="fa-solid fa-sheet-plastic"></i> &nbsp;บันทึกรายการซื้อ (NO VAT)</button>
                        </div>
                    </div>
                    <div class="row" style="margin-bottom: -30px;">
                        <div class="col-md-12">
                            <div class="form-check d-flex justify-content-end">
                                    <input class="form-check-input" type="checkbox" id="select-all" onchange="toggleAll(this)" checked>
                                    <label class="form-check-label" for="select-all">&nbsp;Select All</label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row px-4 my-2">
                        <div class="col-md-12">
                            <input type="text" class="form-control" id="searchData" placeholder="ค้นหาข้อมูล...">
                        </div>
                    </div>

                    <div class="table-responsive px-4 mb-2">
                        <table class="table table-sm table-hover mt-2 css-serial" id="searchTable">
                            <thead>
                                <tr>
                                    <th scope="col" class="fw-bold" style="text-align:center;">#</th>
                                    <th scope="col" class="fw-bold" style="text-align:center;">วันที่ซื้อ</th>
                                    <th scope="col" class="fw-bold" style="text-align:center;">ไซต์งาน</th>
                                    <th scope="col" class="fw-bold" style="text-align:center;">เลขที่ใบเสร็จ</th>
                                    <th scope="col" class="fw-bold">ชื่อผู้ขาย</th>
                                    <th scope="col" class="fw-bold" style="text-align:center;">เลขประจำตัวผู้เสียภาษี</th>
                                    <th scope="col" class="fw-bold" style="text-align:center;">สาขา</th>
                                    <th scope="col" class="fw-bold" style="text-align:right;">มูลค่าสินค้าหรือบริการ</th>
                                    <th scope="col" class="fw-bold" style="text-align:right;">จำนวนเงินภาษีมูลค่าเพิ่ม</th>
                                    <th scope="col" class="fw-bold" style="text-align:center;">ออกใบกำกับภาษี</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($tax as $filterTax) { ?>
                                <tr>
                                    <td style="text-align:center;"></td>
                                    <td style="text-align:center;"><?php echo $filterTax['buy_date']; ?></td>
                                    <td style="text-align:center;"><?php echo $filterTax['site_name']; ?></td>
                                    <td style="text-align:center;"><?php echo $filterTax['receipt_no']; ?></td>
                                    <td><?php echo $filterTax['sales_name']; ?></td>
                                    <td style="text-align:center;"><?php echo $filterTax['tax_no']; ?></td>
                                    <td style="text-align:center;"><?php echo $filterTax['sales_branch']; ?></td>
                                    <td style="text-align:right;"><?php echo number_format($filterTax['sum'], 2); ?></td>
                                    <td style="text-align:right;"><?php echo number_format($filterTax['vat'], 2); ?></td>
                                    <td style="text-align:center;">
                                        <input class="form-check-input check" checked type="checkbox" value="Y" data-price="<?php echo $filterTax['vat']; ?>" name="report[<?php echo $filterTax['receipt_no']; ?>]">
                                        <input type="hidden" name="receipt_no[]" value="<?php echo $filterTax['receipt_no']; ?>">
                                    </td>
                                </tr>
                                <?php } ?>
                            </tbody>
                        </table>
                    </div>
                </form>
            </div>
        </div>
    </section>

    <!-- ปรับ format datetime -->
    <script>
        function dateThaiFormat() {
            var input = document.getElementById("selectTime");
            var selectedDateTime = new Date(input.value);

            var options = { year: 'numeric', month: 'long' };
            var selectedDate = selectedDateTime.toLocaleDateString('th-TH', options);

            var pTag = document.getElementById("sendReportDate");
            pTag.textContent = selectedDate;
        }
    </script>

    <!-- สคริป รวมเงิน checkboxes -->
    <script>
        const checkboxes = document.querySelectorAll('.form-check-input.check');

        for (let i = 0; i < checkboxes.length; i++) {
            checkboxes[i].addEventListener('change', calculateSum);
        }

        function calculateSum() {
            let priceSum = 0;
            let vatSum = 0;

            for (let i = 0; i < checkboxes.length; i++) {
                if (checkboxes[i].checked) {
                const price = parseFloat(checkboxes[i].parentNode.parentNode.children[7].textContent.replace(/,/g, ''));
                const vat = parseFloat(checkboxes[i].getAttribute('data-price').replace(/,/g, ''));

                priceSum += price;
                vatSum += vat;
                }
            }

            document.getElementById('selectedPrice').textContent = priceSum.toLocaleString(undefined, { minimumFractionDigits: 2, maximumFractionDigits: 2 });
            document.getElementById('selectedVAT').textContent = vatSum.toLocaleString(undefined, { minimumFractionDigits: 2, maximumFractionDigits: 2 });
        }
    </script>

    <!-- สคริป ค้นหาข้อมูลในตาราง -->
    <script>
        var input = document.getElementById('searchData');
        var table = document.getElementById('searchTable');
        var rows = table.getElementsByTagName('tr');

        input.addEventListener('keyup', function() {
            var filter = input.value.toLowerCase();

            // Loop through all table rows
            for (var i = 1; i < rows.length; i++) { // Start at 1 to skip the header row
                var row = rows[i];
                var cells = row.getElementsByTagName('td');
                var rowText = '';

                // Concatenate the text content of all cells in the row
                for (var j = 0; j < cells.length; j++) {
                    rowText += cells[j].textContent.toLowerCase() + ' ';
                }

                // Check if the row text contains the filter text
                if (rowText.indexOf(filter) > -1) {
                    row.style.display = ''; // Show the row
                } else {
                    row.style.display = 'none'; // Hide the row
                }
            }
        });
    </script>



</body>
</html>

