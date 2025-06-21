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

 <div class="card card-default border-0 bg-transparent">
  <div class="card-header align-items-center p-0">
    <h2></h2> 
    <a href="#" class="btn btn-success" data-toggle="modal" data-target="#ModalFormAdd">
      <i class="mdi mdi-plus mr-1"></i> เพิ่มทริปท่องเที่ยว
    </a>
  </div>
</div>
              
<!-- Products Inventory -->
<div class="card card-default">
  <div class="card-header">
    <h2><i class="mdi mdi-map"></i> ทริปท่องเที่ยว</h2>
     
      <div class="row text-right">
      ประเภท &nbsp; 
           <button class="btn btn-primary btn-sm category-btn" data-category="all">แสดงทั้งหมด</button>&nbsp;
      <?php
include_once("../connectdb.php");
$sql2 = "SELECT * FROM `tour_category` ORDER BY `tc_id` ASC";
$result2 = $conn->query($sql2);
while ($row2 = $result2->fetch_assoc()) {
?>
					<button class="btn btn-outline-info btn-sm category-btn" data-category="<?=$row2['tc_name'];?>">
						<?=$row2['tc_name'];?>
					</button>&nbsp; 
<?php } ?>
</div>
  </div>
    
  <div class="card-body">
    <table id="productsTable" class="table table-hover table-product" style="width:100%" cellpadding="20">
      <thead>
        <tr>
          <th>Actions</th>
          <th>รูป</th>
          <th>ชื่อทริปท่องเที่ยว</th>
          <th>ID</th>
          <th>ราคา</th>
          <th>ชั่วโมง</th>
          <th>ประเภท</th>
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
        <h5 class="modal-title" id="exampleModalFormTitle"><i class="mdi mdi-plus"></i>เพิ่มทริปท่องเที่ยว</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
        
    <form method="post" action="<?=$_SERVER['PHP_SELF']?>" enctype="multipart/form-data">  
      <div class="modal-body">
          <div class="form-group">
            <label for="t_name">ชื่อทริปท่องเที่ยว</label>
            <input type="text" class="form-control" id="t_name" name="t_name" placeholder="ชื่อทริปท่องเที่ยว" required>
          </div>
          <div class="form-group">
            <label for="t_price">ราคา (บาท)</label>
            <input type="number" class="form-control" id="t_price" name="t_price" placeholder="ราคา (บาท)" required>
          </div>
          <div class="form-group">
            <label for="t_detail">รายละเอียด</label>
            <textarea class="form-control" id="t_detail" name="t_detail" rows="4"></textarea>
          </div>
          <div class="form-group">
            <label for="tc_id">ประเภท</label>
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
        <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="mdi mdi-cancel"></i> ยกเลิก</button>
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
// เพิ่มทริปท่องเที่ยว
if ($_SERVER["REQUEST_METHOD"] == "POST" && $_POST['action'] == "add_tour") {
    $t_name = $_POST['t_name'];
    $t_hour = 3 ;
    $availability = "ทุกวัน" ;
    $t_price = $_POST['t_price'];
    $t_detail = $_POST['t_detail'];
    //$t_daterecord = date('Y-m-d H:i:s');
    $tc_id = $_POST['tc_id'];
    $guide_id = '1'; // ??????????????????

    $uploadDir = "../images/tours/";
    $fileNames = [];
    $fileExtensions = [];

    $sql = "INSERT INTO tours (name, description, hours, price, availability, tc_id, guide_id ) 
            VALUES ('$t_name', '$t_detail', '$t_hour', '$t_price', '$availability', '$tc_id', '$guide_id')";

    if ($conn->query($sql) === TRUE) {
        $lastId = $conn->insert_id;
        
        addLog($conn, $_SESSION['buser_id'], $_SESSION['bfullname'], $_SESSION['brole'], "เพิ่มทริปท่องเที่ยว", "เพิ่มทริปท่องเที่ยว id: {$lastId} {$t_name}");

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
            echo "<script>toastr.success('เพิ่มข้อมูลสำเร็จ!');window.location='tours.php';</script>";
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
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action']) && $_POST['action'] === 'update_tour') {

    // รับค่าจากฟอร์ม
    $t_id = isset($_GET['tid']) ? intval($_GET['tid']) : 0;
    $t_name = isset($_POST['t_name']) ? $_POST['t_name'] : '';
    $t_price = isset($_POST['t_price']) ? floatval($_POST['t_price']) : 0.0;
    $t_detail = isset($_POST['t_detail']) ? $_POST['t_detail'] : '';
    $tc_id = isset($_POST['tc_id']) ? intval($_POST['tc_id']) : 0;

    // ตรวจสอบ ID
    if ($t_id > 0) {
        // อัปเดตข้อมูลพื้นฐานในฐานข้อมูล
        $sqlUpdate = "UPDATE tours SET name = ?, price = ?, description = ?, tc_id = ? WHERE tour_id = ?";
        $stmt = $conn->prepare($sqlUpdate);

        if ($stmt) {
            $stmt->bind_param("sdsii", $t_name, $t_price, $t_detail, $tc_id, $t_id);

            if ($stmt->execute()) {
                // ดึงรูปภาพที่มีอยู่เดิม
                $existingPictures = isset($_POST['existing_pictures']) ? $_POST['existing_pictures'] : '';
                $existingPicturesArray2 = is_string($existingPictures) ? explode(";", $existingPictures) : [];

                // จัดการรูปภาพที่ถูกลบ
                if (isset($_POST['deleted_pictures']) && !empty($_POST['deleted_pictures'])) {
                    $deletedPictures = explode(";", $_POST['deleted_pictures']);
                    foreach ($deletedPictures as $deletedPicture) {
                        $filePath = "../images/tours/" . $deletedPicture;
                        if (file_exists($filePath)) {
                            unlink($filePath); // ลบไฟล์ที่ถูกลบ
                        }
                        //$existingPicturesArray2 = array_diff($existingPicturesArray2, [$deletedPicture]);
                    }
                }

                // อัปโหลดรูปภาพใหม่
                $uploadedPictures = [];
                if (isset($_FILES['tour_pictures']['name']) && !empty($_FILES['tour_pictures']['name'][0])) {
                    for ($i = 0; $i < count($_FILES['tour_pictures']['name']); $i++) {
                        $fileName = $_FILES['tour_pictures']['name'][$i];
                        $fileTmpName = $_FILES['tour_pictures']['tmp_name'][$i];
                        $fileExtension = pathinfo($fileName, PATHINFO_EXTENSION);

                        // ตั้งชื่อไฟล์ใหม่ตามรูปแบบ <รหัส>-<ลำดับ>.<นามสกุลไฟล์>
                        $newFileName = $t_id . '-' . ($i + 1) . '.' . $fileExtension;

                        // ตรวจสอบและย้ายไฟล์
                        if (move_uploaded_file($fileTmpName, "../images/tours/" . $newFileName)) {
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
       
                    // รวมรูปภาพเดิมและรวมรูปภาพใหม่
                    $updatedPictures = array_merge($imgLasted, $uploadedPictures);
                    $updatedPictures_unique = array_unique($updatedPictures);
                    $picturesString = implode(";", $updatedPictures_unique);
                }

                // อัปเดตรูปภาพในฐานข้อมูล
                if (!empty($picturesString)) {
                    $sqlUpdatePictures = "UPDATE tours SET t_pictures = ? WHERE tour_id = ?";
                    $stmtUpdatePictures = $conn->prepare($sqlUpdatePictures);
                    if ($stmtUpdatePictures) {
                        $stmtUpdatePictures->bind_param("si", $picturesString, $t_id);
                        if ($stmtUpdatePictures->execute()) {
                            addLog($conn, $_SESSION['buser_id'], $_SESSION['bfullname'], $_SESSION['brole'], "แก้ไขทริปท่องเที่ยว", "แก้ไขทริปท่องเที่ยว id: {$t_id} {$t_name}");
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
        echo "<script>toastr.error('ไม่พบ ID ที่ต้องการแก้ไข');</script>";
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
        <p>คุณต้องการลบ  "<span id="tourName"></span>" ใช่หรือไม่ ?</p>
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
    const tourId = button.data('id'); // ดึง ID 
    const tourName = button.data('name'); // ดึงชื่อ

    // ตั้งค่าข้อความชื่อทริป ใน Modal
    $('#tourName').text(tourName);

    // ตั้งค่า Event สำหรับปุ่มยืนยันลบ
    $('#confirmDelete').off('click').on('click', function () {
      $('#deleteModal').modal('hide'); // ปิด Modal
      deleteTour(tourId); // เรียกฟังก์ชันลบ
    });

    // ตั้งค่า focus ไปที่ปุ่ม "ลบ" เพื่อให้ผู้ใช้สามารถใช้คีย์บอร์ดได้ง่าย
    $('#confirmDelete').focus();
  });
});

function deleteTour(tourId) {
  if (tourId) {
    $.ajax({
      url: 'tour_delete.php',
      type: 'POST',
      data: { tour_id: tourId },
      success: function (response) {
        try {
          const data = typeof response === 'string' ? JSON.parse(response) : response;
          if (data.success) {
            toastr.success(data.message);
            $('#deleteModal').modal('hide'); // ปิด Modal

            // อัปเดต DataTable
            const table = $('#productsTable').DataTable();
            const row = $(`a[data-id="${tourId}"]`).closest('tr'); // ใช้ <a> แทน <button>
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
        if ($.fn.DataTable.isDataTable('#productsTable')) {
            $('#productsTable').DataTable().destroy(); // ลบ DataTable เดิม
        }
        
        // ตั้งค่า DataTables โดยใช้ fetch() แทน ajax
        const table = $('#productsTable').DataTable({
            "processing": true,  // เปิดแสดงข้อความว่า "กำลังประมวลผล"
            "serverSide": false, // ใช้ client-side processing
            "pageLength": 25,
            "columns": [
                {
                    "data": "t_id",  // ใช้ข้อมูล t_id ในการแสดงปุ่ม
                    "render": function(data, type, row) {
                        // การแสดงปุ่มแก้ไขและลบ
                        return `
                            <a href="#" class="mb-1 btn btn-warning btn-sm product-update" data-id="${row.tour_id}" title="แก้ไข">
                                <i class="mdi mdi-lead-pencil"></i>
                            </a>
                            <a href="#" class="mb-1 btn btn-danger btn-sm" data-toggle="modal" data-target="#deleteModal" data-id="${row.tour_id}" data-name="${row.name}" title="ลบ">
                                <i class="mdi mdi-delete-forever"></i>
                            </a>
                        `;
                    }
                },
                { 
                    "data": "t_pictures",
                    "render": function(data) {
                        var picturesArray = data.split(';');
                        return picturesArray.length > 0 && picturesArray[0] ? `<img src='../images/tours/${picturesArray[0]}'>` : '';
                    }
                },
                { "data": "name" },
                { "data": "tour_id" },
                { 
                    "data": "price",
                    "render": function(data) {
                        return (Number(data) && !isNaN(data)) ? Number(data).toLocaleString() : data;
                    } 
                },
                { "data": "hours"},
                { "data": "tc_name" },
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
        
        // ฟังก์ชันสำหรับคลิกปุ่มประเภท
        $(".category-btn").on("click", function() {
            var category = $(this).data("category");

            if (category === "all") {
                // ถ้าเลือก "แสดงทั้งหมด" ให้ค้นหาค่าเป็นค่าว่าง
                table.column(6).search("").draw(); // ค้นหาตาม tc_name
            } else {
                // ถ้าเลือกประเภทใด ๆ ให้ค้นหาตาม fc_name ที่เลือก
                table.column(6).search(category).draw(); // ค้นหาตาม tc_name
            }
        });
        
        // ใช้ fetch เพื่อดึงข้อมูล
        fetch('fetch_data_tours.php')
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
                <h5 class="modal-title" id="ModalFormUpdateLabel"><i class="mdi mdi-lead-pencil"></i> แก้ไขข้อมูลทริปท่องเที่ยว</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="updateProductForm" method="post" enctype="multipart/form-data">
                <div class="modal-body">
                    <div class="form-group">
                        <label for="t_name2">ชื่อทริปท่องเที่ยว</label>
                        <input type="text" class="form-control" id="t_name2" name="t_name" required>
                    </div>
                    <div class="form-group">
                        <label for="t_price2">ราคา</label>
                        <input type="number" class="form-control" id="t_price2" name="t_price" required>
                    </div>
                  <div class="form-group">
                    <label for="t_detail2">รายละเอียด</label>
                    <textarea class="form-control" id="t_detail2" name="t_detail" rows="4"></textarea>
                  </div>
                    <div class="form-group">
                        <label for="tc_id2">ประเภท</label>
                        <select class="form-control" id="tc_id2" name="tc_id" required>
                            <!-- ตัวเลือกประเภท -->
                            <?php
                            $sql_category = "SELECT * FROM tour_category";
                            $result_category = $conn->query($sql_category);
                            while ($row_category = $result_category->fetch_assoc()) {
                                echo "<option value='" . htmlspecialchars($row_category['tc_id'], ENT_QUOTES, 'UTF-8') . "'>" . htmlspecialchars($row_category['tc_name'], ENT_QUOTES, 'UTF-8') . "</option>";
                            }
                            ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="tour_pictures">รูปภาพ</label>
                        <input type="hidden" name="existing_pictures" id="existing_pictures2">
                        <input type="file" class="form-control-file" id="tour_pictures" name="tour_pictures[]" multiple>
                    </div>
                    <div id="existing_pictures" style="display: flex; gap: 10px; flex-wrap: wrap;"></div>
                    
                    <div id="previewEditProduct" style="display: flex; gap: 0px; flex-wrap: wrap;"></div>
                    
                    <input type="hidden" name="deleted_pictures" id="deleted_pictures">
                </div>
                <div class="modal-footer">
                    <input type="hidden" name="action" value="update_tour">
                    <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="mdi mdi-cancel"></i> ยกเลิก</button>
                    <button type="submit" class="btn btn-primary"><i class="mdi mdi-content-save"></i> บันทึก</button>
                </div>
            </form>
        </div>
    </div>
</div>

      
<script>
$(document).ready(function () {
    // เปิด Modal พร้อมกรอกข้อมูล
    $(document).on('click', '.product-update', function () {
        $('#ModalFormUpdate').modal('show');
        
        const tourId = $(this).data('id') ;
        const rowData = table.row($(this).closest('tr')).data();

        if (!rowData) {
            console.error("Row data is not available.");
            return;
        }

        // เติมข้อมูลลงในฟอร์ม
        $('#t_name2').val(rowData.name || '');
        $('#t_price2').val(rowData.price || 0);
        $('#t_detail2').val(rowData.description || '');
        $('#tc_name2').val(rowData.tc_name || '');
        $('#tc_id2').val(rowData.tc_id || '');
        $('#existing_pictures2').val(rowData.t_pictures || '');

        // แสดงรูปภาพที่มีอยู่
        const picturesArray = rowData.t_pictures ? rowData.t_pictures.split(';') : [];
        const existingPictures = $('#existing_pictures');
        existingPictures.empty();
        picturesArray.forEach((picture) => {
            if (picture) {
                const pictureHtml = `
                    <div class="picture-wrapper" style="position: relative;">
                        <img src="../images/tours/${picture}" alt="${picture}" style="width: 150px; height: 150px; object-fit: cover; border: 1px solid #ddd; border-radius: 5px;">
                        <button type="button" class="remove-picture" data-picture="${picture}" style="position: absolute; top: 5px; right: 5px; background: red; color: white; border: none; border-radius: 50%; width: 20px; height: 20px; font-size: 14px;">X</button>
                    </div>
                `;
                existingPictures.append(pictureHtml);
            }
        });

        // ตั้งค่าการส่งข้อมูล
        $('#updateProductForm').attr('action', `tours.php?tid=${tourId}`);
    });

// พรีวิวรูปภาพใหม่
$('#tour_pictures').on('change', function () {
    const preview = $('#previewEditProduct');
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
      
      
<?php if (isset($_GET['openModal'])): ?>
    <script>
        $(document).ready(function () {
            // แสดง Modal
            //$('#ModalFormUpdate').modal('show');

            // รับค่า tid จาก GET
            const tourId = "<?php echo $_GET['tid']; ?>";

            // ใช้ MutationObserver เพื่อตรวจสอบเมื่อ .product-update ถูกเพิ่มใน DOM
            const observer = new MutationObserver(() => {
                const productUpdateButton = $('.product-update');
                if (productUpdateButton.length > 0) {
                    // ตั้งค่า data-id และจำลองการคลิก
                    productUpdateButton.attr('data-id', tourId).trigger('click');
                    observer.disconnect(); // หยุดการสังเกต
                }
            });

            // เริ่มสังเกตการเปลี่ยนแปลงของ DOM
            observer.observe(document.body, { childList: true, subtree: true });
        });
    </script>
<?php endif; ?>




    </body>
</html>
