<?php

    $servername = "localhost:3307";
    $username = "root";
    $password = "";

    try {
        $conn = new PDO("mysql:host=$servername; dbname=rms", $username, $password);

        // set the PDO error mode to exception
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        // echo "Connected successfully";

    } catch(PDOException $e) {
        echo "Connection failed: " . $e->getMessage();
    }

// query ชื่อผู้ใช้งาน
        $id = $_SESSION['admin_login'];
        $stmt = $conn->query("SELECT name, lastname, username FROM user_info WHERE id = $id");
        $stmt->execute();
        $userName_query = $stmt->fetch(PDO::FETCH_ASSOC);

?>