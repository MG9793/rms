<?php

    session_start();
    require_once 'config/conn.php';


    // เพิ่มข้อมูลจากหน้าตั้งค่า
    if (isset($_POST['addSite'])) {

        $siteName = $_POST['SiteName'];
        $siteAbbre = $_POST['SiteAbbre'];
        $startDate = $_POST['StartDate'];
        $finishDate = $_POST['FinishDate'];
        $installment = $_POST['Installment'];
        $total = $_POST['Total'];


        // check รายการซ้ำ
        $checkRow = $conn->query("SELECT site_name FROM site_info WHERE site_name = '$siteName'");
        if($checkRow->rowCount() >= 1) {

            // Alert รายการซ้ำ
            $_SESSION['addSite_error'] = '<i class="fa-solid fa-circle-check"></i> Error! ไซต์งานนี้ได้บันทึกอยู่ในระบบแล้ว กรุณาตรวจสอบอีกครั้ง';
            header("location: ../page/siteManagement.php");

        // ถ้ารายการไม่ซ้ำ
        } else {
            $stmt = $conn->prepare("INSERT INTO site_info(site_name, site_abbre , start_date ,finish_date ,installment , total) VALUES(:site_name, :site_abbre , :start_date , :finish_date, :installment, :total)");
            $stmt->bindParam(":site_name", $siteName);
            $stmt->bindParam(":site_abbre", $siteAbbre);
            $stmt->bindParam(":start_date", $startDate);
            $stmt->bindParam(":finish_date", $finishDate);
            $stmt->bindParam(":installment", $installment);
            $stmt->bindParam(":total", $total);
            $stmt->execute();

            $_SESSION['addSite_success'] = '<i class="fa-solid fa-circle-check"></i> Success! บันทึกไซต์งานสำเร็จ';
            header("location: ../page/siteManagement.php");
        }
    }


    // แก้ไขข้อมูลจากหน้าตั้งค่า
    else if (isset($_POST['editSite'])) {
        $id = $_POST['id'];
        $siteName = $_POST['editSiteName'];
        $siteAbbre = $_POST['editSiteAbbre'];
        $startDate = $_POST['editStartDate'];
        $finishDate = $_POST['editFinishDate'];
        $installment = $_POST['editInstallment'];
        $total = $_POST['editTotal'];

        $stmt = $conn->prepare("UPDATE site_info SET site_name = :site_name, site_abbre = :site_abbre ,start_date = :start_date,finish_date = :finish_date,installment = :installment , total = :total WHERE id = :id");
        $stmt->bindParam(":id", $id);
        $stmt->bindParam(":site_name", $siteName);
        $stmt->bindParam(":site_abbre", $siteAbbre);
        $stmt->bindParam(":start_date", $startDate);
        $stmt->bindParam(":finish_date", $finishDate);
        $stmt->bindParam(":installment", $installment);
        $stmt->bindParam(":total", $total);
        $stmt->execute();

        header("location: ../page/siteManagement.php");
        
    }


    // เพิ่มข้อมูลจากหน้าบันทึกรายจ่าย
    else if (isset($_POST['add_QuickSite'])) {
        $siteName = $_POST['siteName'];
        $siteAbbre = $_POST['siteAbbre'];
        $startDate = $_POST['startDate'];
        $finishDate = $_POST['finishDate'];
        $installment = $_POST['addInstallment'];
        $total = $_POST['addTotal'];

        // check รายการซ้ำ
        $checkRow = $conn->query("SELECT site_name FROM site_info WHERE site_name = '$siteName'");
        if($checkRow->rowCount() >= 1) {
        
            // Alert รายการซ้ำ
            $_SESSION['duplicateData'] = '<i class="fa-solid fa-circle-check"></i> Error! ไซต์งานนี้ได้บันทึกอยู่ในระบบแล้ว กรุณาตรวจสอบอีกครั้ง';
            header("location: ../page/expense.php");
        
        // ถ้ารายการไม่ซ้ำ
        } else {

            $stmt = $conn->prepare("INSERT INTO site_info(site_name, site_abbre , start_date ,finish_date ,installment , total) VALUES(:site_name, :site_abbre , :start_date , :finish_date, :installment, :total)");
            $stmt->bindParam(":site_name", $siteName);
            $stmt->bindParam(":site_abbre", $siteAbbre);
            $stmt->bindParam(":start_date", $startDate);
            $stmt->bindParam(":finish_date", $finishDate);
            $stmt->bindParam(":installment", $installment);
            $stmt->bindParam(":total", $total);
            $stmt->execute();

            $_SESSION['addSuccess'] = '<i class="fa-solid fa-circle-check"></i> Success! บันทึกข้อมูลสำเร็จ';
            header("location: ../page/expense.php");

        }

    }

?>