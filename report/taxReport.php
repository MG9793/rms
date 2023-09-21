<?php
    session_start();
    require_once "../include/header.php";
?>

<head>
    <style>
        div.headReport {
            text-align: left;
            background-color: #D3D3D3;
            border-radius: 5px;
        }

        iframe {
            height :700px;
            width :100%;
            display:block;
        }

        menu {
            display:block;
            margin-bottom: -4;
            width: auto; 
            height: 16px;
        }

        a:link {
            color: green;
            background-color: transparent;
            text-decoration: none;
        }

        a:visited {
            color: black;
            background-color: transparent;
            text-decoration: none;
        }

        a:hover {
            color: white;
            background-color: transparent;
        }

        a:active {
            color: yellow;
            background-color: transparent;
        }

        h4 {
            font-weight: bold;
        }
    </style>
    
    <!-- Custom CSS ค้นหา -->
    <script src="../resources/lib/dselect.js"></script>

    <!-- Export Excel -->
    <script src="https://unpkg.com/xlsx/dist/xlsx.full.min.js"></script>
    <script src="https://unpkg.com/file-saver@1.3.3/FileSaver.js"></script>

</head>
<body>
<section class="container my-2">
    <div class="card">       
        <div div class="card-body">
            <div class="headReport">
                  <h5 class="fw-bold p-2">TAX003 | รายงานภาษีซื้อ</h5>
            </div>

            <div class="text-center">

                <form action="" method="POST">
                    <div class="row">
                        <div class="col-md-8 mb-2">
                            <select name="selectMonth" class="form-select" id="selectMonth">
                            <?php
                            
                            $stmt = $conn->query("SELECT DISTINCT report_month ,report_month2 FROM bill_head WHERE report = 'Y' ORDER BY report_month2 DESC");
                            $stmt->execute();
                            $monthSelect = $stmt->fetchAll();
                            
                  
                                echo '<option value="">เลือกเดือน</option>';
                                foreach ($monthSelect as $month) {
                                    echo '<option value="'. $month['report_month2'].'">'. $month['report_month'] .'</option>';
                                    }

                                
                            ?> 
                            </select>
                        </div>
                        <div class="col-md-4">
                            <button type="submit" class="btn btn-success w-100" name="showReport"><i class="fa-solid fa-eye"></i> &nbsp;View Report</button>
                        </div>
                    </div>
                </form>
            </div>
            
                        <?php 
                        if(empty($_POST['selectMonth'])){
                        }else{
                      //  $_SESSION['monthTax']=substr($_POST['selectMonth'],0,-4);
                        $_SESSION['yearTax']=substr($_POST['selectMonth'],0,-2);
                        $monthTax=substr($_POST['selectMonth'],-2);
                        if($monthTax=='01'){
                            $_SESSION['monthTax'] = 'มกราคม';
                        }else if($monthTax=='02'){
                            $_SESSION['monthTax'] = 'กุมภาพันธ์';
                        }else if($monthTax=='03'){
                            $_SESSION['monthTax'] = 'มีนาคม';
                        }else if($monthTax=='04'){
                            $_SESSION['monthTax'] = 'เมษายน';
                        }else if($monthTax=='05'){
                            $_SESSION['monthTax'] = 'พฤษภาคม';
                        }else if($monthTax=='06'){
                            $_SESSION['monthTax'] = 'มิถุนายน';
                        }else if($monthTax=='07'){
                            $_SESSION['monthTax'] = 'กรกฎาคม';
                        }else if($monthTax=='08'){
                            $_SESSION['monthTax'] = 'สิงหาคม';
                        }else if($monthTax=='09'){
                            $_SESSION['monthTax'] = 'กันยายน';
                        }else if($monthTax=='10'){
                            $_SESSION['monthTax'] = 'ตุลาคม';
                        }else if($monthTax=='11'){
                            $_SESSION['monthTax'] = 'พฤศจิกายน';
                        }else if($monthTax=='12'){
                            $_SESSION['monthTax'] = 'ธันวาคม';
                        }
                
                        $_SESSION['searchTax'] = substr($_POST['selectMonth'],-6);
              

                    
                        ?>
                        
                        


            <table style="background: #FFA500;" width="100%" height="35">
                <tbody>
                    <tr>
                        <td style="text-align: center;">
                              <button type="button" class="btn btn-sm btn-outline-dark" onclick='javascript:ExcelReport();' style="border: #FFA500;"><img src="../image/icon/excel.png" width="auto" height="16">Export to Excel</button>
                        </td>
                    </tr>
                </tbody>
            </table>
            <iframe src="../report/taxDetail.php" ></iframe>



            <!-- ตารางซ่อน เอาไว้ออก excel โดยดึงข้อมูลจากตารางนี้ -->
            <table id="myTable" hidden>
                <thead>
                    <tr>
                        <th rowspan="2" width="8%">ลำดับที่</th>
                        <th colspan="2">ใบกำกับภาษี</th>
                        <th rowspan="2" width="25%">ชื่อผู้ขายสินค้า/ผู้ให้บริการ</th>
                        <th rowspan="2" width="20%">เลขประจำตัวผู้เสียภาษี</th>
                        <th colspan="2">สถานประกอบการ</th>
                        <th rowspan="2" width="20%">มูลค่าสินค้าหรือบริการ</th>
                        <th rowspan="2" width="20%">จำนวนเงินภาษีมูลค่าเพิ่ม</th>
                    </tr>

                    <tr>
                        <th width="11%">วัน เดือน ปี</th>
                        <th width="11%">เล่มที่/เลขที่</th>
                        <th width="12%">สำนักงานใหญ่</th>
                        <th width="11%">สาขาที่</th>
                    </tr>
                </thead>
                <tbody>
            
                <?php
                    $reportMonth = $_SESSION['searchTax'];

                    $sql = $conn->query("SELECT * FROM bill_head where report_month = '$reportMonth'");
                    $result = $sql->fetchAll();
                    
                    $i=1;
                    $sumTotal = 0;
                    $sumVat = 0;
                    foreach ($result as $row) {
                        if($row['sales_branch']=='สำนักงานใหญ่'){
                            $salesBranch = "";
                            $pic = 'Yes';
                        } else {
                            $salesBranch = $row['sales_branch'];
                            $pic = '';
                        } ?>
        
                    <tr>
                        <td><?php echo $i; ?></td>
                        <td><?php echo $row['buy_date']; ?></td>
                        <td><?php echo $row['receipt_no']; ?></td>
                        <td><?php echo $row['sales_name']; ?></td>
                        <td><?php echo $row['tax_no']; ?></td>

                        <td><?php echo $pic; ?></td>
                        <td><?php echo $salesBranch; ?></td>
                        <td><?php echo number_format($row['sum'], 2); ?></td>
                        <td><?php echo number_format($row['vat'], 2); ?></td>
                    </tr>

                    <?php
                        $sumTotal = $row['sum'] + $sumTotal;
                        $sumVat = $row['vat'] + $sumVat;
                        $i++;
                    ?>
                
                    <?php } ?>
        
                    <tr>
                        <td colspan="7">รวม</td>
                        <td width="5%"><?php echo number_format($sumTotal, 2); ?></td>
                        <td width="5%"><?php echo number_format($sumVat, 2); ?></td>
                    </tr>
                </tbody>
            </table>






        </div>
    </div>
</section>

<?php } ?>

    <script>
        var select_box_element_site = document.querySelector('#selectMonth');

        dselect(select_box_element_site, {
            search: true
        });
    </script>

    <script>
        function ExcelReport() {
            var tax_report = "<?php echo 'TaxReport ' . $yearTax . '-' . $monthTax; ?>";
            var sheet_name = tax_report;
            var elt = document.getElementById('myTable');

            /*------สร้างไฟล์ excel------*/
            var wb = XLSX.utils.table_to_book(elt, {sheet: sheet_name});
            XLSX.writeFile(wb, tax_report + '.xlsx');
        }
    </script>

</body>
</html>