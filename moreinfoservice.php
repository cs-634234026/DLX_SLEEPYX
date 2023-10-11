<?php
require_once('connections/mysqli.php');
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/icons/bootstrap-icons.css">
    <link rel="stylesheet" href="style.css">
    <title>Document</title>
</head>
<style>
    @import url(http://fonts.googleapis.com/css?family=Kanit);

    body {

        font-family: 'Kanit', sans-serif;
    }
</style>
<?php include 'includes/navbar.php'; ?>

<body>
    <?php
    if (isset($_GET['id'])) {
        $id = $_GET['id'];
        require_once('connections/mysqli.php');
        $sql = "SELECT * FROM tb_service WHERE id = $id";
        $result = mysqli_query($Connection, $sql);
    }
    while ($row = mysqli_fetch_array($result)) {
    ?>
        <div class="alert  h4 text-center " role="alert">
            <?= $row['service'] ?>
        </div>
        <div class="container">
            <div class="row">
                <div class="col-xl-6">
                    <img class="card-img-top text-dark" src="admin/<?= $row['image'] ?>" width="250px" height="400" alt="Card image cap" />
                </div>
                <div class="col-xl-6">
                    <p1><?= $row['description'] ?> 
                    <br><br>
                </p1>
                    <!-- Button trigger modal -->
                    <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#exampleModal">
                        เงื่อนไขในการใช้บริการ
                    </button>
                    <!-- Modal -->
                    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-scrollable">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">เงื่อนไขในการใช้บริการ</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <p>1.สัตว์เลี้ยงของท่านต้องมีอายุ 3 เดือนขึ้นไป พร้อมได้รับวัคซีนครบถ้วน</p>
                                    <p>2.สัตว์เลี้ยงของท่านต้องมีสุขพภาพที่แข็งแรงสมบูรณ์ ไม่มีโรคประจำตัวหรือโรคติดต่อหรืออยู่ในช่วงเจ็บป่วย ขณะมาใช้บริการ</p>
                                    <p>&nbsp;&nbsp;2.1 หากสัตว์เลี้ยงข้องท่านป่วยหรือเสียชีวิตระหว่างเข้าพักทางโรงแรมขอไม่รับผิดชอบใดๆทั้งสิ้น
                                        แต่ยินดีแสดงความบริสุทธิ์ใจด้วยการให้ดูกล้องวงจรปิดย้อนหลังในช่วงที่สัตว์ของท่านเข้าใจบริการ
                                        เพื่อเป็นการยืนยันว่าทางโรมแรมไม่มีการทำร้ายร่างกายและดูแลสัตว์เลี้ยงของท่านเป็นอย่างดี</p>
                                    <p>3.สัตว์เลี้ยงของท่านต้องไม่มีเห็บหมัดเด็ดขาด</p>
                                    <p>4.สัตว์เลี้ยงของท่านต้องมีสุขภาพจิตที่ดีไม่ดุ หากเกิดเหตุการณ์ที่ไม่คาดคิด เช่น สัตว์เลี้ยงของท่านข่วนหรือกัดพี่เลี้ยงท่านจะต้องรับผิดชอบ</p>
                                    <p>&nbsp;&nbsp;4.1 หากน้องดุจนไม่สามารถเข้าใกล้ได้ทางร้านขออนุญาติส่งน้องกลับ</p>
                                    <p>5.หากสัตว์เลี้ยงของท่านติดที่นอนหรือของเล่นของตนเอง เจ้าของต้องนำมาด้วย</p>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    <?php } ?>
</body>
<script src="assets/js/bootstrap.bundle.min.js"></script>
<br><br><br><br><br><br><br><br>
<?php include 'includes/footer.php'; ?>

</html>