$(document).ready(function(){
    function getData(data){
        $('#suppProdTbl').dataTable( {
            "aaData": data,
            "columns": [
                { "data": "tbl_id" },
                { "data": "supplier_id" },
                { "data": "supplier_name" },
                { "data": "product_price" },
                {
                    "data": "product_image",
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
                        return '<button type="button" id="delBtn" class="btn btn-danger" data-id="' + row.tbl_id + '"><i class="bi bi-archive"></i> Archive</button></div>';
                    }
                }
            ]
        })  
    }
   
    $.ajax({
        url: 'APIs/SupplierAPI/getsupplierproducts.php',
        type: 'GET',
        dataType: 'json',
        success: function(data) {
            getData(data)
        },
        error: function(error) {
            console.error("An error occurred:", error);
        }
    });

    $('#suppProdTbl').on('click', '#delBtn', function() {
        var rowId = $(this).data('id');
        Swal.fire({
            icon:"question",
            text:"Are you sure you want to move this product to archive?",
            showCancelButton: true,
            confirmButtonText: "Yes"
        }).then((result)=>{
            if(result.isConfirmed){
                $.ajax({
                    url: 'APIs/SupplierAPI/archivedSupplierProducts.php',
                    type: 'POST',
                    data: {
                        tbl_id: rowId,
                    },                    
                    success: function(data) {
                        Swal.fire({
                            icon: 'success',
                            title: 'Product Archived!',
                            showConfirmButton: false,
                            timer: 1500
                        }).then(() => {
                            $('#deleteSupp').modal('hide');
                            location.reload();
                        })
                    },
                    error: function(error) {
                        alert(error);
                    }
                })
            }
        })
    });
})