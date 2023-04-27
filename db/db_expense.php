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

        $stmt = $conn->prepare("INSERT INTO bill_head(site_name , receipt_no, buy_date, sales_name, tax_no, type, sum , vat , total)
                                VALUES(:site_name ,:receipt_no, :buy_date, :sales_name, :tax_no, :type, :sum, :vat, :total)");
        
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


    // แก้ไขข้อมูล bill_head
    else if (isset($_POST['edit_billHead'])) {

        $id = $_POST['id'];
        $siteName = $_POST['editSiteName'];
        $receiptNo = $_POST['editReceiptNo'];
        $buyDate = $_POST['editBuyDate'];
        $type = $_POST['editType'];

        $stmt = $conn->prepare("UPDATE bill_head SET site_name = :site_name, receipt_no = :receipt_no, buy_date = :buy_date, type = :type
                                WHERE id = :id");

        $stmt->bindParam(":id", $id);
        $stmt->bindParam(":site_name", $siteName);
        $stmt->bindParam(":receipt_no", $receiptNo);
        $stmt->bindParam(":buy_date", $buyDate);
        $stmt->bindParam(":type", $type);

        $stmt->execute();
        header("location: ../page/expense.php");
    }


    // เพิ่มข้อมูล bill_line
    else if (isset($_POST['add_billLine'])) {

        $receiptNo = $_POST['searchReceipt'];
        $receiptTotal = $_POST['receiptTotal'];
        $itemName = $_POST['itemName'];
        $qty = $_POST['itemQty'];
        $amount = $_POST['unitPrice'];
        $total = $_POST['itemTotal'];

        // check ยอดกรอกต้องตรงกับยอดใบเสร็จ
        if ($receiptTotal >= $total) {

            $stmt = $conn->prepare("INSERT INTO bill_line (receipt_no, item_name, qty, amount, total)
                                    VALUES (:receipt_no, :item_name, :qty, :amount, :total)");

            $stmt->bindParam(':receipt_no', $receiptNo);
            $stmt->bindParam(':item_name', $itemName);
            $stmt->bindParam(':qty', $qty);
            $stmt->bindParam(':amount', $amount);
            $stmt->bindParam(':total', $total);
            $stmt->execute();

            $_SESSION['receiptNo_billLine'] = $receiptNo;
            $_SESSION['add_billLine_success'] = '<i class="fa-solid fa-triangle-exclamation"></i> Success! บันทึกรายการสำเร็จ';
            header("location: ../page/expenseLine.php");

        } else {

            $_SESSION['add_billLine_error'] = '<i class="fa-solid fa-triangle-exclamation"></i> Error! ยอดที่กรอกเกินยอดตามใบเสร็จ กรุณาตรวจสอบอีกครั้ง';
            header("location: ../page/expenseLine.php");
        }
    }


    // แก้ไข bill_line
    else if (isset($_POST['edit_billLine'])) {

        $id = $_POST['id'];
        $itemName = $_POST['editItems'];
        $qty = $_POST['editQty'];
        $amount = $_POST['editAmount'];
        $total = $_POST['editTotal'];

        $stmt = $conn->prepare("UPDATE bill_line
                                SET item_name = :item_name, qty = :qty, amount = :amount, total = :total
                                WHERE id = :id");

        $stmt->bindParam(":id", $id);
        $stmt->bindParam(":item_name", $itemName);
        $stmt->bindParam(":qty", $qty);
        $stmt->bindParam(":amount", $amount);
        $stmt->bindParam(":total", $total);
        $stmt->execute();

        header("location: ../page/expenseLine.php");

    }


?>