$(document).ready(function () {
    function getData(data) {
        $('#prodTbl').dataTable({
            "aaData": data,
            "columns": [
                { "data": "id" },
                { "data": "product_name" },
                { "data": "product_price" },
                {
                    "data": "image",
                    "render": function (data, type, row) {
                        // Assuming 'image' is the file directory
                        // You can replace 'your_image_directory/' with your actual image directory
                        return '<img src="../Root/img/product/' + data + '" alt="Product Image" style="max-width: 100px; max-height: 100px;" />';
                    }
                },
                { "data": "product_category" },
                {
                    "data": "product_stock",
                    "render": function (data, type, row) {
                        var indicator = (data <= 50) ? 'red' : 'green';
                        return '<span class="stock-indicator ' + indicator + '">' + data + '</span>';
                    }
                },
                {
                    "data": null,
                    "render": function (data, type, row) {
                        return '<div class="d-flex">'+
                            '<button type="button" id="rtvBtn" class="btn btn-primary mx-1" data-id="' + row.id + '"><i class="bi bi-arrow-repeat"></i></button>'+
                            '<button type="button" id="delBtn" class="btn btn-danger" data-id="' + row.id + '"><i class="bi bi-trash"></i></button></div>';
                    }
                }
            ]
        })
    }

    $('#prodTbl').on('click', '#rtvBtn', function () {
        var rowId = $(this).data('id');
        Swal.fire({
            icon: "question",
            text: "Are you sure you want to retrieve this product?",
            showCancelButton: true,
            confirmButtonText: "Yes"
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: 'APIs/ArchiveAPI/getProductRetrieved.php',
                    type: 'POST',
                    data: {
                        id: rowId,
                    },
                    success: function (data) {
                        Swal.fire({
                            icon: 'success',
                            title: 'Product Retrieved!',
                            showConfirmButton: false,
                            timer: 1500
                        }).then(() => {
                            $('.modal').modal('hide');
                            location.reload();
                        })
                    },
                    error: function (error) {
                        alert(error);
                    }
                });
            }
        })
    });

    $('#prodTbl').on('click', '#delBtn', function () {
        var rowId = $(this).data('id');
        Swal.fire({
            icon: "question",
            text: "Are you sure you want to delete this product?",
            showCancelButton: true,
            confirmButtonText: "Yes"
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: 'APIs/ArchiveAPI/getProductDelete.php',
                    type: 'POST',
                    data: {
                        id: rowId,
                    },
                    success: function (data) {
                        Swal.fire({
                            icon: 'success',
                            title: 'Product Deleted!',
                            showConfirmButton: false,
                            timer: 1500
                        }).then(() => {
                            $('.modal').modal('hide');
                            location.reload();
                        })
                    },
                    error: function (error) {
                        alert(error);
                    }
                });
            }
        })
    });
    
    $.ajax({
        url: 'APIs/ArchiveAPI/getProductArchived.php',
        type: 'GET',
        dataType: 'json',
        success: function (data) {
            getData(data)
        },
        error: function (error) {
            console.error("An error occurred:", error);
        }
    });

})