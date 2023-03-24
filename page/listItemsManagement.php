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
    <title>จัดการรายการสินค้า (Items Management) | ระบบบริหารจัดการใบเสร็จ</title>

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
        <legend class="fw-bold text-dark text-center border border-3 border-light bg-secondary shadow-sm p-2">จัดการรายการสินค้า (Items Management)</legend>
    </section>

    <!-- Alert ห้ามลบ -->
    <section class="container">
        <div class="row">
            <div class="col-md">
                <?php
                    // Alert เพิ่มรายการสำเร็จ
                    if(isset($_SESSION['addItem_success'])) {
                        echo "<div class='alert alert-success alert-dismissible fade show' role='alert'>";
                        echo "<button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>";
                        echo $_SESSION['addItem_success'];
                        unset($_SESSION['addItem_success']);
                        echo "</div>";
                    }

                    // Alert แก้ไขรายการสำเร็จ
                    else if(isset($_SESSION['editItem_success'])) {
                        echo "<div class='alert alert-success alert-dismissible fade show' role='alert'>";
                        echo "<button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>";
                        echo $_SESSION['editItem_success'];
                        unset($_SESSION['editItem_success']);
                        echo "</div>";
                    }

                    // Alert ลบรายการสำเร็จ
                    else if(isset($_SESSION['deleteItems_success'])) {
                        echo "<div class='alert alert-success alert-dismissible fade show' role='alert'>";
                        echo "<button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>";
                        echo $_SESSION['deleteItems_success'];
                        unset($_SESSION['deleteItems_success']);
                        echo "</div>";
                    }

                    // Alert รายการซ้ำ
                    else if(isset($_SESSION['addItem_error'])) {
                        echo "<div class='alert alert-danger alert-dismissible fade show' role='alert'>";
                        echo "<button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>";
                        echo $_SESSION['addItem_error'];
                        unset($_SESSION['addItem_error']);
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
                <h5 class="fw-bold"><i class="fa-solid fa-plus"></i> เพิ่มรายการสินค้า</h5>

                <form action="../db/db_listItemsManagement.php" method="POST">
                    <div class="row mb-3">
                        <div class="col-md-8">
                            <label for="itemName" class="form-label fw-bold">ชื่อรายการ :</label>
                            <input type="text" class="form-control" name="itemName" id="itemName" placeholder="ชื่อรายการสินค้า..." required>
                        </div>
                        <div class="col-md-4">
                        <label for="itemType" class="form-label fw-bold">ประเภทรายการ :</label>
                        <select class="form-select" aria-label="itemType" name="itemType" required>
                            <option selected>ค่าแรง</option>
                            <option>ค่าวัสดุ</option>
                        </select>
                        </div>
                    </div>
                    <div class="row mb-2">
                        <div class="col-md-8">
                            <button type="submit" name="addItems" class="btn btn-primary w-100"><i class="fa-solid fa-plus"></i> เพิ่ม</button>
                        </div>
                    </div>
                </form>
            </fieldset>
        </div>
    </section>  <!-- Closing Tag Container -->


    
    <section class="container">
        <div class="collapse show" id="collapseTable">
            <fieldset class="p-3 shadow-sm mt-2">
                <h5 class="fw-bold"><i class="fa-solid fa-table-list"></i> รายการสินค้าทั้งหมด</h5>
                <table class="table table-striped table-hover table-sm table-bordered css-serial">
                    <thead class="bg-dark text-light">
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">ชื่อรายการ</th>
                            <th scope="col">ประเภท</th>
                            <th scope="col">แก้ไข/อัพเดทข้อมูล</th>
                        </tr>
                    </thead>
                    <tbody class="align-middle">

                        <!-- query ตาราง ห้ามลบ -->
                        <?php
                            $stmt = $conn->query("SELECT * FROM item_info");
                            $stmt->execute();
                            $item = $stmt->fetchAll();

                            if (!$item) {
                                echo "<p><td colspan='4' class='text-center'>ไม่พบข้อมูล</td></p>";
                            } else {
                                foreach ($item as $fetch_itemInfo) {
                        ?>

                        <tr>
                            <td></td>
                            <td><?php echo $fetch_itemInfo['item_name']; ?></td>
                            <?php if ($fetch_itemInfo['item_type'] == 'ค่าแรง') { ?>
                                <td><span class="badge bg-warning"><?php echo $fetch_itemInfo['item_type']; ?></span></td>
                            <?php } else { ?>
                                <td><span class="badge bg-info"><?php echo $fetch_itemInfo['item_type']; ?></span></td>
                            <?php } ?>
                            <td>
                                <div class="btn-group" role="group" aria-label="Basic outlined example">
                                    <button type="button" class="btn btn-sm btn-outline-dark" data-bs-toggle="modal" data-bs-target="#modalEditItems<?php echo $fetch_itemInfo['id']; ?>"><i class="fas fa-edit"></i></button>
                                    <button type="button" class="btn btn-sm btn-outline-danger" data-bs-toggle="modal" data-bs-target="#modalDeleteItems<?php echo $fetch_itemInfo['id']; ?>"><i class="fas fa-trash"></i></button>
                                </div>
                            </td>
                        </tr>


                        <!-- Modal แก้ไขข้อมูล ห้ามลบ -->
                        <div class="modal fade" id="modalEditItems<?php echo $fetch_itemInfo['id']; ?>" tabindex="-1" aria-labelledby="modalEditItems" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="modalEditItems"><i class="fa-solid fa-pen-to-square"></i> แก้ไขรายการสินค้า (Edit Items)</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>

                                    <div class="modal-body">
                                        <form action="../db/db_listItemsManagement.php" method="POST">
                                            <div class="mb-0">
                                                <input type="hidden" class="form-control" name="id" value="<?php echo $fetch_itemInfo['id']; ?>" readonly required>
                                                <label for="editItemName" class="col-form-label">ชื่อรายการ :</label>
                                                <input type="text" class="form-control" name="editItemName" id="editItemName" value="<?php echo $fetch_itemInfo['item_name']; ?>" required>
                                            </div>
                                            <div class="mb-2">
                                                <label for="editItemType" class="col-form-label">แก้ไขประเภทรายการ :</label>
                                                <select class="form-select" aria-label="editItemType" name="editItemType" required>
                                                    <option>ค่าแรง</option>
                                                    <option>ค่าวัสดุ</option>
                                                </select>
                                            </div>

                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                <button type="submit" class="btn btn-primary" name="editItems"><i class="fa-solid fa-floppy-disk"></i> Save</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>


                        <!-- Modal ยืนยันลบข้อมูล ห้ามลบ -->
                        <div class="modal fade" id="modalDeleteItems<?php echo $fetch_itemInfo['id']; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title"><i class="fas fa-trash"></i> ยืนยันลบรายการสินค้า ?</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <h6 class="text-center">ต้องการลบรายการสินค้าหรือไม่ ? กรุณายืนยัน</h6>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                        <a data-id="<?php echo $fetch_itemInfo['id']; ?>" href="?deleteItems=<?php echo $fetch_itemInfo['id']; ?>" class="btn btn-danger"><i class="fas fa-trash"></i> Delete</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <?php } } ?>        <!-- endforeach -->
                    </tbody>
                </table>
            </fieldset>
        </div>
    </section>  <!-- Closing Tag Container -->

    <?php include "modal/modal_editItems.php"; ?>
    <?php include "modal/modal_editPassword.php"; ?>
</body>
</html>

<?php } ?>