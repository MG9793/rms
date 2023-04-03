<?php
    require_once "../include/header.php";
    require_once "../include/dependency.php";
?>

<head>
</head>
<body>

<div class="container-fluid" style="width: 100%; overflow: auto;">
    <div class="text-center">
        <h5 class="fw-bold p-5">สรุปรายรับ</h5>
    </div>


    <table class="table table-bordered border-dark table-sm css-serial">
        <thead class="text-center" style="background-color: rgb(230, 230, 230);">
            <tr>
                <th valign="middle" rowspan="2" style="width: 50px;">ลำดับ</th>
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