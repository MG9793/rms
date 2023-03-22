<<<<<<< HEAD
<div class="modal fade" id="modalEditUser<?php //echo $userAccount['id_users']; ?>" tabindex="-1" aria-labelledby="modalEditUser" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalEditUser"><i class="fa-solid fa-pen-to-square"></i> แก้ไขบัญชีผู้ใช้งาน (Edit Account)</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <div class="modal-body">
                <form action="#" method="POST">
                    <!-- <h4 class="fw-bold text-dark">1. ข้อมูลทั่วไป</h4> -->
                    <div class="mb-0">
                        <input type="hidden" readonly value="<?php //echo $userAccount['id_users']; ?>" required class="form-control" name="id_users">
                        <label class="col-form-label font-weight-normal">ชื่อ :</label>
                        <input type="text" value="<?php //echo $userAccount['name']; ?>" required class="form-control" name="name">
                    </div>
                    <div class="mb-0">
                        <label class="col-form-label font-weight-normal">นามสกุล :</label>
                        <input type="text" value="<?php //echo $userAccount['lastName']; ?>" required class="form-control" name="lastname">
                    </div>
                    <div class="mb-0">
                        <label for="editUserStatus" class="col-form-label">สถานะการใช้งาน :</label>
                        <select class="form-select" aria-label="editUserStatus" name="editUserStatus" required>
                            <option>Admin</option>
                            <option>User</option>
                        </select>
                    </div>
                    <hr>

                    <!-- <h4 class="fw-bold text-dark">2. บัญชีผู้ใช้</h4> -->
                    <div class="mb-0">
                        <label for="email" class="col-form-label font-weight-normal">ชื่อผูัใช้ (สำหรับ Login เข้าสู่ระบบ) :</label>
                        <input type="email" value="<?php //echo $userAccount['email']; ?>" required class="form-control" disabled>
                    </div>
                    <div class="mt-0">
                        <label for="password" class="col-form-label font-weight-normal">รหัสผ่าน (อย่างน้อย 8 ตัวอักษร) :</label>
                        <input type="password" minlength="8" required class="form-control" name="password">
                    </div>
                    <div class="mb-0">
                        <label for="confirmpassword" class="col-form-label font-weight-normal">ยืนยันรหัสผ่าน :</label>
                        <input type="password" minlength="8" required class="form-control" name="confirmPassword">
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary" name="editUser"><i class="fa-solid fa-floppy-disk"></i> Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
=======
<div class="modal fade" id="modalEditUser<?php //echo $userAccount['id_users']; ?>" tabindex="-1" aria-labelledby="modalEditUser" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalEditUser"><i class="fa-solid fa-pen-to-square"></i> แก้ไขบัญชีผู้ใช้งาน (Edit Account)</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <div class="modal-body">
                <form action="#" method="POST">
                    <!-- <h4 class="fw-bold text-dark">1. ข้อมูลทั่วไป</h4> -->
                    <div class="mb-0">
                        <input type="hidden" readonly value="<?php //echo $userAccount['id_users']; ?>" required class="form-control" name="id_users">
                        <label class="col-form-label font-weight-normal">ชื่อ :</label>
                        <input type="text" value="<?php //echo $userAccount['name']; ?>" required class="form-control" name="name">
                    </div>
                    <div class="mb-0">
                        <label class="col-form-label font-weight-normal">นามสกุล :</label>
                        <input type="text" value="<?php //echo $userAccount['lastName']; ?>" required class="form-control" name="lastname">
                    </div>
                    <div class="mb-0">
                        <label for="editUserStatus" class="col-form-label">สถานะการใช้งาน :</label>
                        <select class="form-select" aria-label="editUserStatus" name="editUserStatus" required>
                            <option>Admin</option>
                            <option>User</option>
                        </select>
                    </div>
                    <hr>

                    <!-- <h4 class="fw-bold text-dark">2. บัญชีผู้ใช้</h4> -->
                    <div class="mb-0">
                        <label for="email" class="col-form-label font-weight-normal">ชื่อผูัใช้ (สำหรับ Login เข้าสู่ระบบ) :</label>
                        <input type="email" value="<?php //echo $userAccount['email']; ?>" required class="form-control" disabled>
                    </div>
                    <div class="mt-0">
                        <label for="password" class="col-form-label font-weight-normal">รหัสผ่าน (อย่างน้อย 8 ตัวอักษร) :</label>
                        <input type="password" minlength="8" required class="form-control" name="password">
                    </div>
                    <div class="mb-0">
                        <label for="confirmpassword" class="col-form-label font-weight-normal">ยืนยันรหัสผ่าน :</label>
                        <input type="password" minlength="8" required class="form-control" name="confirmPassword">
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary" name="editUser"><i class="fa-solid fa-floppy-disk"></i> Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
>>>>>>> danai
</div>