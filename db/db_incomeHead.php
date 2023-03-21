<?php

    session_start();
    require_once 'config/conn.php';


    // เพิ่มข้อมูล income_head
    if (isset($_POST['addIncome_head'])) {
        $site = $_POST['addSiteName'];
        $installment = $_POST['addInstallment'];
        $startDate = $_POST['addStartDate'];
        $finishDate = $_POST['addFinishDate'];
        $sum = $_POST['addSum'];

        $stmt = $conn->prepare("INSERT INTO income_head(site_name, installment, start_date, finish_date, sum)
                                VALUES(:site_name, :installment, :start_date, :finish_date, :sum)");

        $stmt->bindParam(":site_name", $site);
        $stmt->bindParam(":installment", $installment);
        $stmt->bindParam(":start_date", $startDate);
        $stmt->bindParam(":finish_date", $finishDate);
        $stmt->bindParam(":sum", $sum);
        $stmt->execute();

        $_SESSION['addIncomeHead_success'] = '<i class="fa-solid fa-circle-check"></i> บันทึกรายรับสำเร็จ';
        header("location: ../page/incomeRecord_Total.php");
    }


    // แก้ไขข้อมูล income_head
    else if (isset($_POST['editIncome_head'])) {
        $site = $_POST['editSiteName'];
        $installment = $_POST['editInstallment'];
        $startDate = $_POST['editStartDate'];
        $finishDate = $_POST['editFinishDate'];
        $sum = $_POST['editSum'];
    }



    // Add Users
    // if (isset($_POST['registerUser'])) {
    //     $name = $_POST['name'];
    //     $lastname = $_POST['lastName'];
    //     $phone = $_POST['phone'];
    //     $workgroup = $_POST['addWorkgroup'];
    //     $email = $_POST['email'];
    //     $password = $_POST['password'];
    //     $confirmPassword = $_POST['confirmPassword'];

    //     if ($password != $confirmPassword) {
    //         $_SESSION['confirmPassword_error'] = '<i class="fa-solid fa-triangle-exclamation"></i> ยืนยันรหัสผ่านไม่ถูกต้อง กรุณากรอกใหม่อีกครั้ง';
    //         echo "<script>setTimeout(function(){history.back();});</script>";

    //     } else {
    //         $checkEmail = $conn->prepare("SELECT email FROM tbl_users WHERE email = :email");
    //         $checkEmail->bindParam(":email", $email);
    //         $checkEmail->execute();

    //         if($checkEmail->rowCount()!=0) {
    //             $_SESSION['emailError'] = '<i class="fa-solid fa-triangle-exclamation"></i> อีเมลล์นี้ได้ถูกใช้งานแล้ว กรุณากรอกใหม่อีกครั้ง';
    //             echo "<script>setTimeout(function(){history.back();});</script>";

    //         } else {
    //             $passwordHash = password_hash($password, PASSWORD_DEFAULT);
    //             $stmt = $conn->prepare("INSERT INTO tbl_users(name, lastname, phone, email, workgroup, password)
    //                                     VALUES(:name, :lastname, :phone, :email, :workgroup, :password)");

    //             $stmt->bindParam(":name", $name);
    //             $stmt->bindParam(":lastname", $lastname);
    //             $stmt->bindParam(":phone", $phone);
    //             $stmt->bindParam(":workgroup", $workgroup);
    //             $stmt->bindParam(":email", $email);
    //             $stmt->bindParam(":password", $passwordHash);
    //             $stmt->execute();

    //             $_SESSION['registerSuccess'] = '<i class="fa-solid fa-circle-check"></i> ลงทะเบียนผู้ใช้งานสำเร็จ';
    //             header("location: ../admin_userManagement.php");
    //         }
    //     }
    // }


    // // Edit Users Modal
    // else if (isset($_POST['editUser'])) {
    //     $id = $_POST['id_users'];
    //     $name = $_POST['name'];
    //     $lastname = $_POST['lastname'];
    //     $phone = $_POST['phone'];
    //     $workgroup = $_POST['editWorkgroup'];
    //     $password = $_POST['password'];
    //     $confirmPassword = $_POST['confirmPassword'];

    //     // ถ้ายืนยัน Password ไม่ถูกต้อง
    //     if ($password != $confirmPassword) {
    //         $_SESSION['editPassword_error'] = '<i class="fa-solid fa-triangle-exclamation"></i> ยืนยันรหัสผ่านไม่ถูกต้อง กรุณากรอกใหม่อีกครั้ง';
    //         header("location: ../admin_userManagement.php");

    //     } else {

    //         $passwordHash = password_hash($password, PASSWORD_DEFAULT);
    //         $stmt = $conn->prepare("UPDATE tbl_users
    //                                 SET name = :name, lastname = :lastname, phone = :phone, workgroup = :workgroup, password = :password
    //                                 WHERE id_users = :id_users");

    //         $stmt->bindParam(":id_users", $id);
    //         $stmt->bindParam(":name", $name);
    //         $stmt->bindParam(":lastname", $lastname);
    //         $stmt->bindParam(":phone", $phone);
    //         $stmt->bindParam(":workgroup", $workgroup);
    //         $stmt->bindParam(":password", $passwordHash);
    //         $stmt->execute();

    //         // Alert Edit Success
    //         $_SESSION['editAccount_success'] = '<i class="fa-solid fa-circle-check"></i> ดำเนินการสำเร็จ ข้อมูลผู้ใช้แก้ไขเรียบร้อยแล้ว';
    //         header("location: ../admin_userManagement.php");

    //     }
    // }

?>