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

		//$content .= '

      //';

      $sql = "SELECT *  FROM site_info";
      $result = mysqli_query($conn, $sql);
	
    $head = '
        <div class="container">
            <div class="text-center">
                <h2>สรุปรายงานภาษีซื้อ</h2>
                <h4>เดือนภาษี..........กันยายน..........ปี..........'.(date("Y")+543).'..........</h4>
            </div>

            
            <div class="text-end">
                <h6>เลขประจำตัวผู้เสียภาษีอากร<br>
                ชื่อผู้ประกอบการ....................บริษัท สิทธิชัยเอนจิเนียริ่ง จำกัด......................&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;
                <span style="border: 1px solid">0105516008581</span><br>
                ชื่อสถานประกอบการ............บริษัท สิทธิชัยเอนจิเนียริ่ง จำกัด.......................&nbsp;&nbsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;
                สาขาที่ <span style="border: 1px solid">0000</span></h6>
            </div>
        </div>


        <table id="bg-table" width="100%" style="border-collapse: collapse; font-size:10pt; border-top: 3px double solid">
            <tr style="border:1px solid; padding:4px; border-bottom: 3px double solid">
                <td style="border-right:1px solid;padding:4px;text-align:center;" width="5%">ลำดับ</td>
                <td style="border-right:1px solid;padding:4px;text-align:center;" width="25%">หน่วยงาน</td>
                <td style="border-right:1px solid;padding:4px;text-align:center;" width="25%">มูลค่าสินค้าหรือบริการ</td>
                <td style="border-right:1px solid;padding:4px;text-align:center;" width="25%">จำนวนเงินภาษีมูลค่าเพิ่ม</td>
                <td style="border-right:1px solid;padding:4px;text-align:center;" width="25%">TOTAL</td>
                <td style="border-right:1px solid;padding:4px;text-align:center;" width="12%">จำนวนแผ่น</td>

    ';


    if (mysqli_num_rows($result) > 0) {
        while($row = mysqli_fetch_assoc($result)) {
            $head2 =       '
           
            <tr style="border:1px solid;">
                <td style="border-right:1px solid; padding:4px; text-align:center;" width="5%">1</td>
                <td style="border-right:1px solid; padding:4px; text-align:left;" width="25%">ทั่วไป</td>
                <td style="border-right:1px solid; padding:4px; text-align:right;" width="5%">'.number_format(141242412, 2).'</td>
                <td style="border-right:1px solid; padding:4px; text-align:right;" width="5%">'.number_format(141242412, 2).'</td>
                <td style="border-right:1px solid; padding:4px; text-align:right;" width="5%">'.number_format(141242412, 2).'</td>
                <td style="border-right:1px solid; padding:4px; text-align:right;" width="5%"></td>
            </tr>
            <tr style="border:1px solid;">
                <td style="border-right:1px solid; padding:4px; text-align:center;" width="5%">2</td>
                <td style="border-right:1px solid; padding:4px; text-align:left;" width="25%">ทหารสระบุรี</td>
                <td style="border-right:1px solid; padding:4px; text-align:right;" width="5%">'.number_format(141242412, 2).'</td>
                <td style="border-right:1px solid; padding:4px; text-align:right;" width="5%">'.number_format(141242412, 2).'</td>
                <td style="border-right:1px solid; padding:4px; text-align:right;" width="5%">'.number_format(141242412, 2).'</td>
                <td style="border-right:1px solid; padding:4px; text-align:right;" width="5%"></td>
            </tr>
            ';
   
        }

        $head3 = '
            <tr>
                <td colspan="2" style="border-right:1px solid; text-align:right;"><img src="../image/icon/total.png" width="25%"></td>
                <td style="border-right:1px solid; padding:4px; text-align:right; border-bottom: 3px double solid" width="5%">'.number_format(141242412, 2).'</td>
                <td style="border-right:1px solid; padding:4px; text-align:right; border-bottom: 3px double solid" width="5%">'.number_format(232312332, 2).'</td>
                <td style="border-right:1px solid; padding:4px; text-align:right; border-bottom: 3px double solid" width="5%">'.number_format(133233442, 2).'</td>
                <td style="border-right:1px solid; padding:4px; text-align:center; border-bottom: 3px double solid" width="5%">0</td>
            </tr>
        </thead>
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

    $mpdf->WriteHTML($head2);
    $mpdf->WriteHTML($head3);
    //$mpdf->WriteHTML($content);

    $mpdf->WriteHTML($end);

    $mpdf->Output();
?>

</body>
</html>