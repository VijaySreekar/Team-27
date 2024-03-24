$(document).ready(function() {

    $(document).on('click', '.deleteproduct_btn', function(e) {
        e.preventDefault();
        var product_id = $(this).data('product_id');

        Swal.fire({
            title: "Are you sure?",
            text: "Once deleted, you will not be able to recover this file!",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!',
            cancelButtonText: 'No, cancel!'
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    method: "POST",
                    url: "add_category_code.php",
                    data: {
                        'product_id': product_id,
                        deleteproduct_btn: true
                    },
                    success: function(response) {
                        if (response == 200) {
                            Swal.fire("Success!", "Product Deleted Successfully", "success");
                            $("#product_table").load(location.href + " #product_table")
                        } else if (response == 500) {
                            Swal.fire("Error!", "Internal Server Error", "error");
                        }
                    }
                });
            }
        });

    });

    $(document).on('click', '.delete_categorybtn', function(e) {
        e.preventDefault();

        var category_id = $(this).data('category_id');

        Swal.fire({
            title: "Are you sure?",
            text: "Once deleted, you will not be able to recover this file!",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!',
            cancelButtonText: 'No, cancel!'
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    method: "POST",
                    url: "add_category_code.php",
                    data: {
                        'category_ids': category_id, // Changed from 'category_id' to 'category_ids'
                        delete_categorybtn: true
                    },
                    success: function(response) {
                        if (response == 200) {
                            Swal.fire("Success!", "Category Deleted Successfully", "success");
                            $("#category_table").load(location.href + " #category_table");
                        } else if (response == 500) {
                            Swal.fire("Error!", "Internal Server Error", "error");
                        }
                    }
                });
            }
        });
    });

    $(document).on('click', '.deleteuser_btn', function(e) {
        e.preventDefault();
    
        var user_id = $(this).data('user_id');
    
        Swal.fire({
            title: "Are you sure?",
            text: "Once deleted, you will not be able to recover this file!",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!',
            cancelButtonText: 'No, cancel!'
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    method: "POST",
                    url: "add_category_code.php",
                    data: {
                        'user_id': user_id, 
                        deleteuser_btn: true
                    },
                    success: function(response) {
                        if (response == 200) {
                            Swal.fire("Success!", "Category Deleted Successfully", "success");
                            $("#user_table").load(location.href + " #user_table");
                        } else if (response == 500) {
                            Swal.fire("Error!", "Internal Server Error", "error");
                        }
                    }
                });
            }
        });
    });
    

    $(document).on('click','.addToCartButton',function (e) {
        e.preventDefault();

        var quantity = $('input[name="quantity"]').val();
        var product_id = $(this).val()


        $.ajax({
            method: "POST",
            url: "addToCart.php",
            data: {
                'product_id': product_id,
                'quantity': quantity,
                'scope': 'add'
            },
            success: function (response) {
                if (response == 201) {
                    Swal.fire({
                        icon: 'success',
                        title: 'Success!',
                        text: 'Product added to cart successfully',
                        timer: 3000, // Auto-close after 3 seconds
                        timerProgressBar: true
                    });
                } else if (response == 401) {
                    Swal.fire({
                        icon: 'warning',
                        title: 'Login Required',
                        text: 'Login to Continue!',
                        timer: 3000,
                        timerProgressBar: true
                    });
                } else if (response == 500) {
                    Swal.fire({
                        icon: 'error',
                        title: 'Oops...',
                        text: 'Something went wrong! Please try again later',
                        timer: 3000,
                        timerProgressBar: true
                    });
                }
            }
        });
    });

    $(document).on('click','.updateQuantity',function () {

        var $parentRow = $(this).closest('.row');

        var quantity = $parentRow.find('input[name="quantity"]').val();
        // Since product_id uses class, we need to adjust the selector
        var product_id = $parentRow.find('.product_id').val();

        $.ajax({
            method: "POST",
            url: "../ProductPage/addToCart.php",
            data: {
                'product_id': product_id,
                'quantity': quantity,
                'scope': 'update'
            },
            success: function (response) {
                if (response == 201) {
                    Swal.fire({
                        icon: 'success',
                        title: 'Success!',
                        text: 'Quantity updated successfully',
                        timer: 3000, // Auto-close after 3 seconds
                        timerProgressBar: true
                    });
                } else if (response == 401){
                    Swal.fire({
                        icon: 'warning',
                        title: 'Login Required',
                        text: 'Login to Continue!',
                        timer: 3000,
                        timerProgressBar: true
                    });
                } else if (response == 500){
                    Swal.fire({
                        icon: 'error',
                        title: 'Oops...',
                        text: 'Something went wrong! Please try again later',
                        timer: 3000,
                        timerProgressBar: true
                    });
                }
            }
        });
    });

    $(document).on('click','.deleteItem',function () {
        var cart_id = $(this).val();

        $.ajax({
            method: "POST",
            url: "../ProductPage/addToCart.php",
            data: {
                'cart_id': cart_id,
                'scope': 'delete'
            },
            success: function (response) {
                if (response == 200){
                    Swal.fire({
                        icon: 'success',
                        title: 'Success!',
                        text: 'Item deleted successfully',
                        timer: 3000, // Auto-close after 3 seconds
                        timerProgressBar: true
                    });
                    $('.MyCartItems').load(location.href + ' .MyCartItems');
                }else if (response == 500){
                    Swal.fire({
                        icon: 'error',
                        title: 'Oops...',
                        text: 'Something went wrong! Please try again later',
                        timer: 3000,
                        timerProgressBar: true
                    });
                }
            }
        });
    });
});

