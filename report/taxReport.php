<?php
    session_start();
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
            height: 16px;
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

        h4 {
            font-weight: bold;
        }
    </style>
    
    <!-- Custom CSS ค้นหา -->
    <script src="../resources/lib/dselect.js"></script>

</head>
<body>
<section class="container my-2">
    <div class="card">       
        <div div class="card-body">
            <div class="headReport">
                  <h5 class="fw-bold p-2">TAX003 | รายงานภาษีซื้อ</h5>
            </div>

            <div class="text-center">

                <form action="" method="POST">
                    <div class="row">
                        <div class="col-md-8 mb-2">
                            <select name="selectMonth" class="form-select" id="selectMonth">
                            <?php
                            
                            $stmt = $conn->query("SELECT DISTINCT report_month FROM bill_head WHERE report = 'Y'");
                            $stmt->execute();
                            $monthSelect = $stmt->fetchAll();
                            
                            
                                echo '<option value="">เลือกเดือน</option>';
                                foreach ($monthSelect as $month) {
                                    echo '<option value="'. $month['report_month'] .'">'. $month['report_month'] .'</option>';
                                    }

                                
                            ?> 
                            </select>
                        </div>
                        <?php 
                        $monthTax=substr($_POST['selectMonth'],-2);
                        $yearTax=substr($_POST['selectMonth'],0,4);
                        if($monthTax=='01'){
                            $_SESSION['monthTax'] = 'มกราคม';
                        }else if($monthTax=='02'){
                            $_SESSION['monthTax'] = 'กุมภาพันธ์';
                        }else if($monthTax=='03'){
                            $_SESSION['monthTax'] = 'มีนาคม';
                        }else if($monthTax=='04'){
                            $_SESSION['monthTax'] = 'เมษายน';
                        }else if($monthTax=='05'){
                            $_SESSION['monthTax'] = 'พฤษภาคม';
                        }else if($monthTax=='06'){
                            $_SESSION['monthTax'] = 'มิถุนายน';
                        }else if($monthTax=='07'){
                            $_SESSION['monthTax'] = 'กรกฎาคม';
                        }else if($monthTax=='08'){
                            $_SESSION['monthTax'] = 'สิงหาคม';
                        }else if($monthTax=='09'){
                            $_SESSION['monthTax'] = 'กันยายน';
                        }else if($monthTax=='10'){
                            $_SESSION['monthTax'] = 'ตุลาคม';
                        }else if($monthTax=='11'){
                            $_SESSION['monthTax'] = 'พฤศจิกายน';
                        }else if($monthTax=='12'){
                            $_SESSION['monthTax'] = 'ธันวาคม';
                        }
                       
                        $_SESSION['searchTax'] = $_POST['selectMonth'];
                        $_SESSION['yearTax'] = $yearTax+543; 
                        ?>
                        
                        <div class="col-md-4">
                            <button type="submit" class="btn btn-success w-100" name="showReport"><i class="fa-solid fa-eye"></i> &nbsp;View Report</button>
                        </div>
                    </div>
                </form>
            </div>


            <table style="background: #FFA500;" width="100%" height="35">
                <tbody>
                    <tr>
                        <td style="text-align: center;">
                              
                              <a href="" class="menu"><img src="../image/icon/excel.png" width="auto" height="16">Export to Excel </a>
                        </td>
                    </tr>
                </tbody>
            </table>
            <iframe src="../report/taxDetail.php" ></iframe>
        </div>
    </div>
</section>

<script>
    var select_box_element_site = document.querySelector('#selectMonth');

    dselect(select_box_element_site, {
        search: true
    });
</script>

</body>
</html>

