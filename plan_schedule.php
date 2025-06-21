<?php
//include_once("checklogin.php");   // ต้องปิดไว้ เพราะแอดมินจะเข้าดูจากหลังบ้านไม่ได้
include_once("connectdb.php");

if (!isset($_GET['bid'])) {
 exit;   
}
    
    $booking_id = $_GET['bid'];
        
    $sql = "SELECT * FROM bookings AS b LEFT JOIN users AS u ON b.user_id=u.user_id WHERE b.id = ? AND b.booking_type='plan' ";
    $stmt = $conn->prepare($sql); // เตรียม Statement
    $stmt->bind_param("i", $booking_id); 
    $stmt->execute(); 
    $result = $stmt->get_result(); 
    $rowCount = $result->num_rows; 
    $row = $result->fetch_assoc();
    
    // หาจำนวนวัน
    $days = (new DateTime($row['start_date']))->diff(new DateTime($row['end_date']))->days+1;

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Local Buengkan - Plan Schedule</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/png" href="images/icons/favicon.png"/>
    <link rel="stylesheet" type="text/css" href="css/main.css">
    <link rel="stylesheet" type="text/css" href="fonts/font-awesome-4.7.0/css/font-awesome.min.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Prompt&family=Kanit&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <style>
        body {
            font-family: "Prompt", serif;
            font-size: 14px;
        }
        @media print {
            #btnPrint1, #btnPrint2, #btnPrint3, #btnPrint4 {
                display: none;
            }
        }
    </style>
</head>
<body>
    
<div id="loading" class="mt-5 img-fluid" align="center">
    <img src="images/loading2.gif" alt="Loading...">
</div>

<div id="content" style="display: none;">
    <div class="container mt-5">
        <div class="row">
            <div class="col-8">
        <h4>โปรแกรมทริปท่องเที่ยว จำนวน <?php echo $days;?> วัน ของ <span class="text-success"><?php echo $row['fullname']?></span></h4>
            </div>
            <div class="col-4 d-flex justify-content-end">
    <button id="btnPrint1" class="btn-primary btn-sm" type="button" onclick="window.print();">
                <i class="fa fa-print"></i> พิมพ์หน้านี้ (Print)</button>
    <button id="btnPrint2" class="btn-danger btn-sm ml-1" type="button" onclick="window.close();">
                <i class="fa fa-times"></i> ปิด (Close)</button>
            </div>
        </div>
    </div>
<?php
// สร้าง DateTime จากวันที่เริ่มต้นและวันที่สิ้นสุด
$start = new DateTime($row['start_date']);
$end = new DateTime($row['end_date']);
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

    // ค้นหาข้อมูลจากฐานข้อมูลสำหรับแต่ละกิจกรรม
    $result_foods = $conn->query("SELECT * FROM booking_details WHERE type='food' AND booking_round='{$booking_round}' AND booking_date = '{$dd}' AND booking_id='{$_GET['bid']}'");
    $result_tours = $conn->query("SELECT * FROM booking_details WHERE type='tour' AND booking_round='{$booking_round}' AND booking_date = '{$dd}' AND booking_id='{$_GET['bid']}'");
    $result_homestays = $conn->query("SELECT * FROM booking_details WHERE type='homestay' AND booking_round='{$booking_round}' AND booking_date = '{$dd}' AND booking_id='{$_GET['bid']}'");
    
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
            $resultF = $conn->query("SELECT f_detail, f_pictures FROM foods WHERE f_id='{$row['item_id']}'");
            $rowF = $resultF->fetch_assoc();
            $imgF = explode(";",$rowF['f_pictures']);
          ?>
            <tr class="item-row" data-id="<?php echo $row['item_id']; ?>">
              <td class="text-primary"><a href="food_detail.php?fid=<?php echo $row['item_id']; ?>" target="_blank" style="text-decoration: none"><?php echo $row['item_name']; ?></a> <span class="text-secondary">(<?php echo $row['quantity']; ?> ที่)</span></td>
              <td class="col-2">
                  <img src="images/foods/<?php echo $imgF[0];?>" width="100" title="<?php echo $row['item_name']; ?>" alt="<?php echo $row['item_name']; ?>" class="rounded">  
              </td>
              <td class="col-7"><?php echo $rowF['f_detail']; ?></td>
            </tr>
          <?php } ?>
        <?php } ?>
        
        <!-- แสดงข้อมูลที่สุ่มจากตาราง tours -->
        <?php if ($act_name === "ทริปรอบเช้า" || $act_name === "ทริปรอบบ่าย") { ?>
          <?php 
            while ($row = $result_tours->fetch_assoc()) { 
            $resultT = $conn->query("SELECT description, t_pictures FROM tours WHERE tour_id='{$row['item_id']}'");
            $rowT = $resultT->fetch_assoc();
            $imgT = explode(";",$rowT['t_pictures']);
          ?>
            <tr class="item-row" data-id="<?php echo $row['item_id']; ?>">
              <td class="text-primary"><a href="tour_detail.php?tid=<?php echo $row['item_id']; ?>" target="_blank" style="text-decoration: none"><?php echo $row['item_name']; ?></a> <span class="text-secondary">(<?php echo $row['quantity']; ?> คน)</span><br>
                  
<?php
$sqlTrip = "SELECT * FROM users WHERE user_id='{$row['owner']}' "; 
$rsTrip = $conn->query($sqlTrip);    
$rowTrip = $rsTrip->fetch_assoc();
echo "<a href='images/users/{$rowTrip['picture']}' target='_blank'><img src='images/users/{$rowTrip['picture']}' class='rounded-circle mt-2' width='60' title='ไกด์: {$rowTrip['fullname']}' alt='{$rowTrip['fullname']}'></a>";
?>
                </td>
              <td class="col-2">
                  <img src="images/tours/<?php echo $imgT[0];?>" width="100" title="<?php echo $row['item_name']; ?>" alt="<?php echo $row['item_name']; ?>" class="rounded">  
              </td>
              <td class="col-7"><?php echo $rowT['description']; ?></td>
            </tr>
          <?php } ?>
        <?php } ?>
        
        <!-- แสดงข้อมูลที่สุ่มจากตาราง homestays -->
        <?php if ($act_name === "ที่พัก") { ?>
          <?php 
            while ($row = $result_homestays->fetch_assoc()) { 
            $resultH = $conn->query("SELECT h_detail, h_pictures FROM homestays WHERE homestay_id='{$row['item_id']}'");
            $rowH = $resultH->fetch_assoc();
            $imgH = explode(";",$rowH['h_pictures']);
          ?>
            <tr class="item-row" data-id="<?php echo $row['item_id']; ?>">
              <td class="text-primary"><a href="homestay_detail.php?hid=<?php echo $row['item_id']; ?>" target="_blank" style="text-decoration: none"><?php echo $row['item_name']; ?></a> <span class="text-secondary">(<?php echo $row['quantity']; ?> ห้อง)</span></td>
              <td class="col-2">
                  <img src="images/homestay/<?php echo $imgH[0];?>" width="100" title="<?php echo $row['item_name']; ?>" alt="<?php echo $row['item_name']; ?>" class="rounded">  
              </td>
              <td class="col-7"><?php echo $rowH['h_detail']; ?></td>
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
        <div class="row">
            <button id="btnPrint3" class="btn btn-primary ml-1" type="button" onclick="window.print();">
                <i class="fa fa-print"></i> พิมพ์หน้านี้ (Print)</button>
            <button id="btnPrint4" class="btn btn-danger ml-1" type="button" onclick="window.close();">
                <i class="fa fa-times"></i> ปิด (Close)</button>
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
    
    
</body>
</html>
