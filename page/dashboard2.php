<?php
    require_once "../include/header.php";
    require_once "../db/db_dashboard.php";    
?>

<!DOCTYPE html>
<html lang="en">
<head>

    <style>
        /* div.headReport {
            /* text-align: left; */
            /* background-color: #0d1821; */
            /* border-radius: 5px; */
        /* } */
    </style>

</head>
<body>



    <section class="container mt-3">
        <div class="card">
            <div class="card-body">  
                <div class="headReport">
                    <h5 class="fw-bold p-2 text-center">กรุณาเลือกข้อมูล | ออกบิล VAT</h5>
                </div>


                <div class="row">

                    <div class="col-xl-4 col-md-12 mb-3">
                        <div class="card" style="background-color: #f9f4f5">
                            <div class="card-body">
                                <div class="d-flex">
                                    <img src="../image/icon/cost.png" alt="" style="width: 100px;">
                                    <div class="container text-center mt-4">
                                        <h4 class="fw-bold"><?php echo "เดือนปัจจุบัน"; ?></h4>
                                    </div>
                                </div>
                                <hr>
                                <div class="d-flex flex-row justify-content-between">
                                    <h5><i class="fa-solid fa-hand-holding-dollar text-success"></i> ยอดซื้อ</h5>
                                    <h3 class="text-success fw-bold"><?php echo number_format(000, 2); ?></h3>
                                </div>
                                <div class="d-flex flex-row justify-content-between">
                                    <h5><i class="fa-solid fa-receipt text-danger"></i> VAT</h5>
                                    <h3 class="text-danger fw-bold"><?php echo number_format(000, 2); ?></h3>
                                </div>
                                <button type="submit" class="btn btn-sm btn-success w-100">ออกบิล VAT</button>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-4 col-md-12 mb-3">
                        <div class="card" style="background-color: #f8f7ff;">
                            <div class="card-body">
                                <div class="d-flex">
                                    <img src="../image/icon/cost.png" alt="" style="width: 100px;">
                                    <div class="container text-center mt-4">
                                        <h4 class="fw-bold"><?php echo "06/2566"; ?></h4>
                                    </div>
                                </div>
                                <hr>
                                <div class="d-flex flex-row justify-content-between">
                                    <h5><i class="fa-solid fa-hand-holding-dollar text-success"></i> ยอดซื้อ</h5>
                                    <h3 class="text-success fw-bold"><?php echo number_format(000, 2); ?></h3>
                                </div>
                                <div class="d-flex flex-row justify-content-between">
                                    <h5><i class="fa-solid fa-receipt text-danger"></i> VAT</h5>
                                    <h3 class="text-danger fw-bold"><?php echo number_format(000, 2); ?></h3>
                                </div>
                                <button type="submit" class="btn btn-sm btn-outline-success w-100">ออกบิล VAT</button>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-4 col-md-12 mb-3">
                        <div class="card" style="background-color: #f8f7ff;">
                            <div class="card-body">
                                <div class="d-flex">
                                    <img src="../image/icon/cost.png" alt="" style="width: 100px;">
                                    <div class="container text-center mt-4">
                                        <h4 class="fw-bold"><?php echo "05/2566"; ?></h4>
                                    </div>
                                </div>
                                <hr>
                                <div class="d-flex flex-row justify-content-between">
                                    <h5><i class="fa-solid fa-hand-holding-dollar text-success"></i> ยอดซื้อ</h5>
                                    <h3 class="text-success fw-bold"><?php echo number_format(000, 2); ?></h3>
                                </div>
                                <div class="d-flex flex-row justify-content-between">
                                    <h5><i class="fa-solid fa-receipt text-danger"></i> VAT</h5>
                                    <h3 class="text-danger fw-bold"><?php echo number_format(000, 2); ?></h3>
                                </div>
                                <button type="submit" class="btn btn-sm btn-outline-success w-100">ออกบิล VAT</button>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-4 col-md-12 mb-3">
                        <div class="card" style="background-color: #f8f7ff;">
                            <div class="card-body">
                                <div class="d-flex">
                                    <img src="../image/icon/cost.png" alt="" style="width: 100px;">
                                    <div class="container text-center mt-4">
                                        <h4 class="fw-bold"><?php echo "04/2566"; ?></h4>
                                    </div>
                                </div>
                                <hr>
                                <div class="d-flex flex-row justify-content-between">
                                    <h5><i class="fa-solid fa-hand-holding-dollar text-success"></i> ยอดซื้อ</h5>
                                    <h3 class="text-success fw-bold"><?php echo number_format(000, 2); ?></h3>
                                </div>
                                <div class="d-flex flex-row justify-content-between">
                                    <h5><i class="fa-solid fa-receipt text-danger"></i> VAT</h5>
                                    <h3 class="text-danger fw-bold"><?php echo number_format(000, 2); ?></h3>
                                </div>
                                <button type="submit" class="btn btn-sm btn-outline-success w-100">ออกบิล VAT</button>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-4 col-md-12 mb-3">
                        <div class="card" style="background-color: #f8f7ff;">
                            <div class="card-body">
                                <div class="d-flex">
                                    <img src="../image/icon/cost.png" alt="" style="width: 100px;">
                                    <div class="container text-center mt-4">
                                        <h4 class="fw-bold"><?php echo "03/2566"; ?></h4>
                                    </div>
                                </div>
                                <hr>
                                <div class="d-flex flex-row justify-content-between">
                                    <h5><i class="fa-solid fa-hand-holding-dollar text-success"></i> ยอดซื้อ</h5>
                                    <h3 class="text-success fw-bold"><?php echo number_format(000, 2); ?></h3>
                                </div>
                                <div class="d-flex flex-row justify-content-between">
                                    <h5><i class="fa-solid fa-receipt text-danger"></i> VAT</h5>
                                    <h3 class="text-danger fw-bold"><?php echo number_format(000, 2); ?></h3>
                                </div>
                                <button type="submit" class="btn btn-sm btn-outline-success w-100">ออกบิล VAT</button>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-4 col-md-12 mb-3">
                        <div class="card" style="background-color: #f8f7ff;">
                            <div class="card-body">
                                <div class="d-flex">
                                    <img src="../image/icon/cost.png" alt="" style="width: 100px;">
                                    <div class="container text-center mt-4">
                                        <h4 class="fw-bold"><?php echo "02/2566"; ?></h4>
                                    </div>
                                </div>
                                <hr>
                                <div class="d-flex flex-row justify-content-between">
                                    <h5><i class="fa-solid fa-hand-holding-dollar text-success"></i> ยอดซื้อ</h5>
                                    <h3 class="text-success fw-bold"><?php echo number_format(000, 2); ?></h3>
                                </div>
                                <div class="d-flex flex-row justify-content-between">
                                    <h5><i class="fa-solid fa-receipt text-danger"></i> VAT</h5>
                                    <h3 class="text-danger fw-bold"><?php echo number_format(000, 2); ?></h3>
                                </div>
                                <button type="submit" class="btn btn-sm btn-outline-success w-100">ออกบิล VAT</button>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-4 col-md-12 mb-3">
                        <div class="card" style="background-color: #f8f7ff;">
                            <div class="card-body">
                                <div class="d-flex">
                                    <img src="../image/icon/cost.png" alt="" style="width: 100px;">
                                    <div class="container text-center mt-4">
                                        <h4 class="fw-bold"><?php echo "01/2566"; ?></h4>
                                    </div>
                                </div>
                                <hr>
                                <div class="d-flex flex-row justify-content-between">
                                    <h5><i class="fa-solid fa-hand-holding-dollar text-success"></i> ยอดซื้อ</h5>
                                    <h3 class="text-success fw-bold"><?php echo number_format(000, 2); ?></h3>
                                </div>
                                <div class="d-flex flex-row justify-content-between">
                                    <h5><i class="fa-solid fa-receipt text-danger"></i> VAT</h5>
                                    <h3 class="text-danger fw-bold"><?php echo number_format(000, 2); ?></h3>
                                </div>
                                <button type="submit" class="btn btn-sm btn-outline-success w-100">ออกบิล VAT</button>
                            </div>
                        </div>
                    </div>





                </div>
            </div>
        </div>


    </section>
    <!-- <legend class="fw-bold"><i class="fa-solid "></i> บิล (VAT)</legend> -->
</body>
</html>
