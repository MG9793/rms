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


    // เพิ่มข้อมูล bill_line
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

            $_SESSION['add_billLine_error'] = '<i class="fa-solid fa-triangle-exclamation"></i> Error! ยอดที่กรอกไม่ตรงกับยอดตามใบเสร็จ กรุณาตรวจสอบอีกครั้ง';
            header("location: ../page/expenseLine.php");
        }
    }


    // แก้ไขข้อมูล bill_line
    else if (isset($_POST['edit_billLine'])) {

        $id = $_POST['id'];
        $editItems = $_POST['editItems'];
        $editQty = $_POST['editQty'];

        $stmt = $conn->prepare("UPDATE bill_line SET item_name = :item_name, qty = :qty WHERE id = :id");
        $stmt->bindParam(":id", $id);
        $stmt->bindParam(":item_name", $editItems);
        $stmt->bindParam(":qty", $editQty);
        $stmt->execute();

        header("location: ../page/expenseLine.php");
    }







    
    // check มีการส่ง selectSite_Line จาก incomeRecord.php หรือไม่
    // else if (isset($_POST['selectSite_Line'])) {
    //     $siteName = $_POST['siteName'];

    //     $_SESSION['siteName_incomeLine'] = $siteName;
    //     header("location: ../page/incomeRecord_Line.php");
    // }
?>