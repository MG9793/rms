<?php
session_start();
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
            <legend class="fw-bold text-dark text-center p-2">จัดการรายการสินค้า (Items Management)</legend>
            <form action="../db/db_listItemsManagement.php" method="POST">
                <div class="row">
                    <div class="col-md-8 mb-2">
                        <label for="itemName" class="form-label">ชื่อรายการ :</label>
                        <input type="text" class="form-control" name="itemName" id="itemName" required>
                    </div>
                    <div class="col-md-4 mb-2">
                        <label for="itemType" class="form-label">ประเภทรายการ :</label>
                        <select class="form-select" aria-label="itemType" name="itemType" required>
                            <option selected>ค่าแรง</option>
                            <option>ค่าวัสดุ</option>
                        </select>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12 mb-2">
                        <button type="submit" class="btn btn-success w-100" name="addItems"><i class="fa-solid fa-plus"></i> เพิ่ม</button>
                    </div>
                </div>
            </form>
        </div>
    </section>


    <section class="container my-2">
        <fieldset class="p-3 shadow-sm mt-2">
            <table class="table table-striped table-hover shadow-sm css-serial" id="myTable">
                <thead>
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
    </section>  <!-- Closing Tag Container -->

</body>
</html>

