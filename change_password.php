<?php
require_once('connections/mysqli.php');

if ($_SESSION == NULL) {
  header("location:login.php");
  exit();
}

$check_submit = "";

$sql = "SELECT user_id, user_password FROM tb_user WHERE user_username = '".$_SESSION['user_username']."'";
$query = mysqli_query($Connection,$sql);
$result = mysqli_fetch_array($query);

if (isset($_POST['save'])) {
  if (md5($_POST['password_old']) != $result[1]) {
    $check_submit = '<div class="alert alert-danger" role="alert">';
    $check_submit .= '<span><i class="bi bi-info-circle"></i> รหัสผ่านเดิมไม่ถูกต้อง</span>';
    $check_submit .= '</div>';
  }elseif ($_POST['password_new'] != $_POST['confirm_password']) {
    $check_submit = '<div class="alert alert-danger" role="alert">';
    $check_submit .= '<span><i class="bi bi-info-circle"></i> รหัสผ่านใหม่ ไม่ต้องกับ ยืนยันรหัสผ่านใหม่</span>';
    $check_submit .= '</div>';
  }else{
    $sql_2 = "UPDATE tb_user SET user_password = '".md5($_POST["password_new"])."' WHERE user_username = '".$_SESSION['user_username']."'";
    $query_2 = mysqli_query($Connection,$sql_2);

    header("location:profile.php?update=pass");
    exit();
  }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title><?php echo $title; ?></title>
  <link rel="stylesheet" href="assets/css/bootstrap.min.css">
  <link rel="stylesheet" href="assets/icons/bootstrap-icons.css">
</head>
<body class="bg-dark">
<style>
    @import url(http://fonts.googleapis.com/css?family=Kanit);
    body {
        font-family: 'Kanit', sans-serif;
    }
</style>
  <?php include 'includes/navbar.php';?>
  <div class="container-fluid">
    <div class="col-md-12 mt-4">
      <div class="row justify-content-md-center">
        <div class="col-md-auto"><?php echo $check_submit;?></div>
      </div>
    </div>
    <div class="row justify-content-md-center">
      <div class="col-md-5 mb-4">
        <div class="card border-dark mt-2">
          <h5 class="card-header text-dark">เปลี่ยนรหัสผ่าน ID : <?php echo $result[0]; ?></h5>
          <div class="card-body">
            <div class="row justify-content-md-center mb-2">
              <div class="col col-lg-6">
                <img src="images/PW.png" style="width: 100%;">
              </div>
            </div>
            <form method="post">
              <div class="mb-3">
                <label class="form-label text-dark">รหัสผ่านเดิม</label>
                <input type="password" class="form-control" name="password_old" required/>
              </div>
              <div class="mb-3">
                <label class="form-label text-dark">รหัสผ่านใหม่</label>
                <input type="password" class="form-control" name="password_new" required/>
              </div>
              <div class="mb-3">
                <label class="form-label text-dark">ยืนยันรหัสผ่านใหม่</label>
                <input type="password" class="form-control" name="confirm_password" required/>
              </div>
              <button type="submit" class="btn btn-success" name="save">บันทึกข้อมูล</button>
              <button class="btn btn-success" type="button" onclick="window.location.href='profile.php'">ยกเลิก</button>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
  <script src="assets/js/bootstrap.bundle.min.js"></script>
  <?php mysqli_close($Connection);?>
</body>
</html>
