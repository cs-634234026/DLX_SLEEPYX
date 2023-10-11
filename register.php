<?php
require_once('connections/mysqli.php');

if ($_SESSION != NULL) {
  header("location:index.php");
  exit();
}

$check_submit = "";
$user_username = "";
$user_name = "";
$user_surname = "";
$user_email = "";

if (isset($_POST["submit"])) {
  $sql = "SELECT * FROM tb_user WHERE user_username = '".trim($_POST['user_username'])."'";
  $query = mysqli_query($Connection,$sql);
  $result = mysqli_fetch_array($query,MYSQLI_ASSOC);

  $user_username = $_POST["user_username"];
  $user_name = $_POST["user_name"];
  $user_surname = $_POST["user_surname"];
  $user_email = $_POST["user_email"];

  if ($result) {
    $check_submit = '<div class="alert alert-danger" role="alert">';
    $check_submit .= '<span><i class="bi bi-info-circle"></i> ชื่อผู้ใช้นี้คนอื่นใช้แล้ว กรอกชื่อผู้ใช้ใหม่</span>';
    $check_submit .= '</div>';
  }else{
    $sql = "INSERT INTO tb_user (user_username,user_password,user_name,user_surname,user_phone,user_email) VALUES ('".$_POST["user_username"]."','".md5($_POST["user_password"])."','".$_POST["user_name"]."','".$_POST["user_surname"]."','".$_POST["user_phone"]."','".$_POST["user_email"]."')";
    $query = mysqli_query($Connection,$sql);
    header("location:login.php?register=success");
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
<style>
    @import url(http://fonts.googleapis.com/css?family=Kanit);
    body {
        font-family: 'Kanit', sans-serif;
    }
</style>
<body class="default">
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
          <h5 class="card-header text-dark">สมัครสมาชิก SLEEPY-PET</h5>
          <div class="card-body">
            <div class="row justify-content-md-center mb-2">
              <div class="col col-lg-6">
                <img src="images/RS.png" style="width: 100%;">
              </div>
            </div>
            <form method="post">
              <div class="mb-3">
                <label class="form-label text-dark">ชื่อผู้ใช้</label>
                <input type="text" class="form-control" name="user_username" value="<?php echo $user_username;?>" placeholder="กรุณาใส่ Username" required/>
              </div>
              <div class="mb-3">
                <label class="form-label text-dark">รหัสผ่าน</label>
                <input type="password" class="form-control" name="user_password" placeholder="กรุณาใส่ Password" required/>
              </div>
              <div class="mb-3">
                <label class="form-label text-dark">ชื่อ</label>
                <input type="text" class="form-control" name="user_name" value="<?php echo $user_name;?>" placeholder="กรุณาใส่ ชื่อ" required/>
              </div>
              <div class="mb-3">
                <label class="form-label text-dark">นามสกุล</label>
                <input type="text" class="form-control" name="user_surname" value="<?php echo $user_surname;?>" placeholder="กรุณาใส่ นามสกุล" required/>
              </div>
              <div class="mb-3">
                <label class="form-label text-dark">เบอร์</label>
                <input type="number" class="form-control" name="user_phone" value="<?php echo $user_surname;?>" placeholder="กรุณาใส่ เบอร์โทร" required/>
              </div>
              <div class="mb-3">
                <label class="form-label text-dark">อีเมล์</label>
                <input type="email" class="form-control" name="user_email" value="<?php echo $user_email;?>" placeholder="กรุณาใส่ Email" required/>
              </div>
              
              <button type="submit" class="btn btn-success" name="submit">สมัครสมาชิก</button>
              <button class="btn btn-success" type="button" onclick="window.location.href='login.php'">ยกเลิก</button>
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
