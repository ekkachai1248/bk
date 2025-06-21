<?php
include_once("checklogin.php");
include_once("connectdb.php");

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // รับข้อมูลที่ส่งมาจากฟอร์ม
    $foods = json_decode($_POST['Foods']);
    $tours = json_decode($_POST['Tours']);
    $homestays = json_decode($_POST['Homestays']);
    $startDate = json_decode($_POST['startDate']);
    $endDate = json_decode($_POST['endDate']);
    
    // หาจำนวนวัน
    $days = (new DateTime($startDate))->diff(new DateTime($endDate))->days+1;
    
    // ฟังก์ชันสำหรับสร้างเงื่อนไข LIKE
    function create_like_condition($items, $columns) {
        return implode(" OR ", array_map(function($item) use ($columns) {
            return implode(" OR ", array_map(function($col) use ($item) {
                return "$col LIKE '%$item%'";
            }, $columns));
        }, $items));
    }

    // เตรียมเงื่อนไข LIKE สำหรับแต่ละตาราง
    $food_condition = create_like_condition($foods, ['f_name', 'f_detail']);
    $tour_condition = create_like_condition($tours, ['name', 'description']);
    $homestay_condition = create_like_condition($homestays, ['h_name', 'h_detail']);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Local Buengkan - Trip Results</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/png" href="images/icons/favicon.png"/>
    <link rel="stylesheet" type="text/css" href="css/main.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Prompt&family=Kanit&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <style>
        body {
            font-family: "Prompt", serif;
            font-size: 14px;
        }
    </style>
</head>
<body>
    
<div id="loading" class="mt-5 img-fluid" align="center">
    <img src="images/loading2.gif" alt="Loading...">
</div>

<div id="content" style="display: none;">
    <div class="container mt-5"><h4>&gt;&gt; ทริปจำนวน <?php echo $days;?> วัน</h4><span>ท่านสามารถจัดการเพิ่มหรือลบจำนวนได้อย่างสะดวก เมื่อเสร็จเรียบร้อยให้คลิกปุ่ม <span class="text-primary">"ยืนยันการจอง (Confirm)"</span> ด้านล่าง</span></div>
<?php
// สร้าง DateTime จากวันที่เริ่มต้นและวันที่สิ้นสุด
$start = new DateTime($startDate);
$end = new DateTime($endDate);
$end->modify('+1 day'); // เพิ่ม 1 วันให้กับ $end เพื่อให้รวมวันที่สิ้นสุดในลูป

// วนลูปและแสดงผลลัพธ์ตามจำนวนวันที่รับ
for ($date = $start; $date < $end; $date->modify('+1 day')) {
    $dd = $date->format('Y-m-d');
?>
<div class="d-flex align-items-center justify-content-center h-100">
  <div class="container border border-primary rounded p-3 m-4">
  <form>
    <div class="row"><h5 class="p-3 text-info">วันที่ <?php echo $dd;?></h5></div>
    
<?php
//$act_groups = array("มื้ออาหารเช้า", "ทริปรอบเช้า", "มื้ออาหารเที่ยง", "ทริปรอบบ่าย", "มื้ออาหารเย็น", "ที่พัก");
$act_groups = array(
    array("name" => "มื้ออาหารเช้า", "name_en" => "Breakfast", "time" => "06.00-08.00 น."),
    array("name" => "ทริปรอบเช้า", "name_en" => "Morning trip", "time" => "09.00-12.00 น."),
    array("name" => "มื้ออาหารเที่ยง", "name_en" => "Lunch", "time" => "12.00-13.00 น."),
    array("name" => "ทริปรอบบ่าย", "name_en" => "Afternoon Trip", "time" => "13.00-16.00 น."),
    array("name" => "มื้ออาหารเย็น", "name_en" => "Dinner", "time" => "18.00-20.00 น."),
    array("name" => "ที่พัก", "name_en" => "", "time" => "All night")
);

// วนลูปแต่ละกิจกรรม
foreach ($act_groups as $index => $act_group) {
    $act_name = $act_group['name'];
    $booking_round = $act_group['name_en'];
    $gid = $index + 1;

    // ค้นหาข้อมูลจากฐานข้อมูลโดยการสุ่มข้อมูลใหม่สำหรับแต่ละกิจกรรม
    $result_foods = $conn->query("SELECT * FROM foods WHERE $food_condition ORDER BY RAND() LIMIT 10");  // เพิ่ม LIMIT 10 สำหรับมื้ออาหาร
    $result_tours = $conn->query("SELECT * FROM tours WHERE $tour_condition ORDER BY RAND() LIMIT 1");
    $result_homestays = $conn->query("SELECT * FROM homestays WHERE $homestay_condition ORDER BY RAND() LIMIT 1");
?> 
  <div class="row">
    <div class="col-3 p-3">
      <?php echo $act_name; ?> &gt;&gt;
    </div>
    <div class="col-9">
      <table class="table table-striped ">
        <!-- แสดงข้อมูลที่สุ่มจากตาราง foods (มื้ออาหารเช้า, มื้ออาหารเที่ยง, มื้ออาหารเย็น) -->
        <?php if ($act_name === "มื้ออาหารเช้า" || $act_name === "มื้ออาหารเที่ยง" || $act_name === "มื้ออาหารเย็น") { ?>
          <?php 
            while ($row = $result_foods->fetch_assoc()) { 
              $resultF = $conn->query("SELECT f_detail, f_pictures FROM foods WHERE f_id='{$row['f_id']}'");
              $rowF = $resultF->fetch_assoc();
              $imgF = explode(";",$rowF['f_pictures']);  
              ?>
            <tr class="item-row" data-id="<?php echo $row['f_id']; ?>" data-price="<?php echo $row['f_price']; ?>" data-bookingdate="<?php echo $dd;?>" data-bookinground="<?php echo $booking_round;?>">
              <td><input type="checkbox" id="foodSelect" name="foods[<?php echo $index; ?>][selected]" value="1" checked></td>
              <td class="text-success col-3">
              <a href="food_detail.php?fid=<?php echo $row['f_id']; ?>" target="_blank" style="text-decoration: none"><?php echo $row['f_name']; ?><br>
              <img src="images/foods/<?php echo $imgF[0];?>" width="100" title="<?php echo $row['f_name']; ?>" alt="<?php echo $row['item_name']; ?>"></a></td>
            </td>
              <td class="col-1"><?php echo number_format($row['f_price'],0); ?></td>
              <td class="col-2"><input type="number" min="1" value="1" id="foodQuantity" style="width: 45px"> ที่</td>
              <td><?php echo $row['f_detail']; ?></td>
              <td align="right"><button class="btn-sm btn-danger">ลบ</button></td>
            </tr>
          <?php } ?>
        <?php } ?>
        
        <!-- แสดงข้อมูลที่สุ่มจากตาราง tours -->
        <?php if ($act_name === "ทริปรอบเช้า" || $act_name === "ทริปรอบบ่าย") { ?>
          <?php 
            while ($row = $result_tours->fetch_assoc()) { 
              $resultT = $conn->query("SELECT description, t_pictures FROM tours WHERE tour_id='{$row['tour_id']}'");
              $rowT = $resultT->fetch_assoc();
              $imgT = explode(";",$rowT['t_pictures']);
              ?>
            <tr class="item-row" data-id="<?php echo $row['tour_id']; ?>" data-price="<?php echo $row['price']; ?>" data-bookingdate="<?php echo $dd;?>" data-bookinground="<?php echo $booking_round;?>">
              <td><input type="checkbox" id="tourSelect" name="tours[<?php echo $index; ?>][selected]" value="1" checked></td>
              <td class="text-success col-3">
              <a href="tour_detail.php?tid=<?php echo $row['tour_id']; ?>" target="_blank" style="text-decoration: none"><?php echo $row['name']; ?><br><img src="images/tours/<?php echo $imgT[0];?>" width="100" title="<?php echo $row['name']; ?>" alt="<?php echo $row['name']; ?>"></a>
              </td>
              <td class="col-1"><?php echo number_format($row['price'],0); ?></td>
              <td class="col-2"><input type="number" min="1" value="1" id="tourQuantity" style="width: 45px"> คน</td>
              <td><?php echo $row['description']; ?></td>
              <td align="right"><button class="btn-sm btn-danger">ลบ</button></td>
            </tr>
          <?php } ?>
        <?php } ?>
        
        <!-- แสดงข้อมูลที่สุ่มจากตาราง homestays -->
        <?php if ($act_name === "ที่พัก") { ?>
          <?php 
            while ($row = $result_homestays->fetch_assoc()) { 
              $resultH = $conn->query("SELECT h_detail, h_pictures FROM homestays WHERE homestay_id='{$row['homestay_id']}'");
              $rowH = $resultH->fetch_assoc();
              $imgH = explode(";",$rowH['h_pictures']);
              ?>
            <tr class="item-row" data-id="<?php echo $row['homestay_id']; ?>" data-price="<?php echo $row['h_price']; ?>" data-bookingdate="<?php echo $dd;?>" data-bookinground="<?php echo $booking_round;?>">
              <td><input type="checkbox" id="homestaySelect" name="homestays[<?php echo $index; ?>][selected]" value="1" checked></td>
              <td class="text-success col-3">
              <a href="homestay_detail.php?hid=<?php echo $row['homestay_id']; ?>" target="_blank" style="text-decoration: none"><?php echo $row['h_name']; ?><br><img src="images/homestay/<?php echo $imgH[0];?>" width="100" title="<?php echo $row['h_name']; ?>" alt="<?php echo $row['h_name']; ?>"></a></td>
              <td class="col-1"><?php echo number_format($row['h_price'],0); ?></td>
              <td class="col-2"><input type="number" min="1" value="1" id="homestayQuantity" style="width: 45px"> ห้อง</td>
              <td><?php echo $row['h_detail']; ?></td>
              <td align="right"><button class="btn-sm btn-danger">ลบ</button></td>
            </tr>
          <?php } ?>
        <?php } ?>
        
      </table>
    </div>
  </div>
<?php } ?>  

  </form>
</div>
</div>
<?php } ?>
    
<div class="d-flex h-100 mb-5 justify-content-end">
    <div class="container text-right">
        <div class="row"><h4 class="m-3">ราคารวมทั้งหมด <span id="totalPrice" class="text-primary"></span> บาท</h4></div>
        <div class="row">
            <button class="btn-warning btn-lg m-2" type="button" onclick="window.location.reload();">จัดทริปใหม่อีกครั้ง (Refresh)</button>


<form method="POST" action="booking_script.php">
    <input type="hidden" name="Foods" id="Foods">
    <input type="hidden" name="Tours" id="Tours">
    <input type="hidden" name="bookingdate" id="bookingdate">
    <input type="hidden" name="bookinground" id="bookinground">
    <input type="hidden" name="Homestays" id="Homestays">
    <input type="hidden" name="startDate" value="<?php echo $startDate; ?>">
    <input type="hidden" name="endDate" value="<?php echo $endDate; ?>">
    <input type="hidden" name="totalPrice" id="totalPriceInput">
    
<?php
if(!isset($_SESSION['user_id'])){
?>
<button type="button" class="btn-primary btn-lg m-2" onclick="swal('', 'โปรดล็อคอินเข้าสู่ระบบก่อนยืนยันการจอง', 'warning').then(() => {window.location.href='sign-in.php';});">
ยืนยันการจอง (Confirm)
</button>
<?php } else { ?> 
    <button class="btn-primary btn-lg m-2" type="Submit" id="submitConfirm">ยืนยันการจอง (Confirm)</button>
<?php } ?>  
</form>

        </div>
    </div>
</div>
 
</div> <!-- ปิด <div id="content" style="display: none;"> --> 
<script>
    // เมื่อหน้าเว็บโหลดเสร็จ, ซ่อน "loading" และแสดง "content"
    $(window).on('load', function() {
        $('#loading').fadeOut();  // ซ่อนข้อความ "Loading..."
        $('#content').fadeIn();   // แสดงเนื้อหาหลัก
    });
</script>
    
    
<script>
// ฟังก์ชันอัปเดตราคาเมื่อมีการเปลี่ยนแปลงจำนวนหรือสถานะของ checkbox
function updateTotalPrice() {
  let totalPrice = 0;

  // คำนวณราคาจากมื้ออาหาร
  $('.item-row').each(function() {
    let price = $(this).data('price');  // ดึงราคาจาก data-price
    let quantity = $(this).find('input[type="number"]').val();  // จำนวนที่เลือก
    let isChecked = $(this).find('input[type="checkbox"]').prop('checked');  // ตรวจสอบว่า checkbox ถูกเลือกหรือไม่
    
    if (isChecked) {
      totalPrice += price * quantity;  // คูณราคาและจำนวนถ้า checkbox ถูกเลือก
    }
  });

  // อัปเดตราคารวม
  $('#totalPrice').text(totalPrice.toLocaleString());
}

// เมื่อมีการเปลี่ยนแปลงจำนวน, เลือก/ยกเลิกการเลือก checkbox
$(document).on('change', 'input[type="number"], input[type="checkbox"]', function() {
  updateTotalPrice();
});

// เรียกใช้ครั้งแรกเมื่อโหลดหน้า
updateTotalPrice();

// ฟังก์ชันลบแถวเมื่อคลิกปุ่ม "ลบ"
document.addEventListener('click', function(event) {
    if (event.target.classList.contains('btn-danger')) {
        // ค้นหาแถว (tr) ของปุ่มที่ถูกคลิกและลบออก
        const row = event.target.closest('tr');
        if (row) {
            row.remove();
            updateTotalPrice(); // อัปเดตราคารวมหลังจากลบ
        }
    }
});

document.querySelector('.btn-primary').addEventListener('click', function() {
    let foods = [];
    let tours = [];
    let homestays = [];

    $('.item-row').each(function() {
        let type = $(this).find('input[type="checkbox"]').attr('id');
        let item = {
            id: $(this).data('id'), // ID จากฐานข้อมูล
            name: $(this).find('.col-3').text(),
            price: $(this).data('price'),
            bookingdate: $(this).data('bookingdate'),
            bookinground: $(this).data('bookinground'),
            quantity: $(this).find('input[type="number"]').val()
        };

        if ($(this).find('input[type="checkbox"]').prop('checked')) {
            if (type === 'foodSelect') foods.push(item);
            if (type === 'tourSelect') tours.push(item);
            if (type === 'homestaySelect') homestays.push(item);
        }
    });

// ส่งข้อมูลไปยังฟอร์มเฉพาะรายการที่เลือก
    if (foods.length > 0) {
        document.getElementById('Foods').value = JSON.stringify(foods);
    } else {
        document.getElementById('Foods').value = '';  // ถ้าไม่มีการเลือกอาหารใด ๆ
    }
    
    if (tours.length > 0) {
        document.getElementById('Tours').value = JSON.stringify(tours);
    } else {
        document.getElementById('Tours').value = '';  // ถ้าไม่มีการเลือกทัวร์ใด ๆ
    }
    
    if (homestays.length > 0) {
        document.getElementById('Homestays').value = JSON.stringify(homestays);
    } else {
        document.getElementById('Homestays').value = '';  // ถ้าไม่มีการเลือกที่พักใด ๆ
    }
    
    document.getElementById('totalPriceInput').value = $('#totalPrice').text().replace(/,/g, '');
});

</script>
    <script src="vendor/sweetalert/sweetalert.min.js"></script>
</body>
</html>
