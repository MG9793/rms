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
                    header("location: ../../page/dashboard.php");

                } else {
                    echo "<body onload=\"window.alert('ชื่อผู้ใช้งาน หรือ รหัสผ่าน ของคุณไม่ถูกต้อง');\">";
               
                echo "<script>setTimeout(function(){history.back();});</script>";
            }
        }
    } else {
        echo "<body onload=\"window.alert('ชื่อผู้ใช้งาน หรือ รหัสผ่าน ของคุณไม่ถูกต้อง');\">";
           
            echo "<script>setTimeout(function(){history.back();});</script>";
        }
    }

?>