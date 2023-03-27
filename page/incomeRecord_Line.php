<?php
    session_start();
    require_once "../db/config/conn.php";
    require_once "../db/config/deleteRow.php";

    if (!isset($_SESSION['admin_login'])) {
        header("location: ../login.php");
    } else {

        // query ชื่อผู้ใช้งาน
        $id = $_SESSION['admin_login'];
        $stmt = $conn->query("SELECT name, lastname, username FROM user_info WHERE id = $id");
        $stmt->execute();
        $userName_query = $stmt->fetch(PDO::FETCH_ASSOC);

        if (!isset($_SESSION['siteName_incomeLine'])) {
            header("location: incomeRecord.php");
        } else {

        // ดึง sitename จาก session
        $siteName = $_SESSION['siteName_incomeLine'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>บันทึกรายรับ (รายละเอียด) | ระบบบริหารจัดการใบเสร็จ</title>

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
        <legend class="fw-bold text-dark text-center border border-3 border-light bg-secondary shadow-sm p-2"><i class="fa-solid fa-3 border rounded p-1 bg-dark text-light"></i> บันทึกรายรับ (รายละเอียด)</legend>
    </section>

    <!-- Alert ห้ามลบ -->
    <section class="container">
        <div class="row">
            <div class="col-md">
            <?php
                // Alert เพิ่มรายการสำเร็จ
                if(isset($_SESSION['addIncomeLine_success'])) {
                    echo "<div class='alert alert-success alert-dismissible fade show' role='alert'>";
                    echo "<button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>";
                    echo $_SESSION['addIncomeLine_success'];
                    unset($_SESSION['addIncomeLine_success']);
                    echo "</div>";
                }

                // Alert แก้ไขรายการสำเร็จ
                else if(isset($_SESSION['editIncomeLine_success'])) {
                    echo "<div class='alert alert-success alert-dismissible fade show' role='alert'>";
                    echo "<button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>";
                    echo $_SESSION['editIncomeLine_success'];
                    unset($_SESSION['editIncomeLine_success']);
                    echo "</div>";
                }

                // Alert ลบรายการสำเร็จ
                else if(isset($_SESSION['deleteIncomeLine_success'])) {
                    echo "<div class='alert alert-danger alert-dismissible fade show' role='alert'>";
                    echo "<button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>";
                    echo $_SESSION['deleteIncomeLine_success'];
                    unset($_SESSION['deleteIncomeLine_success']);
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
                <h5 class="fw-bold text-danger"><?php echo $siteName; ?></h5>
                <hr>

                <form action="../db/db_income.php" method="POST">
                    <div class="row">
                        <div class="col-md-12">
                            <input type="hidden" class="form-control" name="addSiteName" value="<?php echo $siteName; ?>" readonly>
                            <label class="form-label fw-bold" for="addPayerName">ชื่อผู้จ่าย :</label>
                            <input type="text" class="form-control" name="addPayerName" id="addPayerName" required>
                        </div>
                    </div>
                    <div class="row mt-2">
                        <div class="col-md-2">
                            <label class="form-label fw-bold" for="addPaidDate">ได้รับเงินวันที่ :</label>
                            <input type="date" class="form-control" name="addPaidDate" id="addPaidDate" required>
                        </div>
                        <div class="col-md-1">
                            <label class="form-label fw-bold" for="addInstallmentNo">งวดที่ :</label>
                            <input type="number" class="form-control" name="addInstallmentNo" id="addInstallmentNo" required>
                        </div>
                        <div class="col-md-3">
                            <label class="form-label fw-bold" for="addPrice">จำนวน :</label>
                            <input type="number" class="form-control" name="addPrice" id="addPrice" step="any" required>
                        </div>
                    </div>

                    <div class="row mt-3">
                        <div class="col-md-6">
                            <button type="submit" name="addIncome_line" class="btn btn-primary w-100"><i class="fa-solid fa-floppy-disk"></i> Save</button>
                        </div>
                    </div>
                </form>
            </fieldset>
        </div>
    </section>


    <!-- ตาราง ห้ามลบ -->
    <section class="container">
        <div class="collapse show" id="collapseTable">
            <fieldset class="p-3 shadow-sm mt-2">
                <h5 class="fw-bold"><i class="fa-solid fa-table-list"></i> ข้อมูลบันทึก/แก้ไข</h5>
                <table class="table table-striped table-hover table-sm table-bordered css-serial">
                    <thead class="bg-dark text-light">
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">ไซต์งาน</th>
                            <th scope="col">ชื่อผู้จ่าย</th>
                            <th scope="col">ได้รับเงินวันที่</th>
                            <th scope="col">งวดที่</th>
                            <th scope="col">จำนวน</th>
                            <th scope="col">แก้ไข/อัพเดทข้อมูล</th>
                        </tr>
                    </thead>
                    <tbody class="align-middle">

                        <!-- query ตาราง ห้ามลบ -->
                        <?php
                            $stmt = $conn->query("SELECT * FROM income_line WHERE site_name = '$siteName'");
                            $stmt->execute();
                            $incomeLine = $stmt->fetchAll();

                            if (!$incomeLine) {
                                echo "<p><td colspan='7' class='text-center'>ไม่พบข้อมูล</td></p>";
                            } else {
                                foreach ($incomeLine as $fetch_incomeLine) {
                        ?>

                        <tr>
                            <td></td>
                            <td><?php echo $fetch_incomeLine['site_name']; ?></td>
                            <td><?php echo $fetch_incomeLine['payer_name']; ?></td>
                            <td><?php echo $fetch_incomeLine['paid_date']; ?></td>
                            <td><?php echo $fetch_incomeLine['installment_no']; ?></td>
                            <td><?php echo $fetch_incomeLine['price']; ?></td>
                            <td>
                                <div class="btn-group" role="group" aria-label="Basic outlined example">
                                    <button type="button" class="btn btn-sm btn-outline-dark" data-bs-toggle="modal" data-bs-target="#modalEditRecord<?php echo $fetch_incomeLine['id']; ?>"><i class="fas fa-edit"></i></button>
                                    <button type="button" class="btn btn-sm btn-outline-danger" data-bs-toggle="modal" data-bs-target="#modalDeleteRecord<?php echo $fetch_incomeLine['id']; ?>"><i class="fas fa-trash"></i></button>
                                </div>
                            </td>
                        </tr>


                        <!-- Modal แก้ไขข้อมูล ห้ามลบ -->
                        <div class="modal fade" id="modalEditRecord<?php echo $fetch_incomeLine['id']; ?>" tabindex="-1" aria-labelledby="modalEditRecord" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="modalEditRecord"><i class="fa-solid fa-pen-to-square"></i> แก้ไขข้อมูลรายรับ (Edit Income)</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>

                                    <div class="modal-body">
                                        <form action="../db/db_income.php" method="POST">
                                            <div class="mb-0">
                                                <input type="hidden" class="form-control" name="id" value="<?php echo $fetch_incomeLine['id']; ?>" readonly required>
                                                <label for="editSiteName" class="col-form-label">ไซต์งาน :</label>
                                                <input type="text" class="form-control" name="editSiteName" id="editSiteName" value="<?php echo $fetch_incomeLine['site_name']; ?>" readonly>
                                            </div>
                                            <div class="mb-0">
                                                <label for="editPayerName" class="col-form-label">ชื่อผู้จ่าย :</label>
                                                <input type="text" class="form-control" name="editPayerName" id="editPayerName" value="<?php echo $fetch_incomeLine['payer_name']; ?>" required>
                                            </div>
                                            <div class="mb-0">
                                                <label for="editPaidDate" class="col-form-label">ได้รับเงินวันที่ :</label>
                                                <input type="date" class="form-control" name="editPaidDate" id="editPaidDate" value="<?php echo $fetch_incomeLine['paid_date']; ?>" required>
                                            </div>
                                            <div class="mb-0">
                                                <label for="editInstallmentNo" class="col-form-label">งวดที่ :</label>
                                                <input type="number" class="form-control" name="editInstallmentNo" id="editInstallmentNo" value="<?php echo $fetch_incomeLine['installment_no']; ?>" required>
                                            </div>
                                            <div class="mb-2">
                                                <label for="editPrice" class="col-form-label">จำนวน :</label>
                                                <input type="number" class="form-control" name="editPrice" id="editPrice" step="any" value="<?php echo $fetch_incomeLine['price']; ?>" required>
                                            </div>

                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                <button type="submit" class="btn btn-primary" name="editIncome_line"><i class="fa-solid fa-floppy-disk"></i> Save</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>


                        <!-- Modal ยืนยันลบข้อมูล ห้ามลบ -->
                        <div class="modal fade" id="modalDeleteRecord<?php echo $fetch_incomeLine['id']; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
                                        <a data-id="<?php echo $fetch_incomeLine['id']; ?>" href="?deleteIncome_line=<?php echo $fetch_incomeLine['id']; ?>" class="btn btn-danger"><i class="fas fa-trash"></i> Delete</a>
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

</body>
</html>

<?php } } ?>