<?php
session_start();
    require_once "../include/header.php";


?>
<head>

</head>
<body>

<div class="container-fluid" style="width: 100%; overflow: auto;">
    <div class="text-center">
        <h5 class="fw-bold p-5">รายงานภาษีซื้อ</h5>
        <h6>เดือนภาษี..........กันยายน..........ปี..........2566..........</h6>
        <h6>ชื่อผุ้ประกอบการ...........................บริษัท สิทธิชัยเอนจิเนียริ่ง จำกัด...........................</h6>
    </div>

    <div class="text-end">
        <h6>เลขประจำตัวผู้เสียภาษีอากร</h6>
    </div>

    <div>
        <div class="d-flex float-end">
            <h5 class="border border-dark p-1">0</h5>
            <h5 class="border border-dark p-1">1</h5>
            <h5 class="border border-dark p-1">0</h5>
            <h5 class="border border-dark p-1">5</h5>
            <h5 class="border border-dark p-1">5</h5>
            <h5 class="border border-dark p-1">1</h5>
            <h5 class="border border-dark p-1">6</h5>
            <h5 class="border border-dark p-1">0</h5>
            <h5 class="border border-dark p-1">0</h5>
            <h5 class="border border-dark p-1">8</h5>
            <h5 class="border border-dark p-1">5</h5>
            <h5 class="border border-dark p-1">8</h5>
            <h5 class="border border-dark p-1">1</h5>
        </div>
    </div>


    <div style="clear: both;">
        <h6 class="float-start">ชื่อสถานประกอบการ................<b>บริษัท สิทธิชัยเอนจิเนียริ่ง จำกัด</b>.......................</h6>
        <div class="d-flex float-end">
            <h6 class="text-end">สาขาที่ &emsp;</h6>
            <h5 class="border border-dark p-1">0</h5>
            <h5 class="border border-dark p-1">0</h5>
            <h5 class="border border-dark p-1">0</h5>
            <h5 class="border border-dark p-1">0</h5>
        </div>
    </div>
    

    <table class="table table-bordered border-dark table-sm">
        <thead class="text-center" style="background-color: rgb(230, 230, 230);">
            <tr>
                <th valign="middle" rowspan="2" style="width: 63px;">ลำดับ</th>
                <th valign="middle" colspan="2">ใบกำกับภาษี</th>
                <th valign="middle" rowspan="2">ชื่อผู้ขายสินค้า / ผู้ให้บริการ</th>
                <th valign="middle" rowspan="2">เลขประจำตัวผู้เสียภาษี</th>
                <th valign="middle" colspan="2">สถานประกอบการ</th>
                <th valign="middle" rowspan="2">มูลค่าสินค้าหรือบริการ</th>
                <th valign="middle" rowspan="2">จำนวนเงินภาษีมูลค่าเพิ่ม</th>
            </tr>
            <tr>
                <!-- Subheader -->
                <th>วัน เดือน ปี</th>
                <th>เล่มที่/เลขที่</th>
                <th style="width: 97px;">สำนักงานใหญ่</th>
                <th style="width: 54px;">สาขาที่</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td class="text-center">002 09</td>
                <td class="text-center">23/03/2023</td>
                <td class="text-center">IV93728</td>
                <td>บริษัทแสงชัยไลท์ติ้ง สำนักงานใหญ่</td>
                <td>0105560072540</td>
                <td class="text-center">&#10003;</td>
                <td class="text-center"></td>
                <td class="text-end commas">4740.00</td>
                <td class="text-end">331.80</td>
            </tr>
        </tbody>
    </table>



    <script>
        function formatNumberWithCommas(number) {
            return number.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
        }
        
        document.querySelectorAll('.commas').forEach(function(element) {
            element.textContent = formatNumberWithCommas(element.textContent);
        });
    </script>


</div>

    
</body>
</html>