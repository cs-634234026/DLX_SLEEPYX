<?php
require_once('connections/mysqli.php');

?>
<!DOCTYPE html>
<html lang="en ">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title><?php echo $title; ?></title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/icons/bootstrap-icons.css">
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
<?php include 'includes/navbar.php';?>
<body>
    <br>
<?php include 'sleepyservice.php';?>

</body>
<script src="assets/js/bootstrap.bundle.min.js"></script>
<?php include 'includes/footer.php';?>
</html>