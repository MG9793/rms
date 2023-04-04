<?php

    session_start();
    require_once 'config/conn.php';

    // เปิด SESSION ดึงไปหน้า expenseLine.php (บันทึกรายจ่าย รายละเอียด)
    if (isset($_POST['expenseLine'])) {
        $selectID = $_POST['id'];

        $_SESSION['select_expenseLine'] = $selectID;
        header("location: ../page/expenseLine.php");
    }

    // เพิ่มข้อมูล bill_head
    // if (isset($_POST['receiptNo'])) {

    //     $receiptNo = $_POST['receiptNo'];
    //     $buyDate = $_POST['buyDate'];
    //     $sellerName = $_POST['sales'];
    //     $taxNO = $_POST['taxNO'];
    //     $expenseSUM = $_POST['expenseSUM'];
    //     $expenseVAT = $_POST['expenseVAT'];
    //     $expenseTotal = $_POST['expenseTotal'];

    //     $stmt = $conn->prepare("INSERT INTO bill_head(receipt_no, buy_date, sales_name, tax_no, sum , vat , total)
    //                             VALUES(:receipt_no, :buy_date, :sales_name, :tax_no, :sum, :vat, :total)");

    //     $stmt->bindParam(":receipt_no", $receiptNo);
    //     $stmt->bindParam(":buy_date", $buyDate);
    //     $stmt->bindParam(":sales_name", $sellerName);
    //     $stmt->bindParam(":tax_no", $taxNO);
    //     $stmt->bindParam(":sum", $expenseSUM);
    //     $stmt->bindParam(":vat", $expenseVAT);
    //     $stmt->bindParam(":total", $expenseTotal);

    //     $stmt->execute();
    //  // $_SESSION['siteName_incomeHead'] = $site;
    //  // $_SESSION['addIncomeHead_success'] = '<i class="fa-solid fa-circle-check"></i> Success! บันทึกรายรับสำเร็จ';
    //     header("location: ../page/expense.php");
    // }


    // else if (isset($_POST['receipt_line'])) {

    //     $receipt_line = $_POST['receipt_line'];
    //     $itemPrice = $_POST['itemPrice'];
    //     $unitPrice = $_POST['unitPrice'];
    //     $itemSum = $_POST['itemSum'];

    //     $stmt = $conn->prepare("INSERT INTO bill_line(receipt_no, amount, price, total)
    //                             VALUES(:receipt_no, :amount, :price, :total)");

    //     $stmt->bindParam(":receipt_no", $receipt_line);
    //     $stmt->bindParam(":amount", $itemPrice);
    //     $stmt->bindParam(":price", $unitPrice);
    //     $stmt->bindParam(":total", $itemSum);


    //     $stmt->execute();
    //  // $_SESSION['siteName_incomeHead'] = $site;
    //  // $_SESSION['addIncomeHead_success'] = '<i class="fa-solid fa-circle-check"></i> Success! บันทึกรายรับสำเร็จ';
    //     header("location: ../page/expense.php");
    // }

/*
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

    */
?>