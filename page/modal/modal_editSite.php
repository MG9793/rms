<div class="modal fade" id="modalEditSite<?php //echo $userAccount['id_users']; ?>" tabindex="-1" aria-labelledby="modalEditSite" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalEditSite"><i class="fa-solid fa-pen-to-square"></i> แก้ไขข้อมูลไซต์งาน (Edit Site)</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <div class="modal-body">
                <form action="#" method="POST">
                    <div class="mb-0">
                        <input type="hidden" readonly value="<?php //echo $userAccount['id_users']; ?>" required class="form-control" name="id_users">
                        <label for="siteName" class="col-form-label">ชื่อไซต์งาน :</label>
                        <input type="text" value="<?php //echo $userAccount['name']; ?>" class="form-control" name="siteName" required>
                    </div>
                    <div class="mb-0">
                        <label for="siteAbbre" class="col-form-label">อักษรย่อไซต์งาน :</label>
                        <input type="text" value="<?php //echo $userAccount['lastName']; ?>" class="form-control" name="siteAbbre" required>
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary" name="editUser"><i class="fa-solid fa-floppy-disk"></i> Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>