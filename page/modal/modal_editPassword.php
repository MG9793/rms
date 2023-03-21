<div class="modal fade" id="modalPassword<?php //echo $userAccount['id_users']; ?>" tabindex="-1" aria-labelledby="modalPassword" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalPassword"><i class="fa-solid fa-pen-to-square"></i> แก้ไขรหัสผ่าน (Edit Password)</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <div class="modal-body">
                <form action="#" method="POST">
                    <div class="mb-0">
                        <label for="text" class="col-form-label font-weight-normal"><i class="fa-solid fa-circle-user"></i> ชื่อผู้ใช้ :</label>
                        <input type="text" value="<?php //echo $userAccount['email']; ?>" required class="form-control" disabled>
                    </div>
                    <hr>
                    <div class="mb-0">
                        <label for="password" class="col-form-label font-weight-normal"><i class="fa-solid fa-key"></i> รหัสผ่าน (อย่างน้อย 8 ตัวอักษร) :</label>
                        <input type="password" minlength="8" required class="form-control" name="password">
                    </div>
                    <div class="mb-0">
                        <label for="confirmpassword" class="col-form-label font-weight-normal"><i class="fa-solid fa-key"></i> ยืนยันรหัสผ่าน :</label>
                        <input type="password" minlength="4" required class="form-control" name="confirmPassword">
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-dark" name="editUser"><i class="fa-solid fa-floppy-disk"></i> Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>