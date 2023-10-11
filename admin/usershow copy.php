 <?php
require_once('../connections/mysqli.php');

if ($_SESSION == NULL) {
    header("location:../login.php");
    exit();
} elseif ($_SESSION["user_level"] != "admin") {
    header("location:../index.php");
    exit();
}

if (isset($_GET["add"])) {
    if ($_GET["add"] == "pass") {
        $check_submit = check_submit_p2("บันทึกข้อมูลเรียบร้อยแล้ว");
    }
}
if (isset($_GET["update"])) {
    if ($_GET["update"] == "pass") {
        $check_submit = check_submit_p2("บันทึกข้อมูลเรียบร้อยแล้ว");
    }
}
if (isset($_GET["delete"])) {
    if ($_GET["delete"] == "pass") {
        $check_submit = check_submit_p2("ลบข้อมูลออกจากระบบเรียบร้อยแล้ว");
    }
}

$num = 1;

$sql = "SELECT * FROM tb_user WHERE user_level = 'member' ORDER BY user_level ASC";
$query = mysqli_query($Connection, $sql);
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="../assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="../assets/icons/bootstrap-icons.css">
    <link rel="stylesheet" href="assets/dashboard.css">
    <title>ระบบหลังบ้าน</title>
</head>
<body>
<?php include 'include/header.php'; ?>
<canvas id="myChart">
<div class="container-fluid">
    <div class="row">
        <?php include 'include/sidebarMenu.php'; ?>
        <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
            <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
                <h1 class="h2">ข้อมูลผู้ใช้งาน</h1>
                <div class="btn-toolbar mb-2 mb-md-0">
                    <!-- เพิ่มข้อมูล -->
                    <button type="button" class="btn btn-secondary" data-bs-toggle="modal"
                            data-bs-target="#add_data">เพิ่มข้อมูล
                    </button>
                    <div class="modal fade" id="add_data" tabindex="-1" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
                            <form class="modal-content" method="post" action="user_add_data.php">
                                <div class="modal-header">
                                    <h5 class="modal-title">เพิ่มข้อมูลผู้ใช้งาน</h5>
                                </div>
                                <div class="modal-body">
                                    <div class="mb-3">
                                        <label class="form-label">ชื่อผู้ใช้</label>
                                        <input type="text" class="form-control" name="user_username" required/>
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label">รหัสผ่าน</label>
                                        <input type="password" class="form-control" name="user_password" required/>
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label">ชื่อ</label>
                                        <input type="text" class="form-control" name="user_name" required/>
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label">นามสกุล</label>
                                        <input type="text" class="form-control" name="user_surname" required/>
                                    </div>

                                    <div class="mb-3">
                                        <label class="form-label">เบอร์</label>
                                        <input type="number" class="form-control" name="user_phone" required/>
                                    </div>

                                    <div class="mb-3">
                                        <label class="form-label">อีเมล์</label>
                                        <input type="email" class="form-control" name="user_email"/>
                                    </div>
                                    <div>
                                        <label class="form-label">ระดับผู้ใช้</label>
                                        <select class="form-select" name="user_level">
                                            <option value="member">สมาชิก</option>
                                            <option value="admin">ผู้ดูแลระบบ</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">ยกเลิก
                                    </button>
                                    <button type="submit" class="btn btn-primary">บันทึกข้อมูล</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <?php echo $check_submit; ?>
            <div class="card mb-4 text-dark">
                <div class="card-header">
                    <i class="fas fa-table me-5 text-dark"></i>
                    แสดงข้อมูลผู้ใช้งาน
                </div>
                <div class="card-body line-2">
                    <div class="table-responsive">
                        <table class="table table-bordered" id="datatablesSimple">
                            <thead>
                            <tr>
                                <th>ลำดับที่</th>
                                <th>ชื่อผู้ใช้</th>
                            
                                <th>ขื่อ</th>
                                <th>นามสกุล</th>
                                <th>เบอร์</th>
                                <th>อีเมล์</th>
                                <th>ระดับผู้ใช้</th>
                                <th>ตัวเลือก</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php
                            while ($result = mysqli_fetch_array($query)) {
                                ?>
                                <tr>
                                    <td><?php echo $num++; ?></td>
                                    <td><?php echo $result['user_username']; ?></td>


                                    <td><?php echo $result['user_name']; ?></td>
                                    <td><?php echo $result['user_surname']; ?></td>
                                    <td><?php echo $result['user_phone']; ?></td>
                                    <td><?php echo $result['user_email']; ?></td>
                                    <td><?php if ($result['user_level'] == "member") {
                                            echo "สมาชิก";
                                        } else {
                                            echo "ผู้ดูแลระบบ";
                                        } ?></td>
                                    <td>
                                        <!-- ปุ่มแก้ไข -->
                                        <button type="button" class="btn btn-success btn-sm"
                                                onclick="window.location.href='user_edit.php?id=<?php echo $result['user_id']; ?>'">
                                            <i class="bi bi-pencil-square"></i>
                                        </button>
                                        <!-- ลบข้อมูล-->
                                        <button type="button" class="btn btn-danger btn-sm" data-bs-toggle="modal"
                                                data-bs-target="#delete_data<?php echo $result['user_id']; ?>">
                                            <i class="bi bi-trash"></i>
                                        </button>
                                        <div class="modal fade" id="delete_data<?php echo $result['user_id']; ?>"
                                             tabindex="-1" aria-hidden="true">
                                            <div class="modal-dialog modal-dialog-centered">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title">ลบข้อมูล</h5>
                                                    </div>
                                                    <div class="modal-body">
                                                        กดยืนยันหากคุณต้องการลบผู้ใช้ <?php echo $result['user_username']; ?>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary"
                                                                data-bs-dismiss="modal">ยกเลิก
                                                        </button>
                                                        <button type="button" class="btn btn-primary"
                                                                onclick="window.location.href='user_delete.php?id=<?php echo $result['user_id']; ?>'">ยืนยัน
                                                        </button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                                <?php
                            }
                            ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </main>
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


<?php mysqli_close($Connection); ?>
</body>
</html>
