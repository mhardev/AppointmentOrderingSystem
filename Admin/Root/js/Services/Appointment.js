$(document).ready(function () {

    function getData(data) {
        var pendingData = data.filter(function (row) {
            return row.status === "Pending";
        });

        // Destroy the existing DataTable instance
        if ($.fn.DataTable.isDataTable('#servRepTbl')) {
            $('#servRepTbl').DataTable().destroy();
        }

        $('#servRepTbl').dataTable({
            "aaData": pendingData,
            "order": [
                [3, "desc"]
            ],
            "columns": [
                { "data": "id" },
                { "data": "user_id" },
                { "data": "services_name" },
                {
                    "data": "appointment_date",
                    "type": "date" // Specify the type as 'date' for proper sorting
                },
                { "data": "appointment_type" },
                { "data": "total_cost" },
                { "data": "status" },
                {
                    "data": null,
                    "render": function (data, type, row) {
                        if (row.status == "Complete") {
                            return '<button type="button" id="updtBtn" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#updtApp" data-id="' + row.id + '">Update</button>'
                        }
                        return '<button type="button" id="updtBtn" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#updtApp" data-id="' + row.id + '">Update</button>'
                    }
                }
            ]
        });
    }

    $('#servRepTbl').on('click', '#updtBtn', function () {
        var rowId = $(this).data('id');
        $('#appId').val(rowId);

    });

    $('#appStatus').on('change', function () {
        Swal.fire({
            icon: "question",
            text: "Are you sure to proceed?",
            showCancelButton: true,
            confirmButtonText: "Save"
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: 'APIs/AppointmentsAPI/updateAppointStatus.php',
                    type: 'POST',
                    data: { id: $('#appId').val(), status: $('#appStatus').val() },
                    success: function (data) {
                        Swal.fire({
                            icon: "success",
                            text: "Status Updated!",
                            timer: 1000,
                            showConfirmButton: false
                        }).then(() => {
                            $("#updtApp").find(':input').val('');
                            $('#updtApp').modal('hide');
                            // Refresh the data without reloading the page
                            $.ajax({
                                url: 'APIs/ServicesAPI/getAppointments.php',
                                type: 'GET',
                                dataType: 'json',
                                success: function (data) {
                                    getData(data);
                                },
                                error: function (error) {
                                    console.error("An error occurred:", error);
                                }
                            });
                        });
                    },
                    error: function (error) {
                        console.error("An error occurred:", error);
                    }
                });
            }
        })
    })

    // Initial load of data
    $.ajax({
        url: 'APIs/ServicesAPI/getAppointments.php',
        type: 'GET',
        dataType: 'json',
        success: function (data) {
            getData(data);
        },
        error: function (error) {
            console.error("An error occurred:", error);
        }
    });
})
