<?php

include 'config.php';
echo $id =$_GET['id'];
mysqli_query($conn,"DELETE FROM `tb_servicedeposit` WHERE id=$id");
header('location:servicedeposit.php');
?>