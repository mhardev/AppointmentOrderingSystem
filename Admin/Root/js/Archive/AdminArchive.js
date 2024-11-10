$(document).ready(function(){

    function getData(data){
        $('#adminAccTbl').dataTable( {
            "aaData": data,
            "columns": [
                { "data": "id" },
                { "data": "username" },
                { "data": "email" },
                { "data": "age" },
                { "data": "address" },
                { 
                    "data": "image",
                    "render": function (data, type, row) {
                        // Assuming 'image' is the file directory
                        // You can replace 'your_image_directory/' with your actual image directory
                        return '<img src="Root/img/admin/' + data + '" alt="Product Image" style="max-width: 100px; max-height: 100px;" />';
                    }
                },
                {
                    "data": null,
                    "render": function (data, type, row) {
                        return '<div class="d-flex"><button type="button" id="rtvBtn" class="btn btn-primary mx-1" data-id="' + row.id + '"><i class="bi bi-arrow-repeat"></i> Retrieve</button>'+
                        '<button type="button" id="delBtn" class="btn btn-danger" data-id="' + row.id + '"><i class="bi bi-trash"></i> Delete</button></div>';
                    }
                }
            ]
        })  
    }

    $.ajax({
        url: 'APIs/ArchiveAPI/getAdminArchived.php',
        type: 'GET',
        dataType: 'json',
        success: function(data) {
            getData(data)
        },
        error: function(error) {
            console.error("An error occurred:", error);
        }
    });

    $('#adminAccTbl').on('click', '#rtvBtn', function () {
        var rowId = $(this).data('id');
        Swal.fire({
            icon: "question",
            text: "Are you sure you want to retrieve this admin account?",
            showCancelButton: true,
            confirmButtonText: "Yes"
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: 'APIs/ArchiveAPI/getAdminRetrieved.php',
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

    $('#adminAccTbl').on('click', '#delBtn', function() {
        var rowId = $(this).data('id');
        Swal.fire({
            icon:"question",
            text:"Are you sure you want to delete this admin account?",
            showCancelButton: true,
            confirmButtonText: "Yes"
        }).then((result)=>{
            if(result.isConfirmed){
                $.ajax({
                    url: 'APIs/ArchiveAPI/getAdminDelete.php',
                    type: 'POST',
                    data: {
                        id: rowId,
                    },
                    success: function(data) {
                        Swal.fire({
                            icon: 'success',
                            title: 'Admin Account Deleted!',
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