	<!-- Footer -->
	<footer class="bg3 p-t-30 p-b-32">
		<div class="container">
			<div class="row">
				<div class="col-sm-6 col-lg-3 p-b-50">
					<h4 class="stext-301 cl0 p-b-30">
						Categories
					</h4>

					<ul>
						<li class="p-b-10">
							<a href="foods.php" class="stext-107 cl7 hov-cl1 trans-04">
								อาหาร
							</a>
						</li>

						<li class="p-b-10">
							<a href="homestay.php" class="stext-107 cl7 hov-cl1 trans-04">
								ที่พัก
							</a>
						</li>

						<li class="p-b-10">
							<a href="products.php" class="stext-107 cl7 hov-cl1 trans-04">
								สินค้าและของฝาก
							</a>
						</li>

						<li class="p-b-10">
							<a href="tours.php" class="stext-107 cl7 hov-cl1 trans-04">
								ท่องเที่ยว
							</a>
						</li>
                        
						<li class="p-b-10">
							<a href="plans.php" class="stext-107 cl7 hov-cl1 trans-04">
								วางแผนกินเที่ยว
							</a>
						</li>
					</ul>
				</div>
                
                <div class="col-sm-6 col-lg-3 p-b-50">
					<h4 class="stext-301 cl0 p-b-30">
						Sub Categories
					</h4>

					<ul>
						<li class="p-b-10">
							<a href="register.php" class="stext-107 cl7 hov-cl1 trans-04">
								สมัครสมาชิกใหม่
							</a>
						</li>

						<li class="p-b-10">
							<a href="shopping_cart.php" class="stext-107 cl7 hov-cl1 trans-04">
								ตะกร้าสินค้า
							</a>
						</li>

						<?php if(empty($_SESSION['user_id'])){ ?>
							<li class="p-b-10">
							<a href="sign-in.php" class="stext-107 cl7 hov-cl1 trans-04">
								เข้าสู่ระบบ
							</a>
						</li>
						<?php } else { ?>
							<li class="p-b-10">
							<a href="transactions.php" class="stext-107 cl7 hov-cl1 trans-04">
							รายการสั่งซื้อ
							</a>
						</li>
						<li class="p-b-10">
							<a href="myaccount.php" class="stext-107 cl7 hov-cl1 trans-04">
							บัญชีของฉัน
							</a>
						</li>
						<li class="p-b-10">
							<a href="sign-out.php" class="stext-107 cl7 hov-cl1 trans-04">
							ออกจากระบบ
							</a>
						</li>
						<?php } ?>



					</ul>
				</div>

				<div class="col-sm-6 col-lg-3 p-b-50">
					<h4 class="stext-301 cl0 p-b-30" style="font-family: Prompt;">
						ลิงค์ที่เกี่ยวข้อง
					</h4>

					<ul>
						<li class="p-b-10">
							<a href="https://www.buengkan.go.th/" target="_blank" class="stext-107 cl7 hov-cl1 trans-04">
								จังหวัดบึงกาฬ
							</a>
						</li>

						<li class="p-b-10">
							<a href="https://www.nia.or.th/" target="_blank" class="stext-107 cl7 hov-cl1 trans-04">
								NIA สำนักงานนวัตกรรมแห่งชาติ 
							</a>
						</li>

					</ul>
				</div>

				<div class="col-sm-6 col-lg-3 p-b-50">
					<h4 class="stext-301 cl0 p-b-30" style="font-family: Prompt;">
						ติดต่อเรา
					</h4>

					<p class="stext-107 cl7 size-201">
						Local Buengkan <br>อำเภอโซ่พิสัย จังหวัดบึงกาฬ <br>โทร.089-999-9999
					</p>

					<div class="p-t-27">
						<a href="https://web.facebook.com/LifeCommunityMuseumBuengkan" class="fs-18 cl7 hov-cl1 trans-04 m-r-16" target="_blank">
							<i class="fa fa-facebook"></i>
						</a>

					</div>
				</div>

				<!--<div class="col-sm-6 col-lg-3 p-b-50">
					<h4 class="stext-301 cl0 p-b-30">
						Newsletter
					</h4>

					<form>
						<div class="wrap-input1 w-full p-b-4">
							<input class="input1 bg-none plh1 stext-107 cl7" type="text" name="email" placeholder="email@example.com">
							<div class="focus-input1 trans-04"></div>
						</div>

						<div class="p-t-18">
							<button type="button" class="flex-c-m stext-101 cl0 size-103 bg1 bor1 hov-btn2 p-lr-15 trans-04">
								Subscribe
							</button>
						</div>
					</form>
				</div>-->
			</div>

			<div>

				<p class="stext-107 cl6 txt-center">
Copyright &copy;<script>document.write(new Date().getFullYear());</script> All rights reserved | Local Buengkan
				</p>
			</div>
		</div>
	</footer>
