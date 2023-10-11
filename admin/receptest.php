<?php
include('config.php');

$sql1 = "SELECT COUNT(id) AS id_zero FROM deposit WHERE status='0'";
$hand1 = mysqli_query($conn, $sql1);
$row1 = mysqli_fetch_array($hand1);

$sql2 = "SELECT COUNT(id) AS id_one FROM deposit WHERE status='1'";
$hand2 = mysqli_query($conn, $sql2);
$row2 = mysqli_fetch_array($hand2);

$sql3 = "SELECT COUNT(id) AS id_two FROM deposit WHERE status='2'";
$hand3 = mysqli_query($conn, $sql3);
$row3 = mysqli_fetch_array($hand3);


?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>Dashboard - SB Admin</title>
        <link href="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/style.min.css" rel="stylesheet" />
        <link href="css/styles.css" rel="stylesheet" />
        <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>
    </head>
    <body class="sb-nav-fixed">
    <?php include 'include/header.php'; ?>
    <?php include 'include/sidebarMenu.php'; ?>
            <div id="layoutSidenav_content">
                <main>
                <div class="container-fluid px-4">
                        <h1 class="mt-4"></h1>
                        <ol class="breadcrumb mb-4">
                            <li class="breadcrumb-item active"></li>
                        </ol>
                        <div class="row justify-content-center text-center">
                            <div class="col-xl-3 col-md-6">
                                <div class="card bg-warning text-white mb-4">
                                    <div class="card-body">รอตรวจสอบชำระเงิน<h4><?=$row1['id_zero']?></h4></div>
                                    <div class="card-footer d-flex align-items-center justify-content-between">
                                        <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-3 col-md-6">
                                <div class="card bg-success text-white mb-4">
                                    <div class="card-body">ชำระเงินแล้ว<h4><?=$row2['id_one']?></h4></div>
                                    <div class="card-footer d-flex align-items-center justify-content-between">
                                        <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-3 col-md-6">
                                <div class="card bg-danger text-white mb-4">
                                    <div class="card-body">ยกเลิกบริการ<h4><?=$row3['id_two']?></h4></div>
                                    <div class="card-footer d-flex align-items-center justify-content-between">
                                        <a class="small text-white stretched-link" href="#"> </a>
                                        <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- <div class="row">
                            <div class="col-xl-6">
                                <div class="card mb-4">
                                    <div class="card-header">
                                        <i class="fas fa-chart-area me-1"></i>
                                        Area Chart Example
                                    </div>
                                    <div class="card-body"><canvas id="myAreaChart" width="100%" height="40"></canvas></div>
                                </div>
                            </div>
                            <div class="col-xl-6">
                                <div class="card mb-4">
                                    <div class="card-header">
                                        <i class="fas fa-chart-bar me-1"></i>
                                        Bar Chart Example
                                    </div>
                                    <div class="card-body"><canvas id="myBarChart" width="100%" height="40"></canvas></div>
                                </div>
                            </div>
                        </div> -->
                        
                <footer class="py-4 bg-light mt-auto">
                    <div class="container-fluid px-4">
                        <div class="d-flex align-items-center justify-content-between small">
                            <div class="text-muted">Copyright &copy; Your Website 2023</div>
                            <div>
                                <a href="#">Privacy Policy</a>
                                &middot;
                                <a href="#">Terms &amp; Conditions</a>
                            </div>
                        </div>
                    </div>
                </footer>
            </div>
        </div>
        <script src="../assets/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script> <!-- เรียกใช้ jQuery -->
<script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script> <!-- เรียกใช้ DataTables -->
<script src="https://cdn.datatables.net/1.11.5/js/dataTables.bootstrap5.min.js"></script> <!-- เรียกใช้ DataTables Bootstrap 5 Integration -->
<script>
$(document).ready(function() {
    $('#datatablesSimple').DataTable({
        // คำสั่งอื่น ๆ ที่คุณต้องการใส่ได้ที่นี่
        autoWidth: false,
    });
});
</script>
<?php mysqli_close($conn); ?>
    </body>
</html>
