<?php
require_once('connections/mysqli.php');
require_once('./PDF/fpdf.php');
//include('connect.php');
$pdf = new FPDF();
$pdf->AddPage();
// ใช้ฟอนต์ที่คุณดาวน์โหลดมา
$pdf->AddFont('THSarabunNew_b', '', 'THSarabunNew_b.php');
$pdf->SetFont('THSarabunNew_b', '', 24);
$text_tis620 = iconv('UTF-8', 'TIS-620', 'ใบเสร็จรับเงิน');
// $pdf->Cell(20, 10, $text_tis620, 0);
// $pdf->Cell(59,10,'',0,1);
$pdf->Cell(71,10,'',0,0);
$pdf->Cell(59,5,$text_tis620,0,0);
$pdf->Cell(59,10,'',0,1);

$pdf->SetFont('THSarabunNew_b', '', 24);
$text_tis621 = iconv('UTF-8', 'TIS-620', 'รายละเอียดลูกค้า');
$pdf->Cell(71,5,'',0,0);
$pdf->Cell(59,5,'',0,0);
$pdf->Cell(59,5,$text_tis621,0,1);


$id = $_GET['id']; // หรือวิธีรับค่า ID จากข้อมูลอื่น ๆ ที่เหมาะสม
$query = "SELECT * FROM `deposit` WHERE `id` = $id"; // ใช้ตัวแปร $id ในคำสั่ง SQL query
$result = mysqli_query($Connection, $query);
$pdf->SetFont('THSarabunNew_b', '', 15);
while ($row = mysqli_fetch_assoc($result)) {




$pdf->SetFont('THSarabunNew_b', '', 18);
$x = 10;
$y = 10;
$width = 50; // ความกว้างของรูปภาพ
$height = 0; // ถ้าเป็น 0 รูปภาพจะถูกยืดเต็มความกว้าง

// แสดงรูปภาพใน PDF
$pdf->Image('images/logo2.png', $x, $y, $width, $height);
$text_tis622 = iconv('UTF-8', 'TIS-620', 'ร้าน SLEEPY-PET ( บริการรับฝากดูแลหมาแมว )');
$text_tis623 = iconv('UTF-8', 'TIS-620', 'ชื่อ :');
$text_tis624 = iconv('UTF-8', 'TIS-620', '');
$pdf->Cell(130,20,$text_tis622,0,0);
$pdf->Cell(25,15,$text_tis623,0,0); 
$pdf->Cell(20,15,$row['user_name'],0,0);
$pdf->Cell(34,15,'',0,1);

$pdf->SetFont('THSarabunNew_b', '', 18);
$text_tis625 = iconv('UTF-8', 'TIS-620', 'ร้าน SLEEPY-PET');
$text_tis626 = iconv('UTF-8', 'TIS-620', 'ที่อยู่ร้าน : ถ.โชติวิทยะกุล 5 อ.หาดใหญ่ จ.สงขลา');
$text_tis627 = iconv('UTF-8', 'TIS-620', 'เบอร์ติดต่อ:');
$pdf->Cell(130,5,$text_tis626 ,0,0);
$pdf->Cell(25,5,$text_tis627,0,0);
$pdf->Cell(34,5,$row['user_phone'],0,1);


$pdf->SetFont('THSarabunNew_b', '', 18);
$text_tis628 = iconv('UTF-8', 'TIS-620', '');
$text_tis629 = iconv('UTF-8', 'TIS-620', 'เบอร์ติดต่อ: 093-425-6521');
$text_tis630 = iconv('UTF-8', 'TIS-620', 'วันออกบิล :');
$pdf->Cell(130,15,$text_tis629,0,0);
$pdf->Cell(25,15,$text_tis630,0,0);
$pdf->Cell(34,15,$row['start'],0,1);

$pdf->SetFont('THSarabunNew_b', '', 18);
$text_tis628 = iconv('UTF-8', 'TIS-620', '');
$text_tis629 = iconv('UTF-8', 'TIS-620', '');
$text_tis630 = iconv('UTF-8', 'TIS-620', 'EMAIL:');
$pdf->Cell(130,10,$text_tis629,0,0);
$pdf->Cell(25,10,$text_tis630,0,0);
$pdf->Cell(34,10,$row['user_email'],0,1);

}


$pdf->SetFont('THSarabunNew_b', '', 24);
$text_tis631 = iconv('UTF-8', 'TIS-620', '');
$text_tis632 = iconv('UTF-8', 'TIS-620', '');
$text_tis633 = iconv('UTF-8', 'TIS-620', 'วันที่รับฝาก');
$text_tis634 = iconv('UTF-8', 'TIS-620', 'วันที่รับกลับ');
$pdf->Cell(130,10,'Bill to',0,0);
$pdf->Cell(59,10,'',0,0);

$pdf->SetFont('THSarabunNew_b', '', 24);
$text_tis631 = iconv('UTF-8', 'TIS-620', '');
$pdf->Cell(189,10,'',0,1);

$pdf->Cell(50,10,'',0,1);
$pdf->SetFont('THSarabunNew_b', '', 15);
//LINE//
$text_tis721 = iconv('UTF-8', 'TIS-620', 'ลำดับ');
$text_tis722 = iconv('UTF-8', 'TIS-620', 'รายละเอียด');
$text_tis723 = iconv('UTF-8', 'TIS-620', 'ประเภทสัตว์');
$text_tis724 = iconv('UTF-8', 'TIS-620', 'จำนวน');
$text_tis725 = iconv('UTF-8', 'TIS-620', 'ราคา');
$text_tis726 = iconv('UTF-8', 'TIS-620', 'ราคารวม');

$pdf->Cell(10, 6, $text_tis721, 1, 0, 'C');
$pdf->Cell(40, 6, $text_tis722, 1, 0, 'C');
$pdf->Cell(40, 6, $text_tis723, 1, 0, 'C'); // Added a cell for "ประเภท"
$pdf->Cell(23, 6, $text_tis724, 1, 0, 'C');
$pdf->Cell(30, 6, $text_tis725, 1, 0, 'C');
$pdf->Cell(45, 6, $text_tis726, 1, 1, 'C');

$id = $_GET['id'];
$query = "SELECT * FROM `deposit` WHERE `id` = $id";
$result = mysqli_query($Connection, $query);
$pdf->SetFont('THSarabunNew_b', '', 15);
while ($row = mysqli_fetch_assoc($result)) {
    $pdf->Cell(10, 10, $row['id'], 1, 0);
    $pdf->Cell(40, 10, iconv('UTF-8', 'TIS-620', $row['service']), 1, 0);
    $pdf->Cell(40, 10, iconv('UTF-8', 'TIS-620', $row['animal']), 1, 0); // Display "ประเภท" in the same row
    $pdf->Cell(23, 10, $row['quantity'], 1, 0, 'R');
    $pdf->Cell(30, 10, $row['price'], 1, 0, 'R');
    $pdf->Cell(45, 10, $row['price'], 1, 1, 'R');



$text_tis799 = iconv('UTF-8', 'TIS-620', 'ราคาทั้งหมด');
$pdf->Cell(118,6,'',0,0,);
$pdf->Cell(25,6,$text_tis799,0,0,);
$pdf->Cell(45,6,$row['price'],1,1,'R');
}
$pdf->Cell(100, 10, '', 0, 1); // สร้างบรรทัดว่าง

$pdf->Cell(100); // เลื่อนตำแหน่งไปทางขวา
$text_signature = iconv('UTF-8', 'TIS-620', 'ลายเซ็นผู้รับเงิน: ________________________________');
$pdf->Cell(0, 10, $text_signature, 0, 1, 'R'); // ใช้ 'R' ใน Cell() เพื่อจัดตำแหน่งข้อความลายเซ็นทางขวา
$text_signature = iconv('UTF-8', 'TIS-620', ' (                                                   )');
$pdf->Cell(0, 10, $text_signature, 0, 1, 'R'); // ใช้ 'R' ใน Cell() เพื่อจัดตำแหน่งข้อความลายเซ็นทางขวา



$pdf->Output();