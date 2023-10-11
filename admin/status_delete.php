<?php
include 'config.php';

if(isset($_GET['id'])) {
    $id = $_GET['id'];

    // Perform deletion query
    $deleteQuery = "DELETE FROM events WHERE id = '$id'";
    $result = mysqli_query($conn, $deleteQuery);

    if($result) {
        // Successful deletion
        echo "<script>
            alert('ลบข้อมูลเรียบร้อยแล้ว');
            window.location.href = 'status.php';
        </script>";
    } else {
        // Failed to delete
        echo "<script>
            alert('เกิดข้อผิดพลาดในการลบข้อมูล');
            window.location.href = 'status.php';
        </script>";
    }
} else {
    // No ID provided
    echo "<script>
        alert('ไม่มีรหัสที่จะใช้ในการลบข้อมูล');
        window.location.href = 'status.php';
    </script>";
}

mysqli_close($Connection);
?>
