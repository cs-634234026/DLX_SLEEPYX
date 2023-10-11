<style>
    p {
        color: white;
    }

    .row {
        display: flex;
        flex-direction: row-reverse;
        /* เรียงลำดับแถวในทิศทางตรงกันข้าม */
    }

    .col-lg-6 {
        flex: 1;
        /* ทำให้ col-lg-6 ยืดเต็มพื้นที่ทางแนวนอน */
    }
</style>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <div class="container col-xxl-8 px-4 py-5">
        <div class="row flex-lg-row-reverse align-items-center g-5 py-5">
            <div class="col-10 col-sm-8 col-lg-6 order-lg-2">
                <img src="images\booking.jpg" class="d-block mx-lg-auto img-fluid" width="300" height="300" loading="lazy">
            </div>
            <div class="col-lg-6 order-lg-1 text-align-center">
                <h1 id="SLEEPY-PET">บริการอาบน้ำสัตว์ </h1>
                <p class="lead text-dark">Sleepy pet hotel&spa โรงแรมรับ-ฝากหมาแมว
                      สิ่งอำนวยความสะดวก ห้องแอร์ ห้องแยกส่วนตัว มีเตียงนอน ถาดรองฉี่ ถ้วยน้ำถ้วยอาหารบริการ มีพี่เลี้ยงคอยดูแลเด็กๆ
                        มีอัพรูป + วิดีโอให้ลูกค้า สถานที่สะอาดได้รับการฆ่าเชื้อ มีกล้องวงจรปิดรักษาความปลอดภัย 
                        สิ่งที่ลูกค้าต้องนำมาคืออาหาร แผ่นรองซับ(ในกรณีน้องใช้ถาดรองไม่เป็น) และทรายแมว</p>
                <div class="d-grid gap-2 d-md-flex justify-content-md-start">
                    <button type="button" class="btn btn-warning btn-lg px-4 me-md-2" onclick="showertoservice()">เริ่มต้นใช้บริการ</button>
                    <script>
                        function showertoservice() {
                            window.location.href = 'service.php';
                        }
                    </script>
                </div>
            </div>
        </div>
    </div>

</body>

</html>