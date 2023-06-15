<?php
    require_once "../include/header.php";
    require_once "../db/db_dashboard.php";    
?>

<!DOCTYPE html>
<html lang="en">
<head>
</head>
<body>


    <section class="container mb-3">
        <div class="row">

            <?php

                $stmt = $conn->query("SELECT * FROM site_info");
                $stmt->execute();
                $site_item = $stmt->fetchAll();

                foreach($site_item as $site) {

                    $siteName = $site['site_name'];
                    $siteAbbre = $site['site_abbre'];

                    $stmt_income = $conn->query("SELECT SUM(amount) AS incomeAmount FROM income WHERE site_name = '$siteName'");
                    $stmt_income->execute();
                    $amount = $stmt_income->fetch(PDO::FETCH_ASSOC);

            ?>

            <div class="col-xl-4 col-md-12 mt-3">
                <div class="card">
                    <div class="card-header bg-dark text-center text-light">
                        <h5 class="fw-bold"><?php echo $siteName; ?></h5>
                        <h5 class="fw-bold"><?php echo $siteAbbre; ?></h5>
                    </div>
                    <div class="card-body">
                        <div class="d-flex flex-row justify-content-between">
                            <h5><i class="fa-solid fa-landmark"></i> Total</h5>
                            <h5><?php echo number_format($site['total'], 2); ?></h5>
                        </div>
                        <hr>
                        <div class="d-flex flex-row justify-content-between">
                            <h5><i class="fa-solid fa-hand-holding-dollar text-success"></i> ยอดรับ</h5>
                            <h3 class="text-success fw-bold"><?php echo number_format($amount['incomeAmount'], 2); ?></h3>
                        </div>
                        <div class="d-flex flex-row justify-content-between">
                            <h5><i class="fa-solid fa-sack-dollar text-danger"></i> ยอดจ่าย</h5>
                            <h3 class="text-danger fw-bold"><?php echo number_format(000, 2); ?></h3>
                        </div>
                        
                    </div>
                </div>
            </div>
            <?php } ?>
        </div>

       
    </section>
    
</body>
</html>
