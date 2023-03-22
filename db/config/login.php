<?php

    session_start();
    require_once "conn.php";

    if (isset($_POST['login'])) {
        $username = $_POST['loginUser'];
        $password = $_POST['loginPassword'];
        

        $check_user = $conn->prepare("SELECT * FROM user_info WHERE username = :username");
        $check_user->bindParam(":username", $username);
        $check_user->execute();
        $row = $check_user->fetch(PDO::FETCH_ASSOC);

        // check username มีหรือไม่

        // if ($check_user->rowCount() > 0) {
        //     if ($email == $row['email']) {
        //         if (password_verify($password, $row['password'])) {
        //             $_SESSION['admin_login'] = $row['id_users'];
        //             header("location: ../index.php");

        //         } else {
        //             $_SESSION['passwordError'] = '<i class="fa-solid fa-triangle-exclamation"></i> รหัสผ่านไม่ถูกต้อง<br>กรุณากรอกใหม่อีกครั้ง';
        //             echo "<script>setTimeout(function(){history.back();});</script>";
        //         }
        //     }

        // } else {
        //     $_SESSION['emailPassword_Error'] = '<i class="fa-solid fa-triangle-exclamation"></i> รหัสผ่านหรืออีเมลล์ไม่ถูกต้อง<br>กรุณากรอกใหม่อีกครั้ง';
        //     echo "<script>setTimeout(function(){history.back();});</script>";
            
        // }
    }

?>