<style>
    p {
        color: white;
    }
    .row {
    display: flex;
    flex-direction: row-reverse; /* เรียงลำดับแถวในทิศทางตรงกันข้าม */
    }

    .col-lg-6 {
        flex: 1; /* ทำให้ col-lg-6 ยืดเต็มพื้นที่ทางแนวนอน */
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
                <img src="images/shower.jpg" class="d-block mx-lg-auto img-fluid" alt="" width="800" height="800" loading="lazy">
            </div>
            <div class="col-lg-6 order-lg-1 text-align-center">
                <h1 id="SLEEPY-PET">บริการอาบน้ำสัตว์ </h1>
                <p class="lead text-dark">บริการอาบน้ำ ที่ร้าน Sleepy Pet เปิดให้บริการทุกวัน เพื่อสิ่งที่ดีที่สุดสำหรับสัตว์เลี้ยง 
                    เราจึงใส่ใจทุกรายละเอียด มีการควบคุมทุกขั้นตอนให้เป็นไปตามมาตรฐานรวมไปถึงอุปกรณ์ เครื่องมือที่มีคุณภาพ 
                    ไม่ว่าจะเป็นแชมพูที่มีสารประกอบจากธรรมชาติ ไม่ก่อให้เกิดอาการแพ้และระคายเคืองต่อผิวหนัง ปลอดสารกันเสีย
                    ทาง ร้าน Sleepy Pet มีการแยกห้องอาบน้ำของน้องสุน้ขและน้องแมว เพื่อให้น้องแมวมีอาการสงบไม่แตกตื่นหรือตกใจในระหว่างการรับบริการ</p>
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
