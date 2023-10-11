<?php
require_once('connections/mysqli.php');
?>
<!DOCTYPE html>
<html lang="en " >
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
  </style>
</head>
<?php include 'includes/navbar.php';?>
<!-- box----> 
<body class="default">
<?php
            require_once('connections/mysqli.php');
            $sql = "SELECT * FROM tb_about";
            $result = mysqli_query($Connection, $sql);
            while ($row = mysqli_fetch_array($result)) {
            ?>
<div class="container col-xxl-8 px-4 py-5">
    <div class="row flex-lg-row-reverse align-items-center g-5 py-5">
      <div class="col-10 col-sm-8 col-lg-6">
      <img src="admin/<?= $row['image'] ?>" class="d-block mx-lg-auto img-fluid" alt="" width="800" height="800" loading="lazy">

      </div>
      <div class="col-lg-6">
        <h1 id="SLEEPY-PET"><?= $row['name'] ?> </h1>
        <p class="lead"> <?= $row['about'] ?></p>
      </div>
    </div>
  </div>
  <?php } ?>
  <br>  <br>  <br>  <br>
  <?php include 'contact.php';?>
</body>
<script src="assets/js/bootstrap.bundle.min.js"></script>
  <br><br><br><br>
  <?php include 'includes/footer.php';?>
  <?php mysqli_close($Connection);?>
</html>
