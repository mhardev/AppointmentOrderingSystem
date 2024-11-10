$(document).ready(function(){

    function getData(data){
        $('#servTbl').dataTable( {
            "aaData": data,
            "columns": [
                { "data": "id" },
                { "data": "services_name" },
                { "data": "services_price" },
                {
                    "data": null,
                    "render": function (data, type, row) {
                        return '<div class="container">'+
                                '<div class="row">'+
                                '<div class="col">'+
                                '<button type="button" id="rtvBtn" class="btn btn-primary mx-1" data-id="' + row.id + '"><i class="bi bi-arrow-repeat"></i> Retrieve</button>'+
                                '<button type="button" id="delBtn" class="btn btn-danger" data-id="' + row.id + '"><i class="bi bi-trash"></i> Delete</button>'+
                                '</div>'+
                                '</div>'+
                                '</div>';
                    }
                }
            ]
        })  
    }

    $.ajax({
        url: 'APIs/ArchiveAPI/getServicesArchived.php',
        type: 'GET',
        dataType: 'json',
        success: function(data) {
            getData(data)
        },
        error: function(error) {
            console.error("An error occurred:", error);
        }
    });

    $('#servTbl').on('click', '#rtvBtn', function () {
        var rowId = $(this).data('id');
        Swal.fire({
            icon: "question",
            text: "Are you sure you want to retrieve this service?",
            showCancelButton: true,
            confirmButtonText: "Yes"
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: 'APIs/ArchiveAPI/getServicesRetrieved.php',
                    type: 'POST',
                    data: {
                        id: rowId,
                    },
                    success: function (data) {
                        Swal.fire({
                            icon: 'success',
                            title: 'Service Retrieved!',
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

    $('#servTbl').on('click', '#delBtn', function() {
        var rowId = $(this).data('id');
        Swal.fire({
            icon:"question",
            text:"Are you sure you want to delete this service?",
            showCancelButton: true,
            confirmButtonText: "Yes"
        }).then((result)=>{
            if(result.isConfirmed){
                $.ajax({
                    url: 'APIs/ArchiveAPI/getServicesDelete.php',
                    type: 'POST',
                    data: {
                        id: rowId,
                    },
                    success: function(data) {
                        Swal.fire({
                            icon: 'success',
                            title: 'Service Deleted!',
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
})