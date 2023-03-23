<?php

    // ดึง connection ห้ามลบ
    require_once "conn.php";


    // ลบบัญชีผู้ใช้
    if (isset($_GET['deleteUser'])) {
        $delete_id = $_GET['deleteUser'];
        $checkRow = $conn->query("SELECT * FROM user_info");
        if($checkRow->rowCount() == 1) {
    
            // Alert Delete Failure
            $_SESSION['deleteUser_error'] = '<i class="fa-solid fa-circle-check"></i> Error! ไม่สามารถลบผู้ใช้งานคนสุดท้ายได้ เนื่องจากไม่มีผู้ใช้งานระบบ';
            header("../page/userManagement.php");
    
        } else {
            $deletestmt = $conn->query("DELETE FROM user_info WHERE id = $delete_id");
            $deletestmt->execute();
    
            // Alert Success
            $_SESSION['deleteUser_success'] = '<i class="fa-solid fa-circle-check"></i> Error! ดำเนินการสำเร็จ ลบข้อมูลผู้ใช้เรียบร้อยแล้ว';
            header("../page/userManagement.php");
        }
    }

    
    // ลบ item_info
    if (isset($_GET['deleteItems'])) {
        $delete_id = $_GET['deleteItems'];
        $deleteStmt = $conn->query("DELETE FROM item_info WHERE id = $delete_id");
        $deleteStmt->execute();

        // Alert Success
        $_SESSION['deleteItems_success'] = '<i class="fa-solid fa-circle-check"></i> Success! ดำเนินการสำเร็จ! ลบรายการเรียบร้อยแล้ว';
        header("../page/listItemsManagement.php");
    }


    // ลบ income_head
    if (isset($_GET['deleteIncome_head'])) {
        $delete_id = $_GET['deleteIncome_head'];
        $deleteStmt = $conn->query("DELETE FROM income_head WHERE id = $delete_id");
        $deleteStmt->execute();

        // Alert Success
        $_SESSION['deleteIncomeHead_success'] = '<i class="fa-solid fa-circle-check"></i> Success! ดำเนินการสำเร็จ! ลบรายการเรียบร้อยแล้ว';
        header("../page/incomeRecord_Total.php");
    }

?>