<?php

    session_start();
    require_once 'config/conn.php';


    // เพิ่มสถานประกอบการ
    if (isset($_POST['addCompany'])) {
        $companyName = $_POST['companyName'];
        $companyBranch = $_POST['companyBranch'];
        $taxNo = $_POST['taxNo'];

        if ($companyBranch == "") {
            $companyBranch = '0000';

            $stmt = $conn->prepare("INSERT INTO company_info(company_name, company_branch, tax_no) VALUES(:company_name, :company_branch, :tax_no)");
            $stmt->bindParam(":company_name", $companyName);
            $stmt->bindParam(":company_branch", $companyBranch);
            $stmt->bindParam(":tax_no", $taxNo);
            $stmt->execute();
    
            header("location: ../page/companyManagement.php");

        } else {

            $stmt = $conn->prepare("INSERT INTO company_info(company_name, company_branch, tax_no) VALUES(:company_name, :company_branch, :tax_no)");
            $stmt->bindParam(":company_name", $companyName);
            $stmt->bindParam(":company_branch", $companyBranch);
            $stmt->bindParam(":tax_no", $taxNo);
            $stmt->execute();

            header("location: ../page/companyManagement.php");

        }
    }


    // แก้ไขข้อมูล item_info
    else if (isset($_POST['editCompany'])) {
        $id = $_POST['id'];
        $companyName = $_POST['editCompanyName'];
        $companyBranch = $_POST['editCompanyBranch'];
        $taxNo = $_POST['edittaxNo'];

        $stmt = $conn->prepare("UPDATE company_info SET company_name = :company_name, company_branch = :company_branch, tax_no = :tax_no WHERE id = :id");
        $stmt->bindParam(":id", $id);
        $stmt->bindParam(":company_name", $companyName);
        $stmt->bindParam(":company_branch", $companyBranch);
        $stmt->bindParam(":tax_no", $taxNo);
        $stmt->execute();

        header("location: ../page/companyManagement.php");

    }

?>