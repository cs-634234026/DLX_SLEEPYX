<?php
session_start();
include('config.php');
if (isset($_POST['submit'])) {
    $id = $_POST['id'];
    $oldPhotoPath = ($_POST['old_photo_path']);
    $pic = ($_FILES['pic']);

    if (isset($_FILES['pic'])) {
        $newPhoto = $_FILES['pic'];
        $newPhotoName = $newPhoto['name'];
        unlink($oldPhotoPath);


        // Upload the file
        $targetPath = "img/$newPhotoName";
        move_uploaded_file($newPhoto['tmp_name'], $targetPath);


        // Insert the values into the database
        $sql = "UPDATE tb_service SET image = '$targetPath' WHERE `tb_service`.`id` = $id";
        mysqli_query($conn, $sql);
        header('location: service.php');
    } else {
    }
}
mysqli_close($conn);
?>