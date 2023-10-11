<?php
require_once('../connections/mysqli.php');

if ($_SESSION == NULL) {
  header("location:../login.php");
  exit();
}elseif ($_SESSION["user_level"] != "admin") {
  header("location:../index.php");
  exit();
}

$id = $_POST["id"];

$sql = "UPDATE tb_user SET user_password = '".md5($_POST['user_password'])."' WHERE user_id = '".$id."'";
$query = mysqli_query($Connection,$sql);

header("location:user.php?update=pass");
exit();

mysqli_close($Connection);
?>
