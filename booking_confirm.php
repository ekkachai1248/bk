<?php
include_once("checklogin.php");
include_once("connectdb.php");

$stmtC = $conn->prepare("SELECT * FROM `commission_settings` LIMIT 1");
$stmtC->execute();
$resultC = $stmtC->get_result();
$rowC = $resultC->fetch_assoc();
//$stmtC->close();
//echo $rowC['product_commission'];
//echo $rowC['product_delivery'];
//echo $rowC['guide_commission'];
//echo $rowC['chef_commission'];
//echo $rowC['homestay_commission'];

// รับข้อมูลจากฟอร์ม
$f_id = !empty($_POST['f_id']) ? $_POST['f_id'] : "";
$f_name = !empty($_POST['f_name']) ? $_POST['f_name'] : "";
$f_date = !empty($_POST['f_date']) ? $_POST['f_date'] : "";
$f_round = !empty($_POST['f_round']) ? $_POST['f_round'] : "";
$f_price = !empty($_POST['f_price']) ? $_POST['f_price'] : "";
$f_item = !empty($_POST['f_item']) ? $_POST['f_item'] : "";

$h_id = !empty($_POST['h_id']) ? $_POST['h_id'] : "";
$h_name = !empty($_POST['h_name']) ? $_POST['h_name'] : "";
$h_datecheckin = !empty($_POST['h_datecheckin']) ? $_POST['h_datecheckin'] : "";
$h_datecheckout = !empty($_POST['h_datecheckout']) ? $_POST['h_datecheckout'] : "";
$h_night = !empty($_POST['h_night']) ? $_POST['h_night'] : "";
$h_price = !empty($_POST['h_price']) ? $_POST['h_price'] : "";
$h_room = !empty($_POST['h_room']) ? $_POST['h_room'] : "";

$p_id = !empty($_POST['p_id']) ? $_POST['p_id'] : "";
$p_name = !empty($_POST['p_name']) ? $_POST['p_name'] : "";
$p_price = !empty($_POST['p_price']) ? $_POST['p_price'] : "";
$p_item = !empty($_POST['p_item']) ? $_POST['p_item'] : "";

$t_id = !empty($_POST['t_id']) ? $_POST['t_id'] : "";
$t_name = !empty($_POST['t_name']) ? $_POST['t_name'] : "";
$t_date = !empty($_POST['t_date']) ? $_POST['t_date'] : "";
$t_round = !empty($_POST['t_round']) ? $_POST['t_round'] : "";
$t_price = !empty($_POST['t_price']) ? $_POST['t_price'] : "";
$t_item = !empty($_POST['t_item']) ? $_POST['t_item'] : "";

$fullname = $_POST['fullname'];
$phone = $_POST['phone'];
$address = $_POST['address'];
$total_all = $_POST['total_all'];
$booking_type = $_POST['booking_type'];
$user_id = $_SESSION['user_id'];

//var_dump($f_id, $h_id, $p_id, $t_id);
//exit();

// บันทึกข้อมูลลงในตาราง bookings
$sql_booking = "INSERT INTO bookings (booking_date, total_price, fullname, phone, address, booking_type, user_id) 
                VALUES (CURRENT_TIMESTAMP, ?, ?, ?, ?, ?, ?)";
$stmt = $conn->prepare($sql_booking);
$stmt->bind_param("sssssi", $total_all, $fullname, $phone, $address, $booking_type, $user_id);
$stmt->execute();
$booking_id = $stmt->insert_id;

// บันทึกข้อมูลลงในตาราง booking_details สำหรับอาหาร
if (!empty($f_id)) {
    foreach ($f_id as $index => $food_id) {
        $food_name = $f_name[$index] ?? "";
        $food_price = $f_price[$index] ?? 0;
        $food_quantity = $f_item[$index] ?? 0;
        $food_round = $f_round[$index] ?? "";
        $food_date = $f_date[$index] ?? NULL;

        $sql_booking_detail = "INSERT INTO booking_details (booking_id, booking_date, booking_round, type, item_id, item_name, quantity, price_per_unit, total_price, datecheckin, commission_percent, commission_baht)
                               VALUES (?, CURRENT_TIMESTAMP, ?, 'food', ?, ?, ?, ?, ?, ?, ?, ?)";
        $stmt_detail = $conn->prepare($sql_booking_detail);
        $total_food_price = $food_price * $food_quantity;
        $food_commission_baht = $total_food_price * $rowC['chef_commission'] / 100;
        $stmt_detail->bind_param("isssiiisid", $booking_id, $food_round, $food_id, $food_name, $food_quantity, $food_price, $total_food_price, $food_date, $rowC['chef_commission'], $food_commission_baht);
        $stmt_detail->execute();
    }
}

// บันทึกข้อมูลลงในตาราง booking_details สำหรับที่พัก
if (!empty($h_id)) {
    foreach ($h_id as $index => $homestay_id) {
        $homestay_name = $h_name[$index] ?? "";
        $homestay_checkin = $h_datecheckin[$index] ?? NULL;
        $homestay_checkout = $h_datecheckout[$index] ?? NULL;
        $homestay_night = $h_night[$index] ?? 0;
        $homestay_price = $h_price[$index] ?? 0;
        $homestay_room = $h_room[$index] ?? 0;

        $sql_booking_detail = "INSERT INTO booking_details (booking_id, booking_date, type, item_id, item_name, quantity, price_per_unit, total_price, datecheckin, datecheckout, night, commission_percent, commission_baht)
                               VALUES (?, CURRENT_TIMESTAMP, 'homestay', ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
        $stmt_detail = $conn->prepare($sql_booking_detail);
        $total_homestay_price = $homestay_price * $homestay_room * $homestay_night;
        $homestay_commission_baht = $total_homestay_price * $rowC['homestay_commission'] / 100;
        $stmt_detail->bind_param("isssiisssid", $booking_id, $homestay_id, $homestay_name, $homestay_room, $homestay_price, $total_homestay_price, $homestay_checkin, $homestay_checkout, $homestay_night, $rowC['homestay_commission'], $homestay_commission_baht);
        $stmt_detail->execute();
    }
}

// บันทึกข้อมูลลงในตาราง booking_details สำหรับสินค้า
if (!empty($p_id)) {
    foreach ($p_id as $index => $product_id) {
        $product_name = $p_name[$index] ?? "";
        $product_price = $p_price[$index] ?? 0;
        $product_quantity = $p_item[$index] ?? 0;

        $sql_booking_detail = "INSERT INTO booking_details (booking_id, booking_date, type, item_id, item_name, quantity, price_per_unit, total_price, commission_percent, commission_baht)
                               VALUES (?, CURRENT_TIMESTAMP, 'product', ?, ?, ?, ?, ?, ?, ?)";
        $stmt_detail = $conn->prepare($sql_booking_detail);
        $total_product_price = $product_price * $product_quantity;
        $product_commission_baht = $total_product_price * $rowC['product_commission'] / 100;
        $stmt_detail->bind_param("isssiiid", $booking_id, $product_id, $product_name, $product_quantity, $product_price, $total_product_price, $rowC['product_commission'], $product_commission_baht);
        $stmt_detail->execute();
                // ตรวจสอบว่าคำสั่ง SQL ทำงานสำเร็จหรือไม่
                //if ($stmt_detail->execute()) {
                //    echo "บันทึกสำเร็จ: $product_name<br>";
                //} else {
                //    echo "Error: " . $stmt_detail->error . "<br>";
                //}
    }
}

// บันทึกข้อมูลลงในตาราง booking_details สำหรับทัวร์
if (!empty($t_id)) {
    foreach ($t_id as $index => $tour_id) {
        $tour_name = $t_name[$index] ?? "";
        $tour_date = $t_date[$index] ?? NULL;
        $tour_round = $t_round[$index] ?? "";
        $tour_price = $t_price[$index] ?? 0;
        $tour_item = $t_item[$index] ?? 0;

        $sql_booking_detail = "INSERT INTO booking_details (booking_id, booking_date, booking_round, type, item_id, item_name, quantity, price_per_unit, total_price, datecheckin, commission_percent, commission_baht)
                               VALUES (?, CURRENT_TIMESTAMP, ?, 'tour', ?, ?, ?, ?, ?, ?, ?, ?)";
        $stmt_detail = $conn->prepare($sql_booking_detail);
        $total_tour_price = $tour_price * $tour_item;
        $tour_commission_baht = $total_tour_price * $rowC['guide_commission'] / 100;
        $stmt_detail->bind_param("isssiiisid", $booking_id, $tour_round, $tour_id, $tour_name, $tour_item, $tour_price, $total_tour_price, $tour_date, $rowC['guide_commission'], $tour_commission_baht);
        $stmt_detail->execute();
    }
}

// ปิดการเชื่อมต่อฐานข้อมูล
$stmt->close();
$conn->close();

	unset($_SESSION['pid']) ;
	unset($_SESSION['pname']) ;
	unset($_SESSION['pprice']) ;
	unset($_SESSION['ppicture']) ;
	unset($_SESSION['pitem']) ;

	unset($_SESSION['fid']) ;
	unset($_SESSION['fname']) ;
	unset($_SESSION['fprice']) ;
	unset($_SESSION['fpicture']) ;
	unset($_SESSION['fitem']) ;
	unset($_SESSION['fdate']) ;
	unset($_SESSION['fround']) ;

	unset($_SESSION['tid']) ;
	unset($_SESSION['tname']) ;
	unset($_SESSION['tprice']) ;
	unset($_SESSION['tpicture']) ;
	unset($_SESSION['titem']) ;
	unset($_SESSION['tdate']) ;
	unset($_SESSION['tround']) ;

	unset($_SESSION['hid']) ;
	unset($_SESSION['hname']) ;
	unset($_SESSION['hprice']) ;
	unset($_SESSION['hpicture']) ;
	unset($_SESSION['qroom']) ;
	unset($_SESSION['datecheckin']) ;
	unset($_SESSION['datecheckout']) ;
	unset($_SESSION['qperson']) ;
	unset($_SESSION['qnight']) ;

?>

<script src="vendor/jquery/jquery-3.2.1.min.js"></script>
<script src="vendor/sweetalert/sweetalert.min.js"></script>
<script>
    $(document).ready(function() {
        swal('', 'บันทึกการสั่งซื้อเสร็จสมบูรณ์', 'success').then(() => {
            //window.location.href = 'redirect_page.php';
            window.close();
        });
    });
</script>

<?php
exit();
?>
