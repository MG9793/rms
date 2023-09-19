<?php
    session_start();
    require_once "../include/header.php";
    require_once "../db/db_dashboard.php";  

?>

<!DOCTYPE html>
<html lang="en">
<head>
</head>
<body>
<br>

    <section class="container mb-3">
        <div class="row">

            <?php

                $stmt = $conn->query("SELECT * FROM site_info WHERE site_abbre <> 'HO' " );
                $stmt->execute();
                $site_item = $stmt->fetchAll();

                foreach($site_item as $site) {

                    $siteName = $site['site_name'];
                    $siteAbbre = $site['site_abbre'];

                    $stmt_income = $conn->query("SELECT SUM(amount) AS incomeAmount FROM income WHERE site_name = '$siteName' ");
                    $stmt_income->execute();
                    $amount = $stmt_income->fetch(PDO::FETCH_ASSOC);

                    $stmt_bill = $conn->query("SELECT SUM(total) AS totalBuy FROM bill_head WHERE site_name = '$siteName' ");
                    $stmt_bill->execute();
                    $bill = $stmt_bill->fetch(PDO::FETCH_ASSOC);

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
                        <div class="d-flex flex-row justify-content-between">
                            <h5><i class="fa-solid fa-hand-holding-dollar text-success"></i> ยอดรับ</h5>
                            <h3 class="text-success fw-bold"><?php echo number_format($amount['incomeAmount'], 2); ?></h3>
                        </div>
                        <div class="d-flex flex-row justify-content-between">
                            <h5><i class="fa-solid fa-sack-dollar text-danger"></i> ยอดจ่าย</h5>
                            <h3 class="text-danger fw-bold"><?php echo number_format($bill['totalBuy'], 2); ?></h3>
                        </div>
                        </div>
                    </div>
                    
                </div>

        
            <?php } ?>
        </div>

       
    </section>
    
</body>
</html>
