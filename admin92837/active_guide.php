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
      <li class="breadcrumb-item active" aria-current="page">สถานะทำงาน  </li>
    </ol>
  </nav>
              
<div class="container col-md-6">
    <div class="justify-content-center">
<div class="card card-default card-profile">

  <div class="card-body mt-6 justify-content-center text-center">

    <div class="profile-avata">
      <img class="user-image rounded-circle" src="../images/users/<?php echo $row['picture'];?>" alt="<?php echo $row['fullname'];?>" title="<?php echo $row['fullname'];?>" width="110">
      <span class="h5 d-block mt-3 mb-2"><?php echo $row['fullname'];?></span>
      <span class="d-block"><?php echo $row['role'];?></span>
        
<span class="d-block mt-4">สถานะทำงาน</span>   
<label class="switch switch-icon switch-success form-control-label mt-1">
  <input type="checkbox" class="switch-input form-check-input" value="active" <?php echo ($row['available'] === 'active') ? 'checked' : ''; ?> data-id="<?php echo $_SESSION['buser_id']; ?>" />
  <span class="switch-label"></span>
  <span class="switch-handle"></span>
</label>

        
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
                    
    <script src="plugins/toaster/toastr.min.js"></script>
                    
                    <script src="js/mono.js"></script>
                    <script src="js/chart.js"></script>
                    <script src="js/map.js"></script>
                    <script src="js/custom.js"></script>

<script>
$(document).on('change', '.switch-input', function () {
    const userId = $(this).data('id');
    const status = $(this).prop('checked') ? 'active' : 'inactive';

    $.post('update_user_status.php', { user_id: userId, available: status }, function (response) {
        //alert(response.success ? 'อัปเดตสถานะสำเร็จ' : 'เกิดข้อผิดพลาด');
        if (response.success) {
            toastr.success('อัปเดตสถานะสำเร็จ'); 
        } else {
            toastr.error('เกิดข้อผิดพลาด'); 
        }
    }, 'json');
});

</script>
      
  </body>
</html>
