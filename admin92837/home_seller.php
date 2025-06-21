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
      
  <title>Local buengkan - ผู้ขายสินค้า</title>

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
      
<?php include("left-sidebar-seller.php"); ?>      

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
      <i class="mdi mdi-plus mr-1"></i> เพิ่มสินค้า/ของฝาก
    </a>
  </div>
</div>
              
<!-- Products Inventory -->
<div class="card card-default">
  <div class="card-header">
    <h2><i class="mdi mdi-shopping"></i> สินค้า/ของฝาก</h2>
     
      <div class="row text-right">
      ประเภทสินค้า/ของฝาก &nbsp; 
           <button class="btn btn-primary btn-sm category-btn" data-category="all">แสดงทั้งหมด</button>&nbsp;
      <?php
include_once("../connectdb.php");
$sql2 = "SELECT * FROM `products_category` ORDER BY `pc_id` ASC";
$result2 = $conn->query($sql2);
while ($row2 = $result2->fetch_assoc()) {
?>
					<button class="btn btn-outline-info btn-sm category-btn" data-category="<?=$row2['pc_name'];?>">
						<?=$row2['pc_name'];?>
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
          <th>ชื่อสินค้า/ของฝาก</th>
          <th>ID</th>
          <th>ราคา</th>
          <th>ประเภท</th>
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
        <h5 class="modal-title" id="exampleModalFormTitle"><i class="mdi mdi-plus"></i>เพิ่มสินค้า/ของฝาก</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
        
    <form method="post" action="<?=$_SERVER['PHP_SELF']?>" enctype="multipart/form-data">  
      <div class="modal-body">
          <div class="form-group">
            <label for="p_name">ชื่อสินค้า/ของฝาก</label>
            <input type="text" class="form-control" id="p_name" name="p_name" placeholder="ชื่อสินค้า/ของฝาก" required>
          </div>
          <div class="form-group">
            <label for="p_price">ราคา/หน่วย (บาท)</label>
            <input type="number" class="form-control" id="p_price" name="p_price" placeholder="ราคา/หน่วย (บาท)" required>
          </div>
          <div class="form-group">
            <label for="p_detail">รายละเอียด</label>
            <textarea class="form-control" id="p_detail" name="p_detail" rows="4"></textarea>
          </div>
          <div class="form-group">
            <label for="fcid">ประเภท</label>
            <select class="form-control" id="pc_id" name="pc_id">
<?php
$sql3 = "SELECT * FROM `products_category` ORDER BY `pc_name` ASC";
$result3 = $conn->query($sql3);
while ($row3 = $result3->fetch_assoc()) {
?>
 <option value="<?=$row3['pc_id'];?>"><?=$row3['pc_name'];?></option>
<?php } ?>   
              </select>
          </div>
            
<div class="form-group">
    <label for="p_pictures">รูปภาพ</label>
    <input type="file" class="form-control-file" id="p_pictures" name="p_pictures[]" multiple required>
</div>
<div id="preview" style="display: flex; gap: 10px; flex-wrap: wrap;"></div>

<script>
    document.getElementById('p_pictures').addEventListener('change', function(event) {
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
            <input type="hidden" name="action" value="add_product">
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
// เพิ่มสินค้า/ของฝาก
if ($_SERVER["REQUEST_METHOD"] == "POST" && $_POST['action'] == "add_product") {
    $p_name = $_POST['p_name'];
    $p_price = $_POST['p_price'];
    $p_detail = $_POST['p_detail'];
    $p_daterecord = date('Y-m-d H:i:s');
    $pc_id = $_POST['pc_id'];
    $seller_id = $_SESSION['buser_id']; 

    $uploadDir = "../images/products/";
    $fileNames = [];
    $fileExtensions = [];

    $sql = "INSERT INTO products (p_name, p_detail, p_price, p_daterecord, pc_id, seller_id ) 
            VALUES ('$p_name', '$p_detail', '$p_price', '$p_daterecord', '$pc_id', '$seller_id')";

    if ($conn->query($sql) === TRUE) {
        $lastId = $conn->insert_id;
        
        addLog($conn, $_SESSION['buser_id'], $_SESSION['bfullname'], $_SESSION['brole'], "เพิ่มสินค้า", "เพิ่มสินค้าของตนเอง id: {$lastId} {$p_name}");

        // ตรวจสอบและอัปโหลดรูปภาพหลายรูป
        if (!empty($_FILES['p_pictures']['name'][0])) {
            foreach ($_FILES['p_pictures']['tmp_name'] as $key => $tmp_name) {
                $fileName = basename($_FILES['p_pictures']['name'][$key]);
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
        $p_pictures = implode(";", $fileNames);

        // อัปเดตข้อมูลรูปภาพในฐานข้อมูล 
        $updateSql = "UPDATE products SET p_pictures='$p_pictures' WHERE p_id='$lastId'";
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
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action']) && $_POST['action'] === 'update_product') {

    // รับค่าจากฟอร์ม
    $p_id = isset($_GET['pid']) ? intval($_GET['pid']) : 0;
    $p_name = isset($_POST['p_name']) ? $_POST['p_name'] : '';
    $p_price = isset($_POST['p_price']) ? floatval($_POST['p_price']) : 0.0;
    $p_detail = isset($_POST['p_detail']) ? $_POST['p_detail'] : '';
    $pc_id = isset($_POST['pc_id']) ? intval($_POST['pc_id']) : 0;

    // ตรวจสอบ ID
    if ($p_id > 0) {
        // อัปเดตข้อมูลพื้นฐานในฐานข้อมูล
        $sqlUpdate = "UPDATE products SET p_name = ?, p_price = ?, p_detail = ?, pc_id = ? WHERE p_id = ?";
        $stmt = $conn->prepare($sqlUpdate);

        if ($stmt) {
            $stmt->bind_param("sdsii", $p_name, $p_price, $p_detail, $pc_id, $p_id);

            if ($stmt->execute()) {
                // ดึงรูปภาพที่มีอยู่เดิม
                $existingPictures = isset($_POST['existing_pictures']) ? $_POST['existing_pictures'] : '';
                $existingPicturesArray2 = is_string($existingPictures) ? explode(";", $existingPictures) : [];

                // จัดการรูปภาพที่ถูกลบ
                if (isset($_POST['deleted_pictures']) && !empty($_POST['deleted_pictures'])) {
                    $deletedPictures = explode(";", $_POST['deleted_pictures']);
                    foreach ($deletedPictures as $deletedPicture) {
                        $filePath = "../images/products/" . $deletedPicture;
                        if (file_exists($filePath)) {
                            unlink($filePath); // ลบไฟล์ที่ถูกลบ
                        }
                        //$existingPicturesArray2 = array_diff($existingPicturesArray2, [$deletedPicture]);
                    }
                }

                // อัปโหลดรูปภาพใหม่
                $uploadedPictures = [];
                if (isset($_FILES['product_pictures']['name']) && !empty($_FILES['product_pictures']['name'][0])) {
                    for ($i = 0; $i < count($_FILES['product_pictures']['name']); $i++) {
                        $fileName = $_FILES['product_pictures']['name'][$i];
                        $fileTmpName = $_FILES['product_pictures']['tmp_name'][$i];
                        $fileExtension = pathinfo($fileName, PATHINFO_EXTENSION);

                        // ตั้งชื่อไฟล์ใหม่ตามรูปแบบ <รหัส>-<ลำดับ>.<นามสกุลไฟล์>
                        $newFileName = $p_id . '-' . ($i + 1) . '.' . $fileExtension;

                        // ตรวจสอบและย้ายไฟล์
                        if (move_uploaded_file($fileTmpName, "../images/products/" . $newFileName)) {
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
                    $sqlUpdatePictures = "UPDATE products SET p_pictures = ? WHERE p_id = ?";
                    $stmtUpdatePictures = $conn->prepare($sqlUpdatePictures);
                    if ($stmtUpdatePictures) {
                        $stmtUpdatePictures->bind_param("si", $picturesString, $p_id);
                        if ($stmtUpdatePictures->execute()) {
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
        echo "<script>toastr.error('ไม่พบ ID ของสินค้าที่ต้องการแก้ไข');</script>";
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
        <p>คุณต้องการลบ  "<span id="productName"></span>" ใช่หรือไม่ ?</p>
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
    const productId = button.data('id'); // ดึง ID 
    const productName = button.data('name'); // ดึงชื่อ

    // ตั้งค่าข้อความชื่ออาหาร ใน Modal
    $('#productName').text(productName);

    // ตั้งค่า Event สำหรับปุ่มยืนยันลบ
    $('#confirmDelete').off('click').on('click', function () {
      $('#deleteModal').modal('hide'); // ปิด Modal
      deleteProduct(productId); // เรียกฟังก์ชันลบ
    });

    // ตั้งค่า focus ไปที่ปุ่ม "ลบ" เพื่อให้ผู้ใช้สามารถใช้คีย์บอร์ดได้ง่าย
    $('#confirmDelete').focus();
  });
});

function deleteProduct(productId) {
  if (productId) {
    $.ajax({
      url: 'product_delete.php',
      type: 'POST',
      data: { product_id: productId },
      success: function (response) {
        try {
          const data = typeof response === 'string' ? JSON.parse(response) : response;
          if (data.success) {
            toastr.success(data.message);
            $('#deleteModal').modal('hide'); // ปิด Modal

            // อัปเดต DataTable
            const table = $('#productsTable').DataTable();
            const row = $(`a[data-id="${productId}"]`).closest('tr'); // ใช้ <a> แทน <button>
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
            "pageLength": 10,
            "columns": [
                {
                    "data": "p_id",  // ใช้ข้อมูล p_id ในการแสดงปุ่ม
                    "render": function(data, type, row) {
                        // การแสดงปุ่มแก้ไขและลบ
                        return `
                            <a href="#" class="mb-1 btn btn-warning btn-sm product-update" data-id="${data}" title="แก้ไข">
                                <i class="mdi mdi-lead-pencil"></i>
                            </a>
                            <a href="#" class="mb-1 btn btn-danger btn-sm" data-toggle="modal" data-target="#deleteModal" data-id="${data}" data-name="${row.p_name}" title="ลบ">
                                <i class="mdi mdi-delete-forever"></i>
                            </a>
                        `;
                    }
                },
                { 
                    "data": "p_pictures",
                    "render": function(data) {
                        var picturesArray = data.split(';');
                        return picturesArray.length > 0 && picturesArray[0] ? `<img src='../images/products/${picturesArray[0]}'>` : '';
                    }
                },
                { "data": "p_name" },
                { "data": "p_id" },
                { 
                    "data": "p_price",
                    "render": function(data) {
                        return (Number(data) && !isNaN(data)) ? Number(data).toLocaleString() : data;
                    } 
                },
                { "data": "pc_name" },
                { "data": "p_daterecord" },
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
                table.column(5).search("").draw(); // ค้นหาตาม fc_name
            } else {
                // ถ้าเลือกประเภทใด ๆ ให้ค้นหาตาม fc_name ที่เลือก
                table.column(5).search(category).draw(); // ค้นหาตาม fc_name
            }
        });
        
        // ใช้ fetch เพื่อดึงข้อมูล
        fetch('fetch_data_products_seller.php')
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
                <h5 class="modal-title" id="ModalFormUpdateLabel"><i class="mdi mdi-lead-pencil"></i> แก้ไขข้อมูลสินค้า/ของฝาก</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="updateProductForm" method="post" enctype="multipart/form-data">
                <div class="modal-body">
                    <div class="form-group">
                        <label for="p_name2">ชื่อสินค้า/ของฝาก</label>
                        <input type="text" class="form-control" id="p_name2" name="p_name" required>
                    </div>
                    <div class="form-group">
                        <label for="p_price2">ราคา</label>
                        <input type="number" class="form-control" id="p_price2" name="p_price" required>
                    </div>
                  <div class="form-group">
                    <label for="p_detail2">รายละเอียด</label>
                    <textarea class="form-control" id="p_detail2" name="p_detail" rows="4"></textarea>
                  </div>
                    <div class="form-group">
                        <label for="fc_name2">ประเภทสินค้า/ของฝาก</label>
                        <select class="form-control" id="pc_id2" name="pc_id" required>
                            <!-- ตัวเลือกประเภท -->
                            <?php
                            $sql_category = "SELECT * FROM products_category";
                            $result_category = $conn->query($sql_category);
                            while ($row_category = $result_category->fetch_assoc()) {
                                echo "<option value='" . htmlspecialchars($row_category['pc_id'], ENT_QUOTES, 'UTF-8') . "'>" . htmlspecialchars($row_category['pc_name'], ENT_QUOTES, 'UTF-8') . "</option>";
                            }
                            ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="product_pictures">รูปภาพ</label>
                        <input type="hidden" name="existing_pictures" id="existing_pictures2">
                        <input type="file" class="form-control-file" id="product_pictures" name="product_pictures[]" multiple>
                    </div>
                    <div id="existing_pictures" style="display: flex; gap: 10px; flex-wrap: wrap;"></div>
                    
                    <div id="previewEditProduct" style="display: flex; gap: 0px; flex-wrap: wrap;"></div>
                    
                    <input type="hidden" name="deleted_pictures" id="deleted_pictures">
                </div>
                <div class="modal-footer">
                    <input type="hidden" name="action" value="update_product">
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
    $(document).on('click', '.product-update', function () {
        $('#ModalFormUpdate').modal('show');
        
        const productId = $(this).data('id');
        const rowData = table.row($(this).closest('tr')).data();

        if (!rowData) {
            console.error("Row data is not available.");
            return;
        }

        // เติมข้อมูลลงในฟอร์ม
        $('#p_name2').val(rowData.p_name || '');
        $('#p_price2').val(rowData.p_price || 0);
        $('#p_detail2').val(rowData.p_detail || '');
        $('#pc_name2').val(rowData.pc_name || '');
        $('#pc_id2').val(rowData.pc_id || '');
        $('#existing_pictures2').val(rowData.p_pictures || '');

        // แสดงรูปภาพที่มีอยู่
        const picturesArray = rowData.p_pictures ? rowData.p_pictures.split(';') : [];
        const existingPictures = $('#existing_pictures');
        existingPictures.empty();
        picturesArray.forEach((picture) => {
            if (picture) {
                const pictureHtml = `
                    <div class="picture-wrapper" style="position: relative;">
                        <img src="../images/products/${picture}" alt="${picture}" style="width: 150px; height: 150px; object-fit: cover; border: 1px solid #ddd; border-radius: 5px;">
                        <button type="button" class="remove-picture" data-picture="${picture}" style="position: absolute; top: 5px; right: 5px; background: red; color: white; border: none; border-radius: 50%; width: 20px; height: 20px; font-size: 14px;">X</button>
                    </div>
                `;
                existingPictures.append(pictureHtml);
            }
        });

        // ตั้งค่าการส่งข้อมูล
        $('#updateProductForm').attr('action', `products.php?pid=${productId}`);
    });

// พรีวิวรูปภาพใหม่
$('#product_pictures').on('change', function () {
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
      
      
    </body>
</html>
