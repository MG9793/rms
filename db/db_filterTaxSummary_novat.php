<?php

    session_start();
    require_once 'config/conn.php';

    
    if (isset($_POST['sendReport'])) {

        $selectTime = $_POST['selectTime'];
        $receipt_nos = $_POST['receipt_no'];
        $reports = $_POST['report'];        // ดึงมาจาก form checkbox

        if (empty($reports)) {
            $_SESSION['reportFailure'] = '<i class="fa-solid fa-triangle-exclamation"></i> Error! กรุณาเลือกรายการออกใบกำกับภาษี';
            header("location: ../page/filterTaxSummarynovat.php");

        } else {
    
            foreach ($receipt_nos as $receipt_no) {
                if (isset($reports[$receipt_no]) && $reports[$receipt_no] === 'Y') {
                    $stmt = $conn->prepare("UPDATE bill_head SET report = 'Y', report_month = '$selectTime' WHERE receipt_no = :receipt_no");
                    $stmt->execute(['receipt_no' => $receipt_no]);

                    header("location: ../report/taxReport.php");

                }
            }
        }
    }


    else if(isset($_POST['this_billNOVAT'])) {
        $thisMonth = $_POST['thisMonth'];
        $_SESSION['thisMonth'] = $thisMonth;

        header("location: ../page/filterTaxSummarynoVAT.php");
    }

    // ดูบิลที่ออกรายการแล้ว
    else if(isset($_POST['reported_billNOVAT'])) {
        // $thisMonth = $_POST['thisMonth'];
        // $_SESSION['reported_billVAT'] = $thisMonth;

        header("location: ../page/viewReportedBillnoVAT.php");
    }

    // รับค่ามาจาก page/selectVatReport.php
    else if(isset($_POST['exportReport'])) {
        $selectMonth = $_POST['selectMonth'];
        $_SESSION['selectMonth'] = $selectMonth;

        header("location: ../report/taxReport.php");
    }
?>