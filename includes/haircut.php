<style>
    p {
        color: white;
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
            <div class="col-10 col-sm-8 col-lg-6 order-lg-1">
                <img src="images/haircut.jpg" class="d-block mx-lg-auto img-fluid" alt="" width="800" height="800" loading="lazy">
            </div>
            <div class="col-lg-6 order-lg-2 text-align-center">
                <h1 id="SLEEPY-PET">บริการตัดขนสัตว์ </h1>
                <p class="lead text-dark">บริการตัดขน ที่ร้าน Sleepy pet เปิดให้บริการทุกวัน เพื่อสิ่งที่ดีที่สุดสำหรับสัตว์เลี้ยง เราจึงใส่ใจทุกรายละเอียด 
                    มีการควบคุมทุกขั้นตอนให้เป็นไปตามมาตรฐานโรงพยาบาล รวมไปถึงอุปกรณ์ เครื่องมือที่มีคุณภาพ ทางร้านมีความเป็นมืออาชีพในการให้บริการเป็นอย่างมาก 
                    อุปกรณ์ทุกชิ้นผ่านการฆ่าเชื้อมาแล้วอย่างดี มั่นใจได้ว่าน้องหมาน้องแมวปลอดภัย บริการตัดขนยังเนี๊ยบไม่แพ้ใคร ขนเท่ากันเป๊ะ แถมได้ทรงที่ต้องการอย่างแน่นอน 
                    น้องหมาน้องแมวที่มาตัดขนที่นี่แฮปปี้กันถ้วนหน้าไม่ก่อให้เกิดอาการแพ้และระคายเคืองต่อผิวหนัง ทางร้าน Sleepy pet มีการแยกห้องอาบน้ำตัดขนของน้องสุน้ขและน้องแมว 
                    เพื่อให้น้องแมวมีอาการสงบไม่แตกตื่นหรือตกใจในระหว่างการรับบริการ</p>
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
