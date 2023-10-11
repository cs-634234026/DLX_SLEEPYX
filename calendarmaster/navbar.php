  
    <header class="p-3 text-bg-dark ">
    <div class="">
      <div class="d-flex flex-wrap align-items-center justify-content-center justify-content-lg-start">
        <a href="/" class="d-flex align-items-center mb-2 mb-lg-0 text-white text-decoration-none">
          <svg class="bi me-10" width="40" height="32" role="img" aria-label="Bootstrap"><use xlink:href="#bootstrap"></use></svg>
        </a>

        <ul class="nav col-12 col-lg-auto me-lg-auto mb-2 justify-content-center mb-md-0">
          <li><a href="index.php" class="nav-link px-3 text-dark btn btn-warning text-dark me-2" >หน้าหลัก</a></li>
          <li><a href="about.php" class="nav-link px-4 text-white" >ติดต่อ</a></li>
          <li><a href="service.php" class="nav-link px-4 text-white">บริการ</a></li>
          <li><a href="status.php" class="nav-link px-4 text-white">ตรวจสอบสถานะ</a></li>
        </ul>
        <div class="text-end">
          <button class="btn btn-outline-warning" type="submit" onclick="window.location.href='login.php'">เข้าสู่ระบบ</button>
          <div class="btn-group">
            <button type="button" class="btn btn-secondary dropdown-toggle" data-bs-toggle="dropdown" data-bs-display="static" aria-expanded="false">
             </button>
            <ul class="dropdown-menu dropdown-menu-lg-end">
              <li><button class="dropdown-item" type="button" onclick="window.location.href='profile.php'">ข้อมูลส่วนตัว</button></li>

                <li><button class="dropdown-item" type="button" onclick="window.location.href='admin/index.php'">Admin-System</button></li>

              <hr>
              <li><button class="dropdown-item" type="button" onclick="window.location.href='logout.php'">ออกจากระบบ</button></li>
            </ul>
          </div>
        
      </div>
    </div>
  </div>
</nav>
