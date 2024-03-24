<?php
session_start();
include '../../Includes/admin_header.php';
include '../../Assets/Functions/myfunctions.php';
?>


<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header bg-transparent">
                    <h3 class="mb-0">Users</h3>
                </div>
                <div class="card-body" id="product_table">
                    <table class="table table-bordered table-striped">
                        <thead>
                        <tr>
                            <th>user ID</th>
                            <th>Username</th>
                            <th>User email</th>
                            <th>Password hash</th>
                            <th>Status</th>
                            <th>Actions</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php
                        $user = getAll('user');

                        if(mysqli_num_rows($user) > 0)
                        {
                            foreach ($user as $item)
                            {
                                ?>
                                <tr>
                                    <td><?= $item['user_id'] ?></td>
                                    <td><?= $item['username'] ?></td>
                                    <td><?= $item['email'] ?></td>
                                    <td><?= $item['password'] ?></td>
                                    <td><?= $item['status'] == '1' ? "Visible" : "Hidden" ?></td>
                                    <td>
                                        <a href="../ProfilePage/edit_user.php?id=<?= $item['user_id']; ?>"  class="btn btn-primary">Edit</a>
                                        <button type="button" class="btn btn-danger deleteuser_btn" data-user_id="<?= $item['user_id']; ?>">Delete</button>
                                    </td>
                                </tr>
                                <?php
                            }
                        }
                        else{
                            echo "No users found!";
                        }
                        ?>
                        <tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
<?php include '../../Includes/admin_footer.php'; ?>

