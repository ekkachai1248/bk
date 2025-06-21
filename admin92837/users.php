<?php
include_once("checklogin.php");
include_once("functions.php");
?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
  <meta charset="utf-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />

    <meta http-equiv="Cache-Control" content="no-store, no-cache, must-revalidate, post-check=0, pre-check=0" />
    <meta http-equiv="Pragma" content="no-cache" />
    <meta http-equiv="Expires" content="0" />
      
  <title>Local buengkan - Admin</title>

  <!-- GOOGLE FONTS -->
  <link href="https://fonts.googleapis.com/css?family=Prompt&family=Karla:400,700|Roboto" rel="stylesheet">
  <link href="plugins/material/css/materialdesignicons.min.css" rel="stylesheet" />
  <link href="plugins/simplebar/simplebar.css" rel="stylesheet" />

  <!-- PLUGINS CSS STYLE -->
  <link href="plugins/nprogress/nprogress.css" rel="stylesheet" />
  
  <link href="plugins/prism/prism.css" rel="stylesheet" />
  
    <script src="plugins/jquery/jquery.min.js"></script>
    <script src="plugins/toaster/toastr.min.js"></script>
    <link href="plugins/toaster/toastr.min.css" rel="stylesheet">

  <link href="plugins/DataTables/DataTables-1.10.18/css/jquery.dataTables.min.css" rel="stylesheet" />
      

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
      
<?php include("left-sidebar.php"); ?>      

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
      <li class="breadcrumb-item">  <a href="index2.php">หน้าหลัก  </a>  </li>
      <li class="breadcrumb-item active" aria-current="page">ผู้ใช้งาน  </li>
    </ol>
  </nav>

 <div class="card card-default border-0 bg-transparent">
  <div class="card-header align-items-center p-0">
    <h2></h2> 
    <a href="#" class="btn btn-success" data-toggle="modal" data-target="#ModalFormAdd">
      <i class="mdi mdi-plus mr-1"></i> เพิ่มผู้ใช้งาน
    </a>
  </div>
</div>
              
<!-- Users -->
<div class="card card-default">
  <div class="card-header">
    <h2><i class="mdi mdi-account-group"></i> ผู้ใช้งาน</h2>
     
      <div class="row text-right">
      ประเภทผู้ใช้งาน &nbsp; 
           <button class="btn btn-primary btn-sm category-btn" data-category="all">แสดงทั้งหมด</button>&nbsp;
<?php
$user_type = array('admin', 'chef', 'customer','guide','seller');
foreach($user_type as $utype){
?>
					<button class="btn btn-outline-info btn-sm category-btn" data-category="<?=$utype;?>">
						<?=$utype;?>
					</button>&nbsp; 
<?php } ?>
</div>
  </div>
    
  <div class="card-body">
    <table id="usersTable" class="table table-hover table-product" style="width:100%" cellpadding="20">
      <thead>
        <tr>
          <th>Actions</th>
          <th>สถานะทำงาน</th>
          <th>รูป</th>
          <th>ชื่อ-สกุล</th>
          <th>อีเมล (Username)</th>
          <th>Role</th>
          <th>การเข้าใช้ระบบ</th>
        </tr>
      </thead>
      <tbody>
<?php
include_once("../connectdb.php");
$sql = "SELECT * FROM users ORDER BY user_id DESC ";
$result = $conn->query($sql);
while ($row = $result->fetch_assoc()){    
?>
        <tr>
          <td>
    <?php if($row['role']!='admin'){  ?>
              <a href="#" class="btn btn-warning btn-sm pr-3 pl-3" title="แก้ไข" data-toggle="modal" data-target="#ModalFormUpdate" data-id="<?php echo $row['user_id'];?>" data-name="<?php echo $row['fullname'];?>" data-phone="<?php echo $row['phone'];?>" data-address="<?php echo $row['address'];?>" data-email="<?php echo $row['email'];?>" data-role="<?php echo $row['role'];?>" data-picture="<?php echo $row['picture'];?>"><i class="mdi mdi-lead-pencil"></i></a>
              
              <a href="#" class="btn btn-info btn-sm pr-3 pl-3" title="เปลี่ยนรหัสผ่าน" data-toggle="modal" data-target="#ModalFormUpdatePwd" data-id="<?php echo $row['user_id'];?>" data-name="<?php echo $row['fullname'];?>"><i class="mdi mdi-key"></i></a>
              
              <a href="#" class="btn btn-danger btn-sm pr-3 pl-3" title="ลบ" data-toggle="modal" data-target="#deleteModal" data-id="<?php echo $row['user_id']; ?>" data-name="<?php echo $row['fullname']; ?>"><i class="mdi mdi-delete-forever"></i></a>
    <?php } else { echo"&nbsp;";}?>   
          </td>
          <td>
<?php if($row['role']!='admin'){  ?>
<label class="switch switch-icon switch-success form-control-label mt-1">
  <input type="checkbox" class="switch-input form-check-input" value="active" <?php echo ($row['available'] === 'active') ? 'checked' : ''; ?> data-id="<?php echo $row['user_id']; ?>" />
  <span class="switch-label"></span>
  <span class="switch-handle"></span>
</label>
<?php } else { echo"&nbsp;";}?>         
          </td>
          <td><img src="../images/users/<?php echo $row['picture'];?>" class="user-image rounded-circle"></td>
          <td><?php echo $row['fullname'];?></td>
          <td><?php echo $row['email'];?></td>
          <td><?php echo $row['role'];?></td>
          <td>
<?php if($row['role']!='admin'){  ?>
<label class="switch switch-outline-alt-success form-control-label mt-1">
  <input type="checkbox" class="switch-input form-check-input" value="enable" <?php echo ($row['enable'] === 'enable') ? 'checked' : ''; ?> data-id="<?php echo $row['user_id']; ?>" />
  <span class="switch-label"></span>
  <span class="switch-handle"></span>
</label>
<?php } else { echo"&nbsp;";}?>
          </td>
        </tr>
<?php } ?>
      </tbody>
    </table>

  </div>
</div>
                         
    
<div class="modal fade" id="ModalFormAdd" tabindex="-1" role="dialog" aria-labelledby="exampleModalFormTitle"
  aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalFormTitle"><i class="mdi mdi-plus"></i>เพิ่มผู้ใช้งาน</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
        
    <form method="post" action="<?=$_SERVER['PHP_SELF']?>" enctype="multipart/form-data">  
      <div class="modal-body">
          
          <div class="form-group">
            <label for="u_role">ประเภทผู้ใช้งาน</label>
            <select class="form-control" id="u_role" name="u_role">
                <option value="customer">ลูกค้าทั่วไป</option>
                <option value="guide">ไกด์ชุมชน</option>
                <option value="chef">เชฟชุมชน</option>
                <option value="seller">ผู้ขายสินค้า</option>
              </select>
          </div>
          
          <div class="form-group">
            <label for="u_name">ชื่อ-สกุล *</label>
            <input type="text" class="form-control" id="u_name" name="u_name" placeholder="ชื่อ-สกุล" required>
          </div>
          <div class="form-group">
            <label for="u_phone">เบอร์โทรศัพท์ *</label>
            <input type="text" class="form-control" id="u_phone" name="u_phone" placeholder="เบอร์โทรศัพท์" required>
          </div>
          <div class="form-group">
            <label for="u_address">ที่อยู่</label>
            <textarea class="form-control" id="u_address" name="u_address" rows="4" placeholder="ที่อยู่"></textarea>
          </div>
          <div class="form-group">
            <label for="u_email">อีเมล (ใช้เป็น Username) *</label>
            <input type="text" class="form-control" id="u_email" name="u_email" placeholder="อีเมล" required>
          </div>
          <div class="form-group">
            <label for="u_password">รหัสผ่าน *</label>
            <input type="password" class="form-control" id="u_password" name="u_password" placeholder="รหัสผ่าน" required>
          </div>
          <div class="form-group">
            <label for="confirmpassword">ยืนยันรหัสผ่าน *</label>
            <input type="password" class="form-control" id="confirmpassword" name="confirmpassword" placeholder="ยืนยันรหัสผ่าน" onKeyUp="validatePasswords();" required>
          </div>
<div id="error-message" style="color: red; font-size: 14px; display: none;" class="m-b-20">
    รหัสผ่านไม่ตรงกัน กรุณาลองอีกครั้ง
</div>      
<script>
function validatePasswords() {
    const password = document.getElementById("u_password").value;
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
            
<div class="form-group mt-2">
    <label for="u_pictures">รูปภาพ</label>
    <input type="file" class="form-control-file" id="u_pictures" name="u_pictures"  required>
</div>
<div id="preview" style="display: flex; gap: 10px; flex-wrap: wrap;"></div>

<script>
    document.getElementById('u_pictures').addEventListener('change', function(event) {
        const preview = document.getElementById('preview');
        preview.innerHTML = '';
        const files = event.target.files;

        Array.from(files).forEach(file => {
            if (file.type.startsWith('image/')) { // ตรวจสอบว่าเป็นไฟล์รูปภาพ
                const reader = new FileReader();
                reader.onload = function(e) {
                    const img = document.createElement('img');
                    img.src = e.target.result;
                    img.style.width = '150px';
                    img.style.height = '150px';
                    img.style.objectFit = 'cover'; // ปรับให้รูปพอดีกับกรอบ
                    img.style.border = '1px solid #ddd';
                    img.style.borderRadius = '5px';
                    preview.appendChild(img);
                };
                reader.readAsDataURL(file); // แปลงไฟล์เป็น Data URL
            }
        });
    });
</script>

          <div class="form-footer mt-6">
            <input type="hidden" name="action" value="add_user">
          </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="mdi mdi-cancel"></i> ยกเลิก</button>
        <button type="submit" id="submit-button" class="btn btn-primary"><i class="mdi mdi-content-save"></i> บันทึก</button>
      </div>
    </form>
        
    </div>
  </div>
</div>              
              
</div>
          
        </div>
        
<?php include("footer.php"); ?>
          
      </div>
    </div>

                    <script src="plugins/jquery/jquery.min.js"></script>
                    <script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
                    <script src="plugins/simplebar/simplebar.min.js"></script>
                    <script src="https://unpkg.com/hotkeys-js/dist/hotkeys.min.js"></script>
                    
                    <script src="plugins/prism/prism.js"></script>
                    
                    <script src="plugins/DataTables/DataTables-1.10.18/js/jquery.dataTables.min.js"></script>
                    
                    <script src="plugins/apexcharts/apexcharts.js"></script>
                    
                    <script src="js/mono.js"></script>
                    <script src="js/chart.js"></script>
                    <script src="js/map.js"></script>
                    <script src="js/custom.js"></script>
      
      <script src="../vendor/sweetalert/sweetalert.min.js"></script>
      

<?php
// เพิ่มผู้ใช้งาน
if ($_SERVER["REQUEST_METHOD"] == "POST" && $_POST['action'] == "add_user") {
    include_once("../connectdb.php");
    
    // ดึงข้อมูลจากฟอร์มและกรองข้อมูล
    $u_name = $conn->real_escape_string($_POST['u_name']);
    $u_phone = $conn->real_escape_string($_POST['u_phone']);
    $u_address = $conn->real_escape_string($_POST['u_address']);
    $u_email = $conn->real_escape_string($_POST['u_email']);
    $password = password_hash($_POST['u_password'], PASSWORD_DEFAULT);
    $u_role = $conn->real_escape_string($_POST['u_role']);
    $created_at = date("Y-m-d H:i:s");

    $uploadDir = "../images/users/"; 
    $u_picture = ""; // ชื่อไฟล์สุดท้ายที่จะบันทึก

    // เพิ่มข้อมูลผู้ใช้งานลงในฐานข้อมูล
    $sql = "INSERT INTO users (fullname, phone, address, email, password, role, created_at, available, enable) 
            VALUES ('$u_name', '$u_phone', '$u_address', '$u_email', '$password', '$u_role', '$created_at', 'active', 'enable')";

    if ($conn->query($sql) === TRUE) {
        $lastId = $conn->insert_id; // ดึง ID ผู้ใช้งานล่าสุดที่เพิ่มเข้าไป
        
        addLog($conn, $_SESSION['buser_id'], $_SESSION['bfullname'], $_SESSION['brole'], "เพิ่มผู้ใช้", "เพิ่มผู้ใช้ User ID: {$lastId} {$u_name}");

        // ตรวจสอบการอัปโหลดรูปภาพ
        if (isset($_FILES['u_pictures']) && $_FILES['u_pictures']['error'] == 0) {
            $fileName = basename($_FILES['u_pictures']['name']);
            $fileType = strtolower(pathinfo($fileName, PATHINFO_EXTENSION));
            $allowedTypes = ['jpg', 'jpeg', 'png', 'gif', 'webp'];

            // ตรวจสอบว่าประเภทไฟล์ถูกต้องหรือไม่
            if (in_array($fileType, $allowedTypes)) {
                $newFileName = $lastId . "." . $fileType; // ชื่อไฟล์ใหม่ (ใช้ user_id)
                $targetFile = $uploadDir . $newFileName;

                // ย้ายไฟล์ไปยังโฟลเดอร์อัปโหลด
                if (move_uploaded_file($_FILES['u_pictures']['tmp_name'], $targetFile)) {
                    $u_picture = $newFileName;

                    // อัปเดตชื่อไฟล์ในฐานข้อมูล
                    $updateSql = "UPDATE users SET picture='$u_picture' WHERE user_id='$lastId'";
                    if ($conn->query($updateSql) === TRUE) {
                        //echo "<script>toastr.success('เพิ่มข้อมูลสำเร็จ!');window.location.href='users.php';</script>";
                        echo "<script>
                                toastr.success('เพิ่มข้อมูลสำเร็จ!');
                                setTimeout(function() {
                                    window.location.href='users.php';
                                }, 2000); 
                            </script>";
                    } else {
                        echo "<script>toastr.error('อัปเดตรูปภาพไม่สำเร็จ: " . $conn->error . "')</script>";
                    }
                } else {
                    echo "<script>toastr.error('ไม่สามารถอัปโหลดไฟล์รูปภาพได้')</script>";
                }
            } else {
                echo "<script>toastr.error('ประเภทไฟล์ไม่ถูกต้อง: $fileType')</script>";
            }
        }
    } else {
        echo "<script>toastr.error('เพิ่มข้อมูลไม่สำเร็จ: " . $conn->error . "')</script>";
    }
}
?>


<!-- Modal ลบ user -->
<div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="deleteModalLabel">ยืนยันการลบข้อมูล</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <p>คุณต้องการลบ  "<span id="userFullname"></span>" ใช่หรือไม่ ?</p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-success" data-dismiss="modal">ยกเลิก</button>
        <button type="button" class="btn btn-danger" id="confirmDelete">ลบ</button>
      </div>
    </div>
  </div>
</div>
      
<!-- Script ลบ user -->
<script>
  $('#deleteModal').on('show.bs.modal', function (event) {
    var button = $(event.relatedTarget);
    var userId = button.data('id');
    $('#userFullname').text(button.data('name'));

    $('#confirmDelete').off('click').on('click', function () {
      $.post('delete_user.php', { user_id: userId }, function (response) {
        $('#deleteModal').modal('hide');
        if (response === 'success') {
          //toastr.success('ลบข้อมูลสำเร็จ!');
          window.location.href='users.php';
        } else {
          toastr.error(response);
        }
      });
    });
  });
</script>


<!-- Modal แก้ไข user -->
<div class="modal fade" id="ModalFormUpdate" tabindex="-1" role="dialog" aria-labelledby="ModalFormUpdateLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalFormTitle"><i class="mdi mdi-plus"></i>แก้ไขข้อมูลผู้ใช้งาน</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
        
    <form method="post" action="<?=$_SERVER['PHP_SELF']?>" enctype="multipart/form-data">  
      <div class="modal-body">
          
          <div class="form-group">
            <label for="u_role2">ประเภทผู้ใช้งาน</label>
            <select class="form-control" id="u_role2" name="u_role">
                <option value="customer">ลูกค้าทั่วไป</option>
                <option value="guide">ไกด์ชุมชน</option>
                <option value="chef">เชฟชุมชน</option>
                <option value="seller">ผู้ขายสินค้า</option>
              </select>
          </div>
          
          <div class="form-group">
            <label for="u_name2">ชื่อ-สกุล *</label>
            <input type="text" class="form-control" id="u_name2" name="u_name" placeholder="ชื่อ-สกุล" required>
          </div>
          <div class="form-group">
            <label for="u_phone2">เบอร์โทรศัพท์ *</label>
            <input type="text" class="form-control" id="u_phone2" name="u_phone" placeholder="เบอร์โทรศัพท์" required>
          </div>
          <div class="form-group">
            <label for="u_address2">ที่อยู่</label>
            <textarea class="form-control" id="u_address2" name="u_address" rows="4" placeholder="ที่อยู่"></textarea>
          </div>
          <div class="form-group">
            <label for="u_email2">อีเมล (ใช้เป็น Username) *</label>
            <input type="text" class="form-control" id="u_email2" name="u_email" placeholder="อีเมล" readonly required>
          </div>
            
<div id="preview2" style="display: flex; gap: 10px; flex-wrap: wrap;"></div>

          <!-- ฟอร์มการอัปโหลดรูปภาพ -->
          <div class="form-group mt-2">
              <label for="u_pictures2">รูปภาพ</label>
              <input type="file" class="form-control-file" id="u_pictures2" name="u_pictures">
          </div>

          <!-- hidden input สำหรับส่งรูปภาพเดิม -->
          <input type="hidden" name="current_picture" id="current_picture">
          
          <div class="form-footer mt-6">
            <input type="hidden" name="action" value="update_user">
              <input type="hidden" id="user_id2" name="user_id">
          </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="mdi mdi-cancel"></i> ยกเลิก</button>
        <button type="submit" id="update-submit-button" class="btn btn-primary"><i class="mdi mdi-content-save"></i> บันทึก</button>
      </div>
    </form>
        
    </div>
    </div>
</div>

<!-- Script แก้ไข user -->
<script>
$('#ModalFormUpdate').on('show.bs.modal', function (event) {
    var button = $(event.relatedTarget);

    // ดึงค่าจาก data-* attributes ของปุ่มที่ถูกคลิก
    var userId = button.data('id');
    var userName = button.data('name');
    var userPhone = button.data('phone');
    var userAddress = button.data('address');
    var userEmail = button.data('email');
    var userRole = button.data('role');
    var userPicture = button.data('picture');

    // ตั้งค่าฟอร์มใน modal
    $('#u_name2').val(userName);
    $('#u_phone2').val(userPhone);
    $('#u_address2').val(userAddress);
    $('#u_email2').val(userEmail);
    $('#u_role2').val(userRole);
    $('#user_id2').val(userId);

    // แสดงรูปภาพเดิมใน modal
    var preview = document.getElementById('preview2');
    preview.innerHTML = ''; // ล้างรูปภาพเก่าก่อน
    if (userPicture) {
        var img = document.createElement('img');
        img.src = "../images/users/" + userPicture;
        img.style.width = '150px';
        img.style.height = '150px';
        img.style.objectFit = 'cover';
        img.style.border = '1px solid #ddd';
        img.style.borderRadius = '5px';
        preview.appendChild(img);
    }

    // ตั้งค่ารูปภาพเดิมใน hidden input
    $('#current_picture').val(userPicture);
});

// การแสดง preview รูปภาพใหม่เมื่อเลือกไฟล์ใหม่
$('#u_pictures2').on('change', function(event) {
    var preview = document.getElementById('preview2');
    preview.innerHTML = ''; // ล้างรูปภาพเดิมก่อน

    var file = event.target.files[0]; // ดึงไฟล์ที่ถูกเลือก
    if (file && file.type.startsWith('image/')) { // ตรวจสอบว่าเป็นไฟล์รูปภาพ
        var reader = new FileReader();
        reader.onload = function(e) {
            var img = document.createElement('img');
            img.src = e.target.result; // รูปภาพจาก FileReader
            img.style.width = '150px';
            img.style.height = '150px';
            img.style.objectFit = 'cover';
            img.style.border = '1px solid #ddd';
            img.style.borderRadius = '5px';
            preview.appendChild(img);
        };
        reader.readAsDataURL(file); // อ่านไฟล์เป็น Data URL
    }
});
</script>
      
<!-- PHP แก้ไข user -->
<?php
if ($_SERVER["REQUEST_METHOD"] == "POST" && $_POST['action'] == "update_user") {
    include_once("../connectdb.php");

    // รับค่าจากฟอร์ม
    $user_id = $_POST['user_id'];
    $fullname = $_POST['u_name'];
    $phone = $_POST['u_phone'];
    $address = $_POST['u_address'];
    $role = $_POST['u_role'];
    $current_picture = $_POST['current_picture'];

    // ตรวจสอบว่าอัปโหลดรูปภาพใหม่หรือไม่
    if (isset($_FILES['u_pictures']) && $_FILES['u_pictures']['error'] == UPLOAD_ERR_OK) {
        $allowedTypes = ['jpg', 'jpeg', 'png', 'gif', 'webp'];
        $fileName = $_FILES['u_pictures']['name'];
        $fileTmpName = $_FILES['u_pictures']['tmp_name'];
        $fileExt = strtolower(pathinfo($fileName, PATHINFO_EXTENSION));

        if (in_array($fileExt, $allowedTypes)) {
            $newFileName = $user_id . '.' . $fileExt;
            $uploadPath = "../images/users/" . $newFileName;

            // ลบรูปภาพเก่า (ถ้ามี)
            if (!empty($current_picture) && file_exists("../images/users/" . $current_picture)) {
                unlink("../images/users/" . $current_picture);
            }

            // อัปโหลดรูปภาพใหม่
            if (!move_uploaded_file($fileTmpName, $uploadPath)) {
                echo "<script>swal('','เกิดข้อผิดพลาดในการอัปโหลดรูปภาพ!', 'error');</script>";
                exit;
            }
        } else {
            echo "<script>swal('','ประเภทไฟล์ไม่รองรับ!', 'error');</script>";
            exit;
        }
    } else {
        // หากไม่มีการอัปโหลดรูปภาพใหม่ ให้ใช้รูปภาพเดิม
        $newFileName = $current_picture;
    }

    // อัปเดตข้อมูลในฐานข้อมูล
    $sql = "UPDATE users 
            SET fullname = ?, phone = ?, address = ?, role = ?, picture = ? 
            WHERE user_id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sssssi", $fullname, $phone, $address, $role, $newFileName, $user_id);

    if ($stmt->execute()) {
        addLog($conn, $_SESSION['buser_id'], $_SESSION['bfullname'], $_SESSION['brole'], "แก้ไขผู้ใช้", "แก้ไขข้อมูลผู้ใช้ User ID: {$user_id} {$fullname}");
        echo "<script>swal('','อัปเดตข้อมูลผู้ใช้เรียบร้อยแล้ว!', 'success'); setTimeout(() => window.location = 'users.php', 2000);</script>";
    } else {
        echo "<script>swal('','เกิดข้อผิดพลาด!', 'error');</script>: " . $stmt->error;
    }

    $stmt->close();
}
?>
  
   
<script>
    $(function() {
        $('.switch-input').change(function() {
            var userId = $(this).data('id');
            var statusType = $(this).val();
            var newValue = $(this).prop('checked') ? (statusType === 'active' ? 'active' : 'enable') : (statusType === 'active' ? 'inactive' : 'disable');

            $.post('update_user_status_for_adm.php', { user_id: userId, status_type: statusType, new_value: newValue }, function(response) {
                var result = JSON.parse(response);

                // ใช้ toastr แทน alert
                if (result.status === 'success') {
                    toastr.success('อัปเดตสถานะสำเร็จ');
                } else {
                    toastr.error('เกิดข้อผิดพลาดในการอัปเดตสถานะ');
                }
            }).fail(function() {
                toastr.error('ไม่สามารถเชื่อมต่อกับเซิร์ฟเวอร์');
            });
        });
    });
</script>

      
    
<!-- Modal เปลี่ยนรหัสผ่าน -->
<div class="modal fade" id="ModalFormUpdatePwd" tabindex="-1" role="dialog" aria-labelledby="ModalFormUpdateLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalFormTitle"><i class="mdi mdi-key"></i> เปลี่ยนรหัสผ่านของ <span id='nameChgPwd'></span></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
        
    <form method="post" action="<?=$_SERVER['PHP_SELF']?>">  
      <div class="modal-body">
          
          <div class="form-group">
            <label for="new_password">รหัสผ่านใหม่ *</label>
            <input type="password" class="form-control" id="new_password" name="new_password" placeholder="รหัสผ่านใหม่" required>
          </div>
          <div class="form-group">
            <label for="new_password_confirm">ยืนยันรหัสผ่านใหม่ *</label>
            <input type="password" class="form-control" id="new_password_confirm" name="new_password_confirm" placeholder="ยืนยันรหัสผ่านใหม่" onKeyUp="validatePasswords();" required>
          </div>
          
<div id="error-message-chg-pwd" style="color: red; font-size: 14px; display: none;" class="mb-3">
    ยืนยันรหัสผ่านไม่ตรงกัน กรุณาลองอีกครั้ง
</div>      
<script>
    // ตรวจสอบรหัสผ่าน
    function validatePasswords() {
        const password = document.getElementById("new_password").value;
        const confirmPassword = document.getElementById("new_password_confirm").value;
        const errorMessage = document.getElementById("error-message-chg-pwd");
        const submitButton = document.getElementById("update-submit-chg-pwd");

        if (password !== confirmPassword) {
            errorMessage.style.display = "block";
            submitButton.disabled = true; 
        } else {
            errorMessage.style.display = "none";
            submitButton.disabled = false;
        }
    }
</script>          
          <div class="form-footer mt-6">
            <input type="hidden" name="action" value="update_password">
              <input type="hidden" id="user_id3" name="user_id3">
          </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="mdi mdi-cancel"></i> ยกเลิก</button>
        <button type="submit" id="update-submit-chg-pwd" class="btn btn-primary"><i class="mdi mdi-content-save"></i> บันทึก</button>
      </div>
    </form>
        
    </div>
    </div>
</div>
      
<!-- Script เปลี่ยนรหัสผ่าน -->
<script>
    // ตั้งค่าข้อมูลใน Modal
    $('#ModalFormUpdatePwd').on('show.bs.modal', function (event) {
        const button = $(event.relatedTarget); // ปุ่มที่เรียก Modal
        const userId = button.data('id');
        const userName = button.data('name');
        
        $('#user_id3').val(userId);
        $('#nameChgPwd').text(userName);
    });
</script>      
      
<!-- PHP เปลี่ยนรหัสผ่าน -->
<?php
if ($_SERVER["REQUEST_METHOD"] == "POST" && $_POST['action'] == "update_password") {
    include_once("../connectdb.php");

    // รับค่าจากฟอร์ม
    $new_password = $_POST['new_password'];
    $new_password_confirm = $_POST['new_password_confirm'];
    $user_id3 = $_POST['user_id3'];

    // ตรวจสอบความถูกต้องของรหัสผ่าน
    if ($new_password !== $new_password_confirm) {
        echo "<script>swal('','รหัสผ่านไม่ตรงกัน!', 'error');</script>";
        exit;
    }

    // แฮชรหัสผ่านก่อนบันทึก
    $hashed_password = password_hash($new_password, PASSWORD_BCRYPT);

    // เตรียมคำสั่ง SQL
    $sql = "UPDATE users SET password = ? WHERE user_id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("si", $hashed_password, $user_id3);

    // บันทึกข้อมูลในฐานข้อมูล
    if ($stmt->execute()) {
        addLog($conn, $_SESSION['buser_id'], $_SESSION['bfullname'], $_SESSION['brole'], "แก้ไขรหัสผ่านผู้ใช้", "แก้ไขรหัสผ่านผู้ใช้ User ID: {$user_id3}");
        echo "<script>swal('','เปลี่ยนรหัสผ่านเรียบร้อย!', 'success'); setTimeout(() => window.location = 'users.php', 2000);</script>";
    } else {
        echo "<script>swal('','เกิดข้อผิดพลาด!', 'error');</script>";
    }

    $stmt->close();
}
?>
   

      
<script>
    $(document).ready(function() {
        
    // สร้าง DataTable
    var table = $('#usersTable').DataTable();
        
    // ปรับแต่งช่องค้นหาไปที่ด้านขวา
    $(".dataTables_filter").css({
        "float": "right",
        "margin-left": "auto"
    });
        
    // ปรับแต่ง select (Entries per page)
    $(".dataTables_length select").css({
        "border": "1px solid #ccc", // กรอบสีเทา
        "border-radius": "4px", // ขอบมน
        "padding": "5px 10px",
        "font-size": "15px", 
        "width": "70px",
        "background-color": "#f8f9fa", // สีพื้นหลัง
        "color": "#495057" // สีตัวอักษร
    });     
        
        // ฟังก์ชันสำหรับคลิกปุ่มประเภท
        $(".category-btn").on("click", function() {
            var category = $(this).data("category");

            if (category === "all") {
                // ถ้าเลือก "แสดงทั้งหมด" ให้ค้นหาค่าเป็นค่าว่าง
                table.column(5).search("").draw(); // ค้นหาตามประเภท
            } else {
                // ถ้าเลือกประเภทใด ๆ ให้ค้นหาตาม ประเภท ที่เลือก
                table.column(5).search(category).draw(); // ค้นหาตามประเภท
            }
        });
        
        
    });
</script>
      
    </body>
</html>
