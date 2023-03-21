<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>สรุปรายงานภาษีซื้อ</title>

    <!-- Bootstrap5.3.0 -->
    <link rel="stylesheet" href="../resources/lib/bootstrap5.3.0/css/bootstrap.min.css">
    <script src="../resources/lib/bootstrap5.3.0/js/bootstrap.bundle.min.js"></script>

    <style>
        body {
            font-family: 'Cordia New';
        }

        .container {
            margin-top: 1rem;
        }

        .css-serial {
            counter-reset: serial-number;
            border-radius: .4em;
            overflow: hidden;
        }

        .css-serial td:first-child:before {
            counter-increment: serial-number;
            content: counter(serial-number);
        }
    </style>
</head>
<body>

<div class="container">
    <div class="text-center">
        <h1 class="fw-bold">สรุปรายงานภาษีซื้อ</h1>
        <h3>เดือนภาษี..........กันยายน..........ปี..........2566..........</h3>
    </div>

    <div class="text-end">
        <h5>เลขประจำตัวผู้เสียภาษีอากร</h5>
    </div>

    <div>
        <h5 class="float-start">ชื่อผู้ประกอบการ................<b>บริษัท สิทธิชัยเอนจิเนียริ่ง จำกัด</b>.......................</h5>
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
        <h5 class="float-start">ชื่อสถานประกอบการ..........<b>บริษัท สิทธิชัยเอนจิเนียริ่ง จำกัด</b>.......................</h5>
        <div class="d-flex float-end">
            <h5 class="text-end">สาขาที่ &emsp;</h5>
            <h5 class="border border-dark p-1">0</h5>
            <h5 class="border border-dark p-1">0</h5>
            <h5 class="border border-dark p-1">0</h5>
            <h5 class="border border-dark p-1">0</h5>
        </div>
    </div>
    

    <table class="table table-bordered border-dark table-sm css-serial">
        <thead class="text-center">
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