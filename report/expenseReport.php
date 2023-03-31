<?php
    require_once "../include/header.php";
?>
<head>


</head>
<body>

<div class="container">
    <div class="text-center">
        <h5 class="fw-bold p-5 shadow" style="background-color: rgb(230, 230, 230);">สรุปค่าใช้จ่ายประจำเดือน มกราคม-ธันวาคม พ.ศ.2565 บริษัท สิทธิชัยเอนจิเนียริ่ง จำกัด (ทำงบ)</h5>
    </div>


    <table class="table table-bordered border-dark table-sm">
        <thead class="text-center" style="background-color: rgb(230, 230, 230);">
            <tr>
                <th>รายละเอียด</th>
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
                <th>TOTAL</th>

            </tr>
        </thead>
        <tbody>
            <?php
                $stmt = $conn->query("SELECT item_name FROM item_info");
                $stmt->execute();
                $item = $stmt->fetchAll();

                if (!$item) {
                    echo "<p><td colspan='15' class='text-center'>ไม่พบข้อมูล</td></p>";
                } else {
                    foreach ($item as $fetch_itemInfo) {
                        echo "<tr><td rowspan='1'>" . $fetch_itemInfo['item_name'] . "</td></tr>";
                    }
                }
                ?>
                
                <tr>
                    <td class="text-center">รวม</td>
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