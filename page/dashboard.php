<?php
    require_once "../include/header.php";
    require_once "../db/db_dashboard.php";    
?>

<!DOCTYPE html>
<html lang="en">
<head>
</head>
<body>


    <!-- pagename ห้ามลบ 
 
    <section class="container mt-2">
        <legend class="fw-bold text-dark text-center border border-3 border-light bg-secondary shadow-sm p-2">แดชบอร์ด</legend>
    </section>
-->
    <!-- pagename ห้ามลบ -->
    <section class="container mt-3">
        <div class="row">
            <div class="col-xl-3 col-md-12">
                <div class="card h-100">
                    <div class="card-body">
                        <div class="d-flex justify-content-between p-md-1">
                            <div class="d-flex flex-row">
                                <div class="align-self-center">
                                    <i class="fa-solid fa-building text-primary fa-3x me-4"></i>
                                </div>
                                <div class="d-flex align-items-center">
                                    <h6 class="fw-bold">ไซต์งาน</h6>
                                </div>
                            </div>
                            <div class="align-self-center">
                                <h6 class="mb-0"><?php echo $site_rowCount ?></h6>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-xl-3 col-md-12">
                <div class="card h-100">
                    <div class="card-body">
                        <div class="d-flex justify-content-between p-md-1">
                            <div class="d-flex flex-row">
                                <div class="align-self-center">
                                    <i class="fa-solid fa-gears fa-3x me-4"></i>
                                </div>
                                <div class="d-flex align-items-center">
                                    <h6 class="fw-bold">ค่าวัสดุ</h6>
                                </div>
                            </div>
                            <div class="align-self-center">
                                <h6 class="mb-0"><?php echo number_format(($materialSum),2) ?></h6>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-xl-3 col-md-12">
                <div class="card h-100">
                    <div class="card-body">
                        <div class="d-flex justify-content-between p-md-1">
                            <div class="d-flex flex-row">
                                <div class="align-self-center">
                                    <i class="fa-solid fa-person text-warning fa-3x me-4"></i>
                                </div>
                                <div class="d-flex align-items-center">
                                    <h6 class="fw-bold">ค่าแรง</h6>
                                </div>
                            </div>
                            <div class="align-self-center">
                                <h6 class="mb-0"><?php echo number_format(($labourSum),2) ?></h6>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-xl-3 col-md-12">
                <div class="card h-100">
                    <div class="card-body">
                        <div class="d-flex justify-content-between p-md-1">
                            <div class="d-flex flex-row">
                                <div class="align-self-center">
                                    <i class="fa-solid fa-wallet fa-3x text-success me-4"></i>
                                </div>
                                <div class="d-flex align-items-center">
                                    <h6 class="fw-bold">รวม</h6>
                                </div>
                            </div>
                            <div class="align-self-center">
                                <h6 class="mb-0"><?php echo number_format(($materialSum+$labourSum),2) ?></h6>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
       
    <br>

 
            <legend class="fw-bold"><i class="fa-solid "></i> บิล (VAT)</legend>
            <div class="row">
            <div class="col-xl-4 col-md-12 mb-2">
                   
                    <div class="card">
                    <div class="fw-bold text-center border p-2 bg-dark text-light rounded"><?php echo date("01/Y") ?></div>
                        <div class="card-body">                          
                                <div class="d-flex flex-row justify-content-between">
                                        <h5 ><i class="fa-solid fa-sack-dollar text-success"></i>  ยอดซื้อ</h5>
                                        <h3 class="mb-0 fw-bold"><?php echo number_format(($sumM01),2) ?>
                                </div>
                            <br>                          
                                <div class="d-flex flex-row justify-content-between">
                                        <h5 ><i class="fa-solid fa-receipt text-info"></i> VAT</h5>
                                        <h3 class="mb-0 fw-bold"><?php echo number_format(($vatM01),2) ?>
                                </div>
                            
                        </div>
                    </div>
                </div>

                <div class="col-xl-4 col-md-12 mb-2">
                    
                    <div class="card">
                    <div class="fw-bold text-center border p-2 bg-dark text-light rounded"><?php echo date("02/Y") ?></div>
                        <div class="card-body">                          
                                <div class="d-flex flex-row justify-content-between">
                                        <h5 ><i class="fa-solid fa-sack-dollar text-success"></i>  ยอดซื้อ</h5>
                                        <h3 class="mb-0 fw-bold"><?php echo number_format(($sumM02),2) ?>
                                </div>
                            <br>                          
                                <div class="d-flex flex-row justify-content-between">
                                        <h5 ><i class="fa-solid fa-receipt text-info"></i> VAT</h5>
                                        <h3 class="mb-0 fw-bold"><?php echo number_format(($vatM02),2) ?>
                                </div>
                            
                        </div>
                    </div>
                </div>
                <div class="col-xl-4 col-md-12 mb-2">
                    
                    <div class="card">
                    <div class="fw-bold text-center border p-2 bg-dark text-light rounded"><?php echo date("03/Y") ?></div>
                        <div class="card-body">                          
                                <div class="d-flex flex-row justify-content-between">
                                        <h5 ><i class="fa-solid fa-sack-dollar text-success"></i>  ยอดซื้อ</h5>
                                        <h3 class="mb-0 fw-bold"><?php echo number_format(($sumM03),2) ?>
                                </div>
                            <br>                          
                                <div class="d-flex flex-row justify-content-between">
                                        <h5 ><i class="fa-solid fa-receipt text-info"></i> VAT</h5>
                                        <h3 class="mb-0 fw-bold"><?php echo number_format(($vatM03),2) ?>
                                </div>
                            
                        </div>
                    </div>
                </div>
                
            </div>
            <div class="row">
            <div class="col-xl-4 col-md-12 mb-2">
                    
                    <div class="card">
                    <div class="fw-bold text-center border p-2 bg-dark text-light rounded"><?php echo date("04/Y") ?></div>
                        <div class="card-body">                          
                                <div class="d-flex flex-row justify-content-between">
                                        <h5 ><i class="fa-solid fa-sack-dollar text-success"></i>  ยอดซื้อ</h5>
                                        <h3 class="mb-0 fw-bold"><?php echo number_format(($sumM04),2) ?>
                                </div>
                            <br>                          
                                <div class="d-flex flex-row justify-content-between">
                                        <h5 ><i class="fa-solid fa-receipt text-info"></i> VAT</h5>
                                        <h3 class="mb-0 fw-bold"><?php echo number_format(($vatM04),2) ?>
                                </div>
                            
                        </div>
                    </div>
                </div>

                <div class="col-xl-4 col-md-12 mb-2">
                    
                    <div class="card">
                    <div class="fw-bold text-center border p-2 bg-dark text-light rounded"><?php echo date("05/Y") ?></div>
                        <div class="card-body">                          
                                <div class="d-flex flex-row justify-content-between">
                                        <h5 ><i class="fa-solid fa-sack-dollar text-success"></i>  ยอดซื้อ</h5>
                                        <h3 class="mb-0 fw-bold"><?php echo number_format(($sumM05),2) ?>
                                </div>
                            <br>                          
                                <div class="d-flex flex-row justify-content-between">
                                        <h5 ><i class="fa-solid fa-receipt text-info"></i> VAT</h5>
                                        <h3 class="mb-0 fw-bold"><?php echo number_format(($vatM05),2) ?>
                                </div>
                            
                        </div>
                    </div>
                </div>
                <div class="col-xl-4 col-md-12 mb-2">
                    
                    <div class="card">
                    <div class="fw-bold text-center border p-2 bg-dark text-light rounded"><?php echo date("06/Y") ?></div>
                        <div class="card-body">                          
                                <div class="d-flex flex-row justify-content-between">
                                        <h5 ><i class="fa-solid fa-sack-dollar text-success"></i>  ยอดซื้อ</h5>
                                        <h3 class="mb-0 fw-bold"><?php echo number_format(($sumM06),2) ?>
                                </div>
                            <br>                          
                                <div class="d-flex flex-row justify-content-between">
                                        <h5 ><i class="fa-solid fa-receipt text-info"></i> VAT</h5>
                                        <h3 class="mb-0 fw-bold"><?php echo number_format(($vatM06),2) ?>
                                </div>
                            
                        </div>
                    </div>
                </div>
                
            </div>
            <div class="row">
            <div class="col-xl-4 col-md-12 mb-2">
                   
                    <div class="card">
                    <div class="fw-bold text-center border p-2 bg-dark text-light rounded"><?php echo date("07/Y") ?></div>
                        <div class="card-body">                          
                                <div class="d-flex flex-row justify-content-between">
                                        <h5 ><i class="fa-solid fa-sack-dollar text-success"></i>  ยอดซื้อ</h5>
                                        <h3 class="mb-0 fw-bold"><?php echo number_format(($sumM07),2) ?>
                                </div>
                            <br>                          
                                <div class="d-flex flex-row justify-content-between">
                                        <h5 ><i class="fa-solid fa-receipt text-info"></i> VAT</h5>
                                        <h3 class="mb-0 fw-bold"><?php echo number_format(($vatM07),2) ?>
                                </div>
                            
                        </div>
                    </div>
                </div>

                <div class="col-xl-4 col-md-12 mb-2">
                    
                    <div class="card">
                    <div class="fw-bold text-center border p-2 bg-dark text-light rounded"><?php echo date("08/Y") ?></div>
                        <div class="card-body">                          
                                <div class="d-flex flex-row justify-content-between">
                                        <h5 ><i class="fa-solid fa-sack-dollar text-success"></i>  ยอดซื้อ</h5>
                                        <h3 class="mb-0 fw-bold"><?php echo number_format(($sumM08),2) ?>
                                </div>
                            <br>                          
                                <div class="d-flex flex-row justify-content-between">
                                        <h5 ><i class="fa-solid fa-receipt text-info"></i> VAT</h5>
                                        <h3 class="mb-0 fw-bold"><?php echo number_format(($vatM08),2) ?>
                                </div>
                            
                        </div>
                    </div>
                </div>
                <div class="col-xl-4 col-md-12 mb-2">
                   
                    <div class="card">
                    <div class="fw-bold text-center border p-2 bg-dark text-light rounded"><?php echo date("09/Y") ?></div>
                        <div class="card-body">                          
                                <div class="d-flex flex-row justify-content-between">
                                        <h5 ><i class="fa-solid fa-sack-dollar text-success"></i>  ยอดซื้อ</h5>
                                        <h3 class="mb-0 fw-bold"><?php echo number_format(($sumM09),2) ?>
                                </div>
                            <br>                          
                                <div class="d-flex flex-row justify-content-between">
                                        <h5 ><i class="fa-solid fa-receipt text-info"></i> VAT</h5>
                                        <h3 class="mb-0 fw-bold"><?php echo number_format(($vatM09),2) ?>
                                </div>
                            
                        </div>
                    </div>
                </div>
                
            </div>
            <div class="row">
            <div class="col-xl-4 col-md-12 mb-2">
                    
                    <div class="card">
                    <div class="fw-bold text-center border p-2 bg-dark text-light rounded"><?php echo date("10/Y") ?></div>
                        <div class="card-body">                          
                                <div class="d-flex flex-row justify-content-between">
                                        <h5 ><i class="fa-solid fa-sack-dollar text-success"></i>  ยอดซื้อ</h5>
                                        <h3 class="mb-0 fw-bold"><?php echo number_format(($sumM10),2) ?>
                                </div>
                            <br>                          
                                <div class="d-flex flex-row justify-content-between">
                                        <h5 ><i class="fa-solid fa-receipt text-info"></i> VAT</h5>
                                        <h3 class="mb-0 fw-bold"><?php echo number_format(($vatM10),2) ?>
                                </div>
                            
                        </div>
                    </div>
                </div>

                <div class="col-xl-4 col-md-12 mb-2">
                    
                    <div class="card">
                    <div class="fw-bold text-center border p-2 bg-dark text-light rounded"><?php echo date("11/Y") ?></div>
                        <div class="card-body">                          
                                <div class="d-flex flex-row justify-content-between">
                                        <h5 ><i class="fa-solid fa-sack-dollar text-success"></i>  ยอดซื้อ</h5>
                                        <h3 class="mb-0 fw-bold"><?php echo number_format(($sumM11),2) ?>
                                </div>
                            <br>                          
                                <div class="d-flex flex-row justify-content-between">
                                        <h5 ><i class="fa-solid fa-receipt text-info"></i> VAT</h5>
                                        <h3 class="mb-0 fw-bold"><?php echo number_format(($vatM11),2) ?>
                                </div>
                            
                        </div>
                    </div>
                </div>
                <div class="col-xl-4 col-md-12 mb-2">
                   
                    <div class="card">
                    <div class="fw-bold text-center border p-2 bg-dark text-light rounded"><?php echo date("12/Y") ?></div>
                        <div class="card-body">                          
                                <div class="d-flex flex-row justify-content-between">
                                        <h5 ><i class="fa-solid fa-sack-dollar text-success"></i>  ยอดซื้อ</h5>
                                        <h3 class="mb-0 fw-bold"><?php echo number_format(($sumM12),2) ?>
                                </div>
                            <br>                          
                                <div class="d-flex flex-row justify-content-between">
                                        <h5 ><i class="fa-solid fa-receipt text-info"></i> VAT</h5>
                                        <h3 class="mb-0 fw-bold"><?php echo number_format(($vatM12),2) ?>
                                </div>
                            
                        </div>
                    </div>
                </div>
                
            </div>


        
    </section>
    
</body>
</html>