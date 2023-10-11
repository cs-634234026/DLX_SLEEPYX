<?php

include 'config.php';
echo $id =$_GET['id'];
mysqli_query($conn,"DELETE FROM `tb_about` WHERE id=$id");
header('location:about.php');
?>