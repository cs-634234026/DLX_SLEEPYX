<?php
include 'config.php';

$id = $_GET["id"];
$sql = "SELECT * FROM tb_about WHERE id = '".$id."'";
$query = mysqli_query($conn,$sql);
$result = mysqli_fetch_array($query,MYSQLI_ASSOC);

?>

<?php

if(isset($_POST['id'])){
  $id = $_POST['id'];
  $name = $_POST['name'];
  $map = $_POST['map'];
  $phone = $_POST['phone'];
  $about = $_POST['about'];
  $adress = $_POST['adress'];
  $facebook = $_POST['facebook'];
  $line = $_POST['line'];



  $sql = "UPDATE tb_about SET id = '$id', name = '$name', map = '$map', phone = '$phone', about = '$about', adress = '$adress', facebook = '$facebook', line = '$line' WHERE `tb_about` .`id` = $id";
    if (mysqli_query($conn, $sql)){
        $_SESSION['success'] = "แก้ไขผู้ใช้สำเร็จ";
        header('location: about.php');
    } else {
        $_SESSION['errors'] = "แก้ไขผู้ใช้ไม่สำเร็จ";
        header('location: about.php');
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
            <h1 class="h2">แก้ไขข้อมูลผู้ใช้งาน</h1>
            <div class="btn-toolbar mb-2 mb-md-0">
              <button type="button" class="btn btn-secondary" onclick="window.location.href='about.php'">ย้อนกลับ</button>
            </div>
          </div>
          <div class="row justify-content-md-center">
            <div class="col-6">
              <div class="card">
                <h5 class="card-header"><?php echo 'ID : '.$_GET['id']; ?></h5>
                <div class="card-body">

                  <form method="post" action="about_update.php" >
                    <input type="hidden" name="id" value="<?php echo $id?>">

                    <div class="mb-3">
                      <label for="service" class="form-label">ชื่อร้าน</label>
                      <input type="text" class="form-control" id="name" name="name" value="<?php echo $result['name']; ?>" required>
                    </div>

                    <div class="mb-3">
                      <label for="map" class="form-label">แผนที่ร้าน</label>
                      <textarea class="form-control" id="map" name="map" rows="3" required><?php echo $result['map']; ?></textarea>
                    </div>

                    <div class="mb-3">
                      <label for="service" class="form-label">เบอร์โทร</label>
                      <input type="number" class="form-control" id="phone" name="phone" value="<?php echo $result['phone']; ?>" required>
                    </div>

                    <div class="mb-3">
                      <label for="adress" class="form-label">ที่ตั้ง</label>
                      <textarea class="form-control" id="adress" name="adress" rows="3" required><?php echo $result['adress']; ?></textarea>
                    </div>

                    <div class="mb-3">
                      <label for="about" class="form-label">เกี่ยวกับร้าน</label>
                      <textarea class="form-control" id="about" name="about" rows="3" required><?php echo $result['about']; ?></textarea>
                    </div>

                    <div class="mb-3">
                      <label for="facebook" class="form-label">facebook</label>
                      <input type="text" class="form-control" id="facebook" name="facebook" value="<?php echo $result['facebook']; ?>" required>
                    </div>

                    <div class="mb-3">
                      <label for="line" class="form-label">LINE</label>
                      <input type="text" class="form-control" id="line" name="line" value="<?php echo $result['line']; ?>" required>
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
