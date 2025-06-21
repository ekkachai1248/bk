<?php
include_once("checklogin.php");
?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
  <meta charset="utf-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />

  <title>Local buengkan - Admin</title>
    
  <!-- theme meta -->
  <meta name="theme-name" content="mono" />

  <!-- GOOGLE FONTS -->
  <link href="https://fonts.googleapis.com/css?family=Prompt&family=Karla:400,700|Roboto" rel="stylesheet">
  <link href="plugins/material/css/materialdesignicons.min.css" rel="stylesheet" />
  <link href="plugins/simplebar/simplebar.css" rel="stylesheet" />

  <!-- PLUGINS CSS STYLE -->
  <link href="plugins/nprogress/nprogress.css" rel="stylesheet" />
  <link href="plugins/DataTables/DataTables-1.10.18/css/jquery.dataTables.min.css" rel="stylesheet" />
  <link href="plugins/jvectormap/jquery-jvectormap-2.0.3.css" rel="stylesheet" />
  <link href="plugins/daterangepicker/daterangepicker.css" rel="stylesheet" />
  <link href="https://cdn.quilljs.com/1.3.6/quill.snow.css" rel="stylesheet">
  <link href="plugins/toaster/toastr.min.css" rel="stylesheet" />
  
  <!-- MONO CSS -->
  <link id="main-css-href" rel="stylesheet" href="css/style.css" />

  <!-- FAVICON -->
  <link href="images/favicon.png" rel="shortcut icon" />

  <script src="plugins/nprogress/nprogress.js"></script>
      
<style>
    body{
        font-family: "Prompt", serif;
    }      
</style>
</head>


  <body class="navbar-fixed sidebar-fixed" id="body">
    <script>
      NProgress.configure({ showSpinner: false });
      NProgress.start();
    </script>
    

    <!-- ====================================
    ——— WRAPPER
    ===================================== -->
    <div class="wrapper">
      
<?php include("left-sidebar.php"); ?>
        
      <!-- ====================================
      ——— PAGE WRAPPER
      ===================================== -->
      <div class="page-wrapper">
        
<?php include("header.php"); ?>
          
        <!-- ====================================
        ——— CONTENT WRAPPER
        ===================================== -->
        <div class="content-wrapper">
          <div class="content">      
              
              
<div class="row">
  <div class="col-lg-6 col-xl-3">
    <div class="card mb-4">
        <a href="foods.php">
      <img class="card-img-top" src="../images/banner-04.jpg">
        </a>
      <div class="card-body">
        <h5 class="card-title ">อาหาร</h5>
        <p class="card-text pb-3" style="font-size: 13px">อาหารพื้นถิ่นร่วมสมัย</p>
        <a href="foods.php" class="btn btn-outline-primary btn-pill btn-block">จัดการ</a>
      </div>
    </div>
  </div>

  <div class="col-lg-6 col-xl-3">
    <div class="card mb-4">
        <a href="homestays.php">
      <img class="card-img-top" src="../images/banner-11.jpg">
        </a>
      <div class="card-body">
        <h5 class="card-title ">ที่พัก</h5>
        <p class="card-text pb-3" style="font-size: 13px">ที่พักโฮมสเตย์</p>
        <a href="homestays.php" class="btn btn-outline-primary btn-pill btn-block">จัดการ</a>
      </div>
    </div>
  </div>

  <div class="col-lg-6 col-xl-3">
    <div class="card mb-4">
        <a href="products.php">
      <img class="card-img-top" src="../images/banner-07.jpg">
        </a>
      <div class="card-body">
        <h5 class="card-title ">สินค้าและของฝาก</h5>
        <p class="card-text pb-3" style="font-size: 13px">สินค้าและของฝากจากชุมชน</p>
        <a href="products.php" class="btn btn-outline-primary btn-pill btn-block">จัดการ</a>
      </div>
    </div>
  </div>

  <div class="col-lg-6 col-xl-3">
    <div class="card mb-4">
        <a href="tours.php">
      <img class="card-img-top" src="../images/banner-10.jpg">
        </a>
      <div class="card-body">
        <h5 class="card-title ">ทริปท่องเที่ยว</h5>
        <p class="card-text pb-3" style="font-size: 13px">ท่องเที่ยววิถีชุมชน</p>
        <a href="tours.php" class="btn btn-outline-primary btn-pill btn-block">จัดการ</a>
      </div>
    </div>
  </div>

  <div class="col-lg-6 col-xl-3">
    <div class="card mb-4">
        <a href="work_chedule_guide_admin.php">
      <img class="card-img-top" src="../images/banner-13.jpg">
        </a>
      <div class="card-body">
        <h5 class="card-title ">ตารางงานไกด์</h5>
        <p class="card-text pb-3" style="font-size: 13px">จัดการตารางงานไกด์ชุมชน</p>
        <a href="work_chedule_guide_admin.php" class="btn btn-outline-primary btn-pill btn-block">จัดการ</a>
      </div>
    </div>
  </div>

  <div class="col-lg-6 col-xl-3">
    <div class="card mb-4">
        <a href="users.php">
      <img class="card-img-top" src="../images/banner-05.jpg">
        </a>
      <div class="card-body">
        <h5 class="card-title ">ผู้ใช้งาน</h5>
        <p class="card-text pb-3" style="font-size: 13px">ผู้ใช้งานระบบทุกกลุ่ม</p>
        <a href="users.php" class="btn btn-outline-primary btn-pill btn-block">จัดการ</a>
      </div>
    </div>
  </div>

  <div class="col-lg-6 col-xl-3">
    <div class="card mb-4">
        <a href="transactions.php">
      <img class="card-img-top" src="../images/banner-08.jpg">
        </a>
      <div class="card-body">
        <h5 class="card-title ">รายการจองทั้งหมด</h5>
        <p class="card-text pb-3" style="font-size: 13px">จัดการรายการจองจากลูกค้า</p>
        <a href="transactions.php" class="btn btn-outline-primary btn-pill btn-block">จัดการ</a>
      </div>
    </div>
  </div>  
    
  <div class="col-lg-6 col-xl-3">
    <div class="card mb-4">
        <a href="myprofile_admin.php">
      <img class="card-img-top" src="../images/banner-14.jpg">
        </a>
      <div class="card-body">
        <h5 class="card-title ">My Profile</h5>
        <p class="card-text pb-3" style="font-size: 13px">จัดการข้อมูลส่วนตัว</p>
        <a href="myprofile_admin.php" class="btn btn-outline-primary btn-pill btn-block">จัดการ</a>
      </div>
    </div>
  </div>

</div>              
              
              
                  <!-- Top Statistics -->
                  <div class="row mt-6 mb-0">
                    <div class="col-xl-3 col-sm-6">
                      <div class="card card-default card-mini">
                        <div class="card-header">
                          <h2>฿ <span id="food_income" class="text-success"></span></h2>
                          <div>
                            <i class="mdi mdi-food-fork-drink"></i>
                          </div>
                          <div class="sub-title">
                            <span class="mr-1">ยอดขายอาหารทั้งหมด</span>
                          </div>
                        </div>
                        <div class="card-body">
                          <div class="chart-wrapper">
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="col-xl-3 col-sm-6">
                      <div class="card card-default card-mini">
                        <div class="card-header">
                          <h2>฿ <span id="homestay_income" class="text-success"></span></h2>
                          <div>
                            <i class="mdi mdi-hotel"></i>
                          </div>
                          <div class="sub-title">
                            <span class="mr-1">ยอดขายที่พักทั้งหมด</span>
                          </div>
                        </div>
                        <div class="card-body">
                          <div class="chart-wrapper">
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="col-xl-3 col-sm-6">
                      <div class="card card-default card-mini">
                        <div class="card-header">
                          <h2>฿ <span id="product_income" class="text-success"></span></h2>
                          <div class="dropdown">
                            <i class="mdi mdi-shopping"></i>
                          </div>
                          <div class="sub-title">
                            <span class="mr-1">ยอดขายสินค้าและของฝากทั้งหมด</span>
                          </div>
                        </div>
                        <div class="card-body">
                          <div class="chart-wrapper">
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="col-xl-3 col-sm-6">
                      <div class="card card-default card-mini">
                        <div class="card-header">
                          <h2>฿ <span id="tour_income" class="text-success"></span></h2>
                          <div class="dropdown">
                            <i class="mdi mdi-map"></i>
                          </div>
                          <div class="sub-title">
                            <span class="mr-1">ยอดขายทริปท่องเที่ยวทั้งหมด</span>
                          </div>
                        </div>
                        <div class="card-body">
                          <div class="chart-wrapper">
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>


                <div class="row mt-0">
                  <div class="col-xl-8">
                    
                    <!-- Income and Express -->
                    <div class="card card-default">
                      <div class="card-header">
                        <h2>All sales graphs</h2>
                      </div>
                      <div class="card-body">
                        <div class="chart-wrapper">
                            <canvas id="incomeChart"></canvas>
                        </div>
                      </div>

                    </div>


                  </div>
                  <div class="col-xl-4">
                    <!-- Current Users  -->
                    <div class="card card-default">
                      <div class="card-header">
                        <h2>Current Users</h2>
                        <span>Realtime</span>
                      </div>
                      <div class="card-body">
                        <canvas id="userPieChart"></canvas>
                      </div>
                      <div class="card-footer bg-white py-2">
                        <a href="users.php" class="text-uppercase">Users Overview</a>
                      </div>
                    </div>
                  </div>
                </div>


</div>
          
        </div>

<?php include("footer.php"); ?>
          
      </div>
    </div>
    
                    <script src="plugins/jquery/jquery.min.js"></script>
                    <script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
                    <script src="plugins/simplebar/simplebar.min.js"></script>
                    <script src="https://unpkg.com/hotkeys-js/dist/hotkeys.min.js"></script>
                    
                    <script src="plugins/apexcharts/apexcharts.js"></script>
                    
                    <script src="plugins/DataTables/DataTables-1.10.18/js/jquery.dataTables.min.js"></script>
                    
                    <script src="plugins/jvectormap/jquery-jvectormap-2.0.3.min.js"></script>
                    <script src="plugins/jvectormap/jquery-jvectormap-world-mill.js"></script>
                    <script src="plugins/jvectormap/jquery-jvectormap-us-aea.js"></script>
                    
                    <script src="plugins/daterangepicker/moment.min.js"></script>
                    <script src="plugins/daterangepicker/daterangepicker.js"></script>
                    <script>
                      jQuery(document).ready(function() {
                        jQuery('input[name="dateRange"]').daterangepicker({
                        autoUpdateInput: false,
                        singleDatePicker: true,
                        locale: {
                          cancelLabel: 'Clear'
                        }
                      });
                        jQuery('input[name="dateRange"]').on('apply.daterangepicker', function (ev, picker) {
                          jQuery(this).val(picker.startDate.format('MM/DD/YYYY'));
                        });
                        jQuery('input[name="dateRange"]').on('cancel.daterangepicker', function (ev, picker) {
                          jQuery(this).val('');
                        });
                      });
                    </script>
                    
                    <script src="https://cdn.quilljs.com/1.3.6/quill.js"></script>
                    
                    <script src="plugins/toaster/toastr.min.js"></script>
                    
                    <script src="js/mono.js"></script>
                    <script src="js/chart.js"></script>
                    <script src="js/map.js"></script>
                    <script src="js/custom.js"></script>

      <script src="js/npm/chart.js"></script>

<script>
fetch('get_booking_totals.php')
    .then(response => response.json())
    .then(data => {
        // แปลงค่าจาก string เป็น number และตรวจสอบค่า
        const food = Number(data.food.replace(/,/g, '')) || 0;
        const tour = Number(data.tour.replace(/,/g, '')) || 0;
        const homestay = Number(data.homestay.replace(/,/g, '')) || 0;
        const product = Number(data.product.replace(/,/g, '')) || 0;

        // อัปเดตรายได้ใน <span>
        document.getElementById("food_income").innerText = food.toLocaleString();
        document.getElementById("tour_income").innerText = tour.toLocaleString();
        document.getElementById("homestay_income").innerText = homestay.toLocaleString();
        document.getElementById("product_income").innerText = product.toLocaleString();

        // ตรวจสอบค่าใน Console
        //console.log("Processed Data:", { food, tour, homestay, product });

        // ตรวจสอบว่า Canvas มีอยู่จริง
        const canvas = document.getElementById('incomeChart');
        if (!canvas) {
            console.error("Canvas incomeChart not found!");
            return;
        }

        // ตรวจสอบว่า ctx ถูกต้อง
        const ctx = canvas.getContext('2d');
        if (!ctx) {
            console.error("getContext failed!");
            return;
        }

        // ลบกราฟเก่า ถ้ามีอยู่
        if (window.myChart) {
            window.myChart.destroy();
        }

        // สร้างกราฟใหม่
        window.myChart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: ['อาหาร', 'ทริปท่องเที่ยว', 'ที่พักโฮมสเตย์', 'สินค้าและของฝาก'],
                datasets: [{
                    data: [food, tour, homestay, product],
                    backgroundColor: ['#4bc0c0', '#ffce56', '#36a2eb', '#ff6384'],
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true,
                scales: {
                    y: {
                        beginAtZero: true
                    }
                },
                plugins: {
                    legend: {
                        display: false // ซ่อน legend หากไม่ต้องการแสดง
                    },
                    tooltip: {
                        callbacks: {
                            label: function(tooltipItem) {
                                return tooltipItem.raw.toLocaleString(); // แสดงตัวเลขที่มีการคำนวณแล้ว
                            }
                        }
                    }
                }
            }
        });
    })
    .catch(error => console.error("Error fetching data:", error));
</script>

<script>
fetch('get_user_totals.php')
    .then(response => response.json())
    .then(data => {
        const ctx = document.getElementById('userPieChart').getContext('2d');
        
        new Chart(ctx, {
            type: 'pie',  // ใช้ Pie Chart
            data: {
                labels: data.roles,  // ชื่อ role
                datasets: [{
                    data: data.counts,  // จำนวนจากแต่ละ role
                    backgroundColor: ['#ff6384', '#36a2eb', '#ffce56', '#4bc0c0'],  // สีของแต่ละส่วน
                    hoverOffset: 4
                }]
            },
            options: {
                responsive: true,
                plugins: {
                    legend: {
                        display: true, // แสดง Legend
                        position: 'top',  // กำหนดตำแหน่งของ Legend
                        labels: {
                            boxWidth: 20,  // ขนาดของกล่อง
                            padding: 15     // ระยะห่างระหว่าง Legend และ label
                        }
                    },
                    tooltip: {
                        callbacks: {
                            label: function(tooltipItem) {
                                // แสดงชื่อ label ใน tooltip
                                return tooltipItem.label + ": " + tooltipItem.raw;
                            }
                        }
                    }
                }
            }
        });
    })
    .catch(error => console.error("Error fetching data:", error));
</script>


  </body>
</html>
