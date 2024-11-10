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
                        return '<div class="d-flex"><button type="button" id="stckBtn" class="btn btn-primary mx-1" data-bs-toggle="modal" data-bs-target="#addProdStock" data-id="' + row.id + '" data-stock="' + row.product_stock + '" data-sad ="' + row.product_name + '"><i class="bi bi-boxes"></i></button>' +
                            '<button type="button" id="delBtn" class="btn btn-danger" data-id="' + row.id + '"><i class="bi bi-trash"></i></button></div>';
                    }
                }
            ]
        })
    }

    $.ajax({
        url: 'APIs/ProductAPI/getProducts.php',
        type: 'GET',
        dataType: 'json',
        success: function (data) {
            getData(data)
        },
        error: function (error) {
            console.error("An error occurred:", error);
        }
    });

    var currentStock = 0;
    $('#prodTbl').on('click', '#stckBtn', function () {
        currentStock = $(this).data('stock');
        $('#stock').val($(this).data('stock'));
        $('#stockId').val($(this).data('id'));
        $('#prodname').val($(this).data('sad'));
        $('#prodtextname').text($(this).data('sad'));
    });

    $('#addProdStockBtn').click(function () {
        $.ajax({
            url: 'APIs/ProductAPI/updateProdStock.php',
            type: 'POST',
            data: {
                id: $('#stockId').val(),
                product_name: $('#prodname').val(),
                product_stock: $('#stock').val()
            },
            success: function (data) {  
                console.log(data)
                if (data == 0) {
                    Swal.fire({
                        icon: 'error',
                        title: 'Requested stock exceeds the available stocks from the supplier',
                        showConfirmButton: false,
                        timer: 1000
                    })
                }
                if(data != 0){
                    Swal.fire({
                        icon: 'success',
                        title: 'Product Stock Added!',
                        showConfirmButton: false,
                        timer: 1000
                    }).then(() => {
                        $('#addProdStock').modal('hide');
                        location.reload();
                    })
                } 
            },
            error: function (error) {
                alert(error);
            }
        });

    })

    $('#prodTbl').on('click', '#delBtn', function () {
        var rowId = $(this).data('id');
        Swal.fire({
            icon: "question",
            text: "Are you sure you want to move this product from archive?",
            showCancelButton: true,
            confirmButtonText: "Yes"
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: 'APIs/ProductAPI/archiveProd.php',
                    type: 'POST',
                    data: {
                        id: rowId,
                    },
                    success: function (data) {
                        Swal.fire({
                            icon: 'success',
                            title: 'Product Archived!',
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

    $('#orderBtn').click(function () {
        $.ajax({
            url: 'APIs/ProductAPI/getSuppliers.php',
            type: 'GET',
            dataType: 'json',
            success: function (data) {
                var select = $('#suppliers');
                $.each(data, function (key, value) {
                    select.append($('<option>').text(value.supplier_name).val(value.supplier_id));
                });
            },
            error: function (data) {
                alert('Error loading supplier names.');
            }
        });
    })

    $('#suppliers').on('change', function () {
        $("#products").empty();
        $('#products').append($('<option>').text('Select Product').val(""));
        $.ajax({
            url: 'APIs/ProductAPI/getSupplierProducts.php',
            type: 'GET',
            data: {
                id: $(this).val()
            },
            dataType: 'json',
            success: function (data) {
                var select = $('#products');
                $.each(data, function (key, value) {
                    select.append($('<option>').text(value.product_name).val(value.product_name));
                });
            },
            error: function (data) {
                alert('Error loading supplier names.');
            }
        });
    })

    var prodImage = '';

    $('#products').on('change', function () {

        $.ajax({
            url: 'APIs/ProductAPI/getSuppProdDetail.php',
            type: 'GET',
            data: {
                name: $(this).val()
            },
            dataType: 'json',
            success: function (data) {
                $('#prodId').val(data[0].tbl_id);
                $('#suppProdStock').val(data[0].product_stock);
                $('#suppProdPrice').val(data[0].product_price);
                $('#suppProdCat').val(data[0].product_category);
                $("#prodImage").attr('src', '../Root/img/product/' + data[0].product_image)
                prodImage = data[0].product_image;
            },
            error: function (data) {
                alert('Error loading supplier names.');
            }
        });
    })

    $('#orderCnfrm').click(function () {
        if (parseInt($("#orderQuant").val()) <= parseInt($("#suppProdStock").val())) {
            $.ajax({
                url: 'APIs/ProductAPI/addproduct.php',
                type: 'POST',
                data: {
                    product_id: $('#prodId').val(),
                    available_stock: $("#suppProdStock").val(),
                    product_name: $("#products option:selected").text(),
                    product_price: $("#suppProdPrice").val(),
                    image: prodImage,
                    product_category: $('#suppProdCat').val(),
                    product_stock: $("#orderQuant").val()
                },
                success: function (data) {
                    Swal.fire({
                        icon: 'success',
                        title: 'Order Submitted',
                        showConfirmButton: false,
                        timer: 1500
                    }).then(() => {
                        $("#orderStock").find(':input').val('');
                        $('#orderStock').modal('hide');
                        location.reload();
                    })

                },
                error: function (error) {
                    alert(error);
                }
            });
        }

        if (parseInt($("#orderQuant").val()) > parseInt($("#suppProdStock").val())) {
            Swal.fire({
                icon: 'warning',
                title: 'Quantity must not exceed the available stock!',
                showConfirmButton: false,
                timer: 1500
            })
        }

    })

})