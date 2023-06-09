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

	$sql = "SELECT SUM(total) as t1,item_name FROM bill_line GROUP BY item_name";
	
	$result = mysqli_query($conn, $sql);
	$content = "";
	if (mysqli_num_rows($result) > 0) {
		while($row = mysqli_fetch_assoc($result)) {
			$content .= '<tr style="border:1px solid #000;">
				<td style="border-right:1px solid #000;padding:3px;text-align:center;"  >'.$row['item_name'].'</td>
				<td style="border-right:1px solid #000;padding:3px;text-align:center;" ></td>
				<td style="border-right:1px solid #000;padding:3px;"  ></td>
        <td style="border-right:1px solid #000;padding:3px;"  ></td>
        <td style="border-right:1px solid #000;padding:3px;"  ></td>
        <td style="border-right:1px solid #000;padding:3px;"  ></td>
        <td style="border-right:1px solid #000;padding:3px;"  ></td>
        <td style="border-right:1px solid #000;padding:3px;"  ></td>
        <td style="border-right:1px solid #000;padding:3px;"  ></td>
        <td style="border-right:1px solid #000;padding:3px;"  ></td>
        <td style="border-right:1px solid #000;padding:3px;"  ></td>
        <td style="border-right:1px solid #000;padding:3px;"  ></td>
        <td style="border-right:1px solid #000;padding:3px;"  ></td>
        <td style="border-right:1px solid #000;padding:3px;"  >'.$row['t1'].'</td>
        
			</tr>
      
      ';
		} 
    $content .= '<tr style="border:1px solid #000;">
    <td style="border-right:1px solid #000;padding:3px;text-align:center;"   >รวม</td>
    <td style="border-right:1px solid #000;padding:3px;text-align:center;" ></td>
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

<h2 style="text-align:center">สรุปค่าใช้จ่าย เดือน มกราคม - ธันวาคม พ.ศ.2566 บริษัท สิทธิชัยเอนจิเนียริ่ง จำกัด (ทำงบ)</h2>

<table id="bg-table" width="100%" style="border-collapse: collapse;font-size:12pt;margin-top:8px;">
    <tr style="border:1px solid #000;padding:4px;">
        <td  style="border-right:1px solid #000;padding:4px;text-align:center;"   width="25%">รายละเอียด</td>
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
        <td  style="border-right:1px solid #000;padding:4px;text-align:center;"  width="10%">TOTAL</td>


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