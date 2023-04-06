<?php
    require_once "../include/header.php";


?>
<head>
    <style>
div.headReport {
  text-align: left;
  background-color: #D3D3D3;
  border-radius: 5px;
}
iframe {
    height :700px;
    width :100%;
    display:block;

}
menu {

    display:block;
    margin-bottom: -4;
    width: auto; 
    
    height: 16px; >
}
a:link {
  color: green;
  background-color: transparent;
  text-decoration: none;
}
a:visited {
  color: black;
  background-color: transparent;
  text-decoration: none;
}
a:hover {
  color: white;
  background-color: transparent;
}
a:active {
  color: yellow;
  background-color: transparent;
}
</style>
    

</head>
<body>
<section class="container mt-1">
 <div class="card">
                    
                        <div class="card-body">                          
<div class="headReport">
        <h5 class="fw-bold p-2 " >INC001 | รายงานสรุปรายรับ</h5>
    </div>
    <table style="background: #FFA500;" width="100%" height="35">
    <tbody><tr>
				<td style="text-align: center;">
					<a href="" class="menu"><img src="../image/icon/undo.png" width="auto" height="16"> กลับหน้าหลัก </a>
					<a href="" class="menu"><img src="../image/icon/excel.png" width="auto" height="16">Export to Excel </a>
				</td>
			</tr>
		</tbody></table>

<iframe src="../report/incomeDetail.php" ></iframe>
</div>
</div>
</body>
</html>

