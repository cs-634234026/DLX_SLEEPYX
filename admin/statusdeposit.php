<?php
// เชื่อมต่อกับฐานข้อมูล
include 'config.php';

$sql1 = "SELECT COUNT(id) AS id_zero FROM deposit WHERE status='0'";
$hand1 = mysqli_query($conn, $sql1);
$row1 = mysqli_fetch_array($hand1);

$sql2 = "SELECT COUNT(id) AS id_one FROM deposit WHERE status='1'";
$hand2 = mysqli_query($conn, $sql2);
$row2 = mysqli_fetch_array($hand2);

$sql3 = "SELECT COUNT(id) AS id_two FROM deposit WHERE status='2'";
$hand3 = mysqli_query($conn, $sql3);
$row3 = mysqli_fetch_array($hand3);

?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="../assets/css/bootstrap.min.css">
  <link rel="stylesheet" href="../assets/icons/bootstrap-icons.css">
  <link rel="stylesheet" href="assets/dashboard.css">
  <link rel="stylesheet" href="../assets/css/bootstrap.min.css">
  <link rel="stylesheet" href="../assets/icons/bootstrap-icons.css">
  <link rel="stylesheet" href="assets/dashboard.css">
  <link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.min.css">
  <title>Document</title>
</head>

<body>
  <style>
     @import url(http://fonts.googleapis.com/css?family=Kanit);

      body {
        font-family: 'Kanit', sans-serif;
      }
      .center-align {
      text-align: center;
      }
        tbody tr:nth-child(even) {
      background-color: #f2f2f2;
      }
      .img-thumbnail {
      width: 200px;
      height: auto;
      display: block;
      margin: 0 auto;
      }
      .btn-edit {
        background-color: #28a745;
        color: white;
        border: none;
      }

      /* ปุ่มลบ */
      .btn-delete {
        background-color: #dc3545;
        color: white;
        border: none;
      }
      td {
        padding: 20px; /* ปรับตามความต้องการ */
      }
      tr {
        margin-bottom: 20px; /* ปรับตามความต้องการ */
      }
      th {
        padding: 10px; /* ปรับตามความต้องการ */
      }
  </style>

   <!-- เพิ่มฟอร์มค้นหาที่นี่ -->

  <?php include 'include/header.php'; ?>
  <div class="container-fluid">
    <div class="row">
      <?php include 'include/sidebarMenu.php'; ?>
      
      <div id="layoutSidenav_content" style="margin-right: 40px;">
    <div class="container-fluid px-4">
        <ol class="breadcrumb mb-4">
        </ol>
        <div class="row justify-content-center text-center">
            <div class="col-xl-3 col-md-6">
                <div class="card bg-warning text-white mb-4">
                    <div class="card-body">รอตรวจสอบชำระเงิน<h4><?=$row1['id_zero']?></h4></div>
                    <div class="card-footer d-flex align-items-center justify-content-between">
                        <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-md-6">
                <div class="card bg-success text-white mb-4">
                    <div class="card-body">ชำระเงินแล้ว<h4><?=$row2['id_one']?></h4></div>
                    <div class="card-footer d-flex align-items-center justify-content-between">
                        <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-md-6">
                <div class="card bg-danger text-white mb-4">
                    <div class="card-body">ยกเลิกบริการ<h4><?=$row3['id_two']?></h4></div>
                    <div class="card-footer d-flex align-items-center justify-content-between">
                        <a class="small text-white stretched-link" href="#"> </a>
                        <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                    </div>
                </div>
            </div>
        </div> 
    </div>
</div>
      <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
        <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
          <h1 class="h2">ข้อมูลการจองบริการรับฝาก</h1>
          <div class="btn-toolbar mb-2 mb-md-0">

            <!-- เพิ่มข้อมูล -->
            <!-- <button type="button" class="btn btn-secondary" data-bs-toggle="modal" data-bs-target="#add_data">เพิ่มข้อมูลบริการ</button> -->
            <div class="modal fade" id="add_data" tabindex="-1" aria-hidden="true">
              <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">



                <form class="modal-content" method="post" action="service.php" enctype="multipart/form-data">
                  <div class="modal-header">

                    <div class="mb-3">
                      <label class="form-label">สถานะบริการ</label>
                      <select class="form-select" name="status" onchange="checkTimeAvailability(this)">
                        <option value="เปิด">เปิด</option>
                        <option value="ปิด">ปิด</option>
                        <option value="เต็ม">เต็ม</option>
                      </select>
                    </div>


                    <div class="mb-3">
                      <label class="form-label">รูปภาพ</label>
                      <input type="file" class="form-control" name="image" id="image" accept=".jpg, .jpeg, .png" value="" />
                    </div>

                    <div class="mb-3">
                      <label for="description" class="form-label">รายละเอียดบริการ</label>
                      <textarea class="form-control" id="description" name="description" rows="3" required></textarea>
                    </div>
                  </div>
                  
                  <!-- บันทึกข้อมูลเข้าไปในตาราง -->
                  <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">ยกเลิก</button>
                    <button type="submit" name="submit" class="btn btn-primary">บันทึกข้อมูล</button>
                  </div>
                </form>
              </div>
            </div>
          </div>
        </div>

        <!-- Modal เพื่อแสดงรูปภาพสลิปโอนเงิน -->
  <div class="modal fade" id="viewSlipModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">รูปภาพสลิปโอนเงิน</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <img id="slipImage" src="" style="max-width: 100%; max-height: 400px;" />
        </div>
      </div>
    </div>
  </div>

    
   <div id="layoutSidenav_content">
    <main>
        <div class="container-fluid px-4 mt-4 center-content">

            <div class="card mb-4 text-dark ">
                <div class="card-header">
                    <i class="fas fa-table me-5 text-dark "></i>
                    แสดงข้อมูล
                </div>
                <div class="card-body line-2">
                <div class="table-responsive">
                    <table id="datatablesSimple">
                        <thead>
                        <tr>
                        <th scope="col" style="text-align: center; white-space: nowrap;">ลำดับ</th>
                        <th scope="col" style="text-align: center; white-space: nowrap;">ชื่อบริการ</th>
                        <th scope="col" style="text-align: center; white-space: nowrap;">ชื่อผู้ใช้บริการ</th>
                        <th scope="col" style="text-align: center; white-space: nowrap;">จำนวน</th>
                        <th scope="col" style="text-align: center; white-space: nowrap;">วันที่ฝาก</th>
                        <th scope="col" style="text-align: center; white-space: nowrap;">วันที่รับกลับ</th>
                        <th scope="col" style="text-align: center; white-space: nowrap;">เวลา</th>
                        <th scope="col" style="text-align: center; white-space: nowrap;">รายละเอียด</th>
                        <th scope="col" style="text-align: center; white-space: nowrap;">ราคา</th>
                        <th scope="col" style="text-align: center; white-space: nowrap;">สถานะบริการ</th>
                        <th scope="col" style="text-align: center; white-space: nowrap;">สลิปโอนเงิน</th>
                        <th scope="col" style="text-align: center; white-space: nowrap;">ลบข้อมูล</th>
                        <th scope="col" style="text-align: center; white-space: nowrap;">ปรับสถานะ</th>
                       

                        </tr>
                        </thead>
                        <tbody>
                       <!-- แสดงข้อมูลในตาราง -->
           <?php
            include 'config.php';
            $total_sum =0;
            $pic = mysqli_query($conn, "SELECT * FROM `deposit`");
            while ($row = mysqli_fetch_array($pic)) {
              $total_sum = $total_sum+$row['price'];
              echo "
                              <tr>
                              <td class='center-align' style='white-space: nowrap;'>$row[id]</td>
                              <td class='center-align' style='white-space: nowrap;'>$row[service]</td>
                              <td class='center-align' style='white-space: nowrap;'>$row[user_username]</td>
                              <td class='center-align' style='white-space: nowrap;'>$row[quantity]</td>
                              <td class='center-align' style='white-space: nowrap;'>$row[start]</td>
                              <td class='center-align' style='white-space: nowrap;'>$row[end]</td>
                              <td class='center-align' style='white-space: nowrap;'>$row[time]</td>
                              <td class='center-align' style='white-space: nowrap;'>$row[description]</td>
                              <td class='center-align' style='white-space: nowrap;'>$row[price]</td>
                              <td class='center-align' style='white-space: nowrap;'>";

                              // แสดงสถานะ
                              $status = $row['status'];
                              if ($status == 0) {
                                  echo "รอตรวจสอบชำระเงิน";
                              } elseif ($status == 1) {
                                  echo "ชำระเงินแล้ว";
                              } elseif ($status == 2) {
                                  echo "ยกเลิกบริการ";
                              }
                              
                              echo "</td>
                              <td class='center-align' style='white-space: nowrap;'>
                                  <button class='btn btn-primary view-slip-button-events' data-toggle='modal' data-target='#view_slip_modal_$row[id]' data-image='img/$row[image]'>
                                      สลิปโอนเงิน
                                  </button>
                              </td>
                              <td class='center-align' style='white-space: nowrap;'>
                                  <a href='status_deletex.php?id=$row[id]' class='btn btn-danger' type='button'>ลบข้อมูล</a>
                              </td>
                              <td class='center-align' style='white-space: nowrap;'>
                                  <a href='status_updatex.php?id=$row[id]' class='btn btn-success bi bi-pencil-square' type='button'></a>
                              </td>
                              
                              </tr>
                              
                                    ";

            }
            ?>
                    </tbody>
                    </table>
                </div>
            </div>
        </div>
    </main>
    </div>
</div>
</tbody>
</table>


        <script src="../assets/js/bootstrap.bundle.min.js"></script>
        <script src="../assets/js/bootstrap.bundle.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/feather-icons/dist/feather.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
        <script src="assets/dashboard.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
        <script src="../assets/js/bootstrap.bundle.min.js"></script>
        <script src="../assets/js/bootstrap.bundle.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/feather-icons/dist/feather.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
        <script src="assets/dashboard.js"></script>
        <script src="../assets/js/bootstrap.bundle.min.js"></script>
        <script src="assets/js/bootstrap.bundle.min.js"></script>

       
         <script>
  // JavaScript สำหรับการแสดง SweetAlert แทนการแสดงรูปภาพใน Modal
  const viewSlipButtons = document.querySelectorAll('.view-slip-button-events');

  viewSlipButtons.forEach(function (button) {
    button.addEventListener('click', function () {
      const imageUrl = this.getAttribute('data-image');

      // แสดง SweetAlert แสดงรูปภาพ
      Swal.fire({
        imageUrl: imageUrl,  // URL รูปภาพ
        imageAlt: 'สลิปโอนเงิน',  // ข้อความคำอธิบายรูปภาพ
        confirmButtonText: 'ปิด',  // ข้อความบนปุ่มยืนยัน
      });
    });
  });
</script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
<script>
$(document).ready(function() {
    $('#datatablesSimple').DataTable({
        lengthChange: true, // แสดง dropdown สำหรับเลือกจำนวน entries ต่อหน้า
        searching: true, // แสดงช่องค้นหา
        info: false, // ไม่แสดงข้อมูลที่บอกถึงการแสดงผล (Show x of y entries)
    });
});
</script>

</body>

</html>