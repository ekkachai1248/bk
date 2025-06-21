<?php
// เปิด session และเชื่อมต่อฐานข้อมูล
error_reporting(E_NOTICE);
session_start();
include_once("connectdb.php");

// เมื่อมีการส่งข้อมูล POST เข้ามา
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $tid = $_POST['tid']; // รับค่ารหัสสินค้า
    $q = $_POST['q'];     // รับค่าจำนวนสินค้า
    $d = $_POST['d'];     // รับค่าวันที่จอง
    $r = $_POST['r'];     // รับค่ารอบ
    
    //var_dump($tid);

    // ดึงข้อมูลสินค้าจากฐานข้อมูลตามรหัสสินค้า
    $sql = "SELECT * FROM tours WHERE tour_id='{$tid}'"; 
    $rs = mysqli_query($conn, $sql);
    $data = mysqli_fetch_array($rs);

    // แยกรูปภาพของสินค้าออกจากกัน
    $pic = explode(";", $data['t_pictures']);

    // สร้าง session สำหรับเก็บข้อมูล
    if (isset($tid)) {
        $_SESSION['tid'][$tid] = $data['tour_id'];
        $_SESSION['tname'][$tid] = $data['name'];
        $_SESSION['tprice'][$tid] = $data['price'];
        $_SESSION['tpicture'][$tid] = $pic[0];
        $_SESSION['titem'][$tid] = $q; 
        $_SESSION['tdate'][$tid] = $d; 
        $_SESSION['tround'][$tid] = $r; 
    }

    // ส่งข้อความยืนยันกลับไปยัง JavaScript
    //echo "สินค้าถูกเพิ่มลงในตะกร้าเรียบร้อยแล้ว!";
    exit; // หยุดการทำงาน PHP หลังจากส่งข้อมูลกลับ
}
?>


<?php
include_once("connectdb.php");

$tid = isset($_GET['tid']) ? (int)$_GET['tid'] : 0;
$stmt = $conn->prepare("SELECT * FROM tours AS t INNER JOIN tour_category AS tc ON t.tc_id=tc.tc_id  WHERE t.tour_id = ?");
$stmt->bind_param("i", $tid);
$stmt->execute();
$result = $stmt->get_result();
$row = $result->fetch_assoc();
$stmt->close();
//$conn->close();
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<title>Tour Detail</title>
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

if(!empty($_SESSION['tid'])) {
    $total = 0;
	foreach($_SESSION['tid'] as $t_id) {
    // แปลงค่า price และ item ให้เป็น float ก่อนคูณ
    $price = floatval($_SESSION['price'][$t_id]); // แปลงราคาสินค้าเป็น float
    $quantity = floatval($_SESSION['titem'][$t_id]); // แปลงจำนวนสินค้าที่เลือกเป็น float

    // คำนวณผลรวมของแต่ละสินค้าตามจำนวน
    $sum[$t_id] = $price * $quantity;
    $total += $sum[$t_id];
?>
					<li class="header-cart-item flex-w flex-t m-b-12">
						<div class="header-cart-item-img">
                            <img src="images/tours/<?=$_SESSION['tpicture'][$t_id];?>" alt="<?=$_SESSION['tname'][$t_id];?>">
						</div>

						<div class="header-cart-item-txt p-t-8">
							<a href="tour_detail.php?tid=<?=$_SESSION['tid'][$t_id];?>" class="header-cart-item-name m-b-18 hov-cl1 trans-04">
								<?=$_SESSION['tname'][$t_id];?>
							</a>

							<span class="header-cart-item-info">
								<?=$_SESSION['titem'][$t_id];?> x <?=$_SESSION['tprice'][$t_id];?> บาท
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

			<a href="tours.php" class="stext-109 cl8 hov-cl1 trans-04">
				ท่องเที่ยว
				<i class="fa fa-angle-right m-l-9 m-r-10" aria-hidden="true"></i>
			</a>

			<a href="#" class="stext-109 cl8 hov-cl1 trans-04">
				<?=$row['tc_name'];?>
				<i class="fa fa-angle-right m-l-9 m-r-10" aria-hidden="true"></i>
			</a>

			<span class="stext-109 cl4">
				<?=$row['name'];?>
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
    $pictures = explode(";", $row['t_pictures']);
    foreach ($pictures as $picture) {
?>
								<div class="item-slick3" data-thumb="images/tours/<?=$picture;?>">
									<div class="wrap-pic-w pos-relative">
										<img src="images/tours/<?=$picture;?>" alt="<?=$row['t_name'];?>">

										<a class="flex-c-m size-108 how-pos1 bor0 fs-16 cl10 bg0 hov-btn3 trans-04" href="images/tours/<?=$picture;?>">
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
							<?=$row['name'];?>
						</h4>

						<span class="mtext-106 cl2">
							ราคา <?=number_format($row['price'],0);?> บาท
						</span>

						<p class="stext-102 cl3 p-t-23">
							<?=$row['description'];?>
						</p>
						
							<!--  -->
							<div class="p-t-33">
								<div class="flex-w flex-r-m p-b-5">
									<div class="size-203 flex-c-m respon6">
										จำนวนคน
									</div>

									<div class="size-204 respon6-next">
<div class="wrap-num-product flex-w m-r-20 m-tb-10">
											<div class="btn-num-product-down cl8 hov-btn3 trans-04 flex-c-m">
												<i class="fs-16 zmdi zmdi-minus"></i>
											</div>

											<input class="mtext-104 cl3 txt-center num-product" type="number" name="num-tour" id="q_tour_<?=$row['tour_id'];?>" value="1" min="1" step="1">

											<div class="btn-num-product-up cl8 hov-btn3 trans-04 flex-c-m">
												<i class="fs-16 zmdi zmdi-plus"></i>
											</div>
										</div>
									</div>
								</div>

								<div class="flex-w flex-r-m p-b-5">
									<div class="size-203 flex-c-m respon6">
										วันที่
									</div>

									<div class="size-204">
<div class="wrap-num-product flex-w m-r-20 m-tb-10">
								<input class="cl3 txt-center" type="date" name="datereserve" id="d_tour_<?=$row['tour_id'];?>" min="<?php echo date('Y-m-d'); ?>" value="<?php echo date('Y-m-d', strtotime('+7 days')); ?>" required>
										</div>
									</div>
								</div>

								<div class="flex-w flex-r-m p-b-10">
									<div class="size-203 flex-c-m respon6">
										รอบ
									</div>

									<div class="size-204">
                                        <div class="wrap-num-product flex-w m-r-20 m-tb-10" style="width: 170px;">
                                        <select id="r_tour_<?=$row['tour_id'];?>" style="border-color: #EFEFEF; color: #555555">
                                            <option value="Morning trip">เช้า (09.00 - 12.00 น.)</option>
                                            <option value="Afternoon trip">บ่าย (13.00 - 16.00 น.)</option>
                                        </select>
										</div>
									</div>
								</div>

								<div class="flex-w flex-r-m p-b-0">
									<div class="size-204 flex-w flex-m respon6-next">
										
										<button class="flex-c-m stext-101 cl0 size-101 bg1 bor1 hov-btn1 p-lr-15 trans-04 js-addcart-detail" onclick="addToCart(<?=$row['tour_id'];?>, 'q_tour_<?=$row['tour_id'];?>', 'd_tour_<?=$row['tour_id'];?>', 'r_tour_<?=$row['tour_id'];?>')">
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
									<?=$row['description'];?>
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
												Weight
											</span>

											<span class="stext-102 cl6 size-206">
												0.79 kg
											</span>
										</li>

										<li class="flex-w flex-t p-b-7">
											<span class="stext-102 cl3 size-205">
												Dimensions
											</span>

											<span class="stext-102 cl6 size-206">
												110 x 33 x 100 cm
											</span>
										</li>

										<li class="flex-w flex-t p-b-7">
											<span class="stext-102 cl3 size-205">
												Materials
											</span>

											<span class="stext-102 cl6 size-206">
												60% cotton
											</span>
										</li>

										<li class="flex-w flex-t p-b-7">
											<span class="stext-102 cl3 size-205">
												Color
											</span>

											<span class="stext-102 cl6 size-206">
												Black, Blue, Grey, Green, Red, White
											</span>
										</li>

										<li class="flex-w flex-t p-b-7">
											<span class="stext-102 cl3 size-205">
												Size
											</span>

											<span class="stext-102 cl6 size-206">
												XL, L, M, S
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
				<h4 class="ltext-106 cl5 txt-center">
					ทริปท่องเที่ยวที่เกี่ยวข้อง<?php  ?>
				</h4>
			</div>

			<!-- Slide2 -->
			<div class="wrap-slick2">
				<div class="slick2">
<?php
$stmt2 = $conn->prepare("SELECT * FROM `tours` ORDER BY RAND() LIMIT 8;");
$stmt2->execute();
$result2 = $stmt2->get_result();
while ($row2 = $result2->fetch_assoc()) {
    $pic = explode(";",$row2['t_pictures']);
?>
                                        
					<div class="item-slick2 p-l-15 p-r-15 p-t-15 p-b-15">
						<!-- Block2 -->
						<div class="block2">
							<div class="block2-pic hov-img0">
								<img src="images/tours/<?=$pic[0];?>" alt="<?=$row2['name'];?>">

								<a href="#" class="block2-btn flex-c-m stext-103 cl2 size-102 bg0 bor2 hov-btn1 p-lr-15 trans-04 js-show-modal1" data-target="#md<?=$row2['tour_id'];?>">
									Quick View
								</a>
							</div>

							<div class="block2-txt flex-w flex-t p-t-14">
								<div class="block2-txt-child1 flex-col-l ">
									<a href="tour_detail.php?tid=<?=$row2['tour_id'];?>" class="stext-104 cl4 hov-cl1 trans-04 js-name-b2 p-b-6">
										<?=$row2['name'];?>
									</a>

									<span class="stext-105 cl3">
										จำนวน <?=number_format($row2['hours'],0);?> ชั่วโมง
									</span>

									<span class="stext-105 cl3">
										ราคา <?=number_format($row2['price'],0);?> บาท
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
$stmt3 = $conn->prepare("SELECT * FROM `tours` ");
$stmt3->execute();
$result3 = $stmt3->get_result();
while ($row3 = $result3->fetch_assoc()) {
?>
	<!-- Modal1 -->
	<div class="wrap-modal1 js-modal1 p-t-60 p-b-20" id="md<?=$row3['tour_id'];?>">
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
    $pictures = explode(";", $row3['t_pictures']);
    foreach ($pictures as $picture) {
?>                                    
								<div class="item-slick3" data-thumb="images/tours/<?=$picture;?>">
									<div class="wrap-pic-w pos-relative">
										<img src="images/tours/<?=$picture;?>" alt="<?=$row3['name'];?>">

										<a class="flex-c-m size-108 how-pos1 bor0 fs-16 cl10 bg0 hov-btn3 trans-04" href="images/tours/<?=$picture;?>">
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
								<?=$row3['name'];?>
							</h4>

							<span class="stext-102 cl2">
								จำนวน <?=number_format($row3['hours'],0);?> ชั่วโมง
							</span><br>

							<span class="mtext-106 cl2">
								ราคา <?=number_format($row3['price'],0);?> บาท
							</span>

							<p class="stext-102 cl3 p-t-23">
								<?=$row3['description'];?>
							</p>
							
							<!--  -->
							<div class="p-t-33">


								<div class="flex-w flex-r-m p-b-0">
									<div class="size-204 flex-w flex-m respon6-next">
										
										<a href="tour_detail.php?tid=<?=$row3['tour_id'];?>" class="flex-c-m stext-101 cl0 size-101 bg1 bor1 hov-btn1 p-lr-15 trans-04">
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
function addToCart(product_id, q, d, r) {
    // ดึงค่าจาก input ผ่าน id ที่ถูกส่งมา
    let quantity = document.getElementById(q).value;
    let datereserve = document.getElementById(d).value;
    let roundtour = document.getElementById(r).value;
    
    // ตรวจสอบค่าที่จะส่งไปยัง PHP
    //console.log("Product ID:", product_id);
    //console.log("Quantity:", quantity);
    //console.log("datereserve:", datereserve);
    //console.log("roundtour:", roundtour);

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
    xhr.send("tid=" + product_id + "&q=" + quantity + "&d=" + datereserve + "&r=" + roundtour);
}
</script>
    
<script>
// ฟังก์ชันสำหรับส่งข้อมูลไปยัง PHP ผ่าน AJAX
function addToCart2(product_id, q2, d2, r2) {
    // ดึงค่าจาก input ผ่าน id ที่ถูกส่งมา
    let quantity = document.getElementById(q2).value;
    let datereserve = document.getElementById(d2).value;
    let roundtour = document.getElementById(r2).value;
    
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
    xhr.send("tid=" + product_id + "&q=" + quantity + "&d=" + datereserve + "&r=" + roundtour);
}
</script>
</body>
</html>