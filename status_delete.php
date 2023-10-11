<?php
require_once('connections/mysqli.php');

if(isset($_GET['id'])) {
    $id = $_GET['id'];

    // Display a confirmation dialog using JavaScript
    echo "<script>
          var result = confirm('คุณต้องการลบข้อมูลนี้หรือไม่?');
          if (result) {
            // User confirmed, perform deletion
            " . "window.location.href = 'status_delete_confirm.php?id=$id';" . "
          } else {
            // User cancelled, do nothing
            window.location.href = 'status.php';
          }
          </script>";
}

mysqli_close($Connection);
?>
