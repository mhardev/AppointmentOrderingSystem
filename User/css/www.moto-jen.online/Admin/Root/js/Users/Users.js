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
                        return '<button type="button" id="delBtn" class="btn btn-danger" data-id="' + row.id + '"><i class="bi bi-trash"></i></button></div>';
                    }
                }
            ]
        })  
    }
    $.ajax({
        url: 'APIs/UsersAPI/getUsers.php',
        type: 'GET',
        dataType: 'json',
        success: function(data) {
            getData(data)
        },
        error: function(error) {
            console.error("An error occurred:", error);
        }
    });

    $('#example').on('click', '#delBtn', function() {
        var rowId = $(this).data('id');
        Swal.fire({
            icon:"question",
            text:"Are you sure you want to delete this?",
            showCancelButton: true,
            confirmButtonText: "Yes"
        }).then((result)=>{
            if(result.isConfirmed){
                $.ajax({
                    url: 'APIs/UsersAPI/archivedUser.php',
                    type: 'POST',
                    data: {
                        id: rowId,
                    },
                    success: function(data) {
                        Swal.fire({
                            icon: 'success',
                            title: 'User Archived!',
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