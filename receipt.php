<?php
//include_once("checklogin.php");
include_once("connectdb.php");

$sql = "SELECT * FROM bookings AS b
LEFT JOIN users AS u ON b.user_id = u.user_id 
WHERE b.order_status = 'ชำระเงินแล้ว' 
AND b.id = '{$_GET['id']}'";

$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();

    $vat = $row['total_price'] * (7/107);
    $total = $row['total_price'] - $vat;
    
} else {
    echo "<p style='color: red;'>รายการนี้ยังไม่ได้ชำระเงิน</p>";
    exit;
}
?>



<!DOCTYPE html>
<html lang="th">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/png" href="images/icons/favicon.png"/>
    <title>ใบเสร็จรับเงิน - Local Buengkan Co.,Ltd.</title>
    <link rel="stylesheet" type="text/css" href="vendor/bootstrap/css/bootstrap.min.css">
    <!--<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">-->
    <style>
        .receipt-container {
            max-width: 800px;
            margin: auto;
            padding: 20px;
            border: 1px solid #ddd;
            background: #fff;
        }
        .receipt-header {
            text-align: center;
        }
        .receipt-title {
            font-size: 24px;
            font-weight: bold;
            margin-bottom: 10px;
        }
        .company-logo {
            max-width: 100px;
        }
        .receipt-table th, .receipt-table td {
            text-align: center;
            vertical-align: middle;
        }
        .total-section {
            font-size: 18px;
            font-weight: bold;
        }
        .signature {
            margin-top: 40px;
            text-align: center;
        }
        .signature-line {
            border-top: 1px solid #000;
            width: 200px;
            margin: auto;
        }
    </style>
    
<link href="https://fonts.googleapis.com/css?family=Prompt&family=Karla:400,700|Roboto" rel="stylesheet">
<style>
    body{
        font-family: "Prompt", serif;
    }      
</style></head>
<body>

<div class="container mt-3 mb-3">
    <div class="receipt-container">
        <!-- ส่วนหัวใบเสร็จ -->
        <div class="receipt-header">
            <img src="images/icons/favicon.png" class="company-logo" alt="Local Buengkan Co.,Ltd." title="Local Buengkan Co.,Ltd.">
            <div class="receipt-title">ใบเสร็จรับเงิน</div>
            <div>Local Buengkan Co.,Ltd.</div>
            <div>123 หมู่ 4 ตำบลเมือง อำเภอโซ่พิสัย จังหวัดบึงกาฬ 38000</div>
            <div>โทร: 089-999-9999 | อีเมล: info@localbuengkan.com</div>
        </div>

        <hr>

        <!-- ข้อมูลใบเสร็จ -->
      <div class="row">
        <div class="col-md-6">
            <?php
$inv = date("Ymd", strtotime($row['booking_date'])); // ดึงแค่ YYYYMMDD
$receipt_id = "#INV".$inv . str_pad($row['id'], 4, '0', STR_PAD_LEFT); // เติม 0 ข้างหน้าจนเป็น 4 หลัก
            ?>
                <p><strong>เลขที่ใบเสร็จ:</strong> <?php echo $receipt_id;?></p>
                <p><strong>วันที่:</strong> <?php echo $row['booking_date'];?></p>
            </div>
        <div class="col-md-6 text-right">
                <p><strong>ลูกค้า:</strong> <?php echo $row['fullname'];?></p>
                <p><strong>ที่อยู่:</strong> <?php echo $row['address'];?></p>
                <p><strong>โทร:</strong> <?php echo $row['phone'];?></p>
            </div>
        </div>

        <!-- ตารางรายการ -->
        <table class="table table-bordered receipt-table">
            <thead class="thead-dark">
                <tr>
                    <th>#</th>
                    <th>รายการ</th>
                    <th>จำนวน</th>
                    <th>ราคาต่อหน่วย (บาท)</th>
                    <th>รวม (บาท)</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>1</td>
                    <td>สินค้าและบริการ</td>
                    <td>1</td>
                    <td><?php echo number_format($row['total_price'],2);?></td>
                    <td><?php echo number_format($row['total_price'],2);?></td>
                </tr>
            </tbody>
        </table>

        <!-- สรุปยอด -->
        <div class="row">
          <div class="col-md-6"></div>
          <div class="col-md-6">
                <table class="table">
                    <tr>
                        <td class="text-right"><strong>รวม:</strong></td>
                        <td class="text-right"><?php echo number_format($total,2);?> บาท</td>
                    </tr>
                    <tr>
                        <td class="text-right"><strong>VAT 7%:</strong></td>
                        <td class="text-right"><?php echo number_format($vat,2);?> บาท</td>
                    </tr>
                    <tr>
                        <td class="text-right total-section"><strong>รวมสุทธิ:</strong></td>
                        <td class="text-right total-section"><?php echo number_format($row['total_price'],2);?> บาท</td>
                    </tr>
                </table>
            </div>
      </div>

        <!-- ลายเซ็น -->
        <div class="signature">
            <p>ลงชื่อ: </p>
            <div class="signature-line"></div>
            <p>ผู้รับเงิน</p>
        </div>

        <hr>
        <p class="text-center"><strong>ขอบคุณที่ใช้บริการ</strong></p>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

</body>
</html>
