<?php
    session_start();
    require_once "../db/config/conn.php";
    require_once "../db/config/deleteRow.php";

    if (!isset($_SESSION['admin_login'])) {
        header("location: ../login.php");
    } else {

        // query ชื่อผู้ใช้งาน
        $id = $_SESSION['admin_login'];
        $stmt = $conn->query("SELECT name, lastname, username FROM user_info WHERE id = $id");
        $stmt->execute();
        $userName_query = $stmt->fetch(PDO::FETCH_ASSOC);
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>จัดการผู้ใช้งาน (User Management) | ระบบบริหารจัดการใบเสร็จ</title>

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
        <legend class="fw-bold text-dark text-center border border-3 border-light bg-secondary shadow-sm p-2">จัดการผู้ใชังาน (User Management)</legend>
    </section>

    <!-- Alert ห้ามลบ -->
    <section class="container">
        <div class="row">
            <div class="col-md">
            <?php
                // Alert เพิ่มผู้ใช้สำเร็จ
                if(isset($_SESSION['addUser_success'])) {
                    echo "<div class='alert alert-success alert-dismissible fade show' role='alert'>";
                    echo "<button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>";
                    echo $_SESSION['addUser_success'];
                    unset($_SESSION['addUser_success']);
                    echo "</div>";
                }

                // Alert ยืนยันรหัสผ่านไม่ถูกต้อง
                else if(isset($_SESSION['confirmPassword_error'])) {
                    echo "<div class='alert alert-danger alert-dismissible fade show' role='alert'>";
                    echo "<button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>";
                    echo $_SESSION['confirmPassword_error'];
                    unset($_SESSION['confirmPassword_error']);
                    echo "</div>";
                }

                // Alert username ซ้ำ
                else if(isset($_SESSION['userName_error'])) {
                    echo "<div class='alert alert-danger alert-dismissible fade show' role='alert'>";
                    echo "<button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>";
                    echo $_SESSION['userName_error'];
                    unset($_SESSION['userName_error']);
                    echo "</div>";
                }

                // Alert ลงทะเบียนสำเร็จ
                else if(isset($_SESSION['registerSuccess'])) {
                    echo "<div class='alert alert-success alert-dismissible fade show' role='alert'>";
                    echo "<button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>";
                    echo $_SESSION['registerSuccess'];
                    unset($_SESSION['registerSuccess']);
                    echo "</div>";
                }

                // Alert ลบรายการสำเร็จ
                else if(isset($_SESSION['deleteUser_success'])) {
                    echo "<div class='alert alert-success alert-dismissible fade show' role='alert'>";
                    echo "<button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>";
                    echo $_SESSION['deleteUser_success'];
                    unset($_SESSION['deleteUser_success']);
                    echo "</div>";
                }

                // Alert ลบรายการไม่สำเร็จ
                else if(isset($_SESSION['deleteUser_error'])) {
                    echo "<div class='alert alert-danger alert-dismissible fade show' role='alert'>";
                    echo "<button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>";
                    echo $_SESSION['deleteUser_error'];
                    unset($_SESSION['deleteUser_error']);
                    echo "</div>";
                }

                // Alert ยืนยันรหัสผ่านไม่ถูกต้อง
                else if(isset($_SESSION['editPassword_error'])) {
                    echo "<div class='alert alert-danger alert-dismissible fade show' role='alert'>";
                    echo "<button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>";
                    echo $_SESSION['editPassword_error'];
                    unset($_SESSION['editPassword_error']);
                    echo "</div>";
                }

                // Alert แก้ไขข้อมูลผู้ใช้สำเร็จ
                else if(isset($_SESSION['editUser_success'])) {
                    echo "<div class='alert alert-success alert-dismissible fade show' role='alert'>";
                    echo "<button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>";
                    echo $_SESSION['editUser_success'];
                    unset($_SESSION['editUser_success']);
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
                <h5 class="fw-bold"><i class="fa-solid fa-plus"></i> เพิ่มผู้ใช้งาน</h5>

                <form action="../db/db_userManagement.php" method="POST">
                    <div class="row mb-3">
                        <div class="col-md-4">
                            <label for="name" class="form-label fw-bold">ชื่อ :</label>
                            <input type="text" class="form-control" name="name" id="name" placeholder="Your name.." required>
                        </div>
                        <div class="col-md-4">
                            <label for="lastName" class="form-label fw-bold">นามสกุล :</label>
                            <input type="text" class="form-control" name="lastName" id="lastName" placeholder="Your lastname.." required>
                        </div>
                        <div class="col-md-4">
                            <label for="userPermission" class="form-label fw-bold">สิทธิการใช้งาน :</label>
                            <select class="form-select" aria-label="userPermission" name="userPermission" required>
                                <option>Admin</option>
                                <option>User</option>
                            </select>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-md-4">
                            <label for="userName" class="form-label fw-bold">ชื่อผู้ใช้ (Username) :</label>
                            <input type="text" class="form-control" name="userName" id="userName" placeholder="username.." required>
                        </div>
                        <div class="col-md-4">
                            <label for="password" class="form-label fw-bold">Password (อย่างน้อย 8 ตัวอักษร) :</label>
                            <input type="password" class="form-control" name="password" id="password" placeholder="xxxxxxxx" minlength="8" required>
                        </div>
                        <div class="col-md-4">
                            <label for="confirmPassword" class="form-label fw-bold">Confirm Password :</label>
                            <input type="password" class="form-control" name="confirmPassword" id="confirmPassword" placeholder="xxxxxxxx" minlength="8" required>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-8">
                            <button type="submit" class="btn btn-primary w-100" name="registerUser"><i class="fa-solid fa-plus"></i> เพิ่ม</button>
                        </div>
                        <div class="col-md-4">
                            <button type="reset" class="btn btn-warning w-100"><i class="fa-solid fa-rotate-right"></i> เคลียร์</button>
                        </div>
                    </div>
                </form>
            </fieldset>
        </div>
    </section>  <!-- Closing Tag Container -->

    
    <section class="container">
        <div class="collapse show" id="collapseTable">
            <fieldset class="p-3 shadow-sm mt-2">
                <h5 class="fw-bold"><i class="fa-solid fa-table-list"></i> รายการผู้ใช้งานทั้งหมด</h5>
                <table class="table table-striped table-hover table-sm table-bordered css-serial">
                    <thead class="bg-dark text-light">
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
        </div>
    </section>


</body>
</html>

<?php } ?>