<?php
    
    require_once "../include/header.php";
    require_once "../include/dependency.php";
    require_once "../db/config/deleteRow.php";

        $site = $conn->prepare("SELECT* FROM site_info");
        $site->execute();
        $rs = $site->fetchAll();

      if (!isset($_SESSION['siteName_incomeHead'])) {
          //  header("location: incomeRecord.php");
          $siteName = "";
        } else {

        // ดึง sitename จาก session
        $siteName = $_SESSION['siteName_incomeHead'];
        }
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
               <!-- Bootstrap CSS -->

               <script src="../resources/lib/dselect.js"></script>
</head>
<body>


    <!-- pagename ห้ามลบ -->
    <section class="container mt-2">
    <div class="fw-bold text-dark bg-secondary shadow-sm p-2 ">
        <legend class="fw-bold text-dark text-center  p-1"> บันทึกรายรับ </legend>
        <form action="../db/db_income.php" method="POST">
               
                                 <div class="row">
                                     
                                    <div class="col-md-4">
                                    <label class="form-label fw-bold" >ไซต์งาน :</label>
                                    <select name="siteName" class="form-select" id="siteName">
                                    <?php if($_SESSION['siteName_incomeHead']=="") { ?>
                                    <option value="">กรุณาเลือกไซต์งาน</option>
                                    <?php foreach($rs as $row) { ?>
                                        <option value="<?=$row['site_name'];?>"><?=$row['site_name'];?></option>
                                    <?php
                                     } 
                                     } else{
                                        ?>
                                    <?php 
                                    foreach($rs as $row)
                                    {
                                        echo '<option value="'.$rs["site_name"].'">'.$row["site_name"].'</option>';
                                    }}
                                    ?>  

                                </select>
                                </div>  
                            <div class="col-md-2">
                                <label class="form-label fw-bold" for="paidDate">วันที่ :</label>
                                <input type="date" class="form-control" name="paidDate" id="paidDate" required>
                            
                            </div>
                            
                            <div class="col-md-2">
                                <label class="form-label fw-bold" for="installmentNO">งวดที่ :</label>
                                <input type="number" class="form-control" name="installmentNO" id="installmentNO" required>
                            </div>
                            <div class="col-md-4">
                                <label class="form-label fw-bold" for="Amount">จำนวนเงิน :</label>
                                <input type="number" class="form-control" name="Amount" id="Amount" step="any" required>
                            </div>
                        </div>
    
                        <div class="row mt-4">
                            <div class="col-md">
                                <button type="submit" name="addIncome" class="btn btn-success w-100">บันทึก</button>
                            </div>
                        </div>
                    </form>


        </div>
    </section>

    


    <!-- ตาราง ห้ามลบ -->
    <section class="container">
        <div class="collapse show" id="collapseTable">
            <fieldset class="p-3 shadow-sm mt-2">
                <table class="table table-striped table-hover shadow-sm css-serial" id="myTable">
                <thead>
                        <tr>
                            <th scope="col" style="text-align:center;">#</th>
                            <th scope="col" style="text-align:center;">ไซต์งาน</th>
                            <th scope="col" style="text-align:center;">งวดที่</th>
                            <th scope="col" style="text-align:center;">วันที่</th>
                            <th scope="col" style="text-align:center;">จำนวนเงิน</th>
                            <th scope="col" style="text-align:center;">แก้ไข/ลบ</th>

                        </tr>
                    </thead>
                    <tbody class="align-middle">

                        <!-- query ตาราง ห้ามลบ -->
                        <?php
                            

                            if (!$siteName) {
                                $stmt = $conn->query("SELECT * FROM income ");
                                $stmt->execute();
                                $incomeHead = $stmt->fetchAll();
                            } else {
                                $stmt = $conn->query("SELECT * FROM income WHERE site_name = '$siteName'");
                                $stmt->execute();
                                $incomeHead = $stmt->fetchAll();
                            }
                                foreach ($incomeHead as $fetch_incomeHead) {
                        ?>

                        <tr style="text-align:center;">
                            <td></td>
                            <td><?php echo $fetch_incomeHead['site_name']; ?></td>
                            <td><?php echo $fetch_incomeHead['installment_no']; ?></td>
                            <td><?php echo $fetch_incomeHead['paid_date']; ?></td>
                            <td><?php echo number_format(($fetch_incomeHead['amount']),2); ?></td>
                            <td>
                                <div class="btn-group" role="group" aria-label="Basic outlined example">
                                    <button type="button" class="btn btn-sm btn-outline-dark" data-bs-toggle="modal" data-bs-target="#modalEditRecord<?php echo $fetch_incomeHead['id']; ?>"><i class="fas fa-edit"></i></button>
                                    <button type="button" class="btn btn-sm btn-outline-danger" data-bs-toggle="modal" data-bs-target="#modalDeleteRecord<?php echo $fetch_incomeHead['id']; ?>"><i class="fas fa-trash"></i></button>
                                </div>
                                </div>
                            </td>
                            
                        </tr>


                        <!-- Modal แก้ไขข้อมูล ห้ามลบ -->
                        <div class="modal fade" id="modalEditRecord<?php echo $fetch_incomeHead['id']; ?>" tabindex="-1" aria-labelledby="modalEditRecord" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="modalEditRecord"><i class="fa-solid fa-pen-to-square"></i> แก้ไขข้อมูลรายรับ</h5>
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
                                                <label for="editPaidtDate" class="col-form-label">วันที่ :</label>
                                                <input type="date" class="form-control" name="editPaidtDate" id="editPaidtDate" value="<?php echo $fetch_incomeHead['paid_date']; ?>" required>
                                            </div>
                                        
                                            <div class="mb-0">
                                                <label for="editInstallmentNO" class="col-form-label">งวดที่ :</label>
                                                <input type="number" class="form-control" name="editInstallmentNO" id="editInstallmentNO" value="<?php echo $fetch_incomeHead['installment_no']; ?>" required>
                                            </div>
                                            <div class="mb-2">
                                                <label for="editAmount" class="col-form-label">จำนวนเงิน :</label>
                                                <input type="text" class="form-control" name="editAmount" id="editAmount" step="any" value="<?php echo $fetch_incomeHead['amount']; ?>" required>
                                            </div>
                                            
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">ยกเลิก</button>
                                                <button type="submit" class="btn btn-primary" name="editIncome_head"><i class="fa-solid fa-floppy-disk"></i> บันทึก</button>
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
                                        <h5 class="modal-title"> ลบรายการ </h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <h6 class="text-center">กรุณายืนยันการลบรายการ</h6>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">ยกเลิก</button>
                                        <a data-id="<?php echo $fetch_incomeHead['id']; ?>" href="?deleteIncome_head=<?php echo $fetch_incomeHead['id']; ?>" class="btn btn-danger"><i class="fas fa-trash"></i> ยืนยัน</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <?php }  ?>        <!-- endforeach -->
                    </tbody>
                </table>
            </fieldset>
        </div>
    </section>

    <script>

var select_box_element_site = document.querySelector('#siteName');

dselect(select_box_element_site, {
    search: true
});

</script>
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

<?php // } ?>

