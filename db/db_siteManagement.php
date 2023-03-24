<?php

    session_start();
    require_once 'config/conn.php';


    // เพิ่มข้อมูล item_info
    if (isset($_POST['addSite'])) {
        $siteName = $_POST['siteName'];
        $siteAbbre = $_POST['siteAbbre'];

        // check รายการซ้ำ
        $checkRow = $conn->query("SELECT site_name FROM site_info WHERE site_name = '$siteName'");
        if($checkRow->rowCount() >= 1) {

            // Alert รายการซ้ำ
            $_SESSION['addSite_error'] = '<i class="fa-solid fa-circle-check"></i> Error! ไซต์งานนี้ได้บันทึกอยู่ในระบบแล้ว กรุณาตรวจสอบอีกครั้ง';
            header("location: ../page/siteManagement.php");

        // ถ้ารายการไม่ซ้ำ
        } else {
            $stmt = $conn->prepare("INSERT INTO site_info(site_name, site_abbre) VALUES(:site_name, :site_abbre)");
            $stmt->bindParam(":site_name", $siteName);
            $stmt->bindParam(":site_abbre", $siteAbbre);
            $stmt->execute();

            $_SESSION['addSite_success'] = '<i class="fa-solid fa-circle-check"></i> Success! บันทึกไซต์งานสำเร็จ';
            header("location: ../page/siteManagement.php");
        }
    }


    // แก้ไขข้อมูล item_info
    else if (isset($_POST['editSite'])) {
        $id = $_POST['id'];
        $siteName = $_POST['editSiteName'];
        $siteAbbre = $_POST['editSiteAbbre'];

        // check รายการซ้ำ
        $checkRow = $conn->query("SELECT site_name FROM site_info WHERE site_name = '$siteName'");
        if($checkRow->rowCount() >= 1) {

            // Alert รายการซ้ำ
            $_SESSION['addSite_error'] = '<i class="fa-solid fa-circle-check"></i> Error! ไซต์งานนี้ได้บันทึกอยู่ในระบบแล้ว กรุณาตรวจสอบอีกครั้ง';
            header("location: ../page/siteManagement.php");

        // ถ้ารายการไม่ซ้ำ
        } else {
            $stmt = $conn->prepare("UPDATE site_info SET site_name = :site_name, site_abbre = :site_abbre WHERE id = :id");
            $stmt->bindParam(":id", $id);
            $stmt->bindParam(":site_name", $siteName);
            $stmt->bindParam(":site_abbre", $siteAbbre);
            $stmt->execute();

            $_SESSION['editSite_success'] = '<i class="fa-solid fa-circle-check"></i> Success! แก้ไขไซต์งานสำเร็จ';
            header("location: ../page/siteManagement.php");
        }
    }

?>