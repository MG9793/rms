<?php
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

	$sql = "SELECT site_info.site_name, site_info.total, SUM(income.amount) as sumAmount,income.paid_month
    FROM income 
    LEFT JOIN site_info ON site_info.site_name=income.site_name
      GROUP BY  income.site_name";

	$result = mysqli_query($conn, $sql);

	$content = "";
    $i=1;
	if (mysqli_num_rows($result) > 0) {
		while($row = mysqli_fetch_assoc($result)) {
			$content .= '<tr style="border:1px solid #000;">
            <td style="border-right:1px solid #000;padding:3px;text-align:center;"  >'.$i.'</td>
				<td style="border-right:1px solid #000;padding:3px;text-align:center;"  >'.$row['site_name'].'</td>
				<td style="border-right:1px solid #000;padding:3px;text-align:center;" >'.number_format(($row['total']),2).'</td>
				<td style="border-right:1px solid #000;padding:3px;text-align:center;"  >'.$row['sumAmount'].'</td>
                <td style="border-right:1px solid #000;padding:3px;text-align:center;"  ></td>
                <td style="border-right:1px solid #000;padding:3px;text-align:center;"  ></td>
                <td style="border-right:1px solid #000;padding:3px;text-align:center;"  ></td>
                <td style="border-right:1px solid #000;padding:3px;text-align:center;"  ></td>
                <td style="border-right:1px solid #000;padding:3px;text-align:center;"  ></td>
                <td style="border-right:1px solid #000;padding:3px;text-align:center;"  ></td>
                <td style="border-right:1px solid #000;padding:3px;text-align:center;"  ></td>
                <td style="border-right:1px solid #000;padding:3px;text-align:center;"  ></td>
                <td style="border-right:1px solid #000;padding:3px;text-align:center;"  ></td>
                <td style="border-right:1px solid #000;padding:3px;text-align:center;"  ></td>
                <td style="border-right:1px solid #000;padding:3px;text-align:center;"  ></td>
                <td style="border-right:1px solid #000;padding:3px;text-align:center;"  ></td>
        
			</tr>
      
      ';
      $sumTotal=$row['total']+$sumTotal;
      $sumTotalAmount=$row['sumAmount']+$sumTotal;
      $i++;
		} 
        
    $content .= '<tr style="border:1px solid #000;">
    <td style="border-right:1px solid #000;padding:3px;text-align:center;" ></td>
    <td style="border-right:1px solid #000;padding:3px;text-align:center;"   >รวม</td>
    <td style="border-right:1px solid #000;padding:3px;text-align:center;" >'.number_format(($sumTotal),2).'</td>
    <td style="border-right:1px solid #000;padding:3px;text-align:center;"  >'.number_format(($sumTotalAmount),2).'</td>
    <td style="border-right:1px solid #000;padding:3px;text-align:center;"  ></td>
    <td style="border-right:1px solid #000;padding:3px;text-align:center;"  ></td>
    <td style="border-right:1px solid #000;padding:3px;text-align:center;"  ></td>
    <td style="border-right:1px solid #000;padding:3px;text-align:center;"  ></td>
    <td style="border-right:1px solid #000;padding:3px;text-align:center;"  ></td>
    <td style="border-right:1px solid #000;padding:3px;text-align:center;"  ></td>
    <td style="border-right:1px solid #000;padding:3px;text-align:center;"  ></td>
    <td style="border-right:1px solid #000;padding:3px;text-align:center;"  ></td>
    <td style="border-right:1px solid #000;padding:3px;text-align:center;"  ></td>
    <td style="border-right:1px solid #000;padding:3px;text-align:center;"  ></td>
    <td style="border-right:1px solid #000;padding:3px;text-align:center;"  ></td>
    <td style="border-right:1px solid #000;padding:3px;text-align:center;"  ></td>
    </tr>
      
      ';
	}
	
	mysqli_close($conn);
	
$mpdf = new \Mpdf\Mpdf(['mode' => 'utf-8', 'orientation' => 'L' , 'format' => 'A3'] );






$mpdf->SetAdditionalXmpRdf($rdf);

$head = '
<style>
	body{
		font-family: "Garuda";//เรียกใช้font Garuda สำหรับแสดงผล ภาษาไทย
	}
</style>

<h2 style="text-align:center">สรุปรายรับ</h2>

<table id="bg-table" width="100%" style="border-collapse: collapse;font-size:12pt;margin-top:8px;">

    <tr style="border:1px solid #000;padding:4px;">
    <td  rowspan="2" style="border-right:1px solid #000;padding:4px;text-align:center;"   width="5%">ลำดับ</td>
    <td  rowspan="2" style="border-right:1px solid #000;padding:4px;text-align:center;"  width="25%">รายการ</td>
    <td  rowspan="2" style="border-right:1px solid #000;padding:4px;text-align:center;"  width="10%">มูลค่างาน<br>(NOVAT)</td>
    <td  rowspan="2" style="border-right:1px solid #000;padding:4px;text-align:center;"  width="10%">รายรับสะสม</td>
    <td colspan="12" style="border-right:1px solid #000;padding:4px;text-align:center;">'. (date("Y")+543) .'</td>
    </tr>
    <tr style="border:1px solid #000;padding:4px;">


        <td  style="border-right:1px solid #000;padding:4px;text-align:center;"  width="10%">มกราคม</td>
        <td  style="border-right:1px solid #000;padding:4px;text-align:center;"  width="10%">กุมภาพันธ์</td>
        <td  style="border-right:1px solid #000;padding:4px;text-align:center;"  width="10%">มีนาคม</td>
        <td  style="border-right:1px solid #000;padding:4px;text-align:center;"  width="10%">เมษายน</td>
        <td  style="border-right:1px solid #000;padding:4px;text-align:center;"  width="10%">พฤษภาคม</td>
        <td  style="border-right:1px solid #000;padding:4px;text-align:center;"  width="10%">มิถุนายน</td>
        <td  style="border-right:1px solid #000;padding:4px;text-align:center;"  width="10%">กรกฎาคม</td>
        <td  style="border-right:1px solid #000;padding:4px;text-align:center;"  width="10%">สิงหาคม</td>
        <td  style="border-right:1px solid #000;padding:4px;text-align:center;"  width="10%">กันยายน</td>
        <td  style="border-right:1px solid #000;padding:4px;text-align:center;"  width="10%">ตุลาคม</td>
        <td  style="border-right:1px solid #000;padding:4px;text-align:center;"  width="10%">พฤศจิกายน</td>
        <td  style="border-right:1px solid #000;padding:4px;text-align:center;"  width="10%">ธันวาคม</td>


    </tr>

</thead>
	<tbody>';
	
$end = "</tbody>
</table>";

$mpdf->WriteHTML($head);

$mpdf->WriteHTML($content);

$mpdf->WriteHTML($end);

$mpdf->Output();
?>

</body>
</html>