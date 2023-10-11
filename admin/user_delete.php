<?php
require_once('../connections/mysqli.php');

if ($_SESSION == NULL) {
  header("location:../login.php");
  exit();
}elseif ($_SESSION["user_level"] != "admin") {
  header("location:../index.php");
  exit();
}

$id = $_GET["id"];
$sql = "DELETE FROM tb_user WHERE user_id = '".$id."' ";
$query = mysqli_query($Connection,$sql);

if (mysqli_affected_rows($Connection)) {
  header("location:user.php?delete=pass");
  exit();
}

mysqli_close($Connection);
?>
