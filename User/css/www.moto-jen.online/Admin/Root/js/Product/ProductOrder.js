$(document).ready(function(){
   
    function getData(data){
        var filteredData = data.filter(function (row) {
            return row.order_status === 'pending';
        });
        $('#prodOrdTbl').dataTable( {
            "aaData": filteredData,
            "order": [
                [4, "desc"]
            ],
            "columns": [
                { "data": "id" },
                { "data": "name" },
                { "data": "number" },
                { "data": "address" },
                { "data": "place_on" },
                { "data": "total_price" },
                { 
                    "data": "proof_of_purchase",
                    "render": function (data, type, row) {
                        // Assuming 'image' is the file directory
                        // You can replace 'your_image_directory/' with your actual image directory
                        return '<img src="../Root/img/ProductOrderProofs/' + data + '" alt="'+ data+'" style="max-width: 100px; max-height: 100px;" />';
                    }
                },
                { "data": "order_status" },
                {
                    "data": null,
                    "render": function (data, type, row) {
                        return '<div class="container">'+
                                '<div class="row">'+
                                '<div class="col">'+
                                '<button type="button" id="viewBtn" class="btn btn-success mx-1" data-bs-toggle="modal" data-bs-target="#viewOrder" data-id="' + row.id + '"><span><i class="bi bi-info-circle"></i></span></button>'+
                                '<button type="button" id="updtBtn" class="btn btn-primary mx-1" data-bs-toggle="modal" data-bs-target="#updtOrder" data-id="' + row.id + '"><span><i class="bi bi-pencil"></i></span></button>'+
                                '<button type="button" id="delBtn" class="btn btn-danger mx-1"data-id="' + row.id + '"><span><i class="bi bi-trash"></i></span></button>'+
                                '</div>'+
                                '</div>'+
                                '</div>';
                    }
                }
            ]
        })  
    }
    
    $.ajax({
        url: 'APIs/ProductAPI/getOrders.php',
        type: 'GET',
        dataType: 'json',
        success: function(data) {
            getData(data)
        },
        error: function(error) {
            console.error("An error occurred:", error);
        }
    });

    $('#prodOrdTbl').on('click', '#updtBtn', function() {
        var rowId = $(this).data('id');
        $('#orderId').val(rowId);
        
    });

    $('#prodOrdTbl').on('click', '#viewBtn', function() {
        var rowId = $(this).data('id');
        $.ajax({
            url: 'APIs/ProductAPI/getOrderDetails.php',
            type: 'GET',
            data: {
                id: rowId,
            },
            dataType: 'json',
            success: function(data) {
                $('#payMeth').val(data[0].payment_method);
                $('#refNo').val(data[0].reference_no);
                $('#payAmount').val(data[0].payment_amount);
                $('#payType').val(data[0].payment_type);
                $('#remainBal').val(data[0].remaining_bal);
                $('#prodOrder').val(data[0].total_products);
            },
            error: function(error) {
                alert(error);
            }
        });
    });

    $('#orderStatus').on('change',function(){
        Swal.fire({
            icon:"question",
            text:"Are you sure to proceed?",
            showCancelButton: true,
            confirmButtonText: "Save"
        }).then((result)=>{
            if(result.isConfirmed){
                $.ajax({
                    url: 'APIs/ProductAPI/updateorder.php',
                    type: 'POST',
                    data:{id:$('#orderId').val(),status:$('#orderStatus').val()},
                    success: function(data) {
                        Swal.fire({
                            icon: "success",
                            text: "Status Updated!",
                            timer:1000,
                            showConfirmButton: false
                        }).then(() => {
                            $("#updtOrder").find(':input').val('');
                            $('#updtOrder').modal('hide');
                            location.reload();
                        })
                    },
                    error: function(error) {
                        console.error("An error occurred:", error);
                    }
                });
            }
        })
    })

    $('#prodOrdTbl').on('click', '#delBtn', function() {
        var rowId = $(this).data('id');
        Swal.fire({
            icon:"question",
            text:"Are you sure you want to delete this?",
            showCancelButton: true,
            confirmButtonText: "Yes"
        }).then((result)=>{
            if(result.isConfirmed){
                $.ajax({
                    url: 'APIs/ProductAPI/deleteProductOrder.php',
                    type: 'POST',
                    data: {
                        id: rowId,
                    },
                    success: function(data) {
                        Swal.fire({
                            icon: 'success',
                            title: 'Product Deleted!',
                            showConfirmButton: false,
                            timer: 1500
                        }).then(() => {
                            $('#deleteOrder').modal('hide');
                            location.reload();
                        })
                    },
                    error: function(error) {
                        alert(error);
                    }
                });
            }
        })
    });

})