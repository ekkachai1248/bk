<?php
// เปิด session และเชื่อมต่อฐานข้อมูล
error_reporting(E_NOTICE);
session_start();
include_once("connectdb.php");

// เมื่อมีการส่งข้อมูล POST เข้ามา
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $pid = $_POST['pid']; // รับค่ารหัสสินค้า
    $q = $_POST['q'];     // รับค่าจำนวนสินค้า
    
    //var_dump($pid);

    // ดึงข้อมูลสินค้าจากฐานข้อมูลตามรหัสสินค้า
    $sql = "SELECT * FROM products WHERE p_id='{$pid}'"; 
    $rs = mysqli_query($conn, $sql);
    $data = mysqli_fetch_array($rs);

    // แยกรูปภาพของสินค้าออกจากกัน
    $pic = explode(";", $data['p_pictures']);

    // สร้าง session สำหรับเก็บข้อมูลสินค้า
    if (isset($pid)) {
        $_SESSION['pid'][$pid] = $data['p_id'];
        $_SESSION['pname'][$pid] = $data['p_name'];
        $_SESSION['pprice'][$pid] = $data['p_price'];
        $_SESSION['ppicture'][$pid] = $pic[0];
        $_SESSION['pitem'][$pid] = $q; 
    }

    // ส่งข้อความยืนยันกลับไปยัง JavaScript
    //echo "สินค้าถูกเพิ่มลงในตะกร้าเรียบร้อยแล้ว!";
    exit; // หยุดการทำงาน PHP หลังจากส่งข้อมูลกลับ
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<title>Local Buengkan - Home</title>
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
	
	<!-- Header -->
	<header class="header-v3">
		<!-- Header desktop -->
		<div class="container-menu-desktop trans-03">
			<div class="wrap-menu-desktop">
				<nav class="limiter-menu-desktop p-l-45">
					
					<!-- Logo desktop -->		
					<a href="index.php" class="logo" style="color: white">
						<h3><strong>Local Buengkan</strong></h3>
					</a>

					<!-- Menu desktop -->
					<div class="menu-desktop">
						<ul class="main-menu">
							<li>
								<a href="index.php">หน้าหลัก</a>
							</li>

							<li class="label1" data-label1="hot">
								<a href="foods.php">อาหาร</a>
							</li>

							<li>
								<a href="homestay.php">ที่พัก</a>
							</li>

							<li class="label1" data-label1="hot">
								<a href="products.php">สินค้าและของฝาก</a>
							</li>

							<li>
								<a href="tours.php">ท่องเที่ยว</a>
							</li>

							<li>
								<a href="plans.php">วางแผนกินเที่ยว</a>
							</li>

							<li>
								<a href="contact.php">ติดต่อเรา</a>
							</li>
                            
							<li>
								<?php if(empty($_SESSION['user_id'])){ ?>
                                    <a href="sign-in.php">เข้าสู่ระบบ</a>
                                <?php } else { ?>
                                    <a href="sign-out.php">ออกจากระบบ</a>
                                <?php } ?>
							</li>
						</ul>
					</div>	

					<!-- Icon header -->
					<div class="wrap-icon-header flex-w flex-r-m h-full">							
						<div class="flex-c-m h-full p-r-25 bor6">
							<!--<div class="icon-header-item cl0 hov-cl1 trans-04 p-lr-11 js-show-cart">
								<i class="zmdi zmdi-shopping-cart"></i>
							</div>-->
							<a href="shopping_cart.php" class="icon-header-item cl0 hov-cl1 trans-04 p-lr-11">
								<i class="zmdi zmdi-shopping-cart"></i>
							</a>
						</div>
							
						<div class="flex-c-m h-full p-lr-19">
							<div class="icon-header-item cl0 hov-cl1 trans-04 p-lr-11 js-show-sidebar">
								<i class="zmdi zmdi-menu"></i>
							</div>
						</div>
					</div>
				</nav>
			</div>	
		</div>

        
		<!-- Modal Search -->
		<div class="modal-search-header flex-c-m trans-04 js-hide-modal-search">
			<button class="flex-c-m btn-hide-modal-search trans-04">
				<i class="zmdi zmdi-close"></i>
			</button>

			<form class="container-search-header">
				<div class="wrap-search-header">
					<input class="plh0" type="text" name="search" placeholder="Search...">

					<button class="flex-c-m trans-04">
						<i class="zmdi zmdi-search"></i>
					</button>
				</div>
			</form>
		</div>
	</header>


	<!-- Sidebar -->
	<aside class="wrap-sidebar js-sidebar">
		<div class="s-full js-hide-sidebar"></div>

		<div class="sidebar flex-col-l p-t-22 p-b-25">
			<div class="flex-r w-full p-b-30 p-r-27">
				<div class="fs-35 lh-10 cl2 p-lr-5 pointer hov-cl1 trans-04 js-hide-sidebar">
					<i class="zmdi zmdi-close"></i>
				</div>
			</div>

			<div class="sidebar-content flex-w w-full p-lr-65 js-pscroll">
				<ul class="sidebar-link w-full">
					<li class="p-b-10">
						<a href="index.php" class="stext-102 cl2 hov-cl1 trans-04">
							หน้าหลัก
						</a>
					</li>
                    
							<li class="p-b-10" data-label1="hot">
								<a href="foods.php" class="stext-102 cl2 hov-cl1 trans-04">อาหาร</a>
							</li>

							<li class="p-b-10">
								<a href="homestay.php" class="stext-102 cl2 hov-cl1 trans-04">ที่พัก</a>
							</li>

							<li class="p-b-10" data-label1="hot">
								<a href="products.php" class="stext-102 cl2 hov-cl1 trans-04">สินค้าและของฝาก</a>
							</li>

							<li class="p-b-10">
								<a href="tours.php" class="stext-102 cl2 hov-cl1 trans-04">ท่องเที่ยว</a>
							</li>

							<li class="p-b-10">
								<a href="plans.php" class="stext-102 cl2 hov-cl1 trans-04">วางแผนกินเที่ยว</a>
							</li>

							<li class="p-b-10">
								<a href="contact.php" class="stext-102 cl2 hov-cl1 trans-04">ติดต่อเรา</a>
							</li>
                    <hr>
                        
								<?php if(empty($_SESSION['user_id'])){ ?>
                    <li class="p-b-10">
						<a href="sign-in.php" class="stext-102 cl2 hov-cl1 trans-04">
							เข้าสู่ระบบ
						</a>
                    </li>
                                <?php } else { ?>
					<li class="p-b-10">
						<a href="transactions.php" class="stext-102 cl2 hov-cl1 trans-04 text-primary">
							<strong>รายการสั่งซื้อ</strong>
						</a>
					</li>
					<li class="p-b-10">
						<a href="myaccount.php" class="stext-102 cl2 hov-cl1 trans-04 text-primary">
							<strong>บัญชีของฉัน</strong>
						</a>
					</li>
                    <li class="p-b-10">    
						<a href="sign-out.php" class="stext-102 cl2 hov-cl1 trans-04">
							ออกจากระบบ
						</a>
                    </li>
                                <?php } ?>

				</ul>

				<div class="sidebar-gallery w-full p-tb-30">
					<span class="mtext-101 cl5">
						@ Local Buengkan
					</span>

					<div class="flex-w flex-sb p-t-36 gallery-lb">
						<!-- item gallery sidebar -->
						<div class="wrap-item-gallery m-b-10">
							<a class="item-gallery bg-img1" href="images/gallery-01.jpg" data-lightbox="gallery" 
							style="background-image: url('images/gallery-01.jpg');"></a>
						</div>

						<!-- item gallery sidebar -->
						<div class="wrap-item-gallery m-b-10">
							<a class="item-gallery bg-img1" href="images/gallery-02.jpg" data-lightbox="gallery" 
							style="background-image: url('images/gallery-02.jpg');"></a>
						</div>

						<!-- item gallery sidebar -->
						<div class="wrap-item-gallery m-b-10">
							<a class="item-gallery bg-img1" href="images/gallery-03.jpg" data-lightbox="gallery" 
							style="background-image: url('images/gallery-03.jpg');"></a>
						</div>

						<!-- item gallery sidebar -->
						<div class="wrap-item-gallery m-b-10">
							<a class="item-gallery bg-img1" href="images/gallery-04.jpg" data-lightbox="gallery" 
							style="background-image: url('images/gallery-04.jpg');"></a>
						</div>

						<!-- item gallery sidebar -->
						<div class="wrap-item-gallery m-b-10">
							<a class="item-gallery bg-img1" href="images/gallery-05.jpg" data-lightbox="gallery" 
							style="background-image: url('images/gallery-05.jpg');"></a>
						</div>

						<!-- item gallery sidebar -->
						<div class="wrap-item-gallery m-b-10">
							<a class="item-gallery bg-img1" href="images/gallery-06.jpg" data-lightbox="gallery" 
							style="background-image: url('images/gallery-06.jpg');"></a>
						</div>

						<!-- item gallery sidebar -->
						<div class="wrap-item-gallery m-b-10">
							<a class="item-gallery bg-img1" href="images/gallery-07.jpg" data-lightbox="gallery" 
							style="background-image: url('images/gallery-07.jpg');"></a>
						</div>

						<!-- item gallery sidebar -->
						<div class="wrap-item-gallery m-b-10">
							<a class="item-gallery bg-img1" href="images/gallery-08.jpg" data-lightbox="gallery" 
							style="background-image: url('images/gallery-08.jpg');"></a>
						</div>

						<!-- item gallery sidebar -->
						<div class="wrap-item-gallery m-b-10">
							<a class="item-gallery bg-img1" href="images/gallery-09.jpg" data-lightbox="gallery" 
							style="background-image: url('images/gallery-09.jpg');"></a>
						</div>
					</div>
				</div>

				<div class="sidebar-gallery w-full">
					<span class="mtext-101 cl5">
						About Us
					</span>

					<p class="stext-108 cl6 p-t-27">
						Local Buengkan 
					</p>
				</div>
			</div>
		</div>
	</aside>


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

if(!empty($_SESSION['pid'])) {
    $total = 0;
	foreach($_SESSION['pid'] as $p_id) {
    // แปลงค่า price และ item ให้เป็น float ก่อนคูณ
    $price = floatval($_SESSION['pprice'][$p_id]); // แปลงราคาสินค้าเป็น float
    $quantity = floatval($_SESSION['pitem'][$p_id]); // แปลงจำนวนสินค้าที่เลือกเป็น float

    // คำนวณผลรวมของแต่ละสินค้าตามจำนวน
    $sum[$p_id] = $price * $quantity;
    $total += $sum[$p_id];
?>
					<li class="header-cart-item flex-w flex-t m-b-12">
						<div class="header-cart-item-img">
                            <img src="images/products/<?=$_SESSION['ppicture'][$p_id];?>" alt="<?=$_SESSION['pname'][$p_id];?>">
						</div>

						<div class="header-cart-item-txt p-t-8">
							<a href="product_detail.php?pid=<?=$_SESSION['pid'][$p_id];?>" class="header-cart-item-name m-b-18 hov-cl1 trans-04">
								<?=$_SESSION['pname'][$p_id];?>
							</a>

							<span class="header-cart-item-info">
								<?=$_SESSION['pitem'][$p_id];?> x <?=$_SESSION['pprice'][$p_id];?> บาท
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



	<!-- Slider -->
	<section class="section-slide">
		<div class="wrap-slick1 rs2-slick1">
			<div class="slick1">
				<div class="item-slick1 bg-overlay1" style="background-image: url(images/slide-05.jpg);" data-thumb="images/thumb-01.jpg" data-caption="สินค้าและของฝาก">
					<div class="container h-full">
						<div class="flex-col-c-m h-full p-t-100 p-b-60 respon5">
							<div class="layer-slick1 animated visible-false" data-appear="fadeInDown" data-delay="0">
								<span class="ltext-202 txt-center cl0 respon2">
									Local Buengkan
								</span>
							</div>
								
							<div class="layer-slick1 animated visible-false" data-appear="fadeInUp" data-delay="800">
								<h2 class="ltext-104 txt-center cl0 p-t-22 p-b-40 respon1">
									สินค้าและของฝาก
								</h2>
							</div>
								
							<div class="layer-slick1 animated visible-false" data-appear="zoomIn" data-delay="1600">
								<a href="products.php" class="flex-c-m stext-101 cl0 size-101 bg1 bor1 hov-btn2 p-lr-15 trans-04">
									รายละเอียด
								</a>
							</div>
						</div>
					</div>
				</div>

				<div class="item-slick1 bg-overlay1" style="background-image: url(images/slide-06.jpg);" data-thumb="images/thumb-02.jpg" data-caption="ท่องเที่ยว">
					<div class="container h-full">
						<div class="flex-col-c-m h-full p-t-100 p-b-60 respon5">
							<div class="layer-slick1 animated visible-false" data-appear="rollIn" data-delay="0">
								<span class="ltext-202 txt-center cl0 respon2">
									Local Buengkan
								</span>
							</div>
								
							<div class="layer-slick1 animated visible-false" data-appear="lightSpeedIn" data-delay="800">
								<h2 class="ltext-104 txt-center cl0 p-t-22 p-b-40 respon1">
									ท่องเที่ยว
								</h2>
							</div>
								
							<div class="layer-slick1 animated visible-false" data-appear="slideInUp" data-delay="1600">
								<a href="tours.php" class="flex-c-m stext-101 cl0 size-101 bg1 bor1 hov-btn2 p-lr-15 trans-04">
									รายละเอียด
								</a>
							</div>
						</div>
					</div>
				</div>

				<div class="item-slick1 bg-overlay1" style="background-image: url(images/slide-07.jpg);" data-thumb="images/thumb-03.jpg" data-caption="อาหาร">
					<div class="container h-full">
						<div class="flex-col-c-m h-full p-t-100 p-b-60 respon5">
							<div class="layer-slick1 animated visible-false" data-appear="rotateInDownLeft" data-delay="0">
								<span class="ltext-202 txt-center cl0 respon2">
									Local Buengkan
								</span>
							</div>
								
							<div class="layer-slick1 animated visible-false" data-appear="rotateInUpRight" data-delay="800">
								<h2 class="ltext-104 txt-center cl0 p-t-22 p-b-40 respon1">
									อาหาร
								</h2>
							</div>
								
							<div class="layer-slick1 animated visible-false" data-appear="rotateIn" data-delay="1600">
								<a href="foods.php" class="flex-c-m stext-101 cl0 size-101 bg1 bor1 hov-btn2 p-lr-15 trans-04">
									รายละเอียด
								</a>
							</div>
						</div>
					</div>
				</div>
                
                <div class="item-slick1 bg-overlay1" style="background-image: url(images/slide-08.jpg);" data-thumb="images/thumb-08.jpg" data-caption="ที่พัก">
					<div class="container h-full">
						<div class="flex-col-c-m h-full p-t-100 p-b-60 respon5">
							<div class="layer-slick1 animated visible-false" data-appear="rotateInDownLeft" data-delay="0">
								<span class="ltext-202 txt-center cl0 respon2">
									Local Buengkan
								</span>
							</div>
								
							<div class="layer-slick1 animated visible-false" data-appear="rotateInUpRight" data-delay="800">
								<h2 class="ltext-104 txt-center cl0 p-t-22 p-b-40 respon1">
									ที่พัก
								</h2>
							</div>
								
							<div class="layer-slick1 animated visible-false" data-appear="rotateIn" data-delay="1600">
								<a href="homestay.php" class="flex-c-m stext-101 cl0 size-101 bg1 bor1 hov-btn2 p-lr-15 trans-04">
									รายละเอียด
								</a>
							</div>
						</div>
					</div>
				</div>
                
			</div>

			<div class="wrap-slick1-dots p-lr-10"></div>
		</div>
	</section>


	<!-- Banner -->
	<div class="sec-banner bg0 p-t-95 p-b-55">
		<div class="container">
			<div class="row">
				<div class="col-md-6 p-b-30 m-lr-auto">
					<!-- Block1 -->
					<div class="block1 wrap-pic-w">
						<img src="images/banner-04.jpg" alt="IMG-BANNER">

						<a href="foods.php" class="block1-txt ab-t-l s-full flex-col-l-sb p-lr-38 p-tb-34 trans-03 respon3">
							<div class="block1-txt-child1 flex-col-l">
								<span class="block1-name ltext-102 trans-04 p-b-8">
									อาหาร
								</span>

								<span class="block1-info stext-102 trans-04">
									อาหารพื้นถิ่นร่วมสมัย
								</span>
							</div>

							<div class="block1-txt-child2 p-b-4 trans-05">
								<div class="block1-link stext-101 cl0 trans-09">
									รายละเอียด
								</div>
							</div>
						</a>
					</div>
				</div>

				<div class="col-md-6 p-b-30 m-lr-auto">
					<!-- Block1 -->
					<div class="block1 wrap-pic-w">
						<img src="images/banner-05.jpg" alt="IMG-BANNER">

						<a href="homestay.php" class="block1-txt ab-t-l s-full flex-col-l-sb p-lr-38 p-tb-34 trans-03 respon3">
							<div class="block1-txt-child1 flex-col-l">
								<span class="block1-name ltext-102 trans-04 p-b-8">
									ที่พักโฮมสเตย์
								</span>

								<span class="block1-info stext-102 trans-04">
									บรรยากาศวิถีชีวิตที่เรียบง่าย
								</span>
							</div>

							<div class="block1-txt-child2 p-b-4 trans-05">
								<div class="block1-link stext-101 cl0 trans-09">
									รายละเอียด
								</div>
							</div>
						</a>
					</div>
				</div>

				<div class="col-md-6 col-lg-4 p-b-30 m-lr-auto">
					<!-- Block1 -->
					<div class="block1 wrap-pic-w">
						<img src="images/banner-07.jpg" alt="IMG-BANNER">

						<a href="products.php" class="block1-txt ab-t-l s-full flex-col-l-sb p-lr-30 p-tb-30 trans-03 respon3">
							<div class="block1-txt-child1 flex-col-l">
								<span class="block1-name ltext-102 trans-04 p-b-8">
									สินค้าและของฝาก
								</span>

								<span class="block1-info stext-102 trans-04">
									สินค้าของฝากจากชุมชน
								</span>
							</div>

							<div class="block1-txt-child2 p-b-4 trans-05">
								<div class="block1-link stext-101 cl0 trans-09">
									รายละเอียด
								</div>
							</div>
						</a>
					</div>
				</div>

				<div class="col-md-6 col-lg-4 p-b-30 m-lr-auto">
					<!-- Block1 -->
					<div class="block1 wrap-pic-w">
						<img src="images/banner-08.jpg" alt="IMG-BANNER">

						<a href="tours.php" class="block1-txt ab-t-l s-full flex-col-l-sb p-lr-30 p-tb-30 trans-03 respon3">
							<div class="block1-txt-child1 flex-col-l">
								<span class="block1-name ltext-102 trans-04 p-b-8">
									ท่องเที่ยว
								</span>

								<span class="block1-info stext-102 trans-04">
									ท่องเที่ยววิถีชุมชน
								</span>
							</div>

							<div class="block1-txt-child2 p-b-4 trans-05">
								<div class="block1-link stext-101 cl0 trans-09">
									รายละเอียด
								</div>
							</div>
						</a>
					</div>
				</div>

				<div class="col-md-6 col-lg-4 p-b-30 m-lr-auto">
					<!-- Block1 -->
					<div class="block1 wrap-pic-w">
						<img src="images/banner-09.jpg" alt="IMG-BANNER">

						<a href="plans.php" class="block1-txt ab-t-l s-full flex-col-l-sb p-lr-30 p-tb-30 trans-03 respon3">
							<div class="block1-txt-child1 flex-col-l">
								<span class="block1-name ltext-102 trans-04 p-b-8" style="color: white;text-shadow: 2px 2px 1px rgba(0, 0, 0, 0.5);">
									วางแผนกินเที่ยว
								</span>

								<span class="block1-info stext-102 trans-04" style="color: white;">
									กำหนดได้ด้วยตนเอง
								</span>
							</div>

							<div class="block1-txt-child2 p-b-4 trans-05">
								<div class="block1-link stext-101 cl0 trans-09">
									รายละเอียด
								</div>
							</div>
						</a>
					</div>
				</div>
			</div>
		</div>
	</div>


	<!-- Product -->
	<section class="bg0 p-t-23 p-b-130">
		<div class="container">
			<div class="p-b-10">
				<h3 class="ltext-103 cl5">
					สินค้าและของฝาก
				</h3>
			</div>

			<div class="flex-w flex-sb-m p-b-52">
				<div class="flex-w flex-l-m filter-tope-group m-tb-10">
					<button class="stext-106 cl6 hov1 bor3 trans-04 m-r-32 m-tb-5 how-active1" data-filter="*">
						ประเภทสินค้าทั้งหมด
					</button>
                    
<?php
include_once("connectdb.php");
$sql = "SELECT * FROM `products_category` ORDER BY `products_category`.`pc_id` ASC";
$result = $conn->query($sql);
while ($row = $result->fetch_assoc()) {
?>
					<button class="stext-106 cl6 hov1 bor3 trans-04 m-r-32 m-tb-5" data-filter=".<?=$row['pc_name'];?>">
						<?=$row['pc_name'];?>
					</button>
<?php } ?>
				</div>

				
				<!-- Search product -->

				<!-- Filter -->
                
			</div>

			<div class="row isotope-grid">
                
<?php
$sql2 = "SELECT * FROM products AS p
LEFT JOIN products_category AS pc
ON p.pc_id = pc.pc_id
ORDER BY p.p_id ASC";
$result2 = $conn->query($sql2);
while ($row2 = $result2->fetch_assoc()) {
    $img1 = explode(";",$row2['p_pictures']);
    $img = "images/products/".$img1[0]; 
    //$img = "images/products/".$row2['p_id'].".".$row2['p_ext'];
?>
				<div class="col-sm-6 col-md-4 col-lg-3 p-b-35 isotope-item <?=$row2['pc_name'];?>">
					<!-- Block2 -->
					<div class="block2">
						<div class="block2-pic hov-img0 label-new" data-label="New">
							<img src="<?=$img;?>" alt="<?=$row2['p_name'];?>">

				<a href="#" class="block2-btn flex-c-m stext-103 cl2 size-102 bg0 bor2 hov-btn1 p-lr-15 trans-04 js-show-modal1" data-target="#modalP<?=$row2['p_id'];?>">
				    Quick View
				</a>
						</div>

						<div class="block2-txt flex-w flex-t p-t-14">
							<div class="block2-txt-child1 flex-col-l ">
								<a href="product_detail.php?pid=<?=$row2['p_id'];?>" class="stext-104 cl4 hov-cl1 trans-04 js-name-b2 p-b-6">
									<?=$row2['p_name'];?>
								</a>

								<span class="stext-105 cl3">
									ราคา <?=number_format($row2['p_price'],0);?> บาท
								</span>
							</div>

							<div class="block2-txt-child2 flex-r p-t-3">
								<!--<a href="#" class="btn-addwish-b2 dis-block pos-relative js-addwish-b2">
									<img class="icon-heart1 dis-block trans-04" src="images/icons/icon-heart-01.png" alt="ICON">
									<img class="icon-heart2 dis-block trans-04 ab-t-l" src="images/icons/icon-heart-02.png" alt="ICON">
								</a>-->
							</div>
						</div>
					</div>
				</div>
                
	<!-- Modal1 -->
	<div class="wrap-modal1 js-modal1 p-t-60 p-b-20" id="modalP<?=$row2['p_id'];?>">
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
    $pictures = explode(";", $row2['p_pictures']);
    foreach ($pictures as $picture) {
?>                                    
								<div class="item-slick3" data-thumb="images/products/<?=$picture;?>">
									<div class="wrap-pic-w pos-relative">
										<img src="images/products/<?=$picture;?>" alt="<?=$row2['p_name'];?>">

										<a class="flex-c-m size-108 how-pos1 bor0 fs-16 cl10 bg0 hov-btn3 trans-04" href="images/products/<?=$picture;?>">
											<i class="fa fa-expand"></i>
										</a>
									</div>
								</div>                               
<?php } //ปิด foreach ?>

									
								</div>
							</div>
						</div>
					</div>
					
					<div class="col-md-6 col-lg-5 p-b-30">
						<div class="p-r-50 p-t-5 p-lr-0-lg">
							<h4 class="mtext-105 cl2 js-name-detail p-b-14">
								<?=$row2['p_name'];?>
							</h4>

							<span class="mtext-106 cl2">
								ราคา <?=number_format($row2['p_price'],0);?> บาท
							</span>

							<p class="stext-102 cl3 p-t-23">
								<?=$row2['p_detail'];?>
							</p>
							
							<!--  -->
							<div class="p-t-33">
								<div class="flex-w flex-r-m p-b-10">
									<div class="size-203 flex-c-m respon6">
										จำนวน
									</div>

									<div class="size-204 respon6-next">
<div class="wrap-num-product flex-w m-r-20 m-tb-10">
											<div class="btn-num-product-down cl8 hov-btn3 trans-04 flex-c-m">
												<i class="fs-16 zmdi zmdi-minus"></i>
											</div>

											<input class="mtext-104 cl3 txt-center num-product" type="number" name="num-product" id="q_product_<?=$row2['p_id'];?>" value="1" min="1" step="1">

											<div class="btn-num-product-up cl8 hov-btn3 trans-04 flex-c-m">
												<i class="fs-16 zmdi zmdi-plus"></i>
											</div>
										</div>
									</div>
								</div>

								<div class="flex-w flex-r-m p-b-10">
									<div class="size-204 flex-w flex-m respon6-next">
										

										<button class="flex-c-m stext-101 cl0 size-101 bg1 bor1 hov-btn1 p-lr-15 trans-04 js-addcart-detail" onclick="addToCart(<?=$row2['p_id'];?>, 'q_product_<?=$row2['p_id'];?>')">
											หยิบลงตะกร้า
										</button>
									</div>
								</div>	
							</div>

							<!--  -->
							<div class="flex-w flex-m p-l-100 p-t-40 respon7">
								<!--<div class="flex-m bor9 p-r-10 m-r-11">
									<a href="#" class="fs-14 cl3 hov-cl1 trans-04 lh-10 p-lr-5 p-tb-2 js-addwish-detail tooltip100" data-tooltip="Add to Wishlist">
										<i class="zmdi zmdi-favorite"></i>
									</a>
								</div>-->

								<a href="#" class="fs-14 cl3 hov-cl1 trans-04 lh-10 p-lr-5 p-tb-2 m-r-8 tooltip100" data-tooltip="Facebook">
									<i class="fa fa-facebook"></i>
								</a>

								<!--<a href="#" class="fs-14 cl3 hov-cl1 trans-04 lh-10 p-lr-5 p-tb-2 m-r-8 tooltip100" data-tooltip="Twitter">
									<i class="fa fa-twitter"></i>
								</a>-->

								<!--<a href="#" class="fs-14 cl3 hov-cl1 trans-04 lh-10 p-lr-5 p-tb-2 m-r-8 tooltip100" data-tooltip="Google Plus">
									<i class="fa fa-google-plus"></i>
								</a>-->
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
                
<?php } ?>
                
			</div>

			<!-- Pagination -->
			<!--<div class="flex-c-m flex-w w-full p-t-38">
				<a href="#" class="flex-c-m how-pagination1 trans-04 m-all-7 active-pagination1">
					1
				</a>

				<a href="#" class="flex-c-m how-pagination1 trans-04 m-all-7">
					2
				</a>
			</div>-->
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
$sql3 = "SELECT * FROM products ORDER BY p_id ASC";
$result3 = $conn->query($sql3);
while ($row3 = $result3->fetch_assoc()) {
?>
    
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
		$('.js-addwish-b2').on('click', function(e){
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
function addToCart(product_id, input_id) {
    // ดึงค่าจาก input ผ่าน id ที่ถูกส่งมา
    let quantity = document.getElementById(input_id).value;
    
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
    xhr.send("pid=" + product_id + "&q=" + quantity);
}
</script>
    
</body>
</html>