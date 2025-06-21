          <!-- Header -->
          <header class="main-header" id="header">
            <nav class="navbar navbar-expand-lg navbar-light" id="navbar">
              <!-- Sidebar toggle button -->
              <button id="sidebar-toggler" class="sidebar-toggle">
                <span class="sr-only">Toggle navigation</span>
              </button>

              <span class="page-title">
<?php
$page = basename($_SERVER['PHP_SELF']);
switch ($page) {
    case 'foods.php': echo 'อาหาร'; break;
    case 'homestays.php': echo 'ที่พัก'; break;
    case 'products.php': echo 'สินค้าและของฝาก'; break;
    case 'tours.php': echo 'ทริปท่องเที่ยว'; break;
    case 'work_chedule_guide_admin.php': echo 'จัดการตารางงานไกด์'; break;
    case 'users.php': echo 'ผู้ใช้งาน'; break;
    case 'transactions.php': echo 'รายการจองทั้งหมด'; break;
    case 'commission_settings.php': echo 'ตั้งค่าคอมมิชชัน'; break;
    case 'myprofile_admin.php': echo 'ข้อมูลส่วนตัว'; break;
    case 'index2.php': echo 'Dashboard'; break;
}
?>
                </span>

              <div class="navbar-right ">

                <!-- search form 
                <div class="search-form">
                  <form action="index.html" method="get">
                    <div class="input-group input-group-sm" id="input-group-search">
                      <input type="text" autocomplete="off" name="query" id="search-input" class="form-control" placeholder="Search..." />
                      <div class="input-group-append">
                        <button class="btn" type="button">/</button>
                      </div>
                    </div>
                  </form>
                  <ul class="dropdown-menu dropdown-menu-search">


                  </ul>

                </div>-->

                <ul class="nav navbar-nav">
                  
                  <!-- User Account -->
                  <li class="dropdown user-menu">
                    <button class="dropdown-toggle nav-link" data-toggle="dropdown">
                      <img src="../images/users/<?php echo $_SESSION['bpicture']?>" class="user-image rounded-circle" />
                      <span class="d-none d-lg-inline-block"><?php echo $_SESSION['bfullname']?></span>
                    </button>
                      <?php
                        switch($_SESSION['brole']){
                            case 'guide': $profile_page='myprofile_guide.php'; break;
                            case 'customer': $profile_page='myprofile_customer.php'; break;
                            case 'chef': $profile_page='myprofile_chef.php'; break;
                            case 'seller': $profile_page='myprofile_seller.php'; break;
                            case 'admin': $profile_page='myprofile_admin.php'; break;
                            default: $profile_page='#'; break;
                        }
                      ?>
                    <ul class="dropdown-menu dropdown-menu-right">
                      <li>
                        <a class="dropdown-link-item" href="<?php echo $profile_page ;?>">
                          <i class="mdi mdi-account-outline"></i>
                          <span class="nav-text">My Profile</span>
                        </a>
                      </li>

                      <li class="dropdown-footer">
                        <a class="dropdown-link-item" href="sign-out.php"> <i class="mdi mdi-logout"></i> Log Out </a>
                      </li>
                    </ul>
                  </li>
                </ul>
              </div>
            </nav>

          </header>