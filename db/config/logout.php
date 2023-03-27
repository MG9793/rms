<?php

    session_start();
    session_unset();
    // unset($_SESSION['admin_login']);
    header('location: ../../login.php');

?>