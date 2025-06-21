<?php
ob_start();
session_start();
include_once("functions.php");
?>
<!DOCTYPE html>

<html lang="en">
<head>
  <head>
  <meta charset="utf-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />

  <title>Local Buengkan Admin</title>

  <!-- GOOGLE FONTS -->
  <link href="https://fonts.googleapis.com/css?family=Karla:400,700|Roboto" rel="stylesheet">
  <link href="plugins/material/css/materialdesignicons.min.css" rel="stylesheet" />
  <link href="plugins/simplebar/simplebar.css" rel="stylesheet" />

  <!-- PLUGINS CSS STYLE -->
  <link href="plugins/nprogress/nprogress.css" rel="stylesheet" />
  
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
      
    <script src="../vendor/jquery/jquery-3.2.1.min.js"></script>
    <script src="../vendor/sweetalert/sweetalert.min.js"></script> 
      
  <link href="https://fonts.googleapis.com/css2?family=Chonburi&family=Kanit&family=Pattaya&family=Prompt&family=Srisakdi&display=swap" rel="stylesheet">

  <style>
    div {
        font-family: "Prompt", sans-serif;
        font-style: normal;
    }
  </style>      
</head>

</head>
  <body class="bg-light-gray" id="body">
          <div class="container d-flex align-items-center justify-content-center" style="min-height: 100vh">
          <div class="d-flex flex-column justify-content-between">
            <div class="row justify-content-center">
              <div class="col-lg-6 col-md-10">
                <div class="card card-default mb-0">
                  <div class="card-header pb-0">
                    <div class="app-brand w-100 d-flex justify-content-center border-bottom-0">
                        <img src="images/lb.png" width="64" class="rounded">
                    </div>
                  </div>
                  <div class="card-body px-5 pb-5 pt-0">
				
				<h4 class="text-center mt-2 mb-6 text-primary">Sign in for Local Buengkan</h4>

                    <form method="post" action="<?php echo $_SERVER['PHP_SELF'];?>">
                      <div class="row">
                        <div class="form-group col-md-12 mb-4">
                          <input type="text" class="form-control input-lg" id="username" name="u_username" placeholder="Username" autofocus required>
                        </div>
                        <div class="form-group col-md-12 ">
                          <input type="password" class="form-control input-lg" id="password" name="u_password" placeholder="Password" required>
                        </div>
                        <div class="col-md-12">

                <div class="d-flex justify-content-between mb-3 mt-1">
                      <div class="form-group">
                          <div class="mb-2">
                          ประเภทผู้ใช้
                          </div>
                        <div class="custom-control custom-radio mb-1">
                          <input class="custom-control-input" type="radio" name="role" id="guide" value="guide" checked>
                          <label for="guide" class="custom-control-label">ไกด์ชุมชุน</label>
                        </div>

                        <div class="custom-control custom-radio mb-1">
                          <input class="custom-control-input" type="radio" name="role" id="seller" value="seller" >
                          <label for="seller" class="custom-control-label">ผู้ขายสินค้า</label>
                        </div>
                        <div class="custom-control custom-radio mb-1">
                          <input class="custom-control-input" type="radio" name="role" id="chef" value="chef" >
                          <label for="chef" class="custom-control-label">เชฟชุมชุน</label>
                        </div>
                        <div class="custom-control custom-radio">
                          <input class="custom-control-input" type="radio" name="role" id="admin" value="admin" >
                          <label for="admin" class="custom-control-label">ผู้ดูแลระบบ</label>
                        </div>
                      </div>
                </div>

                          <button type="submit" class="btn btn-primary btn-pill mb-4">Sign In</button>

                          <div class="text-blue">ติดต่อเรา
                            <span>localbuengkan@gmail.com</span>
                          </div>
                        </div>
                      </div>
                    </form>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>

      
<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    include_once("../connectdb.php");

    // รับข้อมูลจากฟอร์ม
    $u_username = $conn->real_escape_string($_POST['u_username']);
    $u_password = $_POST['u_password'];
    $form_role = $_POST['role']; // รับ role จาก Radio

    // ค้นหาผู้ใช้ในฐานข้อมูล
    $sql = "SELECT * FROM users WHERE email = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $u_username);
    $stmt->execute();
    $result = $stmt->get_result();

    // ตรวจสอบผลลัพธ์
    if ($result->num_rows === 1) {
        $user = $result->fetch_assoc();

        // ตรวจสอบรหัสผ่าน
        if (password_verify($u_password, $user['password'])) {
            // ตรวจสอบว่า role จากฟอร์มตรงกับ role ในฐานข้อมูลหรือไม่
            if ($form_role === $user['role']) {
                // ตั้งค่าข้อมูล session
                $_SESSION['buser_id'] = $user['user_id'];
                $_SESSION['bfullname'] = $user['fullname'];
                $_SESSION['brole'] = $user['role'];
                $_SESSION['bpicture'] = $user['picture'];
                    
                addLog($conn, $_SESSION['buser_id'], $_SESSION['bfullname'], $_SESSION['brole'], "Login", "Login...");
                
                // เปลี่ยนเส้นทางตาม role
                switch ($user['role']) {
                    case 'seller':
                        header("Location: home_seller.php");
                        break;
                    case 'chef':
                        header("Location: home_chef.php");
                        break;
                    case 'guide':
                        header("Location: home_guide.php");
                        break;
                    case 'admin':
                        header("Location: index2.php");
                        break;
                    default:
                        echo "Invalid role!";
                        exit;
                }
                exit;
            } else {
                echo "<script>swal('', 'เลือกประเภทผู้ใช้ให้ถูกต้อง!', 'error');</script>";
            }
        } else {
            echo "<script>swal('', 'รหัสผ่านไม่ถูกต้อง!', 'error');</script>";
        }
    } else {
        echo "<script>swal('', 'ไม่พบผู้ใช้!', 'error');</script>";
    }

    $stmt->close();
}

//$conn->close();

ob_end_flush();
?>
      
     
</body>
</html>
