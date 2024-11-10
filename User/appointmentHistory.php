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
    <title>MOTO-JEN | Appointment History</title>
    <link rel="icon" type="image/x-icon" href="images/motojenlogofinal.png">

    <!-- font awesome cdn link  -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <!-- custom css file link  -->
    <link rel="stylesheet" href="css/style.css">

    <!---Aos animation link-->

    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">

    <style>
        .modal {
            display: none;
            /* Hidden by default */
            position: fixed;
            /* Stay in place */
            z-index: 1;
            /* Sit on top */
            padding-top: 100px;
            /* Location of the box */
            left: 0;
            top: 0;
            width: 100%;
            /* Full width */
            height: 100%;
            /* Full height */
            overflow: auto;
            /* Enable scroll if needed */
            background-color: rgb(0, 0, 0);
            /* Fallback color */
            background-color: rgba(0, 0, 0, 0.4);
            /* Black w/ opacity */
        }

        /* Modal Content */
        .modal-content {
            background-color: #fefefe;
            margin: auto;
            padding: 20px;
            border: 1px solid #888;
            width: 80%;
        }

        /* The Close Button */
        .close {
            color: #aaaaaa;
            float: right;
            font-size: 28px;
            font-weight: bold;
        }

        .close:hover,
        .close:focus {
            color: #000;
            text-decoration: none;
            cursor: pointer;
        }


        table {
            width: 100%;
            border-collapse: collapse;
            border-spacing: 0;
            font-size: 14px;
            /* Default font size */
        }

        th,
        td {
            padding: 8px;
            text-align: left;
        }

        th {
            background-color: #f2f2f2;
        }

        tr:nth-child(even) {
            background-color: #f2f2f2;
        }

        @media (max-width: 600px) {

            th,
            td {
                padding: 5px;
                font-size: 12px;
                /* Adjusted font size for smaller screens */
            }
        }

        @media (max-width: 865px) {

            th,
            td {
                padding: 5px;
                font-size: 12px;
                /* Adjusted font size for mid-sized screens */
            }
        }

        @media (max-width: 450px) {
            table {
                display: block;
            }

            thead {
                display: none;
            }

            tbody {
                display: block;
            }

            tr {
                display: block;
                margin-bottom: 20px;
            }

            td {
                display: block;
                text-align: left;
                border-bottom: 1px solid #ddd;
                font-size: 10px;
                /* Adjusted font size for smaller mobile screens */
                padding: 5px;
            }

            td::before {
                content: attr(data-label);
                font-weight: bold;
                display: block;
            }
        }
    </style>

</head>

<body>

    <header class="header">

        <?php
        include "./pages/sections/navbar.php"
        ?>

    </header>

    <div class="heading">
        <h3>Appointments</h3>
        <p><a href="home.php">Home </a> <span> / Appointments</span></p>
    </div>

    <section class="orders" style="padding-top: 0; min-height: 80vh;">

        <h1 class="title" data-aos="fade-right" data-aos-delay="300" data-aos-duration="3000">Booked Appointments</h1>

        <div class="box-container">

            <div class="" id="">
                <table id="servRepTbl" class="table table-striped table-sm" style="width:100%">
                    <thead>
                        <tr class="table-dark">
                            <th>Service Id</th>
                            <th>Service Name</th>
                            <th>Appointment Date</th>
                            <th>Total Cost</th>
                            <th>Status</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody class=table-group-divider>

                    </tbody>
                </table>
            </div>
            <div id="myModal" class="modal">
                <div class="modal-content">
                    <span class="close">&times;</span>
                    <h2><strong>Invoice</strong></h2>
                    <p><strong>Appointment Date: </strong><span  id="AppDate"></span></p>
                    <p><strong>Service/s List: </strong></p>
                    <div class="servicesGet">                               
                    </div>
                    <p><strong>Total Cost:</strong><span id="Cost"></span></p>
                </div>
            </div>

        </div>
        <script>
            $(document).ready(function() {
                $.ajax({
                    url: 'OrdersAPI/getAppointments.php',
                    type: 'GET',
                    data: {
                        id: <?php echo $user_id; ?>
                    },
                    dataType: 'json',
                    success: function(data) {
                        var table = $('#servRepTbl').find('tbody');
                        table.empty();
                        $.each(data, function(index, row) {
                            if (row.status === "Complete") {
                                table.append($('<tr>')
                                    .append($('<td>').text(row.id))
                                    .append($('<td>').text(row.services_name))
                                    .append($('<td>').text(row.appointment_date))
                                    .append($('<td>').text(row.total_cost))
                                    .append($('<td>').text(row.status))
                                    .append($('<td>').html(function() {
                                        return '<button id="Invoice" data-cost="' + row.total_cost + '" data-date="' + row.appointment_date + '" data-id="' + row.id + '" data-serv="' + row.services_name + '">Check Invoice</button>'
                                    }))
                                );
                            }
                        });
                    },
                    error: function(data) {
                        alert('Error loading supplier names.');
                    }
                });

                $('.close').click(function() {
            $('#myModal').hide();
            $('.servicesGet').empty();
        })

        var arrayOfTasks = [];
        $('#servRepTbl').on('click', '#Invoice', function() {
            $('#AppDate').text($(this).data('date'))
            $('#Cost').text($(this).data('cost'))
            arrayOfTasks = $(this).data('serv').split(',');
            $('#myModal').show();

            if (arrayOfTasks.length > 1) {
                arrayOfTasks.pop()
            }
            var stringWithQuotes = arrayOfTasks.map(function(word) {
                return "'" + word + "'";
            }).join(', ');

            console.log(stringWithQuotes)

            $('.servicesGet').empty(); // Clear existing services list

            $.ajax({
                url: 'OrdersAPI/getInvoice.php',
                type: 'GET',
                dataType: 'json',
                data: {
                    services: stringWithQuotes
                },
                success: function(data) {
                    console.log(data)
                    $.each(data, function(key, value) {
                        // Append each service and its price to the servicesGet div
                        $('.servicesGet').append(`
                            <p>${value.services_name} : ₱${value.services_price}</p>
                        `);
                    });
                },
                error: function(error) {
                    alert(error);
                }
            });
        });

            })
        </script>

    </section>

    <script src="js/script.js"></script>

    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script>
        AOS.init();
    </script>

</body>

</html>
<footer class="footer">
    <?php
    include "./pages/footer.php"
    ?>
</footer>