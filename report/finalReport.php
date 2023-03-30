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
        <h5 class="fw-bold p-2 shadow" style="background-color: rgb(230, 230, 230);">สรุปรายรับ</h5>
    </div>


    <table class="table table-bordered border-dark table-sm css-serial">
        <thead class="text-center" style="background-color: rgb(230, 230, 230);">
            <tr>
                <th valign="middle" rowspan="2">ลำดับ</th>
                <th valign="middle" rowspan="2">รายการ</th>
                <th valign="middle" rowspan="2">มูลค่างาน (NoVAT)</th>
                <th valign="middle" colspan="2">รายรับสะสม</th>
                <th colspan="12">มูลค่างาน-รายรับประจำปี 2565</th>
            </tr>
            <tr>
                <!-- Subheader -->
                <th></th>
                <th>%</th>
                <th>มกราคม</th>
                <th>กุมภาพันธ์</th>
                <th>มีนาคม</th>
                <th>เมษายน</th>
                <th>พฤษภาคม</th>
                <th>มิถุนายน</th>
                <th>กรกฎาคม</th>
                <th>สิงหาคม</th>
                <th>กันยายน</th>
                <th>ตุลาคม</th>
                <th>พฤศจิกายน</th>
                <th>ธันวาคม</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td class="text-center"></td>
                <td>กำไร (ขาดทุน) สะสม MT3-2</td>
                <td class="text-end commas">698518.54</td>
                <td></td>   <!--รายรับสะสม-->
                <td></td>   <!--% รายรับสะสม-->
                <td></td>   <!--มกราคม-->
                <td></td>   <!--กุมภาพันธ์-->
                <td></td>   <!--มีนาคม-->
                <td></td>   <!--เมษายน-->
                <td></td>   <!--พฤษภาคม-->
                <td></td>   <!--มิถุนายน-->
                <td></td>   <!--กรกฎาคม-->
                <td></td>   <!--สิงหาคม-->
                <td></td>   <!--กันยายน-->
                <td></td>   <!--ตุลาคม-->
                <td></td>   <!--พฤศจิกายน-->
                <td></td>   <!--ธันวาคม-->
            </tr>
            <tr>
                <td class="text-center"></td>
                <td class="text-center bg-secondary">รวม</td>
                <td class="text-end commas">2691048.12</td>
                <td></td>   <!--รายรับสะสม-->
                <td></td>   <!--% รายรับสะสม-->
                <td></td>   <!--มกราคม-->
                <td></td>   <!--กุมภาพันธ์-->
                <td></td>   <!--มีนาคม-->
                <td></td>   <!--เมษายน-->
                <td></td>   <!--พฤษภาคม-->
                <td></td>   <!--มิถุนายน-->
                <td></td>   <!--กรกฎาคม-->
                <td></td>   <!--สิงหาคม-->
                <td></td>   <!--กันยายน-->
                <td></td>   <!--ตุลาคม-->
                <td></td>   <!--พฤศจิกายน-->
                <td></td>   <!--ธันวาคม-->
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