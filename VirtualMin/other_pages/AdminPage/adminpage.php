<?php
session_start();
include '../../Includes/admin_header.php';
include '../../Assets/Database/connectdb.php';
include 'adminauth.php';

$sql = "SELECT COUNT(id) AS total_bookings FROM orders";
$result = mysqli_query($conn, $sql);

if ($result) {
    $row = mysqli_fetch_assoc($result);
    $totalBookings = $row['total_bookings'];
} else {
    $totalBookings = 0;
}

$percentageChange = 55;

$sqlRevenue = "SELECT SUM(total_price) AS total_revenue FROM orders WHERE DATE(created_at) = CURDATE()";
$resultRevenue = mysqli_query($conn, $sqlRevenue);


if ($resultRevenue) {

    $rowRevenue = mysqli_fetch_assoc($resultRevenue);


    $totalRevenue = $rowRevenue['total_revenue'];
} else {

    $totalRevenue = 0;
}


$percentageChangeRevenue = 1;

// Fetch data from the user table to get today's user count
$sqlTodayUsers = "SELECT COUNT(user_id) AS today_users FROM user WHERE DATE(created_at) = CURDATE()";
$resultTodayUsers = mysqli_query($conn, $sqlTodayUsers);

// Check if query executed successfully
if ($resultTodayUsers) {
    // Fetch associative array
    $rowTodayUsers = mysqli_fetch_assoc($resultTodayUsers);

    // Extract today's user count
    $todayUsersCount = $rowTodayUsers['today_users'];
} else {
    // Handle error
    $todayUsersCount = 0;
}

// Fetch data from the user table to get last month's user count
$currentMonth = date('m');
$lastMonth = date('m', strtotime('-1 month'));
$sqlLastMonthUsers = "SELECT COUNT(user_id) AS last_month_users FROM user WHERE MONTH(created_at) = $lastMonth";
$resultLastMonthUsers = mysqli_query($conn, $sqlLastMonthUsers);

// Check if query executed successfully
if ($resultLastMonthUsers) {
    // Fetch associative array
    $rowLastMonthUsers = mysqli_fetch_assoc($resultLastMonthUsers);

    // Extract last month's user count
    $lastMonthUsersCount = $rowLastMonthUsers['last_month_users'];
} else {
    // Handle error
    $lastMonthUsersCount = 0;
}

// Calculate percentage change in today's users compared to last month
if ($lastMonthUsersCount != 0) {
    $percentageChangeTodayUsers = (($todayUsersCount - $lastMonthUsersCount) / $lastMonthUsersCount) * 100;
} else {
    // If last month's user count is zero, set percentage change to 100% or leave it blank based on your preference
    $percentageChangeTodayUsers = ($todayUsersCount > 0) ? 100 : 0;
}


$sqlInventory = "SELECT SUM(original_price * quantity) AS total_inventory_value, SUM(quantity) AS total_quantity FROM product";
$resultInventory = mysqli_query($conn, $sqlInventory);

// Check if query executed successfully
if ($resultInventory) {
    // Fetch associative array
    $rowInventory = mysqli_fetch_assoc($resultInventory);

    // Extract total inventory value and quantity
    $totalInventoryValue = $rowInventory['total_inventory_value'];
    $totalQuantity = $rowInventory['total_quantity'];
} else {
    // Handle error
    $totalInventoryValue = 0;
    $totalQuantity = 0;
}

$sqlOrders = "SELECT oh.*, p.name AS product_name, p.original_price AS total_price, u.username
              FROM orders oh
              LEFT JOIN order_items oi ON oh.id = oi.order_id
              LEFT JOIN product p ON oi.product_id = p.product_id
              LEFT JOIN user u ON oh.user_id = u.user_id
              ORDER BY oh.created_at DESC
              LIMIT 5"; // Limiting to 5 recent orders for display
$resultOrders = mysqli_query($conn, $sqlOrders);
?>


<div class="container">
    <?php
        if(isset($_SESSION['message'])):
        {
            ?>
            <div class="alert alert-warning alert-dismissible fade show" role="alert">
            <strong>Hey!</strong> <?= $_SESSION['message'] ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
            <?php
            unset($_SESSION['message']);
        }
        ?>
    <?php endif; ?>
    <div class="row">
        <div class="col-md-12">
            <div class="row">
                <div class="col-lg-5 col-sm-5">
                    <div class="card  mb-2">
                        <div class="card-header p-3 pt-2">
                            <div class="icon icon-lg icon-shape bg-gradient-dark shadow-dark shadow text-center border-radius-xl mt-n4 position-absolute">
                                <i class="material-icons opacity-10">weekend</i>
                            </div>
                            <div class="text-end pt-1">
                                <p class="text-sm mb-0 text-capitalize">Bookings</p>
                                <h4 class="mb-0"><?php echo $totalBookings; ?></h4>
                            </div>
                        </div>

                        <hr class="dark horizontal my-0">
                        <div class="card-footer p-3">
                            <p class="mb-0"><span class="text-success text-sm font-weight-bolder">+<?php echo $percentageChange; ?>% </span>than last week</p>
                        </div>
                    </div>

                    <div class="card  mb-2">
                        <div class="card-header p-3 pt-2">
                            <div class="icon icon-lg icon-shape bg-gradient-primary shadow-primary shadow text-center border-radius-xl mt-n4 position-absolute">
                                <i class="material-icons opacity-10">leaderboard</i>
                            </div>
                            <div class="text-end pt-1">
                                <p class="text-sm mb-0 text-capitalize">Today's Users</p>
                                <h4 class="mb-0"><?php echo $todayUsersCount; ?></h4>
                            </div>
                        </div>

                        <hr class="dark horizontal my-0">
                        <div class="card-footer p-3">
                            <p class="mb-0"><span class="text-success text-sm font-weight-bolder">+<?php echo round($percentageChangeTodayUsers); ?>% </span>than last month</p>
                        </div>
                    </div>

                </div>
                <div class="col-lg-5 col-sm-5 mt-sm-0 mt-4">
                    <div class="card  mb-2">
                        <div class="card-header p-3 pt-2 bg-transparent">
                            <div class="icon icon-lg icon-shape bg-gradient-success shadow-success text-center border-radius-xl mt-n4 position-absolute">
                                <i class="material-icons opacity-10">store</i>
                            </div>
                            <div class="text-end pt-1">
                                <p class="text-sm mb-0 text-capitalize ">Revenue</p>
                                <h4 class="mb-0 "><?php echo $totalRevenue; ?></h4>
                            </div>
                        </div>

                        <hr class="horizontal my-0 dark">
                        <div class="card-footer p-3">
                            <p class="mb-0 "><span class="text-success text-sm font-weight-bolder">+<?php echo $percentageChangeRevenue; ?>% </span>than yesterday</p>
                        </div>
                    </div>

                    <div class="card ">
                        <div class="card-header p-3 pt-2 bg-transparent">
                            <div class="icon icon-lg icon-shape bg-gradient-info shadow-info text-center border-radius-xl mt-n4 position-absolute">
                                <i class="material-icons opacity-10">inventory</i>
                            </div>
                            <div class="text-end pt-1">
                                <p class="text-sm mb-0 text-capitalize ">Inventory Value</p>
                                <h4 class="mb-0">£<?php echo number_format($totalInventoryValue, 2); ?></h4>
                            </div>
                        </div>

                        <hr class="horizontal my-0 dark">
                        <div class="card-footer p-3">
                            <p class="mb-0 ">Total Quantity: <?php echo $totalQuantity; ?></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-4 col-md-6">
            <div class="card h-100">
                <div class="card-header pb-0">
                    <h6>Orders overview</h6>
                    <p class="text-sm">
                        <i class="fa fa-arrow-up text-success" aria-hidden="true"></i>
                        <span class="font-weight-bold">24%</span> this month
                    </p>
                </div>
                <div class="card-body p-3">
                    <div class="timeline timeline-one-side">
                        <?php
                        // Check if there are any orders
                        if ($resultOrders && mysqli_num_rows($resultOrders) > 0) {
                            // Loop through each order
                            while ($rowOrder = mysqli_fetch_assoc($resultOrders)) {
                                ?>
                                <div class="timeline-block mb-3">
                            <span class="timeline-step">
                                <i class="material-icons text-success text-gradient">notifications</i>
                            </span>
                                    <div class="timeline-content">
                                        <h6 class="text-dark text-sm font-weight-bold mb-0"><?php echo $rowOrder['product_name']; ?> - $<?php echo $rowOrder['total_price']; ?></h6>
                                        <p class="text-secondary font-weight-bold text-xs mt-1 mb-0"><?php echo date('d M H:i A', strtotime($rowOrder['created_at'])); ?></p>
                                        <p class="text-secondary font-weight-bold text-xs mt-1 mb-0">Ordered by: <?php echo $rowOrder['username']; ?></p>
                                    </div>
                                </div>
                                <?php
                            }
                        } else {
                            // If no orders found or error in query
                            echo "<p>No recent orders</p>";
                            if (!$resultOrders) {
                                echo "Error: " . mysqli_error($conn);
                            }
                        }
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
</div>
<?php include '../../Includes/admin_footer.php'; ?>