<?php
session_start();
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

    <?php
        // Alert กระจายค่าใช้จ่ายเกิน 100%
        if(isset($_SESSION['overDisperse'])) {
            echo "<div class='alert alert-danger alert-dismissible fade show mt-2' role='alert'>";
            echo "<button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>";
            echo $_SESSION['overDisperse'];
            unset($_SESSION['overDisperse']);
            echo "</div>";
        }
    ?>

        <div class="container border border-3 border-light bg-secondary shadow-sm">                        
            <legend class="fw-bold text-dark text-center p-2">กระจายค่าใช้จ่าย</legend>

            <form action="../db/db_disperseCost.php" method="POST">
                <div class="row">
                    <div class="col-md-3">
                        <label for="selectHO" class="form-label fw-bold">สำนักงานใหญ่ :</label>
                        <select class="form-select" name="selectHO" id="selectHO" required>
                        <?php

                            $siteInfo = $conn->prepare("SELECT id,site_name FROM site_info WHERE site_abbre = 'HO' ");
                            $siteInfo->execute();
                            $site = $siteInfo->fetchAll();
                         
                            if ($_SESSION['headOffice']=="") {

                        ?>
                                     
                        <option value="">เลือกสำนักงานใหญ่</option>
                        <?php

                            foreach($site as $headOffice) {
                                echo '<option value="'.$headOffice["site_name"]. ' ">'.$headOffice["site_name"].'</option>';
                            }

                            } else {
                                echo '<option value="' .$_SESSION["headOffice"]. '">' .$_SESSION["headOffice"]. '</option>';
                                         
                                foreach($site as $headOffice) {
                                    echo '<option value="'.$headOffice["site_name"]. ' ">'.$headOffice["site_name"].'</option>';
                                }
                            }
                            
                        ?>
                        </select>
                    </div>


                    <div class="col-md-2">
                        <label for="selectMonth" class="form-label fw-bold">เดือน :</label>
                        <select class="form-select" name="selectMonth" id="selectMonth" required>
                        <?php

                            $sumDiff = $_SESSION['Total_billLine'] - $_SESSION['lineTotal'];
                                
                        ?>
                                    
                        <?php

                            echo $_SESSION["id"];
                            echo $_SESSION["Month"];

                            $monthInfo = $conn->prepare("SELECT id, month_name FROM month_info");
                            $monthInfo->execute();
                            $month = $monthInfo->fetchAll();

                            if ($_SESSION['Month']=="") {

                        ?>
                                    
                        <option value="">เลือกเดือน</option>

                        <?php

                            foreach($month as $monthName) {
                                echo '<option value="'.$monthName["id"]. ' ">'.$monthName["month_name"].'</option>';
                            } 

                        } else {
                            echo '<option value="' .$_SESSION["id"]. '">' .$_SESSION["Month"]. '</option>';
                                        
                            foreach($month as $monthName) {
                                echo '<option value="'.$monthName["id"]. ' ">'.$monthName["month_name"].'</option>';
                            }
                        }

                        ?>
                        </select>
                    </div>


                    <div class="col-md-1" style="margin-top: 32px;">
                        <button type="submit" class="btn btn-light w-100"><i class="fa-solid fa-magnifying-glass"></i> ค้นหา</button>
                    </div>
            </form>

                    <div class="col-md-2">
                        <label for="headSum" class="form-label fw-bold">รวมกระจายค่าใช้จ่าย(%) :</label>
                        <?php
                            if(empty($_SESSION['Percent'])) {
                                echo '<input type="number" class="form-control" name="headSum" id="headSum" value="0" readonly required style="background-color: rgb(235, 235, 235);">';
                            } else {
                                echo '<input type="number" class="form-control" name="headSum" id="headSum" value="' .$_SESSION['Percent']. '" readonly required style="background-color: rgb(235, 235, 235);">';
                            }
                        ?>
                        <!-- <input type="number" class="form-control" name="headSum" id="headSum" value="<?php //echo $_SESSION['Percent']; ?>" readonly required style="background-color: rgb(235, 235, 235);"> -->
                    </div>
                    <div class="col-md-2">
                        <label for="headSum" class="form-label fw-bold">ยอดกระจายค่าใช้จ่าย :</label>
                        <?php
                            if(empty($_SESSION['Sum'])) {
                                echo '<input type="number" class="form-control" name="headSum" id="headSum" value="0" readonly required style="background-color: rgb(235, 235, 235);">';
                            } else {
                                echo '<input type="number" class="form-control" name="headSum" id="headSum" value="' .$_SESSION['Sum']. '" readonly required style="background-color: rgb(235, 235, 235);">';
                            }
                        ?>
                        <!-- <input type="number" class="form-control" name="headSum" id="headSum" value="<?php //echo $_SESSION['Sum']; ?>" readonly required style="background-color: rgb(235, 235, 235);"> -->
                    </div>

                    <div class="col-md-2">
                        <label for="monthSum" class="form-label fw-bold">ยอดรวม :</label>
                        <?php
                            if(empty($_SESSION['Total'])) {
                                echo '<input type="number" class="form-control" name="monthSum" id="monthSum" value="0" readonly required style="background-color: rgb(235, 235, 235);">';
                            } else {
                                echo '<input type="number" class="form-control" name="monthSum" id="monthSum" value="' .$_SESSION['Total']. '" readonly required style="background-color: rgb(235, 235, 235);">';
                            }
                        ?>
                        <!-- <input type="number" class="form-control" name="monthSum" id="monthSum" value="<?php //echo $_SESSION['Total']; ?>" readonly required style="background-color: rgb(235, 235, 235);"> -->
                    </div>
                </div>


                <form action="../db/db_disperseCost.php"  method="POST" onSubmit="JavaScript:return fncSubmit();">

                    <!-- แถว 2 -->
                    <div class="row ">
                        <div class="col-md-6">
                            <label for="selectSite" class="form-label fw-bold">เลือกไซต์งาน :</label>
                        </div>
                        <div class="col-md-2">
                            <label for="inputPercent" class="form-label fw-bold">กระจายค่าใช้จ่าย(%) :</label>
                        </div>
                        <div class="col-md-4">
                            <label for="txtSum" class="form-label fw-bold">ยอด(ไซต์งาน) :</label>
                        </div>
                    </div>
                    <div class="row" id="item_fields">
                        <div class="col-md-6">
                            <select class="form-select" name="selectSite" id="selectSite" required>
                            <?php

                                // code เดิม
                                $siteInfo = $conn->prepare("SELECT id, site_name FROM site_info WHERE site_abbre != 'HO' ");

                                // modified code inner join เช็ค spread_cost = 'N' จาก site_name ดึงชื่อมาจาก site_info
                                // $siteInfo = $conn->prepare("SELECT si.id, si.site_name 
                                //                             FROM site_info si
                                //                             INNER JOIN bill_head bh ON si.site_name = bh.site_name
                                //                             WHERE si.site_abbre != 'HO' AND bh.spread_cost = 'N'");

                                $siteInfo->execute();
                                $site = $siteInfo->fetchAll();

                            ?>

                                <option value="">เลือกไซต์งาน</option>

                                <?php

                                    foreach($site as $siteName) {
                                        echo '<option value="'.$siteName["site_name"]. ' ">'.$siteName["site_name"].'</option>';
                                    }
                            
                                ?>
                            </select>
                        </div>

                        <div class="col-md-2">
                            <input type="number" class="form-control" name="CalPercent" id="CalPercent" autocomplete="off" oninput="calDisperse()" min="0" max="100" maxlength="3" required>
                        </div>
                        <div class="col-md-4">
                            <input type="number" class="form-control" name="SiteSum" id="SiteSum" autocomplete="off" oninput="calPercent()" required>
                        </div>
                        <div class="col-md-1">

                        </div>
                    </div>


                    <!-- แถว 3 -->
                    <div class="row mt-2">
                        <div class="col">
                            <?php
                                if(empty($_SESSION['Percent'])) {
                                    echo '<input type="hidden" name="sumPercent" value="0">';
                                } else {
                                    echo '<input type="hidden" name="sumPercent" value="' .$_SESSION['Percent']. '">';
                                }
                            ?>
                            <!-- <input type="hidden" name="sumPercent" value="<?php //echo $_SESSION['Percent']; ?>"> -->
                            <button type="submit" name="saveDisperse" class="btn btn-success mt-2 w-100">บันทึก</button>
                        </div>
                    </div>
                </form>
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
                        <th scope="col" style="text-align:center;">ไซต์งาน</th>
                        <th scope="col" style="text-align:center;">กระจายค่าใช้จ่าย(%)</th>
                        <th scope="col" style="text-align:center;">ยอดรวม</th>
                        <th scope="col" style="text-align:center;">สำนักงานใหญ่</th>
                        <th scope="col" style="text-align:center;">เดือน</th>
                        <th scope="col" style="text-align:center;">ลบ</th>
                    </tr>
                </thead>
                <tbody>

                <!-- query ตาราง -->
                <?php
                    // if($_SESSION['headOffice']==null){
                    if(empty($_SESSION['headOffice'])) {
                        $stmt = $conn->query("SELECT * FROM disperse_info ");
                    
                    }else{
                        $Month = $_SESSION['Month'];
                        $headOffice = $_SESSION['headOffice'];
                        $stmt = $conn->query("SELECT * FROM disperse_info WHERE office_name = '$headOffice' AND month = '$Month'");

                    }
                    $stmt->execute();
                    $disperse = $stmt->fetchAll();
                    foreach ($disperse as $fetch_disperse) {
                                
                ?>

                    <tr style="text-align:center;">
                        <td></td>
                        <td><?php echo $fetch_disperse['disperse_site']; ?></td>
                        <td><?php echo $fetch_disperse['disperse_percent']; ?></td>
                        <td><?php echo $fetch_disperse['disperse_sum']; ?></td>
                        <td><?php echo $fetch_disperse['office_name']; ?></td>
                        <td><?php echo $fetch_disperse['month']; ?></td>
                        <td>
                            <div class="btn-group" role="group" aria-label="Basic outlined example">
                                <!-- <button type="button" class="btn btn-sm btn-outline-dark" data-bs-toggle="modal" data-bs-target="#modalEditDisperse<?php //echo $fetch_bill['id']; ?>"><i class="fas fa-edit"></i></button> -->
                                <button type="button" class="btn btn-sm btn-outline-danger" data-bs-toggle="modal" data-bs-target="#modalDeleteDisperse<?php echo $fetch_disperse['id']; ?>"><i class="fas fa-trash"></i></button>
                            </div>
                        </td>
                    </tr>

                    <!-- Modal Edit Disperse -->
                    <!-- <div class="modal fade" id="modalEditDisperse<?php //echo $fetch_bill['id']; ?>" tabindex="-1" aria-labelledby="modalEditBill" aria-hidden="true">
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
                    </div> -->


                    <!-- Modal ยืนยันลบข้อมูล ห้ามลบ -->
                    <div class="modal fade" id="modalDeleteDisperse<?php echo $fetch_disperse['id']; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title fw-bold"> ลบรายการกระจายค่าใช้จ่าย</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <h6 class="text-center"><?php echo $fetch_disperse['disperse_site']; ?> เดือน <?php echo $fetch_disperse['month']; ?></h6>
                                    <p class="text-center">กระจายค่าใช้จ่าย : <?php echo $fetch_disperse['disperse_percent']; ?> % <br>
                                    ยอดรวม : <?php echo number_format(($fetch_disperse['disperse_sum']), 2); ?> บาท</p>
                                </div>
                                <div class="modal-footer">
                                    <?php 
                                    
                                        $_SESSION['officeHO'] = $fetch_disperse['office_name'];
                                    
                                    ?>
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">ยกเลิก</button>
                                    <a data-id="<?php echo $fetch_disperse['id']; ?>" href="?deleteDisperse=<?php echo $fetch_disperse['id']; ?>" class="btn btn-danger"><i class="fas fa-trash"></i> ยืนยัน</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php } ?>
                </tbody>
            </table>




            </div>
        </div>
    </section>



    <script>
        const inputField = document.getElementById("CalPercent");
        inputField.addEventListener("input", function() {
            if (this.value < 0) {
                this.value = 0;
            } else if (this.value > 100) {
                this.value = 100;
            }
        });
    </script>


    <!-- check ถ้า headSum = 100 disable button -->
    <script>
        const headSum = document.getElementById("headSum");
        const submitButton = document.querySelector('button[name="saveDisperse"]');

        if (headSum.value === "100") {
            submitButton.disabled = true;
        }

        // Listen for changes in headSum value
        headSum.addEventListener("input", handleInputChange);

        function handleInputChange() {
            if (headSum.value === "100") {
            submitButton.disabled = true;
            } else {
            submitButton.disabled = false;
            }
        }
    </script>

  
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

   <!-- สคริป ค้นหาสำนักงานใหญ่ -->
   <script>
        var select_box_element_head_office = document.querySelector('#selectHO');
        dselect(select_box_element_head_office, {
            search: true
        });
    </script>

    
    <script>
        // function calDisperse() {
        //     var total = document.getElementById("monthSum").value;;
        //     var percent = document.getElementById("CalPercent").value;
        //     var disperse =  total * percent/100;
        //     document.getElementById("SiteSum").value = disperse.toFixed(2);
           
        // }

        // rewrite check ถ้า input > 100 ให้ calculate ที่ 100
        function calDisperse() {
            const total = document.getElementById("monthSum").value;
            let percent = document.getElementById("CalPercent").value;
            if (percent > 100) {
                percent = 100;
                document.getElementById("CalPercent").value = percent;
            }
            const disperse = total * percent / 100;
            document.getElementById("SiteSum").value = disperse.toFixed(2);
        }
    </script>

    <script>
        function calPercent() {
            var total = document.getElementById("monthSum").value;;
            var siteSum = document.getElementById("SiteSum").value;
            var percent =  siteSum/total * 100;
            document.getElementById("CalPercent").value = percent
           
        }
    </script>
    

    <script language="javascript">
        function fncSubmit()
        {
            for(i=1;i<=document.form1.hdnLine.value;i  )
            {
                if(eval("document.form1.txtName" i ".value.length") <5)
                {
                    alert("incorrect format in box " i " Thank.");
                    eval("document.form1.txtName" i ".focus();")
                    return false;
                }
            }
            document.form1.submit();
        }
    </script>
</body>
</html>
