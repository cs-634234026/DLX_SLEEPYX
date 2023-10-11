<?php
require_once('connections/mysqli.php');

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title><?php echo $title; ?></title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/icons/bootstrap-icons.css">
    <link rel="stylesheet" href="style.css">
    <script src="assets/js/bootstrap.bundle.min.js"></script>
    <style>
        @import url(http://fonts.googleapis.com/css?family=Kanit);

        body {
            font-family: 'Kanit', sans-serif;
            background-color: #17202A;
        }

        h4 {
            color: white;
        }
    </style>
</head>

<body>
    <!-- บริการทั่วไป -->
    <div class="content-wrapper">
        <div class="container-xxl flex-grow-1 container-p-y">
            <h4 class="fw-bold py-3 mb-4"><span>บริการ /</span> บริการทั่วไป</h4>
            <div class="row row-cols-1 row-cols-md-2 row-cols-lg-3 g-4 mb-3">
            <?php
            require_once('connections/mysqli.php');
            $sql = "SELECT * FROM tb_service";
            $result = mysqli_query($Connection, $sql);
            while ($row = mysqli_fetch_array($result)) {
                $serviceStatus = $row['status'];
            ?>
    <form action="calendarmaster/addEvent.php" method="post">
        <div class="card-group mb-5">
            <div class="card h-100">
                <img class="card-img-top text-dark" src="admin/img/<? $row['image'] ?>" width="300px" height="250" alt="Card image cap" />
                <div class="card-body text-dark">
                    <div class="text-center">
                        <?= $row['service'] ?><br>
                    </div>

                    <hr class="dropdown-divider mb-4" />
                    <input type="hidden" id="number" class="form-control" name="productid" value="<?= $row['id'] ?>" hidden />
                    <div class="row d-grid gap-2 col-6 mx-auto mx-2">
                        <?php if ($serviceStatus === 'เปิดให้บริการ') { ?>
                            <button class="bt btn rounded-pill btn-outline-success" type="submit" name="add">จองคิว</button>
                        <?php } else { ?>
                            <button class="bt btn rounded-pill btn-outline-success" type="button" disabled>จองคิว</button>
                        <?php } ?>

                        <button class="bt btn rounded-pill btn-outline-danger" type="button" onclick="redirectToReservationPage()">ดูคิวบริการทั่วไป</button>
                                    <script>
                                        function redirectToReservationPage() {
                                            window.location.href = 'calendarmaster/index.php'; // เด้งไปยังหน้า calendarmaster/index.php
                                        }
                                    </script>

                    </div>
                    <div class="float-end">
                    <a href="moreinfoservice.php?id=<?php echo $row['id']; ?>" class="text-decoration-none">
                            <br><span class="text-right">รายละเอียดข้อมูลเพิ่มเติม<span class="bi bi-chevron-right ml-2"></span></span>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </form>
<?php
}
?>


            </div>
        </div>
    </div>

    <!-- บริการรับฝาก -->
    <div class="content-wrapper">
        <div class="container-xxl flex-grow-1 container-p-y">
            <h4 class="fw-bold py-3 mb-4"><span>บริการ /</span> บริการรับฝาก</h4>
            <div class="row row-cols-1 row-cols-md-2 row-cols-lg-3 g-4 mb-3">
                <?php
                $sql = "SELECT * FROM tb_servicedeposit";
                $result = mysqli_query($Connection, $sql);
                while ($row = mysqli_fetch_array($result)) {
                    $serviceStatus = $row['status'];
                ?>
                    <form action="calendardeposit/addEvent.php" method="post">
                        <div class="card-group mb-5">
                            <div class="card h-100">
                                <img class="card-img-top text-dark" src="admin/<?= $row['image'] ?>" width="300px" height="250" alt="Card image cap" />
                                <div class="card-body text-dark">
                                <div class="text-center">
                                    <?= $row['service'] ?><br>
                                </div>
                                    <hr class="dropdown-divider mb-4" />
                                    <input type="hidden" id="number" class="form-control" name="productid" value="<?= $row['id'] ?>" hidden />
                                    <div class="row d-grid gap-2 col-6 mx-auto mx-2">
                                    <?php if ($serviceStatus === 'เปิดให้บริการ') { ?>
                                    <button class="bt btn rounded-pill btn-outline-success" type="submit" name="add">จองคิว</button>
                                    <?php } else { ?>
                                        <button class="bt btn rounded-pill btn-outline-success" type="button" disabled>จองคิว</button>
                                    <?php } ?>
                                        <button class="bt btn rounded-pill btn-outline-danger" type="button" onclick="redirectToDepositReservationPage()">ดูคิวบริการรับฝาก</button>
                                        <script>
                                            function redirectToDepositReservationPage() {
                                                window.location.href = 'calendardeposit/index.php'; // เด้งไปยังหน้า calendardeposit/index.php
                                            }
                                        </script>

                                    </div>
                                    <div class="float-end">
                                        <a href="moreinfoservicedeposit.php?id=<?php echo $row['id']; ?>" class="text-decoration-none">
                                            <br><span class="text-right">รายละเอียดข้อมูลเพิ่มเติม<span class="bi bi-chevron-right ml-2"></span></span>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                <?php
                }
                mysqli_close($Connection);
                ?>
            </div>
        </div>
    </div>
</body>

</html>
