$(document).ready(function(){

    function getData(data){
        $('#example').dataTable( {
            "aaData": data,
            "columns": [
                { "data": "name" },
                { "data": "email" },
                { "data": "number" },
                { "data": "address" },
                { "data": "status" },
                {
                    "data": null,
                    "render": function (data, type, row) {
                        return '<div class="d-flex"><button type="button" id="rtvBtn" class="btn btn-primary mx-1" data-id="' + row.id + '"><i class="bi bi-arrow-repeat"></i></button>'+
                        '<button type="button" id="delBtn" class="btn btn-danger" data-id="' + row.id + '"><i class="bi bi-trash"></i></button></div>';
                    }
                }
            ]
        })  
    }

    $.ajax({
        url: 'APIs/ArchiveAPI/getUserArchived.php',
        type: 'GET',
        dataType: 'json',
        success: function(data) {
            getData(data)
        },
        error: function(error) {
            console.error("An error occurred:", error);
        }
    });

    $('#example').on('click', '#rtvBtn', function () {
        var rowId = $(this).data('id');
        Swal.fire({
            icon: "question",
            text: "Are you sure you want to retrieve this user account?",
            showCancelButton: true,
            confirmButtonText: "Yes"
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: 'APIs/ArchiveAPI/getUserRetrieved.php',
                    type: 'POST',
                    data: {
                        id: rowId,
                    },
                    success: function (data) {
                        Swal.fire({
                            icon: 'success',
                            title: 'User Retrieved!',
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

    $('#example').on('click', '#delBtn', function() {
        var rowId = $(this).data('id');
        Swal.fire({
            icon:"question",
            text:"Are you sure you want to delete this user account?",
            showCancelButton: true,
            confirmButtonText: "Yes"
        }).then((result)=>{
            if(result.isConfirmed){
                $.ajax({
                    url: 'APIs/ArchiveAPI/getUserDelete.php',
                    type: 'POST',
                    data: {
                        id: rowId,
                    },
                    success: function(data) {
                        Swal.fire({
                            icon: 'success',
                            title: 'User Account Deleted!',
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