<?php
    session_start();
    require_once "../db/config/conn.php";
    require_once "../db/config/deleteRow.php";

    if (!isset($_SESSION['admin_login'])) {
        header("location: ../login.php");
    } else {

        // query ชื่อผู้ใช้งาน
        $id = $_SESSION['admin_login'];
        $stmt = $conn->query("SELECT name, lastname FROM user_info WHERE id = $id");
        $stmt->execute();
        $userName_query = $stmt->fetch(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>จัดการผู้ขาย (Seller Management) | ระบบบริหารจัดการใบเสร็จ</title>

    <!-- Dependency ห้ามลบ -->
    <?php include "include/dependency.php"; ?>

    <!-- Font kanit-300 ห้ามเอาออก -->
    <style>
        @font-face {
            font-display: swap;
            font-family: 'Kanit';
            font-style: normal;
            font-weight: 300;
            src: url('../resources/fonts/kanit-v12-latin_thai-300.eot'); /* IE9 Compat Modes */
            src: url('../resources/fonts/kanit-v12-latin_thai-300.eot?#iefix') format('embedded-opentype'), /* IE6-IE8 */
                url('../resources/fonts/kanit-v12-latin_thai-300.woff2') format('woff2'), /* Super Modern Browsers */
                url('../resources/fonts/kanit-v12-latin_thai-300.woff') format('woff'), /* Modern Browsers */
                url('../resources/fonts/kanit-v12-latin_thai-300.ttf') format('truetype'), /* Safari, Android, iOS */
                url('../resources/fonts/kanit-v12-latin_thai-300.svg#Kanit') format('svg'); /* Legacy iOS */
        }
    </style>
</head>
<body>

    <!-- navbar ห้ามลบ -->
    <?php include 'include/navbar.php'; ?>

    <!-- pagename ห้ามลบ -->
    <section class="container mt-2">
        <legend class="fw-bold text-dark text-center border border-3 border-light bg-secondary shadow-sm p-2">จัดการผู้ขาย (Seller Management)</legend>
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

    <!-- input ห้ามลบ -->
    <section class="container">
        <div class="collapse show" id="collapseForm">
            <fieldset class="p-3 shadow-sm mt-2">
                <h5 class="fw-bold"><i class="fa-solid fa-plus"></i> เพิ่มข้อมูลผู้ขาย</h5>

                <form action="../db/db_sellerManagement.php" method="POST">
                    <div class="row mb-3">
                        <div class="col-md-8">
                            <label for="salesName" class="form-label fw-bold">ชื่อผู้ขาย :</label>
                            <input type="text" class="form-control" name="salesName" id="salesName" placeholder="ชื่อผู้ขาย..." required>
                        </div>
                        <div class="col-md-4">
                            <label for="taxNo" class="form-label fw-bold">เลขประจำตัวผู้เสียภาษี :</label>
                            <input type="text" class="form-control" name="taxNo" id="taxNo" placeholder="เลขประจำตัวผู้เสียภาษี..." required>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="" id="exampleCheck1" onchange="toggleInput()">
                                <label class="form-check-label" for="exampleCheck1">สำนักงานใหญ่</label>
                            </div>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-8">
                            <label for="exampleFormControlInput1" class="form-label fw-bold">สาขา (กรณีไม่ใช่สำนักงานใหญ่) :</label>
                            <input type="text" class="form-control" name="salesBranch" id="exampleFormControlInput1" placeholder="ชื่อสถานประกอบการ/สาขา..." required>
                        </div>
                    </div>


                    <div class="row mb-2">
                        <div class="col-md-8">
                            <button type="submit" class="btn btn-primary w-100" name="addSales"><i class="fa-solid fa-plus"></i> เพิ่ม</button>
                        </div>
                    </div>
                </form>
            </fieldset>
        </div>
    </section>  <!-- Closing Tag Container -->

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


    <section class="container">
        <div class="collapse show" id="collapseTable">
            <fieldset class="p-3 shadow-sm mt-2">
                <h5 class="fw-bold"><i class="fa-solid fa-table-list"></i> รายการผู้ขายทั้งหมด</h5>
                <table class="table table-striped table-hover table-sm table-bordered css-serial">
                    <thead class="bg-dark text-light">
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
                                echo "<p><td colspan='4' class='text-center'>ไม่พบข้อมูล</td></p>";
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
                                                <button type="submit" class="btn btn-primary" name="editSales"><i class="fa-solid fa-floppy-disk"></i> Save</button>
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
        </div>
    </section>


    <?php include "modal/modal_editSeller.php"; ?>
    <?php include "modal/modal_editPassword.php"; ?>
</body>
</html>

<?php } ?>