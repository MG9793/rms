
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
        <legend class="fw-bold text-dark text-center p-2">จัดการผู้ใชังาน (User Management)</legend>
            <form action="../db/db_userManagement.php" method="POST">
                <div class="row">
                    <div class="col-md-4 mb-2">
                        <label for="name" class="form-label">ชื่อ :</label>
                        <input type="text" class="form-control" name="name" id="name" required>
                    </div>
                    <div class="col-md-4 mb-2">
                        <label for="lastName" class="form-label">นามสกุล :</label>
                        <input type="text" class="form-control" name="lastName" id="lastName" required>
                    </div>
                    <div class="col-md-4 mb-2">
                        <label for="userPermission" class="form-label">สิทธิการใช้งาน :</label>
                        <select class="form-select" aria-label="userPermission" name="userPermission" required>
                            <option>Admin</option>
                            <option>Procurement</option>
                            <option>Account</option>
                        </select>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-4 mb-2">
                        <label for="userName" class="form-label">ชื่อผู้ใช้ (Username) :</label>
                        <input type="text" class="form-control" name="userName" id="userName" required>
                    </div>
                    <div class="col-md-4 mb-2">
                        <label for="password" class="form-label">Password (อย่างน้อย 8 ตัวอักษร) :</label>
                        <input type="password" class="form-control" name="password" id="password" placeholder="xxxxxxxx" minlength="8" required>
                    </div>
                    <div class="col-md-4 mb-2">
                        <label for="confirmPassword" class="form-label">Confirm Password :</label>
                        <input type="password" class="form-control" name="confirmPassword" id="confirmPassword" placeholder="xxxxxxxx" minlength="8" required>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12 mb-2">
                        <button type="submit" class="btn btn-success w-100" name="registerUser"><i class="fa-solid fa-plus"></i> เพิ่ม</button>
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
                        <th scope="col">ชื่อ</th>
                        <th scope="col">นามสกุล</th>
                        <th scope="col">ชื่อผู้ใช้</th>
                        <th scope="col">สิทธิการใช้งาน</th>
                        <th scope="col">แก้ไข</th>
                    </tr>
                </thead>
                <tbody class="align-middle">

                    <!-- query ตาราง ห้ามลบ -->
                    <?php
                        $stmt = $conn->query("SELECT id, name, lastname, username, permission FROM user_info");
                        $stmt->execute();
                        $user = $stmt->fetchAll();

                        if (!$user) {
                            echo "<p><td colspan='6' class='text-center'>ไม่พบข้อมูล</td></p>";
                        } else {
                            foreach ($user as $fetch_userInfo) {
                    ?>

                    <tr>
                        <td></td>
                        <td><?php echo $fetch_userInfo['name']; ?></td>
                        <td><?php echo $fetch_userInfo['lastname']; ?></td>
                        <td><?php echo $fetch_userInfo['username']; ?></td>
                        <?php if ($fetch_userInfo['permission'] == 'Admin') { ?>
                            <td><span class="badge bg-success"><?php echo $fetch_userInfo["permission"]; ?></span></td>
                        <?php } else { ?>
                            <td><span class="badge bg-danger"><?php echo $fetch_userInfo["permission"]; ?></span></td>
                        <?php } ?>

                        </td>
                        <td>
                            <div class="btn-group" role="group" aria-label="Basic outlined example">
                                <button type="button" class="btn btn-sm btn-outline-dark" data-bs-toggle="modal" data-bs-target="#modalEditUser<?php echo $fetch_userInfo['id']; ?>"><i class="fas fa-edit"></i></button>
                                <button type="button" class="btn btn-sm btn-outline-danger" data-bs-toggle="modal" data-bs-target="#modalDeleteUser<?php echo $fetch_userInfo['id']; ?>"><i class="fas fa-trash"></i></button>
                            </div>
                        </td>
                    </tr>


                    <!-- Modal แก้ไขข้อมูล ห้ามลบ -->
                    <div class="modal fade" id="modalEditUser<?php echo $fetch_userInfo['id']; ?>" tabindex="-1" aria-labelledby="modalEditUser" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="modalEditUser"><i class="fa-solid fa-pen-to-square"></i> แก้ไขชื่อผู้ใช้งาน (Edit User)</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>

                                <div class="modal-body">
                                    <form action="../db/db_userManagement.php" method="POST">
                                        <div class="mb-0">
                                            <input type="hidden" class="form-control" name="id" value="<?php echo $fetch_userInfo['id']; ?>" readonly required>
                                            <label for="editName" class="col-form-label">ชื่อ :</label>
                                            <input type="text" class="form-control" name="editName" id="editName" value="<?php echo $fetch_userInfo['name']; ?>" required>
                                        </div>
                                    <div class="mb-0">
                                        <label for="editLastname" class="col-form-label">นามสกุล :</label>
                                        <input type="text" class="form-control" name="editLastname" id="editLastname" value="<?php echo $fetch_userInfo['lastname']; ?>" required>
                                    </div>
                                        <div class="mb-0">
                                            <label for="editUsername" class="col-form-label">ชื่อผู้ใช้ (Username) :</label>
                                            <input type="text" class="form-control" name="editUsername" id="editUsername" value="<?php echo $fetch_userInfo['username']; ?>" required>
                                        </div>
                                        <div class="mb-0">
                                            <label for="editPermission" class="col-form-label">สิทธิการใช้งาน :</label>
                                            <select class="form-select" aria-label="editPermission" name="editPermission" required>
                                                <option>Admin</option>
                                                <option>User</option>
                                            </select>
                                        </div>
                                        <div class="mb-0">
                                            <label for="editPassword" class="col-form-label">Password (อย่างน้อย 8 ตัวอักษร) :</label>
                                            <input type="password" class="form-control" name="editPassword" id="editPassword" placeholder="xxxxxxxx" minlength="8" required>
                                        </div>
                                        <div class="mb-2">
                                            <label for="editConfirmPassword" class="col-form-label">Confirm Password :</label>
                                            <input type="password" class="form-control" name="editConfirmPassword" id="editConfirmPassword" placeholder="xxxxxxxx" minlength="8" required>
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


                    <!-- Modal ยืนยันลบข้อมูล ห้ามลบ -->
                    <div class="modal fade" id="modalDeleteUser<?php echo $fetch_userInfo['id']; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title"><i class="fas fa-trash"></i> ยืนยันลบข้อมูลผู้ใช้ ?</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <h6 class="text-center">ต้องการลบข้อมูลผู้ใช้หรือไม่ ? กรุณายืนยัน</h6>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                    <a data-id="<?php echo $fetch_userInfo['id']; ?>" href="?deleteUser=<?php echo $fetch_userInfo['id']; ?>" class="btn btn-danger"><i class="fas fa-trash"></i> Delete</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php } } ?>        <!-- endforeach -->
                </tbody>
            </table>
        </fieldset>
    </section>


</body>
</html>
