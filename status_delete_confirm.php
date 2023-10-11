<?php
require_once('connections/mysqli.php');

if(isset($_GET['id'])) {
    $id = $_GET['id'];

    // Perform deletion query
    $deleteQuery = "DELETE FROM events WHERE id = '$id'";
    $result = mysqli_query($Connection, $deleteQuery);

    if($result) {
        // Successful deletion
        echo "<script>
            alert('ลบข้อมูลเรียบร้อยแล้ว');
            window.location.href = 'status.php';
        </script>";
    } else {
        // Failed to delete
        echo "Error deleting data: " . mysqli_error($Connection);
    }
} else {
    // No ID provided
    echo "No ID provided for deletion.";
}

mysqli_close($Connection);
?>
