<?php
include_once("checklogin.php");
include_once("../connectdb.php");
include_once("functions.php");
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

  <link rel="stylesheet" type="text/css" href="../fonts/font-awesome-4.7.0/css/font-awesome.min.css">
      
  <!-- PLUGINS CSS STYLE -->
  <link href="plugins/nprogress/nprogress.css" rel="stylesheet" />
  
  <link href="plugins/prism/prism.css" rel="stylesheet" />
  

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
              
  <nav aria-label="breadcrumb" class="my-0 m-0">
    <ol class="breadcrumb">
      <li class="breadcrumb-item">  <a href="index2.php">หน้าหลัก  </a>  </li>
      <li class="breadcrumb-item active" aria-current="page">รายการจองทั้งหมด  </li>
    </ol>
  </nav>

<div class="container my-0 m-0">
    <div class="row">
              
<!-- Transactions -->
<div class="card card-default col-lg-7 my-0">
  <div class="card-header">
    <h2><i class="mdi mdi-format-list-bulleted"></i> รายการจองทั้งหมด</h2>
     
      <div class="row text-right">

    </div>
  </div>
    
  <div class="card-body">
    <table id="trasactionsTable" class="table table-striped table-bordered" style="font-size: 13px">
              <thead>
                <tr>
                    <th>&nbsp;</th>
                    <th>สถานะ</th>
                    <th>สลิป</th>
                    <th style="text-transform: none;">ราคารวม</th>
                    <th style="text-transform: none;">Booking Date</th>
                    <th style="text-transform: none;">Booking Type</th>
                </tr>
              </thead>
              <tbody>
<?php
$sql = "SELECT * FROM `bookings` AS b 
LEFT JOIN users AS u ON b.user_id=u.user_id
ORDER BY b.id DESC"; 
$result = $conn->query($sql);
while ($row = $result->fetch_assoc()) {
?>
                  <tr>
                      <td>
                          <a href="transactions.php?id=<?php echo $row['id'];?>&t=<?php echo floor($row['total_price']); ?>&p=<?php echo $row['booking_type'];?>" class="btn btn-outline-info btn-sm" data-id="<?= $row['id'] ?>" style="text-transform: none; font-size: 13px; padding: 3px 6px; line-height: 1.5;">
                              <i class="fa fa-search"></i> 
                              รายละเอียด
                          </a>
                      </td>
                      <td>
                          
                          <?php
                            if($row['order_status']=="รอการชำระเงิน")
echo "<a href='#' class='text-primary' data-toggle='modal' data-id='{$row['id']}' data-target='#updateStatus' data-total='{$row['total_price']}'>".$row['order_status']." <i class='fa fa-hand-pointer-o'></i></a>"; 
                            else if ($row['order_status']=="ชำระเงินแล้ว")
                                //echo "<span class='text-success'>".$row['order_status']."</span>";
                                echo "<a href='../receipt.php?id={$row['id']}' target='_blank' style='text-decoration: none'><span class='text-success'>".$row['order_status']."</span> <i class='fa fa-print' class='text-success'></i></a>";
                            else if ($row['order_status']=="ยกเลิก")
                                echo "<span class='text-danger' title='{$row['note']}'>".$row['order_status']."</span>";
                          ?>
                      </td>
                      <td>
<?php
$sql_slip = "SELECT * FROM payment_slips WHERE booking_id='{$row['id']}' ORDER BY id DESC LIMIT 1"; 
$result_slip = $conn->query($sql_slip);
$row_slip = $result_slip->fetch_assoc();
if (!empty($row_slip['file_name'])){
    echo "<a href='../images/slips/{$row_slip['file_name']}' target='_blank'><img src='../images/slips/{$row_slip['file_name']}' width='30' style='border: 1px solid #BBBBBB; border-radius: 5px;'></a>";
}
?>
                      </td>

                      <td class="text-center" style="font-size: 13px">[<?php echo $row['id']; ?>] <br> <?php echo number_format($row['total_price'], 0) ?>
                      </td>
                      <td class="text-center" style="font-size: 13px">
                          <?php 
                            $booking_date = substr($row['booking_date'],0,10);
                            echo $booking_date . "<br>";
                            echo $row['fullname'];
                          ?></td>
                      <td class="text-center">
                          <?php if ($row['booking_type']=='plan') { ?>
                          <a href="../plan_schedule.php?bid=<?php echo $row['id'];?>" class="btn btn-outline-info btn-sm mr-0 ml-0" target="_blank" title="ดู plan" style="text-transform: none; font-size: 13px; padding: 3px 6px; line-height: 1.5;">
                              <i class="fa fa-list"></i> 
                              <?php echo $row['booking_type'] ?>
                          </a>
                          <?php } else { ?>
                              <?php echo $row['booking_type'] ?>
                          <?php } ?>
                      </td>
                  </tr>
                <?php } ?>
              </tbody>
          </table>
    </div>
</div>
  
        
        <!-- Right: Cart -->
        <div class="card card-default col-lg-5 my-0">
            <h4 class="text-center mb-4 mt-5">รายละเอียดการสั่งซื้อ Order ID: <?php echo empty($_GET['id']) ? "?" : $_GET['id']; ?></h4>


<!-- อาหาร -->            
<?php
if(!empty($_GET['id'])){
    $sql = "SELECT * FROM `booking_details` WHERE `booking_id` = '{$_GET['id']}' AND `type` = 'food' ORDER BY `booking_details`.`id` ASC";
    //var_dump($sql);
    $result = $conn->query($sql);
    $rowCount = $result->num_rows;
    if($rowCount > 0){
?>
<div class="container mx-0">
<h5 class="m-1 text-info">อาหาร &gt;&gt;</h5>
<table class="table table-striped table-bordered" style="font-size: 12px">
    <thead>
        <tr>
            <th>ชื่อเมนูอาหาร</th>
            <th>วันที่</th>
            <th>ราคา</th>
            <th>จำนวน</th>
            <th>รวม</th>
    </thead>
    <tbody>
<?php
    while ($row = $result->fetch_assoc()) {
?>
        <tr>
            <td><a href="../food_detail.php?fid=<?php echo $row['item_id'];?>" target="_blank"><?php echo $row['item_name'];?></a></td>
            <td><?php echo substr($row['booking_date'],0,10);?><br><?php echo $row['booking_round'];?></td>
            <td><?php echo number_format($row['price_per_unit'],0);?></td>
            <td><?php echo number_format($row['quantity'],0);?></td>
            <td><?php echo number_format($row['total_price'],0);?><br>
            <?php echo "(คอมมิชชัน: {$row['commission_baht']})";?>
            </td>
        </tr>
<?php } ?>
    </tbody>
            
</table>
</div>
<?php } } // end if(!empty($_GET['id'])) AND end if($rowCount > 0) ?>
            
            
<!-- ทริปท่องเที่ยว -->            
<?php
if(!empty($_GET['id'])){
    $sql = "SELECT * FROM `booking_details` WHERE `booking_id` = '{$_GET['id']}' AND `type` = 'tour' ORDER BY `booking_details`.`id` ASC";
    //var_dump($sql);
    $result = $conn->query($sql);
    $rowCount = $result->num_rows;
    if($rowCount > 0){
?>
<div class="container">
<h5 class="m-1 text-info mt-4">ทริปท่องเที่ยว &gt;&gt;</h5>
<table class="table table-striped table-bordered" style="font-size: 12px">
    <thead>
        <tr>
            <th>ชื่อทริป</th>
            <th>วันที่</th>
            <th>ราคา</th>
            <th>จำนวน(คน)</th>
            <th>รวม</th>
    </thead>
    <tbody>
<?php
    while ($row = $result->fetch_assoc()) {
?>
        <tr>
            <td><a href="../tour_detail.php?tid=<?php echo $row['item_id'];?>" target="_blank"><?php echo $row['item_name'];?></a><br>
<?php
$sqlTrip = "SELECT * FROM users WHERE user_id='{$row['owner']}' "; 
$rsTrip = $conn->query($sqlTrip);    
$rowTrip = $rsTrip->fetch_assoc();
echo "<a href='../images/users/{$rowTrip['picture']}' target='_blank'><img src='../images/users/{$rowTrip['picture']}' class='rounded-circle mt-2' width='45' title='ไกด์: {$rowTrip['fullname']}' alt='{$rowTrip['fullname']}'></a>";
?>            
            </td>
            <td><?php echo substr($row['booking_date'],0,10);?><br><?php echo $row['booking_round'];?></td>
            <td><?php echo number_format($row['price_per_unit'],0);?></td>
            <td><?php echo number_format($row['quantity'],0);?></td>
            <td><?php echo number_format($row['total_price'],0);?><br>
            <?php echo "(คอมมิชชัน: {$row['commission_baht']})";?></td>
        </tr>
<?php } ?>
    </tbody>   
</table>
</div>
<?php } } // end if($rowCount > 0) ?>
            
            
<!-- ที่พักโฮมสเตย์ -->            
<?php
if(!empty($_GET['id'])){
    $sql = "SELECT * FROM `booking_details` WHERE `booking_id` = '{$_GET['id']}' AND `type` = 'homestay' ORDER BY `booking_details`.`id` ASC";
    //var_dump($sql);
    $result = $conn->query($sql);
    $rowCount = $result->num_rows;
    if($rowCount > 0){
?>
<div class="container">
<h5 class="m-1 text-info mt-4">ที่พักโฮมสเตย์ &gt;&gt;</h5>
<table class="table table-striped table-bordered" style="font-size: 12px">
    <thead>
        <tr>
            <th>ชื่อที่พักโฮมสเตย์</th>
            <th>วันที่</th>
            <th>ราคา</th>
            <th>จำนวนห้อง</th>
            <th>จำนวนคืน</th>
            <th>รวม</th>
    </thead>
    <tbody>
<?php
    while ($row = $result->fetch_assoc()) {
?>
        <tr>
            <td><a href="../homestay_detail.php?hid=<?php echo $row['item_id'];?>" target="_blank"><?php echo $row['item_name'];?></a></td>
            <td>
                <?php 
                    if($_GET['p']=="plan"){
                        echo $row['booking_date'];
                    } else {
                        echo "เช็คอิน: ".$row['datecheckin']."<br>";
                        echo "เช็คเอาท์: ".$row['datecheckout'];
                    }
                ?>
            </td>
            <td><?php echo number_format($row['price_per_unit'],0);?></td>
            <td><?php echo number_format($row['quantity'],0);?></td>
            <td><?php echo empty($row['night']) ? 1 : $row['night']; ?></td>
            <td><?php echo number_format($row['total_price'],0);?><br>
            <?php echo "(คอมมิชชัน: {$row['commission_baht']})";?></td>
        </tr>
<?php } ?>
    </tbody>   
</table>
</div>
<?php } } // end if($rowCount > 0) ?>
                        
            
<!-- สินค้าและของฝาก -->            
<?php
if(!empty($_GET['id'])){
    $sql = "SELECT * FROM `booking_details` WHERE `booking_id` = '{$_GET['id']}' AND `type` = 'product' ORDER BY `booking_details`.`id` ASC";
    //var_dump($sql);
    $result = $conn->query($sql);
    $rowCount = $result->num_rows;
    if($rowCount > 0){
?>
<div class="container">
<h5 class="m-1 text-info mt-4">สินค้าและของฝาก &gt;&gt;</h5>
<table class="table table-striped table-bordered" style="font-size: 12px">
    <thead>
        <tr>
            <th>ชื่อสินค้า</th>
            <th>วันที่</th>
            <th>ราคา</th>
            <th>จำนวน</th>
            <th>รวม</th>
    </thead>
    <tbody>
<?php
    while ($row = $result->fetch_assoc()) {
?>
        <tr>
            <td><a href="../product_detail.php?pid=<?php echo $row['item_id'];?>" target="_blank"><?php echo $row['item_name'];?></a></td>
            <td><?php echo substr($row['booking_date'],0,10);?></td>
            <td><?php echo number_format($row['price_per_unit'],0);?></td>
            <td><?php echo number_format($row['quantity'],0);?></td>
            <td><?php echo number_format($row['total_price'],0);?><br>
            <?php echo "(คอมมิชชัน: {$row['commission_baht']})";?></td>
        </tr>
<?php } ?>
    </tbody>   
</table>
</div>
<?php } } // end if($rowCount > 0) ?>
            
<?php
$booking_id = @$_GET['id'];
$stmt = $conn->prepare("SELECT SUM(commission_baht) AS total_commission FROM booking_details WHERE booking_id = ?");
$stmt->bind_param("i", $booking_id);
$stmt->execute();
$stmt->bind_result($total_commission);
$stmt->fetch();
$stmt->close();            
?>
            <!--<div id="cart">
                <p class="text-center">ไม่มีรายการที่เลือกไว้</p>
            </div>-->
            <div class="cart-summary text-center mt-3 mb-3" style="font-size: 17px; color: #333333">
                <?php echo empty($_GET['t']) ? "คลิกปุ่ม รายละเอียด ในตารางรายการด้านซ้ายเพื่อดูข้อมูล" : "รวมทั้งสิ้น: ".number_format($_GET['t'], 0)." บาท<br> <span style='font-size: 14px'>ค่าคอมมิชชันรวม ".number_format($total_commission, 2)." บาท</span>"; ?> &nbsp; 
            </div>
            <!--<button class="btn btn-success btn-block mt-3" type="button">ยืนยันการทำรายการจอง</button>-->
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
      
      <script src="../vendor/sweetalert/sweetalert.min.js"></script>

<!-- อัปเดตสถานะออเดอร์ -->
<script>
$(document).on('click', 'a[data-target="#updateStatus"]', function() {
    var bookingID = $(this).data('id');
    $('#bookingID').val(bookingID);
});      
</script>      
<div class="modal fade" id="updateStatus" tabindex="-1" role="dialog" aria-labelledby="exampleModalFormTitle"
  aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalFormTitle"><i class="mdi mdi-lead-pencil"></i> อัปเดตสถานะ</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
        
    <form method="post" action="<?=$_SERVER['PHP_SELF']?>">  
      <div class="modal-body">
          
  <div class="form-group">
    <label for="order_status">สถานะ</label>
    <select class="form-control" id="order_status" name="order_status">
      <option value="รอการชำระเงิน">รอการชำระเงิน</option>
      <option value="ชำระเงินแล้ว">ชำระเงินแล้ว</option>
      <option value="ยกเลิก">ยกเลิก</option>
    </select>
  </div>          
          
          <div class="form-group">
            <label for="note">หมายเหตุ</label>
            <input type="text" class="form-control" id="note" name="note" placeholder="หมายเหตุ">
          </div>

          <div class="form-footer mt-6">
            <input type="hidden" name="action" value="update_status">
            <input type="hidden" name="bookingID" id="bookingID">
          </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="mdi mdi-cancel"></i> ยกเลิก</button>
        <button type="submit" class="btn btn-primary"><i class="mdi mdi-content-save"></i> บันทึก</button>
      </div>
    </form>
        
    </div>
  </div>
</div>              
<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action']) && $_POST['action'] === 'update_status') {
    // รับค่าจากฟอร์ม
    $bookingID = intval($_POST['bookingID']);
    $orderStatus = $_POST['order_status'];
    $note = $_POST['note'];

    // ตรวจสอบว่า $bookingID และ $orderStatus ไม่ว่างเปล่า
    if (!empty($bookingID) && !empty($orderStatus)) {
        // เตรียมคำสั่ง SQL สำหรับอัปเดตข้อมูล
        $sql = "UPDATE bookings SET order_status = ?, note = ? WHERE id = ?";
        
        // ใช้ prepared statement ป้องกัน SQL Injection
        if ($stmt = $conn->prepare($sql)) {
            $stmt->bind_param("ssi", $orderStatus, $note, $bookingID);
            
            // ดำเนินการคำสั่ง
            if ($stmt->execute()) {
                addLog($conn, $_SESSION['buser_id'], $_SESSION['bfullname'], $_SESSION['brole'], "อัปเดตสถานะออเดอร์ {$bookingID}", "อัปเดตสถานะออเดอร์ {$bookingID} -> {$orderStatus}");
                echo "<script>swal('','อัปเดตสถานะออเดอร์สำเร็จ!', 'success'); window.location.href='transactions.php';</script>";
            } else {
                echo "<script>swal('','เกิดข้อผิดพลาดในการอัปเดตสถานะ', 'warning');</script>";
            }
            
            // ปิด statement
            $stmt->close();
        } else {
            echo "<script>swal('','ไม่สามารถเตรียมคำสั่ง SQL ได้', 'warning');</script>";
        }
    } else {
        echo "<script>swal('','กรุณากรอกข้อมูลให้ครบถ้วน', 'warning');</script>";
    }
}
?>

      
<script>
    $(document).ready(function() {
        
        var table = $('#trasactionsTable').DataTable({
            pageLength: 50 // กำหนดจำนวนรายการเริ่มต้นต่อหน้า
        });
        
        // ปรับแต่งช่องค้นหาไปที่ด้านขวา
        $(".dataTables_filter").css({
            "float": "right",
            "margin-left": "auto",
            "font-size": "13px"
        });
        
        // ปรับแต่ง select (Entries per page)
        $(".dataTables_length select").css({
            "border": "1px solid #ccc", // กรอบสีเทา
            "border-radius": "4px", // ขอบมน
            "padding": "5px 10px",
            "font-size": "13px", 
            "width": "70px",
            "background-color": "#f8f9fa", // สีพื้นหลัง
            "color": "#495057" // สีตัวอักษร
        });     
        
    });
</script>
      
      
    </body>
</html>
