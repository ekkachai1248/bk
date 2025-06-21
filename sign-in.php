<?php
session_start();
//var_dump($_SESSION['fullname']);
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<title>Local Buengkan - เข้าสู่ระบบ</title>
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
    
	<!-- Title page -->
	<section class="bg-img1 txt-center p-lr-15 p-tb-92" style="background-image: url('images/bg-06.jpg');">
		<h3 class="ltext-103 cl0 txt-center">
			เข้าสู่ระบบ
		</h3>
	</section>	


	<!-- Content page -->
	<section class="bg0 p-t-40 p-b-40">
		<div class="container">
			<div class="flex-w flex-tr justify-content-center">
				<div class="size-210 bor10 p-lr-70 p-t-20 p-b-40 p-lr-15-lg w-full-md">
					<form method="post" action="<?php echo $_SERVER['PHP_SELF'];?>">
						<h4 class="mtext-105 cl2 txt-center p-b-30">
							เข้าสู่ระบบ
						</h4>

						<div class="bor8 m-b-20 how-pos4-parent">
							<input class="stext-111 cl2 plh3 size-116 p-l-62 p-r-30" type="text" name="email" placeholder="อีเมล (E-mail)" required autofocus>
							<img class="how-pos4 pointer-none" src="images/icons/icon-email.png" alt="ICON">
						</div>

						<div class="bor8 m-b-30 how-pos4-parent">
							<input class="stext-111 cl2 plh3 size-116 p-l-62 p-r-30" type="password" name="password" placeholder="รหัสผ่าน (Password)" required>
							<img class="how-pos4 pointer-none" src="images/icons/pass_word.png" alt="ICON">
						</div>

						<button type="submit" id="submit-button" class="flex-c-m stext-101 cl0 size-121 bg3 bor1 hov-btn3 p-lr-15 trans-04 pointer">
							Submit
						</button>
                        
						<div class="m-t-25 m-b-0 txt-right mtext-102">
							<a href="register.php">สมัครสมาชิกใหม่</a>
						</div>
					</form>
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

    $email = $_POST['email'];
    $password = $_POST['password'];

    $stmt = $conn->prepare("SELECT user_id, fullname, phone, address, password, role, email FROM users WHERE email = ?");
    if ($stmt) {
        // ผูกค่ากับ placeholder
        $stmt->bind_param("s", $email);

        // ดำเนินการคำสั่ง
        $stmt->execute();
        $stmt->store_result();

        // ตรวจสอบว่าพบผู้ใช้หรือไม่
        if ($stmt->num_rows > 0) {
            // ผูกผลลัพธ์
            $stmt->bind_result($user_id, $fullname, $phone, $address, $hashed_password, $role, $email);
            $stmt->fetch();

            // ตรวจสอบรหัสผ่าน
            if (password_verify($password, $hashed_password)) {
                //var_dump($role!="customer");exit;
                if($role!="customer"){
                    echo "<script>";
                    //echo "swal('', 'ระบบสำหรับ ไกด์ชุมชน เชฟชุมชน และผู้ขาย กรุณาเข้าที่ระบบหลังบ้านหรือติดต่อแอดมิน', 'warning').then(() => {return false;});";
                    //echo "swal('','ระบบสำหรับ ไกด์ชุมชน เชฟชุมชน และผู้ขาย กรุณาเข้าที่ระบบหลังบ้านหรือติดต่อแอดมิน', 'warning');";
                    echo "alert('ระบบสำหรับ ไกด์ชุมชน เชฟชุมชน และผู้ขาย กรุณาเข้าที่ระบบหลังบ้านหรือติดต่อแอดมิน');";
                    echo "window.location.href = 'sign-in.php';"; 
                    echo "</script>";
                    exit;
                }
                
                // รหัสผ่านถูกต้อง, สร้าง session
                $_SESSION['user_id'] = $user_id;
                $_SESSION['fullname'] = $fullname;
                $_SESSION['phone'] = $phone;
                $_SESSION['address'] = $address;
                $_SESSION['role'] = $role;
                $_SESSION['email'] = $email;
                
                // เปลี่ยนเส้นทางไปที่หน้า index.php
                //header("Location: index.php");
                echo "<script>";
                echo "window.location='index.php';";
                echo "</script>";
                exit();
            } else {
                // รหัสผ่านไม่ถูกต้อง
                //echo "<script>alert('รหัสผ่านไม่ถูกต้อง');</script>";
                echo "<script>";
                echo "swal('','รหัสผ่านไม่ถูกต้อง', 'warning');";
                echo "</script>";
            }
        } else {
            // ไม่มีผู้ใช้ที่อีเมลนี้
            //echo "<script>alert('อีเมลไม่ถูกต้อง');</script>";
                echo "<script>";
                echo "swal('','อีเมลไม่ถูกต้อง', 'warning');";
                echo "</script>";
        }

        $stmt->close();
    } else {
        echo "เกิดข้อผิดพลาดในการเตรียมคำสั่ง SQL: " . $conn->error;
    }

    // ปิดการเชื่อมต่อฐานข้อมูล
    $conn->close();
}
?>

</body>
</html>