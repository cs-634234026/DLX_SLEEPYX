<?php
require_once('connections/mysqli.php');

if ($_SESSION != NULL) {
  header("location:index.php");
  exit();
}

$check_submit = "";
$user_username = "";

if (isset($_POST["submit"])) {
  $sql = "SELECT * FROM tb_user WHERE user_username = '".mysqli_real_escape_string($Connection,$_POST['user_username'])."' and user_password = '".mysqli_real_escape_string($Connection,md5($_POST['user_password']))."'";
  $query = mysqli_query($Connection,$sql);
  $result = mysqli_fetch_array($query,MYSQLI_ASSOC);

  if (!$result) {
    $user_username = $_POST['user_username'];
    $check_submit = '<div class="alert alert-danger" role="alert">';
    $check_submit .= '<span><i class="bi bi-info-circle"></i> ชื่อผู้ใช้หรือรหัสผ่านไม่ถูกต้อง กรุณาตรวจสอบใหม่อีกครั้ง</span>';
    $check_submit .= '</div>';
  }else{
    $_SESSION["user_username"] = $result["user_username"];
    $_SESSION["user_level"] = $result["user_level"];
    $_SESSION["user_id"] = $result["user_id"];
    $_SESSION["user_name"] = $result["user_name"];
    $_SESSION["user_phone"] = $result["user_phone"];
    $_SESSION["user_email"] = $result["user_email"];


    if ($_SESSION["user_level"] == 'admin') {
      header("location:admin/index.php");
      exit();
    }else{
      header("location:index.php");
      exit();
    }
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
  <div class="container-fluid">
    <div class="col-md-12 mt-4">
      <div class="row justify-content-md-center">
        <div class="col-md-auto"><?php echo $check_submit; ?></div>
      </div>
    </div>
    <div class="row justify-content-md-center">
      <div class="col-md-3 mb-4">
        <div class="card border-dark mt-2">
          <h5 class="card-header text-dark">ล็อคอิน User </h5>
          <div class="card-body">
            <div class="row justify-content-md-center mb-2">
              <div class="col col-lg-6">
                <img src="images/LG.png" style="width: 100%;">
              </div>
            </div>
            <form method="post">
              <div class="mb-3">
                <label class="form-label">ชื่อผู้ใช้</label>
                <input type="text" class="form-control" name="user_username" value="<?php echo $user_username;?>" placeholder="Enter Username" required/>
              </div>
              <div class="mb-3">
                <label class="form-label">รหัสผ่าน</label>
                <input type="password" class="form-control" name="user_password" placeholder="Enter Password" required/>
              </div>
              <button type="submit" class="btn btn-success" name="submit">เข้าสู่ระบบ</button>
              <a class="btn btn-warning" href="register.php" role="button">สมัครสมาชิก</a>
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
<?php
if (isset($_GET["register"])) {
  if ($_GET["register"] == "success") {
    ?>
    <script type="text/javascript">
      alert("สมัครสมาชิกสำเร็จแล้ว เข้าสู่ระบบได้เลย");
    </script>
    <?php
  }
}
?>
