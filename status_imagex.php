<?php
require_once('connections/mysqli.php');

// เอาไว้ระบุแก้ไขอะไรสมมุติมี 5 บริการจะแก้ไขยังไง
$id = $_GET["id"];
$sql = "SELECT * FROM deposit WHERE id = '".$id."'";
$query = mysqli_query($Connection,$sql);
$result = mysqli_fetch_array($query,MYSQLI_ASSOC);
$img = $result['image'];

?>

!DOCTYPE html>
<html lang="en ">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/icons/bootstrap-icons.css">
    <link rel="stylesheet" href="/assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="/assets/icons/bootstrap-icons.css">
    <link rel="stylesheet" href="assets/dashboard.css">
    
    <link rel="stylesheet" href="style.css">
    <script src="assets/js/bootstrap.bundle.min.js"></script>
    <style>
        @import url(http://fonts.googleapis.com/css?family=Kanit);

        body {
            font-family: 'Kanit', sans-serif;
            background-color: #17202A;
        }
        h4{
            color: white;
        }
        
    </style>
</head>
<body>
  <div class="container-fluid">
    <div class="row">
      <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
        <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
          <h1 class="text-light">แนบสลิปโอนเงิน</h1>
          <div class="btn-toolbar mb-2 mb-md-0">
            <button type="button" class="btn btn-secondary" onclick="window.location.href='status.php'">ย้อนกลับ</button>
          </div>
        </div>
        <div class="row justify-content-md-center">
          <div class="col-6">
            <div class="card">
              <h5 class="card-header">แนบสลิปโอนเงิน</h5>
              <div class="card-body">
                <form method="post" action="updatimagex.php" enctype="multipart/form-data">
                <input type="hidden" name="old_photo_path" value="<?php echo $img?>">
                <input type="hidden" name="id" value="<?php echo $id?>">

                  <div class="mb-3">
                    <img src="" id="preview" width="200" class="mx-auto d-block mb-3">
                    <input type="file" class="form-control" name="pic" id="formFile" accept=".jpg, .jpeg, .png" value="" />
                  </div>

                      <!-- Button trigger modal -->
                      <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#exampleModal">
                        เลขบัญชีที่ต้องชำระเงิน
                    </button>
                  <button type="submit" name="submit" class="btn btn-primary">บันทึก</button>
                </form>
              </div>
            </div>
          </div>
        </div>
      </main>
    </div>
  </div>

                    <!-- Modal -->
                    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-scrollable">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">กรุณาชำระเงิน</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <p> ธนาคารออมสิน ; 2025412688461515</p>
                                    <p> นายธีรภัทร ตันเก็ง ( กรุณาตรวจสอบชื่อก่อนโอน )</p>
                                   <img src="images\payment.png" width="" height="">
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
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