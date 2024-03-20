<?php
session_start();
include 'Includes/header.php';
include 'AllFunctions/myfunctions.php';
?>


<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header bg-transparent">
                    <h3 class="mb-0">Products</h3>
                </div>
                <div class="card-body">
                    <table class="table table-bordered table-striped">
                        <thead>
                        <tr>
                            <th>Product ID</th>
                            <th>Product Name</th>
                            <th>Product Image</th>
                            <th>Product Status</th>
                            <th>Actions</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php
                        $product = getAll('product');

                        if(mysqli_num_rows($product) > 0)
                        {
                            foreach ($product as $item)
                            {
                                ?>
                                <tr>
                                    <td><?= $item['product_id'] ?></td>
                                    <td><?= $item['name'] ?></td>
                                    <td>
                                        <img src="<?= $item['image'] ?>" width="50px" height="50px" alt="<?= $item['name'] ?>">
                                    </td>
                                    <td>
                                        <?= $item['status'] == '1' ? "Visible" : "Hidden" ?>
                                    </td>
                                    <td>
                                        <a href="edit-product.php?id=<?= $item['product_id']; ?>"  class="btn btn-primary">Edit</a>
                                        <form action="add_category_code.php" method="POST">
                                            <input type="hidden" name="product_ids" value="<?= $item['product_id'] ?>">
                                            <button type="submit" class="btn btn-danger" name="delete_productbtn">Delete</button>
                                        </form>
                                    </td>
                                </tr>
                                <?php
                            }
                        }
                        else{
                            echo "No products found!";
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
<?php include 'Includes/Footer.php'; ?>


