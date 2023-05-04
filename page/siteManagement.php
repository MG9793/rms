<?php
    
    require_once "../include/header.php";
    require_once "../include/dependency.php";
    require_once "../db/config/deleteRow.php";

      


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
        <div class="container border border-3 border-light bg-secondary shadow-sm">
            <legend class="fw-bold text-dark text-center p-2"> จัดการไซต์งาน (Site Management)</legend>
            <form action="../db/db_siteManagement.php" method="POST">
                <div class="row">
                    <div class="col-md-8 mb-2">
                        <label class="form-label fw-bold" for="SiteName">ชื่อไซต์งาน :</label>
                        <input type="text" class="form-control" name="SiteName" id="SiteName" required>
                    </div>
                    <div class="col-md-4 mb-2">
                        <label class="form-label fw-bold" for="SiteAbbre">ตัวย่อไซต์งาน :</label>
                        <input type="text" class="form-control" name="SiteAbbre" id="SiteAbbre" required>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-3 mb-2">
                        <label class="form-label fw-bold" for="StartDate">วันที่เริ่ม :</label>
                        <input type="date" class="form-control" name="StartDate" id="StartDate" required>
                    </div>
                    <div class="col-md-3 mb-2">
                        <label class="form-label fw-bold" for="FinishDate">วันที่สิ้นสุด :</label>
                        <input type="date" class="form-control" name="FinishDate" id="FinishDate" required>
                    </div>
                    <div class="col-md-2 mb-2">
                        <label class="form-label fw-bold" for="Installment">จำนวนงวดงานทั้งหมด :</label>
                        <input type="number" class="form-control" name="Installment" id="Installment" required>
                    </div>
                    <div class="col-md-4 mb-2">
                        <label class="form-label fw-bold" for="Total">จำนวนเงินทั้งสิ้น :</label>
                        <input type="number" class="form-control" name="Total" id="Total" step="any" required>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12 mb-2">
                        <button type="submit" class="btn btn-success w-100" name="addSite">บันทึก</button>
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
                            <th scope="col" style="text-align:center;">ชื่อไซต์งาน</th>
                            <th scope="col" style="text-align:center;">ตัวย่อไซต์งาน</th>
                            <th scope="col" style="text-align:center;">วันที่เริ่ม</th>
                            <th scope="col" style="text-align:center;">วันที่สิ้นสุด</th>
                            <th scope="col" style="text-align:center;">จำนวนงวดงานทั้งหมด</th>
                            <th scope="col" style="text-align:center;">จำนวนเงินทั้งสิ้น</th>
                            <th scope="col" style="text-align:center;">แก้ไข/ลบ</th>

                        </tr>
                    </thead>
                    <tbody class="align-middle">

                        <!-- query ตาราง ห้ามลบ -->
                        <?php
                            

                            
                                $stmt = $conn->query("SELECT * FROM site_info ");
                                $stmt->execute();
                                $site_info = $stmt->fetchAll();
                           
                                foreach ($site_info as $fetch_site) {
                        ?>

                        <tr style="text-align:center;">
                            <td></td>
                            <td><?php echo $fetch_site['site_name']; ?></td>
                            <td><?php echo $fetch_site['site_abbre']; ?></td>
                            <td><?php echo $fetch_site['start_date']; ?></td>
                            <td><?php echo $fetch_site['finish_date']; ?></td>
                            <td><?php echo $fetch_site['installment']; ?></td>
                            <td><?php echo number_format(($fetch_site['total']),2); ?></td>
                            <td>
                                <div class="btn-group" role="group" aria-label="Basic outlined example">
                                    <button type="button" class="btn btn-sm btn-outline-dark" data-bs-toggle="modal" data-bs-target="#modalEditRecord<?php echo $fetch_site['id']; ?>"><i class="fas fa-edit"></i></button>
                                    <button type="button" class="btn btn-sm btn-outline-danger" data-bs-toggle="modal" data-bs-target="#modalDeleteRecord<?php echo $fetch_site['id']; ?>"><i class="fas fa-trash"></i></button>
                                </div>
                                </div>
                            </td>
                            
                        </tr>


                        <!-- Modal แก้ไขข้อมูล ห้ามลบ -->
                        <div class="modal fade" id="modalEditRecord<?php echo $fetch_site['id']; ?>" tabindex="-1" aria-labelledby="modalEditRecord" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="modalEditRecord"><i class="fa-solid fa-pen-to-square"></i> แก้ไขข้อมูลไซต์งาน</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>

                                    <div class="modal-body">
                                        <form action="../db/db_siteManagement.php" method="POST">
                                            <div class="mb-0">
                                                <input type="hidden" class="form-control" name="id" value="<?php echo $fetch_site['id']; ?>"  required>
                                                <label for="editSiteName" class="col-form-label">ชื่อไซต์งาน :</label>
                                                <input type="text" class="form-control" name="editSiteName" id="editSiteName" value="<?php echo $fetch_site['site_name']; ?>" >
                                            </div>
                                            <div class="mb-0">
                                                <input type="hidden" class="form-control" name="id" value="<?php echo $fetch_site['id']; ?>"  required>
                                                <label for="editSiteName" class="col-form-label">ตัวย่อไซต์งาน :</label>
                                                <input type="text" class="form-control" name="editSiteAbbre" id="editSiteAbbre" value="<?php echo $fetch_site['site_abbre']; ?>" >
                                            </div>
                                            <div class="mb-0">
                                                <label for="editStartDate" class="col-form-label">วันที่เริ่ม :</label>
                                                <input type="date" class="form-control" name="editStartDate" id="editStartDate" value="<?php echo $fetch_site['start_date']; ?>" required>
                                            </div>
                                            <div class="mb-0">
                                                <label for="editFinishDate" class="col-form-label">วันที่สิ้นสุด :</label>
                                                <input type="date" class="form-control" name="editFinishDate" id="editFinishDate" value="<?php echo $fetch_site['finish_date']; ?>" required>
                                            </div>
                                            <div class="mb-0">
                                                <label for="editInstallment" class="col-form-label">จำนวนงวด :</label>
                                                <input type="number" class="form-control" name="editInstallment" id="editInstallment" value="<?php echo $fetch_site['installment']; ?>" required>
                                            </div>
                                            <div class="mb-2">
                                                <label for="editSum" class="col-form-label">จำนวนเงินทั้งสิ้น :</label>
                                                <input type="text" class="form-control" name="editTotal" id="editTotal" step="any" value="<?php echo $fetch_site['total']; ?>" required>
                                            </div>
                                            
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">ยกเลิก</button>
                                                <button type="submit" class="btn btn-primary" name="editSite"><i class="fa-solid fa-floppy-disk"></i> บันทึก</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>


                        <!-- Modal ยืนยันลบข้อมูล ห้ามลบ -->
                        <div class="modal fade" id="modalDeleteRecord<?php echo $fetch_site['id']; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
                                        <a data-id="<?php echo $fetch_site['id']; ?>" href="?deleteIncome_head=<?php echo $fetch_site['id']; ?>" class="btn btn-danger"><i class="fas fa-trash"></i> ยืนยัน</a>
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

