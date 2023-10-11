<?php
require_once('connections/mysqli.php');
if (!$_SESSION) {
    header("location:login.php");
    exit();
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
    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.min.css">

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
                    ประวัติข้อมูลบริการทั่วไป
                </div>
                <div class="card-body line-2">
                    <div class="table-responsive">
                        <table id="datatablesSimple-events">
                            <thead>
                        <tr>
                            <th>ลำดับ</th>
                            <th>ชื่อผู้ใช้</th>
                            <th>บริการ</th>
                            <th>จำนวนสัตว์</th>
                            <th>ราคา</th>
                            <th>วันที่ฝาก</th>
                            <th>สถานะ</th>
                            <th>สลิปโอนเงิน</th>
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
                    
                                            
                        // แสดงปุ่มดูสลิปโอนเงิน
                        echo "<td class='center-align'>";
                        if ($row['status'] === "รอตรวจสอบชำระเงิน" || $row['status'] === ""|| $row['status'] === "ยกเลิกบริการ"  || $row['status'] === "2") {
                            echo "<button class='btn btn-secondary'>ดูสลิปโอนเงิน</button>";
                        } else {
                            echo "<button class='btn btn-primary view-slip-button-deposit' data-toggle='modal' data-target='#view_slip_modal_" . $row['id'] . "' data-image='admin/img/" . $row['image'] . "'>ดูสลิปโอนเงิน</button>";
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
                    ประวัติข้อมูลบริการรับฝาก
                </div>
                <div class="card-body line-2">
                <div class="table-responsive">
                    <table id="datatablesSimple-deposit">
                        <thead>
                        <tr>
                            <th>ลำดับ</th>
                            <th>ชื่อผู้ใช้</th>
                            <th>บริการ</th>
                            <th>จำนวนสัตว์</th>
                            <th>ราคา</th>
                            <th>วันที่ฝาก</th>
                            <th>วันที่รับกลับ</th>
                            <th>สถานะ</th>
                            <th>สลิปโอนเงิน</th>
                            <th>พิมพ์ใบเสร็จ</th>
                            <th>พิมพ์ใบรับฝากสัตว์</th>
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
                    
                      
                        
                        // แสดงปุ่มดูสลิปโอนเงิน
                        echo "<td class='center-align'>";
                        if ($row['status'] === "รอตรวจสอบชำระเงิน" || $row['status'] === ""|| $row['status'] === "ยกเลิกบริการ"  || $row['status'] === "2") {
                            echo "<button class='btn btn-secondary'>ดูสลิปโอนเงิน</button>";
                        } else {
                            echo "<button class='btn btn-primary view-slip-button-deposit' data-toggle='modal' data-target='#view_slip_modal_" . $row['id'] . "' data-image='admin/img/" . $row['image'] . "'>ดูสลิปโอนเงิน</button>";
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
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
<script>
$(document).ready(function() {
    $('#datatablesSimple-events').DataTable({
        lengthChange: true, // แสดง dropdown สำหรับเลือกจำนวน entries ต่อหน้า
        searching: true, // แสดงช่องค้นหา
        info: false, // ไม่แสดงข้อมูลที่บอกถึงการแสดงผล (Show x of y entries)
    });
});
</script>
<script>
$(document).ready(function() {
    $('#datatablesSimple-deposit').DataTable({
        lengthChange: true, // แสดง dropdown สำหรับเลือกจำนวน entries ต่อหน้า
        searching: true, // แสดงช่องค้นหา
        info: false, // ไม่แสดงข้อมูลที่บอกถึงการแสดงผล (Show x of y entries)
    });
});
</script>
<br><br><br><br><br><br><br><br><br>
<?php include 'includes/footer.php';?>
<?php mysqli_close($Connection);?>
</body>
</html>
