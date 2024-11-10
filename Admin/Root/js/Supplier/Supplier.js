$(document).ready(function(){

    function getData(data){
        $('#suppTbl').dataTable( {
            "aaData": data,
            "columns": [
                { "data": "supplier_id" },
                { "data": "supplier_name" },
                { "data": "supplier_address" },
                { "data": "contact_no" },
                { "data": "contact_person" },
                {
                    "data": null,
                    "render": function (data, type, row) {
                        return '<button type="button" id="addBtn" class="btn btn-primary mx-2" data-bs-toggle="modal" data-bs-target="#addProd" data-id="' + row.supplier_id + '"><i class="bi bi-plus"></i> Add Product</button>'+
                         '<button type="button" id="delBtn" class="btn btn-danger" data-id="' + row.supplier_id + '"><i class="bi bi-archive"></i> Archive</button></div>';
                    }
                }
            ]
        })  
    }

    $.ajax({
        url: 'APIs/SupplierAPI/getSupplier.php',
        type: 'GET',
        dataType: 'json',
        success: function(data) {
            getData(data)
        },
        error: function(error) {
            console.error("An error occurred:", error);
        }
    });

    $('#suppTbl').on('click', '#delBtn', function() {
        var rowId = $(this).data('id');
        Swal.fire({
            icon:"question",
            text:"Are you sure you want to move this supplier to archive?",
            showCancelButton: true,
            confirmButtonText: "Yes"
        }).then((result)=>{
            if(result.isConfirmed){
                $.ajax({
                    url: 'APIs/SupplierAPI/archivedSuppliers.php',
                    type: 'POST',
                    data: {
                        supplier_id: rowId,
                    },
                    success: function(data) {
                        Swal.fire({
                            icon: 'success',
                            title: 'Supplier Archived!',
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

    $('#suppTbl').on('click', '#addBtn', function() {
        var rowId = $(this).data('id');
        $('#suppId').val(rowId);
    });

    $('#addProdCfrm').click(function(){
        var form_data = new FormData();                  
        form_data.append('supplier_id', $('#suppId').val());
        form_data.append('product_name', $('#prodName').val());
        form_data.append('product_price', $('#prodPrice').val());
        form_data.append('file', $('#prodFile').prop('files')[0]);
        form_data.append('product_category', $('#prodCat').val());
        form_data.append('product_stock', $('#prodStock').val());
        $.ajax({
            url: 'APIs/SupplierAPI/addsupplierproducts.php',
            type: 'POST',
            data:form_data,
            contentType: false,
            processData: false,
            success: function(data) {
                Swal.fire({
                    icon: "success",
                    text: "Product Added!",
                    timer:1000,
                    showConfirmButton: false
                }).then(() => {
                    $("#addProd").find(':input').val('');
                    $('#addProd').modal('hide');
                    location.reload();
                })
            },
            error: function(error) {
                console.error("An error occurred:", error);
            }
        });
    })

    $('#addSuppBtn').click(function(){
        $.ajax({
            url: 'APIs/SupplierAPI/addsuppliers.php',
            type: 'POST',
            data:{supplier_name:$('#ShopName').val(),supplier_address:$('#SuppAdd').val(),contact_no:$('#SuppNum').val(),contact_person:$('#SuppPerson').val()},
            success: function(data) {
                Swal.fire({
                    icon: "success",
                    text: "Supplier Added!",
                    timer:1000,
                    showConfirmButton: false
                }).then(() => {
                    $("#addSupp").find(':input').val('');
                    $('#addSupp').modal('hide');
                    location.reload();
                })
            },
            error: function(error) {
                console.error("An error occurred:", error);
            }
        });
    })
})