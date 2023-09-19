<?php

    session_start();
    require_once 'config/conn.php';

   
    
    if (isset($_POST['sendReport'])) {
        
            $_SESSION["selectTime"] = substr($_POST['selectMonth'],2)." ".$_POST['selectYear']; 
            $_SESSION["selectTime2"] = $_POST['selectYear']."".substr($_POST['selectMonth'],0,2); 
            $_SESSION["selectMonth"] = substr($_POST['selectMonth'],0,2);
            $_SESSION["selectMonthFull"] = substr($_POST['selectMonth'],2);
            $_SESSION["selectMonthOld"] = $_POST['selectMonth'];
            $_SESSION["selectYear"] = $_POST['selectYear'];
            
       
        
        $selectTime = $_SESSION["selectTime"];
        $selectTime2 = $_SESSION["selectTime2"]; 
        $receipt_nos = $_POST['receipt_no'];
        $reports = $_POST['report'];        // ดึงมาจาก form checkbox

        if (empty($reports)) {
            $_SESSION['reportFailure'] = '<i class="fa-solid fa-triangle-exclamation"></i> Error! กรุณาเลือกรายการออกใบกำกับภาษี';
            header("location: ../page/filterTaxSummary.php");

        } else {
    
            foreach ($receipt_nos as $receipt_no) {
                if (isset($reports[$receipt_no]) && $reports[$receipt_no] === 'Y') {
                    $stmt = $conn->prepare("UPDATE bill_head SET report = 'Y', report_month = '$selectTime' , report_month2 = '$selectTime2' WHERE receipt_no = :receipt_no");
                    $stmt->execute(['receipt_no' => $receipt_no]);

                    header("location: ../page/chooseBillVat.php");

                }
            }
        }
    }


    else if(isset($_POST['this_billVAT'])) {
        $thisMonth = $_POST['thisMonth'];
        $_SESSION['thisMonth'] = $thisMonth;

        header("location: ../page/filterTaxSummary.php");
    }

    // ดูบิลที่ออกรายการแล้ว
    else if(isset($_POST['reported_billVAT'])) {
        // $thisMonth = $_POST['thisMonth'];
        // $_SESSION['reported_billVAT'] = $thisMonth;

        header("location: ../page/viewReportedBill.php");
    }

    // รับค่ามาจาก page/selectVatReport.php
    else if(isset($_POST['exportReport'])) {
        $selectMonth = $_POST['selectMonth'];
        $_SESSION['selectMonth'] = $selectMonth;

        header("location: ../page/chooseBillVat.php");
    }
?>