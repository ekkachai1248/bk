<?php
include_once("checklogin.php");

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    include_once("connectdb.php");

    $foods = json_decode($_POST['Foods'], true);
    $tours = json_decode($_POST['Tours'], true);
    $homestays = json_decode($_POST['Homestays'], true);
    $startDate = $_POST['startDate'];
    $endDate = $_POST['endDate'];
    $totalPrice = $_POST['totalPrice'];
    $plan = "plan";
    $user_id = $_SESSION['user_id'];
    $fullname = $_SESSION['fullname'];
    $phone = $_SESSION['phone'];
    $address = $_SESSION['address'];

    $conn->begin_transaction();

    //var_dump($foods, $homestays);exit;
    
    //try {
        $stmt = $conn->prepare("INSERT INTO bookings (start_date, end_date, total_price, booking_type, user_id, fullname, phone, address) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("ssdsisss", $startDate, $endDate, $totalPrice, $plan, $user_id, $fullname, $phone, $address);
        $stmt->execute();
        $bookingId = $stmt->insert_id;

        function save_booking_details($conn, $bookingId, $items, $type) {
            if (empty($items)) {
                //echo "ไม่มีข้อมูลสำหรับ $type<br>";
                return;
            }

            $stmt = $conn->prepare("
                INSERT INTO booking_details (booking_id, booking_date, booking_round, type, item_id, item_name, quantity, price_per_unit, total_price, datecheckin, datecheckout, night)
                VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)
            ");
            foreach ($items as $item) {

                if (!isset($item['id'], $item['name'], $item['quantity'], $item['price'], $item['bookingdate'], $item['bookinground'])) {
                    echo "ข้อมูลไม่ครบ: " . json_encode($item) . "<br>";
                    continue;
                }

                //if (isset($item['selected']) && $item['selected'] == '1') {
                    
                    $totalPrice = $item['quantity'] * $item['price'];
                    $night = ($type == "homestay") ? "1" : NULL; 
                    // ตรวจสอบค่าของ night ก่อน bind
                    if (is_null($night)) {
                        $night = '0';  // หรือค่าอื่นที่ต้องการ เช่น 'N/A'
                    }
                    $datecheckout = isset($item['datecheckout']) ? $item['datecheckout'] : NULL;  // กำหนดค่าให้กับ datecheckout

                    $stmt->bind_param(
                        "issssssddsss",
                        $bookingId,
                        $item['bookingdate'],
                        $item['bookinground'],
                        $type,
                        $item['id'],
                        $item['name'],
                        $item['quantity'],
                        $item['price'],
                        $totalPrice,
                        $item['bookingdate'],
                        $datecheckout,
                        $night
                    );
                    if (!$stmt->execute()) {
                        echo "Error: " . $stmt->error . "<br>";
                    }
                //}
            }
        }

        save_booking_details($conn, $bookingId, $foods, 'food');
        save_booking_details($conn, $bookingId, $tours, 'tour');
        save_booking_details($conn, $bookingId, $homestays, 'homestay');

        $conn->commit();
        //echo "success";
        
        //echo "<script>";
        //echo "alert('บันทึกข้อมูลการจองสำเร็จ');";
        //echo "window.close();";
        //echo "window.location='index.php';";
        //echo "</script>";
    //} catch (Exception $e) {
        //$conn->rollback();
        //echo 'Error: ' . $e->getMessage();
    //}
?>
<script src="vendor/jquery/jquery-3.2.1.min.js"></script>
<script src="vendor/sweetalert/sweetalert.min.js"></script>
<script>
    $(document).ready(function() {
        swal('', 'บันทึกข้อมูลการจองสำเร็จ', 'success').then(() => {
            window.close();
        });
    });
</script>
<?php
}
exit();
?>



