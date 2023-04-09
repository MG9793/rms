<?php

    session_start();
    require_once 'config/conn.php';


    // เพิ่มข้อมูล bill_head
    if (isset($_POST['add_billHead'])) {

        $siteName = $_POST['siteName'];
        $receiptNo = $_POST['receiptNo'];
        $buyDate = $_POST['buyDate'];
        $sellerName = $_POST['sales'];
        $taxNO = $_POST['taxNO'];
        $type = $_POST['type'];
        $expenseSUM = $_POST['expenseSUM'];
        $expenseVAT = $_POST['expenseVAT'];
        $expenseTotal = $_POST['expenseTotal'];

        $stmt = $conn->prepare("INSERT INTO bill_head(site_name , receipt_no, buy_date, sales_name, tax_no,type, sum , vat , total)
                                VALUES(:site_name ,:receipt_no, :buy_date, :sales_name, :tax_no,:type, :sum, :vat, :total)");
        $stmt->bindParam(":site_name", $siteName);
        $stmt->bindParam(":receipt_no", $receiptNo);
        $stmt->bindParam(":buy_date", $buyDate);
        $stmt->bindParam(":sales_name", $sellerName);
        $stmt->bindParam(":tax_no", $taxNO);
        $stmt->bindParam(":type", $type);
        $stmt->bindParam(":sum", $expenseSUM);
        $stmt->bindParam(":vat", $expenseVAT);
        $stmt->bindParam(":total", $expenseTotal);

        $stmt->execute();
        header("location: ../page/expense.php");

    }

    else if (isset($_POST['add_billLine'])) {

        $receiptTotal = $_POST['receiptTotal'];
        $itemSum = $_POST['itemSum'];

        // check ยอดกรอกต้องตรงกับยอดใบเสร็จ
        if ($receiptTotal === $itemSum) {
            $billName = $_POST['searchReceipt'];
            $receiptNo = substr_replace($billName, "", 10, 8);

            $stmt = $conn->prepare("INSERT INTO bill_line (receipt_no, item_name, qty, amount, total)
                                    VALUES (:receipt_no, :item_name, :qty, :amount, :total)");

            $stmt->bindParam(':receipt_no', $receiptNo);
            $stmt->bindParam(':item_name', $item_name);
            $stmt->bindParam(':qty', $qty);
            $stmt->bindParam(':amount', $amount);
            $stmt->bindParam(':total', $total);

            // loop array
            $itemName_array = $_POST["itemName"];
            $itemQty_array = $_POST["itemQty"];
            $unitPrice_array = $_POST['unitPrice'];
            $itemTotal_array = $_POST['itemTotal'];

            for ($i = 0; $i < count($itemQty_array); $i++) {
                $item_name = $itemName_array[$i];
                $qty = $itemQty_array[$i];
                $amount = $unitPrice_array[$i];
                $total = $itemTotal_array[$i];
                $stmt->execute();
            }

            header("location: ../page/expenseLine.php");


        } else {

            $_SESSION['add_billLine_error'] = '<i class="fa-solid fa-circle-check"></i> Error! ยอดที่กรอกไม่ตรงกับยอดตามใบเสร็จ กรุณาตรวจสอบอีกครั้ง';
            header("location: ../page/expenseLine.php");
        }
    }

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