        <!-- ====================================
          ——— LEFT SIDEBAR WITH OUT FOOTER
        ===================================== -->
        <aside class="left-sidebar sidebar-dark" id="left-sidebar">
          <div id="sidebar" class="sidebar sidebar-with-footer">
            <!-- Aplication Brand -->
            <div class="app-brand">
              <a href="home_chef.php">
                <img src="images/lb.png" alt="Mono" width="32">
                <span class="brand-name">Local Buengkan</span>
              </a>
            </div>
            <!-- begin sidebar scrollbar -->
            <div class="sidebar-left" data-simplebar style="height: 100%;">
              <!-- sidebar menu -->
              <ul class="nav sidebar-inner" id="sidebar-menu">

                  <li class="section-title">
                    เมนู
                  </li>
                
                  <li class="<?=(basename($_SERVER['PHP_SELF'])=='home_chef.php')?'active':'';?>">
                    <a class="sidenav-item-link" href="home_chef.php">
                      <i class="mdi mdi-map"></i>
                      <span class="nav-text">เมนูอาหาร</span>
                    </a>
                  </li>
                
                  <li class="<?=(basename($_SERVER['PHP_SELF'])=='work_chedule_chef.php')?'active':'';?>">
                    <a class="sidenav-item-link" href="work_chedule_chef.php">
                      <i class="mdi mdi-table"></i>
                      <span class="nav-text">รายการจอง</span>
                    </a>
                  </li>
                                
                  <li class="<?=(basename($_SERVER['PHP_SELF'])=='active_chef.php')?'active':'';?>">
                    <a class="sidenav-item-link" href="active_chef.php">
                      <i class="mdi mdi-account-convert"></i>
                      <span class="nav-text">สถานะทำงาน</span>
                    </a>
                  </li>
                                
                  <li class="<?=(basename($_SERVER['PHP_SELF'])=='myprofile_chef.php')?'active':'';?>">
                    <a class="sidenav-item-link" href="myprofile_chef.php">
                      <i class="mdi mdi-account-outline"></i>
                      <span class="nav-text">ข้อมูลส่วนตัว</span>
                    </a>
                  </li>
                                
                
              </ul>

            </div>

            <div class="sidebar-footer">
              <div class="sidebar-footer-content">
                <ul class="d-flex">
                  <li>
                    <a href="myprofile_chef.php" data-toggle="tooltip" title="My Profile"><i class="mdi mdi-account-outline"></i></a></li>
                  <li>
                    <a href="sign-out.php" data-toggle="tooltip" title="ออกจากระบบ"><i class="mdi mdi-logout"></i></a>
                  </li>
                </ul>
              </div>
            </div>
          </div>
        </aside>

      
