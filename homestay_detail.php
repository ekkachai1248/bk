<?php
// เปิด session และเชื่อมต่อฐานข้อมูล
error_reporting(E_NOTICE);
session_start();
include_once("connectdb.php");

// เมื่อมีการส่งข้อมูล POST เข้ามา
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $hid = $_POST['hid']; // รับค่ารหัส
    $qroom = $_POST['qroom'];     // รับค่าจำนวน
    $datecheckin = $_POST['chkin'];
    $datecheckout = $_POST['chkout'];
    $qperson = $_POST['qperson'];
    
    // หาจำนวนคืน
    $qnight = (new DateTime($_POST['chkout']))->diff(new DateTime($_POST['chkin']))->days;
    
    //var_dump($pid);

    // ดึงข้อมูลสินค้าจากฐานข้อมูลตามรหัสสินค้า
    $sql = "SELECT * FROM homestays WHERE homestay_id='{$hid}'"; 
    $rs = mysqli_query($conn, $sql);
    $data = mysqli_fetch_array($rs);

    // แยกรูปภาพออกจากกัน
    $pic = explode(";", $data['h_pictures']);

    // สร้าง session สำหรับเก็บข้อมูล
    if (isset($hid)) {
        $_SESSION['hid'][$hid] = $data['homestay_id'];
        $_SESSION['hname'][$hid] = $data['h_name'];
        $_SESSION['hprice'][$hid] = $data['h_price'];
        $_SESSION['hpicture'][$hid] = $pic[0];
        $_SESSION['qroom'][$hid] = $qroom; 
        $_SESSION['datecheckin'][$hid] = $datecheckin; 
        $_SESSION['datecheckout'][$hid] = $datecheckout; 
        $_SESSION['qperson'][$hid] = $qperson;
        $_SESSION['qnight'][$hid] = $qnight;
    }

    // ส่งข้อความยืนยันกลับไปยัง JavaScript
    //echo "สินค้าถูกเพิ่มลงในตะกร้าเรียบร้อยแล้ว!";
    exit; // หยุดการทำงาน PHP หลังจากส่งข้อมูลกลับ
}
?>


<?php
include_once("connectdb.php");

$hid = isset($_GET['hid']) ? (int)$_GET['hid'] : 0;
$stmt = $conn->prepare("SELECT * FROM homestays AS h INNER JOIN homestay_category AS hc ON h.hc_id=hc.hc_id  WHERE h.homestay_id = ?");
$stmt->bind_param("i", $hid);
$stmt->execute();
$result = $stmt->get_result();
$row = $result->fetch_assoc();
$stmt->close();
//$conn->close();
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<title>Homestay Detail</title>
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
	<link rel="stylesheet" type="text/css" href="vendor/select2/select2.min.css">
	<link rel="stylesheet" type="text/css" href="vendor/daterangepicker/daterangepicker.css">
	<link rel="stylesheet" type="text/css" href="vendor/slick/slick.css">
	<link rel="stylesheet" type="text/css" href="vendor/MagnificPopup/magnific-popup.css">
	<link rel="stylesheet" type="text/css" href="vendor/perfect-scrollbar/perfect-scrollbar.css">
	<link rel="stylesheet" type="text/css" href="css/util.css">
	<link rel="stylesheet" type="text/css" href="css/main.css">
</head>
<body class="animsition">
	
<?php include("header.php"); ?>
    
	<!-- Cart -->
	<div class="wrap-header-cart js-panel-cart">
		<div class="s-full js-hide-cart"></div>

		<div class="header-cart flex-col-l p-l-65 p-r-25">
			<div class="header-cart-title flex-w flex-sb-m p-b-8">
				<span class="mtext-103 cl2">
					ตะกร้าสินค้า
				</span>

				<div class="fs-35 lh-10 cl2 p-lr-5 pointer hov-cl1 trans-04 js-hide-cart">
					<i class="zmdi zmdi-close"></i>
				</div>
			</div>
			
			<div class="header-cart-content flex-w js-pscroll">
				<ul class="header-cart-wrapitem w-full">
					
<?php

if(!empty($_SESSION['hid'])) {
    $total = 0;
	foreach($_SESSION['hid'] as $h_id) {
    // แปลงค่า price และ item ให้เป็น float ก่อนคูณ
    $price = floatval($_SESSION['hprice'][$h_id]); // แปลงราคาสินค้าเป็น float
    $quantity = floatval($_SESSION['hitem'][$h_id]); // แปลงจำนวนสินค้าที่เลือกเป็น float

    // คำนวณผลรวมของแต่ละสินค้าตามจำนวน
    $sum[$h_id] = $price * $quantity;
    $total += $sum[$h_id];
?>
					<li class="header-cart-item flex-w flex-t m-b-12">
						<div class="header-cart-item-img">
                            <img src="images/homestay/<?=$_SESSION['hpicture'][$h_id];?>" alt="<?=$_SESSION['hname'][$h_id];?>">
						</div>

						<div class="header-cart-item-txt p-t-8">
							<a href="homestay_detail.php?hid=<?=$_SESSION['hid'][$h_id];?>" class="header-cart-item-name m-b-18 hov-cl1 trans-04">
								<?=$_SESSION['hname'][$h_id];?>
							</a>

							<span class="header-cart-item-info">
								<?=$_SESSION['hitem'][$h_id];?> x <?=$_SESSION['hprice'][$h_id];?> บาท
							</span>
						</div>
					</li>
<?php 
    } // end foreach 
} else {
?>
		<div>ไม่มีสินค้าในตะกร้า</div>
<?php } // end if ?>
					
				</ul>
				
				<div class="w-full">
					<div class="header-cart-total w-full p-tb-40">
						ยอดรวม: <?=number_format(@$total,0);?> บาท
					</div>

					<div class="header-cart-buttons flex-w w-full">
						<a href="shopping_cart.php" class="flex-c-m stext-101 cl0 size-107 bg3 bor2 hov-btn3 p-lr-15 trans-04 m-r-8 m-b-10">
							View Cart
						</a>

						<a href="shopping_cart.php" class="flex-c-m stext-101 cl0 size-107 bg3 bor2 hov-btn3 p-lr-15 trans-04 m-b-10">
							Check Out
						</a>
					</div>
				</div>
			</div>
		</div>
	</div>


	<!-- breadcrumb -->
	<div class="container">
		<div class="bread-crumb flex-w p-l-25 p-r-15 p-t-30 p-lr-0-lg">
			<a href="index.php" class="stext-109 cl8 hov-cl1 trans-04">
				หน้าหลัก
				<i class="fa fa-angle-right m-l-9 m-r-10" aria-hidden="true"></i>
			</a>

			<a href="homestay.php" class="stext-109 cl8 hov-cl1 trans-04">
				ที่พัก
				<i class="fa fa-angle-right m-l-9 m-r-10" aria-hidden="true"></i>
			</a>

			<a href="#" class="stext-109 cl8 hov-cl1 trans-04">
				<?=$row['hc_name'];?>
				<i class="fa fa-angle-right m-l-9 m-r-10" aria-hidden="true"></i>
			</a>

			<span class="stext-109 cl4">
				<?=$row['h_name'];?>
			</span>
		</div>
	</div>
		

	<!-- Product Detail -->
	<section class="sec-product-detail bg0 p-t-40 p-b-60">
		<div class="container">
			<div class="row">
				<div class="col-md-6 col-lg-7 p-b-30">
					<div class="p-l-25 p-r-30 p-lr-0-lg">
						<div class="wrap-slick3 flex-sb flex-w">
							<div class="wrap-slick3-dots"></div>
							<div class="wrap-slick3-arrows flex-sb-m flex-w"></div>

							<div class="slick3 gallery-lb">
<?php
    $pictures = explode(";", $row['h_pictures']);
    foreach ($pictures as $picture) {
?>
								<div class="item-slick3" data-thumb="images/homestay/<?=$picture;?>">
									<div class="wrap-pic-w pos-relative">
										<img src="images/homestay/<?=$picture;?>" alt="<?=$row['h_name'];?>">

										<a class="flex-c-m size-108 how-pos1 bor0 fs-16 cl10 bg0 hov-btn3 trans-04" href="images/homestay/<?=$picture;?>">
											<i class="fa fa-expand"></i>
										</a>
									</div>
								</div>
<?php } // ปิด foreach ?>

							</div>
						</div>
					</div>
				</div>
					
				<div class="col-md-6 col-lg-5 p-b-30">
					<div class="p-r-50 p-t-5 p-lr-0-lg">
						<h4 class="mtext-105 cl2 js-name-detail p-b-14">
							<?=$row['h_name'];?>
						</h4>

						<span class="mtext-106 cl2">
							ราคา <?=number_format($row['h_price'],0);?> บาท
						</span>

						<p class="stext-102 cl3 p-t-23">
							<?=$row['h_detail'];?>
						</p>
						
							<!--  -->
							<div class="p-t-33">
                                
                                <div class="flex-w flex-r-m p-b-0">
									<div class="size-203 flex-c-m respon6">
										วันเช็คอิน
									</div>

									<div class="size-204">
<div class="wrap-num-product flex-w m-r-20 m-tb-10">
								<input class="cl3 txt-center" type="date" name="datecheckin" id="d_homestay_checkin_<?=$row['homestay_id'];?>" min="<?php echo date('Y-m-d'); ?>" value="<?php echo date('Y-m-d', strtotime('+7 days')); ?>" required>
										</div>
									</div>
								</div>
                                
                                <div class="flex-w flex-r-m p-b-0">
									<div class="size-203 flex-c-m respon6">
										วันเช็คเอาท์
									</div>

									<div class="size-204">
<div class="wrap-num-product flex-w m-r-20 m-tb-10">
								<input class="cl3 txt-center" type="date" name="datecheckout" id="d_homestay_checkout_<?=$row['homestay_id'];?>" min="<?php echo date('Y-m-d'); ?>" value="<?php echo date('Y-m-d', strtotime('+8 days')); ?>" required>
										</div>
									</div>
								</div>
                                
                                
								<div class="flex-w flex-r-m p-b-0">
									<div class="size-203 flex-c-m respon6">
										จำนวนห้อง
									</div>

									<div class="size-204 respon6-next">
<div class="wrap-num-product flex-w m-r-20 m-tb-10">
											<div class="btn-num-product-down cl8 hov-btn3 trans-04 flex-c-m">
												<i class="fs-16 zmdi zmdi-minus"></i>
											</div>

											<input class="mtext-104 cl3 txt-center num-product" type="number" id="q_room_<?=$row['homestay_id'];?>" value="1" min="1" step="1">

											<div class="btn-num-product-up cl8 hov-btn3 trans-04 flex-c-m">
												<i class="fs-16 zmdi zmdi-plus"></i>
											</div>
										</div>
									</div>
								</div>

								<div class="flex-w flex-r-m p-b-10">
									<div class="size-203 flex-c-m respon6">
										จำนวนผู้เข้าพัก
									</div>

									<div class="size-204 respon6-next">
<div class="wrap-num-product flex-w m-r-20 m-tb-10">
											<div class="btn-num-product-down cl8 hov-btn3 trans-04 flex-c-m">
												<i class="fs-16 zmdi zmdi-minus"></i>
											</div>

											<input class="mtext-104 cl3 txt-center num-product" type="number" id="q_person_<?=$row['homestay_id'];?>" value="2" min="1" step="1">

											<div class="btn-num-product-up cl8 hov-btn3 trans-04 flex-c-m">
												<i class="fs-16 zmdi zmdi-plus"></i>
											</div>
										</div>
									</div>
								</div>

								<div class="flex-w flex-r-m p-b-10">
									<div class="size-204 flex-w flex-m respon6-next">
										
										<button class="flex-c-m stext-101 cl0 size-101 bg1 bor1 hov-btn1 p-lr-15 trans-04 js-addcart-detail" onclick="addToCart(<?=$row['homestay_id'];?>, 'd_homestay_checkin_<?=$row['homestay_id'];?>', 'd_homestay_checkout_<?=$row['homestay_id'];?>', 'q_room_<?=$row['homestay_id'];?>', 'q_person_<?=$row['homestay_id'];?>')">
											จอง
										</button>
									</div>
								</div>	
							</div>

						<!--  -->
						<div class="flex-w flex-m p-l-100 p-t-40 respon7">

						</div>
					</div>
				</div>
			</div>

			<div class="bor10 m-t-50 p-t-43 p-b-40">
				<!-- Tab01 -->
				<div class="tab01">
					<!-- Nav tabs -->
					<ul class="nav nav-tabs" role="tablist">
						<li class="nav-item p-b-10">
							<a class="nav-link active" data-toggle="tab" href="#description" role="tab">รายละเอียด</a>
						</li>

						<!--<li class="nav-item p-b-10">
							<a class="nav-link" data-toggle="tab" href="#information" role="tab">Additional information</a>
						</li>-->

					</ul>

					<!-- Tab panes -->
					<div class="tab-content p-t-43">
						<!-- - -->
						<div class="tab-pane fade show active" id="description" role="tabpanel">
							<div class="how-pos2 p-lr-15-md">
								<p class="stext-102 cl6">
									<?=$row['h_detail'];?>
								</p>
							</div>
						</div>

						<!-- - -->
						<div class="tab-pane fade" id="information" role="tabpanel">
							<div class="row">
								<div class="col-sm-10 col-md-8 col-lg-6 m-lr-auto">
									<ul class="p-lr-28 p-lr-15-sm">
										<li class="flex-w flex-t p-b-7">
											<span class="stext-102 cl3 size-205">
												ขนาดห้อง
											</span>

											<span class="stext-102 cl6 size-206">
												36 ตารางเมตร
											</span>
										</li>

										<li class="flex-w flex-t p-b-7">
											<span class="stext-102 cl3 size-205">
												สิ่งอำนวยความสะดวก
											</span>

											<span class="stext-102 cl6 size-206">
												แอร์, ทีวี, ตู้เย็น, ที่เป่าผม
											</span>
										</li>

										<li class="flex-w flex-t p-b-7">
											<span class="stext-102 cl3 size-205">
												ที่จอดรถ
											</span>

											<span class="stext-102 cl6 size-206">
												มี
											</span>
										</li>
									</ul>
								</div>
							</div>
						</div>

					</div>
				</div>
			</div>
		</div>

	</section>


	<!-- Related Products -->
	<section class="sec-relate-product bg0 p-t-45 p-b-105">
		<div class="container">
			<div class="p-b-45">
				<h3 class="ltext-106 cl5 txt-center">
					ที่พักโฮมสเตย์ที่เกี่ยวข้อง<?php  ?>
				</h3>
			</div>

			<!-- Slide2 -->
			<div class="wrap-slick2">
				<div class="slick2">
<?php
$stmt2 = $conn->prepare("SELECT * FROM `homestays` ORDER BY RAND() LIMIT 6;");
$stmt2->execute();
$result2 = $stmt2->get_result();
while ($row2 = $result2->fetch_assoc()) {
    $pic = explode(";",$row2['h_pictures']);
?>
                                        
					<div class="item-slick2 p-l-15 p-r-15 p-t-15 p-b-15">
						<!-- Block2 -->
						<div class="block2">
							<div class="block2-pic hov-img0">
								<img src="images/homestay/<?=$pic[0];?>" alt="<?=$row2['h_name'];?>">

								<a href="#" class="block2-btn flex-c-m stext-103 cl2 size-102 bg0 bor2 hov-btn1 p-lr-15 trans-04 js-show-modal1" data-target="#md<?=$row2['homestay_id'];?>">
									Quick View
								</a>
							</div>

							<div class="block2-txt flex-w flex-t p-t-14">
								<div class="block2-txt-child1 flex-col-l ">
									<a href="homestay_detail.php?hid=<?=$row2['homestay_id'];?>" class="stext-104 cl4 hov-cl1 trans-04 js-name-b2 p-b-6">
										<?=$row2['h_name'];?>
									</a>

									<span class="stext-105 cl3">
										ราคา <?=number_format($row2['h_price'],0);?> บาท
									</span>

								</div>

								<div class="block2-txt-child2 flex-r p-t-3">
									<a href="#" class="btn-addwish-b2 dis-block pos-relative js-addwish-b2">
										<img class="icon-heart1 dis-block trans-04" src="images/icons/icon-heart-01.png" alt="ICON">
										<img class="icon-heart2 dis-block trans-04 ab-t-l" src="images/icons/icon-heart-02.png" alt="ICON">
									</a>
								</div>
							</div>
						</div>
					</div>
<?php } ?>

				</div>
			</div>
		</div>
	</section>
		
<?php include("footer.php"); ?>
    
	<!-- Back to top -->
	<div class="btn-back-to-top" id="myBtn">
		<span class="symbol-btn-back-to-top">
			<i class="zmdi zmdi-chevron-up"></i>
		</span>
	</div>

<?php
$stmt3 = $conn->prepare("SELECT * FROM `homestays` ");
$stmt3->execute();
$result3 = $stmt3->get_result();
while ($row3 = $result3->fetch_assoc()) {
?>
	<!-- Modal1 -->
	<div class="wrap-modal1 js-modal1 p-t-60 p-b-20" id="md<?=$row3['homestay_id'];?>">
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
<?php
    $pictures = explode(";", $row3['h_pictures']);
    foreach ($pictures as $picture) {
?>                                    
								<div class="item-slick3" data-thumb="images/homestay/<?=$picture;?>">
									<div class="wrap-pic-w pos-relative">
										<img src="images/homestay/<?=$picture;?>" alt="<?=$row3['h_name'];?>">

										<a class="flex-c-m size-108 how-pos1 bor0 fs-16 cl10 bg0 hov-btn3 trans-04" href="images/homestay/<?=$picture;?>">
											<i class="fa fa-expand"></i>
										</a>
									</div>
								</div>
<?php } ?>
                                    
								</div>
							</div>
						</div>
					</div>
					
					<div class="col-md-6 col-lg-5 p-b-30">
						<div class="p-r-50 p-t-5 p-lr-0-lg">
							<h4 class="mtext-105 cl2 js-name-detail p-b-14">
								<?=$row3['h_name'];?>
							</h4>

							<span class="mtext-106 cl2">
								ราคา <?=number_format($row3['h_price'],0);?> บาท
							</span>

							<p class="stext-102 cl3 p-t-23">
								<?=$row3['h_detail'];?>
							</p>
							
							<!--  -->
							<div class="p-t-33">

								<div class="flex-w flex-r-m p-b-10">
									<div class="size-204 flex-w flex-m respon6-next">

										<a href="homestay_detail.php?hid=<?=$row3['homestay_id'];?>"class="flex-c-m stext-101 cl0 size-101 bg1 bor1 hov-btn1 p-lr-15 trans-04">
											รายละเอียด
										</a>
									</div>
								</div>	
							</div>

							<!--  -->
							<div class="flex-w flex-m p-l-100 p-t-40 respon7">
								<div class="flex-m bor9 p-r-10 m-r-11">
									<a href="#" class="fs-14 cl3 hov-cl1 trans-04 lh-10 p-lr-5 p-tb-2 js-addwish-detail tooltip100" data-tooltip="Add to Wishlist">
										<i class="zmdi zmdi-favorite"></i>
									</a>
								</div>

								<a href="#" class="fs-14 cl3 hov-cl1 trans-04 lh-10 p-lr-5 p-tb-2 m-r-8 tooltip100" data-tooltip="Facebook">
									<i class="fa fa-facebook"></i>
								</a>

								<a href="#" class="fs-14 cl3 hov-cl1 trans-04 lh-10 p-lr-5 p-tb-2 m-r-8 tooltip100" data-tooltip="Twitter">
									<i class="fa fa-twitter"></i>
								</a>

								<a href="#" class="fs-14 cl3 hov-cl1 trans-04 lh-10 p-lr-5 p-tb-2 m-r-8 tooltip100" data-tooltip="Google Plus">
									<i class="fa fa-google-plus"></i>
								</a>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
<?php } ?>
    
<!--===============================================================================================-->	
	<script src="vendor/jquery/jquery-3.2.1.min.js"></script>
<!--===============================================================================================-->
	<script src="vendor/animsition/js/animsition.min.js"></script>
<!--===============================================================================================-->
	<script src="vendor/bootstrap/js/popper.js"></script>
	<script src="vendor/bootstrap/js/bootstrap.min.js"></script>
<!--===============================================================================================-->
	<script src="vendor/select2/select2.min.js"></script>
	<script>
		$(".js-select2").each(function(){
			$(this).select2({
				minimumResultsForSearch: 20,
				dropdownParent: $(this).next('.dropDownSelect2')
			});
		})
	</script>
<!--===============================================================================================-->
	<script src="vendor/daterangepicker/moment.min.js"></script>
	<script src="vendor/daterangepicker/daterangepicker.js"></script>
<!--===============================================================================================-->
	<script src="vendor/slick/slick.min.js"></script>
	<script src="js/slick-custom.js"></script>
<!--===============================================================================================-->
	<script src="vendor/parallax100/parallax100.js"></script>
	<script>
        $('.parallax100').parallax100();
	</script>
<!--===============================================================================================-->
	<script src="vendor/MagnificPopup/jquery.magnific-popup.min.js"></script>
	<script>
		$('.gallery-lb').each(function() { // the containers for all your galleries
			$(this).magnificPopup({
		        delegate: 'a', // the selector for gallery item
		        type: 'image',
		        gallery: {
		        	enabled:true
		        },
		        mainClass: 'mfp-fade'
		    });
		});
	</script>
<!--===============================================================================================-->
	<script src="vendor/isotope/isotope.pkgd.min.js"></script>
<!--===============================================================================================-->
	<script src="vendor/sweetalert/sweetalert.min.js"></script>
	<script>
		$('.js-addwish-b2, .js-addwish-detail').on('click', function(e){
			e.preventDefault();
		});

		$('.js-addwish-b2').each(function(){
			var nameProduct = $(this).parent().parent().find('.js-name-b2').html();
			$(this).on('click', function(){
				swal(nameProduct, "is added to wishlist !", "success");

				$(this).addClass('js-addedwish-b2');
				$(this).off('click');
			});
		});

		$('.js-addwish-detail').each(function(){
			var nameProduct = $(this).parent().parent().parent().find('.js-name-detail').html();

			$(this).on('click', function(){
				swal(nameProduct, "is added to wishlist !", "success");

				$(this).addClass('js-addedwish-detail');
				$(this).off('click');
			});
		});

		/*---------------------------------------------*/

		$('.js-addcart-detail').each(function(){
			var nameProduct = $(this).parent().parent().parent().parent().find('.js-name-detail').html();
			$(this).on('click', function(){
				swal(nameProduct, "is added to cart !", "success");
			});
		});
	
	</script>
<!--===============================================================================================-->
	<script src="vendor/perfect-scrollbar/perfect-scrollbar.min.js"></script>
	<script>
		$('.js-pscroll').each(function(){
			$(this).css('position','relative');
			$(this).css('overflow','hidden');
			var ps = new PerfectScrollbar(this, {
				wheelSpeed: 1,
				scrollingThreshold: 1000,
				wheelPropagation: false,
			});

			$(window).on('resize', function(){
				ps.update();
			})
		});
	</script>
<!--===============================================================================================-->
	<script src="js/main.js"></script>

<script>
// ฟังก์ชันสำหรับส่งข้อมูลไปยัง PHP ผ่าน AJAX
function addToCart(homestay_id, cin, cout, qrm, qps) {
    // ดึงค่าจาก input ผ่าน id ที่ถูกส่งมา
    let chkin = document.getElementById(cin).value;
    let chkout = document.getElementById(cout).value;
    let qroom = document.getElementById(qrm).value;
    let qperson = document.getElementById(qps).value;
    
    // ตรวจสอบค่าที่จะส่งไปยัง PHP
    console.log("Homestay ID:", homestay_id);
    console.log("chkin:", chkin);
    console.log("chkout:", chkout);
    console.log("qroom:", qroom);
    console.log("qperson:", qperson);

    // ใช้ AJAX เพื่อส่งข้อมูลไปยัง PHP โดยไม่ต้องรีเฟรชหน้า
    var xhr = new XMLHttpRequest();
    xhr.open("POST", "", true); // ส่งข้อมูลไปยังหน้าเดียวกัน
    xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
    xhr.onreadystatechange = function () {
        if (xhr.readyState === 4 && xhr.status === 200) {
            // แสดงข้อความยืนยันเมื่อสินค้าถูกเพิ่มลงตะกร้า
            //alert(xhr.responseText);

            // ตรวจสอบ session ในเบราว์เซอร์ (คุณสามารถเปิด Developer Console เพื่อตรวจสอบ)
            //console.log("Session response:", xhr.responseText);
        }
    };
    // ส่งข้อมูล POST ไปที่ PHP
    xhr.send("hid=" + homestay_id + "&chkin=" + chkin + "&chkout=" + chkout + "&qroom=" + qroom + "&qperson=" + qperson);
}
</script>
    
<script>
// ฟังก์ชันสำหรับส่งข้อมูลไปยัง PHP ผ่าน AJAX
function addToCart2(product_id, input_id2) {
    // ดึงค่าจาก input ผ่าน id ที่ถูกส่งมา
    let quantity = document.getElementById(input_id2).value;
    
    // ตรวจสอบค่าที่จะส่งไปยัง PHP
    //console.log("Product ID:", product_id);
    //console.log("Quantity:", quantity);

    // ใช้ AJAX เพื่อส่งข้อมูลไปยัง PHP โดยไม่ต้องรีเฟรชหน้า
    var xhr = new XMLHttpRequest();
    xhr.open("POST", "", true); // ส่งข้อมูลไปยังหน้าเดียวกัน
    xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
    xhr.onreadystatechange = function () {
        if (xhr.readyState === 4 && xhr.status === 200) {
            // แสดงข้อความยืนยันเมื่อสินค้าถูกเพิ่มลงตะกร้า
            //alert(xhr.responseText);

            // ตรวจสอบ session ในเบราว์เซอร์ (คุณสามารถเปิด Developer Console เพื่อตรวจสอบ)
            //console.log("Session response:", xhr.responseText);
        }
    };
    // ส่งข้อมูล POST ไปที่ PHP
    xhr.send("hid=" + product_id + "&q=" + quantity);
}
</script>
</body>
</html>