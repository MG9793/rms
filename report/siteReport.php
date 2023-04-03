<?php
    require_once "../include/header.php";
    require_once "../include/dependency.php";
?>

<head>

</head>
<body>

<div class="container-fluid" style="width: 100%; overflow: auto;">
    <div class="text-center">
        <h5 class="fw-bold p-5 ">สรุปโครงการก่อสร้าง : บริษัท สิทธิชัยเอนจิเนียริ่ง จำกัด</h5>
        <h6 class="fst-italic">สรุปงบประมาณปี 2564 เดือน มกราคม - ธันวาคม 2564</h6>
    </div>

    <table class="table table-bordered border-dark table-sm css-serial">
        <thead class="text-center" style="background-color: rgb(230, 230, 230);">
            <tr>
                <th valign="middle" rowspan="2" style="width: 50px;">ลำดับ</th>
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