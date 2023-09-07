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

    <section class="container mt-3">
        <h5 class="fw-bold p-2 text-center">กรุณาเลือกข้อมูล | ภาษีซื้อ</h5>
            <!-- รายการที่ยังไม่ได้เลือก -->
            <div class="row">
                <?php
                    // query เดือนทั้งหมด
                    $allMonth = $conn->query("SELECT DISTINCT * FROM bill_head WHERE report = 'N' AND vat = 0");
                    $allMonth->execute();
                    $allAmount = $allMonth->fetch(PDO::FETCH_ASSOC);

                    // query ยอดซื้อ เดือนทั้งหมด
                    $allMonth_buy = $conn->query("SELECT SUM(sum) AS monthTotal FROM bill_head WHERE report = 'N' AND vat = 0");
                    $allMonth_buy->execute();
                    $all_monthBuy = $allMonth_buy->fetch(PDO::FETCH_ASSOC);

                    if ($allMonth->rowCount() >= 1) {
                ?>
                <div class="col-xl-4 col-md-12 mb-3 " >
                    <form action="../db/db_filterTaxSummary_novat.php" method="POST">
                    <div class="card" >
                        <div class="fw-bold text-center border p-2 text-light rounded bg-danger">ยอดรวมที่ไม่ได้เลือก</div>
                            <div class="card-body" >
                                <div class="d-flex flex-row justify-content-between">
                                    <h5><i class="fa-solid fa-sack-dollar" ></i> ยอดซื้อ</h5>
                                    <h3 class="mb-0 fw-bold text-danger"><?php echo number_format($all_monthBuy['monthTotal'], 2); ?></h3>
                                </div>
                                <div class="d-flex flex-row p-3 justify-content-between"></div>
                            <br>
                            
                            
                        </div>
                    </div>
                    </form>
                </div>
                <?php } else { ?>

                <div class="col-xl-4 col-md-12 mb-3">
                    <div class="card">
                        <div class="fw-bold text-center border p-2 text-light rounded bg-danger">ยอดรวมที่ไม่ได้เลือก</div>
                            <div class="card-body">
                                <div class="d-flex flex-row justify-content-between">
                                    <h5 ><i class="fa-solid fa-sack-dollar"></i> ยอดซื้อ</h5>
                                    <h3 class="mb-0 fw-bold">0</h3>
                                    
                                </div>
                            <br>
                        </div>
                    </div>
                </div>

                <?php } ?>

                <!-- กล่องกลาง -->
                <?php
                    // query เดือนปัจจุบัน
                    $thisMonth = $conn->query("SELECT DISTINCT * FROM bill_head WHERE report = 'N' AND vat = 0 AND MONTH(buy_date) = MONTH(CURDATE()) AND YEAR(buy_date) = YEAR(CURDATE()) LIMIT 1 ");
                    $thisMonth->execute();
                    $amount = $thisMonth->fetch(PDO::FETCH_ASSOC);

                    // query ยอดซื้อ เดือนปัจจุบัน
                    $thisMonth_buy = $conn->query("SELECT SUM(sum) AS monthTotal FROM bill_head WHERE report = 'N' AND vat = 0 AND MONTH(buy_date) = MONTH(CURDATE()) AND YEAR(buy_date) = YEAR(CURDATE())");
                    $thisMonth_buy->execute();
                    $monthBuy = $thisMonth_buy->fetch(PDO::FETCH_ASSOC);

                    if ($thisMonth->rowCount() >= 1) {
                ?>

                <div class="col-xl-4 col-md-12 mb-3">
                    <form action="../db/db_filterTaxSummary_novat.php" method="POST">
                    <div class="card">
                        <div class="fw-bold text-center border p-2 text-light rounded" style="background-color: #2d6a4f;"><?php echo date("m/Y", strtotime($amount['buy_date'])); ?> (เดือนปัจจุบัน)</div>
                            <div class="card-body">
                                <div class="d-flex flex-row justify-content-between">
                                    <h5 ><i class="fa-solid fa-sack-dollar text-success"></i>  ยอดซื้อ</h5>
                                    <h3 class="mb-0 fw-bold"><?php echo number_format($monthBuy['monthTotal'], 2); ?></h3>
                                </div>
                            <br>
                            <input type="hidden" name="thisMonth" value="<?php echo date("Y-m", strtotime($amount['buy_date'])); ?>">
                            <button type="submit" name="this_billNOVAT" class="btn btn-sm btn-success w-100">เลือก</button>
                        </div>
                    </div>
                    </form>
                </div>
                <?php } else { ?>

                <div class="col-xl-4 col-md-12 mb-3">
                    <div class="card" style="background-color: #f9f4f5">
                        <div class="fw-bold text-center border p-2 bg-dark text-light rounded">--/----</div>
                            <div class="card-body">
                                <div class="d-flex flex-row justify-content-between">
                                    <h5 ><i class="fa-solid fa-sack-dollar text-success"></i>  ยอดซื้อ</h5>
                                    <h3 class="mb-0 fw-bold">0</h3>
                                </div>
                            <br>
                            <button type="submit" class="btn btn-sm btn-outline-success w-100 disabled">ไม่พบรายการซื้อ</button>
                        </div>
                    </div>
                </div>
                <?php } ?>


                <!-- กล่องขวา -->
                <?php
                    // query เดือนปัจจุบัน
                    $thisMonth = $conn->query("SELECT DISTINCT * FROM bill_head WHERE report = 'Y' AND vat = 0");
                    $thisMonth->execute();
                    $amount = $thisMonth->fetch(PDO::FETCH_ASSOC);

                    // query ยอดซื้อ เดือนปัจจุบัน
                    $thisMonth_buy = $conn->query("SELECT SUM(sum) AS monthTotal FROM bill_head WHERE report = 'Y' AND vat = 0");
                    $thisMonth_buy->execute();
                    $monthBuy = $thisMonth_buy->fetch(PDO::FETCH_ASSOC);

                    if ($thisMonth->rowCount() >= 1) {
                ?>

                <div class="col-xl-4 col-md-12 mb-3">
                    <form action="../db/db_filterTaxSummary_novat.php" method="POST">
                    <div class="card">
                        <div class="fw-bold text-center border p-2 text-light rounded bg-primary">ยอดรวมภาษีซื้อ</div>
                            <div class="card-body">
                                <div class="d-flex flex-row justify-content-between">
                                    <h5 ><i class="fa-solid fa-sack-dollar"></i> ยอดซื้อ</h5>
                                    <h3 class="mb-0 fw-bold"><?php echo number_format($monthBuy['monthTotal'], 2); ?></h3>
                                </div>
                            <br>
                            <!-- <input type="hidden" name="reportedMonth" value="<?php //echo date("Y-m", strtotime($amount['buy_date'])); ?>"> -->
                            <button type="submit" name="reported_billNOVAT" class="btn btn-sm btn-outline-primary w-100">ดูรายละเอียด</button>
                           
                        </div>
                    </div>
                    </form>
                </div>
                <?php } else { ?>

                <div class="col-xl-4 col-md-12 mb-3">
                    <div class="card" style="background-color: #f9f4f5">
                        <div class="fw-bold text-center border p-2 text-light rounded bg-primary">ยอดทั้งหมดที่ <u>ออกรายงานแล้ว</u></div>
                            <div class="card-body">
                                <div class="d-flex flex-row justify-content-between">
                                    <h5><i class="fa-solid fa-sack-dollar text-success"></i> ยอดซื้อ</h5>
                                    <h3 class="mb-0 fw-bold">0</h3>
                                </div>
                            <br>
                            <button type="submit" class="btn btn-sm btn-outline-primary w-100 disabled">ไม่พบรายการซื้อ</button>
                        </div>
                    </div>
                </div>
                <?php } ?>
            </div>


            <!-- แถว 2 -->
            <div class="row">
                <?php

                    // query Month-1 จากเดือนปัจจุบัน
                    $Month_1 = $conn->query("SELECT * FROM bill_head
                                             WHERE report = 'N' AND vat = 0 AND MONTH(buy_date) = MONTH(CURRENT_DATE() - INTERVAL 1 MONTH)
                                             AND YEAR(buy_date) = YEAR(CURRENT_DATE() - INTERVAL 1 MONTH)");
                    $Month_1->execute();
                    $month1 = $Month_1->fetch(PDO::FETCH_ASSOC);

                    // query ยอดซื้อ Month-1 จากเดือนปัจจุบัน
                    $Month_1_buy = $conn->query("SELECT SUM(sum) AS monthTotal FROM bill_head
                                                 WHERE report = 'N' AND vat = 0 AND MONTH(buy_date) = MONTH(CURRENT_DATE() - INTERVAL 1 MONTH)
                                                 AND YEAR(buy_date) = YEAR(CURRENT_DATE() - INTERVAL 1 MONTH)");
                    $Month_1_buy->execute();
                    $monthBuy1 = $Month_1_buy->fetch(PDO::FETCH_ASSOC);

                    if ($Month_1->rowCount() >= 1) {

                ?>

                <div class="col-xl-4 col-md-12 mb-3">
                    <form action="../db/db_filterTaxSummary_novat.php" method="POST">
                    <div class="card" style="background-color: #f9f4f5">
                        <div class="fw-bold text-center border p-2 bg-dark text-light rounded"><?php echo date("m/Y", strtotime($month1['buy_date'])); ?></div>
                            <div class="card-body">
                                <div class="d-flex flex-row justify-content-between">
                                    <h5 ><i class="fa-solid fa-sack-dollar text-success"></i> ยอดซื้อ</h5>
                                    <h3 class="mb-0 fw-bold"><?php echo number_format($monthBuy1['monthTotal'], 2); ?></h3>
                                </div>
                            <br>
                            <input type="hidden" name="thisMonth" value="<?php echo date("Y-m", strtotime($month1['buy_date'])); ?>">
                            <button type="submit" name="this_billNOVAT" class="btn btn-sm btn-outline-success w-100">เลือก</button>
                        </div>
                    </div>
                    </form>
                </div>
                <?php } else { ?>

                <div class="col-xl-4 col-md-12 mb-3">
                    <div class="card" style="background-color: #f9f4f5">
                        <div class="fw-bold text-center border p-2 bg-dark text-light rounded">--/----</div>
                            <div class="card-body">
                                <div class="d-flex flex-row justify-content-between">
                                    <h5 ><i class="fa-solid fa-sack-dollar text-success"></i> ยอดซื้อ</h5>
                                    <h3 class="mb-0 fw-bold">0</h3>
                                </div>
                            <br>
                            <button type="submit" class="btn btn-sm btn-outline-success w-100 disabled">ไม่พบรายการซื้อ</button>
                        </div>
                    </div>
                </div>

                <?php } ?>


                <?php

                    // query Month-2 จากเดือนปัจจุบัน
                    $Month_2 = $conn->query("SELECT * FROM bill_head
                                            WHERE report = 'N' AND vat = 0 AND MONTH(buy_date) = MONTH(CURRENT_DATE() - INTERVAL 2 MONTH)
                                            AND YEAR(buy_date) = YEAR(CURRENT_DATE() - INTERVAL 2 MONTH)");
                    $Month_2->execute();
                    $month2 = $Month_2->fetch(PDO::FETCH_ASSOC);

                    // query ยอดซื้อ Month-2 จากเดือนปัจจุบัน
                    $Month_2_buy = $conn->query("SELECT SUM(sum) AS monthTotal FROM bill_head
                                                WHERE report = 'N' AND vat = 0 AND MONTH(buy_date) = MONTH(CURRENT_DATE() - INTERVAL 2 MONTH)
                                                AND YEAR(buy_date) = YEAR(CURRENT_DATE() - INTERVAL 2 MONTH)");
                    $Month_2_buy->execute();
                    $monthBuy2 = $Month_2_buy->fetch(PDO::FETCH_ASSOC);

                    if ($Month_2->rowCount() >= 1) {

                ?>

                <div class="col-xl-4 col-md-12 mb-3">
                    <form action="../db/db_filterTaxSummary_novat.php" method="POST">
                    <div class="card" style="background-color: #f9f4f5">
                        <div class="fw-bold text-center border p-2 bg-dark text-light rounded"><?php echo date("m/Y", strtotime($month2['buy_date'])); ?></div>
                            <div class="card-body">
                                <div class="d-flex flex-row justify-content-between">
                                    <h5 ><i class="fa-solid fa-sack-dollar text-success"></i> ยอดซื้อ</h5>
                                    <h3 class="mb-0 fw-bold"><?php echo number_format($monthBuy2['monthTotal'], 2); ?></h3>
                                </div>
                            <br>
                            <input type="hidden" name="thisMonth" value="<?php echo date("Y-m", strtotime($month2['buy_date'])); ?>">
                            <button type="submit" name="this_billNOVAT" class="btn btn-sm btn-outline-success w-100">เลือก</button>
                        </div>
                    </div>
                    </form>
                </div>
                <?php } else { ?>

                <div class="col-xl-4 col-md-12 mb-3">
                    <div class="card" style="background-color: #f9f4f5">
                        <div class="fw-bold text-center border p-2 bg-dark text-light rounded">--/----</div>
                            <div class="card-body">
                                <div class="d-flex flex-row justify-content-between">
                                    <h5 ><i class="fa-solid fa-sack-dollar text-success"></i> ยอดซื้อ</h5>
                                    <h3 class="mb-0 fw-bold">0</h3>
                                </div>
                            <br>
                            <button type="submit" class="btn btn-sm btn-outline-success w-100 disabled">ไม่พบรายการซื้อ</button>
                        </div>
                    </div>
                </div>

                <?php } ?>


                <?php

                    // query Month-3 จากเดือนปัจจุบัน
                    $Month_3 = $conn->query("SELECT * FROM bill_head
                                            WHERE report = 'N' AND vat = 0 AND MONTH(buy_date) = MONTH(CURRENT_DATE() - INTERVAL 3 MONTH)
                                            AND YEAR(buy_date) = YEAR(CURRENT_DATE() - INTERVAL 3 MONTH)");
                    $Month_3->execute();
                    $month3 = $Month_3->fetch(PDO::FETCH_ASSOC);

                    // query ยอดซื้อ Month-3 จากเดือนปัจจุบัน
                    $Month_3_buy = $conn->query("SELECT SUM(sum) AS monthTotal FROM bill_head
                                                WHERE report = 'N' AND vat = 0 AND MONTH(buy_date) = MONTH(CURRENT_DATE() - INTERVAL 3 MONTH)
                                                AND YEAR(buy_date) = YEAR(CURRENT_DATE() - INTERVAL 3 MONTH)");
                    $Month_3_buy->execute();
                    $monthBuy3 = $Month_3_buy->fetch(PDO::FETCH_ASSOC);

                    if ($Month_3->rowCount() >= 1) {

                ?>

                <div class="col-xl-4 col-md-12 mb-3">
                    <form action="../db/db_filterTaxSummary_novat.php" method="POST">
                    <div class="card" style="background-color: #f9f4f5">
                        <div class="fw-bold text-center border p-2 bg-dark text-light rounded"><?php echo date("m/Y", strtotime($month3['buy_date'])); ?></div>
                            <div class="card-body">
                                <div class="d-flex flex-row justify-content-between">
                                    <h5 ><i class="fa-solid fa-sack-dollar text-success"></i> ยอดซื้อ</h5>
                                    <h3 class="mb-0 fw-bold"><?php echo number_format($monthBuy3['monthTotal'], 2); ?></h3>
                                </div>
                            <br>
                            <input type="hidden" name="thisMonth" value="<?php echo date("Y-m", strtotime($month3['buy_date'])); ?>">
                            <button type="submit" name="this_billNOVAT" class="btn btn-sm btn-outline-success w-100">เลือก</button>
                        </div>
                    </div>
                    </form>
                </div>
                <?php } else { ?>

                <div class="col-xl-4 col-md-12 mb-3">
                    <div class="card" style="background-color: #f9f4f5">
                        <div class="fw-bold text-center border p-2 bg-dark text-light rounded">--/----</div>
                            <div class="card-body">
                                <div class="d-flex flex-row justify-content-between">
                                    <h5 ><i class="fa-solid fa-sack-dollar text-success"></i> ยอดซื้อ</h5>
                                    <h3 class="mb-0 fw-bold">0</h3>
                                </div>
                            <br>
                            <button type="submit" class="btn btn-sm btn-outline-success w-100 disabled">ไม่พบรายการซื้อ</button>
                        </div>
                    </div>
                </div>

                <?php } ?>


                <?php

                    // query Month-4 จากเดือนปัจจุบัน
                    $Month_4 = $conn->query("SELECT * FROM bill_head
                                             WHERE report = 'N' AND vat = 0 AND MONTH(buy_date) = MONTH(CURRENT_DATE() - INTERVAL 4 MONTH)
                                             AND YEAR(buy_date) = YEAR(CURRENT_DATE() - INTERVAL 4 MONTH)");
                    $Month_4->execute();
                    $month4 = $Month_4->fetch(PDO::FETCH_ASSOC);

                    // query ยอดซื้อ Month-4 จากเดือนปัจจุบัน
                    $Month_4_buy = $conn->query("SELECT SUM(sum) AS monthTotal FROM bill_head
                                                 WHERE report = 'N' AND vat = 0 AND MONTH(buy_date) = MONTH(CURRENT_DATE() - INTERVAL 4 MONTH)
                                                 AND YEAR(buy_date) = YEAR(CURRENT_DATE() - INTERVAL 4 MONTH)");
                    $Month_4_buy->execute();
                    $monthBuy4 = $Month_4_buy->fetch(PDO::FETCH_ASSOC);

                    if ($Month_4->rowCount() >= 1) {

                ?>

                <div class="col-xl-4 col-md-12 mb-3">
                    <form action="../db/db_filterTaxSummary_novat.php" method="POST">
                    <div class="card" style="background-color: #f9f4f5">
                        <div class="fw-bold text-center border p-2 bg-dark text-light rounded"><?php echo date("m/Y", strtotime($month4['buy_date'])); ?></div>
                            <div class="card-body">
                                <div class="d-flex flex-row justify-content-between">
                                    <h5 ><i class="fa-solid fa-sack-dollar text-success"></i> ยอดซื้อ</h5>
                                    <h3 class="mb-0 fw-bold"><?php echo number_format($monthBuy4['monthTotal'], 2); ?></h3>
                                </div>
                            <br>
                            <input type="hidden" name="thisMonth" value="<?php echo date("Y-m", strtotime($month4['buy_date'])); ?>">
                            <button type="submit" name="this_billNOVAT" class="btn btn-sm btn-outline-success w-100">เลือก</button>
                        </div>
                    </div>
                    </form>
                </div>
                <?php } else { ?>

                <div class="col-xl-4 col-md-12 mb-3">
                    <div class="card" style="background-color: #f9f4f5">
                        <div class="fw-bold text-center border p-2 bg-dark text-light rounded">--/----</div>
                            <div class="card-body">
                                <div class="d-flex flex-row justify-content-between">
                                    <h5 ><i class="fa-solid fa-sack-dollar text-success"></i> ยอดซื้อ</h5>
                                    <h3 class="mb-0 fw-bold">0</h3>
                                </div>
                            <br>
                            <button type="submit" class="btn btn-sm btn-outline-success w-100 disabled">ไม่พบรายการซื้อ</button>
                        </div>
                    </div>
                </div>

                <?php } ?>


                <?php

                    // query Month-5 จากเดือนปัจจุบัน
                    $Month_5 = $conn->query("SELECT * FROM bill_head
                                             WHERE report = 'N' AND vat = 0 AND MONTH(buy_date) = MONTH(CURRENT_DATE() - INTERVAL 5 MONTH)
                                             AND YEAR(buy_date) = YEAR(CURRENT_DATE() - INTERVAL 5 MONTH)");
                    $Month_5->execute();
                    $month5 = $Month_5->fetch(PDO::FETCH_ASSOC);

                    // query ยอดซื้อ Month-5 จากเดือนปัจจุบัน
                    $Month_5_buy = $conn->query("SELECT SUM(sum) AS monthTotal FROM bill_head
                                                 WHERE report = 'N' AND vat = 0 AND MONTH(buy_date) = MONTH(CURRENT_DATE() - INTERVAL 5 MONTH)
                                                 AND YEAR(buy_date) = YEAR(CURRENT_DATE() - INTERVAL 5 MONTH)");
                    $Month_5_buy->execute();
                    $monthBuy5 = $Month_5_buy->fetch(PDO::FETCH_ASSOC);

                    if ($Month_5->rowCount() >= 1) {

                ?>

                <div class="col-xl-4 col-md-12 mb-3">
                    <form action="../db/db_filterTaxSummary_novat.php" method="POST">
                    <div class="card" style="background-color: #f9f5f5">
                        <div class="fw-bold text-center border p-2 bg-dark text-light rounded"><?php echo date("m/Y", strtotime($month5['buy_date'])); ?></div>
                            <div class="card-body">
                                <div class="d-flex flex-row justify-content-between">
                                    <h5 ><i class="fa-solid fa-sack-dollar text-success"></i> ยอดซื้อ</h5>
                                    <h3 class="mb-0 fw-bold"><?php echo number_format($monthBuy5['monthTotal'], 2); ?></h3>
                                </div>
                            <br>
                            <input type="hidden" name="thisMonth" value="<?php echo date("Y-m", strtotime($month5['buy_date'])); ?>">
                            <button type="submit" name="this_billNOVAT" class="btn btn-sm btn-outline-success w-100">เลือก</button>
                        </div>
                    </div>
                    </form>
                </div>
                <?php } else { ?>

                <div class="col-xl-4 col-md-12 mb-3">
                    <div class="card" style="background-color: #f9f4f5">
                        <div class="fw-bold text-center border p-2 bg-dark text-light rounded">--/----</div>
                            <div class="card-body">
                                <div class="d-flex flex-row justify-content-between">
                                    <h5 ><i class="fa-solid fa-sack-dollar text-success"></i> ยอดซื้อ</h5>
                                    <h3 class="mb-0 fw-bold">0</h3>
                                </div>
                            <br>
                            <button type="submit" class="btn btn-sm btn-outline-success w-100 disabled">ไม่พบรายการซื้อ</button>
                        </div>
                    </div>
                </div>

                <?php } ?>


                <?php

                    // query Month-6 จากเดือนปัจจุบัน
                    $Month_6 = $conn->query("SELECT * FROM bill_head
                                            WHERE report = 'N' AND vat = 0 AND MONTH(buy_date) = MONTH(CURRENT_DATE() - INTERVAL 6 MONTH)
                                            AND YEAR(buy_date) = YEAR(CURRENT_DATE() - INTERVAL 6 MONTH)");
                    $Month_6->execute();
                    $month6 = $Month_6->fetch(PDO::FETCH_ASSOC);

                    // query ยอดซื้อ Month-6 จากเดือนปัจจุบัน
                    $Month_6_buy = $conn->query("SELECT SUM(sum) AS monthTotal FROM bill_head
                                                WHERE report = 'N' AND vat = 0 AND MONTH(buy_date) = MONTH(CURRENT_DATE() - INTERVAL 6 MONTH)
                                                AND YEAR(buy_date) = YEAR(CURRENT_DATE() - INTERVAL 6 MONTH)");
                    $Month_6_buy->execute();
                    $monthBuy6 = $Month_6_buy->fetch(PDO::FETCH_ASSOC);

                    if ($Month_6->rowCount() >= 1) {
                ?>

                <div class="col-xl-4 col-md-12 mb-3">
                    <form action="../db/db_filterTaxSummary_novat.php" method="POST">
                    <div class="card" style="background-color: #f9f5f5">
                        <div class="fw-bold text-center border p-2 bg-dark text-light rounded"><?php echo date("m/Y", strtotime($month6['buy_date'])); ?></div>
                            <div class="card-body">
                                <div class="d-flex flex-row justify-content-between">
                                    <h5 ><i class="fa-solid fa-sack-dollar text-success"></i> ยอดซื้อ</h5>
                                    <h3 class="mb-0 fw-bold"><?php echo number_format($monthBuy6['monthTotal'], 2); ?></h3>
                                </div>
                            <br>
                            <input type="hidden" name="thisMonth" value="<?php echo date("Y-m", strtotime($month6['buy_date'])); ?>">
                            <button type="submit" name="this_billNOVAT" class="btn btn-sm btn-outline-success w-100">เลือก</button>
                        </div>
                    </div>
                    </form>
                </div>
                <?php } else { ?>
                    
                    <div class="col-xl-4 col-md-12 mb-3">
                        <div class="card" style="background-color: #f9f4f5">
                            <div class="fw-bold text-center border p-2 bg-dark text-light rounded">--/----</div>
                                <div class="card-body">
                                    <div class="d-flex flex-row justify-content-between">
                                        <h5 ><i class="fa-solid fa-sack-dollar text-success"></i> ยอดซื้อ</h5>
                                        <h3 class="mb-0 fw-bold">0</h3>
                                    </div>
                                <br>
                                <button type="submit" class="btn btn-sm btn-outline-success w-100 disabled">ไม่พบรายการซื้อ</button>
                            </div>
                        </div>
                    </div>
                <?php } ?>
            </div>
    </section>

</body>
</html>
