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
        if ($check_user->rowCount() > 0) {
            if ($username == $row['username']) {
                if (password_verify($password, $row['password'])) {
                    $_SESSION['admin_login'] = $row['id'];
                    header("location: ../../index.php");

                } else {
                $_SESSION['passwordError'] = '<i class="fa-solid fa-triangle-exclamation"></i> Error! รหัสผ่านไม่ถูกต้อง กรุณากรอกใหม่';
                echo "<script>setTimeout(function(){history.back();});</script>";
            }
        }
    } else {
            $_SESSION['userPassword_Error'] = '<i class="fa-solid fa-triangle-exclamation"></i> Error! รหัสผ่านหรืออีเมลล์ไม่ถูกต้อง กรุณากรอกใหม่';
            echo "<script>setTimeout(function(){history.back();});</script>";
        }
    }

?>