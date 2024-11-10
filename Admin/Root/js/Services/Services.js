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
                        return '<div class="d-flex"><button type="button" id="updtBtn" class="btn btn-primary mx-3" data-bs-toggle="modal" data-bs-target="#updateService" data-id="' + row.id + '"><i class="bi bi-pencil"></i> Update</button>'+
                                '<button type="button" id="delBtn" class="btn btn-danger" data-id="' + row.id + '"><i class="bi bi-trash"></i> Archive</button></div>';
                    }
                }
            ]
        })  
    }

    $.ajax({
        url: 'APIs/ServicesAPI/getServices.php',
        type: 'GET',
        dataType: 'json',
        success: function(data) {
            getData(data)
        },
        error: function(error) {
            console.error("An error occurred:", error);
        }
    });

    
    $('#servTbl').on('click', '#delBtn', function() {
        var rowId = $(this).data('id');
        Swal.fire({
            icon:"question",
            text:"Are you sure you want to delete this?",
            showCancelButton: true,
            confirmButtonText: "Yes"
        }).then((result)=>{
            if(result.isConfirmed){
                $.ajax({
                    url: 'APIs/ServicesAPI/archivedService.php',
                    type: 'POST',
                    data: {
                        id: rowId,
                    },
                    success: function(data) {
                        Swal.fire({
                            icon: 'success',
                            title: 'Service Archived!',
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

    $('#ServAdd').click(function(){
        $.ajax({
            url: 'APIs/ServicesAPI/addService.php',
            type: 'POST',
            data: {
                name: $('#ServName').val(),
                price: $('#ServPrice').val()
            },
            success: function(data) {
                Swal.fire({
                    icon: 'success',
                    title: 'Service Added!',
                    showConfirmButton: false,
                    timer: 1500
                }).then(() => {
                    $("#addService").find(':input').val('');
                    $('#addService').modal('hide');
                    location.reload();
                })
            },
            error: function(error) {
                alert(error);
            }
        });
    })

    $('#servTbl').on('click', '#updtBtn', function() {
        var rowId = $(this).data('id');
        $('#servId').val(rowId);
        $.ajax({
            url: 'APIs/ServicesAPI/getService.php',
            type: 'GET',
            data:{
                id: rowId,
            },
            dataType: 'json',
            success: function(data) {
                console.log(data[0])
                $('#servName').val(data[0].services_name);
                $('#servPrice').val(data[0].services_price);
            },
            error: function(error) {
                alert(error);
            }
        });
    });

    $('#updtServ').click(function(){
        $.ajax({
            url: 'APIs/ServicesAPI/updateService.php',
            type: 'POST',
            data: {
                id:$('#servId').val(),
                name: $('#servName').val(),
                price: $('#servPrice').val()
            },
            success: function(data) {
                Swal.fire({
                    icon: 'success',
                    title: 'Service Updated!',
                    showConfirmButton: false,
                    timer: 1500
                }).then(() => {
                    $("#updateService").find(':input').val('');
                    $('#updateService').modal('hide');
                    location.reload();
                })
            },
            error: function(error) {
                alert(error);
            }
        });
    })
})