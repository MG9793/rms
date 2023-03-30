<?php

    session_start();
    require_once 'config/conn.php';


    // เพิ่มข้อมูล income_head
    if (isset($_POST['addIncome_head'])) {
        $site = $_POST['addSiteName'];
        $installment = $_POST['addInstallment'];
        $startDate = $_POST['addStartDate'];
        $finishDate = $_POST['addFinishDate'];
        $sum = $_POST['addSum'];

        $stmt = $conn->prepare("INSERT INTO income_head(site_name, installment, start_date, finish_date, sum)
                                VALUES(:site_name, :installment, :start_date, :finish_date, :sum)");

        $stmt->bindParam(":site_name", $site);
        $stmt->bindParam(":installment", $installment);
        $stmt->bindParam(":start_date", $startDate);
        $stmt->bindParam(":finish_date", $finishDate);
        $stmt->bindParam(":sum", $sum);
        $stmt->execute();
        $_SESSION['siteName_incomeHead'] = $site;
        $_SESSION['addIncomeHead_success'] = '<i class="fa-solid fa-circle-check"></i> Success! บันทึกรายรับสำเร็จ';
        header("location: ../page/incomeRecord.php");
    }


    // แก้ไขข้อมูล income_head
    else if (isset($_POST['editIncome_head'])) {
        $id = $_POST['id'];
        $site = $_POST['editSiteName'];
        $installment = $_POST['editInstallment'];
        $startDate = $_POST['editStartDate'];
        $finishDate = $_POST['editFinishDate'];
        $sum = $_POST['editSum'];

        $stmt = $conn->prepare("UPDATE income_head
                                SET site_name = :site_name, installment = :installment, start_date = :start_date, finish_date = :finish_date, sum = :sum
                                WHERE id = :id");

        $stmt->bindParam(":id", $id);
        $stmt->bindParam(":site_name", $site);
        $stmt->bindParam(":installment", $installment);
        $stmt->bindParam(":start_date", $startDate);
        $stmt->bindParam(":finish_date", $finishDate);
        $stmt->bindParam(":sum", $sum);
        $stmt->execute();

        $_SESSION['editIncomeHead_success'] = '<i class="fa-solid fa-circle-check"></i> Success! แก้ไขรายรับสำเร็จ';
        header("location: ../page/incomeRecord.php");
    }


    // check มีการส่ง selectSite_Head จาก incomeRecord.php หรือไม่
    else if (isset($_POST['selectSite_Head'])) {
        $siteName = $_POST['siteName'];

        $_SESSION['siteName_incomeHead'] = $siteName;
        header("location: ../page/incomeRecord.php");
    }


    // เพิ่มข้อมูล income_line
    else if (isset($_POST['addIncome_line'])) {
        $site = $_POST['addSiteName'];
        $payer = $_POST['addPayerName'];
        $paidDate = $_POST['addPaidDate'];
        $installment = $_POST['addInstallmentNo'];
        $price = $_POST['addPrice'];

        $stmt = $conn->prepare("INSERT INTO income_line(site_name, payer_name, installment_no, paid_date, price)
                                VALUES(:site_name, :payer_name, :installment_no, :paid_date, :price)");

        $stmt->bindParam(":site_name", $site);
        $stmt->bindParam(":payer_name", $payer);
        $stmt->bindParam(":installment_no", $installment);
        $stmt->bindParam(":paid_date", $paidDate);
        $stmt->bindParam(":price", $price);
        $stmt->execute();

        $_SESSION['addIncomeLine_success'] = '<i class="fa-solid fa-circle-check"></i> Success! บันทึกรายรับ (รายละเอียด) สำเร็จ';
        header("location: ../page/incomeRecord_Line.php");
    }






    
    // check มีการส่ง selectSite_Line จาก incomeRecord.php หรือไม่
    else if (isset($_POST['selectSite_Line'])) {
        $siteName = $_POST['siteName'];

        $_SESSION['siteName_incomeLine'] = $siteName;
        header("location: ../page/incomeRecord_Line.php");
    }
?>