<?php
include 'config.php';

// เอาไว้ระบุแก้ไขอะไรสมมุติมี 5 บริการจะแก้ไขยังไง
$id = $_GET["id"];
$sql = "SELECT * FROM tb_service WHERE id = '".$id."'";
$query = mysqli_query($conn,$sql);
$result = mysqli_fetch_array($query,MYSQLI_ASSOC);
$img = $result['image'];

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
          <h1 class="h2">แก้ไขรูปบริการ</h1>
          <div class="btn-toolbar mb-2 mb-md-0">
            <button type="button" class="btn btn-secondary" onclick="window.location.href='service.php'">ย้อนกลับ</button>
          </div>
        </div>
        <div class="row justify-content-md-center">
          <div class="col-6">
            <div class="card">
              <h5 class="card-header">แก้ไขรูปภาพ</h5>
              <div class="card-body">
                <form method="post" action="updatimagex.php" enctype="multipart/form-data">
                <input type="hidden" name="old_photo_path" value="<?php echo $img?>">
                <input type="hidden" name="id" value="<?php echo $id?>">

                  <div class="mb-3">
                    <label class="form-label">รูปภาพ</label>
                    <img src="" id="preview" width="200" class="mx-auto d-block mb-3">
                    <input type="file" class="form-control" name="pic" id="formFile" accept=".jpg, .jpeg, .png" value="" />
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
  <script>
    const input = document.getElementById('formFile');
    const preview = document.getElementById('preview');
    input.addEventListener('change', () => {
      const file = input.files[0];
      const reader = new FileReader();
      reader.addEventListener('load', () => {
        preview.src = reader.result;
      });

      reader.readAsDataURL(file);
    });
  </script>
</body>

</html>