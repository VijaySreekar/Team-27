<?php
session_start();
include '../../Includes/admin_header.php';
include '../../Assets/Functions/myfunctions.php';
include '../../Assets/Database/connectdb.php';
include 'adminauth.php';

// Pagination configuration
$records_per_page = 10;
$page = isset($_GET['page']) ? $_GET['page'] : 1;
$offset = ($page - 1) * $records_per_page;

// Fetch users with pagination
$query = "SELECT * FROM user LIMIT $offset, $records_per_page";
$users_result = mysqli_query($conn, $query);

?>

<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header bg-transparent">
                    <h3 class="mb-0">Users</h3>
                </div>
                <div class="card-body" id="user_table">
                    <?php
                    if (mysqli_num_rows($users_result) > 0) {
                        ?>
                        <table class="table table-bordered table-striped">
                            <thead>
                            <tr>
                                <th>User ID</th>
                                <th>Username</th>
                                <th>User Email</th>
                                <th>User Phone Number</th>
                                <th>Actions</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php
                            while ($user = mysqli_fetch_assoc($users_result)) {
                                ?>
                                <tr>
                                    <td><?= $user['user_id'] ?></td>
                                    <td><?= $user['username'] ?></td>
                                    <td><?= $user['email'] ?></td>
                                    <td><?= $user['phone'] ?></td>
                                    <td>
                                        <a href="edituser.php?id=<?= $user['user_id']; ?>" class="btn btn-primary">Edit</a>
                                        <button type="button" class="btn btn-danger deleteuser_btn" data-user_id="<?= $user['user_id']; ?>">Delete</button>
                                    </td>
                                </tr>
                                <?php
                            }
                            ?>
                            </tbody>
                        </table>
                        <?php
                    } else {
                        echo "<p>No users found!</p>";
                    }
                    ?>

                    <!-- Pagination links -->
                    <?php
                    $total_query = "SELECT COUNT(*) as total FROM user";
                    $total_result = mysqli_query($conn, $total_query);
                    $total_row = mysqli_fetch_assoc($total_result);
                    $total_users = $total_row['total'];
                    $total_pages = ceil($total_users / $records_per_page);

                    if ($total_pages > 1) {
                        echo '<ul class="pagination justify-content-center">';
                        for ($i = 1; $i <= $total_pages; $i++) {
                            echo '<li class="page-item ' . ($page == $i ? 'active' : '') . '"><a class="page-link" href="?page=' . $i . '">' . $i . '</a></li>';
                        }
                        echo '</ul>';
                    }
                    ?>
                </div>
            </div>
        </div>
    </div>
</div>
<?php include '../../Includes/admin_footer.php'; ?>
