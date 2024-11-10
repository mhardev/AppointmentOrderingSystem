
<?php include('config/dbcon.php');
session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MOTO-JEN | Services</title>
    <link rel="icon" type="image/x-icon" href="images/motojenlogofinal.png">
    <!-- font awesome cdn link  -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <!-- custom css file link  -->
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <link rel="stylesheet" href="css/style.css">
    <!---Aos animation link-->
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    <!-- Add these lines to your head section -->
    <!-- Add this line to include the fullCalendar library -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.10.2/fullcalendar.min.css" integrity="sha512-xpX+TgW6behiI1/RQzrRSF3VoNxXe7h3h5bNrLj+yiQ/k6MLxp5+sEQ9p0dH37Z4KNsI8vjfd4yBYH1XIpJX4A==" crossorigin="anonymous" />

    <!-- Add the fullCalendar script -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.10.2/fullcalendar.min.js" integrity="sha512-R7BVYvM7PnuGm1omWXME4SDdjmSFvf0DX6nRw2Y4yZzp1M7M+kK0qgx/jD0/qhwwJ4dH4dn0U+/6tA4itT1QlA==" crossorigin="anonymous"></script>

</head>

<body>
    <header class="header">
        <?php
        include "./pages/sections/navbar.php"
        ?>
    </header>
    <div class="heading" style="padding-bottom: 5vmin;">
        <h3>Moto-Jen Services</h3>
        <p><a href="home.php">Home </a> <span> / Services</span></p>
    </div>

    <section class="service-class" style="padding-top: 2vmin; max-width: 90%;">
        <div class="row">
            <h2 style="text-align:center;">Select services</h2>
            <div class="btn-group" id="checkboxes" role="group" aria-label="Basic checkbox toggle button group">
            </div>
        </div>
    </section>
    <br>
    <section class="service-class" style="padding-top: 2vmin; max-width: 90%;">
        <h3>Total Amount</h3>
        <div class="input-group mb-3">
            <input type="text" class="form-control" id="price" placeholder="0" aria-label="Username" aria-describedby="basic-addon1" readonly>
        </div>
    </section>
    <br>
    <section class="service-class" style="padding-top: 2vmin; max-width: 90%;">
        <h3>Set appointment date</h3>
        <div id="calendar"></div>
    </section>
    <br>
    <section class="service-class" style="padding-top: 2vmin; padding-bottom: 4vmin; max-width: 90%;">
        <h3>Select schedule</h3>
        <input type="hidden" id="appDate"> <!-- Add this line to define the appDate variable -->
        <input class="btn btn-primary" type="submit" id="checkSlots" value="Check Available Slots" style="width:100%;">
        <button class="btn btn-primary" type="button" id="CheckerApp1Btn" disabled style="width:100%;">Morning slots available 0/0</button>
        <button class="btn btn-primary" type="button" id="CheckerApp2Btn" disabled style="width:100%;">Afternoon slots available 0/0</button>
    </section>
    <script>
        $(document).ready(function() {
            var price = 0;
            var services = '';
            $.ajax({
                url: 'getServices.php',
                type: 'GET',
                dataType: 'json',
                success: function(data) {
                    $.each(data, function(key, value) {

                        $('.btn-group').append(
                            `<input style="display:none;" type="checkbox" name="sample" class="btn-check" id="${value.id}" autocomplete="off">
                            <label class="btn btn-outline-primary me-2 " value=${value.services_price} for="${value.id}">${value.services_name} - ${value.services_price} </label>`
                        )
                        $('#' + value.id).on('click', function() {
                            if ($(this).is(':checked')) {
                                console.log(`Checkbox "${value.services_name}" is checked.`);
                                price += parseInt(value.services_price)
                                services += `${value.services_name},`
                                $('#price').val(price.toFixed(2));
                            } else {
                                price -= parseInt(value.services_price)
                                $('#price').val(price.toFixed(2));
                                services -= `${value.services_name}`
                            }
                        });
                    });


                },
                error: function(error) {
                    console.error("An error occurred:", error);
                }
            });

            $('#calendar').fullCalendar({
                defaultView: 'month',
                editable: true,
                eventStartEditable: true,
                selectable: true,
                header: {
                    left: 'prev,next today',
                    center: 'title',
                    right: 'month,agendaWeek,agendaDay'
                },
                // Add event click and select callbacks
                eventClick: function(calEvent, jsEvent, view) {
                    $('#appDate').val(calEvent.start.format('YYYY-MM-DD'));
                },
                select: function(start, end, allDay) {
                    $('#appDate').val(start.format('YYYY-MM-DD'));
                }
            });


            $('#checkSlots').click(function() {
                $.ajax({
                    url: 'checkAppointmentSlots.php',
                    type: 'GET',
                    data: {
                        date: $('#appDate').val()
                    },
                    dataType: 'json',
                    success: function(data) {
                        console.log(data)
                        if (data[0].morningApp == 5 && data[0].afternoonApp == 5) {
                            Swal.fire({
                                icon: "error",
                                text: "All slots are full. Please select another date.",
                                timer: 1000,
                                showConfirmButton: false
                            })
                        }

                        if (data[0].morningApp >= 1) {
                            var appslot1 = 5 - parseInt(data[0].morningApp)
                            $('#CheckerApp1Btn').text(`Morning slots available ${appslot1}/5`)

                        }

                        if (data[0].afternoonApp >= 1) {
                            var appslot2 = 5 - parseInt(data[0].afternoonApp)
                            $('#CheckerApp2Btn').text(`Afternoon slots available ${appslot2}/5`)
                        }

                        if (data[0].morningApp == 0) {
                            var appslot1 = 5 - parseInt(data[0].morningApp)
                            $('#CheckerApp1Btn').text(`Morning slots available 5/5`)

                        }

                        if (data[0].afternoonApp == 0) {
                            var appslot2 = 5 - parseInt(data[0].afternoonApp)
                            $('#CheckerApp2Btn').text(`Afternoon slots available 5/5`)
                        }

                        if (data[0].morningApp == 5) {
                            $('#CheckerApp1Btn').prop("disabled", true);
                        } else {
                            $('#CheckerApp1Btn').prop("disabled", false);
                        }

                        if (data[0].afternoonApp == 5) {
                            $('#CheckerApp2Btn').prop("disabled", true);
                        } else {
                            $('#CheckerApp2Btn').prop("disabled", false);
                        }

                    },
                    error: function(error) {
                        console.error("An error occurred:", error);
                    }
                });
            })

            $('#CheckerApp1Btn').click(function() {
                var appDate = new Date($('#appDate').val()).toISOString().slice(0,10);
                var currDate = new Date();
                var currentFormattedDate = currDate.toISOString().slice(0,10);
                console.log(appDate)
                console.log(currentFormattedDate)
                if (appDate >= currentFormattedDate) {
                    $.ajax({
                        url: 'checkAppointment1.php',
                        type: 'GET',
                        data: {
                            date: $('#appDate').val()
                        },
                        dataType: 'json',
                        success: function(data) {
                            $.ajax({
                                url: 'saveAppointment.php',
                                type: 'POST',
                                data: {
                                    services_name: services,
                                    appointment_date: `${$("#appDate").val()}`,
                                    appointment_type: 'morning',
                                    total_cost: price
                                },
                                success: function(data) {
                                    console.log(data)
                                    if (data != 0) {
                                        Swal.fire({
                                            icon: 'success',
                                            title: 'Appointment Submitted',
                                            showConfirmButton: false,
                                            timer: 800
                                        }).then(() => {
                                            location.reload()
                                        })
                                    }else{
                                        Swal.fire({
                                            icon: 'error',
                                            title: 'You must login first!',
                                            showConfirmButton: false,
                                            timer: 800
                                        })
                                    }

                                },
                                error: function(error) {
                                    alert(error);
                                }
                            });
                        },
                        error: function(data) {
                            alert('Error loading supplier names.');
                        }
                    });
                } else {
                    Swal.fire({
                        icon: 'error',
                        title: 'Date should be valid!',
                        showConfirmButton: false,
                        timer: 800
                    })
                }
            })

            $('#CheckerApp2Btn').click(function() {
                var appDate = new Date($('#appDate').val()).toLocaleDateString();;
                var currDate = new Date().toLocaleDateString();;
                if (appDate >= currDate) {
                    $.ajax({
                        url: 'checkAppointment1.php',
                        type: 'GET',
                        data: {
                            date: $('#appDate').val()
                        },
                        dataType: 'json',
                        success: function(data) {
                            $.ajax({
                                url: 'saveAppointment.php',
                                type: 'POST',
                                data: {
                                    services_name: services,
                                    appointment_date: `${$("#appDate").val()}`,
                                    appointment_type: 'afternoon',
                                    total_cost: price,
                                },
                                success: function(data) {
                                    if (data != 0) {
                                        Swal.fire({
                                            icon: 'success',
                                            title: 'Appointment Submitted',
                                            showConfirmButton: false,
                                            timer: 800
                                        }).then(() => {
                                            location.reload()
                                        })
                                    }else{
                                        Swal.fire({
                                            icon: 'error',
                                            title: 'You must login first!',
                                            showConfirmButton: false,
                                            timer: 800
                                        }).then(() => {
                                            location.reload()
                                        })
                                    }
                                },
                                error: function(error) {
                                    alert(error);
                                }
                            });
                        },
                        error: function(data) {
                            alert('Error loading supplier names.');
                        }
                    });
                } else {
                    Swal.fire({
                        icon: 'error',
                        title: 'Date should be valid!',
                        showConfirmButton: false,
                        timer: 800
                    })
                }
            })
        })
    </script>
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script>
        AOS.init();
    </script>
    <script src="js/script.js"></script>

</body>

</html>

<footer class="footer" style="padding-top: 4vmin;">
    <?php
    include "./pages/footer.php"
    ?>
</footer>