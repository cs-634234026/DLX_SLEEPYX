<?php
require_once('connections/mysqli.php');
?>
<?php include 'includes/navbar.php'; ?>
<!DOCTYPE html>
<html lang="en " >
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title><?php echo $title; ?></title>
  <link rel="stylesheet" href="assets/css/bootstrap.min.css">
  <link rel="stylesheet" href="assets/icons/bootstrap-icons.css">
  <link rel="stylesheet" href="style.css">
		<!-- Custom CSS -->
		<style>
         @import url(http://fonts.googleapis.com/css?family=Kanit);
    body {
        font-family: 'Kanit', sans-serif;
        background-color: #FFFF;
    }
  

		</style>
</head>
<?php include 'includes/body.php';?>
<?php include 'includes/shower.php';?>
<?php include 'includes/haircut.php';?>

<!-- <iframe src="http://localhost/calendarmaster/index.php" width="100%" height="1000" frameborder="100" style="overflow: hidden;"></iframe> -->

  
<body class="default">
  <script src="assets/js/bootstrap.bundle.min.js"></script>
  <?php include 'includes/footer.php';?>
  <?php mysqli_close($Connection);?>
</body>
</html>
