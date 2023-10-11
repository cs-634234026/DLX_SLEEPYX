<?php
  $hostname = "localhost";
  $username = "root";
  $password = "";
  $database = "sleepy_database";
  $Connection = mysqli_connect($hostname, $username, $password, $database);

  if (!$Connection) {
    exit('ไม่สามารถเชื่อมต่อกับฐานข้อมูล');
  }

  //ตั้งค่าชุดอักขระไคลเอนต์เริ่มต้น
  mysqli_set_charset($Connection, "utf8");

  //เปิดใช้งาน SESSION
  session_start();

  //ตั้งค่า timezone ในประเทศไทย
  date_default_timezone_set('Asia/Bangkok');

  //กำหนด title เว็บไซต์
  $title = "";

  // เลือกข้อมูลผู้ใช้งาน
  if ($_SESSION != NULL) {
    $sql_tb_user = "SELECT * FROM tb_user WHERE user_username = '".$_SESSION['user_username']."'";
    $query_tb_user = mysqli_query($Connection,$sql_tb_user);
    $result_tb_user = mysqli_fetch_array($query_tb_user);
  }

  //check_submit
  $check_submit = "";
  //สำหรับเกิดข้อผิดพลาด
  function check_submit_p1($check_submit_p1) {
    $check_submit = "<div class='col-md-12 mb-2'>";
    $check_submit .= "<div class='row justify-content-md-center'>";
    $check_submit .= "<div class='col-md-auto'><span class='badge bg-danger' style='font-size: 1rem;'><i class='bi bi-exclamation-diamond'></i> $check_submit_p1</span></div>";
    $check_submit .= "</div>";
    $check_submit .= "</div>";

    return  $check_submit;
  }
  //สำหรับการทำงานสำเร็จ
  function check_submit_p2($check_submit_p2) {
    $check_submit = "<div class='col-md-12 mb-2'>";
    $check_submit .= "<div class='row justify-content-md-center'>";
    $check_submit .= "<div class='col-md-auto'><span class='badge bg-success' style='font-size: 1rem;'><i class='bi bi-check-circle'></i> $check_submit_p2</span></div>";
    $check_submit .= "</div>";
    $check_submit .= "</div>";

    return  $check_submit;
  }
?>
