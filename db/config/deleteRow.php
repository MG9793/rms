<?php

    // ดึง connection ห้ามลบ
    require_once "conn.php";


    // ลบ income_head
    if (isset($_GET['deleteIncome_head'])) {
        $delete_id = $_GET['deleteIncome_head'];


        $deleteStmt = $conn->query("DELETE FROM income_head WHERE id = $delete_id");
        $deleteStmt->execute();

        // Alert Success
        $_SESSION['deleteIncomeHead_success'] = '<i class="fa-solid fa-circle-check"></i> ดำเนินการสำเร็จ! ลบรายการเรียบร้อยแล้ว';
        header("../page/incomeRecord_Total.php");
    }

?>