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
        $_SESSION['site'] = $siteName;
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

     // search bill_head ตามเดือน
     else if (isset($_POST['selectMonth'])) {
        $getMonth = $_POST['selectMonth'];
        

        // query ยอดเงิน head
            $sth = $conn->prepare("SELECT SUM(total) AS headSum FROM bill_head WHERE MONTH(buy_date) = '$getMonth'");
            $sth->execute();
           $totalMonth = $sth->fetch(PDO::FETCH_OBJ);
           if ($_POST['selectMonth'] == 1){
            $_SESSION['Month'] = "มกราคม";
        }else if($_POST['selectMonth'] == 2){
            $_SESSION['Month'] = "กุมภาพันธ์";
        }else if($_POST['selectMonth'] == 3){
            $_SESSION['Month'] = "มีนาคม";
        }else if($_POST['selectMonth'] == 4){
            $_SESSION['Month'] = "เมษายน";
        }else if($_POST['selectMonth'] == 5){
            $_SESSION['Month'] = "พฤษภาคม";
        }else if($_POST['selectMonth'] == 6){
            $_SESSION['Month'] = "มิถุนายน";
        }else if($_POST['selectMonth'] == 7){
            $_SESSION['Month'] = "กรกฎาคม";
        }else if($_POST['selectMonth'] == 8){
            $_SESSION['Month'] = "สิงหาคม";
        }else if($_POST['selectMonth'] == 9){
            $_SESSION['Month'] = "กันยายน";
        }else if($_POST['selectMonth'] == 10){
            $_SESSION['Month'] = "ตุลาคม";
        }else if($_POST['selectMonth'] == 11){
            $_SESSION['Month'] = "พฤศจิกายน";
        }else if($_POST['selectMonth'] == 12){
            $_SESSION['Month'] = "ธันวาคม";
        }
        $_SESSION['id'] = $getMonth;
        $_SESSION['Total'] = $totalMonth->headSum;


        header("location: ../page/disperseCost.php");
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

        $receiptTotal = $_POST['receiptTotal'];
        $itemSum = $_POST['itemSum'];

        // check ยอดกรอกต้องตรงกับยอดใบเสร็จ
        if ($receiptTotal === $itemSum) {

            $receiptNo = $_SESSION['receiptNo_billLine'];

            $stmt = $conn->prepare("INSERT INTO bill_line (receipt_no, item_name, qty, amount, total)
                                    VALUES (:receipt_no, :item_name, :qty, :amount, :total)");

            $stmt->bindParam(':receipt_no', $receiptNo);
            $stmt->bindParam(':item_name', $item_name);
            $stmt->bindParam(':qty', $qty);
            $stmt->bindParam(':amount', $amount);
            $stmt->bindParam(':total', $total);

            // loop array
            $item_name = $_POST["itemName"];
            $qty = $_POST["itemQty"];
            $amount = $_POST['unitPrice'];
            $total = $_POST['itemTotal'];
            $stmt->execute();
            


        // query ยอดเงิน line
        $stl = $conn->prepare("SELECT SUM(total) AS lineTotal FROM bill_line WHERE receipt_no = '$receiptNo'");
            $stl->execute();
           $totalLine = $stl->fetch(PDO::FETCH_OBJ);
        $_SESSION['lineTotal'] = $totalLine->lineTotal;

            header("location: ../page/expenseLine.php");


        } else {

            $_SESSION['add_billLine_error'] = '<i class="fa-solid fa-triangle-exclamation"></i> Error! ยอดที่กรอกไม่ตรงกับยอดตามใบเสร็จ กรุณาตรวจสอบอีกครั้ง';
            echo "<script>setTimeout(function(){history.back();});</script>";
            // header("location: ../page/expenseLine.php");
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