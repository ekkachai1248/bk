<?php
include_once("checklogin.php");
include_once("../connectdb.php");
include_once("functions.php");

$sql = "SELECT * FROM users WHERE user_id='{$_SESSION['buser_id']}' ";
$result = $conn->query($sql);
$row = $result->fetch_assoc();
?>
<!DOCTYPE html>

<html lang="en" dir="ltr">
  <head>
  <meta charset="utf-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />

  <title>Local buengkan - ไกด์ชุมชน</title>

  <!-- GOOGLE FONTS -->
  <link href="https://fonts.googleapis.com/css?family=Prompt&family=Karla:400,700|Roboto" rel="stylesheet">
  <link href="plugins/material/css/materialdesignicons.min.css" rel="stylesheet" />
  <link href="plugins/simplebar/simplebar.css" rel="stylesheet" />

  <!-- PLUGINS CSS STYLE -->
  <link href="plugins/nprogress/nprogress.css" rel="stylesheet" />
  
  <link href="plugins/toaster/toastr.min.css" rel="stylesheet" />
  
  <!-- MONO CSS -->
  <link id="main-css-href" rel="stylesheet" href="css/style.css" />

  <!-- FAVICON -->
  <link href="images/favicon.png" rel="shortcut icon" />

  <!--
    HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries
  -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->
  <script src="plugins/nprogress/nprogress.js"></script>
      
<style>
    body{
        font-family: "Prompt", serif;
    }      
</style>
</head>


  <body class="navbar-fixed sidebar-fixed" id="body">
    <script>
      NProgress.configure({ showSpinner: false });
      NProgress.start();
    </script>

    

    <!-- ====================================
    ——— WRAPPER
    ===================================== -->
    <div class="wrapper">
      
<?php include("left-sidebar-guide.php"); ?>      

      <!-- ====================================
      ——— PAGE WRAPPER
      ===================================== -->
      <div class="page-wrapper">
        
<?php include("header.php"); ?>

        <!-- ====================================
        ——— CONTENT WRAPPER
        ===================================== -->
        <div class="content-wrapper">
          <div class="content">
              
<nav aria-label="breadcrumb" class="my-0 m-0">
    <ol class="breadcrumb">
      <li class="breadcrumb-item">  <a href="home_guide.php">หน้าหลัก  </a>  </li>
      <li class="breadcrumb-item active" aria-current="page">ข้อมูลส่วนตัว  </li>
    </ol>
  </nav>
              
<div class="container col-md-6">
    <div class="justify-content-center">
<div class="card card-default card-profile">

  <div class="card-body mt-6 justify-content-center text-center">

    <div class="profile-avata">
      <img class="user-image rounded-circle" src="../images/users/<?php echo $row['picture'];?>" alt="<?php echo $row['fullname'];?>" title="<?php echo $row['fullname'];?>" width="110">
      <span class="h5 d-block mt-3 mb-2"><?php echo $row['fullname'];?></span>
      <span class="d-block mb-4"><?php echo $row['role'];?></span>


<form method="post" action="<?php echo $_SERVER['PHP_SELF'];?>" enctype="multipart/form-data">
<div class="text-left">
          <div class="form-group">
            <label for="u_name">ชื่อ-สกุล *</label>
            <input type="text" class="form-control" id="u_name" name="u_name" placeholder="ชื่อ-สกุล" value="<?php echo $row['fullname'];?>" required>
          </div>
          <div class="form-group">
            <label for="u_phone">เบอร์โทรศัพท์ *</label>
            <input type="text" class="form-control" id="u_phone" name="u_phone" placeholder="เบอร์โทรศัพท์" value="<?php echo $row['phone'];?>" required>
          </div>
          <div class="form-group">
            <label for="u_address">ที่อยู่</label>
            <textarea class="form-control" id="u_address" name="u_address" rows="3" placeholder="ที่อยู่"><?php echo $row['address'];?></textarea>
          </div>
          <div class="form-group">
            <label for="u_email">อีเมล (ใช้เป็น Username) *</label>
            <input type="text" class="form-control" id="u_email" name="u_email" placeholder="อีเมล" value="<?php echo $row['email'];?>" readonly required>
          </div>

            
<div class="form-group mt-2">
    <label for="u_pictures">รูปภาพ</label>
    <input type="file" class="form-control-file" id="u_pictures" name="u_pictures">
</div>
<div id="preview" style="display: flex; gap: 10px; flex-wrap: wrap;">
    <img src="../images/users/<?php echo $row['picture']; ?>" id="currentImage" style="width: 150px; height: 150px; object-fit: cover; border: 1px solid #ddd; border-radius: 5px;">
</div>

<script>
    const fileInput = document.getElementById('u_pictures');
    const preview = document.getElementById('preview');
    const currentImage = document.getElementById('currentImage');

    fileInput.addEventListener('change', function(event) {
        const files = event.target.files;
        if (files.length > 0) {
            const file = files[0];
            if (file.type.startsWith('image/')) { 
                const reader = new FileReader();
                reader.onload = function(e) {
                    currentImage.src = e.target.result;
                };
                reader.readAsDataURL(file);
            }
        }
    });
</script>

      <div class="form-footer mt-3">
          <input type="hidden" name="action" value="update_user">
          <input type="hidden" name="current_picture" id="current_picture" value="<?php echo $row['picture'];?>">
          <input type="hidden" name="user_id" value="<?php echo $_SESSION['buser_id'];?>">
        <button type="reset" class="btn btn-warning" data-dismiss="modal">ยกเลิก</button>
        <button type="submit" id="submit-button" class="btn btn-primary"><i class="mdi mdi-content-save"></i> บันทึก</button>
      </div>
    
</div>            
</form>

        
    </div>

  </div>

</div>
    </div> 
</div>

              
<div class="container col-md-6">
    <div class="justify-content-center">
<div class="card card-default card-profile">

  <div class="card-body mt-6 justify-content-center text-center">

    <div class="profile-avata">

<form method="post" action="<?php echo $_SERVER['PHP_SELF'];?>">
<div class="text-left">
    
          <div class="form-group">
            <label for="u_password_old">รหัสผ่านเดิม *</label>
            <input type="password" class="form-control" id="u_password_old" name="u_password_old" placeholder="รหัสผ่านเดิม" required>
          </div>
          <div class="form-group">
            <label for="u_password_new">รหัสผ่านใหม่ *</label>
            <input type="password" class="form-control" id="u_password_new" name="u_password_new" placeholder="รหัสผ่านใหม่" required>
          </div>
          <div class="form-group">
            <label for="confirmpassword">ยืนยันรหัสผ่านใหม่ *</label>
            <input type="password" class="form-control" id="confirmpassword" name="confirmpassword" placeholder="ยืนยันรหัสผ่านใหม่" onKeyUp="validatePasswords();" required>
          </div>
<div id="error-message" style="color: red; font-size: 14px; display: none;" class="mb-3">
    ยืนยันรหัสผ่านไม่ตรงกัน กรุณาลองอีกครั้ง
</div>      
<script>
function validatePasswords() {
    const password = document.getElementById("u_password_new").value;
    const confirmPassword = document.getElementById("confirmpassword").value;
    const errorMessage = document.getElementById("error-message");
    const submitButton = document.getElementById("submit-button-chgpwd");

    if (password !== confirmPassword) {
        errorMessage.style.display = "block";
        submitButton.disabled = true; 
    } else {
        errorMessage.style.display = "none";
        submitButton.disabled = false;
    }
}
</script>
            
      <div class="form-footer">
          <input type="hidden" name="action" value="update_password">
        <button type="submit" id="submit-button-chgpwd" class="btn btn-primary"><i class="mdi mdi-content-save"></i> บันทึกการเปลี่ยนรหัสผ่าน</button>
      </div>
    
</div>            
</form>

        
    </div>

  </div>

</div>
    </div> 
</div>
              
</div>
          
        </div>
        
<?php include("footer.php")?>
      </div>
    </div>
    
    
                    <script src="plugins/jquery/jquery.min.js"></script>
                    <script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
                    <script src="plugins/simplebar/simplebar.min.js"></script>
                    <script src="https://unpkg.com/hotkeys-js/dist/hotkeys.min.js"></script>
                    
    <script src="../vendor/sweetalert/sweetalert.min.js"></script>
                    
                    <script src="js/mono.js"></script>
                    <script src="js/chart.js"></script>
                    <script src="js/map.js"></script>
                    <script src="js/custom.js"></script>

      
<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action']) && $_POST['action'] === 'update_user') {
    $userId = $_POST['user_id']; 
    $userName = $_POST['u_name'];
    $userPhone = $_POST['u_phone'];
    $userAddress = $_POST['u_address'];
    $userEmail = $_POST['u_email'];
    $userPicture = $_POST['current_picture']; // ค่าเริ่มต้นคือรูปเดิม

    // ประเภทไฟล์ที่อนุญาต
    $allowedTypes = ['jpg', 'jpeg', 'png', 'gif', 'webp'];

    if (isset($_FILES['u_pictures']) && $_FILES['u_pictures']['error'] === UPLOAD_ERR_OK) {
        $uploadedFile = $_FILES['u_pictures'];
        $uploadDirectory = "../images/users/";
        $fileExtension = strtolower(pathinfo($uploadedFile['name'], PATHINFO_EXTENSION)); // นามสกุลไฟล์

        // ตรวจสอบประเภทไฟล์
        if (!in_array($fileExtension, $allowedTypes)) {
            die("Error: Only " . implode(", ", $allowedTypes) . " files are allowed.");
        }

        $fileName = $userId . '.' . $fileExtension; // เปลี่ยนชื่อตาม user_id และนามสกุลไฟล์
        $uploadFilePath = $uploadDirectory . $fileName;

        // ตรวจสอบโฟลเดอร์ก่อนอัปโหลด
        if (!is_dir($uploadDirectory)) {
            die("Error: Upload directory does not exist.");
        }

        // ย้ายไฟล์ที่อัปโหลด
        if (move_uploaded_file($uploadedFile['tmp_name'], $uploadFilePath)) {
            $userPicture = $fileName; // ใช้รูปภาพใหม่
        } else {
            die("Error: Failed to move uploaded file.");
        }
    }

    // อัปเดตข้อมูลในฐานข้อมูล
    $sql = "UPDATE users SET fullname = ?, phone = ?, address = ?, email = ?, picture = ? WHERE user_id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sssssi", $userName, $userPhone, $userAddress, $userEmail, $userPicture, $userId);

    if ($stmt->execute()) {
        addLog($conn, $_SESSION['buser_id'], $_SESSION['bfullname'], $_SESSION['brole'], "แก้ไขข้อมูลส่วนตัว", "แก้ไขข้อมูลส่วนตัวของตนเอง");
        echo "<script>swal('', 'อัปเดตข้อมูลสำเร็จ!', 'success'); window.location.href='myprofile_guide.php';</script>";
    } else {
        echo "<script>swal('', 'เกิดข้อผิดพลาดในการอัปเดตข้อมูล!', 'error');</script>";
    }
}
?>
      
   
      
<!-- เปลี่ยนรหัสผ่าน -->
<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action']) && $_POST['action'] === 'update_password') {
    // ดึงข้อมูลจากฟอร์ม
    $userId = $_SESSION['buser_id']; // สมมติว่ามี user_id ใน session
    $passwordOld = $_POST['u_password_old'];
    $passwordNew = $_POST['u_password_new'];
    $confirmPassword = $_POST['confirmpassword'];

    // ตรวจสอบว่ารหัสผ่านใหม่และยืนยันรหัสผ่านตรงกัน
    if ($passwordNew !== $confirmPassword) {
        echo "<script>alert('รหัสผ่านใหม่ไม่ตรงกัน');</script>";
        exit;
    }

    // คำสั่ง SQL เพื่อดึงรหัสผ่านเดิมจากฐานข้อมูล
    $sql = "SELECT password FROM users WHERE user_id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $userId);
    $stmt->execute();
    $stmt->bind_result($hashedPassword);
    $stmt->fetch();
    $stmt->close();

    // ตรวจสอบว่ารหัสผ่านเดิมที่กรอกถูกต้องหรือไม่
    if (!password_verify($passwordOld, $hashedPassword)) {
        echo "<script>swal('', 'รหัสผ่านเดิมไม่ถูกต้อง', 'error');</script>";
        exit;
    }

    // แฮชรหัสผ่านใหม่
    $newHashedPassword = password_hash($passwordNew, PASSWORD_DEFAULT);

    // อัปเดตรหัสผ่านใหม่ในฐานข้อมูล
    $updateSql = "UPDATE users SET password = ? WHERE user_id = ?";
    $updateStmt = $conn->prepare($updateSql);
    $updateStmt->bind_param("si", $newHashedPassword, $userId);

    if ($updateStmt->execute()) {
        addLog($conn, $_SESSION['buser_id'], $_SESSION['bfullname'], $_SESSION['brole'], "แก้ไขรหัสผ่าน", "แก้ไขรหัสผ่านของตนเอง");
        echo "<script>swal('', 'เปลี่ยนรหัสผ่านสำเร็จ!', 'success'); window.location.href='myprofile_guide.php';</script>";
    } else {
        echo "<script>swal('', 'เกิดข้อผิดพลาดในการเปลี่ยนรหัสผ่าน', 'error');</script>";
    }

    $updateStmt->close();
}
?>

      
  </body>
</html>
