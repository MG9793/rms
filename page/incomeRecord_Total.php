<?php
    session_start();
    require_once "../db/config/conn.php";

    // if (!isset($_SESSION['admin_login'])) {
    //     header("location: login.php");
    // } else {

    //     // query ชื่อผู้ใช้งาน
    //     $user_id = $_SESSION['admin_login'];
    //     $stmt = $conn->query("SELECT name, lastName FROM tbl_users WHERE id_users = $user_id");
    //     $stmt->execute();
    //     $userName_query = $stmt->fetch(PDO::FETCH_ASSOC);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>บันทึกรายรับ (ยอดรวม) | ระบบบริหารจัดการใบเสร็จ</title>

    <!-- Bootstrap5.3.0 -->
    <link rel="stylesheet" href="../resources/lib/bootstrap5.3.0/css/bootstrap.min.css">
    <script src="../resources/lib/bootstrap5.3.0/js/bootstrap.bundle.min.js"></script>

    <!-- Font Awesome6.2.1 -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/fontawesome.min.css" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/brands.min.css" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/solid.min.css" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <!-- Custom UI -->
    <link rel="stylesheet" href="../resources/css/customUI.css">

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
        <legend class="fw-bold text-dark text-center border border-3 border-light bg-secondary shadow-sm p-2"><i class="fa-solid fa-3 border rounded p-1 bg-dark text-light"></i> บันทึกรายรับ (ยอดรวม)</legend>
    </section>


    <!-- Alert ห้ามลบ -->
    <section class="container">
        <div class="row">
            <div class="col-md">
        <?php
            // Alert เพิ่มข้อมูลสำเร็จ
            if(isset($_SESSION['addIncomeHead_success'])) {
                echo "<div class='alert alert-success alert-dismissible fade show' role='alert'>";
                echo "<button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>";
                echo $_SESSION['addIncomeHead_success'];
                unset($_SESSION['addIncomeHead_success']);
                echo "</div>";
            }

            // // Alert แก้ไขข้อมูลผู้ใช้งานสำเร็จ
            // else if(isset($_SESSION['editAccount_success'])) {
            //     echo "<div class='alert alert-success alert-dismissible fade show' role='alert'>";
            //     echo "<button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>";
            //     echo $_SESSION['editAccount_success'];
            //     unset($_SESSION['editAccount_success']);
            //     echo "</div>";
            // }

            // // Alert ลบข้อมูลผู้ใช้งานสำเร็จ
            // else if(isset($_SESSION['deleteAccount_success'])) {
            //     echo "<div class='alert alert-success alert-dismissible fade show' role='alert'>";
            //     echo "<button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>";
            //     echo $_SESSION['deleteAccount_success'];
            //     unset($_SESSION['deleteAccount_success']);
            //     echo "</div>";
            // }
        ?>
            </div>
        </div>
    </section>


    <!-- input ห้ามลบ -->
    <section class="container">
        <div class="collapse show" id="collapseForm">
            <fieldset class="p-3 shadow-sm mt-2">
                <h5 class="fw-bold">ชื่อไซต์งาน : <?php //echo $fetchSite['siteName']; ?></h5>
                <hr>

                <form action="../db/db_incomeHead.php" method="POST">
                    <div class="row">
                        <div class="col-md-2">
                            <input type="hidden" class="form-control" name="addSiteName" value="<?php echo "sdfasd"; ?>" readonly>
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
                            <label class="form-label fw-bold" for="addSum">ยอดรวม :</label>
                            <input type="number" class="form-control" name="addSum" id="addSum" step="any" required>
                        </div>
                    </div>

                    <div class="row mt-3">
                        <div class="col-md-6">
                            <button type="submit" name="addIncome_head" class="btn btn-primary w-100"><i class="fa-solid fa-floppy-disk"></i> Save</button>
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
                            <th scope="col">วันที่เริ่ม</th>
                            <th scope="col">วันที่สิ้นสุด</th>
                            <th scope="col">จำนวนงวด</th>
                            <th scope="col">ยอดรวม</th>
                            <th scope="col">แก้ไข/อัพเดทข้อมูล</th>
                        </tr>
                    </thead>
                    <tbody class="align-middle">


                        <!-- query ตาราง ห้ามลบ -->
                        <?php
                            $stmt = $conn->query("SELECT * FROM income_head");
                            $stmt->execute();
                            $incomeHead = $stmt->fetchAll();

                            if (!$incomeHead) {
                                echo "<p><td colspan='6' class='text-center'>ไม่พบข้อมูล</td></p>";
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
                                    <a class="btn btn-sm btn-outline-dark" href="#" data-bs-toggle="modal" data-bs-target="#modalEditRecord<?php echo $fetch_incomeHead['id']; ?>"><i class="fas fa-edit"></i></a>
                                    <button type="button" class="btn btn-sm btn-outline-danger"><i class="fas fa-trash"></i></button>
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
                                        <form action="../db/db_incomeHead.php" method="POST">
                                            <div class="mb-0">
                                                <input type="hidden" class="form-control" name="editSiteName" value="<?php $fetch_incomeHead['site_name']; ?>" readonly>
                                                <label for="editStartDate" class="col-form-label">วันที่เริ่ม :</label>
                                                <input type="date" value="<?php //echo $userAccount['name']; ?>" class="form-control" name="editStartDate" id="editStartDate" required>
                                            </div>
                                            <div class="mb-0">
                                                <label for="editFinishDate" class="col-form-label">วันที่สิ้นสุด :</label>
                                                <input type="date" value="<?php //echo $userAccount['lastName']; ?>" class="form-control" name="editFinishDate" id="editFinishDate" required>
                                            </div>
                                            <div class="mb-0">
                                                <label for="editInstallment" class="col-form-label">จำนวนงวด :</label>
                                                <input type="number" value="<?php //echo $userAccount['lastName']; ?>" class="form-control" name="editInstallment" id="editInstallment" required>
                                            </div>
                                            <div class="mb-0">
                                                <label for="editSum" class="col-form-label">ยอดรวม :</label>
                                                <input type="number" value="<?php //echo $userAccount['lastName']; ?>" class="form-control" name="editSum" id="editSum" step="any" required>
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



                        <?php } } ?>        <!-- endforeach -->
                    </tbody>
                </table>
            </fieldset>
        </div>
    </section>





    <script>
        function calculateDays() {
            var startDate = new Date(document.getElementById("projectStart").value);
            var endDate = new Date(document.getElementById("projectEnd").value);
            var timeDiff = Math.abs(endDate.getTime() - startDate.getTime());
            var diffDays = Math.ceil(timeDiff / (1000 * 3600 * 24));
            document.getElementById("totalDays").value = diffDays;
        }
    </script>

    <?php include "modal/modal_editPassword.php"; ?>
</body>
</html>