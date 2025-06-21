        <!-- ====================================
          ——— LEFT SIDEBAR WITH OUT FOOTER
        ===================================== -->
        <aside class="left-sidebar sidebar-dark" id="left-sidebar">
          <div id="sidebar" class="sidebar sidebar-with-footer">
            <!-- Aplication Brand -->
            <div class="app-brand">
              <a href="index2.php">
                <img src="images/lb.png" alt="Mono" width="32">
                <span class="brand-name">Local Buengkan</span>
              </a>
            </div>
            <!-- begin sidebar scrollbar -->
            <div class="sidebar-left" data-simplebar style="height: 100%;">
              <!-- sidebar menu -->
              <ul class="nav sidebar-inner" id="sidebar-menu">
                
                
                  <li
                   class="active"
                   >
                    <a class="sidenav-item-link" href="index2.php">
                      <i class="mdi mdi-briefcase-account-outline"></i>
                      <span class="nav-text">Dashboard</span>
                    </a>
                  </li>
                                
                  <li class="section-title">
                    จัดการ
                  </li>
                
                  <li class="<?=(basename($_SERVER['PHP_SELF'])=='foods.php')?'active':'';?>">
                    <a class="sidenav-item-link" href="foods.php">
                      <i class="mdi mdi-food-fork-drink"></i>
                      <span class="nav-text">อาหาร</span>
                    </a>
                  </li>
                
                  <li class="<?=(basename($_SERVER['PHP_SELF'])=='homestays.php')?'active':'';?>">
                    <a class="sidenav-item-link" href="homestays.php">
                      <i class="mdi mdi-hotel"></i>
                      <span class="nav-text">ที่พัก</span>
                    </a>
                  </li>
                
                  <li class="<?=(basename($_SERVER['PHP_SELF'])=='products.php')?'active':'';?>">
                    <a class="sidenav-item-link" href="products.php">
                      <i class="mdi mdi-shopping"></i>
                      <span class="nav-text">สินค้าและของฝาก</span>
                    </a>
                  </li>
                
                  <li class="has-sub <?=(basename($_SERVER['PHP_SELF']) == 'tours.php' || basename($_SERVER['PHP_SELF']) == 'work_chedule_guide_admin.php') ? 'active' : '';?>
">
                    <a class="sidenav-item-link" href="tours.php" data-toggle="collapse" data-target="#subguide"
                      aria-expanded="false" aria-controls="subguide">
                      <i class="mdi mdi-map"></i>
                      <span class="nav-text">ทริปท่องเที่ยว</span> <b class="caret"></b>
                    </a>
                        <ul  class="collapse <?=(basename($_SERVER['PHP_SELF']) == 'tours.php' || basename($_SERVER['PHP_SELF']) == 'work_chedule_guide_admin.php') ? 'show' : '';?>
" id="subguide" data-parent="#sidebar-menu">
                      <div class="sub-menu">
                            <li class="<?=(basename($_SERVER['PHP_SELF'])=='tours.php')?'active':'';?>">
                              <a class="sidenav-item-link" href="tours.php">
                                <span class="nav-text">ทริปท่องเที่ยว</span>
                              </a>
                            </li>
                            <li class="<?=(basename($_SERVER['PHP_SELF'])=='work_chedule_guide_admin.php')?'active':'';?>">
                              <a class="sidenav-item-link" href="work_chedule_guide_admin.php">
                                <span class="nav-text">จัดการตารางงานไกด์</span>
                              </a>
                            </li>
                      </div>
                    </ul>

                  </li>
                                
                
                  <li class="<?=(basename($_SERVER['PHP_SELF'])=='users.php')?'active':'';?>">
                    <a class="sidenav-item-link" href="users.php">
                      <i class="mdi mdi-account-group"></i>
                      <span class="nav-text">ผู้ใช้งาน</span>
                    </a>
                  </li>
                                  
                  <li class="<?=(basename($_SERVER['PHP_SELF'])=='transactions.php')?'active':'';?>">
                    <a class="sidenav-item-link" href="transactions.php">
                      <i class="mdi mdi-format-list-bulleted"></i>
                      <span class="nav-text">รายการจองทั้งหมด</span>
                    </a>
                  </li>
                                  
                  <li class="<?=(basename($_SERVER['PHP_SELF'])=='commission_settings.php')?'active':'';?>">
                    <a class="sidenav-item-link" href="commission_settings.php">
                      <i class="mdi mdi-settings"></i>
                      <span class="nav-text">ตั้งค่าคอมมิชชัน</span>
                    </a>
                  </li>
                                  
                            
              </ul>

            </div>

            <div class="sidebar-footer">
              <div class="sidebar-footer-content">
                <ul class="d-flex">
                  <li>
                    <!--<a href="#" title="Settings"><i class="mdi mdi-settings"></i></a></li>-->
                     <a href="myprofile_admin.php" title="ข้อมูลส่วนตัว"><i class="mdi mdi-account"></i></a></li> 
                  <li>
                    <a href="sign-out.php" title="ออกจากระบบ"><i class="mdi mdi-logout"></i></a>
                  </li>
                </ul>
              </div>
            </div>
          </div>
        </aside>

      
