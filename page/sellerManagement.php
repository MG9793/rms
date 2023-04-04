<?php
    require_once "../include/dependency.php";
    require_once "../include/header.php";
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
        <legend class="fw-bold text-dark text-center border border-3 border-light bg-secondary shadow-sm p-2">ข้อมูลผู้ขาย</legend>
    </section>
    
    <!-- Alert ห้ามลบ -->
    <section class="container">
        <div class="row">
            <div class="col-md">
                <?php
                    // Alert เพิ่มรายการสำเร็จ
                    if(isset($_SESSION['addSales_success'])) {
                        echo "<div class='alert alert-success alert-dismissible fade show' role='alert'>";
                        echo "<button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>";
                        echo $_SESSION['addSales_success'];
                        unset($_SESSION['addSales_success']);
                        echo "</div>";
                    }

                    // Alert แก้ไขรายการสำเร็จ
                    else if(isset($_SESSION['editSales_success'])) {
                        echo "<div class='alert alert-success alert-dismissible fade show' role='alert'>";
                        echo "<button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>";
                        echo $_SESSION['editSales_success'];
                        unset($_SESSION['editSales_success']);
                        echo "</div>";
                    }

                    // Alert ลบรายการสำเร็จ
                    else if(isset($_SESSION['deleteSales_success'])) {
                        echo "<div class='alert alert-success alert-dismissible fade show' role='alert'>";
                        echo "<button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>";
                        echo $_SESSION['deleteSales_success'];
                        unset($_SESSION['deleteSales_success']);
                        echo "</div>";
                    }
                ?>
            </div>
        </div>
    </section>

    <div class="container">
        <button type="button" class="btn btn-light w-100" data-bs-toggle="modal" data-bs-target="#modalAddSeller"><i class="fa-solid fa-plus"></i> เพิ่มข้อมูลผู้ขาย</button>
    </div>

    <!-- Modal เพิ่มข้อมูล ห้ามลบ -->
    <div class="modal fade" id="modalAddSeller" tabindex="-1" aria-labelledby="modalAddSeller" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalAddSeller"><i class="fa-solid fa-plus"></i> เพิ่มข้อมูลผู้ขาย (Add Seller)</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <div class="modal-body">
                    <form action="../db/db_sellerManagement.php" method="POST">
                        <div class="mb-2">
                            <label for="salesName" class="form-label">ชื่อผู้ขาย :</label>
                            <input type="text" class="form-control" name="salesName" id="salesName" required>
                        </div>
                        <div class="mb-2">
                            <label for="taxNo" class="form-label">เลขประจำตัวผู้เสียภาษี :</label>
                            <input type="text" class="form-control" name="taxNo" id="taxNo" minlength="13" maxlength="13" required>
                        </div>
                        <div class="mb-2">
                            <input class="form-check-input" type="checkbox" value="" id="exampleCheck1" onchange="toggleInput()" checked>
                            <label class="form-check-label fw-bold" for="exampleCheck1">สำนักงานใหญ่</label>
                        </div>
                        <div class="mb-2">
                            <label for="exampleFormControlInput1" class="form-label">สาขา (กรณีไม่ใช่สำนักงานใหญ่) :</label>
                            <input type="text" class="form-control" name="salesBranch" id="exampleFormControlInput1" placeholder="ชื่อสถานประกอบการ/สาขา..." required disabled>
                        </div>

                        <div class="modal-footer">
                            <button type="submit" class="btn btn-dark w-100" name="addSales"><i class="fa-solid fa-plus"></i> เพิ่ม</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        function toggleInput() {
            var input = document.getElementById("exampleFormControlInput1");
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
                        <th scope="col">ชื่อผู้ขาย</th>
                        <th scope="col">สถานประกอบการ</th>
                        <th scope="col">เลขประจำตัวผู้เสียภาษี</th>
                        <th scope="col">แก้ไข/อัพเดทข้อมูล</th>
                    </tr>
                </thead>
                <tbody class="align-middle">

                    <!-- query ตาราง ห้ามลบ -->
                    <?php
                        $stmt = $conn->query("SELECT * FROM sales_info");
                        $stmt->execute();
                        $sales = $stmt->fetchAll();

                        if (!$sales) {
                           
                        } else {
                            foreach ($sales as $fetch_salesInfo) {
                    ?>

                    <tr>
                        <td></td>
                        <td><?php echo $fetch_salesInfo['sales_name']; ?></td>
                        <td><?php echo $fetch_salesInfo['sales_branch']; ?></td>
                        <td><?php echo $fetch_salesInfo['tax_no']; ?></td>
                        <td>
                            <div class="btn-group" role="group" aria-label="Basic outlined example">
                                <button type="button" class="btn btn-sm btn-outline-dark" data-bs-toggle="modal" data-bs-target="#modalEditSales<?php echo $fetch_salesInfo['id']; ?>"><i class="fas fa-edit"></i></button>
                                <button type="button" class="btn btn-sm btn-outline-danger" data-bs-toggle="modal" data-bs-target="#modalDeleteSales<?php echo $fetch_salesInfo['id']; ?>"><i class="fas fa-trash"></i></button>
                            </div>
                        </td>
                    </tr>


                    <!-- Modal แก้ไขข้อมูล ห้ามลบ -->
                    <div class="modal fade" id="modalEditSales<?php echo $fetch_salesInfo['id']; ?>" tabindex="-1" aria-labelledby="modalEditSales" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="modalEditSales"><i class="fa-solid fa-pen-to-square"></i> แก้ไขรายการผู้ขาย (Edit Seller)</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>

                                <div class="modal-body">
                                    <form action="../db/db_sellerManagement.php" method="POST">
                                        <div class="mb-0">
                                            <input type="hidden" class="form-control" name="id" value="<?php echo $fetch_salesInfo['id']; ?>" readonly required>
                                            <label for="editSalesName" class="col-form-label">ชื่อผู้ขาย :</label>
                                            <input type="text" class="form-control" name="editSalesName" id="editSalesName" value="<?php echo $fetch_salesInfo['sales_name']; ?>" required>
                                        </div>
                                        <div class="mb-0">
                                            <label for="editSalesBranch" class="col-form-label">ชื่อสาขา :</label>
                                            <input type="text" class="form-control" name="editSalesBranch" id="editSalesBranch" value="<?php echo $fetch_salesInfo['sales_branch']; ?>" required>
                                        </div>
                                        <div class="mb-2">
                                            <label for="edittaxNo" class="col-form-label">เลขประจำตัวผู้เสียภาษี :</label>
                                            <input type="text" class="form-control" name="edittaxNo" id="edittaxNo" value="<?php echo $fetch_salesInfo['tax_no']; ?>" required>
                                        </div>

                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                            <button type="submit" class="btn btn-dark" name="editSales"><i class="fa-solid fa-floppy-disk"></i> Save</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>


                    <!-- Modal ยืนยันลบข้อมูล ห้ามลบ -->
                    <div class="modal fade" id="modalDeleteSales<?php echo $fetch_salesInfo['id']; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title"><i class="fas fa-trash"></i> ยืนยันลบรายการผู้ขาย ?</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <h6 class="text-center">ต้องการลบผู้ขายหรือไม่ ? กรุณายืนยัน</h6>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                    <a data-id="<?php echo $fetch_salesInfo['id']; ?>" href="?deleteSales=<?php echo $fetch_salesInfo['id']; ?>" class="btn btn-danger"><i class="fas fa-trash"></i> Delete</a>
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

