<?php

    session_start();
    require_once 'config/conn.php';


    // เพิ่มข้อมูลจากหน้าตั้งค่า
    if (isset($_POST['addSales'])) {
        $salesName = $_POST['salesName'];
        $salesBranch = $_POST['salesBranch'];
        $taxNo = $_POST['taxNo'];

        if ($salesBranch == "") {
            $salesBranch = $salesName . " (สำนักงานใหญ่)";

            $stmt = $conn->prepare("INSERT INTO sales_info(sales_name, sales_branch, tax_no) VALUES(:sales_name, :sales_branch, :tax_no)");
            $stmt->bindParam(":sales_name", $salesName);
            $stmt->bindParam(":sales_branch", $salesBranch);
            $stmt->bindParam(":tax_no", $taxNo);
            $stmt->execute();
    
            $_SESSION['addSales_success'] = '<i class="fa-solid fa-circle-check"></i> Success! บันทึกผู้ขายสำเร็จ';
            header("location: ../page/sellerManagement.php");

        } else {
            $salesBranch = $salesName . " ($salesBranch)";

            $stmt = $conn->prepare("INSERT INTO sales_info(sales_name, sales_branch, tax_no) VALUES(:sales_name, :sales_branch, :tax_no)");
            $stmt->bindParam(":sales_name", $salesName);
            $stmt->bindParam(":sales_branch", $salesBranch);
            $stmt->bindParam(":tax_no", $taxNo);
            $stmt->execute();

            $_SESSION['addSales_success'] = '<i class="fa-solid fa-circle-check"></i> Success! บันทึกผู้ขายสำเร็จ';
            header("location: ../page/sellerManagement.php");

        }
    }


    // แก้ไขข้อมูลจากหน้าตั้งค่า
    else if (isset($_POST['editSales'])) {
        $id = $_POST['id'];
        $salesName = $_POST['editSalesName'];
        $salesBranch = $_POST['editSalesBranch'];
        $taxNo = $_POST['edittaxNo'];

        $stmt = $conn->prepare("UPDATE sales_info SET sales_name = :sales_name, sales_branch = :sales_branch, tax_no = :tax_no WHERE id = :id");
        $stmt->bindParam(":id", $id);
        $stmt->bindParam(":sales_name", $salesName);
        $stmt->bindParam(":sales_branch", $salesBranch);
        $stmt->bindParam(":tax_no", $taxNo);
        $stmt->execute();

        $_SESSION['editSales_success'] = '<i class="fa-solid fa-circle-check"></i> Success! แก้ไขผู้ขายสำเร็จ';
        header("location: ../page/sellerManagement.php");

    }

 // เพิ่มข้อมูลจากหน้าบันทึกรายจ่าย
 else if (isset($_POST['add_QuickSeller_novat'])) {
    $salesName = $_POST['addSalesName'];
    $salesBranch = $_POST['addSalesBranch'];
    $taxNo = $_POST['addtaxNo'];

    if ($salesBranch == "") {
        $salesBranch = $salesName . " (สำนักงานใหญ่)";

        $stmt = $conn->prepare("INSERT INTO sales_info(sales_name, sales_branch, tax_no) VALUES(:sales_name, :sales_branch, :tax_no)");
        $stmt->bindParam(":sales_name", $salesName);
        $stmt->bindParam(":sales_branch", $salesBranch);
        $stmt->bindParam(":tax_no", $taxNo);
        $stmt->execute();

        $_SESSION['addSuccess'] = '<i class="fa-solid fa-circle-check"></i> Success! บันทึกข้อมูลสำเร็จ';
        header("location: ../page/expense_novat.php");


    } else {
        $salesBranch = $salesName . " ($salesBranch)";

        $stmt = $conn->prepare("INSERT INTO sales_info(sales_name, sales_branch, tax_no) VALUES(:sales_name, :sales_branch, :tax_no)");
        $stmt->bindParam(":sales_name", $salesName);
        $stmt->bindParam(":sales_branch", $salesBranch);
        $stmt->bindParam(":tax_no", $taxNo);
        $stmt->execute();

        $_SESSION['addSuccess'] = '<i class="fa-solid fa-circle-check"></i> Success! บันทึกข้อมูลสำเร็จ';
        header("location: ../page/expense_novat.php");


    }
}


    // เพิ่มข้อมูลจากหน้าบันทึกรายจ่าย
    else if (isset($_POST['add_QuickSeller'])) {
        $salesName = $_POST['addSalesName'];
        $salesBranch = $_POST['addSalesBranch'];
        $taxNo = $_POST['addtaxNo'];

        if ($salesBranch == "") {
            $salesBranch = $salesName . " (สำนักงานใหญ่)";

            $stmt = $conn->prepare("INSERT INTO sales_info(sales_name, sales_branch, tax_no) VALUES(:sales_name, :sales_branch, :tax_no)");
            $stmt->bindParam(":sales_name", $salesName);
            $stmt->bindParam(":sales_branch", $salesBranch);
            $stmt->bindParam(":tax_no", $taxNo);
            $stmt->execute();

            $_SESSION['addSuccess'] = '<i class="fa-solid fa-circle-check"></i> Success! บันทึกข้อมูลสำเร็จ';
            header("location: ../page/expense.php");


        } else {
            $salesBranch = $salesName . " ($salesBranch)";

            $stmt = $conn->prepare("INSERT INTO sales_info(sales_name, sales_branch, tax_no) VALUES(:sales_name, :sales_branch, :tax_no)");
            $stmt->bindParam(":sales_name", $salesName);
            $stmt->bindParam(":sales_branch", $salesBranch);
            $stmt->bindParam(":tax_no", $taxNo);
            $stmt->execute();

            $_SESSION['addSuccess'] = '<i class="fa-solid fa-circle-check"></i> Success! บันทึกข้อมูลสำเร็จ';
            header("location: ../page/expense.php");


        }
    }

?>