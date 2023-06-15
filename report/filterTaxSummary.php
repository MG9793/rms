<?php
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
                            $stmt = $conn->query("SELECT * FROM bill_head WHERE DATE_FORMAT(buy_date, '%Y-%m') = '$thisMonth'");

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
                                <input class="form-check-input" type="checkbox" value="Y" id="selectReport<?php echo $filterTax['receipt_no']; ?>" name="report[<?php echo $filterTax['receipt_no']; ?>]">
                                <input type="hidden" name="receipt_no[]" value="<?php echo $filterTax['receipt_no']; ?>">
                            </td>
                        </tr>
                        <?php } ?>
                    </tbody>
                </table>


            </div>
        </div>
    </section>

    
    <!-- สคริป ค้นหาสถานประกอบการ -->
    <script>
        var select_box_element_site = document.querySelector('#selectCompany');
        dselect(select_box_element_site, {
            search: true
        });
    </script>



</body>
</html>

