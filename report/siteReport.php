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
            font-family: Arial, Helvetica, sans-serif;
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

        thead tr th {
            font-weight: bold;
        }

        @page {
            size: landscape;
        }
    </style>
</head>
<body>

<div class="container">
    <div class="text-center">
        <h5 class="fw-bold p-2 shadow" style="background-color: rgb(230, 230, 230);">สรุปโครงการก่อสร้าง : บริษัท สิทธิชัยเอนจิเนียริ่ง จำกัด</h5>
        <h6 class="fst-italic">สรุปงบประมาณปี 2564 เดือน มกราคม - ธันวาคม 2564</h6>
    </div>


    <table class="table table-bordered border-dark table-sm css-serial">
        <thead class="text-center" style="background-color: rgb(230, 230, 230);">
            <tr>
                <th valign="middle" rowspan="2">ลำดับ</th>
                <th valign="middle" rowspan="2">รายการ</th>

                <!-- site งาน -->
                <th colspan="2">MT3-2</th>
                <th colspan="2">MTุ-1</th>
                <th colspan="2">รวมทั้งสิ้น</th>
            </tr>
            <tr>
                <!-- Subheader -->
                <th colspan="2">คิดเป็น %</th>
                <th colspan="2">คิดเป็น %</th>
                <th colspan="2">คิดเป็น %</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td class="text-center"></td>
                <td>ค่างานก่อน VAT</td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>   <!--รวมทั้งสิ้น-->
                <td></td>   <!--คิดเป็น %-->
            </tr>
            <tr>
                <td class="text-center"></td>
                <td>รายรับ ณ ปัจจุบัน</td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>   <!--รวมทั้งสิ้น-->
                <td></td>   <!--คิดเป็น %-->
            </tr>
            <tr>
                <td class="text-center"></td>
                <td>Direct cost</td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>   <!--รวมทั้งสิ้น-->
                <td></td>   <!--คิดเป็น %-->
            </tr>
            <tr>
                <td class="text-center"></td>
                <td>กำไรขั้นต้น</td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>   <!--รวมทั้งสิ้น-->
                <td></td>   <!--คิดเป็น %-->
            </tr>
            <tr>
                <td class="text-center"></td>
                <td>OH site</td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>   <!--รวมทั้งสิ้น-->
                <td></td>   <!--คิดเป็น %-->
            </tr>
            <tr>
                <td class="text-center"></td>
                <td>OH office</td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>   <!--รวมทั้งสิ้น-->
                <td></td>   <!--คิดเป็น %-->
            </tr>
            <tr>
                <td class="text-center"></td>
                <td>OH All</td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>   <!--รวมทั้งสิ้น-->
                <td></td>   <!--คิดเป็น %-->
            </tr>
            <tr>
                <td class="text-center"></td>
                <td>กำไรสุทธิ</td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>   <!--รวมทั้งสิ้น-->
                <td></td>   <!--คิดเป็น %-->
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