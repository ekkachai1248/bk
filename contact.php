<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<title>Local Buengkan - Contact</title>
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

	<!-- Title page -->
	<section class="bg-img1 txt-center p-lr-15 p-tb-92" style="background-image: url('images/bg-01.jpg');">
		<h3 class="ltext-103 cl0 txt-center">
			ติดต่อเรา
		</h3>
	</section>	


	<!-- Content page -->
	<section class="bg0 p-t-60 p-b-70">
		<div class="container">
			<div class="flex-w flex-tr">
				<div class="size-210 bor10 p-lr-70 p-t-40 p-b-60 p-lr-15-lg w-full-md">
					<form method="post" action="<?php echo $_SERVER['PHP_SELF'];?>">
						<h4 class="mtext-105 cl2 txt-center p-b-30">
							ส่งข้อความถึงเรา Local Buengkan
						</h4>

						<div class="bor8 m-b-20 how-pos4-parent">
							<input class="stext-111 cl2 plh3 size-116 p-l-62 p-r-30" type="text" name="name_sender" placeholder="ชื่อ-สกุล" value="<?php echo empty($_SESSION['fullname'])?"":$_SESSION['fullname'];?>" required <?php echo empty($_SESSION['fullname'])?"":"readonly";?>>
							<img class="how-pos4 pointer-none" src="images/icons/icon-user.png" alt="ICON">
						</div>

						<div class="bor8 m-b-20 how-pos4-parent">
							<input class="stext-111 cl2 plh3 size-116 p-l-62 p-r-30" type="text" name="email" placeholder="อีเมลของคุณ" value="<?php echo empty($_SESSION['email'])?"":$_SESSION['email'];?>" required <?php echo empty($_SESSION['email'])?"":"readonly";?>>
							<img class="how-pos4 pointer-none" src="images/icons/icon-email.png" alt="ICON">
						</div>

						<div class="bor8 m-b-30">
							<textarea class="stext-111 cl2 plh3 size-120 p-lr-28 p-tb-25" name="message" placeholder="พิมพ์ข้อความ" required autofocus></textarea>
						</div>

						<button type="submit" class="flex-c-m stext-101 cl0 size-121 bg3 bor1 hov-btn3 p-lr-15 trans-04 pointer">
							Submit
						</button>
					</form>
				</div>

				<div class="size-210 bor10 flex-w flex-col-m p-lr-93 p-tb-30 p-lr-15-lg w-full-md">
					<div class="flex-w w-full p-b-42">
						<span class="fs-18 cl5 txt-center size-211">
							<span class="lnr lnr-map-marker"></span>
						</span>

						<div class="size-212 p-t-2">
							<span class="mtext-110 cl2">
								ที่อยู่
							</span>

							<p class="stext-115 cl6 size-213 p-t-18">
								Local Buengkan อำเภอโซ่พิสัย จังหวัดบึงกาฬ
							</p>
						</div>
					</div>

					<div class="flex-w w-full p-b-42">
						<span class="fs-18 cl5 txt-center size-211">
							<span class="lnr lnr-phone-handset"></span>
						</span>

						<div class="size-212 p-t-2">
							<span class="mtext-110 cl2">
								โทร.
							</span>

							<p class="stext-115 cl1 size-213 p-t-18">
								089-999-9999
							</p>
						</div>
					</div>

					<div class="flex-w w-full">
						<span class="fs-18 cl5 txt-center size-211">
							<span class="lnr lnr-envelope"></span>
						</span>

						<div class="size-212 p-t-2">
							<span class="mtext-110 cl2">
								อีเมล
							</span>

							<p class="stext-115 cl1 size-213 p-t-18">
								contact@example.com
							</p>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>	
	

<?php include('footer.php'); ?>
    
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
<script src="vendor/sweetalert/sweetalert.min.js"></script>

<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    include_once("connectdb.php");
    $message = $_POST['message'];
    $name_sender = empty($_SESSION['fullname'])?$_POST['name_sender']:$_SESSION['fullname'];  
    $email = empty($_SESSION['email'])?$_POST['email']:$_SESSION['email']; 
    $user_id = empty($_SESSION['user_id'])?"":$_SESSION['user_id'];

    // เตรียมคำสั่ง SQL
    $stmt = $conn->prepare("INSERT INTO contact (user_id, name_sender, email, message) 
                            VALUES (?, ?, ?, ?)");
    if ($stmt) {
        $stmt->bind_param("isss", $user_id, $name_sender, $email, $message);

        if ($stmt->execute()) {
            echo "<script>";
            echo "swal('','ส่งข้อความสำเร็จ ขอบคุณที่ส่งข้อความถึงเรา', 'success');";
            echo "</script>";
        } else {
            echo "เกิดข้อผิดพลาด: " . $stmt->error;
        }
        $stmt->close();
    } else {
        echo "เกิดข้อผิดพลาดในการเตรียมคำสั่ง SQL: " . $conn->error;
    }
}
?>
    
</body>
</html>