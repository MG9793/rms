<?php
session_start();
    require_once "../include/header.php";
?>
<head>

</head>
<body>

<div class="container">
    <div class="text-center">
        <h5 class="fw-bold p-5">สรุปรายงานภาษีซื้อ</h5>
        <h6>เดือนภาษี..........กันยายน..........ปี..........2566..........</h6>
    </div>

    <div class="text-end">
        <h6>เลขประจำตัวผู้เสียภาษีอากร</h6>
    </div>

    <div>
        <h6 class="float-start">ชื่อผู้ประกอบการ................<b>บริษัท สิทธิชัยเอนจิเนียริ่ง จำกัด</b>.......................</h6>
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
        <h6 class="float-start">ชื่อสถานประกอบการ..........<b>บริษัท สิทธิชัยเอนจิเนียริ่ง จำกัด</b>.......................</h6>
        <div class="d-flex float-end">
            <h6 class="text-end">สาขาที่ &emsp;</h6>
            <h5 class="border border-dark p-1">0</h5>
            <h5 class="border border-dark p-1">0</h5>
            <h5 class="border border-dark p-1">0</h5>
            <h5 class="border border-dark p-1">0</h5>
        </div>
    </div>
    

    <table class="table table-bordered border-dark table-sm css-serial">
        <thead class="text-center" style="background-color: rgb(230, 230, 230);">
            <tr>
                <th>ลำดับที่</th>
                <th>หน่วยงาน</th>
                <th>มูลค่าสินค้าหรือบริการ</th>
                <th>จำนวนเงินภาษีมูลค่าเพิ่ม</th>
                <th>TOTAL</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td class="text-center"></td>
                <td>ทั่วไป</td>
                <td class="text-end commas">698518.54</td>
                <td class="text-end commas">48896.30</td>
                <td class="text-end commas">747414.84</td>
            </tr>
            <tr>
                <td class="text-center"></td>
                <td>ทหารชลบุรี</td>
                <td class="text-end commas">620720.73</td>
                <td class="text-end commas">43450.45</td>
                <td class="text-end commas">664171.18</td>
            </tr>
            <tr>
                <td class="text-center"></td>
                <td>ทหารสระบุรี</td>
                <td class="text-end commas">2691048.12</td>
                <td class="text-end commas">188373.37</td>
                <td class="text-end commas">2879421.49</td>
            </tr>
            <tr>
                <td colspan="2" class="text-center bg-secondary">รวม</td>
                <td class="text-end commas">2691048.12</td>
                <td class="text-end commas">188373.37</td>
                <td class="text-end commas">2879421.49</td>
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