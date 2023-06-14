<?php
        if ($_SESSION['permission']=='Admin') {
            require_once "../include/header_admin.php";
    
        } 
        elseif ($_SESSION['permission']=='Procurement') 
        {
            require_once "../include/header_procurement.php";
    
        }
        elseif ($_SESSION['permission']=='Account') 
        {
            require_once "../include/header_account.php";
    
        }
?>
