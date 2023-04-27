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
            <legend class="fw-bold text-dark text-center p-2">สถานประกอบการ</legend>
            <form action="../db/db_companyManagement.php" method="POST">
                <div class="row">
                    <div class="col-md-6 mb-2">
                        <label for="companyName" class="form-label fw-bold">ชื่อสถานประกอบการ :</label>
                        <input type="text" class="form-control" name="companyName" id="companyName" required>
                    </div>
                    <div class="col-md-6 mb-2">
                        <label for="taxNo" class="form-label fw-bold">เลขประจำตัวผู้เสียภาษี (13 หลัก):</label>
                        <input type="text" class="form-control" name="taxNo" id="taxNo" minlength="13" maxlength="13" required>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12 mb-2">
                        <input class="form-check-input" type="checkbox" value="" id="exampleCheck1" onchange="toggleInput()" checked>
                        <label class="form-check-label fw-bold" for="exampleCheck1">สำนักงานใหญ่ (สาขา 0000)</label>
                        <!-- <label for="exampleFormControlInput1" class="form-label fw-bold"></label> -->
                        <input type="text" class="form-control" name="companyBranch" id="companyBranch" placeholder="สาขาที่..." required disabled>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12 mb-2">
                        <button type="submit" class="btn btn-success w-100" name="addCompany"><i class="fa-solid fa-plus"></i> เพิ่ม</button>
                    </div>
                </div>
            </form>
        </div>
    </section>

    <script>
        function toggleInput() {
            var input = document.getElementById("companyBranch");
            if (document.getElementById("exampleCheck1").checked) {
                input.disabled = true;
            } else {
                input.disabled = false;
            }
        }
    </script>


    <section class="container my-2">
        <fieldset class="p-3 shadow-sm mt-2">
            <table class="table table-striped table-hover shadow-sm css-serial" id="myTable">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">ชื่อสถานประกอบการ</th>
                        <th scope="col">สาขา</th>
                        <th scope="col">เลขประจำตัวผู้เสียภาษี</th>
                        <th scope="col">แก้ไข/อัพเดทข้อมูล</th>
                    </tr>
                </thead>
                <tbody class="align-middle">

                    <!-- query ตาราง ห้ามลบ -->
                    <?php
                        $stmt = $conn->query("SELECT * FROM company_info");
                        $stmt->execute();
                        $company = $stmt->fetchAll();

                        if (!$company) {
                           
                        } else {
                            foreach ($company as $fetch_companyInfo) {
                    ?>

                    <tr>
                        <td></td>
                        <td><?php echo $fetch_companyInfo['company_name']; ?></td>
                        <td><?php echo $fetch_companyInfo['company_branch']; ?></td>
                        <td><?php echo $fetch_companyInfo['tax_no']; ?></td>
                        <td>
                            <div class="btn-group" role="group" aria-label="Basic outlined example">
                                <button type="button" class="btn btn-sm btn-outline-dark" data-bs-toggle="modal" data-bs-target="#modalEditCompany<?php echo $fetch_companyInfo['id']; ?>"><i class="fas fa-edit"></i></button>
                                <button type="button" class="btn btn-sm btn-outline-danger" data-bs-toggle="modal" data-bs-target="#modalDeleteCompany<?php echo $fetch_companyInfo['id']; ?>"><i class="fas fa-trash"></i></button>
                            </div>
                        </td>
                    </tr>


                    <!-- Modal แก้ไขข้อมูล ห้ามลบ -->
                    <div class="modal fade" id="modalEditCompany<?php echo $fetch_companyInfo['id']; ?>" tabindex="-1" aria-labelledby="modalEditCompany" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="modalEditCompany"><i class="fa-solid fa-pen-to-square"></i> แก้ไขข้อมูลผู้ขาย</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>

                                <div class="modal-body">
                                    <form action="../db/db_companyManagement.php" method="POST">
                                        <div class="mb-0">
                                            <input type="hidden" class="form-control" name="id" value="<?php echo $fetch_companyInfo['id']; ?>" readonly required>
                                            <label for="editCompanyName" class="col-form-label">ชื่อผู้ขาย :</label>
                                            <input type="text" class="form-control" name="editCompanyName" id="editCompanyName" value="<?php echo $fetch_companyInfo['company_name']; ?>" required>
                                        </div>
                                        <div class="mb-0">
                                            <label for="editCompanyBranch" class="col-form-label">ชื่อสาขา :</label>
                                            <input type="text" class="form-control" name="editCompanyBranch" id="editCompanyBranch" value="<?php echo $fetch_companyInfo['company_branch']; ?>" required>
                                        </div>
                                        <div class="mb-2">
                                            <label for="edittaxNo" class="col-form-label">เลขประจำตัวผู้เสียภาษี :</label>
                                            <input type="text" class="form-control" name="edittaxNo" id="edittaxNo" minlength="13" maxlength="13" value="<?php echo $fetch_companyInfo['tax_no']; ?>" required>
                                        </div>

                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                            <button type="submit" class="btn btn-dark" name="editCompany"><i class="fa-solid fa-floppy-disk"></i> Save</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>


                    <!-- Modal ยืนยันลบข้อมูล ห้ามลบ -->
                    <div class="modal fade" id="modalDeleteCompany<?php echo $fetch_companyInfo['id']; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title"><i class="fas fa-trash"></i> ยืนยันลบสถานประกอบการ ?</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <h6 class="text-center">ต้องการลบสถานประกอบการหรือไม่ ? กรุณายืนยัน</h6>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                    <a data-id="<?php echo $fetch_companyInfo['id']; ?>" href="?deleteCompany=<?php echo $fetch_companyInfo['id']; ?>" class="btn btn-danger"><i class="fas fa-trash"></i> Delete</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php } } ?>        <!-- endforeach -->
                </tbody>
            </table>
        </fieldset>
    </section>

</body>
</html>

