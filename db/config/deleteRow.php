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
         //   header("../page/userManagement.php");
    
        } else {
            $deletestmt = $conn->query("DELETE FROM user_info WHERE id = $delete_id");
            $deletestmt->execute();
    
            // Alert Success
            $_SESSION['deleteUser_success'] = '<i class="fa-solid fa-circle-check"></i> Error! ดำเนินการสำเร็จ ลบข้อมูลผู้ใช้เรียบร้อยแล้ว';
         //   header("../page/userManagement.php");
        }
    }


    // ลบ item_info
    else if (isset($_GET['deleteItems'])) {
        $delete_id = $_GET['deleteItems'];
        $deleteStmt = $conn->query("DELETE FROM item_info WHERE id = $delete_id");
        $deleteStmt->execute();

        // Alert Success
        $_SESSION['deleteItems_success'] = '<i class="fa-solid fa-circle-check"></i> Success! ดำเนินการสำเร็จ! ลบรายการเรียบร้อยแล้ว';
       // header("../page/listItemsManagement.php");
    }


    // ลบ bill_head
    else if (isset($_GET['delete_BillHead'])) {
        $delete_id = $_GET['delete_BillHead'];
        $deleteStmt = $conn->query("DELETE FROM bill_head WHERE id = $delete_id");
        $deleteStmt->execute();
    }


    // ลบ bill_line
    else if (isset($_GET['delete_BillLine'])) {
        $delete_id = $_GET['delete_BillLine'];
        $deleteStmt = $conn->query("DELETE FROM bill_line WHERE id = $delete_id");
        $deleteStmt->execute();

        $receiptNo = $_SESSION['receiptNo_billLine'];
          // query ยอดเงิน line
          $stl = $conn->prepare("SELECT SUM(total) AS lineTotal FROM bill_line WHERE receipt_no = '$receiptNo'");
          $stl->execute();
         $totalLine = $stl->fetch(PDO::FETCH_OBJ);
      $_SESSION['lineTotal'] = $totalLine->lineTotal;
    }


    // ลบ site_info
    else if (isset($_GET['deleteSite'])) {
        $delete_id = $_GET['deleteSite'];
        $deleteStmt = $conn->query("DELETE FROM site_info WHERE id = $delete_id");
        $deleteStmt->execute();

        // Alert Success
        $_SESSION['deleteSite_success'] = '<i class="fa-solid fa-circle-check"></i> Success! ดำเนินการสำเร็จ! ลบไซต์งานเรียบร้อยแล้ว';
     //   header("../page/siteManagement.php");
    }



    // ลบ sales_info
    else if (isset($_GET['deleteSales'])) {
        $delete_id = $_GET['deleteSales'];
        $deleteStmt = $conn->query("DELETE FROM sales_info WHERE id = $delete_id");
        $deleteStmt->execute();

        // Alert Success
        $_SESSION['deleteSales_success'] = '<i class="fa-solid fa-circle-check"></i> Success! ดำเนินการสำเร็จ! ลบรายการเรียบร้อยแล้ว';
     //   header("../page/sellerManagement.php");
    }



    // ลบ income_head
    else if (isset($_GET['deleteIncome_head'])) {
        $delete_id = $_GET['deleteIncome_head'];
        $deleteStmt = $conn->query("DELETE FROM income WHERE id = $delete_id");
        $deleteStmt->execute();

        // Alert Success
        $_SESSION['deleteIncomeHead_success'] = '<i class="fa-solid fa-circle-check"></i> Success! ดำเนินการสำเร็จ! ลบรายการเรียบร้อยแล้ว';
      //  header("../page/incomeRecord_Total.php");
    }


    // ลบ income_line
    else if (isset($_GET['deleteIncome_line'])) {
        $delete_id = $_GET['deleteIncome_line'];
        $deleteStmt = $conn->query("DELETE FROM income_line WHERE id = $delete_id");
        $deleteStmt->execute();

        // Alert Success
        $_SESSION['deleteIncomeLine_success'] = '<i class="fa-solid fa-circle-check"></i> Success! ดำเนินการสำเร็จ! ลบรายการเรียบร้อยแล้ว';
    //    header("../page/incomeRecord_Line.php");
    }


    // ลบ กระจายค่าใช้จ่าย
    else if (isset($_GET['deleteDisperse'])) {
        $delete_id = $_GET['deleteDisperse'];
        $deleteStmt = $conn->query("DELETE FROM disperse_info WHERE id = $delete_id");
        $deleteStmt->execute();

        $Month = $_SESSION["Month"];
        $siteHO = $_SESSION['officeHO'];

        $queryPercent = $conn->query("SELECT SUM(disperse_percent) AS Percent FROM disperse_info WHERE office_name = '$siteHO'");
        $result = $queryPercent->fetch(PDO::FETCH_ASSOC);
        $sumSpread = $result['Percent'];


        $updatePercent = $conn->prepare("UPDATE bill_head SET spread_cost = :spread_cost WHERE site_name = :site_name");
        $updatePercent->bindParam(":spread_cost", $sumSpread);
        $updatePercent->bindParam(":site_name", $siteHO);
        $updatePercent->execute();


        $std = $conn->prepare("SELECT SUM(disperse_sum) AS Sum ,SUM(disperse_percent) AS Percent FROM disperse_info WHERE month = '$Month' AND office_name = '$siteHO' ");
        $std->execute();
        $total = $std->fetch(PDO::FETCH_OBJ);
        $_SESSION['Sum'] = $total->Sum;
        $_SESSION['Percent'] = $total->Percent;

    }

?>