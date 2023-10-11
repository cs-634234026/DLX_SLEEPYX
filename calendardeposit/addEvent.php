<?php
session_start();
require_once('connect.php');
if (!$_SESSION) {
    header("location:../login.php");
    exit();
}
//echo $_POST['title'];
if (isset($_POST['start']) && isset($_POST['end']) && isset($_POST['color']) && isset($_POST['service'])
&& isset($_POST['quantity'])&& isset($_POST['price'])&& isset($_POST['time'])&& isset($_POST['description'])){
	
	$productid = $_POST['productid'];
	$start = $_POST['start'];
	$end = $_POST['end'];
	$color = $_POST['color'];
	$service = $_POST['service'];
	$price = $_POST['price'];
	$quantity = $_POST['quantity'];
	$time = $_POST['time'];
	$description = $_POST['description'];
	$status = '0';
	$animal = $_POST['animal'];
	$room = $_POST['room'];
	$user_id = $_SESSION['user_id'];
	$user_username = $_SESSION['user_username'];
	$user_name = $_SESSION['user_name'];
	$user_phone = $_SESSION['user_phone'];
	$user_email = $_SESSION['user_email'];

	 // Upload the file
	 $target_dir = "";
	 $target_file = $target_dir . basename($_FILES["image"]["name"]);
	 move_uploaded_file($_FILES["image"]["tmp_name"], $target_file);
	
	$sql = "INSERT INTO deposit (start, end, color, service, quantity, price, time, description, status, user_id, user_username,animal,room ,productid ,image,user_name , user_phone , user_email) 
	VALUES ('$start', '$end', '$color', '$service', '$quantity', '$price', '$time', '$description', '$status', '$user_id', '$user_username', '$animal', '$room', '$productid', '$target_file' ,'$user_name', '$user_phone', '$user_email')";

 // ตรวจสอบคิวซ้ำโดยเช็คในฐานข้อมูล
 $sql_check = "SELECT COUNT(*) FROM deposit WHERE room = :room AND start >= :start AND end <= :end AND productid = $productid";
 $stmt_check = $bdd->prepare($sql_check);
 $stmt_check->bindParam(':room', $room, PDO::PARAM_STR);
 $stmt_check->bindParam(':start', $start, PDO::PARAM_STR);
 $stmt_check->bindParam(':end', $end, PDO::PARAM_STR);
 $stmt_check->execute();
 $count = $stmt_check->fetchColumn();

if ($count > 0) {
	// ถ้ามีคิวซ้ำในเวลาที่ระบุ
	echo '<script>alert("มีคิวห้องซ้ำที่เลือกกรุณาเลือกห้องอื่น"); window.location.href = "addEvent.php?product_id=' . $_POST['productid'] . '";</script>';
} else {
	
	$query = $bdd->prepare( $sql );
	if ($query == false) {
	 print_r($bdd->errorInfo());
	 die ('Erreur prepare');
	}
	$sth = $query->execute();
	if ($sth == false) {
	 print_r($query->errorInfo());
	 die ('Erreur execute');
	}
	// เมื่อข้อมูลเพิ่มสำเร็จ ให้เปลี่ยนเส้นทางไปยังหน้า status.php
	header("Location: http://localhost/DLX/status.php");
	exit(); // จบการทำงานของสคริปต์
}
}

	
?>
	<!DOCTYPE html>
	<html lang="en">

	<head>

		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<meta name="description" content="">
		<meta name="author" content="">

		<title>Full calendar PHP</title>

		<!-- Bootstrap Core CSS -->
		<link href="css/bootstrap.min.css" rel="stylesheet">

		<!-- FullCalendar -->
		<link href='lib/fullcalendar.min.css' rel='stylesheet' />

		<script src='/lib/jquery.min.js'></script>
		<!-- jQuery Version 1.11.1 -->
		<script src="js/jquery.js"></script>

		<!-- Bootstrap Core JavaScript -->
		<script src="js/bootstrap.min.js"></script>

		<!-- FullCalendar -->
		<script src='lib/moment.min.js'></script>
		<script src='lib/fullcalendar.min.js'></script>
		<link rel="stylesheet" type="text/css" href="animated-background.css">

		<!-- Custom CSS -->
		<style>
			@import url(http://fonts.googleapis.com/css?family=Kanit);
			body {
				font-family: 'Kanit', sans-serif;
				padding-top: 70px;
				background-color: #ADD8E6;
				/* Required padding for .navbar-fixed-top. Remove if using .navbar-static-top. Change if height of navigation changes. */
			}
			h1 {
            color: #000000; /* เปลี่ยนสีตัวอักษรเป็นสีขาว */
        }
		</style>

		<!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
		<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
		<!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

	</head>
 <br>
	<body>
		<!-- Page Content -->
		<div class="container ">

			<div class="row">

				<div class="col-lg-12 text-center" >
					<h1>แบบฟอร์มกรอกข้อมูล</h1>
					<a href="http://localhost/DLX/status.php" class="btn btn-warning mt-3">แก้ไขข้อมูล</a>
					<a href="http://localhost/DLX/service.php" class="btn btn-danger mt-3">ย้อนกลับ</a>
					<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
					<div class="modal-dialog" role="document">
						<div class="modal-content">
						<!-- ส่วนเนื้อหาของโมดัล -->
						<div class="modal-header">
							<button type="button" class="close" data-dismiss="modal" aria-label="Close">
							<span aria-hidden="true">&times;</span>
							</button>
							<h4 class="modal-title" id="myModalLabel">เลขบัญชีธนาคาร</h4>
							<div class="modal-body" style="font-size: 18px;">
                                    <p> ธนาคารออมสิน ; 2025412688461515</p>
                                    <p> นายธีรภัทร ตันเก็ง ( กรุณาตรวจสอบชื่อก่อนโอน )</p>
                                   <img src="images\payment.png">
                                </div>
						</div>
						<div class="modal-body">
							<!-- เนื้อหาที่คุณต้องการแสดงในโมดัล -->
						</div>
						<div class="modal-footer">
							<button type="button" class="btn btn-default" data-dismiss="modal">ปิด</button>
						</div>
						</div>
					</div>
					</div>
					<div id="calendar" class="col-centered">
					</div>
				</div>

			</div>
			<!-- /.row -->

			<!-- Modal -->
			<?php
								require_once('connect.php');
								if (isset($_POST['productid']) || isset($_GET['product_id'])) {
									if(isset($_POST['productid']) && !empty($_POST['productid'])) {
										$id = $_POST['productid'];
									} else {
										$id = isset($_GET['product_id']) ? $_GET['product_id'] : null;
									}
									$sql = "SELECT * FROM tb_servicedeposit WHERE id = :id";
									$stmt = $bdd->prepare($sql);
									$stmt->bindParam(':id', $id, PDO::PARAM_INT);
									$stmt->execute();
									$row = $stmt->fetch(PDO::FETCH_ASSOC);
									if ($row) {
							?>

						<div class="modal-content " style="margin-top: 40px;">
							<form class="form-horizontal" method="POST" action="addEvent.php" enctype="multipart/form-data">
							<input type="hidden" name="id" value="<?php  echo $row['id'];?>">
								<div class="modal-header">
									<button type="button" class="close" data-dismiss="modal" aria-label="Close">
										<span aria-hidden="true">&times;</span>
									</button>
									<h4 class="modal-title" id="myModalLabel">กรุณากรอกข้อมูล</h4>
								</div>

								<div class="modal-body">
									<div class="form-group">
										<label for="title" class="col-sm-2 control-label">บริการ </label>
										<div class="col-sm-10">
											<input type="disable" class="form-control" id="service" name="service" value="<?=$row['service']?>" readonly>
											<input type="hidden" class="form-control" id="product" name="productid" value="<?=$id?>" readonly>
										</div>
									</div>

									<div class="form-group">
										<label for="animal" class="col-sm-2 control-label">ประเภทสัตว์</label>
										<div class="col-sm-10">
											<select name="animal" class="form-control" id="animal" required>
												<option value="หมา">หมา</option>
												<option value="แมว">แมว</option>
											</select>
										</div>
									</div>

									<div class="form-group">
										<label for="animal" class="col-sm-2 control-label">ห้อง</label>
										<div class="col-sm-10">
											<select name="room" class="form-control" id="room" required>
												<option value="room 1">room 1</option>
												<option value="room 2">room 2</option>
												<option value="room 3">room 3</option>
												<option value="room 4">room 4</option>
												<option value="room 5">room 5</option>
												<option value="room 6">room 6</option>
												<option value="room 7">room 7</option>
												<option value="room 8">room 8</option>
												<option value="room 9">room 9</option>
												<option value="room 10">room 10</option>
											</select>
										</div>
									</div>

									<div class="form-group">
										<label for="quantity" class="col-sm-2 control-label">จำนวนสัตว์</label>
										<div class="col-sm-10">
											<input name="quantity" class="form-control" id="quantity" value="1" readonly>
										</div>
									</div>

									<div class="form-group">
										<label for="description" class="col-sm-2 control-label" >รายละเอียดเพิ่มเติม</label>
										<div class="col-sm-10">
											<textarea type="text" name="description" class="form-control" id="description" rows="3" placeholder="กรุณากรอกที่ข้อมูลสัตว์" required></textarea>
										</div>
									</div>

									<div class="form-group">
										<label for="start" class="col-sm-2 control-label">วันที่เริ่มใช้บริการ</label>
										<div class="col-sm-10">
										<input type="date" name="start" class="form-control" id="start" min="<?php echo date('Y-m-d'); ?>" onchange="updatePrice()" required>
										</div>
										</div>

										<div class="form-group">
										<label for="end" class="col-sm-2 control-label">วันที่สิ้นสุดการใช้บริการ</label>
										<div class="col-sm-10">
										<input type="date" name="end" class="form-control" id="end" onchange="updatePrice()" required >
										</div>
										</div>


										<div class="form-group">
										<label for="price" class="col-sm-2 control-label">ราคา</label>
										<div class="col-sm-10">
											<input type="text" class="form-control" id="price" name="price" value="300"readonly>
										</div>
									</div>





											<script>
										document.addEventListener("DOMContentLoaded", function() {
											var startDateInput = document.getElementById("start");
											var endDateInput = document.getElementById("end");

											startDateInput.addEventListener("change", function() {
												endDateInput.value = this.value;
											});
										});
										</script>

									 <div class="form-group">
									<label for="color" class="col-sm-2 control-label">เวลา</label>
									<div class="col-sm-10">
										<select name="time" class="form-control" id="time">
	                                    <option value="9.00-10.00">9.00-10.00</option>
										<option value="10.00-11.00">10.00-11.00</option>
										<option value="11.00-12.00">11.00-12.00</option>
										<option value="13.00-14.00">13.00-14.00</option>
										<option value="14.00-15.00">14.00-15.00</option>
										<option value="15.00-16.00">15.00-16.00</option>
										<option value="16.00-17.00">16.00-17.00</option>
										</select>
									</div>
								</div>

									<div class="form-group">
										<label for="color" class="col-sm-2 control-label">เลือกสีปฎิทิน</label>
										<div class="col-sm-10">
											<select name="color" class="form-control" id="color">
												<option value="">เลือก</option>
												<option style="color:#0071c5;" value="#0071c5">&#9724; สีน้ำเงิน</option>
												<option style="color:#008000;" value="#008000">&#9724; สีเขียว</option>
												<option style="color:#FFD700;" value="#FFD700">&#9724; สีเหลือง</option>
												<option style="color:#FF8C00;" value="#FF8C00">&#9724; สีส้ม</option>
												<option style="color:#FF0000;" value="#FF0000">&#9724; สีแดง</option>
												<option style="color:#000;" value="#000">&#9724; สีดำ</option>
											</select>
										</div>
									</div>

									<!-- <div class="form-group">
										<label for="" class="col-sm-2 control-label">เลขบัญชีที่ต้องชำระ</label>
										<div class="col-sm-10">
										<input name="" class="form-control" id="" value="กรุงไทย 2563458715 นายธีรภัทร ตันเก็ง" readonly>
										</div>
									</div> -->

									<div class="form-group">
										<label for="image" class="col-sm-2 control-label">แนปสลิปโอนเงิน</label>
										<div class="col-sm-10">
										<input type="file" class="form-control" id="image" name="image" accept=".jpg, .jpeg, .png" onchange="checkUpload()" required>
										<br>
										<button type="button" class="btn btn-danger" data-toggle="modal" data-target="#myModal">คลิกเพื่อดูเลขบัญชี</button>
									</div>
									</div>
									
								</div>

								<div class="modal-footer">
									<button type="submit" class="btn btn-success">ยืนยันการใช้บริการ</button>
								</div>
							</form>
							<?php
							} 
						}
						?>
					</div>

				</div>
			</div>

			<script>
				// เมื่อแบบฟอร์มถูกส่ง
				$('form').on('submit', function() {
					// แสดง confirm dialog
					const isConfirmed = confirm('คุณต้องการที่จะเพิ่มเหตุการณ์ในปฎิทินหรือไม่?');
					
					// ถ้าผู้ใช้กด OK ใน confirm dialog
					if (isConfirmed) {
						// ไม่ต้องทำอะไร เป็นการยอมรับการเพิ่มเหตุการณ์
					} else {
						// ยกเลิกการส่งแบบฟอร์ม
						event.preventDefault();
					}
				});
			</script>

			<script>
				function updatePrice() {
					var startDate = document.getElementById("start").value;
					var endDate = document.getElementById("end").value;
					var pricePerDay = 300; // ราคาต่อวัน

					// ตรวจสอบว่า startDate และ endDate มีค่าที่ถูกต้อง
					if (startDate && endDate) {
						// สร้างวัตถุ Date จาก startDate และ endDate
						var start = new Date(startDate);
						var end = new Date(endDate);

						// คำนวณจำนวนวันระหว่างวันที่เริ่มและสิ้นสุด
						var timeDiff = end - start;
						var daysDiff = Math.ceil(timeDiff / (1000 * 3600 * 24));

						// ตรวจสอบว่า daysDiff มีค่ามากกว่าหรือเท่ากับ 0 หรือไม่
						if (daysDiff >= 0) {
							// คำนวณราคารวม
							var totalPrice = pricePerDay * (daysDiff + 1); // รวมวันที่เริ่มด้วย

							// แสดงราคาในฟิลด์ราคา
							document.getElementById("price").value = totalPrice;
						}
					}
				}


			</script>
ิ<br><br><br>
	</body>
	</html>
