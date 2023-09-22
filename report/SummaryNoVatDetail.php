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
                            <th colspan="9" style=" padding-bottom: 7px;" align="center"><h1 style="font-size: 30pt;">สรุปรายงานไม่มีภาษีซื้อ</th>
                        </tr>
                        <tr>
                            <td colspan="9" style="font-size: 19.5pt; padding-bottom: 7px; padding-top: 20px;" align="center">เดือน........'. $_SESSION['monthTax'].'........ปี.......'.$_SESSION['yearTax'].'........</td>
                        </tr>
                        <tr>
                            <td colspan="9" style="font-size: 15pt; padding-top: 20px;" align="right">เลขประจำตัวผู้เสียภาษีอากร</td>
                        </tr>
                        <table style="border-collapse: collapse; font-size: 19pt;">
                            <tr>
                                <td style="font-size: 15pt;">ชื่อผู้ประกอบการ........................<b>บริษัท สิทธิชัยเอนจิเนียริ่ง จำกัด</b>.......................&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&emsp;&emsp;</td>
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
                                <td style="width: 695px; ">ชื่อสถานประกอบการ.................<b>บริษัท สิทธิชัยเอนจิเนียริ่ง จำกัด</b>.......................&nbsp;&nbsp;&nbsp;</td>
                                <td>&nbsp;&nbsp;&nbsp;&nbsp;&emsp;&emsp;&emsp;&nbsp;&nbsp;สาขาที่&emsp;&emsp;&emsp;&emsp;&emsp;</td>
                                <td style="font-size: 19pt; border: 1px solid black; border-collapse: collapse; width: 15px; height: 15px;">0</td>
                                <td style="font-size: 19pt; border: 1px solid black; border-collapse: collapse; width: 15px; height: 15px;">0</td>
                                <td style="font-size: 19pt; border: 1px solid black; border-collapse: collapse; width: 15px; height: 15px;">0</td>
                                <td style="font-size: 19pt; border: 1px solid black; border-collapse: collapse; width: 15px; height: 15px;">0</td>
                            </tr>
                            <tr>
                                <td colspan="9" style="padding-top: 8px;"></td>
                            </tr>

                        </table>




                        <tr style="border:1px solid; border-top: 3px double solid">
                            <th style="border-right:1px solid; font-size: 12pt; padding: 4px; width: 20%; text-align:center;" width="8%">ลำดับที่</th>
                            <th style="border-right:1px solid; font-size: 12pt; padding: 4px; width: 70%;">หน่วยงาน</th>
                            <th style="border-right:1px solid; font-size: 12pt; padding: 4px; width: 30%; text-align:center;">มูลค่าสินค้า<br>หรือบริการ</th>
                            <th style="border-right:1px solid; font-size: 12pt; padding: 4px; width: 30%; text-align:center;">จำนวนแผ่น</th>
                        </tr>
                    </thead>


    ';
    
   // $sql = "SELECT SUM(sum) as sumTotal , site_name FROM bill_head  where report_month2 = $reportMonth AND vat = 0 GROUP BY site_name";
   $sql = "
   SELECT site_info.site_name, bill_head.site_name, site_info.site_abbre,bill_head.report_month2,bill_head.sum,SUM(sum) as sumTotal
    FROM bill_head 
    LEFT JOIN site_info ON site_info.site_name=bill_head.site_name
    where bill_head.report_month2 = 256609 AND vat = 0
    GROUP BY  bill_head.site_name
   ";
   $result = mysqli_query($conn, $sql);
    $content = "";
    $i=1;
    if (mysqli_num_rows($result) > 0) {
		while($row = mysqli_fetch_assoc($result)) {
            $rowCount = mysqli_num_rows($result);
            
            

            $content .=   '<tr style="border:1px solid #000;">
                <td style="border-right:1px solid #000; font-size: 12pt; padding:3px;text-align:center;"  >'.$i.'</td>
				<td style="border-right:1px solid #000; font-size: 12pt; padding:3px;text-align:left;"  >'.$row['site_name']."".$row['site_abbre'].'</td>
                <td style="border-right:1px solid #000; font-size: 12pt; padding:3px;text-align:right;"  >'.number_format($row['sumTotal'], 2).'</td>
                <td style="border-right:1px solid #000; font-size: 12pt; padding:3px;text-align:center;"  >1</td>
			</tr>
            ';
            $sumTotal=$row['sumTotal']+$sumTotal;
            
            $i++;
        
        }
    
        $head3 = '
            <tr>
                <td colspan="2" style="border-right:1px solid; text-align:right; padding-top: 10px;"><img src="../image/icon/total.png" width="200px" ></td>
                <td style="border-right:1px solid; font-size: 12pt; padding:4px; text-align:right; border-bottom: 3px double solid">'.number_format($sumTotal, 2).'</td>
                <td style="border-right:1px solid; font-size: 12pt; padding:4px; text-align:center; border-bottom: 3px double solid">'.$rowCount.'</td>
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