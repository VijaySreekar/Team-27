<?php
session_start();

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

<?php include '../../Includes/admin_header.php'; ?>
<div class="container">
    <?php if(isset($_SESSION['message'])): ?>
        <div class="alert alert-warning alert-dismissible fade show" role="alert">
            <strong>Hey!</strong> <?= $_SESSION['message'] ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        <?php unset($_SESSION['message']); ?>
    <?php endif; ?>

    <div class="row">
        <!-- Bookings Card - Light Blue -->
        <div class="col-md-6 col-lg-3 mb-4">
            <div class="card border-0 shadow-sm bg-lightblue">
                <div class="card-body">
                    <h5 class="card-title">Bookings</h5>
                    <h2><?= $totalBookings; ?></h2>
                    <p class="text-success">+<?= $percentageChange; ?>% than last week</p>
                </div>
            </div>
        </div>

        <!-- Today's Users Card - Light Green -->
        <div class="col-md-6 col-lg-3 mb-4">
            <div class="card border-0 shadow-sm bg-lightgreen">
                <div class="card-body">
                    <h5 class="card-title">Today's Users</h5>
                    <h2><?= $todayUsersCount; ?></h2>
                    <p class="text-success">+<?= round($percentageChangeTodayUsers); ?>% than last month</p>
                </div>
            </div>
        </div>

        <!-- Revenue Card - Light Yellow -->
        <div class="col-md-6 col-lg-3 mb-4">
            <div class="card border-0 shadow-sm bg-lightyellow">
                <div class="card-body">
                    <h5 class="card-title">Revenue</h5>
                    <h2><?= $totalRevenue; ?></h2>
                    <p class="text-success">+<?= $percentageChangeRevenue; ?>% than yesterday</p>
                </div>
            </div>
        </div>

        <!-- Inventory Value Card - Light Purple -->
        <div class="col-md-6 col-lg-3 mb-4">
            <div class="card border-0 shadow-sm bg-lightpurple">
                <div class="card-body">
                    <h5 class="card-title">Inventory Value</h5>
                    <h2>£<?= number_format($totalInventoryValue, 2); ?></h2>
                    <p>Total Quantity: <?= $totalQuantity; ?></p>
                </div>
            </div>
        </div>

    <div class="row">
        <div class="col-lg-12">
            <div class="card h-100 border-0 shadow-sm">
                <div class="card-header">
                    <h6>Orders Overview</h6>
                    <p class="text-success"><i class="fas fa-arrow-up"></i> 24% this month</p>
                </div>
                <div class="card-body">
                    <?php if($resultOrders && mysqli_num_rows($resultOrders) > 0): ?>
                    <div class="list-group">
                        <?php while($rowOrder = mysqli_fetch_assoc($resultOrders)): ?>
                        <div class="list-group-item list-group-item-action">
                            <div class="d-flex w-100 justify-content-between">
                                <h5 class="mb-1"><?= $rowOrder['product_name']; ?> - £<?= $rowOrder['total_price']; ?></h5>
                                <small><?= date('d M H:i A', strtotime($rowOrder['created_at'])); ?></small>
                            </div>
                            <p class="mb-1">Ordered by: <?= $rowOrder['username']; ?></p
                            </p>
                        </div>
                        <?php endwhile; ?>
                    </div>
                    <?php else: ?>
                        <p class="text-muted">No recent orders</p>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include '../../Includes/admin_footer.php'; ?>
