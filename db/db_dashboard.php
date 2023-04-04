<?php
        // query จำนวนไซต์งาน
        $siteTotal = $conn->query("SELECT * FROM site_info");
        $siteTotal->execute();
        $site_rowCount = $siteTotal->rowCount();
   
       
        // query materialTotal
        $materialTotal = $conn->query("SELECT SUM(total) as materialSum FROM bill_head where type = 'ค่าวัสดุ'");
        $materialTotal->execute();
        $material = $materialTotal->fetch(PDO::FETCH_ASSOC);
        if ($material) {
            $materialSum = $material['materialSum'];
          }

        // query labourTotal
        $labourTotal = $conn->prepare("SELECT SUM(total) as labourSum FROM bill_head where type = 'ค่าแรง'");
        $labourTotal->execute();
        $labour = $labourTotal->fetch(PDO::FETCH_ASSOC);
        if ($labour) {
            $labourSum = $labour['labourSum'];
          }

        // query BillVAT Month01
        $M01=date("Y-01");
        $M01 = $conn->prepare("SELECT SUM(total) as sumM01 ,SUM(vat) as vatM01 FROM bill_head WHERE buy_date like '$M01%' and vat != 0");
        $M01->execute();
        $BillVat01 = $M01->fetch(PDO::FETCH_ASSOC);
        if ($BillVat01) {
            $sumM01 = $BillVat01['sumM01'];
            $vatM01 = $BillVat01['vatM01'];
          }

        // query BillVAT Month02
        $M02=date("Y-02");
        $M02 = $conn->prepare("SELECT SUM(total) as sumM02 ,SUM(vat) as vatM02 FROM bill_head WHERE buy_date like '$M02%' and vat != 0");
        $M02->execute();
        $BillVat02 = $M02->fetch(PDO::FETCH_ASSOC);
        if ($BillVat02) {
            $sumM02 = $BillVat02['sumM02'];
            $vatM02 = $BillVat02['vatM02'];
          }

         // query BillVAT Month03
         $M03=date("Y-03");
         $M03 = $conn->prepare("SELECT SUM(total) as sumM03 ,SUM(vat) as vatM03 FROM bill_head WHERE buy_date like '$M03%' and vat != 0");
         $M03->execute();
         $BillVat03 = $M03->fetch(PDO::FETCH_ASSOC);
         if ($BillVat03) {
             $sumM03 = $BillVat03['sumM03'];
             $vatM03 = $BillVat03['vatM03'];
           }

          // query BillVAT Month04
          $M04=date("Y-04");
          $M04 = $conn->prepare("SELECT SUM(total) as sumM04 ,SUM(vat) as vatM04 FROM bill_head WHERE buy_date like '$M04%' and vat != 0");
          $M04->execute();
          $BillVat04 = $M04->fetch(PDO::FETCH_ASSOC);
          if ($BillVat04) {
              $sumM04 = $BillVat04['sumM04'];
              $vatM04 = $BillVat04['vatM04'];
            }
  
           // query BillVAT Month05
         $M05=date("Y-05");
         $M05 = $conn->prepare("SELECT SUM(total) as sumM05 ,SUM(vat) as vatM05 FROM bill_head WHERE buy_date like '$M05%' and vat != 0");
         $M05->execute();
         $BillVat05 = $M05->fetch(PDO::FETCH_ASSOC);
         if ($BillVat05) {
             $sumM05 = $BillVat05['sumM05'];
             $vatM05 = $BillVat05['vatM05'];
           }

          // query BillVAT Month06
          $M06=date("Y-06");
          $M06 = $conn->prepare("SELECT SUM(total) as sumM06 ,SUM(vat) as vatM06 FROM bill_head WHERE buy_date like '$M06%' and vat != 0");
          $M06->execute();
          $BillVat06 = $M06->fetch(PDO::FETCH_ASSOC);
          if ($BillVat06) {
              $sumM06 = $BillVat06['sumM06'];
              $vatM06 = $BillVat06['vatM06'];
            }
  
           // query BillVAT Month07
         $M07=date("Y-07");
         $M07 = $conn->prepare("SELECT SUM(total) as sumM07 ,SUM(vat) as vatM07 FROM bill_head WHERE buy_date like '$M07%' and vat != 0");
         $M07->execute();
         $BillVat07 = $M07->fetch(PDO::FETCH_ASSOC);
         if ($BillVat07) {
             $sumM07 = $BillVat07['sumM07'];
             $vatM07 = $BillVat07['vatM07'];
           }

          // query BillVAT Month08
          $M08=date("Y-08");
          $M08 = $conn->prepare("SELECT SUM(total) as sumM08 ,SUM(vat) as vatM08 FROM bill_head WHERE buy_date like '$M08%' and vat != 0");
          $M08->execute();
          $BillVat08 = $M08->fetch(PDO::FETCH_ASSOC);
          if ($BillVat08) {
              $sumM08 = $BillVat08['sumM08'];
              $vatM08 = $BillVat08['vatM08'];
            }
  
           // query BillVAT Month09
         $M09=date("Y-09");
         $M09 = $conn->prepare("SELECT SUM(total) as sumM09 ,SUM(vat) as vatM09 FROM bill_head WHERE buy_date like '$M09%' and vat != 0");
         $M09->execute();
         $BillVat09 = $M09->fetch(PDO::FETCH_ASSOC);
         if ($BillVat09) {
             $sumM09 = $BillVat09['sumM09'];
             $vatM09 = $BillVat09['vatM09'];
           }
 
          // query BillVAT Month10
          $M10=date("Y-10");
          $M10 = $conn->prepare("SELECT SUM(total) as sumM10 ,SUM(vat) as vatM10 FROM bill_head WHERE buy_date like '$M10%' and vat != 0");
          $M10->execute();
          $BillVat10 = $M10->fetch(PDO::FETCH_ASSOC);
          if ($BillVat10) {
              $sumM10 = $BillVat10['sumM10'];
              $vatM10 = $BillVat10['vatM10'];
            }
  
           // query BillVAT Month11
         $M11=date("Y-11");
         $M11 = $conn->prepare("SELECT SUM(total) as sumM11 ,SUM(vat) as vatM11 FROM bill_head WHERE buy_date like '$M11%' and vat != 0");
         $M11->execute();
         $BillVat11 = $M11->fetch(PDO::FETCH_ASSOC);
         if ($BillVat11) {
             $sumM11 = $BillVat11['sumM11'];
             $vatM11 = $BillVat11['vatM11'];
           }
 
          // query BillVAT Month12
          $M12=date("Y-12");
          $M12 = $conn->prepare("SELECT SUM(total) as sumM12 ,SUM(vat) as vatM12 FROM bill_head WHERE buy_date like '$M12%' and vat != 0");
          $M12->execute();
          $BillVat12 = $M12->fetch(PDO::FETCH_ASSOC);
          if ($BillVat12) {
              $sumM12 = $BillVat12['sumM12'];
              $vatM12 = $BillVat12['vatM12'];
            }


         ?>