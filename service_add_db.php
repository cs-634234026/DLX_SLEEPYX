<?php
require_once('connections/mysqli.php');

if (isset($_POST["submit"])) {

    $id = $_POST["id"];
    $quantity = $_POST["quantity"];
    $service = $_POST["service"];
    $price = $_POST["price"];
    $Depositdate = $_POST["start"];
    $returndate= $_POST["end"];
    $time = $_POST["time"];
    $description = $_POST["description"];
    $status = $_POST["status"];
  
      $sql = "INSERT INTO `tb_order` (`id_order`, `id_user`, `service`, `quantity`, `depositdate`, `returndate`, `time`, `description`, `price`, `status`) 
      VALUES (NULL, '$id', '$service', '$quantity', '$Depositdate', '$returndate', '$time', ' $description', '$price', '0')";
      $query = mysqli_query($Connection,$sql);
      header("location:status.php?status=success");
      exit();
    }
?>

