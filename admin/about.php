
<?php
session_start();
include('config.php');
if (isset($_POST['submit'])) {
  $name = $_POST["name"];
  $map = $_POST["map"];
  $about = $_POST["about"];
  $adress = $_POST["adress"];
  $line = $_POST["line"];
  $facebook = $_POST["facebook"];
  $phone = $_POST["phone"];


    // Upload the file
    $target_dir = "img/";
    $target_file = $target_dir . basename($_FILES["image"]["name"]);
    move_uploaded_file($_FILES["image"]["tmp_name"], $target_file);


    // Insert the values into the database
    $sql = "INSERT INTO tb_about (name, map, image ,about , adress , line , facebook , phone) 
    VALUES ('$name', '$map', '$target_file', '$about', '$adress', '$line', '$facebook' , '$phone')";
    mysqli_query($conn, $sql);
    header('location: about.php');
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
/* เพิ่ม CSS ในไฟล์ของคุณ */
table {
  width: 100%; /* ความกว้างของตารางเต็มหน้าจอ */
  /* หรือ */
  min-width: 3000px; /* ความกว้างขั้นต่ำของตาราง */
}
/* เพิ่ม CSS ในไฟล์ของคุณ */
td, th {
  /* ปรับความกว้างของเซลล์ตาราง */
  width: 100px; /* หรือค่าอื่น ๆ ตามที่คุณต้องการ */
}




  </style>
  <?php include 'include/header.php'; ?>
  <div class="container-fluid">
    <div class="row">
      <?php include 'include/sidebarMenu.php'; ?>
      <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
        <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
          <h1 class="h2">ข้อมูลเกี่ยวกับร้าน</h1>
          <div class="btn-toolbar mb-2 mb-md-0">
            
            <!-- เพิ่มข้อมูล -->
            <button type="button" class="btn btn-secondary" data-bs-toggle="modal" data-bs-target="#add_data">เพิ่มข้อมูลบริการ</button>
            <div class="modal fade" id="add_data" tabindex="-1" aria-hidden="true">
              <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">



                <form class="modal-content" method="post" action="about.php" enctype="multipart/form-data">
                  <div class="modal-header">
                    <h5 class="modal-title">เพิ่มข้อมูลบริการ</h5>
                  </div>
                  <div class="modal-body">


                    <div class="mb-3">
                      <label for="name" class="form-label">ชื่อร้าน</label>
                      <input type="text" class="form-control" id="name" name="name" required>
                    </div>


                    <div class="mb-3">
                      <label class="form-label">รูปภาพ</label>
                      <input type="file" class="form-control" name="image" id="image" accept=".jpg, .jpeg, .png" value="" />
                    </div>


                    <div class="mb-3">
                      <label for="map" class="form-label">แผนที่ร้าน</label>
                      <input type="" class="form-control" id="map" name="map" required>
                    </div>

                    <div class="mb-3">
                                <label class="form-label text-dark">เบอร์โทร</label>
                                <input type="number" class="form-control" name="phone" id="phone" value=""required />
                    </div>

                    <div class="mb-3">
                      <label for="adress" class="form-label">ที่ตั้ง</label>
                      <textarea class="form-control" id="adress" name="adress" rows="3" required></textarea>
                    </div>

                    <div class="mb-3">
                      <label for="about" class="form-label">เกี่ยวกับร้าน</label>
                      <textarea class="form-control" id="about" name="about" rows="3" required></textarea>
                    </div>

                    <div class="mb-3">
                      <label for="facebook" class="form-label">Facebook</label>
                      <input type="text" class="form-control mx-auto" id="facebook" name="facebook" required>
                    </div>

                    <div class="mb-3">
                      <label for="line" class="form-label">Line</label>
                      <input type="text" class="form-control mx-auto" id="line" name="line" required>
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
                            <th scope="col"style="text-align: center;">ชื่อร้าน</th>
                            <th scope="col"style="text-align: center;" width="400px" heigth="200px">รูปภาพ</th>
                            <th scope="col"style="text-align: center;">แก้ไขรูปภาพ</th>
                            <th scope="col"style="text-align: center;">เกี่ยวกับร้าน</th>
                            <th scope="col"style="text-align: center;">ที่ตั้ง</th>
                            <th scope="col"style="text-align: center;">เบอร์โทร</th>
                            <th scope="col"style="text-align: center;">FACEBOOK</th>
                            <th scope="col"style="text-align: center;">LINE</th>
                            <th scope="col"style="text-align: center;">MAP</th>
                            <th scope="col"style="text-align: center;">ลบ</th>
                            <th scope="col"style="text-align: center;">แก้ไข</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php
            include 'config.php';
            $pic = mysqli_query($conn, "SELECT * FROM `tb_about`");
            while ($row = mysqli_fetch_array($pic)) {
              echo "
                              <tr>
                              <td class='center-align'>$row[id]</td>
                              <td class='center-align name-cell'>$row[name]</td>
                              <td class='center-align image-cell'><img src= '$row[image]' class='img-thumbnail'></td>
                              <td class='center-align edit-image'><a href='about_updateImage.php?id=$row[id]' class='btn btn-edit bi bi-pencil-square' type='button'></a></td>
                              <td class='center-align adress-cell'>$row[adress]</td>
                              <td class='center-align about-cell'>$row[about]</td>
                              <td class='center-align phone-cell'>$row[phone]</td>
                              <td class='center-align facebook-cell'>$row[facebook]</td>
                              <td class='center-align line-cell'>$row[line]</td>
                              <td class='center-align map-cell'>$row[map]</td>
                              <td class='center-align delete-cell'><a href='about_delete.php?id=$row[id]' class='btn btn-danger' type='button' onclick='return confirmDelete()'>ลบข้อมูล</a></td>
                              <td class='center-align edit-cell'><a href='about_update.php?id=$row[id]' class='btn btn-success' type='button'>แก้ไข</a></td>
                              
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
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script> <!-- เรียกใช้ jQuery -->
<script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script> <!-- เรียกใช้ DataTables -->
<script src="https://cdn.datatables.net/1.11.5/js/dataTables.bootstrap5.min.js"></script> <!-- เรียกใช้ DataTables Bootstrap 5 Integration -->
<script>
$(document).ready(function() {
    $('#datatablesSimple').DataTable({
        // คำสั่งอื่น ๆ ที่คุณต้องการใส่ได้ที่นี่
        autoWidth: false,
    });
});
</script>


</body>

</html>

