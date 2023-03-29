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
    <title>จัดการไซต์งาน (Site Management) | ระบบบริหารจัดการใบเสร็จ</title>

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
        <legend class="fw-bold text-dark text-center border border-3 border-light bg-secondary shadow-sm p-2">จัดการไซต์งาน (Site Management)</legend>
    </section>

    <!-- Alert ห้ามลบ -->
    <section class="container">
        <div class="row">
            <div class="col-md">
                <?php
                    // Alert เพิ่มรายการสำเร็จ
                    if(isset($_SESSION['addSite_success'])) {
                        echo "<div class='alert alert-success alert-dismissible fade show' role='alert'>";
                        echo "<button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>";
                        echo $_SESSION['addSite_success'];
                        unset($_SESSION['addSite_success']);
                        echo "</div>";
                    }

                    // Alert แก้ไขรายการสำเร็จ
                    else if(isset($_SESSION['editSite_success'])) {
                        echo "<div class='alert alert-success alert-dismissible fade show' role='alert'>";
                        echo "<button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>";
                        echo $_SESSION['editSite_success'];
                        unset($_SESSION['editSite_success']);
                        echo "</div>";
                    }

                    // Alert ลบรายการสำเร็จ
                    else if(isset($_SESSION['deleteSite_success'])) {
                        echo "<div class='alert alert-success alert-dismissible fade show' role='alert'>";
                        echo "<button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>";
                        echo $_SESSION['deleteSite_success'];
                        unset($_SESSION['deleteSite_success']);
                        echo "</div>";
                    }

                    // Alert รายการซ้ำ
                    else if(isset($_SESSION['addSite_error'])) {
                        echo "<div class='alert alert-danger alert-dismissible fade show' role='alert'>";
                        echo "<button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>";
                        echo $_SESSION['addSite_error'];
                        unset($_SESSION['addSite_error']);
                        echo "</div>";
                    }
                ?>
            </div>
        </div>
    </section>

    <div class="container">
        <button type="button" class="btn btn-light w-100" data-bs-toggle="modal" data-bs-target="#modalAddSite"><i class="fa-solid fa-plus"></i> เพิ่มไซต์งาน</button>
    </div>

    <!-- Modal เพิ่มข้อมูล ห้ามลบ -->
    <div class="modal fade" id="modalAddSite" tabindex="-1" aria-labelledby="modalAddSite" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalAddSite"><i class="fa-solid fa-plus"></i> เพิ่มไซต์งาน (Add Sites)</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <div class="modal-body">
                    <form action="../db/db_siteManagement.php" method="POST">
                        <div class="mb-2">
                            <label for="siteName" class="form-label">ชื่อไซต์งาน :</label>
                            <input type="text" class="form-control" name="siteName" id="siteName" required>
                        </div>
                        <div class="mb-2">
                            <label for="siteAbbre" class="form-label">อักษรย่อไซต์งาน :</label>
                            <input type="text" class="form-control" name="siteAbbre" id="siteAbbre" required>
                        </div>

                        <div class="modal-footer">
                            <button type="submit" class="btn btn-dark w-100" name="addSite"><i class="fa-solid fa-plus"></i> เพิ่ม</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <section class="container my-2">
        <fieldset class="p-3 shadow-sm mt-2">
            <table class="table table-striped table-hover shadow-sm css-serial" id="myTable">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">ชื่อไซต์งาน</th>
                        <th scope="col">อักษรย่อ</th>
                        <th scope="col">แก้ไข/อัพเดทข้อมูล</th>
                    </tr>
                </thead>
                <tbody class="align-middle">

                    <!-- query ตาราง ห้ามลบ -->
                    <?php
                        $stmt = $conn->query("SELECT * FROM site_info");
                        $stmt->execute();
                        $site = $stmt->fetchAll();

                        if (!$site) {
                            echo "<p><td colspan='4' class='text-center'>ไม่พบข้อมูล</td></p>";
                        } else {
                            foreach ($site as $fetch_siteInfo) {
                    ?>

                    <tr>
                        <td></td>
                        <td><?php echo $fetch_siteInfo['site_name']; ?></td>
                        <td><?php echo $fetch_siteInfo['site_abbre']; ?></td>
                        <td>
                            <div class="btn-group" role="group" aria-label="Basic outlined example">
                                <button type="button" class="btn btn-sm btn-outline-dark" data-bs-toggle="modal" data-bs-target="#modalEditSite<?php echo $fetch_siteInfo['id']; ?>"><i class="fas fa-edit"></i></button>
                                <button type="button" class="btn btn-sm btn-outline-danger" data-bs-toggle="modal" data-bs-target="#modalDeleteSite<?php echo $fetch_siteInfo['id']; ?>"><i class="fas fa-trash"></i></button>
                            </div>
                        </td>
                    </tr>


                    <!-- Modal แก้ไขข้อมูล ห้ามลบ -->
                    <div class="modal fade" id="modalEditSite<?php echo $fetch_siteInfo['id']; ?>" tabindex="-1" aria-labelledby="modalEditSite" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="modalEditSite"><i class="fa-solid fa-pen-to-square"></i> แก้ไขรายการไซต์งาน (Edit Sites)</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>

                                <div class="modal-body">
                                    <form action="../db/db_siteManagement.php" method="POST">
                                        <div class="mb-0">
                                            <input type="hidden" class="form-control" name="id" value="<?php echo $fetch_siteInfo['id']; ?>" readonly required>
                                            <label for="editSiteName" class="col-form-label">ชื่อไซต์งาน :</label>
                                            <input type="text" class="form-control" name="editSiteName" id="editSiteName" value="<?php echo $fetch_siteInfo['site_name']; ?>" required>
                                        </div>
                                        <div class="mb-2">
                                            <label for="editSiteAbbre" class="col-form-label">อักษรย่อไซต์งาน :</label>
                                            <input type="text" class="form-control" name="editSiteAbbre" id="editSiteAbbre" value="<?php echo $fetch_siteInfo['site_abbre']; ?>" required>
                                        </div>

                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                            <button type="submit" class="btn btn-dark" name="editSite"><i class="fa-solid fa-floppy-disk"></i> Save</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>


                    <!-- Modal ยืนยันลบข้อมูล ห้ามลบ -->
                    <div class="modal fade" id="modalDeleteSite<?php echo $fetch_siteInfo['id']; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title"><i class="fas fa-trash"></i> ยืนยันลบรายการไซต์งาน ?</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <h6 class="text-center">ต้องการลบไซต์งานหรือไม่ ? กรุณายืนยัน</h6>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                    <a data-id="<?php echo $fetch_siteInfo['id']; ?>" href="?deleteSite=<?php echo $fetch_siteInfo['id']; ?>" class="btn btn-danger"><i class="fas fa-trash"></i> Delete</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php } } ?>        <!-- endforeach -->
                </tbody>
            </table>
        </fieldset>
    </section>


    <script>
        // function calculateDays() {
        //     var startDate = new Date(document.getElementById("projectStart").value);
        //     var endDate = new Date(document.getElementById("projectEnd").value);
        //     var timeDiff = Math.abs(endDate.getTime() - startDate.getTime());
        //     var diffDays = Math.ceil(timeDiff / (1000 * 3600 * 24));
        //     document.getElementById("totalDays").value = diffDays;
        // }
    </script>


</body>
</html>

<?php } ?>