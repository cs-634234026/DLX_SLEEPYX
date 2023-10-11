<?php
require_once('connect.php');


$sql = "SELECT id , start, end, color , service ,quantity ,time , user_username FROM events ";

$req = $bdd->prepare($sql);
$req->execute();

$events = $req->fetchAll();

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


		<!-- Custom CSS -->
		<style>
			@import url(http://fonts.googleapis.com/css?family=Kanit);
			body {
				font-family: 'Kanit', sans-serif;
				padding-top: 70px;
				/* Required padding for .navbar-fixed-top. Remove if using .navbar-static-top. Change if height of navigation changes. */
			}

			#calendar {
				max-width: 1000px;
				padding-top: 20px;
			}

			.col-centered {
				float: none;
				margin: 0 auto;
			}
			.modal-button {
				margin-top: 20px; 
				margin-left: 20px; 
			}

		</style>

		<!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
		<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
		<!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

	</head>

	<body>
		<!-- Page Content -->
		<div class="container">

			<div class="row">

				<div class="col-lg-12 text-center">
					<h1>ตารางการจองคิว</h1>
					<a href="http://localhost/DLX/status.php" class="btn btn-warning mt-3">แก้ไขข้อมูล</a>
					<a href="http://localhost/DLX/service.php" class="btn btn-danger mt-3">ย้อนกลับ</a>
					<div id="calendar" class="col-centered">
					</div>
				</div>

			</div>
			<!-- /.row -->

			<!-- Modal -->
			<!-- Modal -->
			<div class="modal fade" id="ModalEdit" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
				<div class="modal-dialog" role="document">
					<div class="modal-content">
						<form class="form-horizontal" method="POST" action="editEventTitle.php">
							<div class="modal-header">
								<button type="button" class="close" data-dismiss="modal" aria-label="Close">
									<span aria-hidden="true">&times;</span>
								</button>
								<h4 class="modal-title" id="myModalLabel">ข้อมูลบริการ</h4>
							</div>
							<div class="modal-body">
									
								<div class="form-group">
									<label for="user_username" class="col-sm-2 control-label">ชื่อผู้ใช้</label>
									<div class="col-sm-10">
										<input type="text" name="user_username" class="form-control" id="user_username" placeholder="user_username" readonly>
									</div>
								</div>

								<div class="form-group">
								<label for="title" class="col-sm-2 control-label">บริการ</label>
								<div class="col-sm-10">
									<input type="text" name="service" class="form-control" id="service" readonly>
								</div>
							</div>

							<div class="form-group">
										<label for="quantity" class="col-sm-2 control-label">จำนวนสัตว์</label>
										<div class="col-sm-10">
											<select name="quantity" class="form-control" id="quantity" onchange="updatePrice()" disabled>
												<option value="">เลือก</option>
												<option value="1">1</option>
												<option value="2">2</option>
												<option value="3">3</option>
												<option value="4">4</option>
												<option value="5">5</option>
												<option value="6">6</option>
											</select>
										</div>
									</div>

								<div class="form-group">
									<label for="color" class="col-sm-2 control-label">Color</label>
									<div class="col-sm-10">
										<select name="color" class="form-control" id="color" disabled>
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

								<div class="form-group">
									<label for="start" class="col-sm-2 control-label">วันที่จอง</label>
									<div class="col-sm-10">
										<input type="date" name="start" class="form-control" id="start" readonly>
									</div>
								</div>
							
							<div class="form-group">
									<label for="time" class="col-sm-2 control-label">เวลา</label>
									<div class="col-sm-10">
										<input type="" name="time" class="form-control" id="time" readonly>
									</div>
								</div>
								
								<!-- <div class="form-group">
									<div class="col-sm-offset-2 col-sm-10">
										<div class="checkbox">
											<label class="text-danger">
												<input type="checkbox" name="delete"> Delete event</label>
										</div>
									</div>
								</div> -->

								<input type="hidden" name="id" class="form-control" id="id">


							</div>
							<div class="modal-footer">
								<button type="button" class="btn btn-default" data-dismiss="modal">ปิด</button>
								<!-- <button type="submit" class="btn btn-primary">Save changes</button> -->
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>

		<!-- /.container -->


		<?php date_default_timezone_set("Asia/Bangkok");
	$date = date("Y-m-d");
	?>
		<script>

			$(document).ready(function () {

				$('#calendar').fullCalendar({

					header: {

						left: 'prev,next today',
						center: 'title',
						//right: 'month,basicWeek,basicDay'
						right: 'month,agendaWeek,agendaDay,listMonth'
					},
				
					navLinks: true,
					defaultDate: '<?php echo$date?>',
					minTime: '00:00:00',
					maxTime: '24:00:00',
					editable: false,

					eventLimit: true, // allow "more" link when too many events
					selectable: true,
					selectHelper: true,
					select: function (start, end) {

						$('#ModalAdd #start').val(moment(start).format('YYYY-MM-DD HH:mm:ss'));
						$('#ModalAdd #end').val(moment(end).format('YYYY-MM-DD HH:mm:ss'));
						$('#ModalAdd').modal('show');
					},
					
					eventRender: function (event, element) {
						element.bind('dblclick', function () {
							$('#ModalEdit #id').val(event.id);
							$('#ModalEdit #user_username').val(event.user_username);
							$('#ModalEdit #color').val(event.color).prop('disabled', true);
							$('#ModalEdit #service').val(event.service);
							$('#ModalEdit #quantity').val(event.quantity);
							$('#ModalEdit #time').val(event.time);
							$('#ModalEdit #start').val(event.start.format('YYYY-MM-DD'));
							$('#ModalEdit').modal('show');
						});

						// เพิ่มการแสดงเวลาในรายการอีเวนต์
						var timeDisplay = $('<div class="fc-time" />').text(event.time);
						element.find('.fc-title').append(timeDisplay);
					},

					
					eventDrop: function (event, delta, revertFunc) { // si changement de position

						edit(event);

					},
					eventResize: function (event, dayDelta, minuteDelta, revertFunc) { // si changement de longueur

						edit(event);

					},
					events: [
						<?php foreach ($events as $event) :
        $start = explode(" ", $event['start']);
        $end = explode(" ", $event['end']);
        if ($start[1] == '00:00:00') {
            $start = $start[0];
        } else {
            $start = $event['start'];
        }
        if ($end[1] == '00:00:00') {
            $end = $end[0];
        } else {
            $end = $event['end'];
        }
		 // Convert start and end dates to color
		 $startDate = date('Y-m-d', strtotime($start));
		 $endDate = date('Y-m-d', strtotime($end));
		 $color = $event['color'];
    ?>
					{
			id: '<?php echo $event['id']; ?>',
			user_username:'<?php echo $event['user_username']; ?>',
            start: '<?php echo $start; ?>',
            end: '<?php echo $end; ?>',
            color: '<?php echo $event['color']; ?>',
            time: '<?php echo $event['time']; ?>',
            service: '<?php echo $event['service']; ?>',
            quantity: '<?php echo $event['quantity']; ?>',
					},
					
			<?php endforeach; ?>
			]
			});

			function edit(event) {
				start = event.start.format('YYYY-MM-DD HH:mm:ss');
				if (event.end) {
					end = event.end.format('YYYY-MM-DD HH:mm:ss');
				} else {
					end = start;
				}
				

				id = event.id;

				Event = [];
				Event[0] = id;
				Event[1] = start;
				Event[2] = end;

				$.ajax({
					url: 'editEventDate.php',
					type: "POST",
					data: { Event: Event },
					success: function (rep) {
						if (rep == 'OK') {
							alert('บันทึก');
						} else {
							alert('Could not be saved. try again.');
						}
					}
				});
			}
		
	});

		</script>
		

	</body>

	</html>