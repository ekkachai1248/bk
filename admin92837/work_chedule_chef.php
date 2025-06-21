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
              
  <nav aria-label="breadcrumb" class="my-0 m-0">
    <ol class="breadcrumb">
      <li class="breadcrumb-item">  <a href="home_chef.php">หน้าหลัก  </a>  </li>
      <li class="breadcrumb-item active" aria-current="page">รายการจอง  </li>
    </ol>
  </nav>
              
<div class="container col-md-6">
    <div class="justify-content-center">
        <div class="card card-default card-profile">
          <div class="card-body mt-1 justify-content-center text-center">
            <h4><i class="mdi mdi-cash-multiple"></i> รายได้สะสม <span id="total_income" class="text-success"></span> บาท</h4>            
          </div>
        </div>
    </div> 
</div>              
              
              
<!-- Users -->
<div class="card card-default">
  <div class="card-header">
    <h2><i class="mdi mdi-table"></i> รายการจอง</h2>
     
      <div class="row text-right">
      
      </div>
  </div>
    
  <div class="card-body">
    <table id="toursTable" class="table table-hover" style="width:100%" cellpadding="20">
      <thead>
        <tr>
          <th>...</th>
          <th>ชื่อเมนูอาหาร</th>
          <th>วันที่จอง</th>
          <th>รอบ</th>
          <th>จำนวน</th>
          <th>ราคา/หน่วย</th>
          <th>ชื่อลูกค้าที่จอง</th>
          <th>สถานะ</th>
        </tr>
      </thead>
      <tbody>
<?php
include_once("../connectdb.php");
$sql = "SELECT
booking_details.id,
bookings.booking_date,
bookings.fullname,
booking_details.item_id,
booking_details.item_name,
booking_details.booking_round,
booking_details.booking_date AS bk_dt_bookdate,
booking_details.type,
booking_details.quantity,
booking_details.price_per_unit,
booking_details.total_price,
bookings.order_status
FROM
bookings
INNER JOIN booking_details ON booking_details.booking_id = bookings.id
INNER JOIN foods ON booking_details.item_id = foods.f_id
WHERE
booking_details.type = 'food' AND
foods.c_id = '{$_SESSION['buser_id']}'
ORDER BY
bookings.id DESC
";
$result = $conn->query($sql);
$total_prices = 0;
while ($row = $result->fetch_assoc()){ 
    
    $total_prices += $row['total_price'];
    
    $sqlImg = "SELECT `f_pictures` FROM `foods` WHERE `f_id`='{$row['item_id']}' ";
    $rsImg = $conn->query($sqlImg);
    $rowImg = $rsImg->fetch_assoc();
    $img = explode(";", $rowImg['f_pictures']);
?>
        <tr>
          <td>
              <!--<a href="#" class="btn btn-warning btn-sm pr-3 pl-3" title="แก้ไข" data-toggle="modal" data-target="#ModalFormUpdate" data-id="<?php echo $row['id'];?>" data-name="<?php echo $row['item_name'];?>" data-date="<?php echo $row['booking_date'];?>" data-round="<?php echo $row['booking_round'];?>" data-quantity="<?php echo $row['quantity'];?>"><i class="mdi mdi-lead-pencil"></i></a>
                            
              <a href="#" class="btn btn-danger btn-sm pr-3 pl-3" title="ลบ" data-toggle="modal" data-target="#deleteModal" data-id="<?php echo $row['id']; ?>"><i class="mdi mdi-delete-forever"></i></a>-->
              
              <a href="../images/foods/<?php echo $img[0];?>" target="_blank"><img src="../images/foods/<?php echo $img[0];?>" width="90"></a>
          </td>
          <td><a href="../food_detail.php?fid=<?php echo $row['item_id'];?>" target="_blank" style="text-decoration: none;" class="text-success"><?php echo $row['item_name'];?></a></td>
          <td><?php echo $row['booking_date'];?></td>
          <td><?php echo $row['booking_round'];?></td>
          <td><?php echo $row['quantity'];?></td>
          <td><?php echo number_format($row['price_per_unit'],0);?></td>
          <td><?php echo $row['fullname'];?></td>
          <td class="<?php echo ($row['order_status']=='ยกเลิก')?'text-danger':'text-dark';?>"><?php echo $row['order_status'];?></td>
        </tr>
<?php } ?>
      </tbody>
    </table>

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
      
      
<script>
    $(document).ready(function() {
        
    // สร้าง DataTable
    var table = $('#toursTable').DataTable({
        pageLength: 50
    });
        
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
      
<script>
var totalIncome = <?php echo json_encode($total_prices); ?>;

// ตรวจสอบว่า totalIncome เป็นตัวเลขหรือไม่
if (!isNaN(totalIncome)) {
    document.getElementById("total_income").innerText = totalIncome.toLocaleString('en-US', { minimumFractionDigits: 0, maximumFractionDigits: 0 });
} else {
    document.getElementById("total_income").innerText = "0";
}
</script>
      
    </body>
</html>
