<?php
  //  session_start();
    require_once "../db/config/deleteRow.php";
    require_once "../page/include/header.php";

    // if (!isset($_SESSION['admin_login'])) {
    //     header("location: ../login.php");
    // } else {

    //     // query ชื่อผู้ใช้งาน
    //     $id = $_SESSION['admin_login'];
    //     $stmt = $conn->query("SELECT name, lastname, username FROM user_info WHERE id = $id");
    //     $stmt->execute();
    //     $userName_query = $stmt->fetch(PDO::FETCH_ASSOC);
?>

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
        <h5 class="fw-bold p-2 shadow" style="background-color: rgb(230, 230, 230);">สรุปค่าใช้จ่ายประจำเดือน มกราคม-ธันวาคม พ.ศ.2565 บริษัท สิทธิชัยเอนจิเนียริ่ง จำกัด (ทำงบ)</h5>
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