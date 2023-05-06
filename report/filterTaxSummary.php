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
                    <h5 class="fw-bold p-2 text-center">กรุณาเลือกข้อมูล | รายงานภาษีซื้อ</h5>
                </div>

                <form action="../db/db_filterTaxSummary.php" method="POST">
                    <div class="row">
                        <div class="col-md-3">
                            <label for="selectTime" class="form-label fw-bold">กรุณาเลือก เดือน/ปี :</label>

                            <?php

                                if ($_SESSION['selectTime'] == "") {
                                    echo '<input type="month" class="form-control" name="selectTime" id="selectTime" required>';
                                } else {
                                    echo '<input type="month" class="form-control" name="selectTime" id="selectTime" value="'.$_SESSION['selectTime'].'" required>';
                                }

                            ?>
                            <!-- <input type="month" class="form-control" name="selectTime" id="selectTime" required> -->
                        </div>
                        <div class="col-md-7">
                            <label for="selectCompany" class="form-label fw-bold">เลือกสถานประกอบการ :</label>
                            <select class="form-select" name="selectCompany" id="selectCompany" required>
                                <option value="">ค้นหาสถานประกอบการ</option>
                                <?php

                                    $companyInfo = $conn->prepare("SELECT * FROM company_info");
                                    $companyInfo->execute();
                                    $company = $companyInfo->fetchAll();

                                    foreach($company as $searchCompany) {
                                        echo '<option value="'.$searchCompany["company_name"].'">'.$searchCompany["company_name"].'</option>';
                                    }
                                
                                ?>
                            </select>
                        </div>
                        <div class="col-md-2" style="margin-top: 32px;">
                            <button type="submit" class="btn btn-light w-100"><i class="fa-solid fa-magnifying-glass"></i> ค้นหา</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </section>



    <?php

        // if (isset($_POST['selectCompany'])) {
        //     $getCompany = $_POST['selectCompany'];
        //     $getTime = $_POST['selectTime'];

        //     $stmt = $conn->query("SELECT * FROM company_info WHERE company_name = '$getCompany'");
        //     $companyInfo = $stmt->fetch(PDO::FETCH_ASSOC);

            // $_SESSION['selectTime'] = $getTime;

    ?>

    <section class="container mb-3">
        <form action="../db/db_filterTaxSummary.php" method="POST">
        <div class="card px-4">
            <div class="card-body">
                <div class="text-center text-primary fw-bold"><?php echo $_SESSION['selectCompany']; ?> &emsp; เลขประจำตัวผู้เสียภาษี <?php echo $_SESSION['companyTax']; ?> &emsp; ช่วงเวลา(ปี-เดือน) <?php echo $_SESSION['selectTime']; ?></div>
                <button type="submit" class="btn btn-sm btn-primary w-100 my-3" name="sendToReport"><i class="fa-solid fa-sheet-plastic"></i> ออกรายงานภาษีซื้อ</button>
            
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

                            if ($_SESSION['selectCompany'] == null) {

                                $stmt = $conn->query("SELECT * FROM bill_head WHERE report = 'N'");

                            } else {

                                $getTime = $_SESSION['selectTime'];
                                $stmt = $conn->query("SELECT * FROM bill_head WHERE buy_date LIKE '$getTime%' AND report = 'N'");

                            }

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
                            <td></td>
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
        </form>
    </section>

    <?php //} ?>


    <?php

        // if (isset($_POST['selectCompany'])) {
        //     $getCompany = $_POST['selectCompany'];
        //     $getTime = $_POST['selectTime'];

        //     $stmt = $conn->query("SELECT * FROM company_info WHERE company_name = '$getCompany'");
        //     $companyInfo = $stmt->fetch(PDO::FETCH_ASSOC);

        //     $_SESSION['selectTime'] = $getTime;
        //     $_SESSION['selectCompany'] = $getCompany;
        //     $_SESSION['companyTax'] = $companyInfo['tax_no'];

        //     header("location: filterTaxSummary.php");

        // }

        // else if (isset($_POST['sendToReport'])) {

        //     $receipt_nos = $_POST['receipt_no'];
        //     $reports = $_POST['report'];        // ดึงมาจาก form checkbox
        
        //     foreach ($receipt_nos as $receipt_no) {
        //         if (isset($reports[$receipt_no]) && $reports[$receipt_no] === 'Y') {
        //             $stmt = $conn->prepare("UPDATE bill_head SET report = 'Y' WHERE receipt_no = :receipt_no");
        //             $stmt->execute(['receipt_no' => $receipt_no]);
        //         }
        //     }
        // }


    ?>




    
    <!-- สคริป ค้นหาสถานประกอบการ -->
    <script>
        var select_box_element_site = document.querySelector('#selectCompany');
        dselect(select_box_element_site, {
            search: true
        });
    </script>



</body>
</html>

