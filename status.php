<?php
require_once('connections/mysqli.php');
if (!$_SESSION) {
    header("location:login.php");
    exit();
}

if (isset($_POST['submit'])) {
    // Upload the file
    $target_dir = "";
    $target_file = $target_dir . basename($_FILES["image"]["name"]);
    move_uploaded_file($_FILES["image"]["tmp_name"], $target_file);
}
?>

<!DOCTYPE html>
<html lang="en " >
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title><?php echo $title; ?></title>
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/icons/bootstrap-icons.css">
    <link rel="stylesheet" href="style.css">

    <style>
        @import url(http://fonts.googleapis.com/css?family=Kanit);

        body {
            font-family: 'Kanit', sans-serif;
        }
        .center-content {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 50vh; /* ปรับตามความต้องการ */
        }
        .table-responsive {
            margin-bottom: 50px; /* ปรับตามความต้องการ */
        }
        table {
        border-collapse: collapse;
        width: 100%;
        }

        th, td {
            border: 1px solid black; /* You can adjust the border style here */
            padding: 8px;
            text-align: center;
        }

        th {
            background-color: #f2f2f2; /* Header background color */
        }

        tr:nth-child(even) {
            background-color: #f2f2f2; /* Even row background color */
        }
        h1{

        }
    </style>
</head>
<?php include 'includes/navbar.php';?> <br>
<body class="sb-nav-fixed">
<div id="layoutSidenav_content">
    <main>
        <div class="container-fluid px-4 mt-4 center-content">

            <div class="card mb-4 text-dark">
                <div class="card-header">
                    <i class="fas fa-table me-5 text-dark"></i>
                    แสดงข้อมูลบริการทั่วไป
                </div>
                <div class="card-body line-2">
                    <div class="table-responsive">
                        <table id="datatablesSimple">
                            <thead>
                        <tr>
                            <th>ลำดับ</th>
                            <th>ชื่อผู้ใช้</th>
                            <th>บริการ</th>
                            <th>ประเภทสัตว์</th>
                            <th>จำนวนสัตว์</th>
                            <th>ราคา</th>
                            <th>วันที่ฝาก</th>
                            <th>สถานะ</th>
                            <th>ยกเลิกบริการ</th>
                            <th>ดูปฎิทิน</th>
                            <th>สลิปโอนเงิน</th>
                            <th>แนบสลิปโอนเงิน</th>
                            <th>พิมพ์ใบเสร็จ</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php
                    require_once('connections/mysqli.php');
                    $user_id = $_SESSION['user_id'];
                    $user_username = $_SESSION['user_username'];
                    $sql = "SELECT * FROM events WHERE user_id = $user_id";
                    $result = mysqli_query($Connection, $sql);
                    while ($row = mysqli_fetch_array($result)) {
                        echo "<tr>";
                        echo "<td class='center-align'>" . $row['id'] . "</td>";
                        echo "<td class='center-align'>" . $row['user_username'] . "</td>";
                        echo "<td class='center-align'>" . $row['service'] . "</td>";
                        echo "<td class='center-align'>" . $row['animal'] . "</td>";
                        echo "<td class='center-align'>" . $row['quantity'] . "</td>";
                        echo "<td class='center-align'>" . $row['price'] . "</td>";
                        echo "<td class='center-align'>" . $row['start'] . "</td>";
                         // แสดงสถานะ
                         echo "<td class='center-align'>";
                         $status = $row['status'];
                         if ($status == 0) {
                             echo "รอตรวจสอบชำระเงิน";
                         } elseif ($status == 1) {
                             echo "ชำระเงินแล้ว";
                         } elseif ($status == 2) {
                             echo "ยกเลิกบริการ";
                         } 
                         echo "</td>";
                        echo "<td class='center-align'><a class='btn btn-danger' href='cancle.php?id=" . $row['id'] . "' type='button' onclick=\"return confirm('ต้องการยกเลิกการจองใช่หรือไม่?')\">ยกเลิกบริการ</a></td>";
                        echo "<td class='center-align'>";
                        echo "<a href='calendarmaster/index.php' class='btn btn-success bi bi-calendar' role='button'></a>";
                        echo "<td class='center-align'>";
                        // ตรวจสอบสถานะและกำหนดให้ปุ่มเป็น "disabled" หรือไม่
                        if ($row['status'] === "" || $row['status'] === "ยกเลิกบริการ" || $row['status'] === "2") {
                            echo "<button class='btn btn-secondary'>ดูสลิปโอนเงิน</button>";
                        } else {
                            echo "<button class='btn btn-primary view-slip-button-events' data-toggle='modal' data-target='#view_slip_modal_" . $row['id'] . "' data-image='calendarmaster/" . $row['image'] . "'>ดูสลิปโอนเงิน</button>";
                        }
                        echo "</td>";
                        echo "<td class='center-align'>";
                        
                        // ตรวจสอบสถานะและกำหนดให้ปุ่มเป็น "disabled" หรือไม่
                        if ($row['status'] === "" || $row['status'] === "ยกเลิกบริการ"  || $row['status'] === "2") {
                            echo "<a class='btn btn-secondary bi bi-pencil-square' type='button'></a>";
                        } else {
                            echo "<a href='status_image.php? id= $row[id]' class='btn btn-success bi bi-pencil-square' type='button'></a>";
                        }
                        echo "</td>";
                        echo "<td class='center-align'>";
                        
                        // ตรวจสอบสถานะและกำหนดให้ปุ่มเป็น "disabled" หรือไม่
                        if ($row['status'] === "รอตรวจสอบชำระเงิน" || $row['status'] === "0"|| $row['status'] === "ยกเลิกบริการ"  || $row['status'] === "2") {
                            echo "<a  class='btn btn-secondary print-receipt-button' >พิมพ์ใบเสร็จ</a>";
                        } else {
                            echo "<a href='pdf_event.php? id= $row[id]' class='btn btn-danger print-receipt-button' type='button' data-status='" . $row['status'] . "'>พิมพ์ใบเสร็จ</a>";
                        }
                        echo "</td>";
                        echo "</tr>";
                    }
                    ?>

        
                    </tbody>
                    </table>
                </div>
            </div>
        </div>
    </main>
    </div>

    <!-- Modal เพื่อแสดงรูปภาพสลิปโอนเงิน -->
    <div class="modal fade" id="viewSlipModal_events" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-lg"> <!-- modal-lg คือ modal ขนาดใหญ่ -->
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">รูปภาพสลิปโอนเงิน</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <img id="slipImage_events" src="" style="max-width: 100%; max-height: 100%;" /> <!-- ใช้ max-width: 100%; max-height: 100%; เพื่อปรับขนาดรูปให้เต็มขนาด modal -->
            </div>
        </div>
    </div>
</div>



</div>
</tbody>
</table>

<!-- table data -->
<div id="layoutSidenav_content">
    <main>
        <div class="container-fluid px-4 mt-4 center-content">

            <div class="card mb-4 text-dark ">
                <div class="card-header">
                    <i class="fas fa-table me-5 text-dark "></i>
                    แสดงข้อมูลบริการรับฝาก
                </div>
                <div class="card-body line-2">
                <div class="table-responsive">
                    <table id="datatablesSimple">
                        <thead>
                        <tr>
                            <th>ลำดับ</th>
                            <th>ชื่อผู้ใช้</th>
                            <th>บริการ</th>
                            <th>จำนวนสัตว์</th>
                            <th>ราคา</th>
                            <th>สี</th>
                            <th>วันที่ฝาก</th>
                            <th>วันที่รับกลับ</th>
                            <th>สถานะ</th>
                            <th>ยกเลิกบริการ</th>
                            <th>ดูปฎิทิน</th>
                            <th>สลิปโอนเงิน</th>
                            <th>แนบสลิปโอนเงิน</th>
                            <th>พิมพ์ใบเสร็จ</th>
                            <th>พิมพ์ใบรับฝาก</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php
                            require_once('connections/mysqli.php');
                            $user_id = $_SESSION['user_id'];
                            $user_username = $_SESSION['user_username'];
                            $sql = "SELECT * FROM deposit WHERE user_id = $user_id";
                            $result = mysqli_query($Connection, $sql);
                            while ($row = mysqli_fetch_array($result)) {
                                echo "<tr>";
                                echo "<td class='center-align'>" . $row['id'] . "</td>";
                                echo "<td class='center-align'>" . $row['user_username'] . "</td>";
                                echo "<td class='center-align'>" . $row['service'] . "</td>";
                                echo "<td class='center-align'>" . $row['quantity'] . "</td>";
                                echo "<td class='center-align'>" . $row['price'] . "</td>";
                                echo "<td class='center-align'>" . $row['color'] . "</td>";
                                echo "<td class='center-align'>" . $row['start'] . "</td>";
                                echo "<td class='center-align'>" . $row['end'] . "</td>";
                                
                                // แสดงสถานะ
                                echo "<td class='center-align'>";
                                $status = $row['status'];
                                if ($status == 0) {
                                    echo "รอตรวจสอบชำระเงิน";
                                } elseif ($status == 1) {
                                    echo "ชำระเงินแล้ว";
                                } elseif ($status == 2) {
                                    echo "ยกเลิกบริการ";
                                }
                                echo "</td>";
                            
                                // แสดงปุ่มยกเลิกบริการ
                                echo "<td class='center-align'><a class='btn btn-danger' href='canclex.php?id=" . $row['id'] . "' type='button' onclick=\"return confirm('ต้องการยกเลิกการจองใช่หรือไม่?')\">ยกเลิกบริการ</a></td>";
                                echo "<td class='center-align'>";
                                echo "<a href='calendardeposit/index.php' class='btn btn-success bi bi-calendar' role='button'></a>";
                                // แสดงปุ่มดูสลิปโอนเงิน
                                echo "<td class='center-align'>";
                                if ($row['status'] === "รอตรวจสอบชำระเงิน" || $row['status'] === ""|| $row['status'] === "ยกเลิกบริการ"  || $row['status'] === "2") {
                                    echo "<button class='btn btn-secondary'>ดูสลิปโอนเงิน</button>";
                                } else {
                                    echo "<button class='btn btn-primary view-slip-button-events' data-toggle='modal' data-target='#view_slip_modal_" . $row['id'] . "' data-image='calendardeposit/" . $row['image'] . "'>ดูสลิปโอนเงิน</button>";
                                }
                                echo "</td>";
                                
                                // แสดงปุ่มแก้ไข
                                echo "<td class='center-align'>";
                                if ($row['status'] === "รอตรวจสอบชำระเงิน" || $row['status'] === ""|| $row['status'] === "ยกเลิกบริการ"  || $row['status'] === "2") {
                                    echo "<a class='btn btn-secondary bi bi-pencil-square' type='button'></a>";
                                } else {
                                    echo "<a href='status_imagex.php? id= $row[id]' class='btn btn-success bi bi-pencil-square' type='button'></a>";
                                }
                                echo "</td>";
                                
                                // แสดงปุ่มพิมพ์ใบเสร็จ
                                echo "<td class='center-align'>";
                                if ($row['status'] === "รอตรวจสอบชำระเงิน" || $row['status'] === "0"|| $row['status'] === "ยกเลิกบริการ"  || $row['status'] === "2") {
                                    echo "<a class='btn btn-secondary print-receipt-button' >พิมพ์ใบเสร็จ</a>";
                                } else {
                                    echo "<a href='pdf_eventx.php? id= $row[id]' class='btn btn-danger print-receipt-button' type='button' data-status='" . $status . "'>พิมพ์ใบเสร็จ</a>";
                                }
                                echo "</td>";
                                
                                // แสดงปุ่มพิมพ์ใบรับฝาก
                                echo "<td class='center-align'>";
                                if ($row['status'] === "รอตรวจสอบชำระเงิน" || $row['status'] === "0"|| $row['status'] === "ยกเลิกบริการ"  || $row['status'] === "2") {
                                    echo "<a class='btn btn-secondary print-receipt-button' >พิมพ์ใบรับฝาก</a>";
                                } else {
                                    echo "<a href='pdf_deposit.php? id= $row[id]' class='btn btn-danger print-receipt-button' type='button' data-status='" . $status . "'>พิมพ์ใบรับฝาก</a>";
                                }
                                echo "</td>";
                                
                                echo "</tr>";
                            }
                            ?>
                            

                    </tbody>
                    </table>
                </div>
            </div>
        </div>
    </main>
    </div>

    <!-- Modal เพื่อแสดงรูปภาพสลิปโอนเงิน -->
    <div class="modal fade" id="viewSlipModal_deposit" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">รูปภาพสลิปโอนเงิน</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <img id="slipImage" src="" style="width: 1000%; height: 1500px;" />
        </div>
      </div>
    </div>
  </div>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>

       
<!-- ส่วนของการแสดงสลิปการฝาก -->
<script>
const viewSlipButtonsDeposit = document.querySelectorAll('.view-slip-button-deposit');

viewSlipButtonsDeposit.forEach(function (button) {
    button.addEventListener('click', function () {
        const imageUrl = this.getAttribute('data-image');

        Swal.fire({
            imageUrl: imageUrl,
            imageAlt: 'กรุณาแนบรูปสลิปโอนเงิน',
            confirmButtonText: 'ปิด',
        });
    });
});
</script>

<!-- ส่วนของการแสดงสลิปการรับฝาก -->
<script>
const viewSlipButtonsEvents = document.querySelectorAll('.view-slip-button-events');

viewSlipButtonsEvents.forEach(function (button) {
    button.addEventListener('click', function () {
        const imageUrl = this.getAttribute('data-image');

        Swal.fire({
            imageUrl: imageUrl,
            imageAlt: 'กรุณาแนบรูปสลิปโอนเงิน',
            confirmButtonText: 'ปิด',

        });
    });
});
</script>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.7.0/dist/js/bootstrap.bundle.min.js"></script>
<script src="../assets/js/bootstrap.bundle.min.js"></script>
<script src="../assets/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/feather-icons/dist/feather.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script src="assets/dashboard.js"></script>
<script src="assets/js/bootstrap.bundle.min.js"></script>
<script>
// ตรวจสอบสถานะเมื่อหน้าเว็บโหลดเสร็จ
document.addEventListener("DOMContentLoaded", function () {
    // เลือกปุ่ม "พิมพ์ใบเสร็จ" ทั้งหมด
    const printButtons = document.querySelectorAll('.print-receipt-button');

    // ไล่วนลูปผ่านปุ่มทั้งหมดและตรวจสอบสถานะและปิดปุ่มตามเงื่อนไข
    printButtons.forEach(function (button) {
        const status = button.getAttribute('data-status');
        if (status === "รอตรวจสอบชำระเงิน") {
            button.setAttribute('disabled', 'true'); // ปิดปุ่ม
        }
    });
});
</script>


<br><br><br><br><br><br><br><br><br>
<?php include 'includes/footer.php';?>
<?php mysqli_close($Connection);?>
</body>
</html>
