<?php

    session_start();
    require_once 'config/conn.php';


    // เพิ่มข้อมูล item_info
    if (isset($_POST['addItems'])) {
        $itemName = $_POST['itemName'];
        $itemType = $_POST['itemType'];

        // check รายการซ้ำ
        $checkRow = $conn->query("SELECT item_name FROM item_info WHERE item_name = '$itemName'");
        if($checkRow->rowCount() >= 1) {

            // Alert รายการซ้ำ
            $_SESSION['addItem_error'] = '<i class="fa-solid fa-circle-check"></i> Error! รายการนี้ได้บันทึกอยู่ในระบบแล้ว กรุณาตรวจสอบอีกครั้ง';
            header("location: ../page/listItemsManagement.php");

        // ถ้ารายการไม่ซ้ำ
        } else {
            $stmt = $conn->prepare("INSERT INTO item_info(item_name, item_type) VALUES(:item_name, :item_type)");
            $stmt->bindParam(":item_name", $itemName);
            $stmt->bindParam(":item_type", $itemType);
            $stmt->execute();

            $_SESSION['addItem_success'] = '<i class="fa-solid fa-circle-check"></i> Success! บันทึกรายการสินค้าสำเร็จ';
            header("location: ../page/listItemsManagement.php");
        }
    }


    // แก้ไขข้อมูล item_info
    else if (isset($_POST['editItems'])) {
        $id = $_POST['id'];
        $itemName = $_POST['editItemName'];
        $itemType = $_POST['editItemType'];

        $stmt = $conn->prepare("UPDATE item_info SET item_name = :item_name, item_type = :item_type WHERE id = :id");
        $stmt->bindParam(":id", $id);
        $stmt->bindParam(":item_name", $itemName);
        $stmt->bindParam(":item_type", $itemType);
        $stmt->execute();

        $_SESSION['editItem_success'] = '<i class="fa-solid fa-circle-check"></i> Success! แก้ไขรายการสินค้าสำเร็จ';
        header("location: ../page/listItemsManagement.php");
    }

?>