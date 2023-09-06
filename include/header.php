<?php
        if ($_SESSION['permission']=='Admin') {
            require_once "../include/header_admin.php";
    
        } 
        elseif ($_SESSION['permission']=='Procurement_Vat') 
        {
            require_once "../include/header_procurement_vat.php";
    
        }
        elseif ($_SESSION['permission']=='Procurement_noVat') 
        {
            require_once "../include/header_procurement_novat.php";
    
        }
        elseif ($_SESSION['permission']=='Account') 
        {
            require_once "../include/header_account.php";
    
        }
?>
