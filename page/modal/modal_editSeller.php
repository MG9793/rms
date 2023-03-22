<<<<<<< HEAD
<div class="modal fade" id="modalEditSeller<?php //echo $userAccount['id_users']; ?>" tabindex="-1" aria-labelledby="modalEditSeller" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalEditSeller"><i class="fa-solid fa-pen-to-square"></i> แก้ไขข้อมูลจัดการผู้ขาย (Edit Seller)</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <div class="modal-body">
                <form action="#" method="POST">
                    <div class="mb-0">
                        <input type="hidden" readonly value="<?php //echo $userAccount['id_users']; ?>" required class="form-control" name="id_users">
                        <label for="sellerName" class="col-form-label">ชื่อผู้ขาย :</label>
                        <input type="text" value="<?php //echo $userAccount['name']; ?>" class="form-control" name="sellerName" required>
                    </div>
                    <div class="mb-0">
                        <label for="sellerTaxID" class="col-form-label">เลขประจำตัวผู้เสียภาษี :</label>
                        <input type="text" value="<?php //echo $userAccount['lastName']; ?>" class="form-control" name="sellerTaxID" required>
                    </div>
                    <div class="mb-0">
                        <label for="companyName" class="col-form-label">สถานประกอบการ :</label>
                        <input type="text" value="<?php //echo $userAccount['lastName']; ?>" class="form-control" name="companyName" required>
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary" name="editSeller"><i class="fa-solid fa-floppy-disk"></i> Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
=======
<div class="modal fade" id="modalEditSeller<?php //echo $userAccount['id_users']; ?>" tabindex="-1" aria-labelledby="modalEditSeller" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalEditSeller"><i class="fa-solid fa-pen-to-square"></i> แก้ไขข้อมูลจัดการผู้ขาย (Edit Seller)</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <div class="modal-body">
                <form action="#" method="POST">
                    <div class="mb-0">
                        <input type="hidden" readonly value="<?php //echo $userAccount['id_users']; ?>" required class="form-control" name="id_users">
                        <label for="sellerName" class="col-form-label">ชื่อผู้ขาย :</label>
                        <input type="text" value="<?php //echo $userAccount['name']; ?>" class="form-control" name="sellerName" required>
                    </div>
                    <div class="mb-0">
                        <label for="sellerTaxID" class="col-form-label">เลขประจำตัวผู้เสียภาษี :</label>
                        <input type="text" value="<?php //echo $userAccount['lastName']; ?>" class="form-control" name="sellerTaxID" required>
                    </div>
                    <div class="mb-0">
                        <label for="companyName" class="col-form-label">สถานประกอบการ :</label>
                        <input type="text" value="<?php //echo $userAccount['lastName']; ?>" class="form-control" name="companyName" required>
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary" name="editSeller"><i class="fa-solid fa-floppy-disk"></i> Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
>>>>>>> danai
</div>