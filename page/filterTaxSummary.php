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
                if(checkbox.checked = source.checked){
                    var query_sumBuy = parseFloat(document.getElementById('hiddenPrice').textContent)
                    var query_sumVAT = parseFloat(document.getElementById('hiddenVAT').textContent)
                    var query_reportSumPrice = document.getElementById('hiddenReportedPrice').textContent
                    var query_reportSumVAT = document.getElementById('hiddenReportedVAT').textContent
                    var sumreportPrice = parseFloat(query_reportSumPrice)+parseFloat(query_sumBuy)
                    var sumreportVAT = parseFloat(query_reportSumVAT)+parseFloat(query_sumVAT)

                    document.getElementById('selectedPrice').textContent = query_sumBuy.toLocaleString(undefined, { minimumFractionDigits: 2, maximumFractionDigits: 2 });
                    document.getElementById('selectedVAT').textContent = query_sumVAT.toLocaleString(undefined, { minimumFractionDigits: 2, maximumFractionDigits: 2 });
                    document.getElementById('reportedPrice').textContent = sumreportPrice.toLocaleString(undefined, { minimumFractionDigits: 2, maximumFractionDigits: 2 });
                    document.getElementById('reportedVAT').textContent = sumreportVAT.toLocaleString(undefined, { minimumFractionDigits: 2, maximumFractionDigits: 2 });
                 
        
                }else{
                    var query_reportSumPrice2 = parseFloat(document.getElementById('hiddenReportedPrice').textContent)
                    var query_reportSumVAT2 = parseFloat(document.getElementById('hiddenReportedVAT').textContent)
                    document.getElementById('selectedPrice').textContent = '0.00';
                    document.getElementById('selectedVAT').textContent = '0.00';
                    document.getElementById('reportedPrice').textContent = query_reportSumPrice2.toLocaleString(undefined, { minimumFractionDigits: 2, maximumFractionDigits: 2 });
                    document.getElementById('reportedVAT').textContent = query_reportSumVAT2.toLocaleString(undefined, { minimumFractionDigits: 2, maximumFractionDigits: 2 });
               
                    }
            });
        }
  </script>

<?php
 $month = $conn->prepare("SELECT * FROM month_info");
 $month->execute();
 $rs_month = $month->fetchAll();
 ?>

</head>
<body>
<center>
                        <section class="mb-2 " style="width:70% ">
                            <fieldset class="p-3 shadow-sm mt-3"> 

    
                            
            <legend class="fw-bold text-dark text-center  p-1"> เลือกข้อมูล | รายงานภาษีซื้อ </legend>
            
                <?php
                    // Alert ไม่ได้เลือกรายการออกใบกำกับภาษี
                    if(isset($_SESSION['reportFailure'])) {
                        echo "<div class='alert alert-danger alert-dismissible fade show mt-2' role='alert'>";
                        echo "<button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>";
                        echo $_SESSION['reportFailure'];
                        unset($_SESSION['reportFailure']);
                        echo "</div>";
                    }

                    $thisMonth_last = $conn->query("SELECT MAX(report_month2) as Month_last FROM bill_head WHERE report = 'Y' AND vat <> 0 LIMIT 1");
                    $thisMonth_last->execute();
                    $Month_last = $thisMonth_last->fetch(PDO::FETCH_ASSOC);
                    if($Month_last['Month_last']==""){
                        $MonthLast = 0;
                    }else{
                    $MonthLast= $Month_last['Month_last'];
                }

                    // query ตาราง
                    $thisMonth = $_SESSION['thisMonth']; 
                    $stmt = $conn->query("SELECT * FROM bill_head WHERE buy_date like '%$thisMonth' AND vat <> 0 AND report = 'N' ORDER BY buy_date ASC");
                    $tax = $stmt->fetchAll();

                    // query รวมยอดซื้อ
                    $sumBuy = $conn->query("SELECT SUM(sum) AS sumbuy FROM bill_head WHERE buy_date like '%$thisMonth' AND vat <> 0 AND report = 'N'");
                    $query_sumBuy = $sumBuy->fetch(PDO::FETCH_ASSOC);

                    // query รวมยอด VAT
                    $sumVAT = $conn->query("SELECT SUM(vat) AS sumvat FROM bill_head WHERE buy_date like '%$thisMonth' AND vat <> 0 AND report = 'N'");
                    $query_sumVAT = $sumVAT->fetch(PDO::FETCH_ASSOC);

                    // query รวมยอดซื้อที่ออกรายงานแล้ว
                    $sumBuy_reported = $conn->query("SELECT SUM(sum) AS sumbuy_reported FROM bill_head WHERE report_month2 = '$MonthLast' AND vat <> 0 AND report = 'Y'");
                    $query_sumBuy_reported = $sumBuy_reported->fetch(PDO::FETCH_ASSOC);

                    // query ยอด VAT ที่ออกรายงานแล้ว
                    $sumVAT_reported = $conn->query("SELECT SUM(vat) AS sumvat_reported FROM bill_head WHERE report_month2 = '$MonthLast' AND vat <> 0 AND report = 'Y'");
                    $query_sumVAT_reported = $sumVAT_reported->fetch(PDO::FETCH_ASSOC);

                    $curYear1 = date("Y")+543;
                    $curYear2 = date("Y")+543-1;
                    $curYear3 = date("Y")+543-2;
                ?>
                 <form action="../db/db_filterTaxSummary.php" method="POST"> 
                <!-- <form action="" method="POST">-->
                <div class="row mb-2">
                    
                   
                <div class="col-md-2 p-3 "> </div>
                    <div class="col-md-1 p-3 "> 
                       </div>
                    
                    <div class="col-md-2 p-3 ">
                    <select name="selectMonth" class="form-select" id="selectMonth" required>
                    
                        <?php
                    if($_SESSION["selectMonth"]==""){
                        ?>
                        <option value="">กรุณาเลือกเดือน</option>
                        <?php
                        foreach($rs_month as $row_month)
                        {
                            echo '<option value="'.$row_month["value"].$row_month["month_name"].'">'.$row_month["month_name"].'</option>';
                        }
                   
                    }else{
                        echo '<option value="' .$_SESSION["selectMonthOld"]. '">' .$_SESSION["selectMonthFull"]. '</option>'; 
                        foreach($rs_month as $row_month)
                        {
                            echo '<option value="'.$row_month["value"].$row_month["month_name"].'">'.$row_month["month_name"].'</option>';
                        }
                    }
                    
                            ?>
                </select>
                </div>
                <div class="col-md-2 p-3 ">
                    <select name="selectYear" class="form-select" id="selectYear" required>
                       
                    <?php    
                    if($_SESSION["selectYear"]==""){
                        echo '<option value="">กรุณาเลือกปี</option>'; 
                        echo '<option value="' .$curYear1. '">' .$curYear1. '</option>'; 
                        echo '<option value="' .$curYear2. '">' .$curYear2. '</option>'; 
                        echo '<option value="' .$curYear3. '">' .$curYear3. '</option>'; 
                    }  else{
                        echo '<option value="' .$_SESSION["selectYear"]. '">' .$_SESSION["selectYear"]. '</option>'; 
                        echo '<option value="' .$curYear1. '">' .$curYear1. '</option>'; 
                        echo '<option value="' .$curYear2. '">' .$curYear2. '</option>'; 
                        echo '<option value="' .$curYear3. '">' .$curYear3. '</option>'; 
                    }

                    
                        ?>
                </select>

                    </div>
                    
                            <div class="col-md-2 p-3 ">
                            
                            <button type="submit" class="btn btn-success w-100" name="sendReport"></i> &nbsp;บันทึก</button>
                            </div>
                           
                </div>
                    <div class="row mb-2">
                    <div class="col-md-2 p-3 "></div>
                    <div class="col-md-2 p-3">
                    <div class="card">
                        <div class="fw-bold text-center border p-2 text-light rounded bg-warning">ยอดซื้อ(ที่เลือก) :</div>
                            <div class="card-body">
                                <div class="d-flex flex-row justify-content-between">
                                <h5 class="text-black fw-bold" id="selectedPrice"><?php echo number_format($query_sumBuy['sumbuy'], 2); ?></h5>
                                     <h4 class="text-black fw-bold" hidden id="hiddenPrice"><?php echo $query_sumBuy['sumbuy']; ?></h4>
                                </div>
                        </div>
                        
                    </div>
                </div>

                <div class="col-md-2 p-3 ">
                    <div class="card">
                        <div class="fw-bold text-center border p-2 text-light rounded bg-warning">ยอดรวม VAT(ที่เลือก) :</div>
                            <div class="card-body">
                                <div class="d-flex flex-row justify-content-between">
                                <h5 class="text-black fw-bold" id="selectedVAT"><?php echo number_format($query_sumVAT['sumvat'], 2); ?></h5>
                            <h4 class="text-black fw-bold" hidden id="hiddenVAT"><?php echo $query_sumVAT['sumvat']; ?></h4>
                                </div>
                        </div>
                        
                    </div>

                    
                </div>

                <div class="col-md-2 p-3">
                    <div class="card">
                        <div class="fw-bold text-center border p-2 text-light rounded bg-primary">ยอดรวมภาษีซื้อ(สะสม) :</div>
                            <div class="card-body">
                                <div class="d-flex flex-row justify-content-between">
                                <h5 class="text-black fw-bold" id="reportedPrice"><?php echo number_format($query_sumBuy_reported['sumbuy_reported']+$query_sumBuy['sumbuy'], 2); ?></h5>
                                <h4 class="text-black fw-bold" hidden id="hiddenReportedPrice"><?php 
                                if($Month_last['Month_last']==""){
                                    echo '0.00';
                                }else{
                                echo $query_sumBuy_reported['sumbuy_reported']; }?></h4>
                                </div>
                        </div>
                        
                    </div>

                    
                </div>

                <div class="col-md-2 p-3">
                    <div class="card">
                        <div class="fw-bold text-center border p-2 text-light rounded bg-primary">ยอดรวม VAT(สะสม) :</div>
                            <div class="card-body">
                                <div class="d-flex flex-row justify-content-between">
                                <h5 class="text-black fw-bold" id="reportedVAT"><?php echo number_format($query_sumVAT_reported['sumvat_reported']+$query_sumVAT['sumvat'], 2); ?></h5>
                                <h4 class="text-black fw-bold" hidden id="hiddenReportedVAT"><?php 
                                if($Month_last['Month_last']==""){
                                    echo '0.00';
                                }else{
                                echo $query_sumVAT_reported['sumvat_reported']; }?></h4>
                                
                                </div>
                        </div>
                        
                    </div>

                    
                </div>
                </div>
                </fieldset>
                </section>
                <section class="mb-2 " style="width:70% ">
                            <fieldset class="p-3 shadow-sm mt-3"> 

                    <div class="row px-4 my-2">
                    
                        <div class="col-md-4">
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
                                    <th scope="col" class="fw-bold" style="text-align:center;">ออกใบกำกับภาษี<br>
                                    <input class="form-check-input" type="checkbox" id="select-all" onchange="toggleAll(this)" checked>
                                    <label class="form-check-label" for="select-all">ทั้งหมด</label></th>
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
            var query_reportPriceSum = parseFloat(document.getElementById('hiddenReportedPrice').textContent)
            var query_reportVATSum = parseFloat(document.getElementById('hiddenReportedVAT').textContent)

            for (let i = 0; i < checkboxes.length; i++) {
                if (checkboxes[i].checked) {
                const price = parseFloat(checkboxes[i].parentNode.parentNode.children[7].textContent.replace(/,/g, ''));
                const vat = parseFloat(checkboxes[i].getAttribute('data-price').replace(/,/g, ''));

                priceSum += price;
                vatSum += vat;
                query_reportPriceTotal = priceSum +query_reportPriceSum;
                query_reportVATTotal = vatSum +query_reportVATSum;
                }
            }
               
            document.getElementById('selectedPrice').textContent = priceSum.toLocaleString(undefined, { minimumFractionDigits: 2, maximumFractionDigits: 2 });
            document.getElementById('selectedVAT').textContent = vatSum.toLocaleString(undefined, { minimumFractionDigits: 2, maximumFractionDigits: 2 });
            document.getElementById('reportedPrice').textContent = query_reportPriceTotal.toLocaleString(undefined, { minimumFractionDigits: 2, maximumFractionDigits: 2 });
            document.getElementById('reportedVAT').textContent = query_reportVATTotal.toLocaleString(undefined, { minimumFractionDigits: 2, maximumFractionDigits: 2 });
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

