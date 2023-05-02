<?php

    require_once "../include/dependency.php";
    require_once "../include/header.php";
    require_once "../db/config/deleteRow.php";


    // fetch ไซต์งาน ไปแสดงในฟอร์ม
    // $site = $conn->prepare("SELECT DISTINCT site_name FROM bill_head");
    // $site->execute();
    // $siteName = $site->fetchAll();

?>

<head>

    <!-- script Data Tables ห้ามลบจ้า -->
    <script>
        $(document).ready( function () {
            $('#myTable').DataTable();
        } );
    </script>


    <!-- Custom CSS ค้นหา -->
    <script src="../resources/lib/dselect.js"></script>

</head>
<body>


<section class="container mt-2">
        <div class="container border border-3 border-light bg-secondary shadow-sm">                        

                <legend class="fw-bold text-dark text-center p-2">กระจายค่าใช้จ่าย </legend>

                <form method="POST">
                    <div class="row">
                        
                    <div class="col-md-4">
                        

                        <label for="selectMonth" class="form-label fw-bold">เดือน :</label>
                            <select class="form-select" name="selectMonth" id="selectMonth" required>
                            <?php 
                            $sumDiff = $_SESSION['Total_billLine'] - $_SESSION['lineTotal'];
                            
                            ?>
                                
                                <?php

                                    $monthInfo = $conn->prepare("SELECT id,month_name FROM month_info");
                                    $monthInfo->execute();
                                    $month = $monthInfo->fetchAll();
                                   ?>

                                        <option value="">เลือกเดือน</option>
                                        <?php
                                    foreach($month as $monthName) {
                                        echo '<option value="'.$monthName["id"]. ' ">'.$monthName["month_name"].'</option>';
                                    }
                                   
                                    
                                
                                
                                
                                ?>
                            </select>

                        



                    </div>
                        <div class="col-md-1" style="margin-top: 32px;">
                            <button type="submit" class="btn btn-light w-100"><i class="fa-solid fa-magnifying-glass"></i> ค้นหา</button>
                        </div>
                    

                <?php

                    if (isset($_POST['selectMonth'])) {
                        $getMonth = $_POST['selectMonth'];
                        $stmt = $conn->query("SELECT SUM(total) AS headSum FROM bill_head WHERE MONTH(buy_date) = '$getMonth'");
                        $sumMonth = $stmt->fetch(PDO::FETCH_ASSOC);

                ?>
                        <div class="col-md-3">
                            <label for="disperseSum" class="form-label fw-bold">ยอดกระจายค่าใช้จ่าย :</label>
                            <input type="number" class="form-control" name="disperseSum" id="disperseSum" value="<?php echo $sumMonth['headSum']; ?>" readonly required style="background-color: rgb(235, 235, 235);">
                        </div>

                        <div class="col-md-3">
                            <label for="monthSum" class="form-label fw-bold">ยอดรวม :</label>
                            <input type="number" class="form-control" name="monthSum" id="monthSum" value="<?php echo $sumMonth['headSum']; ?>" readonly required style="background-color: rgb(235, 235, 235);">
                        </div>
                    </div>
                    </form>
                    <!-- แถว 2 -->
                    <!-- <form method="POST" id="formRow2"> -->
                        <div class="row ">
                            <div class="col-md-5">
                                <label for="selectSite" class="form-label fw-bold">เลือกไซต์งาน :</label>
                            </div>
                            <div class="col-md-3">
                                <label for="inputPercent" class="form-label fw-bold">กระจายค่าใช้จ่าย(%) :</label>
                            </div>
                            <div class="col-md-3">
                                <label for="disperseSum" class="form-label fw-bold">ยอดรวม(ไซต์งาน) :</label>
                            </div>
                        </div>
                        <div class="row" id="item_fields">
                            <div class="col-md-5">
                            <select class="form-select" name="selectSite" id="selectSite" required>
                            
                                
                            <?php

                                $siteInfo = $conn->prepare("SELECT id,site_name FROM site_info");
                                $siteInfo->execute();
                                $site = $siteInfo->fetchAll();
                               ?>

                                    <option value="">เลือกไซต์งาน</option>
                                    <?php
                                foreach($site as $siteName) {
                                    echo '<option value="'.$siteName["id"]. ' ">'.$siteName["site_name"].'</option>';
                                }
                               
                                
                            
                            
                            
                            ?>
                        </select>

                            </div>
                            <div class="col-md-3">
                                <input type="number" class="form-control" name="inputPercent[]" id="inputPercent" required>
                            </div>
                            <div class="col-md-3">
                                <input type="number" class="form-control" name="disperseSum[]" id="disperseSum" value="<?php //echo $calcPercent; ?>" required readonly style="background-color: rgb(235, 235, 235);">
                            </div>
                            <div class="col-md-1">

                            </div>
                        </div>

                        <!-- แถว 3 -->
                        <div class="row">
                            <div class="col-md-5">
                                <button type="button" class="btn btn-light mt-2 w-100" id="add-item-btn" onclick="addRows()"><i class="fa-solid fa-plus"></i> Add Site</button>
                            </div>
                        </div>

                        <!-- แถว 4 -->
                        <div class="row mt-2">
                            <div class="col">
                                <button type="submit" name="saveDisperse" class="btn btn-success mt-2 w-100">Save</button>
                            </div>
                        </div>



                            <!-- <div class="col-md-1" style="margin-top: 32px;">
                                <button type="submit" class="btn btn-primary w-100">คำนวณ</button>
                            </div> -->
                        <!-- </form> -->

                            <?php

                                // } else if (isset($_POST['selectSite'])) {
                                //     $getSite = $_POST['selectSite'];
                                //     $getPercent = intval($_POST['inputPercent']);

                                        // คำนวณยอดกระจายค่าใช้จ่าย เฉพาะไซต์งานที่เลือก
                                //     $stmt = $conn->query("SELECT SUM(total) AS siteTotal FROM bill_head WHERE site_name ='$getSite'");
                                //     $siteTotal = $stmt->fetch(PDO::FETCH_ASSOC);
                                //     $getSiteTotal = intval($siteTotal['siteTotal']);

                                //     $calcPercent = ($getPercent / 100) * $getSiteTotal;
                                
                            ?>

                <?php } ?>
            
        </div>
    </section>




    <!-- ส่วนตาราง -->
    <section class="container my-3">
        <div class="card px-4">
            <div class="card-body">



            <table class="table table-sm table-striped table-hover shadow-sm css-serial" id="myTable">
                <thead>
                    <tr>
                        <th scope="col" style="text-align:center;">#</th>
                        <th scope="col" style="text-align:center;">เดือน</th>
                        <th scope="col" style="text-align:center;">ไซต์งาน</th>
                        <th scope="col" style="text-align:center;">จำนวน</th>
                        <th scope="col" style="text-align:center;">แก้ไข/ลบ</th>
                    </tr>
                </thead>
                <tbody>


                <?php

                    // // query ตาราง
                    // $stmt = $conn->query("SELECT * FROM bill_line WHERE receipt_no = '$selectedValue'");
                    // $stmt->execute();
                    // $bill = $stmt->fetchAll();

                    // foreach ($bill as $fetch_bill) {
                                
                ?>

                    <tr style="text-align:center;">
                        <td></td>
                        <td><?php //echo $fetch_bill['receipt_no']; ?></td>
                        <td><?php //echo $fetch_bill['item_name']; ?></td>
                        <td><?php //echo $fetch_bill['qty']; ?></td>
                        <td>
                            <div class="btn-group" role="group" aria-label="Basic outlined example">
                                <button type="button" class="btn btn-sm btn-outline-dark" data-bs-toggle="modal" data-bs-target="#modalEditDisperse<?php //echo $fetch_bill['id']; ?>"><i class="fas fa-edit"></i></button>
                                <button type="button" class="btn btn-sm btn-outline-danger" data-bs-toggle="modal" data-bs-target="#modalDeleteDisperse<?php //echo $fetch_bill['id']; ?>"><i class="fas fa-trash"></i></button>
                            </div>
                        </td>
                    </tr>


                    <!-- Modal Edit Disperse -->
                    <div class="modal fade" id="modalEditDisperse<?php //echo $fetch_bill['id']; ?>" tabindex="-1" aria-labelledby="modalEditBill" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="modalEditBill"><i class="fa-solid fa-pen-to-square"></i> แก้ไขรายการกระจายค่าใช้จ่าย</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>

                                <div class="modal-body">
                                    <form action="" method="POST">
                                        <div class="mb-0">
                                            <input type="hidden" class="form-control" name="id" value="<?php //echo $fetch_bill['id']; ?>" readonly required>
                                            <label for="editMonth" class="form-label">เดือน :</label>
                                            <select class="form-select" name="editMonth" id="editMonth" required>
                                                <option value="01">มกราคม</option>
                                                <option value="02">กุมภาพันธ์</option>
                                                <option value="03">มีนาคม</option>
                                                <option value="04">เมษายน</option>
                                                <option value="05">พฤษภาคม</option>
                                                <option value="06">มิถุนายน</option>
                                                <option value="07">กรกฎาคม</option>
                                                <option value="08">สิงหาคม</option>
                                                <option value="09">กันยายน</option>
                                                <option value="10">ตุลาคม</option>
                                                <option value="11">พฤศจิกายน</option>
                                                <option value="12">ธันวาคม</option>
                                            </select>
                                        </div>
                                        <div class="mb-0">
                                            <label for="editSite" class="col-form-label">ไซต์งาน :</label>
                                            <input type="text" class="form-control" name="editSite" id="editSite" list="selectSite2" value="<?php //echo $fetch_bill['item_name']; ?>" required>
                                        </div>
                                        <div class="mb-0">
                                            <label for="editSum" class="col-form-label">จำนวน :</label>
                                            <input type="number" class="form-control" name="editSum" id="editSum" value="<?php //echo $fetch_bill['qty']; ?>" required>
                                        </div>

                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                            <button type="submit" class="btn btn-dark w-25" name="editDisperse"><i class="fa-solid fa-floppy-disk"></i> Save</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>


                    <!-- Modal ยืนยันลบข้อมูล ห้ามลบ -->
                    <div class="modal fade" id="modalDeleteDisperse<?php //echo $fetch_bill['id']; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title fw-bold"> ลบรายการกระจายค่าใช้จ่าย</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <h6 class="text-center">กรุณายืนยันการลบรายการ : <?php //echo $fetch_bill['item_name']; ?></h6>
                                    <p class="text-center">ยอดรวม : <?php //echo number_format(($fetch_bill['total']), 2); ?> บาท</p>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">ยกเลิก</button>
                                    <a data-id="<?php //echo $fetch_bill['id']; ?>" href="?deleteDisperse=<?php //echo $fetch_bill['id']; ?>" class="btn btn-danger"><i class="fas fa-trash"></i> ยืนยัน</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php //} } ?>
                </tbody>
            </table>




            </div>
        </div>
    </section>



    <!-- script Add InputField -->
    <script>
		function addRows() {
			var div = document.createElement("div");
            // var uniqueId = Date.now(); // Generate a unique ID for each row
			div.innerHTML = '<div class="row">' +
                                '<div class="col-md-5 mt-2">' +
                                    '<input type="text" class="form-control" name="selectSite[]" id="selectSite" list="selectSite2" required>' +
                                '</div>' +
                                '<div class="col-md-3 mt-2">' +
                                    '<input type="number" class="form-control" name="inputPercent[]" id="inputPercent" required>' +
                                '</div>' +
                                '<div class="col-md-3 mt-2">' +
                                    '<input type="number" class="form-control" name="disperseSum[]" id="disperseSum" required readonly style="background-color: rgb(235, 235, 235);">' +
                                '</div>' +
                                '<div class="col-md-1 mt-2">' +
                                    '<button type="button" class="btn btn-danger" onclick="removeItem(this)" tabindex="-1"><i class="fas fa-trash"></i></button>' +
                                '</div>';
			document.getElementById("item_fields").appendChild(div);
		}
		
        function removeItem(button) {
            var row = button.parentNode.parentNode;
            row.parentNode.removeChild(row);
        }
	</script>



    <!-- Autocomplete -->
    <datalist id="selectSite2">
        <?php
            $stmt = $conn->query("SELECT DISTINCT site_name FROM bill_head");
            $stmt->execute();
            $siteSearch = $stmt->fetchAll();

            if (!$siteSearch) {            
            
            } else {
                foreach ($siteSearch as $fetch_site) {
        ?>

        <option value="<?php echo $fetch_site['site_name']; ?>"></option>
        <?php } } ?>
    </datalist>


    
    <!-- สคริป ค้นหาเดือน -->
    <script>
        var select_box_element_month = document.querySelector('#selectMonth');
        dselect(select_box_element_month, {
            search: true
        });
    </script>

    <!-- สคริป ค้นหาไซต์งาน -->
    <script>
        var select_box_element_site = document.querySelector('#selectSite');
        dselect(select_box_element_site, {
            search: true
        });
    </script>


</body>
</html>

