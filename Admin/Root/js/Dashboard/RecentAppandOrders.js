$(document).ready(function () {
    $.ajax({
        url: 'APIs/DashboardAPI/getNotification.php',
        type: 'GET',
        dataType: 'json',
        success: function (data) {
            if (data != null) {
                var select = $('#notif');
                $.each(data, function (key, value) {

                    if (value.Title == 'Appointments')
                        select.append(
                            `<p align="center"><a href="${value.Title}.php">An Appointment was made on ${value.appointment_date}</a></p>`
                        )

                    if (value.Title == 'ProductOrder')
                        select.append(
                            `<p align="center"><a href="${value.Title}.php">An Order was made on ${value.appointment_date}</a></p>`
                        )

                });
            } else {
                var select = $('#notif');
                select.append(
                    `<p align="center">No recent Appointments or Notifications</p>`
                )
            }

        },
        error: function (error) {
            console.error("An error occurred:", error);
        }
    });

    $.ajax({
        url: 'APIs/DashboardAPI/removeAppointments.php',
        type: 'POST',
        success: function (data) {
        },
        error: function (error) {
            alert(error);
        }
    });

})

