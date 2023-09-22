<?php
    session_start();
    require_once "../db/config/conn.php";
    
?>
<head>

<?php
	//เรียกใช้ไฟล์ autoload.php ที่อยู่ใน Folder vendor
	require_once __DIR__ . '../../vendor/autoload.php';

	//ตั้งค่าการเชื่อมต่อฐานข้อมูล

    $conn = mysqli_connect($servername, $username, $password, $dbname);
	mysqli_set_charset($conn, "utf8");

	if (!$conn) {
		die("Connection failed: " . mysqli_connect_error());
	}
   // $tax = $conn->query("SELECT SUM(vat) AS sumvat FROM bill_head WHERE DATE_FORMAT(buy_date, '%Y-%m') = '$thisMonth' AND vat <> 0 AND report = 'N'");
  //  $query_tax = $tax->fetch(PDO::FETCH_ASSOC);

    $reportMonth = intval($_SESSION['searchTax']);

  
  
    $head = '
        
  
            <div class="text-center" >
                <table id="bg-table" width="100%" style="border-collapse: collapse; font-size: 8pt; ">
                    <thead>
                        <tr>
                            <th colspan="9" style=" padding-bottom: 7px;" align="center"><h1 style="font-size: 30pt;">รายงานภาษีซื้อ (NO VAT)</h1></th>
                        </tr>
                        <tr>
                            <td colspan="9" style="font-size: 19.5pt; padding-bottom: 7px;" align="center">เดือนภาษี........'. $_SESSION['monthTax'].'........ปี.......'.$_SESSION['yearTax'].'........</td>
                        </tr>
                        <tr>
                            <td colspan="9" style="font-size: 19.5pt; padding-bottom: 7px;" align="center">ชื่อผู้ประกอบการ........บริษัท สิทธิชัยเอนจิเนียริ่ง จำกัด........</td>
                        </tr>
                        <tr>
                            <td colspan="9" style="font-size: 15pt; padding-bottom: 7px; padding-top: 20px;" align="right">เลขประจำตัวผู้เสียภาษีอากร</td>
                        </tr>
                        <tr>
                            <td colspan="9" style="padding-top: 8px;"></td>
                        </tr>
                        <table style="border-collapse: collapse; font-size: 19pt; "align="right">
                            <tr>
                                <td style="border: 1px solid black; border-collapse: collapse; width: 15px; height: 15px;" align="center">0</td>
                                <td style="border: 1px solid black; border-collapse: collapse; width: 15px; height: 15px;" align="center">1</td>
                                <td style="border: 1px solid black; border-collapse: collapse; width: 15px; height: 15px;" align="center">0</td>
                                <td style="border: 1px solid black; border-collapse: collapse; width: 15px; height: 15px;" align="center">5</td>
                                <td style="border: 1px solid black; border-collapse: collapse; width: 15px; height: 15px;" align="center">5</td>
                                <td style="border: 1px solid black; border-collapse: collapse; width: 15px; height: 15px;" align="center">1</td>
                                <td style="border: 1px solid black; border-collapse: collapse; width: 15px; height: 15px;" align="center">6</td>
                                <td style="border: 1px solid black; border-collapse: collapse; width: 15px; height: 15px;" align="center">0</td>
                                <td style="border: 1px solid black; border-collapse: collapse; width: 15px; height: 15px;" align="center">0</td>
                                <td style="border: 1px solid black; border-collapse: collapse; width: 15px; height: 15px;" align="center">8</td>
                                <td style="border: 1px solid black; border-collapse: collapse; width: 15px; height: 15px;" align="center">5</td>
                                <td style="border: 1px solid black; border-collapse: collapse; width: 15px; height: 15px;" align="center">8</td>
                                <td style="border: 1px solid black; border-collapse: collapse; width: 15px; height: 15px;" align="center">1</td>
                            </tr>
                            <tr>
                                <td colspan="9" style="padding-top: 8px;"></td>
                            </tr>
                        </table> 
                        <table style="border-collapse: collapse; font-size: 15pt;">
                            <tr>
                                <td style="width: 695px; "> ชื่อสถานประกอบการ............<b>บริษัท สิทธิชัยเอนจิเนียริ่ง จำกัด</b>............ </td>
                                <td style="border: 1px solid black; border-collapse: collapse; width: 15px; height: 10px;"><img src="../image/icon/check2.jpg" width="12px" ></td>
                                <td>&nbsp;สำนักงานใหญ่&nbsp;</td>
                                <td style="border: 1px solid black; border-collapse: collapse; width: 15px; height: 15px;"></td>
                                <td>&nbsp;สาขาที่</td>
                            </tr>
                            <tr>
                            <td colspan="9" style="padding-top: 8px;"></td>
                        </tr>
                        </table>
                        <table style="border-collapse: collapse; font-size: 19pt;" align="right">
                            <tr>
                                <td style="border: 1px solid black; border-collapse: collapse; width: 15px; height: 15px;" align="center">0</td>
                                <td style="border: 1px solid black; border-collapse: collapse; width: 15px; height: 15px;" align="center">0</td>
                                <td style="border: 1px solid black; border-collapse: collapse; width: 15px; height: 15px;" align="center">0</td>
                                <td style="border: 1px solid black; border-collapse: collapse; width: 15px; height: 15px;" align="center">0</td>
                            </tr>
                            <tr>
                                <td colspan="9" style="padding-top: 8px;"></td>
                            </tr>
                        </table>




                        <tr style="border:1px solid; border-top: 3px double solid">
                            <th rowspan="2" style="border-right:1px solid; padding: 4px; text-align:center; " width="8%">ลำดับที่</th>
                            <th colspan="2" style="border-right:1px solid; padding: 4px; text-align:center;">ใบกำกับภาษี</th>
                            <th rowspan="2" style="border-right:1px solid; padding: 4px; text-align:center;" width="25%">ชื่อผู้ขายสินค้า/ผู้ให้บริการ</th>
                            <th rowspan="2" style="border-right:1px solid; padding: 4px; text-align:center;" width="20%">เลขประจำตัวผู้เสียภาษี</th>
                            <th colspan="2" style="border-right:1px solid; padding: 4px; text-align:center;">สถานประกอบการ</th>
                            <th rowspan="2" style="border-right:1px solid; padding: 4px; text-align:center;" width="20%">มูลค่าสินค้าหรือบริการ</th>
                            <th rowspan="2" style="border-right:1px solid; padding: 4px; text-align:center;" width="20%">จำนวนเงินภาษีมูลค่าเพิ่ม</th>
                        </tr>

                        <tr style="border:1px solid; ">      
                            <th style="border-right:1px solid; padding:4px; text-align:center;" width="11%">วัน เดือน ปี</th>
                            <th style="border-right:1px solid; padding:4px; text-align:center;" width="11%">เล่มที่/เลขที่</th>
                            <th style="border-right:1px solid; padding:4px; text-align:center;" width="12%">สำนักงานใหญ่</th>
                            <th style="border-right:1px solid; padding:4px; text-align:center;" width="11%">สาขาที่</th>
                        </tr>
                    </thead>


    ';
    
    $sql = "SELECT *  FROM bill_head where report_month2 = $reportMonth AND vat = 0";
    $result = mysqli_query($conn, $sql);
    $content = "";
    $i=1;
    if (mysqli_num_rows($result) > 0) {
		while($row = mysqli_fetch_assoc($result)) {
            if($row['sales_branch']=='สำนักงานใหญ่'){
                $salesBranch = "";
                $pic = '<img src="../image/icon/check2.jpg" width="12px" >';
            }else{
                $salesBranch = $row['sales_branch'];
                $pic = '';
            }
            

            $content .=   '<tr style="border:1px solid #000;">
                <td style="border-right:1px solid #000;padding:3px;text-align:center;"  >'.$i.'</td>
				<td style="border-right:1px solid #000;padding:3px;text-align:center;"  >'.$row['buy_date'].'</td>
				<td style="border-right:1px solid #000;padding:3px;text-align:center;" >'.$row['receipt_no'].'</td>
				<td style="border-right:1px solid #000;padding:3px;text-align:left;"  >'.$row['sales_name'].'</td>
                <td style="border-right:1px solid #000;padding:3px;text-align:center;"  >'.$row['tax_no'].'</td>

                <td style="border-right:1px solid #000;padding:3px;text-align:center;"  >'.$pic.'</td>
                <td style="border-right:1px solid #000;padding:3px;text-align:center;"  >'.$salesBranch.'</td>
                <td style="border-right:1px solid #000;padding:3px;text-align:right;"  >'.number_format($row['sum'], 2).'</td>
                <td style="border-right:1px solid #000;padding:3px;text-align:right;"  >'.number_format($row['vat'], 2).'</td>

        
			</tr>
            ';
            $sumTotal=$row['sum']+$sumTotal;
            $sumVat=$row['vat']+$sumVat;
            $i++;
        
        }
    
        $head3 = '
            <tr>
                <td colspan="7" style="border-right:1px solid; text-align:right; font-weight: bold; padding: 4px;">รวม</td>
                <td style="border-right:1px solid; padding:4px; text-align:right; border-bottom: 3px double solid" width="5%">'.number_format($sumTotal, 2).'</td>
                <td style="border-right:1px solid; padding:4px; text-align:right; border-bottom: 3px double solid" width="5%">'.number_format($sumVat, 2).'</td>
            </tr>

	<tbody>';
}

    mysqli_close($conn);

    $end = "</tbody>
    </table>";
    $mpdf = new \Mpdf\Mpdf(['mode' => 'utf-8' , 'format' => 'A4'] );


    $mpdf->SetAdditionalXmpRdf($rdf);
    $stylesheet = file_get_contents('css/taxDetail.css');
    $mpdf->WriteHTML($stylesheet,\Mpdf\HTMLParserMode::HEADER_CSS);

    $mpdf->WriteHTML($head);

    $mpdf->WriteHTML($content);
    $mpdf->WriteHTML($head3);
    //$mpdf->WriteHTML($content);

    $mpdf->WriteHTML($end);

    $mpdf->Output();
?>

</body>
</html>