<?php
include_once("checklogin.php");
include_once("functions.php");
include_once("../connectdb.php");

$stmtC = $conn->prepare("SELECT * FROM `commission_settings` LIMIT 1");
$stmtC->execute();
$resultC = $stmtC->get_result();
$rowC = $resultC->fetch_assoc();
?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
  <meta charset="utf-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />

    <meta http-equiv="Cache-Control" content="no-store, no-cache, must-revalidate, post-check=0, pre-check=0" />
    <meta http-equiv="Pragma" content="no-cache" />
    <meta http-equiv="Expires" content="0" />
      
  <title>Local buengkan - Admin</title>

  <!-- GOOGLE FONTS -->
  <link href="https://fonts.googleapis.com/css?family=Prompt&family=Karla:400,700|Roboto" rel="stylesheet">
  <link href="plugins/material/css/materialdesignicons.min.css" rel="stylesheet" />
  <link href="plugins/simplebar/simplebar.css" rel="stylesheet" />

  <!-- PLUGINS CSS STYLE -->
  <link href="plugins/nprogress/nprogress.css" rel="stylesheet" />
  
  <link href="plugins/prism/prism.css" rel="stylesheet" />
  
    <script src="plugins/jquery/jquery.min.js"></script>
    <script src="plugins/toaster/toastr.min.js"></script>
    <link href="plugins/toaster/toastr.min.css" rel="stylesheet">

  <link href="plugins/DataTables/DataTables-1.10.18/css/jquery.dataTables.min.css" rel="stylesheet" />
      

  <!-- MONO CSS -->
  <link id="main-css-href" rel="stylesheet" href="css/style.css" />

  <!-- FAVICON -->
  <link href="images/favicon.png" rel="shortcut icon" />

  <!--
    HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries
  -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->
  <script src="plugins/nprogress/nprogress.js"></script>
      
<style>
    body{
        font-family: "Prompt", serif;
    }      
</style>
</head>


  <body class="navbar-fixed sidebar-fixed" id="body">
    <script>
      NProgress.configure({ showSpinner: false });
      NProgress.start();
    </script>

    <!-- ====================================
    ——— WRAPPER
    ===================================== -->
    <div class="wrapper">
      
<?php include("left-sidebar.php"); ?>      

      <!-- ====================================
      ——— PAGE WRAPPER
      ===================================== -->
      <div class="page-wrapper">
          
<?php include("header.php"); ?>
          
        <!-- ====================================
        ——— CONTENT WRAPPER
        ===================================== -->
        <div class="content-wrapper">
          <div class="content">

 <div class="card card-default border-0 bg-transparent">
  
</div>
              
<!-- Foods Inventory -->
<div class="card card-default">
  <div class="card-header">
    <h2><i class="mdi mdi-settings"></i> ตั้งค่าคอมมิชชัน</h2>
     
      
  </div>
    
  <div class="card-body">
    
      <div class="modal-content">
              
    <form method="post" action="<?=$_SERVER['PHP_SELF']?>">  
      <div class="modal-body">
          
          <div class="form-group">
            <label for="chef_commission"><i class="mdi mdi-food-fork-drink"></i> การขาย <span class="text-primary">อาหาร</span> (% เปอร์เซ็นต์)</label>
            <input type="number" class="form-control" id="chef_commission" name="chef_commission" placeholder="% เปอร์เซ็นต์" min="0" value="<?php echo $rowC['chef_commission'];?>" required>
          </div>
          
          <div class="form-group">
            <label for="homestay_commission"><i class="mdi mdi-hotel"></i> การขาย <span class="text-primary">ที่พัก</span> (% เปอร์เซ็นต์)</label>
            <input type="number" class="form-control" id="homestay_commission" name="homestay_commission" placeholder="% เปอร์เซ็นต์" min="0" value="<?php echo $rowC['homestay_commission'];?>" required>
          </div>

          <div class="form-group">
            <label for="product_commission"><i class="mdi mdi-shopping"></i> การขาย <span class="text-primary">สินค้าและของฝาก</span> (% เปอร์เซ็นต์)</label>
            <input type="number" class="form-control" id="product_commission" name="product_commission" placeholder="% เปอร์เซ็นต์" min="0" value="<?php echo $rowC['product_commission'];?>" required>
          </div>
                    
          <div class="form-group">
            <label for="guide_commission"><i class="mdi mdi-map"></i> การขาย <span class="text-primary">ทริปท่องเที่ยว</span>  (% เปอร์เซ็นต์)</label>
            <input type="number" class="form-control" id="guide_commission" name="guide_commission" placeholder="% เปอร์เซ็นต์" min="0" value="<?php echo $rowC['guide_commission'];?>" required>
          </div>
                    
          <!--<div class="form-group">
            <label for="f_price"><i class="mdi mdi-truck-delivery"></i> ค่าขนส่งสินค้า (บาท)</label>
            <input type="number" class="form-control" id="f_price" name="f_price" placeholder="บาท" min="0" value="<?php //echo $rowC['product_delivery'];?>" required>
          </div>-->
          
          <div class="form-footer mt-6">
              <input type="hidden" name="action" value="update_commission">
          </div>
      </div>
      <div class="modal-footer">
        <button type="submit" class="btn btn-primary"><i class="mdi mdi-content-save"></i> บันทึก</button>
      </div>
    </form>
        
    </div>

  </div>
</div>
                         
    
</div>
          
        </div>
        
<?php include("footer.php"); ?>
          
      </div>
    </div>

                    <script src="plugins/jquery/jquery.min.js"></script>
                    <script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
                    <script src="plugins/simplebar/simplebar.min.js"></script>
                    <script src="https://unpkg.com/hotkeys-js/dist/hotkeys.min.js"></script>
                    
                    <script src="plugins/prism/prism.js"></script>
                    
                    <script src="plugins/DataTables/DataTables-1.10.18/js/jquery.dataTables.min.js"></script>
                    
                    <script src="plugins/apexcharts/apexcharts.js"></script>
                    
                    <script src="js/mono.js"></script>
                    <script src="js/chart.js"></script>
                    <script src="js/map.js"></script>
                    <script src="js/custom.js"></script>
      
      
<?php
// ตรวจสอบการส่งคำขอ POST
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action']) && $_POST['action'] === 'update_commission') {

    // รับค่าจากฟอร์ม
    $product_commission = isset($_POST['product_commission']) ? intval($_POST['product_commission']) : 0;
    $guide_commission = isset($_POST['guide_commission']) ? intval($_POST['guide_commission']) : 0;
    $chef_commission = isset($_POST['chef_commission']) ? intval($_POST['chef_commission']) : 0;
    $homestay_commission = isset($_POST['homestay_commission']) ? intval($_POST['homestay_commission']) : 0;
    $comm_id = 1 ;

        $sqlUpdate = "UPDATE commission_settings SET product_commission = ?, guide_commission = ?, chef_commission = ?, homestay_commission = ? WHERE comm_id = ?";
        $stmt = $conn->prepare($sqlUpdate);
        $stmt->bind_param("iiiii", $product_commission, $guide_commission, $chef_commission, $homestay_commission, $comm_id);
  
        if ($stmt->execute()) {
            addLog($conn, $_SESSION['buser_id'], $_SESSION['bfullname'], $_SESSION['brole'], "อัปเดตค่าคอมมิชชัน", "อัปเดตค่าคอมมิชชัน...");
            echo "<script>
                        toastr.success('อัปเดตค่าคอมมิชชันเรียบร้อย!');
                        setTimeout(function() {
                            window.location.href='commission_settings.php';
                        }, 2000); 
                    </script>";
        } else {
            echo "<script>toastr.error('อัปเดตค่าคอมมิชชันไม่สำเร็จ: " . $conn->error . "')</script>";
        }

}
?>
      
    </body>
</html>
