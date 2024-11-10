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
                        return '<div class="d-flex"><button type="button" id="delBtn" class="btn btn-danger" data-id="' + row.id + '"><i class="bi bi-archive"></i> Archive</button></div>';
                    }
                }
            ]
        })  
    }

    $.ajax({
        url: 'APIs/AdminAccountsAPI/getAdminAccounts.php',
        type: 'GET',
        dataType: 'json',
        success: function(data) {
            getData(data)
        },
        error: function(error) {
            console.error("An error occurred:", error);
        }
    });

    $('#adminAccTbl').on('click', '#delBtn', function() {
        var rowId = $(this).data('id');
        Swal.fire({
            icon:"question",
            text:"Are you sure you want to move this admin account from archive?",
            showCancelButton: true,
            confirmButtonText: "Yes"
        }).then((result)=>{
            if(result.isConfirmed){
                $.ajax({
                    url: 'APIs/AdminAccountsAPI/archivedAdmin.php',
                    type: 'POST',
                    data: {
                        id: rowId,
                    },
                    success: function(data) {
                        Swal.fire({
                            icon: 'success',
                            title: 'Admin Account Archived!',
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

    $('#adminAccTbl').on('click', '#updtBtn', function() {
        var rowId = $(this).data('id');
    });

   

    $('#addConfirm').click(function(){
        var form_data = new FormData();                  
        form_data.append('user', $('#user').val());
        form_data.append('email', $('#email').val());
        form_data.append('pass', $('#pass').val());
        form_data.append('file', $('#image').prop('files')[0]);
        form_data.append('age', $('#age').val());
        form_data.append('Number', $('#Number').val());
        form_data.append('address', $('#address').val());
        $.ajax({
            url: 'APIs/AdminAccountsAPI/addAdminAccount.php',
            type: 'POST',
            data:form_data,
            contentType: false,
            processData: false,
            success: function(data) {
                Swal.fire({
                    icon: "success",
                    text: "Account Added!",
                    timer:1000,
                    showConfirmButton: false
                }).then(() => {
                    $("#addAcc").find(':input').val('');
                    $('#addAcc').modal('hide');
                    location.reload();
                })
            },
            error: function(error) {
                console.error("An error occurred:", error);
            }
        });
    })

    
})