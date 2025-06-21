<?php
require 'PHPMailer/PHPMailer.php';
require 'PHPMailer/SMTP.php';
require 'PHPMailer/Exception.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

$mail = new PHPMailer(true);

try {
    // ตั้งค่า SMTP
    $mail->isSMTP();
    $mail->Host       = 'mail.localbuengkan.com'; // เปลี่ยนตามผู้ให้บริการ
    $mail->SMTPAuth   = true;
    $mail->Username   = 'info@localbuengkan.com'; // อีเมลของคุณ
    $mail->Password   = 'ai9B#7wtk';    // รหัสผ่านอีเมล
    $mail->SMTPSecure = 'ssl';                    // หรือ 'tls' หากใช้ port 587
    $mail->Port       = 465;                      // หรือ 587 ถ้าใช้ TLS

    // ผู้ส่งและผู้รับ
    $mail->setFrom('info@localbuengkan.com', 'ระบบแจ้งเตือน Buengkan');
    $mail->addAddress('nkcombat@gmail.com', 'ผู้รับ'); // อีเมลผู้รับ

    // เนื้อหา
    $mail->isHTML(true);
    $mail->Subject = 'แจ้งเตือนการสั่งซื้อ';
    $mail->Body    = '<h3>มีออเดอร์ใหม่เข้ามา</h3><p>ตรวจสอบได้ในระบบ</p>';

    $mail->send();
    echo 'ส่งอีเมลสำเร็จแล้ว';
} catch (Exception $e) {
    echo "ไม่สามารถส่งอีเมลได้: {$mail->ErrorInfo}";
}
?>
