<?php
session_start();
include_once("admin92837/functions.php");
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<title>Local Buengkan - สมัครสมาชิกใหม่</title>
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
	<section class="bg-img1 txt-center p-lr-15 p-tb-92" style="background-image: url('images/bg-07.jpg');">
		<h3 class="ltext-103 cl0 txt-center">
			สมัครสมาชิก
		</h3>
	</section>	


	<!-- Content page -->
	<section class="bg0 p-t-40 p-b-40">
		<div class="container">
			<div class="flex-w flex-tr justify-content-center">
				<div class="size-210 bor10 p-lr-70 p-t-20 p-b-40 p-lr-15-lg w-full-md">
					<form method="post" action="<?php echo $_SERVER['PHP_SELF'];?>">
						<h4 class="mtext-105 cl2 txt-center p-b-30">
							ลงทะเบียน
						</h4>

						<div class="bor8 m-b-20 how-pos4-parent">
							<select name="user_type" class="stext-111 cl2 plh3 size-116 p-l-62 p-r-30">
                                <option value="customer">ลูกค้าทั่วไป</option>
                                <option value="guide">ไกด์ชุมชน</option>
                                <option value="chef">เชฟชุมชน</option>
                                <option value="seller">ผู้ขายสินค้า</option>
                            </select>
							<img class="how-pos4 pointer-none" src="images/icons/icon-users.png" alt="ICON">
						</div>

						<div class="bor8 m-b-20 how-pos4-parent">
							<input class="stext-111 cl2 plh3 size-116 p-l-62 p-r-30" type="text" name="fullname" placeholder="ชื่อ-สกุล *" required autofocus>
							<img class="how-pos4 pointer-none" src="images/icons/icon-user.png" alt="ICON">
						</div>

						<div class="bor8 m-b-20 how-pos4-parent">
							<input class="stext-111 cl2 plh3 size-116 p-l-62 p-r-30" type="text" name="phone" placeholder="เบอร์โทรศัพท์ *" required>
							<img class="how-pos4 pointer-none" src="images/icons/icon-phone.png" alt="ICON">
						</div>

						<div class="bor8 m-b-30">
							<textarea class="stext-111 cl2 plh3 size-120 p-lr-28 p-tb-25" name="address" placeholder="ที่อยู่ *" required></textarea>
						</div>
                        
						<div class="bor8 m-b-20 how-pos4-parent">
							<input class="stext-111 cl2 plh3 size-116 p-l-62 p-r-30" type="text" name="email" placeholder="อีเมล (ใช้เป็น Username) *" required>
							<img class="how-pos4 pointer-none" src="images/icons/icon-email.png" alt="ICON">
						</div>

						<div class="bor8 m-b-30 how-pos4-parent">
							<input class="stext-111 cl2 plh3 size-116 p-l-62 p-r-30" type="password" name="password" id="password" placeholder="รหัสผ่าน *" required>
							<img class="how-pos4 pointer-none" src="images/icons/pass_word.png" alt="ICON">
						</div>

						<div class="bor8 m-b-10 how-pos4-parent">
							<input class="stext-111 cl2 plh3 size-116 p-l-62 p-r-30" type="password" name="confirmpassword" id="confirmpassword" placeholder="ยืนยันรหัสผ่าน *" onKeyUp="validatePasswords();" required>
							<img class="how-pos4 pointer-none" src="images/icons/pass_word.png" alt="ICON">
                        </div>
<div id="error-message" style="color: red; font-size: 14px; display: none;" class="m-b-20">
    รหัสผ่านไม่ตรงกัน กรุณาลองอีกครั้ง
</div>          

<script>
function validatePasswords() {
    const password = document.getElementById("password").value;
    const confirmPassword = document.getElementById("confirmpassword").value;
    const errorMessage = document.getElementById("error-message");
    const submitButton = document.getElementById("submit-button");

    if (password !== confirmPassword) {
        errorMessage.style.display = "block";
        submitButton.disabled = true; 
    } else {
        errorMessage.style.display = "none";
        submitButton.disabled = false;
    }
}
</script>
                        
						<button type="submit" id="submit-button" class="flex-c-m stext-101 cl0 size-121 bg3 bor1 hov-btn3 p-lr-15 trans-04 pointer" disabled>
							สมัครสมาชิก
						</button>
                        
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
// สมัครสมาชิกใหม่
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    include_once("connectdb.php");
    $fullname = $_POST['fullname'];
    $phone = $_POST['phone'];
    $address = $_POST['address'];
    $email = $_POST['email'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT); // เข้ารหัสรหัสผ่าน
    $role = $_POST['user_type'];
    $created_at = date("Y-m-d H:i:s");
    //$picture = ""; // ชื่อรูปภาพเริ่มต้น

    // เตรียมคำสั่ง SQL
    $stmt = $conn->prepare("INSERT INTO users (fullname, phone, address, email, password, role, created_at) 
                            VALUES (?, ?, ?, ?, ?, ?, ?)");
    if ($stmt) {
        // ผูกค่ากับ placeholder
        $stmt->bind_param("sssssss", $fullname, $phone, $address, $email, $password, $role, $created_at);

        // ดำเนินการคำสั่ง
        if ($stmt->execute()) {
            // สมัครสมาชิกสำเร็จ
            addLog($conn, "0", "บุคคลทั่วไป", "customer", "สมัครสมาชิกใหม่", "บุคคลทั่วไปสมัครสมาชิกใหม่");
            echo "<script>";
            echo "swal('','สมัครสมาชิกใหม่สำเร็จ', 'success');";
            echo "</script>";
        } else {
            echo "เกิดข้อผิดพลาด: " . $stmt->error;
        }
        $stmt->close();
    } else {
        echo "เกิดข้อผิดพลาดในการเตรียมคำสั่ง SQL: " . $conn->error;
    }
}

// ปิดการเชื่อมต่อฐานข้อมูล
//$conn->close();
?>


</body>
</html>