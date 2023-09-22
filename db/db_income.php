<?php

    session_start();
    require_once 'config/conn.php';


    // เพิ่มข้อมูล income
    if (isset($_POST['addIncome'])) {
        $site = $_POST['siteName'];
        $paidDate = $_POST['paidDate'];
        $installmentNO = $_POST['installmentNO'];
        $amount = $_POST['Amount'];
        $paidMonth = substr($_POST['paidDate'],3,2);

        $stmt = $conn->prepare("INSERT INTO income(site_name, installment_no, paid_date, paid_month, amount)
                                VALUES(:site_name, :installment_no, :paid_date, :paid_month, :amount)");

        $stmt->bindParam(":site_name", $site);
        $stmt->bindParam(":installment_no", $installmentNO);
        $stmt->bindParam(":paid_date", $paidDate);
        $stmt->bindParam(":paid_month", $paidMonth);
        $stmt->bindParam(":amount", $amount);
        $stmt->execute();
        $_SESSION['siteName_incomeHead'] = $site;
        $_SESSION['addIncomeHead_success'] = '<i class="fa-solid fa-circle-check"></i> Success! บันทึกรายรับสำเร็จ';
        header("location: ../page/incomeRecord.php");
    }


    // แก้ไขข้อมูล income_head
    else if (isset($_POST['editIncome_head'])) {
        $id = $_POST['id'];
        $site = $_POST['editSiteName'];
        $installmentNO = $_POST['editInstallmentNO'];
        $paidDate = $_POST['editPaidtDate'];
        $amount = $_POST['editAmount'];

        $stmt = $conn->prepare("UPDATE income
                                SET site_name = :site_name, installment_no = :installment_no, paid_date = :paid_date, amount = :amount
                                WHERE id = :id");

        $stmt->bindParam(":id", $id);
        $stmt->bindParam(":site_name", $site);
        $stmt->bindParam(":installment_no", $installmentNO);
        $stmt->bindParam(":paid_date", $paidDate);
        $stmt->bindParam(":amount", $amount);
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