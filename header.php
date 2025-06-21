	<!-- Header -->
	<header class="header-v4">
		<!-- Header desktop -->
		<div class="container-menu-desktop">
			<!-- Topbar -->
			<div class="top-bar">
				<div class="content-topbar flex-sb-m h-full container">
					<div class="left-top-bar">
						<a href="index.php" style="color: white"><h3>Local Buengkan</h3></a>
					</div>

					<div class="right-top-bar flex-w h-full">
                        
								<?php if(empty($_SESSION['user_id'])){ ?>
						<a href="sign-in.php" class="flex-c-m trans-04 p-lr-25">
							เข้าสู่ระบบ
						</a>
                                <?php } else { ?>
						<a href="transactions.php" class="flex-c-m trans-04 p-lr-25">
							รายการสั่งซื้อ
						</a>
						<a href="myaccount.php" class="flex-c-m trans-04 p-lr-25">
							บัญชีของฉัน
						</a>
						<a href="sign-out.php" class="flex-c-m trans-04 p-lr-25">
							ออกจากระบบ
						</a>
                                <?php } ?>

					</div>
                                        
				</div>
			</div>

			<div class="wrap-menu-desktop how-shadow1">
				<nav class="limiter-menu-desktop container">
					
					<!-- Logo desktop--> 		
					<!--<a href="#" class="logo">-->
						<img src="images/icons/logo-01.png" alt="IMG-LOGO">
					<!--</a>-->

					<!-- Menu desktop -->
					<div class="menu-desktop">
						<ul class="main-menu">
							<li>
								<a href="index.php">หน้าหลัก</a>
							</li>

							<li class="label1 <?php echo (basename($_SERVER['PHP_SELF']) == 'foods.php' || basename($_SERVER['PHP_SELF']) == 'food_detail.php') ? 'active-menu' : ''; ?>" data-label1="hot">
								<a href="foods.php">อาหาร</a>
							</li>

							<li class="<?php echo (basename($_SERVER['PHP_SELF']) == 'homestay.php' || basename($_SERVER['PHP_SELF']) == 'homestay_detail.php') ? 'active-menu' : ''; ?>">
								<a href="homestay.php">ที่พัก</a>
							</li>

							<li class="label1 <?php echo basename($_SERVER['PHP_SELF']) == 'products.php' ? 'active-menu' : ''; ?>" data-label1="hot">
								<a href="products.php">สินค้าและของฝาก</a>
							</li>

							<li class="<?php echo basename($_SERVER['PHP_SELF']) == 'tours.php' ? 'active-menu' : ''; ?>">
								<a href="tours.php">ท่องเที่ยว</a>
							</li>

							<li class="label1 <?php echo basename($_SERVER['PHP_SELF']) == 'plans.php' ? 'active-menu' : ''; ?>" data-label1="hot">
								<a href="plans.php">วางแผนกินเที่ยว</a>
							</li>
                            
							<li class="<?php echo basename($_SERVER['PHP_SELF']) == 'contact.php' ? 'active-menu' : ''; ?>">
								<a href="contact.php">ติดต่อเรา</a>
							</li>
                            
						</ul>
					</div>	

					<!-- Icon header -->
					<div class="wrap-icon-header flex-w flex-r-m">

						<div class="icon-header-item cl2 hov-cl1 trans-04 p-l-22 p-r-11" >
							<a href="shopping_cart.php"><i class="zmdi zmdi-shopping-cart"></i></a>
						</div>

						<!--<a href="#" class="icon-header-item cl2 hov-cl1 trans-04 p-l-22 p-r-11">
							<i class="zmdi zmdi-favorite-outline"></i>
						</a>-->
					</div>
				</nav>
			</div>	
		</div>
    </header>