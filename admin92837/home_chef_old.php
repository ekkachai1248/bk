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

  <title>Local buengkan - เชฟชุมชน</title>

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
      
<?php include("left-sidebar-chef.php"); ?>      

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
      <li class="breadcrumb-item">  <a href="home_chef.php">หน้าหลัก  </a>  </li>
      <li class="breadcrumb-item active" aria-current="page">เมนูอาหาร  </li>
    </ol>
  </nav>
              
<div class="card card-default border-0 bg-transparent">
  <div class="card-header align-items-center p-0">
    <h2></h2> 
    <a href="#" class="btn btn-success" data-toggle="modal" data-target="#ModalFormAdd">
      <i class="mdi mdi-plus mr-1"></i> เพิ่มเมนูอาหาร
    </a>
  </div>
</div>
              
              
<?php
      include_once("../connectdb.php");

?>

<!-- Basic Examples -->
<div class="card card-default">
  
<div class="card-header">
                <h2 class="text-primary">เมนูอาหาร</h2>
                <div class="text-left">

                </div>
                  
                  
 <div class="row text-right">ประเภท: 
      <?php
      $sql2 = "SELECT * FROM `foods_category` ORDER BY `fc_id` ASC";
      $result2 = $conn->query($sql2);
      while ($row2 = $result2->fetch_assoc()) {
      ?>
        <a href="<?php echo $_SERVER['PHP_SELF']?>?filter=group&fc_id=<?=$row2['fc_id'];?>" 
           class="btn btn-outline-info btn-sm mx-1" style="text-transform: none; font-size: 13px; padding: 6px 10px; line-height: 1.5;">
          <?=$row2['fc_name'];?>
        </a>
      <?php } ?>
 </div>                 

              </div>    

  <div class="card-body">
    <div class="row">
        
<?php
$sql = "SELECT * FROM foods AS f
LEFT JOIN foods_category AS fc ON f.fc_id = fc.fc_id
LEFT JOIN users AS u ON f.c_id = u.user_id
WHERE f.c_id = '{$_SESSION['buser_id']}'
ORDER BY f.f_id ASC ";
$result = $conn->query($sql);
while ($row = $result->fetch_assoc()) { 
    $img = explode(";", $row['f_pictures']);
    //$countGuide = count(explode(";", $row['guide_list']));
    $available = ($row['available']=='active')?"bg-success":"bg-dark";
?> 
      <div class="col-lg-6 col-xl-3">
        <div class="card mb-4">
          <img class="card-img-top" src="../images/foods/<?php echo $img[0];?>">
          <div class="card-body">
            <h5 class="card-title "><?php echo $row['f_name'];?></h5>
            <p class="card-text pb-3" style="font-size: 13px"><?php echo mb_strimwidth($row['f_detail'], 0, 120, '...'); ?></p>
              
        <div class="media media-sm">
          <div class="media-sm-wrapper">
              <img src="../images/users/<?php echo $row['picture'];?>" width="50" height="50" alt="<?php echo $row['fullname'];?>" title="<?php echo $row['available'];?>">
              <span class="active <?php echo $available;?>"></span>
          </div>
          <div class="media-body">
            <a href="user-profile.html">
              <span class="text-primary"><?php echo $row['fullname'];?></span>
              <span class="discribe">เจ้าของอาหาร</span>
            </a>
          </div>
        </div>

    <button class="btn btn-danger btn-block btn-sm mx-1 mt-2 justify-content-center delete-tour" data-id="<?php echo $row['f_id']; ?>"><i class="mdi mdi-delete-forever"></i> ลบเมนูอาหารนี้</button>   
 
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
