<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <nav>
        <header class="p-3 text-bg-dark">
            <div class="">
                <div class="d-flex flex-wrap align-items-center justify-content-center justify-content-lg-start">
                    <a href="index.php" class="d-flex align-items-center mb-2 mb-lg-0 text-white text-decoration-none">
                        <svg class="bi me-10" width="40" height="32" role="img" aria-label="Bootstrap">
                            <use xlink:href="#bootstrap"></use>
                        </svg>
                    </a>
                    <div>
                        <a href="index.php"><img src="images\logo2.png" width="250px" height="100"></a>
                    </div>
                    <div class="d-flex align-items-center ms-auto">
                        <ul class="container nav col-12 col-lg-auto me-lg-auto mb-2 justify-content-center mb-md-0">
                            <li><a href="index.php" class="nav-link px-3 text-dark btn btn-warning text-dark me-2">หน้าหลัก</a></li>
                            <li><a href="about.php" class="nav-link px-4 text-white">เกี่ยวกับเรา</a></li>
                            <li><a href="service.php" class="nav-link px-4 text-white">บริการ</a></li>
                            <li><a href="status.php" class="nav-link px-4 text-white">ตรวจสอบสถานะ</a></li>
                        </ul>
                        <div class="text-end ml-lg-4">
                            <?php
                            if ($_SESSION == NULL) {
                            ?>
                                <button class="btn btn-outline-warning" type="submit" onclick="window.location.href='login.php'">เข้าสู่ระบบ</button>
                            <?php
                            } else {
                            ?>
                                <div class="btn-group">
                                    <button type="button" class="btn btn-secondary dropdown-toggle" data-bs-toggle="dropdown" data-bs-display="static" aria-expanded="false">
                                        <?php echo "</i> " . $result_tb_user[3] . ' ' . $result_tb_user[4] . ' '; ?></button>
                                    <ul class="dropdown-menu dropdown-menu-lg-end">
                                        <li><button class="dropdown-item" type="button" onclick="window.location.href='profile.php'">ข้อมูลส่วนตัว</button></li>
                                        <li><button class="dropdown-item" type="button" onclick="window.location.href='history.php'">ประวัติการใช้งาน</button></li>
                                        <?php
                                        if ($_SESSION["user_level"] == "admin") {
                                        ?>
                                            <li><button class="dropdown-item" type="button" onclick="window.location.href='admin/index.php'">ระบบหลังบ้าน</button></li>
                                        <?php
                                        }
                                        ?>
                                        <hr>
                                        <li><button class="dropdown-item" type="button" onclick="window.location.href='logout.php'">ออกจากระบบ</button></li>
                                    </ul>
                                </div>
                            <?php
                            }
                            ?>
                        </div>
                    </div>
                </div>
            </div>
        </header>
    </nav>
</body>

</html>
