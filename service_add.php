<?php
require_once('connections/mysqli.php');
if (!$_SESSION) {
    header("location:login.php");
    exit();
  }

?>
<!DOCTYPE html>
<html lang="en ">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title><?php echo $title; ?></title>
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/icons/bootstrap-icons.css">
    <link rel="stylesheet" href="style.css">
    <script src="assets/js/bootstrap.bundle.min.js"></script>
    <style>
        @import url(http://fonts.googleapis.com/css?family=Kanit);

        body {
            font-family: 'Kanit', sans-serif;
        }
    </style>
</head>
<?php include 'includes/navbar.php'; ?>

<body>
    <main class=" ">
        <div class="">
            <h1 class="h2"></h1><br><br>
            <div class="btn-toolbar mb-2 mb-md-0">
            </div>
        </div>
        <div class="row justify-content-md-center">
            <div class="col-6">
                <div class="card">
                    <?php
                    require_once('connections/mysqli.php');
                    if (isset($_POST['productid'])) {
                        $id = $_POST['productid'];
                        $sql = "SELECT * FROM tb_service WHERE id =$id";
                        $result = mysqli_query($Connection, $sql);
                        while ($row = mysqli_fetch_array($result)) {
                            echo $row['id'];
                        ?>
                    <h5 class="card-header text-dark">กรุณากรอกข้อมูล</h5>
                    <div class="card-body">
                        <form method="post" action="service_add_db.php" >
                            <input type="hidden" name="id" value="<?php  echo $row['id'];?>">

                            <div class="mb-3">
                                <label for="service" class="form-label text-dark">บริการ</label>
                                <input type="disable" class="form-control" id="service" name="service" value="<?=$row['service']?>" readonly>
                            </div>

                            <div class="mb-3">
                                <label class="form-label text-dark">จำนวน ( ตัว )</label>
                                <select class="form-select" name="quantity" id="quantity-select">
                                    <option value="1">1</option>
                                    <option value="2">2</option>
                                    <option value="3">3</option>
                                    <option value="4">4</option>
                                    <option value="5">5</option>
                                    <option value="6">6</option>
                                    <option value="7">7</option>
                                    <option value="8">8</option>
                                    <option value="9">9</option>
                                    <option value="10">10</option>
                                </select>
                            </div>

                            <div class="mb-3">
                                <label class="form-label text-dark">ราคา ( บาท )</label>
                                <input type="text" class="form-control" name="price" id="price-input" value="300"required />
                            </div>

                            
                            <div class="mb-3">
                        <label for="description" class="form-label text-dark">รายละเอียดเพิ่มเติม</label>
                         <textarea class="form-control" id="description" name="description" rows="3" required></textarea>
                        </div>
                            <!-- <div class="mb-3">
                                <label class="form-label text-dark">สถานะบริการ</label>
                                <select class="form-select" name="status" onchange="checkTimeAvailability(this)">
                                    <option value="เปิด">เปิด</option>
                                    <option value="ปิด">ปิด</option>
                                    <option value="เต็ม">เต็ม</option>
                                </select>
                            </div> -->

                            <div class="mb-3">
                                <label class="form-label text-dark">วันที่ฝาก</label>
                                <input type="date" class="form-control" name="start" required>
                            </div>

                            <div class="mb-3">
                                <label class="form-label text-dark">วันที่รับกลับ</label>
                                <input type="date" class="form-control" name="end" required>
                            </div>

                            <div class="mb-3">
                                <label class="form-label text-dark">เวลา</label>
                                <select class="form-select" name="time" onchange="checkTimeAvailability(this)">
                                    <option value="9.00 10.00">9.00-10.00</option>
                                    <option value="10.00 11.00">10.00-11.00</option>
                                    <option value="11.00">11.00-12.00</option>
                                    <option value="13.00">13.00-14.00</option>
                                    <option value="14.00">14.00-15.00</option>
                                    <option value="15.00">15.00-16.00</option>
                                    <option value="16.00">16.00-17.00</option>
                                </select>
                            </div>

                            <div class="form-group">
									<label for="color" class="col-sm-2 control-label text-dark">Color</label>
									<div class="col-sm-10">
										<select name="color" class="form-control" id="color">
											<option value="">Choose</option>
											<option style="color:#0071c5;" value="#0071c5">&#9724; Dark blue</option>
											<option style="color:#40E0D0;" value="#40E0D0">&#9724; Turquoise</option>
											<option style="color:#008000;" value="#008000">&#9724; Green</option>
											<option style="color:#FFD700;" value="#FFD700">&#9724; Yellow</option>
											<option style="color:#FF8C00;" value="#FF8C00">&#9724; Orange</option>
											<option style="color:#FF0000;" value="#FF0000">&#9724; Red</option>
											<option style="color:#000;" value="#000">&#9724; Black</option>

										</select>
									</div>
								</div>


                            <!-- <div class="mb-3">
                                <label class="form-label text-dark">รูปภาพ</label>
                                <input type="file" class="form-control" name="image" id="image" accept=".jpg, .jpeg, .png" value="" />
                            </div> -->

                            <!-- <div class="mb-3">
                      <label class="form-label">รูปภาพ</label>
                      <input type="file" class="form-control" name="image" id="image" accept=".jpg, .jpeg, .png" value="" />
                    </div> -->

                            <!-- <div class="mb-3">
                                <label for="description" class="form-label">รายละเอียดบริการ</label>
                                <textarea class="form-control" id="description" name="description" rows="3" required></textarea>
                            </div> -->
                            <br>
                            <button type="submit" name="submit" class="btn btn-primary">บันทึก</button>
                            <button type="button" class="btn btn-secondary" onclick="window.location.href='service.php'">ย้อนกลับ</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <?php
        } 
        }
    ?>
    </main>
    </div>
    </div>
    <script src="../assets/js/bootstrap.bundle.min.js"></script>


    <?php mysqli_close($Connection); ?>

    <script>
        // ค้นหา element ของ select และ input
        const quantitySelect = document.getElementById('quantity-select');
        const priceInput = document.getElementById('price-input');

        const basePrice = 300; // ราคาเริ่มต้น

        // เพิ่มเหตุการณ์เมื่อมีการเปลี่ยนแปลงใน select
        quantitySelect.addEventListener('change', function() {
            const selectedQuantity = parseInt(quantitySelect.value); // ค่าจำนวนที่เลือก

            const totalPrice = selectedQuantity * basePrice; // คำนวณราคารวม

            priceInput.value = totalPrice; // กำหนดค่าราคาให้กับ input
        });
    </script>


    <script>
        function checkTimeAvailability(selectElement) {
            const selectedTime = selectElement.value;
            const selectOptions = selectElement.getElementsByTagName('option');

            // ตรวจสอบตัวเลือกทั้งหมด
            for (let i = 0; i < selectOptions.length; i++) {
                const option = selectOptions[i];
                if (option.value !== selectedTime) {
                    option.disabled = false; // เปิดใช้งานตัวเลือกที่ไม่ซ้ำกัน
                } else {
                    option.disabled = true; // ปิดใช้งานตัวเลือกที่ซ้ำกัน
                }
            }
        }
    </script>

</body>
<br><br><br><br>
<?php include 'includes/footer.php'; ?>

</html>