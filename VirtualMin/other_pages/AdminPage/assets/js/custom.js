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
});
