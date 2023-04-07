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


			$content .= '<tr style="border:1px solid #000;">
           
            <td  style="border-right:1px solid #000;padding:4px;text-align:center;"  width="5%">1</td>
            <td  style="border-right:1px solid #000;padding:4px;text-align:left;"  width="25%">ค่างานก่อน VAT</td>
            <td  style="border-right:1px solid #000;padding:4px;text-align:center;"  width="5%"></td>
            <td  style="border-right:1px solid #000;padding:4px;text-align:center;"  width="5%"></td>
			</tr>
            <tr style="border:1px solid #000;">
           
            <td  style="border-right:1px solid #000;padding:4px;text-align:center;"  width="5%">2</td>
            <td  style="border-right:1px solid #000;padding:4px;text-align:left;"  width="25%">รายรับ ณ ปัจจุบัน</td>
            <td  style="border-right:1px solid #000;padding:4px;text-align:center;"  width="5%"></td>
            <td  style="border-right:1px solid #000;padding:4px;text-align:center;"  width="5%"></td>
			</tr>
            <tr style="border:1px solid #000;">
           
            <td  style="border-right:1px solid #000;padding:4px;text-align:center;"  width="5%">3</td>
            <td  style="border-right:1px solid #000;padding:4px;text-align:left;"  width="25%">- direct cost</td>
            <td  style="border-right:1px solid #000;padding:4px;text-align:center;"  width="5%"></td>
            <td  style="border-right:1px solid #000;padding:4px;text-align:center;"  width="5%"></td>
			</tr>
            <tr style="border:1px solid #000;">
           
            <td  style="border-right:1px solid #000;padding:4px;text-align:center;"  width="5%">4</td>
            <td  style="border-right:1px solid #000;padding:4px;text-align:left;"  width="25%">กำไรขั้นต้น</td>
            <td  style="border-right:1px solid #000;padding:4px;text-align:center;"  width="5%"></td>
            <td  style="border-right:1px solid #000;padding:4px;text-align:center;"  width="5%"></td>
			</tr>
            <tr style="border:1px solid #000;">
           
            <td  style="border-right:1px solid #000;padding:4px;text-align:center;"  width="5%">5</td>
            <td  style="border-right:1px solid #000;padding:4px;text-align:left;"  width="25%">-OH site</td>
            <td  style="border-right:1px solid #000;padding:4px;text-align:center;"  width="5%"></td>
            <td  style="border-right:1px solid #000;padding:4px;text-align:center;"  width="5%"></td>
			</tr>
            <tr style="border:1px solid #000;">
           
            <td  style="border-right:1px solid #000;padding:4px;text-align:center;"  width="5%">6</td>
            <td  style="border-right:1px solid #000;padding:4px;text-align:left;"  width="25%">-OH office</td>
            <td  style="border-right:1px solid #000;padding:4px;text-align:center;"  width="5%"></td>
            <td  style="border-right:1px solid #000;padding:4px;text-align:center;"  width="5%"></td>
			</tr>
            <tr style="border:1px solid #000;">
           
            <td  style="border-right:1px solid #000;padding:4px;text-align:center;"  width="5%">7</td>
            <td  style="border-right:1px solid #000;padding:4px;text-align:left;"  width="25%">OH ALL</td>
            <td  style="border-right:1px solid #000;padding:4px;text-align:center;"  width="5%"></td>
            <td  style="border-right:1px solid #000;padding:4px;text-align:center;"  width="5%"></td>
			</tr>
            <tr style="border:1px solid #000;">
           
            <td  style="border-right:1px solid #000;padding:4px;text-align:center;"  width="5%">8</td>
            <td  style="border-right:1px solid #000;padding:4px;text-align:left;"  width="25%">กำไรสุทธิ</td>
            <td  style="border-right:1px solid #000;padding:4px;text-align:center;"  width="5%"></td>
            <td  style="border-right:1px solid #000;padding:4px;text-align:center;"  width="5%"></td>
			</tr>

            
      
      ';

      

      $sql = "SELECT *  FROM site_info";
	
      $result = mysqli_query($conn, $sql);
	
$head = '
<style>
	body{
		font-family: "Garuda";//เรียกใช้font Garuda สำหรับแสดงผล ภาษาไทย
	}
</style>

<h2 style="text-align:center ">สรุปโครงการก่อสร้าง : บริษัท สิทธิชัยเอนจิเนียริ่ง จำกัด</h2>
<h2 style="text-align:center">สรุปงบประมาณปี '. (date("Y")+543) .' เดือน มกราคม - ธันวาคม '. (date("Y")+543) .'</h2>

<table id="bg-table" width="100%" style="border-collapse: collapse;font-size:12pt;margin-top:8px;">

    <tr style="border:1px solid #000;padding:4px;">
    <td  rowspan="2" style="border-right:1px solid #000;padding:4px;text-align:center;"  width="5%">ลำดับ</td>
    <td  rowspan="2" style="border-right:1px solid #000;padding:4px;text-align:center;"  width="25%">รายการ</td>
    
';


    if (mysqli_num_rows($result) > 0) {
        while($row = mysqli_fetch_assoc($result)) {
            $head2 =       '
           
    <td  colspan="2" style="border-right:1px solid #000;padding:4px;text-align:center;"  width="10%">'.$row['site_abbre'].'</td>
    </tr>
    <tr style="border:1px solid #000;padding:4px;">
    <td  colspan="2" style="border-right:1px solid #000;padding:4px;text-align:center;"  width="10%">คิดเป็น%</td>
    </tr>
    ';
   
}
        $head3 = ' 
</thead>
	<tbody>';
   

} 
mysqli_close($conn);    
$end = "</tbody>
</table>";
$mpdf = new \Mpdf\Mpdf(['mode' => 'utf-8' , 'format' => 'A4'] );


$mpdf->SetAdditionalXmpRdf($rdf);
$mpdf->WriteHTML($head);

$mpdf->WriteHTML($head2);
$mpdf->WriteHTML($head3);
$mpdf->WriteHTML($content);

$mpdf->WriteHTML($end);

$mpdf->Output();
?>

</body>
</html>