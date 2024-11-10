<?php include('config/dbcon.php');
session_start();
if (isset($_SESSION['user_id'])) {
    $user_id = $_SESSION['user_id'];
} else {
    $user_id = '';
};

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
        <div class="container-calendar input-group mb-3">

            <div class="button-container-calendar">

                <button id="previous">&#8249;</button>

                <button id="next">&#8250;</button>

                <h3 id="monthHeader"></h3>

                <p id="yearHeader"></p>

            </div>



            <table class="table-calendar" id="calendar">

                <thead id="thead-month"></thead>

                <tbody id="calendar-body"></tbody>

            </table>



            <div class="footer-container-calendar">

                <label for="month">Jump To: </label>

                <select id="month">

                    <option value=0>Jan</option>

                    <option value=1>Feb</option>

                    <option value=2>Mar</option>

                    <option value=3>Apr</option>

                    <option value=4>May</option>

                    <option value=5>Jun</option>

                    <option value=6>Jul</option>

                    <option value=7>Aug</option>

                    <option value=8>Sep</option>

                    <option value=9>Oct</option>

                    <option value=10>Nov</option>

                    <option value=11>Dec</option>

                </select>

                <select id="year"></select>

            </div>
        </div>
        <hr style="height:2px;border-width:0;color:gray;background-color:gray">
        <h2>Appointment Date:</h2>
        <input type="date" id="appDate"></input>
        <style>
            input[type="date"]::-webkit-calendar-picker-indicator {
                display: none;
            }
        </style>
        <hr style="height:2px;border-width:0;color:gray;background-color:gray">
    </section>
    <br>
    <section class="service-class" style="padding-top: 2vmin; padding-bottom: 4vmin; max-width: 90%;">
        <h3>Select schedule</h4>
        <input class="btn btn-primary" type="submit" id="checkSlots" value="Check Available Slots" style="width:100%;">
        <style>
            .timeBtn{
                background-color: #7CFC00;
                color: black;
            }
            
            .redDate {
                background-color: red; /* Customize the red color as needed */
            }

            .greenDate{
                background-color: #7CFC00;
            }

            .timeBtn{
                display: inline-block;
                cursor: pointer;
                font-size: 10px;
                text-transform: capitalize;
            }

            .redBtn {
                background-color: red;
                color: white; /* You can adjust the text color as needed */
                cursor: not-allowed;
            }

            .redBtn{
                display: inline-block;
                cursor: pointer;
                font-size: 10px;
                text-transform: capitalize;
            }
        </style>
        <table style="width: 100%;">
            <tr>
                <td><button class="btn btn-primary" type="button" id="CheckerApp1Btn" disabled style="width:100%; font-size:10px;">08:00 AM - 09:00 AM 0/0</button></td>
                <td><button class="btn btn-primary" type="button" id="CheckerApp2Btn" disabled style="width:100%; font-size:10px;">09:00 AM - 10:00 AM 0/0</button></td>
                <td><button class="btn btn-primary" type="button" id="CheckerApp3Btn" disabled style="width:100%; font-size:10px;">10:00 AM - 11:00 AM 0/0</button></td>
            </tr>
            <tr><td><button class="btn btn-primary" type="button" id="CheckerApp4Btn" disabled style="width:100%; font-size:10px;">11:00 AM - 12:00 NN 0/0</button></td>
                <td><button class="btn btn-primary" type="button" id="CheckerApp5Btn" disabled style="width:100%; font-size:10px;">01:00 PM - 02:00 PM 0/0</button></td>
                <td><button class="btn btn-primary" type="button" id="CheckerApp6Btn" disabled style="width:100%; font-size:10px;">02:00 PM - 03:00 PM 0/0</button></td>
            </tr>
            <tr>
                <td><button class="btn btn-primary" type="button" id="CheckerApp7Btn" disabled style="width:100%; font-size:10px;">03:00 PM - 04:00 PM 0/0</button></td>
                <td><button class="btn btn-primary" type="button" id="CheckerApp8Btn" disabled style="width:100%; font-size:10px;">04:00 PM - 05:00 PM 0/0</button></td>
            </tr>
        </table>
    </section>
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
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
                            <label style="font-size:1.5rem;"class="btn btn-outline-primary me-2 " value=${value.services_price} for="${value.id}">${value.services_name} - ${parseFloat(value.services_price).toFixed(2)} </label>`
                        )
                        $('#' + value.id).on('click', function() {
                            if ($(this).is(':checked')) {
                                console.log(`Checkbox "${value.services_name}" is checked.`);
                                price += parseInt(value.services_price);
                                services += `${value.services_name},`;
                                $('#price').val(price.toFixed(2)); // Use toFixed() to ensure 2 digits after the decimal point
                            } else {
                                price -= parseInt(value.services_price);
                                $('#price').val(price.toFixed(2)); // Use toFixed() to ensure 2 digits after the decimal point
                                services -= `${value.services_name}`;
                            }
                        });
                    });


                },
                error: function(error) {
                    console.error("An error occurred:", error);
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
                        console.log(data);
                        // Pass the available slots data to the showCalendar function
                        showCalendar(currentMonth, currentYear, data[0].availableSlots);
                        if (data[0].mornA == 2 && data[0].mornB == 2 && data[0].mornC == 2 && data[0].mornD == 2 
                        && data[0].afterA == 2 && data[0].afterB == 2 && data[0].afterC == 2 && data[0].afterD == 2) {
                            Swal.fire({
                                icon: "error",
                                text: "All slots are full. Please select another date.",
                                timer: 1000,
                                showConfirmButton: false
                            })
                        }

                        if (data[0].mornA >= 1) {
                            var appslot1 = 2 - parseInt(data[0].mornA)
                            $('#CheckerApp1Btn').text(`08:00 AM - 09:00 AM ${appslot1}/2`)
                        }

                        if (data[0].mornB >= 1) {
                            var appslot2 = 2 - parseInt(data[0].mornB)
                            $('#CheckerApp2Btn').text(`09:00 AM - 10:00 AM ${appslot2}/2`)
                        }

                        if (data[0].mornC >= 1) {
                            var appslot3 = 2 - parseInt(data[0].mornC);
                            $('#CheckerApp3Btn').text(`10:00 AM - 11:00 AM ${appslot3}/2`);
                        }

                        if (data[0].mornD >= 1) {
                            var appslot4 = 2 - parseInt(data[0].mornD);
                            $('#CheckerApp4Btn').text(`11:00 AM - 12:00 NN ${appslot4}/2`);
                        }

                        if (data[0].afterA >= 1) {
                            var appslot5 = 2 - parseInt(data[0].afterA);
                            $('#CheckerApp5Btn').text(`01:00 PM - 02:00 PM ${appslot5}/2`);
                        }

                        if (data[0].afterB >= 1) {
                            var appslot6 = 2 - parseInt(data[0].afterB);
                            $('#CheckerApp6Btn').text(`02:00 PM - 03:00 PM ${appslot6}/2`);
                        }

                        if (data[0].afterC >= 1) {
                            var appslot7 = 2 - parseInt(data[0].afterC);
                            $('#CheckerApp7Btn').text(`03:00 PM - 04:00 PM ${appslot7}/2`);
                        }

                        if (data[0].afterD >= 1) {
                            var appslot8 = 2 - parseInt(data[0].afterD);
                            $('#CheckerApp8Btn').text(`04:00 PM - 05:00 PM ${appslot8}/2`);
                        }

                        if (data[0].mornA == 0) {
                            var appslot1 = 2 - parseInt(data[0].mornA)
                            $('#CheckerApp1Btn').text(`08:00 AM - 09:00 AM 2/2`)

                        }

                        if (data[0].mornB == 0) {
                            var appslot2 = 2 - parseInt(data[0].mornB)
                            $('#CheckerApp2Btn').text(`09:00 AM - 10:00 AM 2/2`)
                        }

                        if (data[0].mornC == 0) {
                            var appslot3 = 2 - parseInt(data[0].mornC);
                            $('#CheckerApp3Btn').text(`10:00 AM - 11:00 AM 2/2`);
                        }

                        if (data[0].mornD == 0) {
                            var appslot4 = 2 - parseInt(data[0].mornD);
                            $('#CheckerApp4Btn').text(`11:00 AM - 12:00 NN 2/2`);
                        }

                        if (data[0].afterA == 0) {
                            var appslot5 = 2 - parseInt(data[0].afterA);
                            $('#CheckerApp5Btn').text(`01:00 PM - 02:00 PM 2/2`);
                        }

                        if (data[0].afterB == 0) {
                            var appslot6 = 2 - parseInt(data[0].afterB);
                            $('#CheckerApp6Btn').text(`02:00 PM - 03:00 PM 2/2`);
                        }

                        if (data[0].afterC == 0) {
                            var appslot7 = 2 - parseInt(data[0].afterC);
                            $('#CheckerApp7Btn').text(`03:00 PM - 04:00 PM 2/2`);
                        }

                        if (data[0].afterD == 0) {
                            var appslot8 = 2 - parseInt(data[0].afterD);
                            $('#CheckerApp8Btn').text(`04:00 PM - 05:00 PM 2/2`);
                        }

                        if (data[0].mornA == 2) {
                            $('#CheckerApp1Btn').prop("disabled", true);
                        } else {
                            $('#CheckerApp1Btn').prop("disabled", false);
                        }

                        if (data[0].mornB == 2) {
                            $('#CheckerApp2Btn').prop("disabled", true);
                        } else {
                            $('#CheckerApp2Btn').prop("disabled", false);
                        }

                        if (data[0].mornC == 2) {
                            $('#CheckerApp3Btn').prop("disabled", true);
                        } else {
                            $('#CheckerApp3Btn').prop("disabled", false);
                        }

                        if (data[0].mornD == 2) {
                            $('#CheckerApp4Btn').prop("disabled", true);
                        } else {
                            $('#CheckerApp4Btn').prop("disabled", false);
                        }

                        if (data[0].afterA == 2) {
                            $('#CheckerApp5Btn').prop("disabled", true);
                        } else {
                            $('#CheckerApp5Btn').prop("disabled", false);
                        }

                        if (data[0].afterB == 2) {
                            $('#CheckerApp6Btn').prop("disabled", true);
                        } else {
                            $('#CheckerApp6Btn').prop("disabled", false);
                        }

                        if (data[0].afterC == 2) {
                            $('#CheckerApp7Btn').prop("disabled", true);
                        } else {
                            $('#CheckerApp7Btn').prop("disabled", false);
                        }

                        if (data[0].afterD == 2) {
                            $('#CheckerApp8Btn').prop("disabled", true);
                        } else {
                            $('#CheckerApp8Btn').prop("disabled", false);
                        }



                        if (data[0].mornA == 0 || data[0].mornA >= 1) {
                            $('#CheckerApp1Btn').addClass('timeBtn');
                        } else {
                            $('#CheckerApp1Btn').removeClass('timeBtn');
                        }

                        if (data[0].mornB == 0 || data[0].mornB >= 1) {
                            $('#CheckerApp2Btn').addClass('timeBtn');
                        } else {
                            $('#CheckerApp2Btn').removeClass('timeBtn');
                        }

                        if (data[0].mornC == 0 || data[0].mornC >= 1) {
                            $('#CheckerApp3Btn').addClass('timeBtn');
                        } else {
                            $('#CheckerApp3Btn').removeClass('timeBtn');
                        }

                        if (data[0].mornD == 0 || data[0].mornD >= 1) {
                            $('#CheckerApp4Btn').addClass('timeBtn');
                        } else {
                            $('#CheckerApp4Btn').removeClass('timeBtn');
                        }

                        if (data[0].afterA == 0 || data[0].afterA >= 1) {
                            $('#CheckerApp5Btn').addClass('timeBtn');
                        } else {
                            $('#CheckerApp5Btn').removeClass('timeBtn');
                        }

                        if (data[0].afterB == 0 || data[0].afterB >= 1) {
                            $('#CheckerApp6Btn').addClass('timeBtn');
                        } else {
                            $('#CheckerApp6Btn').removeClass('timeBtn');
                        }

                        if (data[0].afterC == 0 || data[0].afterC >= 1) {
                            $('#CheckerApp7Btn').addClass('timeBtn');
                        } else {
                            $('#CheckerApp7Btn').removeClass('timeBtn');
                        }

                        if (data[0].afterD == 0 || data[0].afterD >= 1) {
                            $('#CheckerApp8Btn').addClass('timeBtn');
                        } else {
                            $('#CheckerApp8Btn').removeClass('timeBtn');
                        }


                        if (data[0].mornA == 2) {
                            $('#CheckerApp1Btn').addClass('redBtn');
                        } else {
                            $('#CheckerApp1Btn').removeClass('redBtn');
                        }

                        if (data[0].mornB == 2) {
                            $('#CheckerApp2Btn').addClass('redBtn');
                        } else {
                            $('#CheckerApp2Btn').removeClass('redBtn');
                        }

                        if (data[0].mornC == 2) {
                            $('#CheckerApp3Btn').addClass('redBtn');
                        } else {
                            $('#CheckerApp3Btn').removeClass('redBtn');
                        }

                        if (data[0].mornD == 2) {
                            $('#CheckerApp4Btn').addClass('redBtn');
                        } else {
                            $('#CheckerApp4Btn').removeClass('redBtn');
                        }

                        if (data[0].afterA == 2) {
                            $('#CheckerApp5Btn').addClass('redBtn');
                        } else {
                            $('#CheckerApp5Btn').removeClass('redBtn');
                        }

                        if (data[0].afterB == 2) {
                            $('#CheckerApp6Btn').addClass('redBtn');
                        } else {
                            $('#CheckerApp6Btn').removeClass('redBtn');
                        }

                        if (data[0].afterC == 2) {
                            $('#CheckerApp7Btn').addClass('redBtn');
                        } else {
                            $('#CheckerApp7Btn').removeClass('redBtn');
                        }

                        if (data[0].afterD == 2) {
                            $('#CheckerApp8Btn').addClass('redBtn');
                        } else {
                            $('#CheckerApp8Btn').removeClass('redBtn');
                        }

                        

                    },
                    error: function(error) {
                        console.error("An error occurred:", error);
                    }
                });
            })

            $('#CheckerApp1Btn').click(function () {
                var appDate = new Date($('#appDate').val()).toISOString().slice(0, 10);
                var currDate = new Date();
                var currentFormattedDate = currDate.toISOString().slice(0, 10);

                if (appDate >= currentFormattedDate) {
                    // Check if any services are selected
                    if (services.trim() === '') {
                        // Show an error message because no services are selected
                        Swal.fire({
                            icon: 'error',
                            title: 'Please select at least one service before making an appointment!',
                            showConfirmButton: false,
                            timer: 2000
                        });
                    } else {
                        $.ajax({
                            url: 'checkAppointment1.php',
                            type: 'GET',
                            data: {
                                date: $('#appDate').val()
                            },
                            dataType: 'json',
                            success: function (data) {
                                $.ajax({
                                    url: 'saveAppointment.php',
                                    type: 'POST',
                                    data: {
                                        services_name: services,
                                        appointment_date: `${$("#appDate").val()}`,
                                        appointment_type: '08:00 AM - 09:00 AM',
                                        total_cost: price
                                    },
                                    success: function (data) {
                                        console.log(data);
                                        if (data != 0) {
                                            Swal.fire({
                                                icon: 'success',
                                                title: 'Appointment Submitted',
                                                showConfirmButton: false,
                                                timer: 800
                                            }).then(() => {
                                                window.location.href = 'Appointments.php';
                                            });
                                        } else {
                                            Swal.fire({
                                                icon: 'error',
                                                title: 'You must login first!',
                                                showConfirmButton: false,
                                                timer: 800
                                            });
                                        }
                                    },
                                    error: function (error) {
                                        alert(error);
                                    }
                                });
                            },
                            error: function (data) {
                                alert('Error loading supplier names.');
                            }
                        });
                    }
                } else {
                    Swal.fire({
                        icon: 'error',
                        title: 'Date should be valid!',
                        showConfirmButton: false,
                        timer: 800
                    });
                }
            });


            $('#CheckerApp2Btn').click(function () {
                var appDate = new Date($('#appDate').val()).toISOString().slice(0, 10);
                var currDate = new Date();
                var currentFormattedDate = currDate.toISOString().slice(0, 10);

                if (appDate >= currentFormattedDate) {
                    // Check if any services are selected
                    if (services.trim() === '') {
                        // Show an error message because no services are selected
                        Swal.fire({
                            icon: 'error',
                            title: 'Please select at least one service before making an appointment!',
                            showConfirmButton: false,
                            timer: 2000
                        });
                    } else {
                        $.ajax({
                            url: 'checkAppointment2.php',
                            type: 'GET',
                            data: {
                                date: $('#appDate').val()
                            },
                            dataType: 'json',
                            success: function (data) {
                                $.ajax({
                                    url: 'saveAppointment.php',
                                    type: 'POST',
                                    data: {
                                        services_name: services,
                                        appointment_date: `${$("#appDate").val()}`,
                                        appointment_type: '09:00 AM - 10:00 AM',
                                        total_cost: price
                                    },
                                    success: function (data) {
                                        console.log(data);
                                        if (data != 0) {
                                            Swal.fire({
                                                icon: 'success',
                                                title: 'Appointment Submitted',
                                                showConfirmButton: false,
                                                timer: 800
                                            }).then(() => {
                                                window.location.href = 'Appointments.php';
                                            });
                                        } else {
                                            Swal.fire({
                                                icon: 'error',
                                                title: 'You must login first!',
                                                showConfirmButton: false,
                                                timer: 800
                                            });
                                        }
                                    },
                                    error: function (error) {
                                        alert(error);
                                    }
                                });
                            },
                            error: function (data) {
                                alert('Error loading supplier names.');
                            }
                        });
                    }
                } else {
                    Swal.fire({
                        icon: 'error',
                        title: 'Date should be valid!',
                        showConfirmButton: false,
                        timer: 800
                    });
                }
            });

            $('#CheckerApp3Btn').click(function () {
                var appDate = new Date($('#appDate').val()).toISOString().slice(0, 10);
                var currDate = new Date();
                var currentFormattedDate = currDate.toISOString().slice(0, 10);

                if (appDate >= currentFormattedDate) {
                    // Check if any services are selected
                    if (services.trim() === '') {
                        // Show an error message because no services are selected
                        Swal.fire({
                            icon: 'error',
                            title: 'Please select at least one service before making an appointment!',
                            showConfirmButton: false,
                            timer: 2000
                        });
                    } else {
                        $.ajax({
                            url: 'checkAppointment3.php',
                            type: 'GET',
                            data: {
                                date: $('#appDate').val()
                            },
                            dataType: 'json',
                            success: function (data) {
                                $.ajax({
                                    url: 'saveAppointment.php',
                                    type: 'POST',
                                    data: {
                                        services_name: services,
                                        appointment_date: `${$("#appDate").val()}`,
                                        appointment_type: '10:00 AM - 11:00 AM',
                                        total_cost: price
                                    },
                                    success: function (data) {
                                        console.log(data);
                                        if (data != 0) {
                                            Swal.fire({
                                                icon: 'success',
                                                title: 'Appointment Submitted',
                                                showConfirmButton: false,
                                                timer: 800
                                            }).then(() => {
                                                window.location.href = 'Appointments.php';
                                            });
                                        } else {
                                            Swal.fire({
                                                icon: 'error',
                                                title: 'You must login first!',
                                                showConfirmButton: false,
                                                timer: 800
                                            });
                                        }
                                    },
                                    error: function (error) {
                                        alert(error);
                                    }
                                });
                            },
                            error: function (data) {
                                alert('Error loading supplier names.');
                            }
                        });
                    }
                } else {
                    Swal.fire({
                        icon: 'error',
                        title: 'Date should be valid!',
                        showConfirmButton: false,
                        timer: 800
                    });
                }
            });


            $('#CheckerApp4Btn').click(function () {
                var appDate = new Date($('#appDate').val()).toISOString().slice(0, 10);
                var currDate = new Date();
                var currentFormattedDate = currDate.toISOString().slice(0, 10);

                if (appDate >= currentFormattedDate) {
                    // Check if any services are selected
                    if (services.trim() === '') {
                        // Show an error message because no services are selected
                        Swal.fire({
                            icon: 'error',
                            title: 'Please select at least one service before making an appointment!',
                            showConfirmButton: false,
                            timer: 2000
                        });
                    } else {
                        $.ajax({
                            url: 'checkAppointment4.php',
                            type: 'GET',
                            data: {
                                date: $('#appDate').val()
                            },
                            dataType: 'json',
                            success: function (data) {
                                $.ajax({
                                    url: 'saveAppointment.php',
                                    type: 'POST',
                                    data: {
                                        services_name: services,
                                        appointment_date: `${$("#appDate").val()}`,
                                        appointment_type: '11:00 AM - 12:00 NN',
                                        total_cost: price
                                    },
                                    success: function (data) {
                                        console.log(data);
                                        if (data != 0) {
                                            Swal.fire({
                                                icon: 'success',
                                                title: 'Appointment Submitted',
                                                showConfirmButton: false,
                                                timer: 800
                                            }).then(() => {
                                                window.location.href = 'Appointments.php';
                                            });
                                        } else {
                                            Swal.fire({
                                                icon: 'error',
                                                title: 'You must login first!',
                                                showConfirmButton: false,
                                                timer: 800
                                            });
                                        }
                                    },
                                    error: function (error) {
                                        alert(error);
                                    }
                                });
                            },
                            error: function (data) {
                                alert('Error loading supplier names.');
                            }
                        });
                    }
                } else {
                    Swal.fire({
                        icon: 'error',
                        title: 'Date should be valid!',
                        showConfirmButton: false,
                        timer: 800
                    });
                }
            });

            $('#CheckerApp5Btn').click(function () {
                var appDate = new Date($('#appDate').val()).toISOString().slice(0, 10);
                var currDate = new Date();
                var currentFormattedDate = currDate.toISOString().slice(0, 10);

                if (appDate >= currentFormattedDate) {
                    // Check if any services are selected
                    if (services.trim() === '') {
                        // Show an error message because no services are selected
                        Swal.fire({
                            icon: 'error',
                            title: 'Please select at least one service before making an appointment!',
                            showConfirmButton: false,
                            timer: 2000
                        });
                    } else {
                        $.ajax({
                            url: 'checkAppointment5.php',
                            type: 'GET',
                            data: {
                                date: $('#appDate').val()
                            },
                            dataType: 'json',
                            success: function (data) {
                                $.ajax({
                                    url: 'saveAppointment.php',
                                    type: 'POST',
                                    data: {
                                        services_name: services,
                                        appointment_date: `${$("#appDate").val()}`,
                                        appointment_type: '01:00 PM - 02:00 PM',
                                        total_cost: price
                                    },
                                    success: function (data) {
                                        console.log(data);
                                        if (data != 0) {
                                            Swal.fire({
                                                icon: 'success',
                                                title: 'Appointment Submitted',
                                                showConfirmButton: false,
                                                timer: 800
                                            }).then(() => {
                                                window.location.href = 'Appointments.php';
                                            });
                                        } else {
                                            Swal.fire({
                                                icon: 'error',
                                                title: 'You must login first!',
                                                showConfirmButton: false,
                                                timer: 800
                                            });
                                        }
                                    },
                                    error: function (error) {
                                        alert(error);
                                    }
                                });
                            },
                            error: function (data) {
                                alert('Error loading supplier names.');
                            }
                        });
                    }
                } else {
                    Swal.fire({
                        icon: 'error',
                        title: 'Date should be valid!',
                        showConfirmButton: false,
                        timer: 800
                    });
                }
            });


            $('#CheckerApp6Btn').click(function () {
                var appDate = new Date($('#appDate').val()).toISOString().slice(0, 10);
                var currDate = new Date();
                var currentFormattedDate = currDate.toISOString().slice(0, 10);

                if (appDate >= currentFormattedDate) {
                    // Check if any services are selected
                    if (services.trim() === '') {
                        // Show an error message because no services are selected
                        Swal.fire({
                            icon: 'error',
                            title: 'Please select at least one service before making an appointment!',
                            showConfirmButton: false,
                            timer: 2000
                        });
                    } else {
                        $.ajax({
                            url: 'checkAppointment6.php',
                            type: 'GET',
                            data: {
                                date: $('#appDate').val()
                            },
                            dataType: 'json',
                            success: function (data) {
                                $.ajax({
                                    url: 'saveAppointment.php',
                                    type: 'POST',
                                    data: {
                                        services_name: services,
                                        appointment_date: `${$("#appDate").val()}`,
                                        appointment_type: '02:00 PM - 03:00 PM',
                                        total_cost: price
                                    },
                                    success: function (data) {
                                        console.log(data);
                                        if (data != 0) {
                                            Swal.fire({
                                                icon: 'success',
                                                title: 'Appointment Submitted',
                                                showConfirmButton: false,
                                                timer: 800
                                            }).then(() => {
                                                window.location.href = 'Appointments.php';
                                            });
                                        } else {
                                            Swal.fire({
                                                icon: 'error',
                                                title: 'You must login first!',
                                                showConfirmButton: false,
                                                timer: 800
                                            });
                                        }
                                    },
                                    error: function (error) {
                                        alert(error);
                                    }
                                });
                            },
                            error: function (data) {
                                alert('Error loading supplier names.');
                            }
                        });
                    }
                } else {
                    Swal.fire({
                        icon: 'error',
                        title: 'Date should be valid!',
                        showConfirmButton: false,
                        timer: 800
                    });
                }
            });

            $('#CheckerApp7Btn').click(function () {
                var appDate = new Date($('#appDate').val()).toISOString().slice(0, 10);
                var currDate = new Date();
                var currentFormattedDate = currDate.toISOString().slice(0, 10);

                if (appDate >= currentFormattedDate) {
                    // Check if any services are selected
                    if (services.trim() === '') {
                        // Show an error message because no services are selected
                        Swal.fire({
                            icon: 'error',
                            title: 'Please select at least one service before making an appointment!',
                            showConfirmButton: false,
                            timer: 2000
                        });
                    } else {
                        $.ajax({
                            url: 'checkAppointment7.php',
                            type: 'GET',
                            data: {
                                date: $('#appDate').val()
                            },
                            dataType: 'json',
                            success: function (data) {
                                $.ajax({
                                    url: 'saveAppointment.php',
                                    type: 'POST',
                                    data: {
                                        services_name: services,
                                        appointment_date: `${$("#appDate").val()}`,
                                        appointment_type: '03:00 AM - 04:00 PM',
                                        total_cost: price
                                    },
                                    success: function (data) {
                                        console.log(data);
                                        if (data != 0) {
                                            Swal.fire({
                                                icon: 'success',
                                                title: 'Appointment Submitted',
                                                showConfirmButton: false,
                                                timer: 800
                                            }).then(() => {
                                                window.location.href = 'Appointments.php';
                                            });
                                        } else {
                                            Swal.fire({
                                                icon: 'error',
                                                title: 'You must login first!',
                                                showConfirmButton: false,
                                                timer: 800
                                            });
                                        }
                                    },
                                    error: function (error) {
                                        alert(error);
                                    }
                                });
                            },
                            error: function (data) {
                                alert('Error loading supplier names.');
                            }
                        });
                    }
                } else {
                    Swal.fire({
                        icon: 'error',
                        title: 'Date should be valid!',
                        showConfirmButton: false,
                        timer: 800
                    });
                }
            });


            $('#CheckerApp8Btn').click(function () {
                var appDate = new Date($('#appDate').val()).toISOString().slice(0, 10);
                var currDate = new Date();
                var currentFormattedDate = currDate.toISOString().slice(0, 10);

                if (appDate >= currentFormattedDate) {
                    // Check if any services are selected
                    if (services.trim() === '') {
                        // Show an error message because no services are selected
                        Swal.fire({
                            icon: 'error',
                            title: 'Please select at least one service before making an appointment!',
                            showConfirmButton: false,
                            timer: 2000
                        });
                    } else {
                        $.ajax({
                            url: 'checkAppointment8.php',
                            type: 'GET',
                            data: {
                                date: $('#appDate').val()
                            },
                            dataType: 'json',
                            success: function (data) {
                                $.ajax({
                                    url: 'saveAppointment.php',
                                    type: 'POST',
                                    data: {
                                        services_name: services,
                                        appointment_date: `${$("#appDate").val()}`,
                                        appointment_type: '04:00 PM - 05:00 PM',
                                        total_cost: price
                                    },
                                    success: function (data) {
                                        console.log(data);
                                        if (data != 0) {
                                            Swal.fire({
                                                icon: 'success',
                                                title: 'Appointment Submitted',
                                                showConfirmButton: false,
                                                timer: 800
                                            }).then(() => {
                                                window.location.href = 'Appointments.php';
                                            });
                                        } else {
                                            Swal.fire({
                                                icon: 'error',
                                                title: 'You must login first!',
                                                showConfirmButton: false,
                                                timer: 800
                                            });
                                        }
                                    },
                                    error: function (error) {
                                        alert(error);
                                    }
                                });
                            },
                            error: function (data) {
                                alert('Error loading supplier names.');
                            }
                        });
                    }
                } else {
                    Swal.fire({
                        icon: 'error',
                        title: 'Date should be valid!',
                        showConfirmButton: false,
                        timer: 800
                    });
                }
            });
        })
    </script>
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script>
        AOS.init();
    </script>
    <script src="js/date.js"></script>
    <script src="js/script.js"></script>

</body>

</html>

<footer class="footer" style="padding-top: 4vmin;">
    <?php
    include "./pages/footer.php"
    ?>
</footer>