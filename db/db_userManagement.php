<?php

    session_start();
    require_once 'config/conn.php';


    // Add Users
    if (isset($_POST['registerUser'])) {
        $name = $_POST['name'];
        $lastname = $_POST['lastName'];
        $userPermission = $_POST['userPermission'];
        $userName = $_POST['userName'];
        $password = $_POST['password'];
        $confirmPassword = $_POST['confirmPassword'];

        // check รหัสผ่านกรอกไม่ตรงกัน
        if ($password != $confirmPassword) {
            $_SESSION['confirmPassword_error'] = '<i class="fa-solid fa-triangle-exclamation"></i> Error! ยืนยันรหัสผ่านไม่ถูกต้อง กรุณากรอกใหม่';
            echo "<script>setTimeout(function(){history.back();});</script>";

        // ถ้ารหัสผ่านถูกต้องจะ check username ซ้ำ
        } else {
            $checkUser = $conn->prepare("SELECT username FROM user_info WHERE username = :username");
            $checkUser->bindParam(":username", $userName);
            $checkUser->execute();

            if($checkUser->rowCount()!=0) {
                $_SESSION['userName_error'] = '<i class="fa-solid fa-triangle-exclamation"></i> Error! ชื่อผู้ใช้งานนี้ได้ถูกใช้แล้ว กรุณากรอกใหม่';
                echo "<script>setTimeout(function(){history.back();});</script>";

            // ถ้า username ไม่ซ้ำจะ insert ข้อมูลได้
            } else {
                $passwordHash = password_hash($password, PASSWORD_DEFAULT);
                $stmt = $conn->prepare("INSERT INTO user_info(name, lastname, username, password, permission)
                                        VALUES(:name, :lastname, :username, :password, :permission)");

                $stmt->bindParam(":name", $name);
                $stmt->bindParam(":lastname", $lastname);
                $stmt->bindParam(":username", $userName);
                $stmt->bindParam(":password", $passwordHash);
                $stmt->bindParam(":permission", $userPermission);
                $stmt->execute();

                $_SESSION['registerSuccess'] = '<i class="fa-solid fa-circle-check"></i> Success! ลงทะเบียนผู้ใช้งานสำเร็จ';
                header("location: ../page/userManagement.php");
            }
        }
    }


    // Edit Users Modal
    else if (isset($_POST['editUser'])) {
        $id = $_POST['id'];
        $name = $_POST['editName'];
        $lastname = $_POST['editLastname'];
        $userPermission = $_POST['editPermission'];
        $userName = $_POST['editUsername'];
        $password = $_POST['editPassword'];
        $confirmPassword = $_POST['editConfirmPassword'];

        // check รหัสผ่านกรอกไม่ตรงกัน
        if ($password != $confirmPassword) {
            $_SESSION['editPassword_error'] = '<i class="fa-solid fa-triangle-exclamation"></i> Error! ยืนยันรหัสผ่านไม่ถูกต้อง กรุณากรอกใหม่';
            header("location: ../page/userManagement.php");

        // ถ้ารหัสผ่านถูกต้องจะ insert ข้อมูลได้
        } else {

            $passwordHash = password_hash($password, PASSWORD_DEFAULT);
            $stmt = $conn->prepare("UPDATE user_info
                                    SET name = :name, lastname = :lastname, username = :username, password = :password, permission = :permission
                                    WHERE id = :id");

            $stmt->bindParam(":id", $id);
            $stmt->bindParam(":name", $name);
            $stmt->bindParam(":lastname", $lastname);
            $stmt->bindParam(":username", $userName);
            $stmt->bindParam(":password", $passwordHash);
            $stmt->bindParam(":permission", $userPermission);
            $stmt->execute();

            $_SESSION['editUser_success'] = '<i class="fa-solid fa-circle-check"></i> Success! แก้ไขข้อมูลผู้ใช้งานสำเร็จ';
            header("location: ../page/userManagement.php");
        }
    }

?>