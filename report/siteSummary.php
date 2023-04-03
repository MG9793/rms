<?php
    require_once "../include/header.php";
    require_once "../include/dependency.php";
?>

<head>

</head>
<body>

<div class="container-fluid" style="width: 100%; overflow: auto;">
    <div class="text-center">
        <h5 class="fw-bold p-5 ">สรุป : โครงการก่อสร้าง MT7-A : บริษัท สิทธิชัยเอนจิเนียริ่ง จำกัด</h5>
    </div>


    <table class="table table-bordered border-dark table-sm css-serial">
        <thead class="text-center" style="background-color: rgb(230, 230, 230);">
            <tr>
                <th valign="middle" style="width: 50px;">ลำดับ</th>
                <th valign="middle">ทุน</th>
                <th>งบประมาณ</th>
                <th>งบประมาณคงเหลือ</th>
                <th>รวมทั้งสิ้น</th>
                <th>มค.65</th>
                <th>กพ.65</th>
                <th>มีค.65</th>
                <th>เม.ย.65</th>
                <th>พค.65</th>
                <th>มิย.65</th>
                <th>กค.65</th>
                <th>สค.65</th>
                <th>กย.65</th>
                <th>ตค.65</th>
                <th>พย.65</th>
                <th>ธค.65</th>
                <th>ยอดรวมปี 2565</th>
                <th>งบประมาณที่ใช้ไป</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td class="text-center"></td>
                <td class="fw-bold text-center">OA : OVERHEAD I : ค่าใช้จ่ายหน่วยงาน (ค่าแรง)</td>
            </tr>

            <!-- query รายการค่าแรง -->
            <?php
                $stmt = $conn->query("SELECT item_name FROM item_info WHERE item_type = 'ค่าแรง'");
                $stmt->execute();
                $item = $stmt->fetchAll();

                if (!$item) {
                    echo "<p><td colspan='19' class='text-center'>ไม่พบข้อมูล</td></p>";
                } else {
                    foreach ($item as $fetch_itemInfo) {
                        echo "<tr>";
                        echo "<td class='text-center'></td>";
                        echo "<td rowspan='1'>" . $fetch_itemInfo['item_name'] . "</td>";
                        echo "</tr>";
                    }
                }
            ?>

            <tr>
                <td class="text-center"></td>
                <td class="fw-bold text-center">OA : OVERHEAD I : ค่าใช้จ่ายหน่วยงาน (ค่าวัสดุ)</td>
            </tr>

            <!-- query รายการค่าวัสดุ -->
            <?php
                $stmt = $conn->query("SELECT item_name FROM item_info WHERE item_type = 'ค่าวัสดุ'");
                $stmt->execute();
                $item = $stmt->fetchAll();

                if (!$item) {
                    echo "<p><td colspan='19' class='text-center'>ไม่พบข้อมูล</td></p>";
                } else {
                    foreach ($item as $fetch_itemInfo) {
                        echo "<tr>";
                        echo "<td class='text-center'></td>";
                        echo "<td rowspan='1'>" . $fetch_itemInfo['item_name'] . "</td>";
                        echo "</tr>";
                    }
                }
            ?>

            
            <tr>
                <td class="text-center"></td>
                <td class="fw-bold text-center">รวมราคางาน OVERHEAD I : ค่าใช้จ่ายหน่วยงาน</td>
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