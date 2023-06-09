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
           // query sales_branch
           $stl = $conn->prepare("SELECT sales_branch FROM sales_info WHERE sales_name = '$sellerName'");
           $stl->execute();
           $sales = $stl->fetch(PDO::FETCH_OBJ);
           $salesBranch = $sales->sales_branch;

        
        $_SESSION['site'] = $siteName;
        $stmt = $conn->prepare("INSERT INTO bill_head(site_name , receipt_no, buy_date, sales_name, tax_no, type, sum , vat , total , sales_branch)
                                VALUES(:site_name ,:receipt_no, :buy_date, :sales_name, :tax_no, :type, :sum, :vat, :total , :sales_branch)");
        
        $stmt->bindParam(":site_name", $siteName);
        $stmt->bindParam(":receipt_no", $receiptNo);
        $stmt->bindParam(":buy_date", $buyDate);
        $stmt->bindParam(":sales_name", $sellerName);
        $stmt->bindParam(":tax_no", $taxNO);
        $stmt->bindParam(":type", $type);
        $stmt->bindParam(":sum", $expenseSUM);
        $stmt->bindParam(":vat", $expenseVAT);
        $stmt->bindParam(":total", $expenseTotal);
        $stmt->bindParam(":sales_branch", $salesBranch);

        $stmt->execute();
        header("location: ../page/expense.php");

    }

     // แก้ไขข้อมูล search bill_head
     else if (isset($_POST['searchReceipt'])) {
        $receipt_no = $_POST['searchReceipt'];
        // query ยอดเงิน head
            $sth = $conn->prepare("SELECT total FROM bill_head WHERE receipt_no = '$receipt_no'");
            $sth->execute();
           $totalHead = $sth->fetch(PDO::FETCH_OBJ);
        $_SESSION['receiptNo_billLine'] = $receipt_no;
        $_SESSION['Total_billLine'] = $totalHead->total;



        // query ยอดเงิน line
        $stl = $conn->prepare("SELECT SUM(total) AS lineTotal FROM bill_line WHERE receipt_no = '$receipt_no'");
            $stl->execute();
           $totalLine = $stl->fetch(PDO::FETCH_OBJ);
        $_SESSION['lineTotal'] = $totalLine->lineTotal;

        header("location: ../page/expenseLine.php");
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

        // $receiptTotal = $_POST['receiptTotal'];     // ยอดเงินตามใบเสร็จ
        // $itemSum = $_POST['itemSum'];

        // check ยอดกรอกต้องตรงกับยอดใบเสร็จ
        // if ($receiptTotal === $itemSum) {

            $receiptNo = $_SESSION['receiptNo_billLine'];
            $item_name = $_POST["itemName"];
            $qty = $_POST["itemQty"];
            $amount = $_POST['unitPrice'];
            $total = $_POST['itemTotal'];

            $stmt = $conn->prepare("INSERT INTO bill_line (receipt_no, item_name, qty, amount, total)
                                    VALUES (:receipt_no, :item_name, :qty, :amount, :total)");

            $stmt->bindParam(':receipt_no', $receiptNo);
            $stmt->bindParam(':item_name', $item_name);
            $stmt->bindParam(':qty', $qty);
            $stmt->bindParam(':amount', $amount);
            $stmt->bindParam(':total', $total);
            $stmt->execute();
            

            // query ยอดเงิน line
            $stl = $conn->prepare("SELECT SUM(total) AS lineTotal FROM bill_line WHERE receipt_no = '$receiptNo'");
            $stl->execute();
            $totalLine = $stl->fetch(PDO::FETCH_OBJ);
            $_SESSION['lineTotal'] = $totalLine->lineTotal;

            header("location: ../page/expenseLine.php");


        // } else {

            // $_SESSION['add_billLine_error'] = '<i class="fa-solid fa-triangle-exclamation"></i> Error! ยอดที่กรอกไม่ตรงกับยอดตามใบเสร็จ กรุณาตรวจสอบอีกครั้ง';
            // echo "<script>setTimeout(function(){history.back();});</script>";
            // header("location: ../page/expenseLine.php");
        }
    // }


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

?>