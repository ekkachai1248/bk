<?php
session_start();
include_once("connectdb.php");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Local Buengkan - วางแผนกินเที่ยว</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

	<link rel="icon" type="image/png" href="images/icons/favicon.png"/>
	<link rel="stylesheet" type="text/css" href="css/main.css">
    <link rel="stylesheet" type="text/css" href="fonts/iconic/css/material-design-iconic-font.min.css">
    
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Prompt&family=Kanit&display=swap" rel="stylesheet">
    
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        body{
            font-family: "Prompt", serif;
            font-size: 14px;
        }
        .drag-container {
            display: flex;
            flex-wrap: wrap;
            justify-content: space-between;
            align-items: flex-start;
        }

        .drag-box {
            width: 45%;
            min-height: 200px;
            border: 2px dashed;
            padding: 8px;
            border-radius: 5px;
            background-color: #f8f9fa;
            margin-bottom: 20px;
            position: relative;
            overflow-y: auto; /* Make box scrollable */
            height: 300px; /* Adjust height as needed */
        }

        .drag-box h6 {
            text-align: center;
            margin-bottom: 8px;
            padding: 8px;
            font-weight: bold;
            position: sticky;
            top: 0;
            z-index: 1;  /* Ensure header stays above content */
            background-color: #007bff;
            color: white;
            pointer-events: none; /* Prevent interaction */
        }

        .drag-box h5 {
            background-color: #007bff;
            color: white;
        }

        .drag-item {
            padding: 8px 12px;
            margin-bottom: 5px;
            border-radius: 3px;
            cursor: move;
        }

        .drag-item:last-child {
            margin-bottom: 0;
        }

        /* Colors for each group */
        #availableTours, #selectedTours {
            border-color: #007bff;
        }

        #availableTours h6, #selectedTours h6 {
            background-color: #007bff;
            color: white;
        }        
        
        #availableFoods, #selectedFoods {
            border-color: #28a745;
        }

        #availableFoods h6, #selectedFoods h6 {
            background-color: #28a745;
            color: white;
        }

        #availableHomestays, #selectedHomestays {
            border-color: #ffc107;
        }

        #availableHomestays h6, #selectedHomestays h6 {
            background-color: #ffc107;
            color: white;
        }

        /* Lighter colors for items */
        #availableTours .drag-item, #selectedTours .drag-item {
            background-color: rgba(0, 123, 255, 0.2);
            color: #007bff;
        }        
        
        #availableFoods .drag-item, #selectedFoods .drag-item {
            background-color: rgba(40, 167, 69, 0.2);
            color: #155724;
        }

        #availableHomestays .drag-item, #selectedHomestays .drag-item {
            background-color: rgba(255, 193, 7, 0.2);
            color: #856404;
        }

    </style>
<style>
a {
    text-decoration: none; /* ลบเส้นขีดใต้ในสถานะปกติ */
}

a:hover {
    text-decoration: none; /* ลบเส้นขีดใต้ในสถานะ hover */
}
</style>
</head>
<body class="animsition">
    
<?php //include("header.php"); ?>
    
<header class="header-v4">
		<!-- Header desktop -->
		<div class="container-menu-desktop">
			<!-- Topbar -->
			<div class="top-bar">
				<div class="content-topbar flex-sb-m h-full container">
					<div class="row">
                    <div class="col-6">
                        <div class="left-top-bar">
                            <a href="index.php" style="color: white;"><h3>Local Buengkan</h3></a>
                        </div>
                    </div>
                        
                    <div class="right-top-bar col-6 d-flex justify-content-end">   
                        
								<?php if(empty($_SESSION['user_id'])){ ?>
                        
						<a href="sign-in.php" class="flex-c-m trans-04 p-lr-25 p-2 pr-4 pl-4">
							เข้าสู่ระบบ
						</a>
                                <?php } else { ?>
						<a href="transactions.php" class="flex-c-m trans-04 p-lr-25 p-2 pr-4 pl-4">
							รายการสั่งซื้อ
						</a>
						<a href="myaccount.php" class="flex-c-m trans-04 p-lr-25 p-2 pr-4 pl-4">
							บัญชีของฉัน
						</a>
						<a href="sign-out.php" class="flex-c-m trans-04 p-lr-25 p-2 pr-4 pl-4">
							ออกจากระบบ
						</a>
                                <?php } ?>

					</div>
		</div>			
				</div>
			</div>

			<div class=" how-shadow1">
				<nav class="limiter-menu-desktop container">
					
					<!-- Logo desktop 		
					<a href="#" class="logo">
						<img src="images/icons/logo-01.png" alt="IMG-LOGO">
					</a>-->
                    
            <!--<div class="row">-->
                <div class="col-12 d-flex justify-content-center">

					<!-- Menu desktop -->
					<div class="menu-desktop mt-2">
						<ul class="main-menu">
							<li>
								<a href="index.php">หน้าหลัก</a>
							</li>

							<li class="label1 <?php echo (basename($_SERVER['PHP_SELF']) == 'foods.php' || basename($_SERVER['PHP_SELF']) == 'food_detail.php') ? 'active-menu' : ''; ?>" data-label1="hot">
								<a href="foods.php">อาหาร</a>
							</li>

							<li class="<?php echo (basename($_SERVER['PHP_SELF']) == 'homestay.php' || basename($_SERVER['PHP_SELF']) == 'homestay_detail.php') ? 'active-menu' : ''; ?>">
								<a href="homestay.php">ที่พัก</a>
							</li>

							<li class="label1 <?php echo basename($_SERVER['PHP_SELF']) == 'products.php' ? 'active-menu' : ''; ?>" data-label1="hot">
								<a href="products.php">สินค้าและของฝาก</a>
							</li>

							<li class="<?php echo basename($_SERVER['PHP_SELF']) == 'tours.php' ? 'active-menu' : ''; ?>">
								<a href="tours.php">ท่องเที่ยว</a>
							</li>

							<li class="label1 <?php echo basename($_SERVER['PHP_SELF']) == 'plans.php' ? 'active-menu' : ''; ?>" data-label1="hot">
								<a href="plans.php">วางแผนกินเที่ยว</a>
							</li>
                            
							<li class="<?php echo basename($_SERVER['PHP_SELF']) == 'contact.php' ? 'active-menu' : ''; ?>">
								<a href="contact.php">ติดต่อเรา</a>
							</li>
						</ul>
					</div>	
                </div>
                
                <div class="justify-content-end">
					<!-- Icon header -->
					<div class="wrap-icon-header flex-w flex-r-m">

						<div class="icon-header-item cl2 hov-cl1 trans-04 p-l-22 p-r-11" >
							<a href="shopping_cart.php"><i class="zmdi zmdi-shopping-cart"></i></a>
						</div>

						<!--<a href="#" class="icon-header-item cl2 hov-cl1 trans-04 p-l-22 p-r-11">
							<i class="zmdi zmdi-favorite-outline"></i>
						</a>-->
					</div>
                </div>
            <!--</div>-->
                    
				</nav>
			</div>	
		</div>
    </header>    
    <div class="container mt-2">
        <h2 class="text-center mb-4">วางแผนกินเที่ยว</h2>
        <h6 class="text-center mb-4">เลือกสิ่งที่ท่านชอบกิน ชอบเที่ยว หรือชอบพัก<br>
โดยลากข้อมูลจากช่องด้านซ้ายไปด้านขวา</h6>
        
        <!-- Datepicker Section -->
        <form>
            <div class="row justify-content-center mb-3">
            <div class="form-group">
                <label for="startDate" class="col-form-label text-primary">วันที่เริ่มต้น:</label>
                <div class="col-md-12">
                    <input type="date" id="startDate" class="form-control" placeholder="เลือกวันที่เริ่มต้น" min="<?php echo date('Y-m-d'); ?>" value="<?php echo date('Y-m-d'); ?>" required>
                </div>
            </div>
            <div class="form-group">
                <label for="endDate" class="col-form-label text-primary">วันที่สิ้นสุด:</label>
                <div class="col-md-12">
                    <input type="date" id="endDate" class="form-control" placeholder="เลือกวันที่สิ้นสุด" min="<?php echo date('Y-m-d'); ?>" value="<?php echo date('Y-m-d'); ?>" required>
                </div>
            </div>
            </div>
        </form>        
        
        <div class="drag-container">
            
            
            <!-- Group: Tours -->
            <div class="drag-box" id="availableTours">
                <h6>ทริปท่องเที่ยว</h6>
<?php
$sql = "SELECT data FROM `tags` WHERE `id`='3' "; // Tours `id`='3'
$result = $conn->query($sql);
$row = $result->fetch_assoc();
$arr_tours = explode(";",$row['data']);
$i = 0;
foreach($arr_tours as $tour){
    $i++;
?>
                <div class="drag-item" data-id="<?php echo $i;?>"><?php echo $tour;?></div>
<?php } ?>
                <input type="text" id="toursInput1" placeholder="เพิ่มคำค้น">
                <input type="text" id="toursInput2" placeholder="เพิ่มคำค้น">
            </div>
            <div class="drag-box" id="selectedTours">
                <h6>ทริปท่องเที่ยวที่เลือก</h6>
            </div>

            
            <!-- Group: Foods -->
            <div class="drag-box" id="availableFoods">
                <h6>อาหาร</h6>
<?php
$sql = "SELECT data FROM `tags` WHERE `id`='1' "; // Foods `id`='1'
$result = $conn->query($sql);
$row = $result->fetch_assoc();
$arr_foods = explode(";",$row['data']);
$i = 0;
foreach($arr_foods as $food){
    $i++;
?>
                <div class="drag-item" data-id="<?php echo $i;?>"><?php echo $food;?></div>
<?php } ?>
                <input type="text" id="foodsInput1" placeholder="เพิ่มคำค้น">
                <input type="text" id="foodsInput2" placeholder="เพิ่มคำค้น">
            </div>
            <div class="drag-box" id="selectedFoods">
                <h6>อาหารที่เลือก</h6>
            </div>

            <!-- Group: Homestays -->
            <div class="drag-box" id="availableHomestays">
                <h6>ที่พัก</h6>
<?php
$sql = "SELECT data FROM `tags` WHERE `id`='2' "; // Homestays `id`='2'
$result = $conn->query($sql);
$row = $result->fetch_assoc();
$arr_homestays = explode(";",$row['data']);
$i = 0;
foreach($arr_homestays as $homestay){
    $i++;
?>
                <div class="drag-item" data-id="<?php echo $i;?>"><?php echo $homestay;?></div>
<?php } ?>
                <input type="text" id="homestaysInput1" placeholder="เพิ่มคำค้น">
                <input type="text" id="homestaysInput2" placeholder="เพิ่มคำค้น">
            </div>
            <div class="drag-box" id="selectedHomestays">
                <h6>ที่พักที่เลือก</h6>
            </div>

        </div>

        <div class="text-center mt-4 mb-5">
            <button class="btn btn-primary btn-lg" id="submitButton">สร้างทริปกินเที่ยว &gt;&gt;</button>
        </div>
    </div>

    <!-- Include Sortable.js -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Sortable/1.14.0/Sortable.min.js"></script>
<script>
    // Apply Sortable.js to all drag-boxes
    const groups = ['Tours', 'Foods', 'Homestays'];

    groups.forEach(group => {
        new Sortable(document.getElementById('available' + group), {
            group: group,
            animation: 150
        });
        new Sortable(document.getElementById('selected' + group), {
            group: group,
            animation: 150
        });
    });

    // Handle Submit button
    document.getElementById('submitButton').addEventListener('click', () => {
        let hasError = false; // Reset error flag
        const errorMessages = []; // Collect error messages
        const results = {};

        groups.forEach(group => {
            const selectedItems = Array.from(document.getElementById('selected' + group).children)
                .filter(item => item.classList.contains('drag-item')) // Filter out the header
                .map(item => item.textContent.trim());
            results[group] = selectedItems;

            // Validate required selections
            if (group === 'Tours' && selectedItems.length === 0) {
                errorMessages.push("โปรดเลือก 'ทริปท่องเที่ยว' อย่างน้อย 1 ทริป");
                hasError = true;
            } else if (group === 'Foods' && selectedItems.length === 0) {
                errorMessages.push("โปรดเลือก 'อาหาร' อย่างน้อย 1 เมนู");
                hasError = true;
            } else if (group === 'Homestays' && selectedItems.length === 0) {
                errorMessages.push("โปรดเลือก 'ที่พัก' อย่างน้อย 1 ที่");
                hasError = true;
            }
        });

        // Show all error messages at once
        if (hasError) {
            alert(errorMessages.join("\n"));
            return; // Stop further processing
        }

        // Add the values from the input fields to the results if not empty
        groups.forEach(group => {
            const input1 = document.getElementById(group.toLowerCase() + 'Input1');
            const input2 = document.getElementById(group.toLowerCase() + 'Input2');

            if (input1 && input1.value.trim() !== '') results[group].push(input1.value.trim());
            if (input2 && input2.value.trim() !== '') results[group].push(input2.value.trim());
        });

        // Get date values from inputs
        const startDate = document.getElementById('startDate').value;
        const endDate = document.getElementById('endDate').value;

        results.startDate = startDate;
        results.endDate = endDate;

        // Alert results for debugging (optional)
        //alert(JSON.stringify(results, null, 2));

        // Send data to PHP using a hidden form or AJAX
        const form = document.createElement('form');
        form.method = 'POST';
        form.action = 'process_submission.php';
        form.target = '_blank';

        Object.keys(results).forEach(key => {
            const input = document.createElement('input');
            input.type = 'hidden';
            input.name = key;
            input.value = JSON.stringify(results[key]);
            form.appendChild(input);
        });

        document.body.appendChild(form);
        form.submit();
    });
</script>

<?php //include("footer.php"); ?>
    
</body>
</html>
