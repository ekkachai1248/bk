<?php
//error_reporting(E_NOTICE);
session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<title>Local Buengkan - ตะกร้าสินค้า</title>
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
	<link rel="stylesheet" type="text/css" href="vendor/perfect-scrollbar/perfect-scrollbar.css">
	<link rel="stylesheet" type="text/css" href="css/util.css">
	<link rel="stylesheet" type="text/css" href="css/main.css">
    
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
				Shopping Cart
			</span>
		</div>
	</div>
		

	<!-- Shoping Cart -->
	<form id="cartForm" class="bg0 p-t-75 p-b-85" method="post" action="booking_confirm.php" target="_blank">
		<div class="container">
			<div class="row">
				<div class="col-lg-10 col-xl-7 m-lr-auto m-b-50">
                    
                    
            <div class="m-l-25 m-r--38 m-lr-0-xl m-t-0">
                        <h4 class="mtext-108 m-b-10">อาหาร</h4>
						<div class="wrap-table-shopping-cart">
							<table class="table-shopping-cart">
								<tr class="table_head">
									<th class="column-1" colspan="2">ชื่อเมนูอาหาร</th>
									<th class="column-2">วันเวลา</th>
									<th class="column-3">ราคา</th>
									<th class="column-4">จำนวน</th>
									<th class="column-5">รวม (บาท)</th>
								</tr>
<?php

if(!empty($_SESSION['fid'])) {
    $totalFood = 0;
	foreach($_SESSION['fid'] as $f_id) {
    // แปลงค่า price และ item ให้เป็น float ก่อนคูณ
    $price = floatval($_SESSION['fprice'][$f_id]); // แปลงราคาเป็น float
    $quantity = floatval($_SESSION['fitem'][$f_id]); // แปลงจำนวนที่เลือกเป็น float

    // คำนวณผลรวมของแต่ละสินค้าตามจำนวน
    $sum[$f_id] = $price * $quantity;
    $totalFood += $sum[$f_id];
?>

								<tr class="">
									<td class="column-1 p-t-30 p-b-30">
										<div class="how-itemcart1">
											<img src="images/foods/<?=$_SESSION['fpicture'][$f_id];?>" alt="<?=$_SESSION['fname'][$f_id];?>">
										</div>
									</td>
									<td class="column-2">
                                        <?=$_SESSION['fname'][$f_id];?>
                                        <input type="hidden" name="f_id[]" value="<?=$_SESSION['fid'][$f_id];?>">
                                        <input type="hidden" name="f_name[]" value="<?=$_SESSION['fname'][$f_id];?>">
                                        <input type="hidden" name="f_date[]" value="<?=$_SESSION['fdate'][$f_id];?>">
                                        <input type="hidden" name="f_round[]" value="<?=$_SESSION['fround'][$f_id];?>">
                                    </td>
									<td class="column-2"><?=$_SESSION['fdate'][$f_id];?><br><?=$_SESSION['fround'][$f_id];?></td>
									<td class="column-3 text-success"><?=number_format($_SESSION['fprice'][$f_id],0);?><input type="hidden" name="f_price[]" value="<?=$_SESSION['fprice'][$f_id];?>"></td>
									<td class="column-4">
<input class="bor8 num-quantity text-primary p-1" type="number" name="f_item[]" value="<?=$_SESSION['fitem'][$f_id];?>" data-price="<?=floatval($_SESSION['fprice'][$f_id]);?>" data-group="food" min="1" style="width: 54px; font-size: 16px;">
									</td>
									<td class="column-5"><div id="sumFood<?=$_SESSION['fid'][$f_id];?>"></div></td>
								</tr>
<?php 
    } // end foreach 
} else {
?>
	<tr>
		<td colspan="5" height="50" align="center">ไม่มีอาหารที่เลือกไว้</td>
	</tr>
<?php } // end if ?>

								
							</table>
						</div>

						<div class="flex-w flex-sb-m bor15 p-t-18 p-b-15 p-lr-40 p-lr-15-sm">
							<div class="flex-w flex-m m-r-20 m-tb-5">
								<a href="clearBasket.php?c=foods" class="flex-c-m stext-101 cl2 size-119 bg8 bor13 hov-btn3 p-lr-15 trans-04 pointer m-tb-10"><i class="zmdi zmdi-delete"></i> &nbsp; ลบอาหารที่เลือกไว้ทั้งหมด</a>	

							</div>

							<!--<div class="flex-c-m stext-101 cl2 size-119 bg8 bor13 hov-btn3 p-lr-15 trans-04 pointer m-tb-10">
								Update Cart
							</div>-->
						</div>
					</div>                    
                    
            <div class="m-l-25 m-r--38 m-lr-0-xl m-t-60">
                        <h4 class="mtext-108 m-b-10">ที่พัก</h4>
						<div class="wrap-table-shopping-cart">
							<table class="table-shopping-cart">
								<tr class="table_head">
									<th class="column-1" colspan="2">ชื่อที่พัก</th>
									<th class="column-2">วันเวลา</th>
									<th class="column-3">ราคา/คืน</th>
									<th class="column-4">จำนวนห้อง</th>
									<th class="column-5">รวม (บาท)</th>
								</tr>
<?php

if(!empty($_SESSION['hid'])) {
    $totalHomestay = 0;
	foreach($_SESSION['hid'] as $h_id) {
    // แปลงค่า price และ item ให้เป็น float ก่อนคูณ
    $price = floatval($_SESSION['hprice'][$h_id]); // แปลงราคาเป็น float
    $quantity = floatval($_SESSION['qroom'][$h_id]); // แปลงจำนวนที่เลือกเป็น float
    $qnight = floatval($_SESSION['qnight'][$h_id]);

    // คำนวณผลรวมของแต่ละสินค้าตามจำนวน
    $sum[$h_id] = $price * $quantity * $qnight;
    $totalHomestay += $sum[$h_id];
?>

								<tr class="">
									<td class="column-1 p-t-30 p-b-30">
										<div class="how-itemcart1">
											<img src="images/homestay/<?=$_SESSION['hpicture'][$h_id];?>" alt="<?=$_SESSION['hname'][$h_id];?>">
										</div>
									</td>
									<td class="column-2"><?=$_SESSION['hname'][$h_id];?></td>
									<td class="column-2" style="font-size: 13px">เช็คอิน <?=$_SESSION['datecheckin'][$h_id];?><br>เช็คเอาท์ <?=$_SESSION['datecheckout'][$h_id];?><br>(รวม <?=$_SESSION['qnight'][$h_id];?> คืน)
                                        <input type="hidden" name="h_id[]" value="<?=$_SESSION['hid'][$h_id];?>">
                                        <input type="hidden" name="h_name[]" value="<?=$_SESSION['hname'][$h_id];?>">
                                        <input type="hidden" name="h_datecheckin[]" value="<?=$_SESSION['datecheckin'][$h_id];?>">
                                        <input type="hidden" name="h_datecheckout[]" value="<?=$_SESSION['datecheckout'][$h_id];?>">
                                        <input type="hidden" class="num-night" name="h_night[]" value="<?=$_SESSION['qnight'][$h_id];?>" class="num-night">
                                        <input type="hidden" name="h_price[]" value="<?=$_SESSION['hprice'][$h_id];?>">
                                    </td>
									<td class="column-3 text-success" style="font-size: 14px"><?=number_format($_SESSION['hprice'][$h_id],0);?> </td>
									<td class="">

<input class="bor8 num-quantity text-primary p-1" type="number" name="h_room[]" value="<?=$_SESSION['qroom'][$h_id];?>" data-price="<?=floatval($_SESSION['hprice'][$h_id]);?>" data-group="homestay" min="1" style="width: 54px; font-size: 16px;">

									</td>
									<td class="column-5"><div id="sumHomestay<?=$_SESSION['hid'][$h_id];?>"></div></td>
								</tr>
<?php 
    } // end foreach 
} else {
?>
	<tr>
		<td colspan="5" height="50" align="center">ไม่มีที่พักที่เลือกไว้</td>
	</tr>
<?php } // end if ?>

								
							</table>
						</div>

						<div class="flex-w flex-sb-m bor15 p-t-18 p-b-15 p-lr-40 p-lr-15-sm">
							<div class="flex-w flex-m m-r-20 m-tb-5">
								<a href="clearBasket.php?c=homestays" class="flex-c-m stext-101 cl2 size-119 bg8 bor13 hov-btn3 p-lr-15 trans-04 pointer m-tb-10"><i class="zmdi zmdi-delete"></i> &nbsp; ลบที่พักที่เลือกไว้ทั้งหมด</a>	

							</div>

							<!--<div class="flex-c-m stext-101 cl2 size-119 bg8 bor13 hov-btn3 p-lr-15 trans-04 pointer m-tb-10">
								Update Cart
							</div>-->
						</div>
					</div>                    
                    
					<div class="m-l-25 m-r--38 m-lr-0-xl m-t-60">
                        <h4 class="mtext-108 m-b-10">สินค้าและของฝาก</h4>
						<div class="wrap-table-shopping-cart">
							<table class="table-shopping-cart">
								<tr class="table_head">
									<th class="column-1">สินค้า</th>
									<th class="column-2"></th>
									<th class="column-3">ราคา/ชิ้น</th>
									<th class="column-4">จำนวน</th>
									<th class="column-5">รวม (บาท)</th>
								</tr>
<?php

if(!empty($_SESSION['pid'])) {
    $totalProduct = 0;
	foreach($_SESSION['pid'] as $p_id) {
    // แปลงค่า price และ item ให้เป็น float ก่อนคูณ
    $price = floatval($_SESSION['pprice'][$p_id]); // แปลงราคาสินค้าเป็น float
    $quantity = floatval($_SESSION['pitem'][$p_id]); // แปลงจำนวนสินค้าที่เลือกเป็น float

    // คำนวณผลรวมของแต่ละสินค้าตามจำนวน
    $sum[$p_id] = $price * $quantity;
    $totalProduct += $sum[$p_id];
?>

								<tr class="">
									<td class="column-1 p-t-30 p-b-30">
										<div class="how-itemcart1">
											<img src="images/products/<?=$_SESSION['ppicture'][$p_id];?>" alt="<?=$_SESSION['pname'][$p_id];?>">
										</div>
									</td>
									<td class="column-2">
                                        <?=$_SESSION['pname'][$p_id];?>
                                        <input type="hidden" name="p_id[]" value="<?=$_SESSION['pid'][$p_id];?>">
                                        <input type="hidden" name="p_name[]" value="<?=$_SESSION['pname'][$p_id];?>">
                                        <input type="hidden" name="p_price[]" value="<?=$_SESSION['pprice'][$p_id];?>">
                                    </td>
									<td class="column-3 text-success"><?=number_format($_SESSION['pprice'][$p_id],0);?> บาท</td>
									<td class="column-4">
<input class="bor8 num-quantity text-primary p-1" type="number" name="p_item[]" value="<?=$_SESSION['pitem'][$p_id];?>" data-price="<?=floatval($_SESSION['pprice'][$p_id]);?>" data-group="product" min="1" style="width: 54px; font-size: 16px;">
									</td>
									<td class="column-5"><div id="sumProduct<?=$_SESSION['pid'][$p_id];?>"></div></td>
								</tr>
<?php 
    } // end foreach 
} else {
?>
	<tr>
		<td colspan="5" height="50" align="center">ไม่มีสินค้าในตะกร้า</td>
	</tr>
<?php } // end if ?>

								
							</table>
						</div>

						<div class="flex-w flex-sb-m bor15 p-t-18 p-b-15 p-lr-40 p-lr-15-sm">
							<div class="flex-w flex-m m-r-20 m-tb-5">
								<a href="clearBasket.php?c=products" class="flex-c-m stext-101 cl2 size-119 bg8 bor13 hov-btn3 p-lr-15 trans-04 pointer m-tb-10"><i class="zmdi zmdi-delete"></i> &nbsp; ลบสินค้าในตะกร้าทั้งหมด</a>	

							</div>

							<!--<div class="flex-c-m stext-101 cl2 size-119 bg8 bor13 hov-btn3 p-lr-15 trans-04 pointer m-tb-10">
								Update Cart
							</div>-->
						</div>
					</div>
                    
                    
                    <div class="m-l-25 m-r--38 m-lr-0-xl m-t-60">
                        <h4 class="mtext-108 m-b-10">ทริปท่องเที่ยว</h4>
						<div class="wrap-table-shopping-cart">
							<table class="table-shopping-cart">
								<tr class="table_head">
									<th class="column-1" colspan="2">ชื่อทริปท่องเที่ยว</th>
									<th class="column-2">วันเวลา</th>
									<th class="column-3">ราคา/คน</th>
									<th class="column-4">จำนวนคน</th>
									<th class="column-5">รวม (บาท)</th>
								</tr>
<?php

if(!empty($_SESSION['tid'])) {
    $totalTour = 0;
	foreach($_SESSION['tid'] as $t_id) {
    // แปลงค่า price และ item ให้เป็น float ก่อนคูณ
    $price = floatval($_SESSION['tprice'][$t_id]); // แปลงราคาสินค้าเป็น float
    $quantity = floatval($_SESSION['titem'][$t_id]); // แปลงจำนวนสินค้าที่เลือกเป็น float

    // คำนวณผลรวมของแต่ละสินค้าตามจำนวน
    $sum[$t_id] = $price * $quantity;
    $totalTour += $sum[$t_id];
?>

								<tr class="">
									<td class="column-1 p-t-30 p-b-30">
										<div class="how-itemcart1">
											<img src="images/tours/<?=$_SESSION['tpicture'][$t_id];?>" alt="<?=$_SESSION['tname'][$t_id];?>">
										</div>
									</td>
									<td class="column-2">
                                        <?=$_SESSION['tname'][$t_id];?>
                                        <input type="hidden" name="t_id[]" value="<?=$_SESSION['tid'][$t_id];?>">
                                        <input type="hidden" name="t_name[]" value="<?=$_SESSION['tname'][$t_id];?>">
                                        <input type="hidden" name="t_price[]" value="<?=$_SESSION['tprice'][$t_id];?>">
                                        <input type="hidden" name="t_date[]" value="<?=$_SESSION['tdate'][$t_id];?>">
                                        <input type="hidden" name="t_round[]" value="<?=$_SESSION['tround'][$t_id];?>">
                                    </td>
									<td class="column-2"><?=$_SESSION['tdate'][$t_id];?><br><?=$_SESSION['tround'][$t_id];?></td>
									<td class="column-3 text-success"><?=number_format($_SESSION['tprice'][$t_id],0);?> </td>
									<td class="column-4">
<input class="bor8 num-quantity text-primary p-1" type="number" name="t_item[]" value="<?=$_SESSION['titem'][$t_id];?>" data-price="<?=floatval($_SESSION['tprice'][$t_id]);?>" data-group="tour" min="1" style="width: 54px; font-size: 16px;">
									</td>
									<td class="column-5"><div id="sumTour<?=$_SESSION['tid'][$t_id];?>"></div></td>
								</tr>
<?php 
    } // end foreach 
} else {
?>
	<tr>
		<td colspan="5" height="50" align="center">ไม่มีทริปท่องเที่ยวที่เลือกไว้</td>
	</tr>
<?php } // end if ?>

								
							</table>
						</div>

						<div class="flex-w flex-sb-m bor15 p-t-18 p-b-15 p-lr-40 p-lr-15-sm">
							<div class="flex-w flex-m m-r-20 m-tb-5">
								<a href="clearBasket.php?c=tours" class="flex-c-m stext-101 cl2 size-119 bg8 bor13 hov-btn3 p-lr-15 trans-04 pointer m-tb-10"><i class="zmdi zmdi-delete"></i> &nbsp; ลบทริปท่องเที่ยวที่เลือกไว้ทั้งหมด</a>	

							</div>

							<!--<div class="flex-c-m stext-101 cl2 size-119 bg8 bor13 hov-btn3 p-lr-15 trans-04 pointer m-tb-10">
								Update Cart
							</div>-->
						</div>
					</div>
                    
                    
				</div>

				<div class="col-sm-10 col-lg-7 col-xl-5 m-lr-auto m-b-50">
					<div class="bor10 p-lr-40 p-t-30 p-b-40 m-l-63 m-r-40 m-lr-0-xl p-lr-15-sm">
						<h4 class="mtext-109 cl2 p-b-30">
							Cart Totals
						</h4>

						<div class="flex-w flex-t bor12 p-t-15 p-b-30">
							<div class="size-208 w-full-ssm">
								<span class="stext-110 cl2">
									ผู้รับ:
								</span>
							</div>

							<div class="size-209 p-r-18 p-r-0-sm w-full-ssm">
								
								<div class="p-t-15">
                                    
									<span class="stext-112 cl8">
										ชื่อ-สกุล
									</span>
									<div class="bor8 bg0 m-b-12">
										<input class="stext-111 cl8 plh3 size-111 p-lr-15" type="text" name="fullname" placeholder="ชื่อ-สกุล" value="<?php echo empty ($_SESSION['fullname'])?'':$_SESSION['fullname'];?>" required>
									</div>

									<span class="stext-112 cl8">
										เบอร์โทรศัพท์
									</span>

									<div class="bor8 bg0 m-b-22">
										<input class="stext-111 cl8 plh3 size-111 p-lr-15" type="text" name="phone" placeholder="เบอร์โทรศัพท์" value="<?php echo empty ($_SESSION['phone'])?'':$_SESSION['phone'];?>" required>
									</div>

									<span class="stext-112 cl8">
										ที่อยู่จัดส่ง
									</span>

									<div class="bor8 bg0 m-b-12">
										<textarea class="stext-111 cl8 plh3 size-111 p-lr-15" name="address" style="height: 80px" required><?php echo empty ($_SESSION['address'])?'':$_SESSION['address'];?></textarea>
									</div>
										
								</div>
							</div>
						</div>

						<div class="flex-w flex-t p-t-27 p-b-33">
							<div class="size-208">
								<span class="mtext-101 cl2">
									รวมทั้งสิ้น:
								</span>
							</div>

							<div class="size-209 p-t-1">
                                <div id="Total" class="mtext-110 cl2 text-primary"></div>
                                <input type="hidden" id="total_all" name="total_all">
                                <input type="hidden" name="booking_type" value="regular">
							</div>
						</div>

<?php
if(!isset($_SESSION['user_id'])){
?>
<button type="button" class="flex-c-m stext-101 cl0 size-116 bg3 bor14 hov-btn3 p-lr-15 trans-04 pointer" onclick="swal('', 'โปรดล็อคอินเข้าสู่ระบบก่อนยืนยันการสั่งซื้อ', 'warning').then(() => {window.location.href='sign-in.php';});">
ยืนยันการสั่งซื้อ
</button>
<?php } else { ?>   
<button type="button" class="flex-c-m stext-101 cl0 size-116 bg3 bor14 hov-btn3 p-lr-15 trans-04 pointer" onclick="
        (function() {
            var totalValue = document.getElementById('total_all').value;
            if (totalValue == '0') {
                swal('', 'ตะกร้าว่างเปล่า โปรดเลือกรายการก่อนกดปุ่ม ยืนยันการสั่งซื้อ', 'warning');
            } else {
                document.getElementById('cartForm').submit();
            }
        })();
    ">
        ยืนยันการสั่งซื้อ
    </button>
<?php } ?>
					</div>
				</div>
			</div>
		</div>
	</form>
			

	<?php include("footer.php");?>


	<!-- Back to top -->
	<div class="btn-back-to-top" id="myBtn">
		<span class="symbol-btn-back-to-top">
			<i class="zmdi zmdi-chevron-up"></i>
		</span>
	</div>

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
	<script src="vendor/MagnificPopup/jquery.magnific-popup.min.js"></script>
    
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
    
	<script src="js/main.js"></script>

<script>
document.addEventListener("DOMContentLoaded", function () {
    // ค้นหาปุ่มเพิ่มและลดจำนวน
    const inputs = document.querySelectorAll('.num-quantity');

    inputs.forEach(input => {
        // ฟังการเปลี่ยนแปลงค่าใน input
        input.addEventListener('input', function () {
            updateQuantity(input);
        });
    });

    // คำนวณราคาเริ่มต้น
    calculateTotal();
});

// ฟังก์ชันการอัปเดตจำนวน
function updateQuantity(input) {
    let quantity = parseInt(input.value) || 0; // รับค่าจำนวน
    if (quantity < 1) quantity = 1; // ค่าจำนวนน้อยสุดคือ 1 (ตามที่กำหนดใน HTML min="1")
    input.value = quantity; // กำหนดค่าใหม่ใน input
    calculateTotal(); // คำนวณราคาผลรวมใหม่
}

function calculateTotal() {
        let groups = ["food", "homestay", "product", "tour"];
        let grandTotal = 0;

        groups.forEach(group => {
            let sumGroup = 0;
            
            // คำนวณผลรวมของแต่ละ ID ในกลุ่มนั้น ๆ
            let groupItems = {};
            
            document.querySelectorAll(`input[data-group="${group}"]`).forEach(input => {
                let quantity = parseInt(input.value) || 0;
                let price = parseFloat(input.dataset.price) || 0;
                let id = input.closest("td").nextElementSibling.querySelector("div").id.replace(`sum${group.charAt(0).toUpperCase() + group.slice(1)}`, "");

                let subtotal = quantity * price;

                // ตรวจสอบว่ามี input จำนวนคืนหรือไม่ (เฉพาะ Homestay)
                if (group === "homestay") {
                    const nightInput = input.closest("tr").querySelector(".num-night");
                    if (nightInput) {
                        const nights = parseInt(nightInput.value) || 1; // ถ้าไม่มีค่ากำหนดเป็น 1 คืน
                        subtotal *= nights;
                    }
                }

                if (!groupItems[id]) {
                    groupItems[id] = 0;
                }
                groupItems[id] += subtotal;
                sumGroup += subtotal;
            });

            // อัปเดตราคาของแต่ละไอเท็มตาม ID
            for (let id in groupItems) {
                let sumElement = document.getElementById(`sum${group.charAt(0).toUpperCase() + group.slice(1)}${id}`);
                if (sumElement) {
                    sumElement.innerHTML = `<strong>${groupItems[id].toLocaleString()} บาท</strong>`;
                }
            }

            // เพิ่มค่าของกลุ่มนี้ไปยังยอดรวมทั้งหมด
            grandTotal += sumGroup;
        });

        // แสดงผลรวมทั้งหมด
        let totalDiv = document.getElementById("Total");
        if (totalDiv) {
            totalDiv.innerHTML = `<strong>${grandTotal.toLocaleString()} บาท</strong>`;
        }

        // อัปเดตค่าใน input ซ่อนค่า total_all
        let totalInput = document.getElementById("total_all");
        if (totalInput) {
            totalInput.value = grandTotal;
        }
    }

    // ติดตามการเปลี่ยนแปลงค่าของ input
    document.querySelectorAll('.num-quantity, .num-night').forEach(input => {
        input.addEventListener('input', calculateTotal);
    });

    // คำนวณยอดรวมเมื่อโหลดหน้าเว็บ
    calculateTotal();

</script>

    
</body>
</html>