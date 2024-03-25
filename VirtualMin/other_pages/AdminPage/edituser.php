<?php
session_start();
include '../../Assets/Functions/myfunctions.php';
include 'adminauth.php';
?>

<?php include '../../Includes/admin_header.php'; ?>

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow">
                <?php
                if(isset($_GET['user_id'])) {
                    $id = $_GET['user_id'];
                    $user = getUserbyID('user', $id);
                    if(mysqli_num_rows($user) > 0) {
                        $data = mysqli_fetch_array($user);
                        ?>
                        <div class="card-header">
                            <h4>Edit User
                                <a href="allusers.php" class="btn btn-primary float-end">Back</a>
                            </h4>
                        </div>
                        <div class="card-body">
                            <form action="update_user_code.php" method="POST" enctype="multipart/form-data">
                                <input type="hidden" name="user_id" value="<?= $data['user_id']; ?>">
                                <div class="form-group">
                                    <label>Name</label>
                                    <input type="text" class="form-control" name="username" value="<?= $data['username']; ?>" placeholder="Enter User Name" required>
                                </div>
                                <div class="form-group">
                                    <label>Email</label>
                                    <input type="email" class="form-control" name="email" value="<?= $data['email']; ?>" placeholder="Enter User Email" required>
                                </div>
                                <div class="form-group">
                                    <label>Phone Number</label>
                                    <input type="text" class="form-control" name="phone" value="<?= $data['phone']; ?>" placeholder="Enter User Phone Number" required>
                                </div>
                                <div class="form-group mt-4">
                                    <button type="submit" class="btn btn-primary" name="edituser_btn">Update</button>
                                </div>
                            </form>
                        </div>
                        <?php
                    } else {
                        echo "<div class='alert alert-danger' role='alert'>Cannot find user with this ID!</div>";
                    }
                } else {
                    echo "<div class='alert alert-danger' role='alert'>ID is not set!</div>";
                }
                ?>
            </div>
        </div>
    </div>
</div>

<?php include '../../Includes/admin_footer.php'; ?>
