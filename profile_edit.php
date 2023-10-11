<?php
require_once('connections/mysqli.php');

if ($_SESSION == NULL) {
  header("location:login.php");
  exit();
}

$sql = "SELECT * FROM tb_user WHERE user_username = '".$_SESSION['user_username']."'";
$query = mysqli_query($Connection,$sql);
$result = mysqli_fetch_array($query);

if (isset($_POST["save"])) {
  $sql_2 = "UPDATE tb_user SET user_name = '".$_POST["user_name"]."' , user_surname = '".$_POST["user_surname"]."' , user_phone = '".$_POST["user_phone"]."' , user_email = '".$_POST["user_email"]."' WHERE user_username = '".$_SESSION['user_username']."'";
  $query_2 = mysqli_query($Connection,$sql_2);

  header("location:profile.php?update=pass");
  exit();
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
<body class="bg-dark">
  <?php include 'includes/navbar.php';?>
  <div class="container-fluid">
    <div class="row justify-content-md-center">
      <div class="col-md-5 mb-4">
        <div class="card border-dark mt-2">
          <h5 class="card-header text-dark">แก้ไขข้อมูลผู้ใช้ ID : <?php echo $result[0]; ?></h5>
          <div class="card-body">
            <div class="row justify-content-md-center mb-2">
              <div class="col col-lg-6">
                <img src="images/RS.png" style="width: 100%;">
              </div>
            </div>
            <form method="post">
              <div class="mb-3">
                <label class="form-label">ชื่อผู้ใช้</label>
                <input type="text" class="form-control" value="<?php echo $result[1];?>" disabled/>
              </div>
              <div class="mb-3">
                <label class="form-label">ชื่อ</label>
                <input type="text" class="form-control" name="user_name" value="<?php echo $result[3];?>" required/>
              </div>
              <div class="mb-3">
                <label class="form-label">นามสกุล</label>
                <input type="text" class="form-control" name="user_surname" value="<?php echo $result[4];?>" required/>
              </div>
              <div class="mb-3">
                <label class="form-label">เบอร์</label>
                <input type="number" class="form-control" name="user_phone" value="<?php echo $result[5];?>" required/>
              </div>
              <div class="mb-3">
                <label class="form-label">อีเมล์</label>
                <input type="email" class="form-control" name="user_email" value="<?php echo $result[6];?>"/>
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
