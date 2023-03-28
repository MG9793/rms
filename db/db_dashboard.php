<?php
// query ชื่อผู้ใช้งาน
        $id = $_SESSION['admin_login'];
        $stmt = $conn->query("SELECT name, lastname, username FROM user_info WHERE id = $id");
        $stmt->execute();
        $userName_query = $stmt->fetch(PDO::FETCH_ASSOC);

        // query จำนวนไซต์งาน
        $siteTotal = $conn->query("SELECT * FROM site_info");
        $siteTotal->execute();
        $site_rowCount = $siteTotal->rowCount();
   

        // query materialTotal
        $materialTotal = $conn->query("SELECT SUM(sum) as materialSum FROM material_head");
        $materialTotal->execute();
        $material = $materialTotal->fetch(PDO::FETCH_ASSOC);
        if ($material) {
            $materialSum = $material['materialSum'];
          }

        // query labourTotal
        $labourTotal = $conn->prepare("SELECT SUM(sum) as labourSum FROM labour_head");
        $labourTotal->execute();
        $labour = $labourTotal->fetch(PDO::FETCH_ASSOC);
        if ($labour) {
            $labourSum = $labour['labourSum'];
          }

        // query BillVAT Month01
        $M01=date("Y-01");
        $M01_L = $conn->prepare("SELECT SUM(sum) as sumM01 ,SUM(vat) as vatM01 FROM labour_head WHERE sales_date like '$M01%' and vat != 0");
        $M01_L->execute();
        $BillVat01_L = $M01_L->fetch(PDO::FETCH_ASSOC);
        if ($BillVat01_L) {
            $sumM01_l = $BillVat01_L['sumM01'];
            $vatM01_l = $BillVat01_L['vatM01'];
          }

          $M01_M = $conn->prepare("SELECT SUM(sum) as sumM01 ,SUM(vat) as vatM01 FROM material_head WHERE sales_date like '$M01%' and vat != 0");
          $M01_M->execute();
          $BillVat01_M = $M01_M->fetch(PDO::FETCH_ASSOC);
        if ($BillVat01_M) {
            $sumM01_m = $BillVat01_M['sumM01'];
            $vatM01_m = $BillVat01_M['vatM01'];
          }
        $sumM01 = $sumM01_m + $sumM01_l;
        $vatM01 = $vatM01_m + $vatM01_l;

        // query BillVAT Month02
        $M02=date("Y-02");
        $M02_L = $conn->prepare("SELECT SUM(sum) as sumM02 ,SUM(vat) as vatM02 FROM labour_head WHERE sales_date like '$M02%' and vat != 0");
        $M02_L->execute();
        $BillVat02_L = $M02_L->fetch(PDO::FETCH_ASSOC);
        if ($BillVat02_L) {
            $sumM02_l = $BillVat02_L['sumM02'];
            $vatM02_l = $BillVat02_L['vatM02'];
          }

          $M02_M = $conn->prepare("SELECT SUM(sum) as sumM02 ,SUM(vat) as vatM02 FROM material_head WHERE sales_date like '$M02%' and vat != 0");
          $M02_M->execute();
          $BillVat02_M = $M02_M->fetch(PDO::FETCH_ASSOC);
        if ($BillVat02_M) {
            $sumM02_m = $BillVat02_M['sumM02'];
            $vatM02_m = $BillVat02_M['vatM02'];
          }
        $sumM02 = $sumM02_m + $sumM02_l;
        $vatM02 = $vatM02_m + $vatM02_l;

         // query BillVAT Month03
         $M03=date("Y-03");
         $M03_L = $conn->prepare("SELECT SUM(sum) as sumM03 ,SUM(vat) as vatM03 FROM labour_head WHERE sales_date like '$M03%' and vat != 0");
         $M03_L->execute();
         $BillVat03_L = $M03_L->fetch(PDO::FETCH_ASSOC);
         if ($BillVat03_L) {
             $sumM03_l = $BillVat03_L['sumM03'];
             $vatM03_l = $BillVat03_L['vatM03'];
           }
 
           $M03_M = $conn->prepare("SELECT SUM(sum) as sumM03 ,SUM(vat) as vatM03 FROM material_head WHERE sales_date like '$M03%' and vat != 0");
           $M03_M->execute();
           $BillVat03_M = $M03_M->fetch(PDO::FETCH_ASSOC);
         if ($BillVat03_M) {
             $sumM03_m = $BillVat03_M['sumM03'];
             $vatM03_m = $BillVat03_M['vatM03'];
           }
         $sumM03 = $sumM03_m + $sumM03_l;
         $vatM03 = $vatM03_m + $vatM03_l;

          // query BillVAT Month04
          $M04=date("Y-04");
          $M04_L = $conn->prepare("SELECT SUM(sum) as sumM04 ,SUM(vat) as vatM04 FROM labour_head WHERE sales_date like '$M04%' and vat != 0");
          $M04_L->execute();
          $BillVat04_L = $M04_L->fetch(PDO::FETCH_ASSOC);
          if ($BillVat04_L) {
              $sumM04_l = $BillVat04_L['sumM04'];
              $vatM04_l = $BillVat04_L['vatM04'];
            }
  
            $M04_M = $conn->prepare("SELECT SUM(sum) as sumM04 ,SUM(vat) as vatM04 FROM material_head WHERE sales_date like '$M04%' and vat != 0");
            $M04_M->execute();
            $BillVat04_M = $M04_M->fetch(PDO::FETCH_ASSOC);
          if ($BillVat04_M) {
              $sumM04_m = $BillVat04_M['sumM04'];
              $vatM04_m = $BillVat04_M['vatM04'];
            }
          $sumM04 = $sumM04_m + $sumM04_l;
          $vatM04 = $vatM04_m + $vatM04_l;

           // query BillVAT Month05
         $M05=date("Y-05");
         $M05_L = $conn->prepare("SELECT SUM(sum) as sumM05 ,SUM(vat) as vatM05 FROM labour_head WHERE sales_date like '$M05%' and vat != 0");
         $M05_L->execute();
         $BillVat05_L = $M05_L->fetch(PDO::FETCH_ASSOC);
         if ($BillVat05_L) {
             $sumM05_l = $BillVat05_L['sumM05'];
             $vatM05_l = $BillVat05_L['vatM05'];
           }
 
           $M05_M = $conn->prepare("SELECT SUM(sum) as sumM05 ,SUM(vat) as vatM05 FROM material_head WHERE sales_date like '$M05%' and vat != 0");
           $M05_M->execute();
           $BillVat05_M = $M05_M->fetch(PDO::FETCH_ASSOC);
         if ($BillVat05_M) {
             $sumM05_m = $BillVat05_M['sumM05'];
             $vatM05_m = $BillVat05_M['vatM05'];
           }
         $sumM05 = $sumM05_m + $sumM05_l;
         $vatM05 = $vatM05_m + $vatM05_l;

          // query BillVAT Month06
          $M06=date("Y-06");
          $M06_L = $conn->prepare("SELECT SUM(sum) as sumM06 ,SUM(vat) as vatM06 FROM labour_head WHERE sales_date like '$M06%' and vat != 0");
          $M06_L->execute();
          $BillVat06_L = $M06_L->fetch(PDO::FETCH_ASSOC);
          if ($BillVat06_L) {
              $sumM06_l = $BillVat06_L['sumM06'];
              $vatM06_l = $BillVat06_L['vatM06'];
            }
  
            $M06_M = $conn->prepare("SELECT SUM(sum) as sumM06 ,SUM(vat) as vatM06 FROM material_head WHERE sales_date like '$M06%' and vat != 0");
            $M06_M->execute();
            $BillVat06_M = $M06_M->fetch(PDO::FETCH_ASSOC);
          if ($BillVat06_M) {
              $sumM06_m = $BillVat06_M['sumM06'];
              $vatM06_m = $BillVat06_M['vatM06'];
            }
          $sumM06 = $sumM06_m + $sumM06_l;
          $vatM06 = $vatM06_m + $vatM06_l;

           // query BillVAT Month07
         $M07=date("Y-07");
         $M07_L = $conn->prepare("SELECT SUM(sum) as sumM07 ,SUM(vat) as vatM07 FROM labour_head WHERE sales_date like '$M07%' and vat != 0");
         $M07_L->execute();
         $BillVat07_L = $M07_L->fetch(PDO::FETCH_ASSOC);
         if ($BillVat07_L) {
             $sumM07_l = $BillVat07_L['sumM07'];
             $vatM07_l = $BillVat07_L['vatM07'];
           }
 
           $M07_M = $conn->prepare("SELECT SUM(sum) as sumM07 ,SUM(vat) as vatM07 FROM material_head WHERE sales_date like '$M07%' and vat != 0");
           $M07_M->execute();
           $BillVat07_M = $M07_M->fetch(PDO::FETCH_ASSOC);
         if ($BillVat07_M) {
             $sumM07_m = $BillVat07_M['sumM07'];
             $vatM07_m = $BillVat07_M['vatM07'];
           }
         $sumM07 = $sumM07_m + $sumM07_l;
         $vatM07 = $vatM07_m + $vatM07_l;

          // query BillVAT Month08
          $M08=date("Y-08");
          $M08_L = $conn->prepare("SELECT SUM(sum) as sumM08 ,SUM(vat) as vatM08 FROM labour_head WHERE sales_date like '$M08%' and vat != 0");
          $M08_L->execute();
          $BillVat08_L = $M08_L->fetch(PDO::FETCH_ASSOC);
          if ($BillVat08_L) {
              $sumM08_l = $BillVat08_L['sumM08'];
              $vatM08_l = $BillVat08_L['vatM08'];
            }
  
            $M08_M = $conn->prepare("SELECT SUM(sum) as sumM08 ,SUM(vat) as vatM08 FROM material_head WHERE sales_date like '$M08%' and vat != 0");
            $M08_M->execute();
            $BillVat08_M = $M08_M->fetch(PDO::FETCH_ASSOC);
          if ($BillVat08_M) {
              $sumM08_m = $BillVat08_M['sumM08'];
              $vatM08_m = $BillVat08_M['vatM08'];
            }
          $sumM08 = $sumM08_m + $sumM08_l;
          $vatM08 = $vatM08_m + $vatM08_l;

           // query BillVAT Month09
         $M09=date("Y-09");
         $M09_L = $conn->prepare("SELECT SUM(sum) as sumM09 ,SUM(vat) as vatM09 FROM labour_head WHERE sales_date like '$M09%' and vat != 0");
         $M09_L->execute();
         $BillVat09_L = $M09_L->fetch(PDO::FETCH_ASSOC);
         if ($BillVat09_L) {
             $sumM09_l = $BillVat09_L['sumM09'];
             $vatM09_l = $BillVat09_L['vatM09'];
           }
 
           $M09_M = $conn->prepare("SELECT SUM(sum) as sumM09 ,SUM(vat) as vatM09 FROM material_head WHERE sales_date like '$M09%' and vat != 0");
           $M09_M->execute();
           $BillVat09_M = $M09_M->fetch(PDO::FETCH_ASSOC);
         if ($BillVat09_M) {
             $sumM09_m = $BillVat09_M['sumM09'];
             $vatM09_m = $BillVat09_M['vatM09'];
           }
         $sumM09 = $sumM09_m + $sumM09_l;
         $vatM09 = $vatM09_m + $vatM09_l;

          // query BillVAT Month10
          $M10=date("Y-10");
          $M10_L = $conn->prepare("SELECT SUM(sum) as sumM10 ,SUM(vat) as vatM10 FROM labour_head WHERE sales_date like '$M10%' and vat != 0");
          $M10_L->execute();
          $BillVat10_L = $M10_L->fetch(PDO::FETCH_ASSOC);
          if ($BillVat10_L) {
              $sumM10_l = $BillVat10_L['sumM10'];
              $vatM10_l = $BillVat10_L['vatM10'];
            }
  
            $M10_M = $conn->prepare("SELECT SUM(sum) as sumM10 ,SUM(vat) as vatM10 FROM material_head WHERE sales_date like '$M10%' and vat != 0");
            $M10_M->execute();
            $BillVat10_M = $M10_M->fetch(PDO::FETCH_ASSOC);
          if ($BillVat10_M) {
              $sumM10_m = $BillVat10_M['sumM10'];
              $vatM10_m = $BillVat10_M['vatM10'];
            }
          $sumM10 = $sumM10_m + $sumM10_l;
          $vatM10 = $vatM10_m + $vatM10_l;

           // query BillVAT Month11
         $M11=date("Y-11");
         $M11_L = $conn->prepare("SELECT SUM(sum) as sumM11 ,SUM(vat) as vatM11 FROM labour_head WHERE sales_date like '$M11%' and vat != 0");
         $M11_L->execute();
         $BillVat11_L = $M11_L->fetch(PDO::FETCH_ASSOC);
         if ($BillVat11_L) {
             $sumM11_l = $BillVat11_L['sumM11'];
             $vatM11_l = $BillVat11_L['vatM11'];
           }
 
           $M11_M = $conn->prepare("SELECT SUM(sum) as sumM11 ,SUM(vat) as vatM11 FROM material_head WHERE sales_date like '$M11%' and vat != 0");
           $M11_M->execute();
           $BillVat11_M = $M11_M->fetch(PDO::FETCH_ASSOC);
         if ($BillVat11_M) {
             $sumM11_m = $BillVat11_M['sumM11'];
             $vatM11_m = $BillVat11_M['vatM11'];
           }
         $sumM11 = $sumM11_m + $sumM11_l;
         $vatM11 = $vatM11_m + $vatM11_l;

          // query BillVAT Month12
          $M12=date("Y-12");
          $M12_L = $conn->prepare("SELECT SUM(sum) as sumM12 ,SUM(vat) as vatM12 FROM labour_head WHERE sales_date like '$M12%' and vat != 0");
          $M12_L->execute();
          $BillVat12_L = $M12_L->fetch(PDO::FETCH_ASSOC);
          if ($BillVat12_L) {
              $sumM12_l = $BillVat12_L['sumM12'];
              $vatM12_l = $BillVat12_L['vatM12'];
            }
  
            $M12_M = $conn->prepare("SELECT SUM(sum) as sumM12 ,SUM(vat) as vatM12 FROM material_head WHERE sales_date like '$M12%' and vat != 0");
            $M12_M->execute();
            $BillVat12_M = $M12_M->fetch(PDO::FETCH_ASSOC);
          if ($BillVat12_M) {
              $sumM12_m = $BillVat12_M['sumM12'];
              $vatM12_m = $BillVat12_M['vatM12'];
            }
          $sumM12 = $sumM12_m + $sumM12_l;
          $vatM12 = $vatM12_m + $vatM12_l;















         ?>