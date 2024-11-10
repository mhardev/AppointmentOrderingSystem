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
                        return '<button type="button" id="rtvBtn" class="btn btn-primary mx-3" data-id="' + row.supplier_id + '"><i class="bi bi-arrow-repeat"></i> Retrieve</button>'+
                         '<button type="button" id="delBtn" class="btn btn-danger" data-id="' + row.supplier_id + '"><i class="bi bi-archive"></i> Archive</button></div>';
                    }
                }
            ]
        })  
    }

    $.ajax({
        url: 'APIs/ArchiveAPI/getSupplierArchived.php',
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
            text:"Are you sure you want to delete this supplier?",
            showCancelButton: true,
            confirmButtonText: "Yes"
        }).then((result)=>{
            if(result.isConfirmed){
                $.ajax({
                    url: 'APIs/ArchiveAPI/getSupplierDelete.php',
                    type: 'POST',
                    data: {
                        supplier_id: rowId,
                    },
                    success: function(data) {
                        Swal.fire({
                            icon: 'success',
                            title: 'Supplier Deleted!',
                            showConfirmButton: false,
                            timer: 1500
                        }).then(() => {
                            $('.modal').modal('hide');
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

    $('#suppTbl').on('click', '#rtvBtn', function () {
        var rowId = $(this).data('id');
        Swal.fire({
            icon: "question",
            text: "Are you sure you want to retrieve this supplier?",
            showCancelButton: true,
            confirmButtonText: "Yes"
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: 'APIs/ArchiveAPI/getSupplierRetrieved.php',
                    type: 'POST',
                    data: {
                        supplier_id: rowId,
                    },
                    success: function (data) {
                        Swal.fire({
                            icon: 'success',
                            title: 'Supplier Retrieved!',
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
})