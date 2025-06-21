<?php
include_once("checklogin.php");
include_once("connectdb.php");
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<title>Local Buengkan - รายการสั่งซื้อ</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">

	<link rel="icon" type="image/png" href="images/icons/favicon.png"/>
	<link rel="stylesheet" type="text/css" href="vendor/bootstrap/css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="fonts/font-awesome-4.7.0/css/font-awesome.min.css">
	<link rel="stylesheet" type="text/css" href="fonts/iconic/css/material-design-iconic-font.min.css">
	<link rel="stylesheet" type="text/css" href="fonts/linearicons-v1.0.0/icon-font.min.css">

	<link rel="stylesheet" type="text/css" href="vendor/animate/animate.css">
	<link rel="stylesheet" type="text/css" href="vendor/css-hamburgers/hamburgers.min.css">
	<link rel="stylesheet" type="text/css" href="vendor/animsition/css/animsition.min.css">

	<link rel="stylesheet" type="text/css" href="vendor/perfect-scrollbar/perfect-scrollbar.css">
	<link rel="stylesheet" type="text/css" href="css/util.css">
	<link rel="stylesheet" type="text/css" href="css/main.css">
    
    <!--<link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">-->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Prompt&display=swap" rel="stylesheet">
<style>
    body {
        font-family: "Prompt", serif;
    }
    table {
        font-family: "Prompt", serif;
        font-size: 14px;
    }

</style>
    
</head>
<body class="animsition"> <!-- class="animsition" -->
	
<?php include('header.php'); ?>
	
	<!-- breadcrumb -->
	<div class="container">
		<div class="bread-crumb flex-w p-l-25 p-r-15 p-t-30 p-lr-0-lg">
			<a href="index.php" class="stext-109 cl8 hov-cl1 trans-04">
				หน้าหลัก
				<i class="fa fa-angle-right m-l-9 m-r-10" aria-hidden="true"></i>
			</a>

			<span class="stext-109 cl4">
				รายการสั่งซื้อ
			</span>
		</div>
	</div>
		

<div class="container my-5">
    <div class="row">
        <!-- Left: Food Menu -->
      <div class="col-lg-6 border border-secondary rounded p-3">
        <h4 class="mb-4">รายการสั่งซื้อทั้งหมด</h4>
            
            
          <table id="trasactionsTable" class="table table-striped table-bordered">
              <thead>
                <tr>
                    <th>&nbsp;</th>
                    <th>สถานะ</th>
                    <th>Order ID</th>
                    <th>ราคารวม (บาท)</th>
                    <th>Booking Date</th>
                    <th>Booking Type</th>
                </tr>
              </thead>
              <tbody>
<?php
$sql = "SELECT * FROM `bookings` WHERE `user_id` = '{$_SESSION['user_id']}' ORDER BY `bookings`.`id` DESC"; // WHERE `user_id` = '{$_SESSION['user_id']}'
$result = $conn->query($sql);
while ($row = $result->fetch_assoc()) {
?>
                  <tr>
                      <td>
                          <a href="transactions.php?id=<?php echo $row['id'];?>&t=<?php echo floor($row['total_price']); ?>&p=<?php echo $row['booking_type'];?>" class="btn btn-outline-info btn-sm" data-id="<?= $row['id'] ?>">
                              <i class="fa fa-search"></i> 
                              รายละเอียด
                          </a>
                      </td>
                      <td>
                          <?php
                            if($row['order_status']=="รอการชำระเงิน")
echo "<a href='#' class='text-primary js-show-modal1' data-id='{$row['id']}' data-target='#md1' data-total='{$row['total_price']}'><i class='fa fa-qrcode'></i> ".$row['order_status']." <i class='fa fa-hand-pointer-o'></i></a>"; 
                            else if ($row['order_status']=="ชำระเงินแล้ว")
                                echo "<a href='receipt.php?id={$row['id']}' target='_blank' style='text-decoration: none'><span class='text-success'>".$row['order_status']."</span> <i class='fa fa-print' class='text-success'></i></a>";
                            else if ($row['order_status']=="ยกเลิก")
                                echo "<span class='text-danger'>".$row['order_status']."</span>";
                          ?>
                      </td>
                      <td class="text-center" style="font-size: 13px"><?php echo $row['id']; ?></td>
                      <td><?php echo number_format($row['total_price'], 0) ?></td>
                      <td class="text-center" style="font-size: 13px">
                          <?php 
                            $booking_date = substr($row['booking_date'],0,10);
                            echo $booking_date; 
                          ?></td>
                      <td class="text-center">
                          <?php if ($row['booking_type']=='plan') { ?>
                          <a href="plan_schedule.php?bid=<?php echo $row['id'];?>" class="btn btn-outline-info btn-sm" target="_blank" title="ดูกำหนดการ">
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

        <!-- Right: Cart -->
        <div class="col-lg-6 mt-3">
            <h4 class="text-center mb-4">รายละเอียดการสั่งซื้อ Order ID: <?php echo empty($_GET['id']) ? "?" : $_GET['id']; ?></h4>


<!-- อาหาร -->            
<?php
if(!empty($_GET['id'])){
    $sql = "SELECT * FROM `booking_details` WHERE `booking_id` = '{$_GET['id']}' AND `type` = 'food' ORDER BY `booking_details`.`id` ASC";
    //var_dump($sql);
    $result = $conn->query($sql);
    $rowCount = $result->num_rows;
    if($rowCount > 0){
?>
<div class="container">
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
            <td><a href="food_detail.php?fid=<?php echo $row['item_id'];?>" target="_blank"><?php echo $row['item_name'];?></a></td>
            <td><?php echo substr($row['booking_date'],0,10);?><br><?php echo $row['booking_round'];?></td>
            <td><?php echo number_format($row['price_per_unit'],0);?></td>
            <td><?php echo number_format($row['quantity'],0);?></td>
            <td><?php echo number_format($row['total_price'],0);?></td>
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
<h5 class="m-1 text-info">ทริปท่องเที่ยว &gt;&gt;</h5>
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
            <td><a href="tour_detail.php?tid=<?php echo $row['item_id'];?>" target="_blank"><?php echo $row['item_name'];?></a><br>
<?php
$sqlTrip = "SELECT * FROM users WHERE user_id='{$row['owner']}' "; 
$rsTrip = $conn->query($sqlTrip);    
$rowTrip = $rsTrip->fetch_assoc();
echo "<a href='images/users/{$rowTrip['picture']}' target='_blank'><img src='images/users/{$rowTrip['picture']}' class='rounded-circle mt-2' width='45' title='ไกด์: {$rowTrip['fullname']}' alt='{$rowTrip['fullname']}'></a>";
?>                
            </td>
            <td><?php echo substr($row['booking_date'],0,10);?><br><?php echo $row['booking_round'];?></td>
            <td><?php echo number_format($row['price_per_unit'],0);?></td>
            <td><?php echo number_format($row['quantity'],0);?></td>
            <td><?php echo number_format($row['total_price'],0);?></td>
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
<h5 class="m-1 text-info">ที่พักโฮมสเตย์ &gt;&gt;</h5>
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
            <td><a href="homestay_detail.php?hid=<?php echo $row['item_id'];?>" target="_blank"><?php echo $row['item_name'];?></a></td>
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
            <td><?php echo number_format($row['total_price'],0);?></td>
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
<h5 class="m-1 text-info">สินค้าและของฝาก &gt;&gt;</h5>
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
            <td><a href="product_detail.php?pid=<?php echo $row['item_id'];?>" target="_blank"><?php echo $row['item_name'];?></a></td>
            <td><?php echo substr($row['booking_date'],0,10);?></td>
            <td><?php echo number_format($row['price_per_unit'],0);?></td>
            <td><?php echo number_format($row['quantity'],0);?></td>
            <td><?php echo number_format($row['total_price'],0);?></td>
        </tr>
<?php } ?>
    </tbody>   
</table>
</div>
<?php } } // end if($rowCount > 0) ?>
            
            
            <!--<div id="cart">
                <p class="text-center">ไม่มีรายการที่เลือกไว้</p>
            </div>-->
            <div class="cart-summary text-center" style="font-size: 17px">
                <strong><?php echo empty($_GET['t']) ? "คลิกปุ่ม รายละเอียด ในตารางรายการด้านซ้ายเพื่อดูข้อมูล" : "รวมทั้งสิ้น: ".number_format($_GET['t'], 0)." บาท"; ?></strong> &nbsp; 
            </div>
            <!--<button class="btn btn-success btn-block mt-3" type="button">ยืนยันการทำรายการจอง</button>-->
        </div>
    </div>
</div>
			

	<?php include("footer.php");?>


	<!-- Back to top -->
	<div class="btn-back-to-top" id="myBtn">
		<span class="symbol-btn-back-to-top">
			<i class="zmdi zmdi-chevron-up"></i>
		</span>
	</div>

    
	<!-- Modal1 -->
	<div class="wrap-modal1 js-modal1 p-t-60 p-b-20" id="md1">
		<div class="overlay-modal1 js-hide-modal1"></div>

		<div class="container">
			<div class="bg0 p-t-60 p-b-30 p-lr-15-lg how-pos3-parent">
				<button class="how-pos3 hov3 trans-04 js-hide-modal1">
					<img src="images/icons/icon-close.png" alt="CLOSE">
				</button>

				<div class="row">
					<div class="col-md-6 col-lg-7 p-b-30">
						<div class="p-l-25 p-r-30 p-lr-0-lg">
							<div class="wrap-slick3 flex-sb flex-w">
								<div class="wrap-slick3-dots"></div>
								<div class="wrap-slick3-arrows flex-sb-m flex-w"></div>

								<div class="slick3 gallery-lb">
								<div class="item-slick3" data-thumb="images/qrcode.png">
									<div class="wrap-pic-w pos-relative">
										<img src="images/qrcode.png" style="width: 400px">
									</div>
								</div>
                                    
								</div>
							</div>
						</div>
					</div>
					
					<div class="col-md-6 col-lg-5 p-b-30">
						<div class="p-r-50 p-t-5 p-lr-0-lg">
							<h5 class="mtext-105 cl2 js-name-detail p-b-14">
								ชื่อบัญชี Local Buengkan Co.,Ltd.
							</h5>

							<span class="d-flex mtext-106 mt-4 justify-content-center">
								จำนวนเงิน &nbsp;  <span id="billTotal" class="text-success"></span> &nbsp; บาท
							</span>

							<!--<p class="stext-102 cl3 p-t-23">
								Detail
							</p>-->
							
							<!--  -->
<form method="post" enctype="multipart/form-data" action="<?php echo $_SERVER['PHP_SELF'];?>">
							<div class="p-t-33">
								<div class="flex-w flex-r-m p-b-40">
									<div class="size-203 flex-c-m respon6">
										อัปโหลดสลิป
									</div>

									<div class="size-204 respon6-next">
<div class="flex-w m-r-20 m-tb-10">

<input class="mtext-104 cl3 txt-center" type="file" name="slip" required>
<input type="hidden" name="bookingID" id="bookingID">             
										</div>
									</div>
								</div>

								<div class="flex-w flex-r-m p-b-10">
									<div class="size-204 flex-w flex-m respon6-next">
                                
										<button type="submit" class="flex-c-m stext-101 cl0 size-101 bg1 bor1 hov-btn1 p-lr-15 trans-04">
											แจ้งการชำระเงิน
										</button>
									</div>
								</div>	
							</div>
</form>

							<!--  -->
							<div class="flex-w flex-m p-l-100 p-t-40 respon7">

							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
    
<script>
document.addEventListener("click", function (e) {
    if (e.target.classList.contains("js-show-modal1")) {
        e.preventDefault();
        //console.log(e.target.dataset.id);
        document.getElementById("bookingID").value = e.target.dataset.id;
        document.getElementById("billTotal").textContent = 
        Number(e.target.dataset.total).toLocaleString('th-TH', { minimumFractionDigits: 0, maximumFractionDigits: 0 });
        //document.getElementById("productModal").style.display = "block";
    }
    if (e.target.classList.contains("modal-close")) {
        //document.getElementById("productModal").style.display = "none";
    }
});
    
</script>
    
<!--===============================================================================================-->	
	<script src="vendor/jquery/jquery-3.2.1.min.js"></script>
<!--===============================================================================================-->
	<script src="vendor/animsition/js/animsition.min.js"></script>
<!--===============================================================================================-->
	<script src="vendor/bootstrap/js/popper.js"></script>
	<script src="vendor/bootstrap/js/bootstrap.min.js"></script>
<!--===============================================================================================-->
	<script src="vendor/sweetalert/sweetalert.min.js"></script>
<!--===============================================================================================-->
	<script src="vendor/perfect-scrollbar/perfect-scrollbar.min.js"></script>
    
	<script src="js/main.js"></script>


<!-- jQuery and Bootstrap Bundle -->
<!--<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>-->
<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap4.min.js"></script>
<!--<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>-->
<script>
    $(document).ready(function () {
        // Initialize DataTable
        $('#trasactionsTable').DataTable();
    });
</script>
    
    
<?php
// แจ้งชำระเงิน อัปโหลดสลิป
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_FILES['slip'])) {
    $uploadDir = "images/slips/";
    $bookingID = $_POST['bookingID'];

    // ประเภทไฟล์ที่อนุญาต
    $allowedTypes = ['jpg', 'jpeg', 'png', 'gif', 'webp'];
    $fileType = strtolower(pathinfo($_FILES['slip']['name'], PATHINFO_EXTENSION));
    $allowedMimeTypes = ['image/jpeg', 'image/png', 'image/gif', 'image/webp'];

    // สร้างชื่อไฟล์ตามรูปแบบ bookingID_วันเดือนปีเวลา.นามสกุล
    $fileName = $bookingID . "_" . date("Y-m-d_H-i-s") . "." . $fileType;
    $uploadFilePath = $uploadDir . $fileName;

    // ตรวจสอบประเภทไฟล์
    if (in_array($fileType, $allowedTypes) && in_array(mime_content_type($_FILES['slip']['tmp_name']), $allowedMimeTypes)) {
        // อัปโหลดไฟล์
        if (move_uploaded_file($_FILES['slip']['tmp_name'], $uploadFilePath)) {
            // เก็บข้อมูลลงในฐานข้อมูล
            $sql = "INSERT INTO payment_slips (file_name, uploaded_at, booking_id) VALUES (?, NOW(), ?)";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("si", $fileName, $bookingID);

            if ($stmt->execute()) {
                echo "<script>swal('','อัปโหลดสลิปสำเร็จ! แอดมินจะอัปเดตสถานะการสั่งซื้อให้เร็ว ๆ นี้', 'success');</script>";
            } else {
                echo "<script>swal('','เกิดข้อผิดพลาดในการบันทึกข้อมูลในฐานข้อมูล!', 'warning');</script>";
            }
            $stmt->close();
        } else {
            echo "<script>swal('','เกิดข้อผิดพลาดในการอัปโหลดไฟล์!', 'warning');</script>";
        }
    } else {
        echo "<script>swal('','ประเภทไฟล์ไม่ถูกต้อง! กรุณาอัปโหลดเฉพาะ JPG, PNG, GIF, หรือ WEBP', 'warning');</script>";
    }
}
?>

    
</body>
</html>