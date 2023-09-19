<?php
    session_start();
    require_once "../include/header.php";
    require_once "../db/db_dashboard.php";  
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <style>
        .quickAdd {
            text-decoration: none;
            font-weight: 500;
            color: #f86624;
        }
    </style>
</head>
<body>
<br>

    <section class="container mb-3">
        <div class="row">

            <?php
                $stmt = $conn->query("SELECT * FROM site_info WHERE site_abbre <> 'HO' " );
                $site_item = $stmt->fetchAll();

                foreach($site_item as $site) {

                    $siteName = $site['site_name'];
                    $siteAbbre = $site['site_abbre'];

                    // ยอดรับ
                    $stmt_income = $conn->query("SELECT SUM(amount) AS incomeAmount FROM income WHERE site_name = '$siteName'");
                    $amount = $stmt_income->fetch(PDO::FETCH_ASSOC);
                    // แยกหลักทศนิยม ยอดรับ
                    if (isset($amount['incomeAmount'])) {
                        $income_separate = explode('.', $amount['incomeAmount']);
                        $incomeWhole = $income_separate[0];
                        $incomeDecimal = $income_separate[1];
                    } else {
                        $incomeWhole = 0;
                        $incomeDecimal = 0;
                    }


                    // ยอดจ่าย
                    $stmt_expense = $conn->query("SELECT SUM(total) AS expenseAmount FROM bill_head WHERE site_name = '$siteName'");
                    $expense = $stmt_expense->fetch(PDO::FETCH_ASSOC);
                    // แยกหลักทศนิยม ยอดจ่าย
                    if (isset($expense['expenseAmount'])) {
                        $expense_separate = explode('.', $expense['expenseAmount']);
                        $expenseWhole = $expense_separate[0];
                        $expenseDecimal = $expense_separate[1];
                    } else {
                        $expenseWhole = 0;
                        $expenseDecimal = 0;
                    }
            ?>
                <div class="col-xl-4 col-md-12 mb-3 p-2">
                   
                    <div class="card" style="background-color: #f9f4f5">
                        <h5 class="fw-bold text-center border p-2 bg-success text-light rounded"><?php echo $siteName; ?> (<?php echo $siteAbbre; ?>)</h5>
                        <div class="card-body">
                            <div class="d-flex flex-row justify-content-between ">
                                <h5><i class="fa-solid fa-landmark"></i> ยอดรวม</h5>
                                <h3><?php echo number_format($site['total'], 2); ?></h3>
                            </div>
                            <hr>
                            <div class="row">
                                <div class="col-md-4">
                                    <h5><i class="fa-solid fa-hand-holding-dollar text-success"></i> ยอดรับ</h5>
                                </div>
                                <div class="col-md-8 position-relative">
                                    <h3 class="text-success fw-bold text-end" style="margin-right: 41px;"><?php echo number_format($incomeWhole); ?></h3>
                                    <h3 class="text-success fw-bold position-absolute" style="top: 0; margin-left: 200px;">.<?php echo $incomeDecimal; ?></h3>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-4">
                                    <h5><i class="fa-solid fa-sack-dollar text-danger"></i> ยอดจ่าย</h5>
                                </div>
                                <div class="col-md-8 position-relative">
                                    <h3 class="text-danger fw-bold text-end" style="margin-right: 41px;"><?php echo number_format($expenseWhole); ?></h3>
                                    <h3 class="text-danger fw-bold position-absolute" style="top: 0; margin-left: 200px;">.<?php echo $expenseDecimal; ?></h3>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                </div>

        
            <?php } ?>
        </div>

       
    </section>
    
</body>
</html>
