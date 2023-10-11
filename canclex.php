<?php
// รับค่า id ที่ต้องการยกเลิกจาก URL
if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // เชื่อมต่อฐานข้อมูล
    require_once('connections/mysqli.php');

    // สร้างคำสั่ง SQL สำหรับอัปเดตรายการ
    $sql = "UPDATE deposit SET status = '2' WHERE id = $id";

    // ทำการอัปเดตรายการ
    if (mysqli_query($Connection, $sql)) {
        // อัปเดตสำเร็จ
        echo "รายการถูกยกเลิกเรียบร้อยแล้ว";
    } else {
        // เกิดข้อผิดพลาดในการอัปเดต
        echo "เกิดข้อผิดพลาดในการยกเลิกรายการ: " . mysqli_error($Connection);
    }

    // ปิดการเชื่อมต่อกับฐานข้อมูล
    mysqli_close($Connection);
} else {
    // ถ้าไม่มี ID ที่ระบุใน URL
    echo "ไม่มีรหัสรายการที่ต้องการยกเลิก";
}
    header("location:status.php");
?>
