<?php
include 'config.php';

$id = $_GET["id"];
$sql = "SELECT * FROM tb_service WHERE id = '".$id."'";
$query = mysqli_query($conn,$sql);
$result = mysqli_fetch_array($query,MYSQLI_ASSOC);

?>

<?php

if(isset($_POST['id'])){
  $id = $_POST['id'];
  $service = $_POST['service'];
  $status = $_POST['status'];
  $description = $_POST['description'];
  $price = $_POST['price'];

  $sql = "UPDATE tb_service SET id = '$id', service = '$service', status = '$status', description = '$description', price = '$price' WHERE `tb_service` .`id` = $id";
    if (mysqli_query($conn, $sql)){
        $_SESSION['success'] = "แก้ไขผู้ใช้สำเร็จ";
        header('location: service.php');
    } else {
        $_SESSION['errors'] = "แก้ไขผู้ใช้ไม่สำเร็จ";
        header('location: service.php');
    }
}


?>

<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="../assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="../assets/icons/bootstrap-icons.css">
    <link rel="stylesheet" href="assets/dashboard.css">
    <title>ระบบหลังบ้าน</title>
  </head>
  <body>
    <?php include 'include/header.php'; ?>
    <div class="container-fluid">
      <div class="row">
        <?php include 'include/sidebarMenu.php'; ?>
        <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
          <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
            <h1 class="h2">แก้ไขข้อมูลบริการ</h1>
            <div class="btn-toolbar mb-2 mb-md-0">
              <button type="button" class="btn btn-secondary" onclick="window.location.href='service.php'">ย้อนกลับ</button>
            </div>
          </div>
          <div class="row justify-content-md-center">
            <div class="col-6">
              <div class="card">
                <h5 class="card-header"><?php echo 'ID : '.$_GET['id']; ?></h5>
                <div class="card-body">
                  <form method="post" action="service_update.php" >
                    <input type="hidden" name="id" value="<?php echo $id?>">
                    <div class="mb-3">
                      <label for="service" class="form-label">ชื่อบริการ</label>
                      <input type="text" class="form-control" id="service" name="service" value="<?php echo $result['service']; ?>" required>
                    </div>

                    <div class="mb-3">
                      <label for="service" class="form-label">ราคา</label>
                      <input type="text" class="form-control" id="price" name="price" value="<?php echo $result['price']; ?>" required>
                    </div>

                    <div class="mb-3">
                      <label class="form-label">สถานะบริการ</label>
                      <select class="form-select" name="status" onchange="checkTimeAvailability(this)">
                        <option value="เปิดให้บริการ" <?php if ($result["status"] == 'เปิดให้บริการ') {echo " selected";} ?> >เปิดให้บริการ</option>
                        <option value="ปิดให้บริการ" <?php if ($result["status"] == 'ปิดให้บริการ') {echo " selected";} ?> >ปิดให้บริการ</option>
                        <option value="เต็ม" <?php if ($result["status"] == 'เต็ม') {echo " selected";} ?> >เต็ม</option>
                      </select>
                    </div>

                    <!-- <div class="mb-3">
                      <label class="form-label">รูปภาพ</label>
                      <input type="file" class="form-control" name="image" id="image" accept=".jpg, .jpeg, .png" value="" />
                    </div> -->

                    <div class="mb-3">
                      <label for="description" class="form-label">รายละเอียดบริการ</label>
                      <textarea class="form-control" id="description" name="description" rows="3" required><?php echo $result['description']; ?></textarea>
                    </div>

                    <button type="submit" name="submit" class="btn btn-primary">บันทึก</button>
                  </form>
                </div>
              </div>
            </div>
          </div>
        </main>
      </div>
    </div>
    <script src="../assets/js/bootstrap.bundle.min.js"></script>
  </body>
</html>
