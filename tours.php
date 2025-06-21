<?php
@session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<title>Local Buengkan - Tours</title>
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
	
<?php include('header.php'); ?>

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
	foreach($_SESSION['tid'] as $p_id) {
    // แปลงค่า price และ item ให้เป็น float ก่อนคูณ
    $price = floatval($_SESSION['tprice'][$p_id]); // แปลงราคาสินค้าเป็น float
    $quantity = floatval($_SESSION['titem'][$p_id]); // แปลงจำนวนสินค้าที่เลือกเป็น float

    // คำนวณผลรวมของแต่ละสินค้าตามจำนวน
    $sum[$t_id] = $price * $quantity;
    $total += $sum[$t_id];
?>
					<li class="header-cart-item flex-w flex-t m-b-12">
						<div class="header-cart-item-img">
                            <img src="images/tours/<?=$_SESSION['tpicture'][$t_id];?>" alt="<?=$_SESSION['tname'][$t_id];?>">
						</div>

						<div class="header-cart-item-txt p-t-8">
							<a href="product_detail.php?pid=<?=$_SESSION['tid'][$t_id];?>" class="header-cart-item-name m-b-18 hov-cl1 trans-04">
								<?=$_SESSION['tname'][$t_id];?>
							</a>

							<span class="header-cart-item-info">
								<?=$_SESSION['titem'][$t_id];?> x <?=$_SESSION['pprice'][$p_id];?> บาท
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

	
	<!-- Product -->
	<div class="bg0 m-t-23 p-b-140">
		<div class="container">
			<div class="flex-w flex-sb-m p-b-52">
				<div class="flex-w flex-l-m filter-tope-group m-tb-10">
					<button class="stext-106 cl6 hov1 bor3 trans-04 m-r-32 m-tb-5 how-active1" data-filter="*">
						ประเภททริปท่องเที่ยวทั้งหมด
					</button>

<?php
include_once("connectdb.php");
$sql = "SELECT * FROM `tour_category` ORDER BY `tour_category`.`tc_id` ASC";
$result = $conn->query($sql);
while ($row = $result->fetch_assoc()) {
?>
					<button class="stext-106 cl6 hov1 bor3 trans-04 m-r-32 m-tb-5" data-filter=".<?=$row['tc_name'];?>">
						<?=$row['tc_name'];?>
					</button>
<?php } ?>
					
				</div>

				<!--<div class="flex-w flex-c-m m-tb-10">
					<div class="flex-c-m stext-106 cl6 size-105 bor4 pointer hov-btn3 trans-04 m-tb-4 js-show-search">
						<i class="icon-search cl2 m-r-6 fs-15 trans-04 zmdi zmdi-search"></i>
						<i class="icon-close-search cl2 m-r-6 fs-15 trans-04 zmdi zmdi-close dis-none"></i>
						Search
					</div>
				</div>-->
				
				<!-- Search product -->

				<!-- Filter -->
                
			</div>

			<div class="row isotope-grid">
                
<?php
$sql2 = "SELECT * FROM tours AS t
LEFT JOIN tour_category AS tc
ON t.tc_id = tc.tc_id
ORDER BY t.tour_id ASC";
$result2 = $conn->query($sql2);
while ($row2 = $result2->fetch_assoc()) {
    $img1 = explode(";",$row2['t_pictures']);
    $img = "images/tours/".$img1[0];
?>
				<div class="col-sm-6 col-md-4 col-lg-3 p-b-35 isotope-item <?=$row2['tc_name'];?>">
					<!-- Block2 -->
					<div class="block2">
						<div class="block2-pic hov-img0">
							<img src="<?=$img;?>" alt="<?=$row2['name'];?>">

							<a href="#" class="block2-btn flex-c-m stext-103 cl2 size-102 bg0 bor2 hov-btn1 p-lr-15 trans-04 js-show-modal1" data-target="#md<?=$row2['tour_id'];?>">
									Quick View
								</a>
						</div>

						<div class="block2-txt flex-w flex-t p-t-14">
							<div class="block2-txt-child1 flex-col-l ">
								<a href="tour_detail.php?tid=<?=$row2['tour_id'];?>" class="stext-104 cl4 hov-cl1 trans-04 js-name-b2 p-b-4">
									<?=$row2['name'];?>
								</a>
                                
								<!--<span class="stext-105 cl3 p-b-4">
									จำนวน <?php //echo number_format($row2['hours'],0);?> ชั่วโมง
								</span>-->
                                
								<span class="stext-106 cl4">
									ราคา <?=number_format($row2['price'],0);?> บาท
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
<?php } ?>
			</div>

			<!-- Load more 
			<div class="flex-c-m flex-w w-full p-t-45">
				<a href="#" class="flex-c-m stext-101 cl5 size-103 bg2 bor1 hov-btn1 p-lr-15 trans-04">
					Load More
				</a>
			</div>-->
		</div>
	</div>
		
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

							<span class="mtext-106 cl2">
								ราคา <?=number_format($row3['price'],0);?> บาท
							</span>

							<p class="stext-102 cl3 p-t-23">
								<?=$row3['description'];?>
							</p>
							
							<!--  -->
							<div class="p-t-33">

								<div class="flex-w flex-r-m p-b-10">
									<div class="size-204 flex-w flex-m respon6-next">
										
										<a href="tour_detail.php?tid=<?php echo $row3['tour_id'];?>" class="flex-c-m stext-101 cl0 size-101 bg1 bor1 hov-btn1 p-lr-15 trans-04">
											รายละเอียด
										</a>
									</div>
								</div>	
							</div>

							<!--  -->
							<div class="flex-w flex-m p-l-100 p-t-40 respon7">

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

</body>
</html>