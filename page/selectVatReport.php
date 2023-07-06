<?php
    session_start();
    require_once "../include/header.php";
    require_once "../include/dependency.php";
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
                    <h5 class="fw-bold p-2 text-center">กรุณาเลือกเดือนภาษีซื้อ</h5>
                </div>

                <form action="../db/db_filterTaxSummary.php" method="POST">
                    <div class="row mt-3">
                        <div class="col-md-8">
                            <label for="selectMonth" class="form-label fw-bold">เลือกเดือนภาษี :</label>
                            <select name="selectMonth" class="form-select" id="selectMonth">
                            <option value="">กรุณาเลือกเดือน</option>
                            <?php

                                $stmt = $conn->query("SELECT DISTINCT report_month FROM bill_head WHERE report = 'Y'");
                                $stmt->execute();
                                $monthSelect = $stmt->fetchAll();

                                foreach ($monthSelect as $month) {
                                    echo '<option value="'. $month['report_month'] .'">'. $month['report_month'] .'</option>';
                                }
                            ?>
                            </select>
                        </div>
                        <!-- <div class="col-md-3">
                            <label for="selectedPrice" class="form-label fw-bold text-primary">รวมยอดซื้อ :</label>
                            <input type="number" class="form-control text-primary" name="selectedPrice" id="selectedPrice" value="<?php //echo $query_sumBuy['sumbuy']; ?>" required readonly min="0" step="any">
                        </div>
                        <div class="col-md-3">
                            <label for="selectedVAT" class="form-label fw-bold text-primary">รวมยอด VAT :</label>
                            <input type="number" class="form-control text-primary" name="selectedVAT" id="selectedVAT" required readonly value="<?php //echo $query_sumVAT['sumvat']; ?>" min="0" step="any">
                        </div> -->
                        <div class="col-md-4" style="margin-top: 32px;">
                            <button type="submit" class="btn btn-success w-100" name="exportReport"><i class="fa-solid fa-print"></i> &nbsp;ออกรายงาน</button>
                        </div>
                    </div>
                    <!-- <hr> -->

                <!-- <table class="table table-sm table-hover mt-2 css-serial">
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
                        </tr>
                    </thead>
                    <tbody>

                        <?php

                            // $stmt = $conn->query("SELECT * FROM bill_head WHERE report_month != '' AND report = 'Y'");
                            // $stmt->execute();
                            // $tax = $stmt->fetchAll();
                            // foreach ($tax as $filterTax) {
                        ?>

                        <tr>
                            
                            <td style="text-align:center;"></td>
                            <td style="text-align:center;"><?php //echo $filterTax['buy_date']; ?></td>
                            <td style="text-align:center;"><?php //echo $filterTax['receipt_no']; ?></td>
                            <td><?php //echo $filterTax['sales_name']; ?></td>
                            <td style="text-align:center;"><?php //echo $filterTax['tax_no']; ?></td>
                            <td style="text-align:center;"><?php //echo $filterTax['sales_branch']; ?></td>
                            <td style="text-align:right;"><?php //echo $filterTax['sum']; ?></td>
                            <td style="text-align:right;"><?php //echo $filterTax['vat']; ?></td>
                        </tr>
                        <?php //} ?>
                    </tbody>
                </table> -->
                </form>

            </div>
        </div>
    </section>

    <script>
        var select_box_element_site = document.querySelector('#selectMonth');

        dselect(select_box_element_site, {
            search: true
        });
    </script>



</body>
</html>

