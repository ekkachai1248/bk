<?php
include_once("checklogin.php");
include_once("connectdb.php");
include_once("admin92837/functions.php");
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<title>Local Buengkan - บัญชีของฉัน</title>
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

	<link rel="stylesheet" type="text/css" href="vendor/perfect-scrollbar/perfect-scrollbar.css">
	<link rel="stylesheet" type="text/css" href="css/util.css">
	<link rel="stylesheet" type="text/css" href="css/main.css">
    
    <!--<link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">-->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Prompt&display=swap" rel="stylesheet">
<style>
    body {
        font-family: "Prompt", serif;
    }
    table {
        font-family: "Prompt", serif;
        font-size: 14px;
    }

</style>
    
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
				บัญชีของฉัน
			</span>
		</div>
	</div>
		

	<!-- Content page -->
	<section class="bg0 p-t-40 p-b-40">
		<div class="container">
			<div class="flex-w flex-tr justify-content-center">
				<div class="size-210 bor10 p-lr-70 p-t-20 p-b-40 p-lr-15-lg w-full-md">
					<form method="post" action="<?php echo $_SERVER['PHP_SELF'];?>" enctype="multipart/form-data">
                        <input type="hidden" name="form_type" value="update_profile">
						<h4 class="mtext-105 cl2 txt-center p-b-30">
							บัญชีของฉัน
						</h4>

						<div class="bor8 m-b-20 how-pos4-parent p-3" style="height: 52px">
							ประเภท: 
                            <?php
                                switch($_SESSION['role']) {
                                    case "customer" : echo "<span class='text-success'>ลูกค้าทั่วไป</span>";break;
                                    case "guide" : echo "<span class='text-success'>ไกด์ชุมชน</span>";break;
                                    case "chef" : echo "<span class='text-success'>เชฟชุมชน</span>";break;
                                    case "seller" : echo "<span class='text-success'>ผู้ขายสินค้า</span>";break;
                                    default: echo "-";
                                }    
                            ?>
                            
						</div>
                        
						<div class="bor8 m-b-20 how-pos4-parent">
							<input class="stext-111 cl2 plh3 size-116 p-l-62 p-r-30" type="text" name="email" placeholder="อีเมล (ใช้เป็น Username) *" value="<?php echo $_SESSION['email'];?>" required readonly style="background: #eeeeee">
							<img class="how-pos4 pointer-none" src="images/icons/icon-email.png" alt="ICON">
						</div>

						<div class="bor8 m-b-20 how-pos4-parent">
							<input class="stext-111 cl2 plh3 size-116 p-l-62 p-r-30" type="text" name="fullname" placeholder="ชื่อ-สกุล *" value="<?php echo $_SESSION['fullname'];?>" required>
							<img class="how-pos4 pointer-none" src="images/icons/icon-user.png" alt="ICON">
						</div>

						<div class="bor8 m-b-20 how-pos4-parent">
							<input class="stext-111 cl2 plh3 size-116 p-l-62 p-r-30" type="text" name="phone" placeholder="เบอร์โทรศัพท์ *" value="<?php echo $_SESSION['phone'];?>" required>
							<img class="how-pos4 pointer-none" src="images/icons/icon-phone.png" alt="ICON">
						</div>

						<div class="bor8 m-b-30">
							<textarea class="stext-111 cl2 plh3 size-110 p-lr-28 p-tb-25" name="address" placeholder="ที่อยู่ *" required><?php echo $_SESSION['address'];?></textarea>
						</div>
                        
<div class="bor8 m-b-10 how-pos4-parent">
    <input class="stext-111 cl2 plh3 size-116 p-l-62 p-r-30" 
           type="file" 
           name="profile_picture" 
           id="profile_picture"
           accept="image/*"
           onchange="previewImage(event)" 
           placeholder="รูปโปรไฟล์ *" 
           title="รูปโปรไฟล์">
</div>

<div class="m-b-20 how-pos4-parent">
    รูปโปรไฟล์<br>
    <?php                   
    $sql = "SELECT * FROM users WHERE user_id = '{$_SESSION['user_id']}' ";
    $result = $conn->query($sql);                               
    $row = $result->fetch_assoc();

    $profile_picture = !empty($row['picture']) ? "images/users/{$row['picture']}" : "images/users/0.jpg";
    ?>
    <img id="profilePreview" src="<?php echo $profile_picture; ?>" width="110">
</div>

<script>
function previewImage(event) {
    var reader = new FileReader();
    reader.onload = function(){
        var output = document.getElementById('profilePreview');
        output.src = reader.result;
    };
    reader.readAsDataURL(event.target.files[0]);
}
</script>
                        
						<button type="submit" id="submit-button" class="flex-c-m stext-101 cl0 size-121 bg3 bor1 hov-btn3 p-lr-15 trans-04 pointer">
							แก้ไขข้อมูล
						</button>
                        
					</form>
				</div>
                
                
                <!-- แก้ไขรหัสผ่าน -->
                <div class="size-210 bor10 p-lr-70 p-t-20 p-b-40 p-lr-15-lg w-full-md">
					<form method="post" action="<?php echo $_SERVER['PHP_SELF'];?>">
                        <input type="hidden" name="form_type" value="change_password">
						<h4 class="mtext-105 cl2 txt-center p-b-30">
							แก้ไขรหัสผ่าน
						</h4>
                        
<div class="bor8 m-b-20 how-pos4-parent">
        <input class="stext-111 cl2 plh3 size-116 p-l-62 p-r-30" type="password" name="current_password" placeholder="รหัสผ่านเดิม *" required>
        <img class="how-pos4 pointer-none" src="images/icons/pass_word.png" alt="ICON">
    </div>

    <div class="bor8 m-b-20 how-pos4-parent">
        <input class="stext-111 cl2 plh3 size-116 p-l-62 p-r-30" type="password" name="new_password" placeholder="รหัสผ่านใหม่ *" required>
        <img class="how-pos4 pointer-none" src="images/icons/pass_word.png" alt="ICON">
    </div>

    <div class="bor8 m-b-20 how-pos4-parent">
        <input class="stext-111 cl2 plh3 size-116 p-l-62 p-r-30" type="password" name="confirm_password" placeholder="ยืนยันรหัสผ่านใหม่ *" required>
        <img class="how-pos4 pointer-none" src="images/icons/pass_word.png" alt="ICON">
    </div>

    <button type="submit" class="flex-c-m stext-101 cl0 size-121 bg3 bor1 hov-btn3 p-lr-15 trans-04 pointer">
        เปลี่ยนรหัสผ่าน
    </button>
                        
					</form>
				</div>

			</div>
		</div>
	</section>	
	
    

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
	<script src="vendor/sweetalert/sweetalert.min.js"></script>
<!--===============================================================================================-->
	<script src="vendor/perfect-scrollbar/perfect-scrollbar.min.js"></script>
    
	<script src="js/main.js"></script>
<script src="vendor/sweetalert/sweetalert.min.js"></script>
    
<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if ($_POST['form_type'] == 'update_profile') {
        $fullname = $_POST['fullname'];
        $phone = $_POST['phone'];
        $address = $_POST['address'];
        $user_id = $_SESSION['user_id'];
        $profile_picture = ""; // กำหนดค่าเริ่มต้น
        
        // ตรวจสอบว่ามีไฟล์อัปโหลดมาหรือไม่
        if (!empty($_FILES['profile_picture']['name'])) {
            $target_dir = "images/users/";
            $file_extension = pathinfo($_FILES["profile_picture"]["name"], PATHINFO_EXTENSION);
            $new_filename = $user_id . "." . $file_extension;
            $target_file = $target_dir . $new_filename;

            // ตรวจสอบชนิดของไฟล์ (อนุญาตเฉพาะ JPG, JPEG, PNG)
            $allowed_types = ['jpg', 'jpeg', 'png', 'gif'];
            if (!in_array(strtolower($file_extension), $allowed_types)) {
                echo "<script>alert('อัปโหลดได้เฉพาะไฟล์ JPG, JPEG, PNG, GIF เท่านั้น');</script>";
                exit();
            }

            // อัปโหลดไฟล์
            if (move_uploaded_file($_FILES["profile_picture"]["tmp_name"], $target_file)) {
                $profile_picture = $new_filename;
            } else {
                echo "<script>alert('เกิดข้อผิดพลาดในการอัปโหลดรูปภาพ');</script>";
                exit();
            }
        }

        // อัปเดตข้อมูลโปรไฟล์
        if (!empty($profile_picture)) {
            // ถ้ามีการอัปโหลดรูปใหม่ ให้เพิ่ม `picture` เข้าไปในคำสั่ง SQL
            $stmt = $conn->prepare("UPDATE users SET fullname = ?, phone = ?, address = ?, picture = ? WHERE user_id = ?");
            if ($stmt) {
                $stmt->bind_param("ssssi", $fullname, $phone, $address, $profile_picture, $user_id);
            }
        } else {
            // ถ้าไม่มีการอัปโหลดรูปใหม่ ให้ใช้รูปเดิมโดยไม่อัปเดตฟิลด์ `picture`
            $stmt = $conn->prepare("UPDATE users SET fullname = ?, phone = ?, address = ? WHERE user_id = ?");
            if ($stmt) {
                $stmt->bind_param("sssi", $fullname, $phone, $address, $user_id);
            }
        }

        if ($stmt && $stmt->execute()) {
            // อัปเดตค่าที่ Session ด้วย
            $_SESSION['fullname'] = $fullname;
            $_SESSION['phone'] = $phone;
            $_SESSION['address'] = $address;
            if (!empty($profile_picture)) {
                $_SESSION['picture'] = $profile_picture;
            }

            echo "<script>";
            echo "swal('', 'แก้ไขข้อมูลส่วนตัวสำเร็จ', 'success').then(() => {";
            echo "window.location.href = 'myaccount.php';";
            echo "});";
            echo "</script>";
        } else {
            echo "เกิดข้อผิดพลาด: " . ($stmt ? $stmt->error : $conn->error);
        }

        if ($stmt) {
            $stmt->close();
        }
    }
}
?>
    
    
<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
 if ($_POST['form_type'] == 'change_password') {
    $user_id = $_SESSION['user_id'];
    $current_password = $_POST['current_password'];
    $new_password = $_POST['new_password'];
    $confirm_password = $_POST['confirm_password'];

    // ตรวจสอบรหัสผ่านเดิม
    $result = $conn->prepare("SELECT password FROM users WHERE user_id = ?");
    $result->bind_param("i", $user_id);
    $result->execute();
    $result->bind_result($stored_password);
    $result->fetch();
    $result->close();

    if (password_verify($current_password, $stored_password)) {
        if ($new_password === $confirm_password) {
            // อัปเดตรหัสผ่าน
            $hashed_password = password_hash($new_password, PASSWORD_DEFAULT);
            $stmt = $conn->prepare("UPDATE users SET password = ? WHERE user_id = ?");
            if ($stmt) {
                $stmt->bind_param("si", $hashed_password, $user_id);
                if ($stmt->execute()) {
                    echo "<script>";
                    echo "swal('', 'เปลี่ยนรหัสผ่านสำเร็จ', 'success').then(() => {";
                    echo "window.location.href = 'myaccount.php';";
                    echo "});";
                    echo "</script>";
                } else {
                    echo "เกิดข้อผิดพลาด: " . $stmt->error;
                }
                $stmt->close();
            } else {
                echo "เกิดข้อผิดพลาดในการเตรียมคำสั่ง SQL: " . $conn->error;
            }
        } else {
            echo "<script>swal('', 'รหัสผ่านใหม่ไม่ตรงกัน', 'error');</script>";
        }
    } else {
        echo "<script>swal('', 'รหัสผ่านเดิมไม่ถูกต้อง', 'error');</script>";
    }
 }
}
?>
    
</body>
</html>