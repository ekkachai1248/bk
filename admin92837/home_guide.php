<?php
include_once("checklogin.php");
include_once("../connectdb.php");
include_once("functions.php");
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
  
  <link href="plugins/prism/prism.css" rel="stylesheet" />
  
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
      <li class="breadcrumb-item active" aria-current="page">ทริปท่องเที่ยว  </li>
    </ol>
  </nav>
              
<div class="card card-default border-0 bg-transparent">
  <div class="card-header align-items-center p-0">
    <h2></h2> 
    <a href="#" class="btn btn-success" data-toggle="modal" data-target="#ModalFormAdd">
      <i class="mdi mdi-plus mr-1"></i> เพิ่มทริปท่องเที่ยว
    </a>
  </div>
</div>
              
              
<?php
      include_once("../connectdb.php");

      $WHERE = "";
      if (!empty($_GET['filter']) && $_GET['filter'] == "myTrip") {
          $WHERE = "WHERE FIND_IN_SET('{$_SESSION['buser_id']}', REPLACE(t.guide_list, ';', ','))";
      } else if (!empty($_GET['filter']) && $_GET['filter'] == "group") {
          $WHERE = "WHERE t.tc_id = '{$_GET['tc_id']}' ";
      }
?>

<!-- Basic Examples -->
<div class="card card-default">
  
<div class="card-header">
                <h2 class="text-primary">ทริปท่องเที่ยว</h2>
                <div class="text-left">
      <a href="<?php echo $_SERVER['PHP_SELF']?>" class="btn btn-primary btn-sm">
        ทริปท่องเที่ยวทั้งหมด
      </a>
      <a href="<?php echo $_SERVER['PHP_SELF']?>?filter=myTrip" class="btn btn-success btn-sm">
        <i class="mdi mdi-account-check"></i> เฉพาะของฉัน
      </a>
                </div>
                  
                  
 <div class="row text-right">ประเภท: 
      <?php
      $sql2 = "SELECT * FROM `tour_category` ORDER BY `tc_id` ASC";
      $result2 = $conn->query($sql2);
      while ($row2 = $result2->fetch_assoc()) {
      ?>
        <a href="<?php echo $_SERVER['PHP_SELF']?>?filter=group&tc_id=<?=$row2['tc_id'];?>" 
           class="btn btn-outline-info btn-sm mx-1">
          <?=$row2['tc_name'];?>
        </a>
      <?php } ?>
 </div>                 

              </div>    

  <div class="card-body">
    <div class="row">
        
<?php
$sql = "SELECT * FROM tours AS t
LEFT JOIN tour_category AS tc ON t.tc_id = tc.tc_id
LEFT JOIN users AS u ON t.guide_id = u.user_id
{$WHERE}
ORDER BY t.tour_id ASC ";
$result = $conn->query($sql);
while ($row = $result->fetch_assoc()) { 
    $img = explode(";", $row['t_pictures']);
    $countGuide = count(explode(";", $row['guide_list']));
    $available = ($row['available']=='active')?"bg-success":"bg-dark";
?> 
      <div class="col-lg-6 col-xl-3">
        <div class="card mb-4">
          <img class="card-img-top" src="../images/tours/<?php echo $img[0];?>">
          <div class="card-body">
            <h5 class="card-title "><?php echo $row['name'];?></h5>
            <p class="card-text pb-3" style="font-size: 13px"><?php echo mb_strimwidth($row['description'], 0, 120, '...'); ?></p>
              
        <div class="media media-sm">
          <div class="media-sm-wrapper">
              <img src="../images/users/<?php echo $row['picture'];?>" width="50" height="50" alt="<?php echo $row['fullname'];?>" title="<?php echo $row['available'];?>">
              <span class="active <?php echo $available;?>"></span>
          </div>
          <div class="media-body">
            <a href="user-profile.html">
              <span class="text-primary"><?php echo $row['fullname'];?></span>
              <span class="discribe">เจ้าของทริป</span>
            </a>
          </div>
        </div>
            
<a href="#" class="btn btn-outline-primary btn-sm btn-pill d-flex justify-content-center" data-toggle="modal" data-target="#guideList<?php echo $row['tour_id'];?>">ไกด์ทั้งหมด&nbsp; <span class="badge badge-secondary badge-xs rounded-circle"><?php echo $countGuide;?></span></a>
              
<?php
$g_list = explode(";", $row['guide_list']);
if (in_array($_SESSION['buser_id'], $g_list)){         
    
    // ถ้าเป็น เจ้าของทริป
    if ($g_list[0]==$_SESSION['buser_id']){
?>         

    <button class="btn btn-danger btn-block btn-sm mx-1 mt-2 justify-content-center delete-tour" data-id="<?php echo $row['tour_id']; ?>"><i class="mdi mdi-delete-forever"></i> ลบทริปท่องเที่ยวนี้</button>   
<?php } else { ?>
      <a href="update_register_guide.php?action=remove&tour_id=<?php echo $row['tour_id']; ?>" class="btn btn-outline-secondary btn-sm btn-pill d-flex justify-content-center mt-2" onClick="return confirm('ยืนยันการทำรายการ?');">ยกเลิกเข้าร่วมเป็นไกด์</a>            
<?php } } else { ?>    
     <a href="update_register_guide.php?action=add&tour_id=<?php echo $row['tour_id']; ?>" class="btn btn-outline-success btn-sm btn-pill d-flex justify-content-center mt-2" onClick="return confirm('ยืนยันการทำรายการ?');">สมัครเข้าร่วมเป็นไกด์</a>            
<?php } ?>
              
          </div>
        </div>
      </div>
        
<!-- Guide List --> 
<div class="modal fade" id="guideList<?php echo $row['tour_id'];?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalSmallTitle"
  aria-hidden="true">
  <div class="modal-dialog modal-sm" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalSmallTitle">รายชื่อไกด์ทั้งหมด</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">×</span>
        </button>
      </div>
      <div class="modal-body">
        
      <div class="card-body">
<?php
$guideList = explode(";",$row['guide_list']);
foreach($guideList as $index => $guide) {         
    $sqlG = "SELECT fullname, picture, available FROM `users` WHERE user_id='{$guide}' ";
    $resultG = $conn->query($sqlG);
    $rowG = $resultG->fetch_assoc();
    $imgG = explode(";", $rowG['picture']);
    $title = ($index==0)?"เจ้าของทริป":"ไกด์ชุมชน";
    $fullname_color = ($index==0)?"text-primary":"text-dark";
    $available = ($rowG['available']=='active')?"bg-success":"bg-dark";
?>
        <div class="media media-sm">
          <div class="media-sm-wrapper">
              <img src="../images/users/<?php echo $imgG[0];?>" alt="<?php echo $rowG['fullname'];?>" title="<?php echo $rowG['available'];?>" width="50" height="50">
              <span class="active <?php echo $available;?>"></span>
          </div>
          <div class="media-body">
              <span class="<?php echo $fullname_color;?>"><?php echo $rowG['fullname'];?></span>
              <span class="discribe"><?php echo $title;?></span>
          </div>
        </div>
<?php } ?>          
    </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-danger btn-pill" data-dismiss="modal">ปิด</button>
      </div>
    </div>
  </div>
</div>      
        
<?php } ?>
        
        
    </div>

  </div>
</div>


</div>
          
        </div>
        
          <!-- Footer -->
<?php include("footer.php"); ?>
          
      </div>
    </div>
      
                    <script src="plugins/jquery/jquery.min.js"></script>
                    <script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
                    <script src="plugins/simplebar/simplebar.min.js"></script>
                    <script src="https://unpkg.com/hotkeys-js/dist/hotkeys.min.js"></script>

                    
                    <script src="plugins/prism/prism.js"></script>
                    
      <script src="plugins/toaster/toastr.min.js"></script>

                    <script src="js/mono.js"></script>
                    <script src="js/chart.js"></script>
                    <script src="js/map.js"></script>
                    <script src="js/custom.js"></script>
      

                    
<div class="modal fade" id="ModalFormAdd" tabindex="-1" role="dialog" aria-labelledby="exampleModalFormTitle"
  aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalFormTitle"><i class="mdi mdi-plus"></i>เพิ่มทริปท่องเที่ยว</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
        
    <form method="post" action="<?=$_SERVER['PHP_SELF']?>" enctype="multipart/form-data">  
      <div class="modal-body">
          <div class="form-group">
            <label for="p_name">ชื่อทริปท่องเที่ยว</label>
            <input type="text" class="form-control" id="t_name" name="t_name" placeholder="ชื่อทริปท่องเที่ยว" required>
          </div>
          <div class="form-group">
            <label for="p_price">ราคา (บาท)</label>
            <input type="number" class="form-control" id="t_price" name="t_price" placeholder="ราคา (บาท)" required>
          </div>
          <div class="form-group">
            <label for="p_detail">รายละเอียด</label>
            <textarea class="form-control" id="t_detail" name="t_detail" rows="4"></textarea>
          </div>
          <div class="form-group">
            <label for="fcid">ประเภท</label>
            <select class="form-control" id="tc_id" name="tc_id">
<?php
$sql3 = "SELECT * FROM `tour_category` ORDER BY `tc_name` ASC";
$result3 = $conn->query($sql3);
while ($row3 = $result3->fetch_assoc()) {
?>
 <option value="<?=$row3['tc_id'];?>"><?=$row3['tc_name'];?></option>
<?php } ?>   
              </select>
          </div>
            
<div class="form-group">
    <label for="t_pictures">รูปภาพ</label>
    <input type="file" class="form-control-file" id="t_pictures" name="t_pictures[]" multiple required>
</div>
<div id="preview" style="display: flex; gap: 10px; flex-wrap: wrap;"></div>

<script>
    document.getElementById('t_pictures').addEventListener('change', function(event) {
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
            <input type="hidden" name="action" value="add_tour">
          </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="mdi mdi-cancel"></i>  ยกเลิก</button>
        <button type="submit" class="btn btn-primary"><i class="mdi mdi-content-save"></i> บันทึก</button>
      </div>
    </form>
        
    </div>
  </div>
</div>              

      
<?php
// เพิ่มทริปท่องเที่ยว
if ($_SERVER["REQUEST_METHOD"] == "POST" && $_POST['action'] == "add_tour") {
    $t_name = $_POST['t_name'];
    $t_hour = 3 ;
    $availability = "ทุกวัน" ;
    $t_price = $_POST['t_price'];
    $t_detail = $_POST['t_detail'];
    //$t_daterecord = date('Y-m-d H:i:s');
    $tc_id = $_POST['tc_id'];
    $guide_id = $_SESSION['buser_id']; // seller_id

    $uploadDir = "../images/tours/";
    $fileNames = [];
    $fileExtensions = [];

    $sql = "INSERT INTO tours (name, description, hours, price, availability, tc_id, guide_id, guide_list ) 
            VALUES ('$t_name', '$t_detail', '$t_hour', '$t_price', '$availability', '$tc_id', '$guide_id', '$guide_id')";

    if ($conn->query($sql) === TRUE) {
        $lastId = $conn->insert_id;
        
        addLog($conn, $_SESSION['buser_id'], $_SESSION['bfullname'], $_SESSION['brole'], "เพิ่มทริปท่องเที่ยว", "เพิ่มทริปท่องเที่ยวของตนเอง tour_id: {$lastId} {$t_name}");

        // ตรวจสอบและอัปโหลดรูปภาพหลายรูป
        if (!empty($_FILES['t_pictures']['name'][0])) {
            foreach ($_FILES['t_pictures']['tmp_name'] as $key => $tmp_name) {
                $fileName = basename($_FILES['t_pictures']['name'][$key]);
                $fileType = strtolower(pathinfo($fileName, PATHINFO_EXTENSION));
                $allowedTypes = ['jpg', 'jpeg', 'png', 'gif', 'webp']; 

                // ตรวจสอบประเภทไฟล์
                if (in_array($fileType, $allowedTypes)) {
                    $newFileName = $lastId . "-" . ($key + 1) . "." . $fileType;
                    $targetFile = $uploadDir . $newFileName;

                    if (move_uploaded_file($tmp_name, $targetFile)) {
                        $fileNames[] = $newFileName; // เก็บชื่อไฟล์ใหม่
                        $fileExtensions[] = $fileType; // ประเภทไฟล์
                    } else {
                        echo "Error uploading file: $fileName<br>";
                    }
                } else {
                    echo "File type not allowed: $fileType<br>";
                }
            }
        }

        // รวมชื่อไฟล์เพื่ออัปเดตในฐานข้อมูล
        $t_pictures = implode(";", $fileNames);

        // อัปเดตข้อมูลรูปภาพในฐานข้อมูล 
        $updateSql = "UPDATE tours SET t_pictures='$t_pictures' WHERE tour_id='$lastId'";
        if ($conn->query($updateSql) === TRUE) {
            echo "<script>toastr.success('เพิ่มข้อมูลสำเร็จ!');window.location='home_guide.php';</script>";
        } else {
            echo "<script>toastr.danger('เพิ่มข้อมูลไม่สำเร็จ!')</script>" . $conn->error;
        }
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}
?>


<?php if (isset($_GET['success']) && $_GET['success'] == 'true') { ?>
    <script>
        //alert('สำเร็จ!');
        toastr.success("สำเร็จ!");
    </script>
<?php } ?>
      
<script>
    $(document).on('click', '.delete-tour', function () {
    const tourId = $(this).data('id');
    if (confirm('ยืนยันการลบ?')) {
        $.ajax({
            url: 'delete_mytour.php',
            type: 'POST',
            data: { tour_id: tourId },
            dataType: 'json',
            success: function (response) {
                if (response.success) {
                    //alert(response.message);
                    toastr.success(response.message);
                    location.reload(); // รีเฟรชหน้าเพื่ออัปเดตข้อมูล
                } else {
                    //alert(response.message);
                    toastr.danger(response.message);
                }
            },
            error: function () {
                alert('เกิดข้อผิดพลาดในการลบข้อมูล');
            }
        });
    }
});

</script>
  </body>
</html>
