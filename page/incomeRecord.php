<?php
    
    require_once "include/header.php";
    require_once "include/dependency.php";

        $site = $conn->prepare("SELECT* FROM site_info");
        $site->execute();
        $rs = $site->fetchAll();

        if (!isset($_SESSION['siteName_incomeHead'])) {
            header("location: incomeRecord.php");
        } else {

        // ดึง sitename จาก session
        $siteName = $_SESSION['siteName_incomeHead'];
        
?>


<!DOCTYPE html>
<html lang="en">

<head>
 <!-- script Datables ห้ามลบจ้า -->
 <script>
        $(document).ready( function () {
            $('#myTable').DataTable();
        } );
    </script>
</head>
<body>


    <!-- pagename ห้ามลบ -->
    <section class="container mt-2">
    <div class="fw-bold text-dark bg-secondary shadow-sm p-2 ">
        <legend class="fw-bold text-dark text-center  p-1"> บันทึกรายรับ </legend>
        <form action="../db/db_income.php" method="POST">
        <label class="form-label fw-bold" >ไซต์งาน :</label>
                <select name="addSiteName" class="form-control" required>
                    <?php if($_SESSION['siteName_incomeHead']=="") { ?>
                       <option value="" >--เลือกไซต์งาน--</option>
                       <?php foreach($rs as $row) { ?>
                          
                          <option value="<?=$row['site_name'];?>"><?=$row['site_name'];?></option>
                        <?php } ?>
                        <?php } else{
    ?>
                        <option value="<?php echo $_SESSION['siteName_incomeHead']; ?>" >--<?php echo $_SESSION['siteName_incomeHead']; ?>--</option>
                        <?php foreach($rs as $row) { ?>
                          
                          <option value="<?=$row['site_name'];?>"><?=$row['site_name'];?></option>
                        <?php } ?>
    <?php
                        }
                         
                        ?>
                     </select>
                    
                
                            <br>
    
                    
                        <div class="row">
                            <div class="col-md-2">
                                <label class="form-label fw-bold" for="addStartDate">วันที่เริ่ม :</label>
                                <input type="date" class="form-control" name="addStartDate" id="addStartDate" required>
                            
                            </div>
                            <div class="col-md-2">
                                <label class="form-label fw-bold" for="addFinishDate">วันที่สิ้นสุด :</label>
                                <input type="date" class="form-control" name="addFinishDate" id="addFinishDate" required>
                            </div>
                            <div class="col-md-2">
                                <label class="form-label fw-bold" for="addInstallment">จำนวนงวด :</label>
                                <input type="number" class="form-control" name="addInstallment" id="addInstallment" required>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label fw-bold" for="addSum">จำนวนเงินทั้งสิ้น :</label>
                                <input type="number" class="form-control" name="addSum" id="addSum" step="any" required>
                            </div>
                        </div>
    
                        <div class="row mt-4">
                            <div class="col-md">
                                <button type="submit" name="addIncome_head" class="btn btn-success w-100">บันทึก</button>
                            </div>
                        </div>
                    </form>


        </div>
    </section>

    <!-- Alert ห้ามลบ -->
    <section class="container">
        <div class="row">
            <div class="col-md">
            <?php
                // Alert เพิ่มรายการสำเร็จ
                if(isset($_SESSION['addIncomeHead_success'])) {
                    echo "<div class='alert alert-success alert-dismissible fade show' role='alert'>";
                    echo "<button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>";
                    echo $_SESSION['addIncomeHead_success'];
                    unset($_SESSION['addIncomeHead_success']);
                    echo "</div>";
                }

                // Alert แก้ไขรายการสำเร็จ
                else if(isset($_SESSION['editIncomeHead_success'])) {
                    echo "<div class='alert alert-success alert-dismissible fade show' role='alert'>";
                    echo "<button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>";
                    echo $_SESSION['editIncomeHead_success'];
                    unset($_SESSION['editIncomeHead_success']);
                    echo "</div>";
                }

                // Alert ลบรายการสำเร็จ
                else if(isset($_SESSION['deleteIncomeHead_success'])) {
                    echo "<div class='alert alert-danger alert-dismissible fade show' role='alert'>";
                    echo "<button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>";
                    echo $_SESSION['deleteIncomeHead_success'];
                    unset($_SESSION['deleteIncomeHead_success']);
                    echo "</div>";
                }
            ?>
            </div>
        </div>
    </section>


    <!-- ตาราง ห้ามลบ -->
    <section class="container">
        <div class="collapse show" id="collapseTable">
            <fieldset class="p-3 shadow-sm mt-2">
                <table class="table table-striped table-hover shadow-sm css-serial" id="myTable">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">ไซต์งาน</th>
                            <th scope="col">วันที่เริ่ม</th>
                            <th scope="col">วันที่สิ้นสุด</th>
                            <th scope="col">จำนวนงวด</th>
                            <th scope="col">ยอดรวม</th>
                            <th scope="col">แก้ไข</th>
                            <th scope="col">ลบ</th>
                        </tr>
                    </thead>
                    <tbody class="align-middle">

                        <!-- query ตาราง ห้ามลบ -->
                        <?php
                            $stmt = $conn->query("SELECT * FROM income_head WHERE site_name = '$siteName'");
                            $stmt->execute();
                            $incomeHead = $stmt->fetchAll();

                            if (!$incomeHead) {
                                echo "<p><td colspan='7' class='text-center'>ไม่พบข้อมูล</td></p>";
                            } else {
                                foreach ($incomeHead as $fetch_incomeHead) {
                        ?>

                        <tr>
                            <td></td>
                            <td><?php echo $fetch_incomeHead['site_name']; ?></td>
                            <td><?php echo $fetch_incomeHead['installment']; ?></td>
                            <td><?php echo $fetch_incomeHead['start_date']; ?></td>
                            <td><?php echo $fetch_incomeHead['finish_date']; ?></td>
                            <td><?php echo $fetch_incomeHead['sum']; ?></td>
                            <td>
                                <div class="btn-group" role="group" aria-label="Basic outlined example">
                                    <button type="button" class="btn btn-sm btn-outline-dark" data-bs-toggle="modal" data-bs-target="#modalEditRecord<?php echo $fetch_incomeHead['id']; ?>"><i class="fas fa-edit"></i></button>
                                    
                                </div>
                            </td>
                            <td>
                                <div class="btn-group" role="group" aria-label="Basic outlined example">
                                    
                                    <button type="button" class="btn btn-sm btn-outline-danger" data-bs-toggle="modal" data-bs-target="#modalDeleteRecord<?php echo $fetch_incomeHead['id']; ?>"><i class="fas fa-trash"></i></button>
                                </div>
                            </td>
                        </tr>

 


                        <!-- Modal แก้ไขข้อมูล ห้ามลบ -->
                        <div class="modal fade" id="modalEditRecord<?php echo $fetch_incomeHead['id']; ?>" tabindex="-1" aria-labelledby="modalEditRecord" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="modalEditRecord"><i class="fa-solid fa-pen-to-square"></i> แก้ไขข้อมูลรายรับ (Edit Income)</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>

                                    <div class="modal-body">
                                        <form action="../db/db_income.php" method="POST">
                                            <div class="mb-0">
                                                <input type="hidden" class="form-control" name="id" value="<?php echo $fetch_incomeHead['id']; ?>" readonly required>
                                                <label for="editSiteName" class="col-form-label">ไซต์งาน :</label>
                                                <input type="text" class="form-control" name="editSiteName" id="editSiteName" value="<?php echo $fetch_incomeHead['site_name']; ?>" readonly>
                                            </div>
                                            <div class="mb-0">
                                                <label for="editStartDate" class="col-form-label">วันที่เริ่ม :</label>
                                                <input type="date" class="form-control" name="editStartDate" id="editStartDate" value="<?php echo $fetch_incomeHead['start_date']; ?>" required>
                                            </div>
                                            <div class="mb-0">
                                                <label for="editFinishDate" class="col-form-label">วันที่สิ้นสุด :</label>
                                                <input type="date" class="form-control" name="editFinishDate" id="editFinishDate" value="<?php echo $fetch_incomeHead['finish_date']; ?>" required>
                                            </div>
                                            <div class="mb-0">
                                                <label for="editInstallment" class="col-form-label">จำนวนงวด :</label>
                                                <input type="number" class="form-control" name="editInstallment" id="editInstallment" value="<?php echo $fetch_incomeHead['installment']; ?>" required>
                                            </div>
                                            <div class="mb-2">
                                                <label for="editSum" class="col-form-label">ยอดรวม :</label>
                                                <input type="number" class="form-control" name="editSum" id="editSum" step="any" value="<?php echo $fetch_incomeHead['sum']; ?>" required>
                                            </div>

                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                <button type="submit" class="btn btn-primary" name="editIncome_head"><i class="fa-solid fa-floppy-disk"></i> Save</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>


                        <!-- Modal ยืนยันลบข้อมูล ห้ามลบ -->
                        <div class="modal fade" id="modalDeleteRecord<?php echo $fetch_incomeHead['id']; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title"><i class="fas fa-trash"></i> ยืนยันลบรายการ ?</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <h6 class="text-center">ต้องการลบรายการหรือไม่ ? กรุณายืนยัน</h6>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                        <a data-id="<?php echo $fetch_incomeHead['id']; ?>" href="?deleteIncome_head=<?php echo $fetch_incomeHead['id']; ?>" class="btn btn-danger"><i class="fas fa-trash"></i> Delete</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <?php } } ?>        <!-- endforeach -->
                    </tbody>
                </table>
            </fieldset>
        </div>
    </section>


<!-- 
    <script>
        function calculateDays() {
            var startDate = new Date(document.getElementById("projectStart").value);
            var endDate = new Date(document.getElementById("projectEnd").value);
            var timeDiff = Math.abs(endDate.getTime() - startDate.getTime());
            var diffDays = Math.ceil(timeDiff / (1000 * 3600 * 24));
            document.getElementById("totalDays").value = diffDays;
        }
    </script> -->

</body>


</html>

<?php   } ?>
