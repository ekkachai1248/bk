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
      
  <title>Local buengkan - เชฟชุมชน</title>

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

 <div class="card card-default border-0 bg-transparent">
  <div class="card-header align-items-center p-0">
    <h2></h2> 
    <a href="#" class="btn btn-success" data-toggle="modal" data-target="#ModalFormAdd">
      <i class="mdi mdi-plus mr-1"></i> เพิ่มเมนูอาหาร
    </a>
  </div>
</div>
              
<!-- Foods Inventory -->
<div class="card card-default">
  <div class="card-header">
    <h2><i class="mdi mdi-food-fork-drink"></i> เมนูอาหาร</h2>
     
      <div class="row text-right">
      ประเภทอาหาร &nbsp; 
           <button class="btn btn-primary btn-sm category-btn" data-category="all">แสดงทั้งหมด</button>&nbsp;
      <?php
include_once("../connectdb.php");
$sql2 = "SELECT * FROM `foods_category` ORDER BY `foods_category`.`fc_id` ASC";
$result2 = $conn->query($sql2);
while ($row2 = $result2->fetch_assoc()) {
?>
					<button class="btn btn-outline-info btn-sm category-btn" data-category="<?=$row2['fc_name'];?>" style="text-transform: none; font-size: 13px; padding: 6px 13px; line-height: 1.5;">
						<?=$row2['fc_name'];?>
					</button>&nbsp; 
<?php } ?>
</div>
  </div>
    
  <div class="card-body">
    <table id="foodsTable" class="table table-hover table-product" style="width:100%" cellpadding="20">
      <thead>
        <tr>
          <th>Actions</th>
          <th>รูป</th>
          <th>ชื่ออาหาร</th>
          <th>ID</th>
          <th>ราคา</th>
          <th>ประเภท</th>
          <th>จำนวนแคลอรี่</th>
          <th>วันที่บันทึก</th>
        </tr>
      </thead>
      <tbody>
          
      </tbody>
    </table>

  </div>
</div>
                         
    
<div class="modal fade" id="ModalFormAdd" tabindex="-1" role="dialog" aria-labelledby="exampleModalFormTitle"
  aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalFormTitle"><i class="mdi mdi-plus"></i>เพิ่มอาหาร</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
        
    <form method="post" action="<?=$_SERVER['PHP_SELF']?>" enctype="multipart/form-data">  
      <div class="modal-body">
          <div class="form-group">
            <label for="f_name">ชื่ออาหาร</label>
            <input type="text" class="form-control" id="f_name" name="f_name" placeholder="ชื่ออาหาร" required>
          </div>
          <div class="form-group">
            <label for="f_price">ราคา/หน่วย (บาท)</label>
            <input type="number" class="form-control" id="f_price" name="f_price" placeholder="ราคา/หน่วย (บาท)" required>
          </div>
          <div class="form-group">
            <label for="f_detail">รายละเอียด</label>
            <textarea class="form-control" id="f_detail" name="f_detail" rows="4"></textarea>
          </div>
          <div class="form-group">
            <label for="f_calorie">จำนวนแคลอรี่</label>
            <input type="number" class="form-control" id="f_calorie" name="f_calorie" placeholder="จำนวนแคลอรี่" required>
          </div>
          <div class="form-group">
            <label for="fcid">ประเภทอาหาร</label>
            <select class="form-control" id="fc_id" name="fc_id">
<?php
$sql3 = "SELECT * FROM `foods_category` ORDER BY `foods_category`.`fc_name` ASC";
$result3 = $conn->query($sql3);
while ($row3 = $result3->fetch_assoc()) {
?>
 <option value="<?=$row3['fc_id'];?>"><?=$row3['fc_name'];?></option>
<?php } ?>   
              </select>
          </div>
            
<div class="form-group">
    <label for="f_pictures">รูปภาพอาหาร</label>
    <input type="file" class="form-control-file" id="f_pictures" name="f_pictures[]" multiple required>
</div>
<div id="preview" style="display: flex; gap: 10px; flex-wrap: wrap;"></div>

<script>
    document.getElementById('f_pictures').addEventListener('change', function(event) {
        const preview = document.getElementById('preview');
        preview.innerHTML = ''; // ล้างพรีวิวเก่า
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
            <input type="hidden" name="action" value="add_food">
          </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-dismiss="modal">ยกเลิก</button>
        <button type="submit" class="btn btn-primary"><i class="mdi mdi-content-save"></i> บันทึก</button>
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
      
      

<?php
// เพิ่มอาหาร
if ($_SERVER["REQUEST_METHOD"] == "POST" && $_POST['action'] == "add_food") {
    $f_name = $_POST['f_name'];
    $f_price = $_POST['f_price'];
    $f_detail = $_POST['f_detail'];
    $f_calorie = $_POST['f_calorie'];
    $f_daterecord = date('Y-m-d H:i:s');
    $fc_id = $_POST['fc_id'];
    $c_id = $_SESSION['buser_id']; 

    $uploadDir = "../images/foods/";
    $fileNames = [];
    $fileExtensions = [];

    $sql = "INSERT INTO foods (f_name, f_detail, f_price, f_daterecord, f_calorie, fc_id, c_id) 
            VALUES ('$f_name', '$f_detail', '$f_price', '$f_daterecord', '$f_calorie', '$fc_id', '$c_id')";

    if ($conn->query($sql) === TRUE) {
        $lastId = $conn->insert_id;
        
        addLog($conn, $_SESSION['buser_id'], $_SESSION['bfullname'], $_SESSION['brole'], "เพิ่มอาหาร", "เพิ่มอาหารของตนเอง f_id: {$lastId} {$f_name}");

        // ตรวจสอบและอัปโหลดรูปภาพหลายรูป
        if (!empty($_FILES['f_pictures']['name'][0])) {
            foreach ($_FILES['f_pictures']['tmp_name'] as $key => $tmp_name) {
                $fileName = basename($_FILES['f_pictures']['name'][$key]);
                $fileType = strtolower(pathinfo($fileName, PATHINFO_EXTENSION)); // ดึงนามสกุลไฟล์
                $allowedTypes = ['jpg', 'jpeg', 'png', 'gif', 'webp']; 

                // ตรวจสอบประเภทไฟล์
                if (in_array($fileType, $allowedTypes)) {
                    $newFileName = $lastId . "-" . ($key + 1) . "." . $fileType; // ตั้งชื่อใหม่ตาม auto id
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
        $f_pictures = implode(";", $fileNames);

        // อัปเดตข้อมูลรูปภาพในฐานข้อมูล 
        $updateSql = "UPDATE foods SET f_pictures='$f_pictures' WHERE f_id='$lastId'";
        if ($conn->query($updateSql) === TRUE) {
            echo "<script>toastr.success('เพิ่มข้อมูลสำเร็จ!')</script>";
        } else {
            echo "<script>toastr.danger('เพิ่มข้อมูลไม่สำเร็จ!')</script>" . $conn->error;
        }
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}
?>

<?php
// ตรวจสอบการส่งคำขอ POST
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action']) && $_POST['action'] === 'update_food') {

    // รับค่าจากฟอร์ม
    $f_id = isset($_GET['fid']) ? intval($_GET['fid']) : 0;
    $f_name = isset($_POST['f_name']) ? $_POST['f_name'] : '';
    $f_price = isset($_POST['f_price']) ? floatval($_POST['f_price']) : 0.0;
    $f_detail = isset($_POST['f_detail']) ? $_POST['f_detail'] : '';
    $f_calorie = isset($_POST['f_calorie']) ? intval($_POST['f_calorie']) : 0;
    $fc_id = isset($_POST['fc_id']) ? intval($_POST['fc_id']) : 0;

    // ตรวจสอบ ID
    if ($f_id > 0) {
        // อัปเดตข้อมูลพื้นฐานในฐานข้อมูล
        $sqlUpdate = "UPDATE foods SET f_name = ?, f_price = ?, f_detail = ?, f_calorie = ?, fc_id = ? WHERE f_id = ?";
        $stmt = $conn->prepare($sqlUpdate);

        if ($stmt) {
            $stmt->bind_param("sdsiii", $f_name, $f_price, $f_detail, $f_calorie, $fc_id, $f_id);

            if ($stmt->execute()) {
                // ดึงรูปภาพที่มีอยู่เดิม
                $existingPictures = isset($_POST['existing_pictures']) ? $_POST['existing_pictures'] : '';
                $existingPicturesArray2 = is_string($existingPictures) ? explode(";", $existingPictures) : [];

                // จัดการรูปภาพที่ถูกลบ
                if (isset($_POST['deleted_pictures']) && !empty($_POST['deleted_pictures'])) {
                    $deletedPictures = explode(";", $_POST['deleted_pictures']);
                    foreach ($deletedPictures as $deletedPicture) {
                        $filePath = "../images/foods/" . $deletedPicture;
                        if (file_exists($filePath)) {
                            unlink($filePath); // ลบไฟล์ที่ถูกลบ
                        }
                        //$existingPicturesArray2 = array_diff($existingPicturesArray2, [$deletedPicture]);
                    }
                }

                // อัปโหลดรูปภาพใหม่
                $uploadedPictures = [];
                if (isset($_FILES['food_pictures']['name']) && !empty($_FILES['food_pictures']['name'][0])) {
                    for ($i = 0; $i < count($_FILES['food_pictures']['name']); $i++) {
                        $fileName = $_FILES['food_pictures']['name'][$i];
                        $fileTmpName = $_FILES['food_pictures']['tmp_name'][$i];
                        $fileExtension = pathinfo($fileName, PATHINFO_EXTENSION);

                        // ตั้งชื่อไฟล์ใหม่ตามรูปแบบ <รหัสอาหาร>-<ลำดับ>.<นามสกุลไฟล์>
                        $newFileName = $f_id . '-' . ($i + 1) . '.' . $fileExtension;

                        // ตรวจสอบและย้ายไฟล์
                        if (move_uploaded_file($fileTmpName, "../images/foods/" . $newFileName)) {
                            $uploadedPictures[] = $newFileName;
                        } else {
                            echo "<script>toastr.error('ไม่สามารถอัปโหลดไฟล์: $fileName');</script>";
                        }
                    }
                }
                
                // หารูปล่าสุด  
                $imgDelete = explode(";",$_POST['deleted_pictures']);
                
                if(isset($_POST['existing_pictures'])){
                    $array_existing_pictures = explode(";",$_POST['existing_pictures']);
                    $imgLasted = array_diff($array_existing_pictures, $imgDelete);
//var_dump($imgLasted);exit;       
                    // รวมรูปภาพเดิมและรวมรูปภาพใหม่
                    $updatedPictures = array_merge($imgLasted, $uploadedPictures);
                    $updatedPictures_unique = array_unique($updatedPictures);
                    $picturesString = implode(";", $updatedPictures_unique);
                }

                // อัปเดตรูปภาพในฐานข้อมูล
                if (!empty($picturesString)) {
                    $sqlUpdatePictures = "UPDATE foods SET f_pictures = ? WHERE f_id = ?";
                    $stmtUpdatePictures = $conn->prepare($sqlUpdatePictures);
                    if ($stmtUpdatePictures) {
                        $stmtUpdatePictures->bind_param("si", $picturesString, $f_id);
                        if ($stmtUpdatePictures->execute()) {
                            addLog($conn, $_SESSION['buser_id'], $_SESSION['bfullname'], $_SESSION['brole'], "แก้ไขอาหาร", "แก้ไขข้อมูลอาหารของตนเอง f_id: {$f_id} {$f_name}");
                            echo "<script>toastr.success('แก้ไขข้อมูลสำเร็จ!');</script>";
                        } else {
                            echo "<script>toastr.error('เกิดข้อผิดพลาดในการอัปเดตรูปภาพ');</script>";
                        }
                        $stmtUpdatePictures->close();
                    }
                } else {
                    echo "<script>toastr.warning('ไม่มีรูปภาพใหม่ที่อัปโหลด');</script>";
                }
            } else {
                echo "<script>toastr.error('เกิดข้อผิดพลาด: {$stmt->error}');</script>";
            }
            $stmt->close();
        } else {
            echo "<script>toastr.error('เกิดข้อผิดพลาด: {$conn->error}');</script>";
        }
    } else {
        echo "<script>toastr.error('ไม่พบ ID ของอาหารที่ต้องการแก้ไข');</script>";
    }
}
?>

<!-- Modal ลบ -->
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
        <p>คุณต้องการลบอาหาร  "<span id="foodName"></span>" ใช่หรือไม่ ?</p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-success" data-dismiss="modal">ยกเลิก</button>
        <button type="button" class="btn btn-danger" id="confirmDelete">ลบ</button>
      </div>
    </div>
  </div>
</div>
      
<script>
$(document).ready(function () {
    $('#deleteModal').on('hidden.bs.modal', function (event) {
      $(this).attr('aria-hidden', 'true');
    });
    
  $('#deleteModal').on('show.bs.modal', function (event) {
      $(this).attr('aria-hidden', 'false');
    const button = $(event.relatedTarget); // ปุ่มที่เรียก Modal
    const foodId = button.data('id'); // ดึง ID อาหาร
    const foodName = button.data('name'); // ดึงชื่ออาหาร

    // ตั้งค่าข้อความชื่ออาหารใน Modal
    $('#foodName').text(foodName);

    // ตั้งค่า Event สำหรับปุ่มยืนยันลบ
    $('#confirmDelete').off('click').on('click', function () {
      $('#deleteModal').modal('hide'); // ปิด Modal
      deleteFood(foodId); // เรียกฟังก์ชันลบอาหาร
    });

    // ตั้งค่า focus ไปที่ปุ่ม "ลบ" เพื่อให้ผู้ใช้สามารถใช้คีย์บอร์ดได้ง่าย
    $('#confirmDelete').focus();
  });
});

function deleteFood(foodId) {
  if (foodId) {
    $.ajax({
      url: 'food_delete.php',
      type: 'POST',
      data: { food_id: foodId },
      success: function (response) {
        try {
          const data = typeof response === 'string' ? JSON.parse(response) : response;
          if (data.success) {
            toastr.success(data.message);
            $('#deleteModal').modal('hide'); // ปิด Modal

            // อัปเดต DataTable
            const table = $('#foodsTable').DataTable();
            const row = $(`a[data-id="${foodId}"]`).closest('tr'); // ใช้ <a> แทน <button>
            if (row.length > 0) {
              table.row(row).remove().draw(); // ลบแถวและอัปเดตตาราง
            } else {
              toastr.warning('ไม่พบแถวที่ต้องการลบ');
            }
          } else {
            toastr.warning(data.message);
          }
        } catch (e) {
          //console.error('เกิดข้อผิดพลาดในการแปลงข้อมูลเซิร์ฟเวอร์');
        }
      },
      error: function () {
        alert('เกิดข้อผิดพลาดในการเชื่อมต่อกับเซิร์ฟเวอร์');
      },
    });
  }
}
</script>    


<script>
    $(document).ready(function() {
        // ตั้งค่า DataTables โดยใช้ fetch() แทน ajax
        const table = $('#foodsTable').DataTable({
            "processing": true,  // เปิดแสดงข้อความว่า "กำลังประมวลผล"
            "serverSide": false, // ใช้ client-side processing
            "pageLength": 10,
            "columns": [
                {
                    "data": "f_id",  // ใช้ข้อมูล f_id ในการแสดงปุ่ม
                    "render": function(data, type, row) {
                        // การแสดงปุ่มแก้ไขและลบ
                        return `
                            <a href="#" class="mb-1 btn btn-warning btn-sm food-update" data-id="${data}" title="แก้ไข">
                                <i class="mdi mdi-lead-pencil"></i>
                            </a>
                            <a href="#" class="mb-1 btn btn-danger btn-sm" data-toggle="modal" data-target="#deleteModal" data-id="${data}" data-name="${row.f_name}" title="ลบ">
                                <i class="mdi mdi-delete-forever"></i>
                            </a>
                        `;
                    }
                },
                { 
                    "data": "f_pictures",
                    "render": function(data) {
                        var picturesArray = data.split(';');
                        return picturesArray.length > 0 && picturesArray[0] ? `<img src='../images/foods/${picturesArray[0]}'>` : '';
                    }
                },
                { "data": "f_name" },
                { "data": "f_id" },
                { 
                    "data": "f_price",
                    "render": function(data) {
                        return (Number(data) && !isNaN(data)) ? Number(data).toLocaleString() : data;
                    } 
                },
                { "data": "fc_name" },
                { 
                    "data": "f_calorie",
                    "render": function(data) {
                        return (Number(data) && !isNaN(data)) ? Number(data).toLocaleString() : data;
                    } 
                },
                { "data": "f_daterecord" },
            ]
        });

    window.table = table;
        
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
        
        // ฟังก์ชันสำหรับคลิกปุ่มประเภทอาหาร
        $(".category-btn").on("click", function() {
            var category = $(this).data("category");

            if (category === "all") {
                // ถ้าเลือก "แสดงทั้งหมด" ให้ค้นหาค่าเป็นค่าว่าง
                table.column(5).search("").draw(); // ค้นหาตาม fc_name
            } else {
                // ถ้าเลือกประเภทอาหารใด ๆ ให้ค้นหาตาม fc_name ที่เลือก
                table.column(5).search(category).draw(); // ค้นหาตาม fc_name
            }
        });
        
        // ใช้ fetch เพื่อดึงข้อมูลจาก fetch_data_foods_chef.php
        fetch('fetch_data_foods_chef.php')
            .then(response => response.json())  // แปลงข้อมูลเป็น JSON
            .then(data => {
                // เพิ่มข้อมูลไปที่ DataTable
                table.clear().rows.add(data.data).draw();
            })
            .catch(error => console.error('Error fetching data:', error));
    });
</script>

<div class="modal fade" id="ModalFormUpdate" tabindex="-1" role="dialog" aria-labelledby="ModalFormUpdateLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="ModalFormUpdateLabel"><i class="mdi mdi-lead-pencil"></i> แก้ไขข้อมูลอาหาร</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="updateFoodForm" method="post" enctype="multipart/form-data">
                <div class="modal-body">
                    <div class="form-group">
                        <label for="f_name2">ชื่ออาหาร</label>
                        <input type="text" class="form-control" id="f_name2" name="f_name" required>
                    </div>
                    <div class="form-group">
                        <label for="f_price2">ราคา</label>
                        <input type="number" class="form-control" id="f_price2" name="f_price" required>
                    </div>
                  <div class="form-group">
                    <label for="f_detail2">รายละเอียด</label>
                    <textarea class="form-control" id="f_detail2" name="f_detail" rows="4"></textarea>
                  </div>
                    <div class="form-group">
                        <label for="f_calorie2">จำนวนแคลอรี่</label>
                        <input type="number" class="form-control" id="f_calorie2" name="f_calorie" required>
                    </div>
                    <div class="form-group">
                        <label for="fc_name2">ประเภทอาหาร</label>
                        <select class="form-control" id="fc_id2" name="fc_id" required>
                            <!-- ตัวเลือกประเภทอาหาร -->
                            <?php
                            $sql_category = "SELECT * FROM foods_category";
                            $result_category = $conn->query($sql_category);
                            while ($row_category = $result_category->fetch_assoc()) {
                                echo "<option value='" . htmlspecialchars($row_category['fc_id'], ENT_QUOTES, 'UTF-8') . "'>" . htmlspecialchars($row_category['fc_name'], ENT_QUOTES, 'UTF-8') . "</option>";
                            }
                            ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="food_pictures">รูปภาพอาหาร</label>
                        <input type="hidden" name="existing_pictures" id="existing_pictures2">
                        <input type="file" class="form-control-file" id="food_pictures" name="food_pictures[]" multiple>
                    </div>
                    <div id="existing_pictures" style="display: flex; gap: 10px; flex-wrap: wrap;"></div>
                    
                    <div id="previewEditFood" style="display: flex; gap: 0px; flex-wrap: wrap;"></div>
                    
                    <input type="hidden" name="deleted_pictures" id="deleted_pictures">
                </div>
                <div class="modal-footer">
                    <input type="hidden" name="action" value="update_food">
                    <button type="button" class="btn btn-danger" data-dismiss="modal">ยกเลิก</button>
                    <button type="submit" class="btn btn-primary"><i class="mdi mdi-content-save"></i> บันทึก</button>
                </div>
            </form>
        </div>
    </div>
</div>

      
<script>
$(document).ready(function () {
    // เปิด Modal พร้อมกรอกข้อมูล
    $(document).on('click', '.food-update', function () {
        $('#ModalFormUpdate').modal('show');
        
        const foodId = $(this).data('id');
        const rowData = table.row($(this).closest('tr')).data();

        if (!rowData) {
            console.error("Row data is not available.");
            return;
        }

        // เติมข้อมูลลงในฟอร์ม
        $('#f_name2').val(rowData.f_name || '');
        $('#f_price2').val(rowData.f_price || 0);
        $('#f_calorie2').val(rowData.f_calorie || 0);
        $('#f_detail2').val(rowData.f_detail || '');
        $('#fc_name2').val(rowData.fc_name || '');
        $('#fc_id2').val(rowData.fc_id || '');
        $('#existing_pictures2').val(rowData.f_pictures || '');
        

        // แสดงรูปภาพที่มีอยู่
        const picturesArray = rowData.f_pictures ? rowData.f_pictures.split(';') : [];
        const existingPictures = $('#existing_pictures');
        existingPictures.empty();
        picturesArray.forEach((picture) => {
            if (picture) {
                const pictureHtml = `
                    <div class="picture-wrapper" style="position: relative;">
                        <img src="../images/foods/${picture}" alt="${picture}" style="width: 150px; height: 150px; object-fit: cover; border: 1px solid #ddd; border-radius: 5px;">
                        <button type="button" class="remove-picture" data-picture="${picture}" style="position: absolute; top: 5px; right: 5px; background: red; color: white; border: none; border-radius: 50%; width: 20px; height: 20px; font-size: 14px;">X</button>
                    </div>
                `;
                existingPictures.append(pictureHtml);
            }
        });

        // ตั้งค่าการส่งข้อมูล
        $('#updateFoodForm').attr('action', `home_chef.php?fid=${foodId}`); // home_chef.php?fid=${foodId}
    });

// พรีวิวรูปภาพใหม่
$('#food_pictures').on('change', function () {
    const preview = $('#previewEditFood');
    preview.empty(); // ล้างพรีวิวก่อน
    const files = Array.from(this.files); // แปลง FileList เป็น Array

    if (files.length === 0) {
        console.log('No files selected.');
        return;
    }

    files.forEach((file) => {
        // ตรวจสอบว่าเป็นไฟล์รูปภาพ
        if (file.type.startsWith('image/')) {
            const reader = new FileReader();
            reader.onload = (e) => {
                // สร้าง HTML สำหรับแสดงรูปภาพ
                const img = `
                    <img src="${e.target.result}" 
                         alt="Preview" 
                         style="width: 150px; height: 150px; object-fit: cover; border: 1px solid #ddd; border-radius: 5px; margin-right: 10px;">
                `;
                preview.append(img);
            };
            reader.readAsDataURL(file); // อ่านไฟล์เป็น Data URL
        } else {
            console.log(`${file.name} is not an image file.`);
        }
    });
});

    // ลบรูปภาพที่มีอยู่
    $(document).on('click', '.remove-picture', function () {
        const picture = $(this).data('picture');
        const deletedPictures = $('#deleted_pictures');
        const currentValue = deletedPictures.val() ? deletedPictures.val().split(';') : [];
        currentValue.push(picture);
        deletedPictures.val(currentValue.join(';'));
        $(this).closest('.picture-wrapper').remove();
    });
});
</script>
      
      
    </body>
</html>
