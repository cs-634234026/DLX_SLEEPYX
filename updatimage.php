<?php
session_start();
require_once('connections/mysqli.php');
if (isset($_POST['submit'])) {
    $id = $_POST['id'];
    $oldPhotoPath = ($_POST['old_photo_path']);
    $pic = ($_FILES['pic']);

    if (isset($_FILES['pic'])) {
        $newPhoto = $_FILES['pic'];
        $newPhotoName = $newPhoto['name'];
        unlink($oldPhotoPath);


        // Upload the file
        $targetPath = "$newPhotoName";
        move_uploaded_file($newPhoto['tmp_name'], $targetPath);


        // Insert the values into the database
        $sql = "UPDATE events SET image = '$newPhotoName' WHERE `events`.`id` = $id";
        mysqli_query($Connection, $sql);
        header('location: status.php');
    } else {
    }
}
mysqli_close($conn);
?>