<?php

include 'config.php';
echo $id =$_GET['id'];
mysqli_query($conn,"DELETE FROM `tb_service` WHERE id=$id");
header('location:service.php');
?>