<?php

    session_start();
    require_once 'config/conn.php';


    // if (isset($_POST['selectCompany'])) {
    //     $getCompany = $_POST['selectCompany'];
    //     $getTime = $_POST['selectTime'];

    //     $stmt = $conn->query("SELECT * FROM company_info WHERE company_name = '$getCompany'");
    //     $companyInfo = $stmt->fetch(PDO::FETCH_ASSOC);

    //     $_SESSION['selectTime'] = $getTime;
    //     $_SESSION['selectCompany'] = $getCompany;
    //     $_SESSION['companyTax'] = $companyInfo['tax_no'];

    //     header("location: ../report/filterTaxSummary.php");

    // }

    
    if (isset($_POST['sendReport'])) {

        $receipt_nos = $_POST['receipt_no'];
        $reports = $_POST['report'];        // ดึงมาจาก form checkbox

        if (empty($reports)) {
            $_SESSION['reportFailure'] = '<i class="fa-solid fa-triangle-exclamation"></i> Error! กรุณาเลือกรายการออกใบกำกับภาษี';
            header("location: ../report/filterTaxSummary.php");

        } else {
    
            foreach ($receipt_nos as $receipt_no) {
                if (isset($reports[$receipt_no]) && $reports[$receipt_no] === 'Y') {
                    $stmt = $conn->prepare("UPDATE bill_head SET report = 'Y' WHERE receipt_no = :receipt_no");
                    $stmt->execute(['receipt_no' => $receipt_no]);

                    header("location: ../report/taxReport.php");

                }
            }
        }

        //header("location: ../report/taxReport.php");
    }


    else if(isset($_POST['this_billVAT'])) {
        $thisMonth = $_POST['thisMonth'];
        $_SESSION['thisMonth'] = $thisMonth;

        header("location: ../report/filterTaxSummary.php");
    }
?>