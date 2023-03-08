<div class="modal fade" id="modalEditUser<?php //echo $userAccount['id_users']; ?>" tabindex="-1" aria-labelledby="modalEditUser" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-primary">
                <h5 class="modal-title text-light" id="modalEditUser"><i class="fa-solid fa-pen-to-square"></i> แก้ไขบัญชีผู้ใช้งาน (Edit Account)</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <div class="modal-body">
                <form action="#" method="POST">
                    <h4 class="fw-bold text-primary">1. ข้อมูลทั่วไป</h4>
                    <div class="mb-0 mt-2">
                        <input type="hidden" readonly value="<?php //echo $userAccount['id_users']; ?>" required class="form-control" name="id_users">
                        <label class="col-form-label font-weight-normal"><i class="fa-solid fa-user"></i> ชื่อ :</label>
                        <input type="text" value="<?php //echo $userAccount['name']; ?>" required class="form-control" name="name">
                    </div>
                    <div class="mb-0 mt-2">
                        <label class="col-form-label font-weight-normal"><i class="fa-solid fa-signature"></i> นามสกุล :</label>
                        <input type="text" value="<?php //echo $userAccount['lastName']; ?>" required class="form-control" name="lastname">
                    </div>
                    <div class="mb-0 mt-2">
                        <label for="editPosition" class="form-label"><i class="fa-solid fa-briefcase"></i> ตำแหน่ง :</label>
                        <select class="form-select" aria-label="editPosition" name="editPosition" required>
                            <option>ตำแหน่ง 1</option>
                            <option>ตำแหน่ง 1</option>
                            <option>ตำแหน่ง 1</option>
                        </select>
                    </div>
                    <div class="mb-0 mt-2">
                        <label for="editUserStatus" class="form-label"><i class="fa-solid fa-lock-open"></i> สถานะการใช้งานระบบ :</label>
                        <select class="form-select" aria-label="editUserStatus" name="editUserStatus" required>
                            <option>Admin</option>
                            <option>User</option>
                        </select>
                    </div>
                    <hr>
                                            
                    <h4 class="fw-bold text-primary">2. บัญชีผู้ใช้</h4>
                    <div class="mb-0 mt-2">
                        <label for="email" class="col-form-label font-weight-normal"><i class="fa-solid fa-envelope-circle-check"></i> อีเมลล์ (ใช้สำหรับ Login เข้าสู่ระบบ) :</label>
                        <input type="email" value="<?php //echo $userAccount['email']; ?>" required class="form-control" disabled>
                    </div>
                    <div class="mt-0 mt-2">
                        <label for="password" class="col-form-label font-weight-normal"><i class="fa-solid fa-key"></i> รหัสผ่าน (อย่างน้อย 8 ตัวอักษร) :</label>
                        <input type="password" minlength="8" required class="form-control" name="password">
                    </div>
                    <div class="mb-3 mt-2">
                        <label for="confirmpassword" class="col-form-label font-weight-normal"><i class="fa-solid fa-key"></i> ยืนยันรหัสผ่าน :</label>
                        <input type="password" minlength="4" required class="form-control" name="confirmPassword">
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