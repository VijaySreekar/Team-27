<?php
session_start();
include '../../Assets/Functions/myfunctions.php';
include 'adminauth.php';
?>

<?php include '../../Includes/admin_header.php'; ?>

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
            <?php
                if(isset($_GET['user_id']))
                {
                    $id = $_GET['user_id'];
                    $user = getUserbyID('user', $id);
                    if(mysqli_num_rows($user) > 0)
                    {
                        $data = mysqli_fetch_array($user);
                        ?>
                            <div class="card">
                            <div class="card-header">
                                <h4>Edit User
                                    <a href="allusers.php" class="btn btn-primary float-end">Back</a>
                                </h4>
                            </div>
                            <div class="card-body">
                                <form action="add_category_code.php" method="POST" enctype="multipart/form-data">
                                    <div class="row">
                                         class="col-md-12">
                                        <input type="hidden" name="user_id" value="<?= $data['user_id']; ?>">
                                        <div class="col-md-12">
                                            <label class="mb-0">Name</label>
                                            <input type="text" required class="form-control mb-3" value="<?= $data['username']; ?>" name="username" placeholder="Enter User Name">
                                        </div>
                                        <div class="col-md-12">
                                            <label class="mb-0">Email</label>
                                            <textarea class="form-control mb-3" required name="email" placeholder="Enter User Email"><?= $data['email']; ?></textarea>
                                        </div>
                                        <div class="col-md-6">
                                            <label class="mb-0">Phone number</label>
                                            <input type="text" class="form-control mb-3" required name="phone" value="<?= $data['phone']; ?>" placeholder="Enter User Phone Number">
                                        </div>
                                        </div>

                                        <div class="col-md-12">
                                            <button type='submit' class="btn btn-primary mt-3" name="edituser_btn">Update</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                        <?php
                    }
                    else
                    {
                        echo "Cannot find user with this ID!";
                    }

                }
                else
                    {
                        echo "Id is not set!";
                    }
                ?>
        </div>
    </div>
</div>
<?php include '../../Includes/admin_footer.php'; ?>

