<div class="modal fade" id="modalEditSite<?php //echo $userAccount['id_users']; ?>" tabindex="-1" aria-labelledby="modalEditSite" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalEditSite"><i class="fa-solid fa-pen-to-square"></i> แก้ไขข้อมูลไซต์งาน (Edit Site)</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <div class="modal-body">
                <form action="#" method="POST">
                    <!-- <div class="mb-0 mt-2">
                        <input type="hidden" readonly value="<?php //echo $userAccount['id_users']; ?>" required class="form-control" name="id_users">
                        <label class="col-form-label font-weight-normal">ชื่อ :</label>
                        <input type="text" value="<?php //echo $userAccount['name']; ?>" required class="form-control" name="name">
                    </div>
                    <div class="mb-0 mt-2">
                        <label class="col-form-label font-weight-normal">นามสกุล :</label>
                        <input type="text" value="<?php //echo $userAccount['lastName']; ?>" required class="form-control" name="lastname">
                    </div>
                    <div class="mb-0 mt-2">
                        <label for="editPosition" class="form-label">ตำแหน่ง :</label>
                        <select class="form-select" aria-label="editPosition" name="editPosition" required>
                            <option>ตำแหน่ง 1</option>
                            <option>ตำแหน่ง 1</option>
                            <option>ตำแหน่ง 1</option>
                        </select>
                    </div>
                    <div class="mb-0 mt-2">
                        <label for="editUserStatus" class="form-label">สถานะการใช้งานระบบ :</label>
                        <select class="form-select" aria-label="editUserStatus" name="editUserStatus" required>
                            <option>Admin</option>
                            <option>User</option>
                        </select>
                    </div>
                    <hr>
                                            
                    <div class="mb-0 mt-2">
                        <label for="email" class="col-form-label font-weight-normal">อีเมลล์ (ใช้สำหรับ Login เข้าสู่ระบบ) :</label>
                        <input type="email" value="<?php //echo $userAccount['email']; ?>" required class="form-control" disabled>
                    </div>
                    <div class="mt-0 mt-2">
                        <label for="password" class="col-form-label font-weight-normal">รหัสผ่าน (อย่างน้อย 8 ตัวอักษร) :</label>
                        <input type="password" minlength="8" required class="form-control" name="password">
                    </div>
                    <div class="mb-3 mt-2">
                        <label for="confirmpassword" class="col-form-label font-weight-normal">ยืนยันรหัสผ่าน :</label>
                        <input type="password" minlength="4" required class="form-control" name="confirmPassword">
                    </div> -->

                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary" name="editUser"><i class="fa-solid fa-floppy-disk"></i> Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>