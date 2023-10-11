<?php
require_once('connections/mysqli.php');
?>
<!DOCTYPE html>
<html lang="en ">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title><?php echo $title; ?></title>
  <link rel="stylesheet" href="assets/css/bootstrap.min.css">
  <link rel="stylesheet" href="assets/icons/bootstrap-icons.css">
  <link rel="stylesheet" href="style.css">

  <style>
    @import url(http://fonts.googleapis.com/css?family=Kanit);

    body {
      font-family: 'Kanit', sans-serif;
    }

    h1 {
      text-align: center;
      padding: 40px;
    }

    h3 {
      text-align: center;
    }

    h2 {
      text-align: center;
    }
    .cardcontact{
      padding-top: 10px;
    }
  </style>
</head>
<body class="default">
        <?php
            require_once('connections/mysqli.php');
            $sql = "SELECT * FROM tb_about";
            $result = mysqli_query($Connection, $sql);
            while ($row = mysqli_fetch_array($result)) {
            ?>
<h1>ติดต่อเรา</h1>
<h3>ร้าน Sleepy-Pet Hotel & Spa พร้อมดูแลสัตว์ของท่าน</h3>
<div class="container col-xxl-8 px-4 py-5">
  <div class="row flex-lg-row-reverse align-items-center g-5 py-5">
    <div class="col-10 col-sm-8 col-lg-6">
    <?= $row['map'] ?>
    </div>
    <div class="col-lg-6">
      <img src="images\map.png" class="rounded mx-auto d-block" width="100" height="100">
      <h2>ที่ตั้ง </h2>
      <p class="lead"> <?= $row['adress'] ?> </p>
      <div class="cardcontact">
        <div class="row row-cols-1 row-cols-md-2 row-cols-lg-3 g-4 mb-3 d-flex flex-wrap ">
          <div class="card text-center" style="width: 10rem;">
            <div>
          <a href="#"><i class="fa-solid fa-phone" style="font-size: 40px; color: green; padding: 13px;"></i></a>
          </div>
            <div class="card-body">
              <h5 class="card-title">เบอร์โทร</h5>
              <p class="card-text"><?= $row['phone'] ?></p>
            </div>
          </div>
          <div class="card text-center" style="width: 10rem;">
            <a href="<?= $row['facebook'] ?>" target="_blank"><i class="fa-brands fa-square-facebook" style="font-size: 48px; padding: 10px;"></i></a>
            <div class="card-body">
              <h5 class="card-title">Facebook</h5>
              <p class="card-text">Sleepy pet hotel&spa</p>
            </div>
          </div>
          <div class="card text-center" style="width: 10rem;">
            <a href="#"><i class="fa-brands fa-line" style="font-size: 40px; color: green; padding: 15px;" ></i></a>
            <div class="card-body">
              <h5 class="card-title">Line</h5>
              <p class="card-text"><?= $row['line'] ?></p>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
</div>
<?php } ?>
</body>

</html>