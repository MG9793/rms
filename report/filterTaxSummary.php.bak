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

</head>
<body>


    <section class="container my-3">
        <div class="card px-4">
            <div class="card-body">                          
                <div class="headReport">
                    <h5 class="fw-bold p-2 text-center">กรุณาเลือกข้อมูล | รายงานภาษีซื้อ <?php echo $_SESSION['thisMonth']; ?></h5>
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
                ?>

                <form action="../db/db_filterTaxSummary.php" method="POST">
                    <div class="row mt-3">
                        <div class="col-md-3">
                            <label for="selectTime" class="form-label fw-bold">เดือน/ปี สำหรับออกรายงานภาษีซื้อ :</label>
                            <input type="month" class="form-control" name="selectTime" id="selectTime" required>
                        </div>
                        <div class="col-md-3">
                            <label for="selectedPrice" class="form-label fw-bold text-primary">รวมยอดซื้อ :</label>
                            <input type="number" class="form-control text-primary" name="selectedPrice" id="selectedPrice" required readonly min="0" value="0" step="any">
                        </div>
                        <div class="col-md-3">
                            <label for="selectedVAT" class="form-label fw-bold text-primary">รวมยอด VAT :</label>
                            <input type="number" class="form-control text-primary" name="selectedVAT" id="selectedVAT" required readonly min="0" value="0" step="any">
                        </div>
                        <div class="col-md-3" style="margin-top: 32px;">
                            <button type="submit" class="btn btn-primary w-100" name="sendReport"><i class="fa-solid fa-sheet-plastic"></i> &nbsp;ออกรายงานภาษีซื้อ</button>
                        </div>
                    </div>
                
                <hr>


                <table class="table table-sm table-hover mt-2 css-serial">
                    <thead>
                        <tr>
                            <th scope="col" class="fw-bold" style="text-align:center;">#</th>
                            <th scope="col" class="fw-bold" style="text-align:center;">วันที่ซื้อ</th>
                            <th scope="col" class="fw-bold" style="text-align:center;">เลขที่ใบเสร็จ</th>
                            <th scope="col" class="fw-bold">รายการซื้อสินค้า</th>
                            <th scope="col" class="fw-bold" style="text-align:center;">เลขประจำตัวผู้เสียภาษี</th>
                            <th scope="col" class="fw-bold" style="text-align:center;">สาขา</th>
                            <th scope="col" class="fw-bold" style="text-align:right;">มูลค่าสินค้าหรือบริการ</th>
                            <th scope="col" class="fw-bold" style="text-align:right;">จำนวนเงินภาษีมูลค่าเพิ่ม</th>
                            <th scope="col" class="fw-bold" style="text-align:center;">ออกใบกำกับภาษี</th>
                        </tr>
                    </thead>
                    <tbody>

                        <?php

                            $thisMonth = $_SESSION['thisMonth'];
                            $stmt = $conn->query("SELECT * FROM bill_head WHERE DATE_FORMAT(buy_date, '%Y-%m') = '$thisMonth' AND report = 'N'");

                            $stmt->execute();
                            $tax = $stmt->fetchAll();

                            foreach ($tax as $filterTax) {
                        ?>

                        <tr>
                            
                            <td style="text-align:center;"></td>
                            <td style="text-align:center;"><?php echo $filterTax['buy_date']; ?></td>
                            <td style="text-align:center;"><?php echo $filterTax['receipt_no']; ?></td>
                            <td><?php echo $filterTax['sales_name']; ?></td>
                            <td style="text-align:center;"><?php echo $filterTax['tax_no']; ?></td>
                            <td style="text-align:center;"><?php echo $filterTax['sales_branch']; ?></td>
                            <td style="text-align:right;"><?php echo $filterTax['sum']; ?></td>
                            <td style="text-align:right;"><?php echo $filterTax['vat']; ?></td>
                            <td style="text-align:center;">
                                <input class="form-check-input check" type="checkbox" value="Y" data-price="<?php echo $filterTax['vat']; ?>" id="selectReport<?php echo $filterTax['receipt_no']; ?>" name="report[<?php echo $filterTax['receipt_no']; ?>]">
                                <input type="hidden" name="receipt_no[]" value="<?php echo $filterTax['receipt_no']; ?>">
                            </td>
                        </tr>
                        <?php } ?>
                    </tbody>
                </table>
                </form>

            </div>
        </div>
    </section>

    
    <!-- สคริป ค้นหาสถานประกอบการ -->
    <script>
        // var select_box_element_site = document.querySelector('#selectCompany');
        // dselect(select_box_element_site, {
        //     search: true
        // });
    </script>


    <!-- สคริป รวมเงิน checkboxes -->
    <script>
        const checkboxes = document.getElementsByClassName('check');

        for (let i = 0; i < checkboxes.length; i++) {
            checkboxes[i].addEventListener('change', calculateSum);
        }

        function calculateSum() {
            let priceSum = 0;
            let vatSum = 0;

            for (let i = 0; i < checkboxes.length; i++) {
                if (checkboxes[i].checked) {
                    const price = parseFloat(checkboxes[i].parentNode.parentNode.children[6].textContent);
                    const vat = parseFloat(checkboxes[i].getAttribute('data-price'));

                    priceSum += price;
                    vatSum += vat;
                }
            }

            document.getElementById('selectedPrice').value = priceSum.toFixed(2);
            document.getElementById('selectedVAT').value = vatSum.toFixed(2);
        }
    </script>



</body>
</html>

