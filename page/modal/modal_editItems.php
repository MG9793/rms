<<<<<<< HEAD
<div class="modal fade" id="modalEditItems<?php //echo $userAccount['id_users']; ?>" tabindex="-1" aria-labelledby="modalEditItems" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalEditItems"><i class="fa-solid fa-pen-to-square"></i> แก้ไขข้อมูลรายการสินค้า (Edit Items)</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <div class="modal-body">
                <form action="#" method="POST">
                    <div class="mb-0">
                        <input type="hidden" readonly value="<?php //echo $userAccount['id_users']; ?>" required class="form-control" name="id_users">
                        <label for="itemsName" class="col-form-label">ชื่อรายการ :</label>
                        <input type="text" value="<?php //echo $userAccount['name']; ?>" class="form-control" name="itemsName" required>
                    </div>
                    <div class="mb-0">
                        <label for="editItemsType" class="col-form-label">ประเภทรายการ :</label>
                        <select class="form-select" aria-label="editItemsType" name="editItemsType" required>
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
=======
<div class="modal fade" id="modalEditItems<?php //echo $userAccount['id_users']; ?>" tabindex="-1" aria-labelledby="modalEditItems" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalEditItems"><i class="fa-solid fa-pen-to-square"></i> แก้ไขข้อมูลรายการสินค้า (Edit Items)</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <div class="modal-body">
                <form action="#" method="POST">
                    <div class="mb-0">
                        <input type="hidden" readonly value="<?php //echo $userAccount['id_users']; ?>" required class="form-control" name="id_users">
                        <label for="itemsName" class="col-form-label">ชื่อรายการ :</label>
                        <input type="text" value="<?php //echo $userAccount['name']; ?>" class="form-control" name="itemsName" required>
                    </div>
                    <div class="mb-0">
                        <label for="editItemsType" class="col-form-label">ประเภทรายการ :</label>
                        <select class="form-select" aria-label="editItemsType" name="editItemsType" required>
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
>>>>>>> danai
</div>