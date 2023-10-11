
<?php
session_start();
include('config.php');
if (isset($_POST['submit'])) {
  $service = $_POST["service"];
  $status = "เปิดให้บริการ";
  $description = $_POST["description"];
  $price = $_POST["price"];


    // Upload the file
    $target_dir = "img/";
    $target_file = $target_dir . basename($_FILES["image"]["name"]);
    move_uploaded_file($_FILES["image"]["tmp_name"], $target_file);


    // Insert the values into the database
    $sql = "INSERT INTO tb_service (service, status, description, image,price) 
    VALUES ('$service', '$status', '$description', '$target_file', '$price')";
    mysqli_query($conn, $sql);
    header('location: service.php');
}
mysqli_close($conn);


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
  <link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.min.css">
  <title>Document</title>
</head>

<body class="sb-nav-fixed">
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
  </style>
  <?php include 'include/header.php'; ?>
  <div class="container-fluid">
    <div class="row">
      <?php include 'include/sidebarMenu.php'; ?>
      <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
        <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
          <h1 class="h2">ข้อมูลบริการทั่วไป</h1>
          <div class="btn-toolbar mb-2 mb-md-0">
            
            <!-- เพิ่มข้อมูล -->
            <button type="button" class="btn btn-secondary" data-bs-toggle="modal" data-bs-target="#add_data">เพิ่มข้อมูลบริการ</button>
            <div class="modal fade" id="add_data" tabindex="-1" aria-hidden="true">
              <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">



                <form class="modal-content" method="post" action="service.php" enctype="multipart/form-data">
                  <div class="modal-header">
                    <h5 class="modal-title">เพิ่มข้อมูลบริการ</h5>
                  </div>
                  <div class="modal-body">


                    <div class="mb-3">
                      <label for="service" class="form-label">ชื่อบริการ</label>
                      <input type="text" class="form-control" id="service" name="service" required>
                    </div>

                    <div class="mb-3">
                      <label class="form-label">สถานะบริการ</label>
                      <select class="form-select" name="status" onchange="checkTimeAvailability(this)">
                        <option value="เปิด">เปิดให้บริการ</option>
                        <option value="ปิด">ปิดให้บริการ</option>
                        <option value="เต็ม">เต็ม</option>
                      </select>
                    </div>


                    <div class="mb-3">
                      <label class="form-label">รูปภาพ</label>
                      <input type="file" class="form-control" name="image" id="image" accept=".jpg, .jpeg, .png" value="" />
                    </div>


                    <div class="mb-3">
                                <label class="form-label text-dark">ราคา</label>
                                <input type="text" class="form-control" name="price" id="price-input" value=""required />
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


        <!-- table data -->
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
                            <th scope="col"style="text-align: center;">ลำดับ</th>
                            <th scope="col"style="text-align: center;">ชื่อบริการ</th>
                            <th scope="col"style="text-align: center;" width="400px" heigth="200px">รูปภาพ</th>
                            <th scope="col"style="text-align: center;">แก้ไขรูปภาพ</th>
                            <th scope="col"style="text-align: center;">ราคา</th>
                            <th scope="col"style="text-align: center;">รายละเอียด</th>
                            <th scope="col"style="text-align: center;">สถานะ</th>
                            <th scope="col"style="text-align: center;">ลบ</th>
                            <th scope="col"style="text-align: center;">แก้ไข</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php
            include 'config.php';
            $pic = mysqli_query($conn, "SELECT * FROM `tb_service`");
            while ($row = mysqli_fetch_array($pic)) {
              echo "
                              <tr>
                              <td class='center-align'>$row[id]</td>
                              <td class='center-align' style='white-space: nowrap; overflow: hidden;'>$row[service]</td>
                              <td class='center-align'><img src= '$row[image]' class='img-thumbnail'></td>
                              <td class='center-align style='white-space: nowrap; overflow: hidden;'><a href='service_updateImage.php?id=$row[id]' class='btn btn-success' type='button'>แก้ไข</a></td>
                              <td class='center-align style='white-space: nowrap; overflow: hidden;'>$row[price]</td>
                              <td class='center-align style='white-space: nowrap; overflow: hidden;'>$row[description]</td>
                              <td class='center-align style='white-space: nowrap; overflow: hidden;'>$row[status]</td>
                              <td class='center-align' style='white-space: nowrap; overflow: hidden;'><a href='service_delete.php?id=$row[id]' class='btn btn-danger' type='button' onclick='return confirmDelete()'>ลบข้อมูล</a></td>
                              <td class='center-align style='white-space: nowrap; overflow: hidden;'><a href='service_update.php?id=$row[id]'class='btn btn-success' type='button'>แก้ไข</a></td>
                              
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
        <script src="../assets/js/bootstrap.bundle.min.js"></script>
        <script src="assets/js/bootstrap.bundle.min.js"></script>
        
        <script>
          // ค้นหา element ของ select และ input
          const quantitySelect = document.getElementById('quantity-select');
          const priceInput = document.getElementById('price-input');

          // เพิ่มเหตุการณ์เมื่อมีการเปลี่ยนแปลงใน select
          quantitySelect.addEventListener('change', function() {
            const selectedQuantity = parseInt(quantitySelect.value); // ค่าจำนวนที่เลือก
            const additionalPrice = 300; // ราคาเพิ่มเติมที่ต้องการให้เพิ่ม

            const totalPrice = selectedQuantity * additionalPrice; // คำนวณราคารวม

            priceInput.value = totalPrice; // กำหนดค่าราคาให้กับ input
          });
        </script>

        <script>
          function checkTimeAvailability(selectElement) {
            const selectedTime = selectElement.value;
            const selectOptions = selectElement.getElementsByTagName('option');

            // ตรวจสอบตัวเลือกทั้งหมด
            for (let i = 0; i < selectOptions.length; i++) {
              const option = selectOptions[i];
              if (option.value !== selectedTime) {
                option.disabled = false; // เปิดใช้งานตัวเลือกที่ไม่ซ้ำกัน
              } else {
                option.disabled = true; // ปิดใช้งานตัวเลือกที่ซ้ำกัน
              }
            }
          }
        </script>
        <script>
function confirmDelete() {
    return confirm("คุณต้องการลบข้อมูลนี้หรือไม่?");
}
</script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
<script>
$(document).ready(function() {
    $('#datatablesSimple').DataTable({
        paging: true, // Show pagination
        lengthChange: true, // Show entries dropdown
        searching: true, // Show search box
        scrollY: "400px", // Set a fixed height for vertical scrolling
        scrollCollapse: true, // Enable vertical scrollbar
        ordering: true, // Enable column sorting
        info: true, // Show table information
        autoWidth: false // Disable automatic column width calculation
    });
});
</script>


</body>

</html>